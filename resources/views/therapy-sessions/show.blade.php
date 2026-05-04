<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Therapy Session Details</h2>
            <div class="space-x-2">
                @can('update', $therapySession)
                    <a href="{{ route('therapy-sessions.edit', $therapySession) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Edit Session
                    </a>
                @endcan
                <a href="{{ route('therapy-sessions.index') }}" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Session Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Session Information</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Student</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $therapySession->student->user->name }}</p>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $therapySession->student->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Therapist</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $therapySession->therapist->name ?? 'Unassigned' }}</p>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $therapySession->therapist->email ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Therapy Type</p>
                        <p class="text-lg font-bold">
                            <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-lg">
                                {{ $therapySession->getTherapyTypeLabel() }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Date & Time</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $therapySession->session_date->format('M d, Y g:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Duration</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $therapySession->getSessionDurationFormatted() }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Status</p>
                        @if($therapySession->isCompleted())
                            <span class="inline-block px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-lg font-semibold">
                                ✓ Completed
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg font-semibold">
                                📅 Scheduled
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Progress & Stats -->
            <div class="space-y-4">
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-4">Progress</p>
                    <div class="flex items-end gap-4">
                        <div class="flex-1">
                            <div class="w-full h-32 bg-slate-200 dark:bg-slate-700 rounded-lg overflow-hidden">
                                <div class="h-full bg-gradient-to-t from-purple-500 to-indigo-500 transition-all" style="width: 100%; height: {{ $therapySession->getProgressPercentage() }}%"></div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-4xl font-bold text-slate-900 dark:text-white">{{ $therapySession->getProgressPercentage() }}%</p>
                            <p class="text-sm text-slate-600 dark:text-slate-400">{{ $therapySession->getProgressStatus()['label'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                    <p class="font-semibold text-slate-900 dark:text-white mb-3">Quick Links</p>
                    <div class="space-y-2">
                        <a href="{{ route('therapy.student-progress', $therapySession->student) }}" class="block text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                            View Student Progress
                        </a>
                        <a href="{{ route('therapy.behavioral-notes', $therapySession->student) }}" class="block text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-semibold">
                            View Behavioral Notes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Session Notes -->
        @if($therapySession->notes)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Session Notes</h3>
                <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-700">
                    <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">{{ $therapySession->notes }}</p>
                </div>
            </div>
        @endif

        <!-- Behavioral Notes for this Session -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">📝 Behavioral Observations</h3>
                @can('update', $therapySession)
                    <button type="button" onclick="toggleBehavioralNoteForm()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-semibold">
                        + Add Note
                    </button>
                @endcan
            </div>

            <!-- Add Behavioral Note Form -->
            @can('update', $therapySession)
                <div id="behavioralNoteForm" class="hidden mb-6 p-6 bg-slate-50 dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-700">
                    <form method="POST" action="{{ route('therapy.add-note', $therapySession) }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="emotion_state" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Emotion State</label>
                                <select name="emotion_state" id="emotion_state" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white rounded-lg">
                                    <option value="">Select emotion state</option>
                                    <option value="happy">😊 Happy</option>
                                    <option value="calm">😌 Calm</option>
                                    <option value="anxious">😰 Anxious</option>
                                    <option value="frustrated">😤 Frustrated</option>
                                    <option value="angry">😠 Angry</option>
                                    <option value="sad">😢 Sad</option>
                                </select>
                            </div>
                            <div>
                                <label for="observation" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Observation</label>
                                <textarea name="observation" id="observation" rows="4" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white rounded-lg"></textarea>
                            </div>
                            <div>
                                <label for="support_provided" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Support Provided (Optional)</label>
                                <textarea name="support_provided" id="support_provided" rows="3" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white rounded-lg"></textarea>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                                    Save Note
                                </button>
                                <button type="button" onclick="toggleBehavioralNoteForm()" class="flex-1 px-4 py-2 bg-slate-300 dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg hover:bg-slate-400 dark:hover:bg-slate-600 font-semibold">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endcan

            <!-- Display Notes -->
            <div class="space-y-3">
                @forelse($therapySession->behavioralNotes as $note)
                    <div class="p-4 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <div class="flex items-start gap-3 mb-3">
                            <span class="text-2xl">{{ $note->getEmotionStateIcon() }}</span>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white">{{ ucfirst($note->emotion_state) }}</p>
                                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $note->observation_date->format('M d, Y') }} • By {{ $note->createdBy->name ?? 'System' }}</p>
                                    </div>
                                    <span class="px-2 py-1 bg-slate-100 dark:bg-slate-900 rounded text-xs font-semibold text-slate-700 dark:text-slate-300">
                                        {{ ucfirst($note->emotion_state) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="text-slate-700 dark:text-slate-300 mb-2">{{ $note->observation }}</p>
                        @if($note->support_provided)
                            <div class="text-sm p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded">
                                <p class="font-semibold text-blue-900 dark:text-blue-200 mb-1">Support Provided:</p>
                                <p class="text-blue-800 dark:text-blue-300">{{ $note->support_provided }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-slate-500 dark:text-slate-400 py-4">No behavioral notes recorded</p>
                @endforelse
            </div>
        </div>

        <!-- Delete Button -->
        @can('delete', $therapySession)
            <div class="text-right">
                <form method="POST" action="{{ route('therapy-sessions.destroy', $therapySession) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this session?')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Delete Session
                    </button>
                </form>
            </div>
        @endcan
    </div>

    <script>
        function toggleBehavioralNoteForm() {
            const form = document.getElementById('behavioralNoteForm');
            form.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
