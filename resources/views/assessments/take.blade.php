<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $assessment->title }}</h2>
            <div id="timer" class="text-xl font-bold px-4 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg">
                {{ $adjustedTimeLimit ?? 'No Limit' }} min
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Assessment Info -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Assessment Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Student</p>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $student->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Total Questions</p>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $questions->count() }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Accommodations</p>
                    <p class="font-semibold text-slate-900 dark:text-white">
                        @if(isset($accommodations['extra_time']))
                            ⏱️ Extra Time
                        @else
                            Standard
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Assessment Questions -->
        <form method="POST" action="{{ route('assessments.submit', [$assessment, $student]) }}" id="assessmentForm" class="space-y-6">
            @csrf

            @foreach($questions as $index => $question)
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                    <!-- Question Header -->
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
                                Question {{ $index + 1 }} of {{ $questions->count() }}
                            </h3>
                            <p class="text-slate-700 dark:text-slate-300 text-base">{{ $question->question_text }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-600 dark:text-slate-400">{{ $question->getDifficultyLabel() }}</p>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $question->points }} pts</p>
                        </div>
                    </div>

                    <!-- Question Input Based on Type -->
                    <div class="mt-6 space-y-3">
                        @if($question->question_type === 'multiple_choice' || $question->question_type === 'true_false')
                            @foreach($question->getFormattedOptions() as $key => $option)
                                <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 cursor-pointer transition">
                                    <input type="radio" name="responses[{{ $question->id }}]" value="{{ $key }}" 
                        required class="w-5 h-5 text-purple-600">
                                    <span class="ml-3 text-slate-700 dark:text-slate-300">{{ $option }}</span>
                                </label>
                            @endforeach
                        @elseif($question->question_type === 'short_answer' || $question->question_type === 'fill_blank')
                            <input type="text" name="responses[{{ $question->id }}]" required 
                                placeholder="Type your answer here..."
                                class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        @elseif($question->question_type === 'essay')
                            <textarea name="responses[{{ $question->id }}]" required rows="5"
                                placeholder="Write your response here..."
                                class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"></textarea>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Hidden time tracking -->
            <input type="hidden" name="time_taken" id="timeTaken" value="0">

            <!-- Submit Button -->
            <div class="flex gap-3">
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:shadow-lg transition font-semibold">
                    Submit Assessment
                </button>
                <a href="{{ route('assessments.show', $assessment) }}" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-700 font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        let startTime = Date.now();
        const adjustedTimeLimit = {{ $adjustedTimeLimit ?? 0 }} * 60;

        // Timer
        function updateTimer() {
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            const remaining = adjustedTimeLimit - elapsed;
            
            if (adjustedTimeLimit > 0) {
                const mins = Math.floor(remaining / 60);
                const secs = remaining % 60;
                document.getElementById('timer').textContent = 
                    (mins > 0 ? mins + ' min ' : '') + secs + ' sec';
                
                if (remaining <= 0) {
                    document.getElementById('assessmentForm').submit();
                }
            }

            document.getElementById('timeTaken').value = elapsed;
        }

        if (adjustedTimeLimit > 0) {
            setInterval(updateTimer, 1000);
        }

        // Track time before submit
        document.getElementById('assessmentForm').addEventListener('submit', function() {
            document.getElementById('timeTaken').value = 
                Math.floor((Date.now() - startTime) / 1000);
        });
    </script>
</x-app-layout>
