<x-app-layout>
    <x-slot name="header">
        Therapy Dashboard & Analytics
    </x-slot>

    <div class="space-y-6">
        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">TOTAL SESSIONS</p>
                <p class="text-4xl font-bold">{{ $totalSessions }}</p>
            </div>
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">COMPLETED</p>
                <p class="text-4xl font-bold">{{ $completedSessions }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">AVG PROGRESS</p>
                <p class="text-4xl font-bold">{{ round($averageProgress) }}%</p>
            </div>
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 text-white shadow-lg">
                <p class="text-sm font-semibold opacity-90 mb-2">UPCOMING</p>
                <p class="text-4xl font-bold">{{ $upcomingSessions->count() }}</p>
            </div>
        </div>

        <!-- Upcoming Sessions -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">📅 Upcoming Sessions</h3>
            <div class="space-y-3">
                @forelse($upcomingSessions as $session)
                    <div class="p-4 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h4 class="font-semibold text-slate-900 dark:text-white">
                                    {{ $session->student->user->name }} - {{ $session->getTherapyTypeLabel() }}
                                </h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    Therapist: {{ $session->therapist->name ?? 'Unassigned' }}
                                </p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    📅 {{ $session->session_date->format('M d, Y \a\t g:i A') }}
                                </p>
                            </div>
                            <a href="{{ route('therapy-sessions.show', $session) }}" class="text-purple-600 dark:text-purple-400 hover:underline font-semibold">
                                View →
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 dark:text-slate-400 text-center py-4">No upcoming sessions</p>
                @endforelse
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Sessions by Type -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Sessions by Type</h3>
                <div class="space-y-3">
                    @forelse($sessionsByType as $type)
                        <div>
                            <div class="flex justify-between mb-2">
                                <p class="font-semibold text-slate-900 dark:text-white">
                                    {{ match($type->session_type) {
                                        'speech' => 'Speech Therapy',
                                        'occupational' => 'Occupational Therapy',
                                        'physical' => 'Physical Therapy',
                                        'behavioral' => 'Behavioral Therapy',
                                        'counseling' => 'Counseling',
                                        'special_education' => 'Special Education Support',
                                        default => ucfirst($type->session_type),
                                    } }}
                                </p>
                                <span class="font-bold text-slate-700 dark:text-slate-300">{{ $type->count }}</span>
                            </div>
                            <div class="w-full h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500" style="width: {{ ($type->count / $totalSessions) * 100 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-400 text-center py-4">No session types data</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Sessions -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Recent Sessions</h3>
                <div class="space-y-3">
                    @forelse($therapySessions as $session)
                        <div class="p-4 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-slate-900 dark:text-white">{{ $session->student->user->name }}</h4>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ $session->session_date->format('M d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-slate-900 dark:text-white">{{ $session->getProgressPercentage() }}%</p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">{{ $session->getProgressStatus()['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 dark:text-slate-400 text-center py-4">No recent sessions</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
