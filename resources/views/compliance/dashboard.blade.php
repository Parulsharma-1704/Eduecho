<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Compliance Dashboard</h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">TOTAL AUDITS</p>
                <p class="text-4xl font-bold">{{ $totalAudits }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">COMPLIANCE RATE</p>
                <p class="text-4xl font-bold">{{ $complianceRate }}%</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">DATA ACCESS (30D)</p>
                <p class="text-4xl font-bold">{{ $dataAccessCount }}</p>
            </div>
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">SENSITIVE ACTIONS</p>
                <p class="text-4xl font-bold">{{ count($recentLogs) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Latest Audit -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Latest Audit</h3>
                @if($latestAudit)
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Date</p>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $latestAudit->audit_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">WCAG Level</p>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $latestAudit->getWCAGLabel() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Status</p>
                            <span class="inline-block px-3 py-1 bg-{{ $latestAudit->getComplianceStatus()['color'] }}-100 dark:bg-{{ $latestAudit->getComplianceStatus()['color'] }}-900/30 text-{{ $latestAudit->getComplianceStatus()['color'] }}-700 dark:text-{{ $latestAudit->getComplianceStatus()['color'] }}-300 rounded-lg font-semibold text-sm">
                                {{ $latestAudit->getComplianceStatus()['icon'] }} {{ $latestAudit->getComplianceStatus()['label'] }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Issues Found</p>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $latestAudit->getIssuesCount() }}</p>
                        </div>
                        <a href="{{ route('compliance.audits.show', $latestAudit) }}" class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-semibold">
                            View Details
                        </a>
                    </div>
                @else
                    <p class="text-slate-500 dark:text-slate-400">No audits yet. <a href="{{ route('compliance.audits.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Create first audit</a></p>
                @endif
            </div>

            <!-- Activity by Type -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Activity Summary (30D)</h3>
                <div class="space-y-2">
                    @forelse($logsByType as $log)
                        <div class="flex justify-between items-center p-2 bg-slate-50 dark:bg-slate-900 rounded">
                            <p class="text-sm text-slate-700 dark:text-slate-300">{{ ucfirst(str_replace('_', ' ', $log->action_type)) }}</p>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $log->count }}</span>
                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-400 text-sm">No activity recorded</p>
                    @endforelse
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Most Active Users (30D)</h3>
                <div class="space-y-3">
                    @forelse($activeUsers as $user)
                        <div class="flex justify-between items-center">
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $user->user?->name ?? 'Unknown' }}</p>
                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded text-xs font-semibold">{{ $user->action_count }}</span>
                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-400 text-sm">No user activity</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Sensitive Actions -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Recent Sensitive Actions</h3>
            </div>
            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($recentLogs as $log)
                    <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-lg">{{ $log->getActionTypeInfo()['icon'] }}</span>
                                    <span class="font-semibold text-slate-900 dark:text-white">{{ $log->getActionTypeInfo()['label'] }}</span>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $log->getActionDescription() }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">{{ $log->timestamp->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-slate-500 dark:text-slate-400 text-center">
                        No sensitive actions in the last 7 days
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('compliance.audits') }}" class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 hover:shadow-xl transition text-center">
                <p class="text-2xl mb-2">📋</p>
                <p class="font-semibold text-slate-900 dark:text-white">Audit History</p>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">View all audits</p>
            </a>
            <a href="{{ route('compliance.logs') }}" class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 hover:shadow-xl transition text-center">
                <p class="text-2xl mb-2">📝</p>
                <p class="font-semibold text-slate-900 dark:text-white">Audit Logs</p>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Access and activity logs</p>
            </a>
            <a href="{{ route('compliance.reports') }}" class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 hover:shadow-xl transition text-center">
                <p class="text-2xl mb-2">📊</p>
                <p class="font-semibold text-slate-900 dark:text-white">Reports</p>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Compliance reports</p>
            </a>
            <a href="{{ route('compliance.governance') }}" class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 hover:shadow-xl transition text-center">
                <p class="text-2xl mb-2">🔐</p>
                <p class="font-semibold text-slate-900 dark:text-white">Governance</p>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Data policies</p>
            </a>
        </div>
    </div>
</x-app-layout>
