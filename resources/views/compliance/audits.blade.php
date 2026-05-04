<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Accessibility Audits</h2>
            <a href="{{ route('compliance.audits.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition">
                + Create Audit
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filters -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
            <form method="GET" class="flex gap-4 flex-wrap">
                <div class="flex-1 min-w-48">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Statuses</option>
                        <option value="compliant" {{ request('status') === 'compliant' ? 'selected' : '' }}>Compliant</option>
                        <option value="partial" {{ request('status') === 'partial' ? 'selected' : '' }}>Partial Compliance</option>
                        <option value="non_compliant" {{ request('status') === 'non_compliant' ? 'selected' : '' }}>Non-Compliant</option>
                    </select>
                </div>
                <div class="flex-1 min-w-48">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">WCAG Level</label>
                    <select name="wcag" class="w-full px-3 py-2 bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Levels</option>
                        <option value="A" {{ request('wcag') === 'A' ? 'selected' : '' }}>Level A</option>
                        <option value="AA" {{ request('wcag') === 'AA' ? 'selected' : '' }}>Level AA</option>
                        <option value="AAA" {{ request('wcag') === 'AAA' ? 'selected' : '' }}>Level AAA</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition">
                        Filter
                    </button>
                    <a href="{{ route('compliance.audits') }}" class="px-4 py-2 bg-slate-300 dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg hover:bg-slate-400 dark:hover:bg-slate-600 font-semibold transition">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Audits Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 overflow-hidden">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Date</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">WCAG Level</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Issues</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Status</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700 dark:text-slate-300">Auditor</th>
                        <th class="px-6 py-3 text-right font-semibold text-slate-700 dark:text-slate-300">Actions</th>
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
                                    {{ $audit->getComplianceStatus()['icon'] }} {{ $audit->getComplianceStatus()['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 dark:text-white">
                                {{ $audit->auditor?->name ?? 'System' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('compliance.audits.show', $audit) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold text-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                No audits found. <a href="{{ route('compliance.audits.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Create one now</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $audits->links() }}
        </div>
    </div>
</x-app-layout>
