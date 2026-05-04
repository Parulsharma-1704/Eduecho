<?php

namespace App\Http\Controllers;

use App\Models\AccessibilityAudit;
use App\Models\ComplianceLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplianceController extends Controller
{
    /**
     * Display compliance dashboard
     */
    public function dashboard()
    {
        $this->authorize('viewAny', AccessibilityAudit::class);

        // Latest audit
        $latestAudit = AccessibilityAudit::orderBy('audit_date', 'desc')->first();

        // Compliance trend (last 6 months)
        $auditTrend = AccessibilityAudit::where('audit_date', '>=', now()->subMonths(6))
            ->selectRaw('DATE(audit_date) as date, status, COUNT(*) as count')
            ->groupBy('date', 'status')
            ->orderBy('date')
            ->get();

        // Recent logs (sensitive actions)
        $recentLogs = ComplianceLog::where('created_at', '>=', now()->subDays(7))
            ->whereIn('action_type', ['data_access', 'data_modification', 'data_deletion', 'export', 'access_granted', 'access_denied'])
            ->orderBy('timestamp', 'desc')
            ->limit(10)
            ->get();

        // Total audit count
        $totalAudits = AccessibilityAudit::count();
        $compliantAudits = AccessibilityAudit::where('status', 'compliant')->count();
        $complianceRate = $totalAudits > 0 ? round(($compliantAudits / $totalAudits) * 100) : 0;

        // Activity by type
        $logsByType = ComplianceLog::where('created_at', '>=', now()->subMonths(1))
            ->selectRaw('action_type, COUNT(*) as count')
            ->groupBy('action_type')
            ->get();

        // Data access summary
        $dataAccessCount = ComplianceLog::where('action_type', 'data_access')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        // Users with high activity
        $activeUsers = ComplianceLog::where('created_at', '>=', now()->subDays(30))
            ->selectRaw('user_id, COUNT(*) as action_count')
            ->groupBy('user_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->with('user')
            ->get();

        return view('compliance.dashboard', compact(
            'latestAudit',
            'auditTrend',
            'recentLogs',
            'totalAudits',
            'compliantAudits',
            'complianceRate',
            'logsByType',
            'dataAccessCount',
            'activeUsers'
        ));
    }

    /**
     * Display list of audits
     */
    public function audits(Request $request)
    {
        $this->authorize('viewAny', AccessibilityAudit::class);

        $audits = AccessibilityAudit::with('auditor')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->wcag, fn($q) => $q->where('wcag_level', $request->wcag))
            ->orderBy('audit_date', 'desc')
            ->paginate(10);

        return view('compliance.audits', compact('audits'));
    }

    /**
     * Create new audit
     */
    public function createAudit()
    {
        $this->authorize('create', AccessibilityAudit::class);
        return view('compliance.create-audit');
    }

    /**
     * Store new audit
     */
    public function storeAudit(Request $request)
    {
        $this->authorize('create', AccessibilityAudit::class);

        $validated = $request->validate([
            'wcag_level' => 'required|in:A,AA,AAA',
            'issues_found' => 'required|array',
            'recommendations' => 'required|array',
            'status' => 'required|in:compliant,partial,non_compliant',
        ]);

        $validated['auditor_id'] = auth()->id();
        $validated['audit_date'] = now()->date();

        $audit = AccessibilityAudit::create($validated);

        // Log the audit creation
        ComplianceLog::create([
            'user_id' => auth()->id(),
            'action' => 'Accessibility audit created',
            'action_type' => 'audit',
            'details' => ['audit_id' => $audit->id, 'status' => $audit->status],
            'timestamp' => now(),
        ]);

        return redirect()->route('compliance.audits')
            ->with('success', 'Audit created successfully.');
    }

    /**
     * Display compliance logs
     */
    public function logs(Request $request)
    {
        $this->authorize('viewAny', ComplianceLog::class);

        $logs = ComplianceLog::with('user')
            ->when($request->action_type, fn($q) => $q->where('action_type', $request->action_type))
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->when($request->date_from, fn($q) => $q->where('timestamp', '>=', $request->date_from))
            ->when($request->date_to, fn($q) => $q->where('timestamp', '<=', $request->date_to))
            ->orderBy('timestamp', 'desc')
            ->paginate(20);

        $users = User::all();
        $actionTypes = [
            'data_access' => 'Data Access',
            'data_modification' => 'Data Modified',
            'data_deletion' => 'Data Deleted',
            'user_created' => 'User Created',
            'access_granted' => 'Access Granted',
            'access_denied' => 'Access Denied',
            'export' => 'Data Exported',
            'audit' => 'Audit',
        ];

        return view('compliance.logs', compact('logs', 'users', 'actionTypes'));
    }

    /**
     * Generate compliance report
     */
    public function generateReport(Request $request)
    {
        $this->authorize('viewAny', AccessibilityAudit::class);

        $dateFrom = $request->date_from ? \Carbon\Carbon::parse($request->date_from) : now()->subMonths(3);
        $dateTo = $request->date_to ? \Carbon\Carbon::parse($request->date_to) : now();

        // Audit data
        $audits = AccessibilityAudit::whereBetween('audit_date', [$dateFrom, $dateTo])->get();
        
        // Compliance log summary
        $logsSummary = ComplianceLog::whereBetween('timestamp', [$dateFrom, $dateTo])
            ->selectRaw('action_type, COUNT(*) as count')
            ->groupBy('action_type')
            ->get();

        // Data access summary
        $dataAccessCount = ComplianceLog::where('action_type', 'data_access')
            ->whereBetween('timestamp', [$dateFrom, $dateTo])
            ->count();

        // Sensitive actions
        $sensitiveActions = ComplianceLog::where('created_at', '>=', now()->subDays(30))
            ->whereIn('action_type', ['data_deletion', 'access_denied', 'export'])
            ->count();

        // Users summary
        $userCount = ComplianceLog::whereBetween('timestamp', [$dateFrom, $dateTo])
            ->distinct('user_id')
            ->count('user_id');

        $reportData = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'audits' => $audits,
            'logs_summary' => $logsSummary,
            'data_access_count' => $dataAccessCount,
            'sensitive_actions' => $sensitiveActions,
            'user_count' => $userCount,
            'compliant_audits' => $audits->where('status', 'compliant')->count(),
            'total_audits' => $audits->count(),
        ];

        if ($request->format === 'pdf') {
            return view('compliance.report-pdf', $reportData);
        }

        return view('compliance.report', $reportData);
    }

    /**
     * Export compliance data
     */
    public function export(Request $request)
    {
        $this->authorize('viewAny', ComplianceLog::class);

        $type = $request->type ?? 'logs';
        
        if ($type === 'logs') {
            $data = ComplianceLog::with('user')
                ->orderBy('timestamp', 'desc')
                ->get();
        } else {
            $data = AccessibilityAudit::with('auditor')
                ->orderBy('audit_date', 'desc')
                ->get();
        }

        // Log the export
        ComplianceLog::create([
            'user_id' => auth()->id(),
            'action' => "Exported {$type}",
            'action_type' => 'export',
            'details' => ['export_type' => $type, 'record_count' => $data->count()],
            'timestamp' => now(),
        ]);

        $filename = "{$type}-export-" . now()->format('Y-m-d') . '.csv';
        $headers = ['Content-Type' => 'text/csv'];

        return response()->stream(function() use ($data) {
            $handle = fopen('php://output', 'w');
            
            if ($data->first()) {
                fputcsv($handle, array_keys($data->first()->toArray()));
                foreach ($data as $row) {
                    fputcsv($handle, $row->toArray());
                }
            }
            
            fclose($handle);
        }, 200, ['Content-Disposition' => "attachment; filename=$filename", 'Content-Type' => 'text/csv']);
    }

    /**
     * Data governance settings
     */
    public function governance()
    {
        $this->authorize('viewAny', ComplianceLog::class);

        // Retention policies
        $retentionPolicies = [
            'compliance_logs' => ['retention_days' => 365, 'label' => 'Compliance Logs'],
            'audit_logs' => ['retention_days' => 730, 'label' => 'Audit Logs'],
            'access_logs' => ['retention_days' => 180, 'label' => 'Access Logs'],
        ];

        // Data classification
        $dataClassifications = [
            'public' => ['level' => 0, 'description' => 'Public data'],
            'internal' => ['level' => 1, 'description' => 'Internal use only'],
            'confidential' => ['level' => 2, 'description' => 'Confidential student data'],
            'restricted' => ['level' => 3, 'description' => 'Restricted/sensitive data'],
        ];

        // Access control summary
        $permissionCount = DB::table('permissions')->count();
        $roleCount = DB::table('roles')->count();
        $userCount = User::count();

        // Last data cleanup
        $lastCleanup = null; // Would fetch from logs

        return view('compliance.governance', compact(
            'retentionPolicies',
            'dataClassifications',
            'permissionCount',
            'roleCount',
            'userCount',
            'lastCleanup'
        ));
    }

    /**
     * Get detailed audit view
     */
    public function showAudit(AccessibilityAudit $audit)
    {
        $this->authorize('view', $audit);
        $audit->load('auditor');
        return view('compliance.audit-detail', compact('audit'));
    }
}
