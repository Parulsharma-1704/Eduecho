<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Assessment Analytics: {{ $assessment->title }}</h2>
            <a href="{{ route('assessments.show', $assessment) }}" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">TOTAL RESPONSES</p>
                <p class="text-4xl font-bold">{{ $totalResponses }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">COMPLETED</p>
                <p class="text-4xl font-bold">{{ $completedResponses }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">AVG SCORE</p>
                <p class="text-4xl font-bold">{{ round($averageScore) }}%</p>
            </div>
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">COMPLETION RATE</p>
                <p class="text-4xl font-bold">{{ $completionRate }}%</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Score Distribution -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Score Distribution</h3>
                <div class="space-y-4">
                    @forelse($scoreDistribution as $dist)
                        <div>
                            <div class="flex justify-between mb-2">
                                <p class="font-semibold text-slate-900 dark:text-white">{{ $dist->range }}</p>
                                <span class="font-bold text-slate-700 dark:text-slate-300">{{ $dist->count }}</span>
                            </div>
                            <div class="w-full h-3 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500" 
                                    style="width: {{ ($dist->count / max(1, $completedResponses)) * 100 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-400 text-center py-4">No completed assessments yet</p>
                    @endforelse
                </div>
            </div>

            <!-- Time Statistics -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Time Statistics</h3>
                @if($timeStats)
                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg">
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Average Time</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">
                                {{ floor($timeStats->avg_time / 60) }}m {{ round($timeStats->avg_time % 60) }}s
                            </p>
                        </div>
                        <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg">
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Minimum Time</p>
                            <p class="text-2xl font-bold text-blue-600">
                                {{ floor($timeStats->min_time / 60) }}m {{ round($timeStats->min_time % 60) }}s
                            </p>
                        </div>
                        <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg">
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Maximum Time</p>
                            <p class="text-2xl font-bold text-amber-600">
                                {{ floor($timeStats->max_time / 60) }}m {{ round($timeStats->max_time % 60) }}s
                            </p>
                        </div>
                    </div>
                @else
                    <p class="text-slate-500 dark:text-slate-400 text-center py-4">No time data available</p>
                @endif
            </div>
        </div>

        <!-- Assessment Details -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Assessment Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Total Questions</p>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $assessment->questions->count() }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Total Points</p>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $assessment->questions->sum('points') }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Time Limit</p>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $assessment->time_limit ?? '∞' }} min</p>
                </div>
            </div>

            <!-- Accommodations -->
            <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-3">Accommodations Available</p>
                <div class="flex flex-wrap gap-2">
                    @if($assessment->allow_extra_time)
                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg text-sm">⏱️ Extra Time</span>
                    @endif
                    @if($assessment->allow_breaks)
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg text-sm">☕ Breaks</span>
                    @endif
                    @if($assessment->allow_assistive_tech)
                        <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-lg text-sm">🎧 Assistive Tech</span>
                    @endif
                    @if($assessment->is_adaptive)
                        <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-lg text-sm">🎯 Adaptive</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
