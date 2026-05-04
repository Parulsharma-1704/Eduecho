<?php

namespace App\Http\Controllers;

use App\Models\ProgressReport;
use Illuminate\Http\Request;

class ProgressReportController extends Controller
{
    /**
     * Display a listing of progress reports.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', ProgressReport::class);

        $reports = ProgressReport::with('student', 'generatedBy')
            ->when($request->search, fn($q) => $q->whereHas('student', fn($q) => $q->whereHas('user', fn($q) => $q->where('name', 'like', "%{$request->search}%"))))
            ->paginate(15);

        return view('progress-reports.index', compact('reports'));
    }

    /**
     * Display the specified progress report.
     */
    public function show(ProgressReport $progressReport)
    {
        $this->authorize('view', $progressReport);
        $progressReport->load('student', 'generatedBy');
        return view('progress-reports.show', compact('progressReport'));
    }
}
