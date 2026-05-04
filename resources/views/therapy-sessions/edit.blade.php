<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Therapy Session</h2>
            <a href="{{ route('therapy-sessions.show', $therapySession) }}" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <form method="POST" action="{{ route('therapy-sessions.update', $therapySession) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Student Selection -->
                <div>
                    <label for="student_id" class="block text-sm font-semibold text-slate-900 dark:text-white mb-3">Student *</label>
                    <select name="student_id" id="student_id" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600" disabled>
                        @foreach(\App\Models\Student::with('user')->get() as $student)
                            <option value="{{ $student->id }}" {{ $therapySession->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->user->name }} ({{ $student->user->email }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Student cannot be changed. Create a new session if needed.</p>
                </div>

                <!-- Therapist Selection -->
                <div>
                    <label for="therapist_id" class="block text-sm font-semibold text-slate-900 dark:text-white mb-3">Therapist *</label>
                    <select name="therapist_id" id="therapist_id" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="">Select a therapist</option>
                        @foreach(\App\Models\User::where('role', 'therapist')->orWhere('role', 'admin')->get() as $therapist)
                            <option value="{{ $therapist->id }}" {{ $therapySession->therapist_id == $therapist->id ? 'selected' : '' }}>
                                {{ $therapist->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('therapist_id')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Therapy Type -->
                <div>
                    <label for="session_type" class="block text-sm font-semibold text-slate-900 dark:text-white mb-3">Therapy Type *</label>
                    <select name="session_type" id="session_type" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="">Select therapy type</option>
                        <option value="speech" {{ $therapySession->session_type == 'speech' ? 'selected' : '' }}>Speech Therapy</option>
                        <option value="occupational" {{ $therapySession->session_type == 'occupational' ? 'selected' : '' }}>Occupational Therapy</option>
                        <option value="physical" {{ $therapySession->session_type == 'physical' ? 'selected' : '' }}>Physical Therapy</option>
                        <option value="behavioral" {{ $therapySession->session_type == 'behavioral' ? 'selected' : '' }}>Behavioral Therapy</option>
                        <option value="counseling" {{ $therapySession->session_type == 'counseling' ? 'selected' : '' }}>Counseling</option>
                        <option value="special_education" {{ $therapySession->session_type == 'special_education' ? 'selected' : '' }}>Special Education Support</option>
                    </select>
                    @error('session_type')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date & Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="session_date" class="block text-sm font-semibold text-slate-900 dark:text-white mb-3">Date & Time *</label>
                        <input type="datetime-local" name="session_date" id="session_date" required value="{{ $therapySession->session_date->format('Y-m-d\TH:i') }}" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        @error('session_date')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block text-sm font-semibold text-slate-900 dark:text-white mb-3">Duration (minutes) *</label>
                        <input type="number" name="duration" id="duration" min="15" step="15" required value="{{ $therapySession->duration }}" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        @error('duration')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Progress -->
                <div>
                    <label for="progress" class="block text-sm font-semibold text-slate-900 dark:text-white mb-3">Progress (%)</label>
                    <div class="flex items-center gap-4">
                        <input type="range" name="progress" id="progress" min="0" max="100" value="{{ $therapySession->progress }}" class="flex-1">
                        <span id="progressValue" class="text-2xl font-bold text-slate-900 dark:text-white w-12 text-center">{{ $therapySession->progress }}%</span>
                    </div>
                    @error('progress')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-semibold text-slate-900 dark:text-white mb-3">Session Notes</label>
                    <textarea name="notes" id="notes" rows="4" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">{{ $therapySession->notes }}</textarea>
                    @error('notes')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-6">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition font-semibold">
                        Update Session
                    </button>
                    <a href="{{ route('therapy-sessions.show', $therapySession) }}" class="flex-1 px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600 transition font-semibold text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const progressInput = document.getElementById('progress');
        const progressValue = document.getElementById('progressValue');
        
        progressInput.addEventListener('input', function() {
            progressValue.textContent = this.value + '%';
        });
    </script>
</x-app-layout>