<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Therapy Progress: {{ $student->user->name }}</h2>
            <a href="{{ route('therapy.behavioral-notes', $student) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                View Behavioral Notes
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Total Sessions</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $totalSessions }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Completed</p>
                <p class="text-3xl font-bold text-emerald-600">{{ $completedSessions }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Avg Progress</p>
                <p class="text-3xl font-bold text-purple-600">{{ round($averageProgress) }}%</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Recent Notes</p>
                <p class="text-3xl font-bold text-blue-600">{{ $recentNotes->count() }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Session Progress Chart -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">📊 Progress Over Time</h3>
                <div class="space-y-4">
                    @forelse($sessions as $session)
                        <div>
                            <div class="flex justify-between mb-2">
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">{{ $session->getTherapyTypeLabel() }}</p>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ $session->session_date->format('M d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-slate-900 dark:text-white">{{ $session->getProgressPercentage() }}%</p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">{{ $session->getProgressStatus()['label'] }}</p>
                                </div>
                            </div>
                            <div class="w-full h-3 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                @php
                                    $color = match($session->getProgressStatus()['color']) {
                                        'emerald' => 'from-emerald-500 to-emerald-600',
                                        'blue' => 'from-blue-500 to-blue-600',
                                        'amber' => 'from-amber-500 to-amber-600',
                                        'red' => 'from-red-500 to-red-600',
                                        default => 'from-slate-500 to-slate-600',
                                    };
                                @endphp
                                <div class="h-full bg-gradient-to-r {{ $color }}" style="width: {{ $session->getProgressPercentage() }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-400 text-center py-4">No sessions recorded</p>
                    @endforelse
                </div>
                {{ $sessions->links() }}
            </div>

            <!-- Sessions by Type -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Therapy Types</h3>
                <div class="space-y-3">
                    @forelse($sessionsByType as $type)
                        <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-900 rounded-lg">
                            <p class="font-semibold text-slate-900 dark:text-white">
                                {{ match($type->session_type) {
                                    'speech' => '🗣️',
                                    'occupational' => '👐',
                                    'physical' => '🏃',
                                    'behavioral' => '🧠',
                                    'counseling' => '💬',
                                    'special_education' => '📚',
                                    default => '📋',
                                } }}
                                {{ substr($type->session_type, 0, 8) }}
                            </p>
                            <span class="font-bold text-blue-600 dark:text-blue-400">{{ $type->count }}</span>
                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-400 text-center py-4">No sessions</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Behavioral Notes -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">📝 Recent Behavioral Notes</h3>
                <a href="{{ route('therapy.behavioral-notes', $student) }}" class="text-purple-600 dark:text-purple-400 hover:underline text-sm font-semibold">
                    View All →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentNotes as $note)
                    <div class="p-4 border border-slate-200 dark:border-slate-700 rounded-lg">
                        <div class="flex items-start gap-3">
                            <span class="text-2xl">{{ $note->getEmotionStateIcon() }}</span>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="inline-block px-2 py-1 bg-slate-100 dark:bg-slate-900 rounded text-xs font-semibold text-slate-700 dark:text-slate-300">
                                        {{ ucfirst($note->emotion_state) }}
                                    </span>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ $note->observation_date->format('M d, Y') }}</p>
                                </div>
                                <p class="text-slate-700 dark:text-slate-300">{{ Str::limit($note->observation, 150) }}</p>
                                @if($note->support_provided)
                                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                                        <strong>Support:</strong> {{ Str::limit($note->support_provided, 100) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 dark:text-slate-400 text-center py-4">No behavioral notes recorded</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
