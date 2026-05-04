<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Assessment Results</h2>
            <a href="{{ route('assessments.student-results', $student) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                ← Back to Results
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Score Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Assessment</p>
                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $assessment->title }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Student</p>
                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $student->user->name }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Completed</p>
                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $response->completed_at->format('M d, Y') }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Time Taken</p>
                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $response->getTimeTakenFormatted() }}</p>
            </div>
        </div>

        <!-- Main Score Display -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg p-12 text-white text-center">
            <p class="text-lg font-semibold opacity-90 mb-2">Your Score</p>
            <div class="flex items-end justify-center gap-4 mb-4">
                <div class="text-6xl font-bold">{{ $response->getScorePercentage() }}</div>
                <div class="text-3xl font-semibold opacity-75">%</div>
            </div>
            <p class="text-xl font-semibold">{{ $response->getPerformanceStatus()['label'] }} {{ $response->getPerformanceStatus()['icon'] }}</p>
        </div>

        <!-- Score Breakdown -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Question Breakdown</h3>
            
            <div class="space-y-3">
                @foreach($breakdown as $item)
                    <div class="p-4 border border-slate-200 dark:border-slate-700 rounded-lg">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="font-semibold text-slate-900 dark:text-white">{{ $item['question']->question_text }}</h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                    {{ $item['question']->getDifficultyLabel() }} • 
                                    {{ $item['points_earned'] }}/{{ $item['points_possible'] }} points
                                </p>
                            </div>
                            @if($item['is_correct'])
                                <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-lg font-semibold text-sm">
                                    ✓ Correct
                                </span>
                            @else
                                <span class="px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg font-semibold text-sm">
                                    ✗ Incorrect
                                </span>
                            @endif
                        </div>

                        <!-- Answer Details -->
                        <div class="mt-3 p-3 bg-slate-50 dark:bg-slate-900 rounded-lg">
                            <p class="text-xs text-slate-600 dark:text-slate-400 mb-2">Your Answer:</p>
                            <p class="text-slate-700 dark:text-slate-300">
                                @if($item['student_answer'])
                                    @if(is_array($item['student_answer']))
                                        {{ implode(', ', $item['student_answer']) }}
                                    @else
                                        {{ $item['student_answer'] }}
                                    @endif
                                @else
                                    <span class="text-red-600 dark:text-red-400">No answer provided</span>
                                @endif
                            </p>
                        </div>

                        @if(!$item['is_correct'])
                            <div class="mt-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <p class="text-xs text-blue-600 dark:text-blue-400 mb-1">Correct Answer:</p>
                                <p class="text-blue-800 dark:text-blue-300">
                                    @php
                                        $correct = is_string($item['question']->correct_answer) ? 
                                            json_decode($item['question']->correct_answer, true) : 
                                            $item['question']->correct_answer;
                                    @endphp
                                    @if(is_array($correct))
                                        {{ implode(', ', $correct) }}
                                    @else
                                        {{ $correct }}
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-3">
            <a href="{{ route('assessments.show', $assessment) }}" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-center">
                Back to Assessment
            </a>
            <a href="{{ route('assessments.student-results', $student) }}" class="flex-1 px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold text-center">
                View All Results
            </a>
        </div>
    </div>
</x-app-layout>
