<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Compliance Reports</h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Date Range Selection -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition">
                        Generate
                    </button>
                </div>
            </form>
        </div>

        <!-- Report Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">TOTAL AUDITS</p>
                <p class="text-4xl font-bold">{{ $total_audits }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">COMPLIANT</p>
                <p class="text-4xl font-bold">{{ $compliant_audits }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">TOTAL LOGS</p>
                <p class="text-4xl font-bold">{{ $data_access_count }}</p>
            </div>
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">ACTIVE USERS</p>
                <p class="text-4xl font-bold">{{ $user_count }}</p>
            </div>
        </div>

        <!-- Audit Details Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Audit Summary</h3>
            </div>
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Audit Date</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">WCAG Level</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Issues</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($audits as $audit)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-6 py-4 text-slate-900 dark:text-white font-medium">
                                {{ $audit->audit_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-slate-900 dark:text-white font-semibold">
                                {{ $audit->getWCAGLabel() }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded text-sm font-semibold">
                                    {{ $audit->getIssuesCount() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-{{ $audit->getComplianceStatus()['color'] }}-100 dark:bg-{{ $audit->getComplianceStatus()['color'] }}-900/30 text-{{ $audit->getComplianceStatus()['color'] }}-700 dark:text-{{ $audit->getComplianceStatus()['color'] }}-300 rounded-lg font-semibold text-sm">
                                    {{ $audit->getComplianceStatus()['label'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                No audits in the selected period
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Activity Breakdown -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700">
                <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Activity by Type</h3>
                </div>
                <div class="p-6 space-y-2">
                    @forelse($logs_summary as $log)
                        <div class="flex justify-between items-center p-2 bg-slate-50 dark:bg-slate-900 rounded">
                            <p class="text-sm text-slate-700 dark:text-slate-300">{{ ucfirst(str_replace('_', ' ', $log->action_type)) }}</p>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $log->count }}</span>
                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-400 text-sm">No activity in selected period</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700">
                <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Compliance Status</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <p class="font-semibold text-slate-900 dark:text-white">Compliance Rate</p>
                                <p class="font-bold text-lg text-green-600 dark:text-green-400">
                                    {{ $total_audits > 0 ? round(($compliant_audits / $total_audits) * 100) : 0 }}%
                                </p>
                            </div>
                            <div class="w-full bg-slate-300 dark:bg-slate-700 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $total_audits > 0 ? round(($compliant_audits / $total_audits) * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400">{{ $compliant_audits }} of {{ $total_audits }} audits compliant</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
