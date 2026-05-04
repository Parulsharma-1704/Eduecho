<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Assessments</h2>
            @can('create', App\Models\Assessment::class)
                <a href="{{ route('assessments.create') }}" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition">
                    + Create Assessment
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Total Assessments</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $assessments->total() }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Adaptive Assessments</p>
                <p class="text-3xl font-bold text-blue-600">{{ $assessments->filter(fn($a) => $a->is_adaptive)->count() }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Avg Completion</p>
                <p class="text-3xl font-bold text-green-600">
                    @php
                        $avgCompletion = $assessments->avg(fn($a) => $a->getCompletionRate());
                    @endphp
                    {{ round($avgCompletion) }}%
                </p>
            </div>
        </div>

        <!-- Search -->
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" placeholder="Search assessments..." value="{{ request('search') }}" 
                class="flex-1 px-4 py-2 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 rounded-lg">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Search</button>
        </form>

        <!-- Assessments Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @forelse($assessments as $assessment)
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700 hover:shadow-xl transition">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $assessment->title }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400">{{ $assessment->course->name ?? 'No Course' }}</p>
                        </div>
                        @if($assessment->is_adaptive)
                            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg text-xs font-semibold">
                                🎯 Adaptive
                            </span>
                        @endif
                    </div>

                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-4">{{ Str::limit($assessment->description, 80) }}</p>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-2 mb-4 p-3 bg-slate-50 dark:bg-slate-900 rounded-lg">
                        <div class="text-center">
                            <p class="text-xs text-slate-600 dark:text-slate-400">Questions</p>
                            <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $assessment->questions->count() }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xs text-slate-600 dark:text-slate-400">Avg Score</p>
                            <p class="text-lg font-bold text-blue-600">{{ round($assessment->getAverageScore()) }}%</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xs text-slate-600 dark:text-slate-400">Completion</p>
                            <p class="text-lg font-bold text-green-600">{{ $assessment->getCompletionRate() }}%</p>
                        </div>
                    </div>

                    @if($assessment->time_limit)
                        <p class="text-xs text-slate-600 dark:text-slate-400 mb-4">⏱️ Time Limit: {{ $assessment->time_limit }} minutes</p>
                    @endif

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <a href="{{ route('assessments.show', $assessment) }}" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-semibold text-center">
                            View
                        </a>
                        @can('update', $assessment)
                            <a href="{{ route('assessments.edit', $assessment) }}" class="flex-1 px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-semibold text-center">
                                Edit
                            </a>
                        @endcan
                        <a href="{{ route('assessments.analytics', $assessment) }}" class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm font-semibold text-center">
                            Analytics
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-12 text-slate-500 dark:text-slate-400">
                    <p class="text-lg font-medium mb-2">No assessments found</p>
                    @can('create', App\Models\Assessment::class)
                        <a href="{{ route('assessments.create') }}" class="text-purple-600 dark:text-purple-400 hover:underline">Create your first assessment</a>
                    @endcan
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $assessments->links() }}
        </div>
    </div>
</x-app-layout>