<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Audit Details</h2>
            <a href="{{ route('compliance.audits') }}" class="px-4 py-2 bg-slate-300 dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg hover:bg-slate-400 dark:hover:bg-slate-600 font-semibold transition">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Audit Header -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Audit Date</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $audit->audit_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">WCAG Level</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $audit->getWCAGLabel() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Auditor</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $audit->auditor?->name ?? 'System' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Status</p>
                        <span class="inline-block px-3 py-1 bg-{{ $audit->getComplianceStatus()['color'] }}-100 dark:bg-{{ $audit->getComplianceStatus()['color'] }}-900/30 text-{{ $audit->getComplianceStatus()['color'] }}-700 dark:text-{{ $audit->getComplianceStatus()['color'] }}-300 rounded-lg font-semibold text-sm">
                            {{ $audit->getComplianceStatus()['icon'] }} {{ $audit->getComplianceStatus()['label'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Issues Found -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Issues Found ({{ $audit->getIssuesCount() }})</h3>
            </div>
            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($audit->issues_found as $issue)
                    <div class="p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <div class="flex items-start gap-3">
                            <p class="text-2xl">⚠️</p>
                            <div class="flex-1">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $issue['title'] ?? $issue }}</p>
                                @if(is_array($issue) && isset($issue['description']))
                                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">{{ $issue['description'] }}</p>
                                @endif
                                @if(is_array($issue) && isset($issue['severity']))
                                    <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold bg-{{ $issue['severity'] === 'critical' ? 'red' : ($issue['severity'] === 'high' ? 'orange' : 'yellow') }}-100 dark:bg-{{ $issue['severity'] === 'critical' ? 'red' : ($issue['severity'] === 'high' ? 'orange' : 'yellow') }}-900/30 text-{{ $issue['severity'] === 'critical' ? 'red' : ($issue['severity'] === 'high' ? 'orange' : 'yellow') }}-700 dark:text-{{ $issue['severity'] === 'critical' ? 'red' : ($issue['severity'] === 'high' ? 'orange' : 'yellow') }}-300 rounded">
                                        {{ ucfirst($issue['severity'] ?? 'medium') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-500 dark:text-slate-400">
                        <p class="text-lg font-semibold mb-1">✓ No Issues Found</p>
                        <p class="text-sm">This audit passed with flying colors!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recommendations -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Recommendations ({{ count($audit->recommendations ?? []) }})</h3>
            </div>
            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($audit->recommendations as $recommendation)
                    <div class="p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <div class="flex items-start gap-3">
                            <p class="text-2xl">💡</p>
                            <div class="flex-1">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $recommendation['title'] ?? $recommendation }}</p>
                                @if(is_array($recommendation) && isset($recommendation['description']))
                                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">{{ $recommendation['description'] }}</p>
                                @endif
                                @if(is_array($recommendation) && isset($recommendation['priority']))
                                    <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded">
                                        Priority: {{ ucfirst($recommendation['priority']) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-500 dark:text-slate-400">
                        <p class="text-sm">No recommendations at this time</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Follow-up Status -->
        @if($audit->needsFollowUp())
            <div class="bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-800 rounded-2xl p-6">
                <div class="flex items-start gap-3">
                    <p class="text-2xl">⚠️</p>
                    <div>
                        <p class="font-bold text-amber-900 dark:text-amber-100 mb-1">Follow-up Required</p>
                        <p class="text-amber-800 dark:text-amber-200 text-sm">
                            This audit has findings that require attention. Please address the issues and recommendations listed above.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-green-50 dark:bg-green-950/20 border border-green-200 dark:border-green-800 rounded-2xl p-6">
                <div class="flex items-start gap-3">
                    <p class="text-2xl">✓</p>
                    <div>
                        <p class="font-bold text-green-900 dark:text-green-100 mb-1">All Clear</p>
                        <p class="text-green-800 dark:text-green-200 text-sm">
                            This audit shows full compliance with no issues requiring follow-up.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
