<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Therapy Sessions</h2>
            @can('create', App\Models\TherapySession::class)
                <a href="{{ route('therapy-sessions.create') }}" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition">
                    + Schedule Session
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Total Sessions</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $sessions->total() }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Upcoming</p>
                <p class="text-3xl font-bold text-blue-600">{{ $sessions->where('session_date', '>', now())->count() }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Completed</p>
                <p class="text-3xl font-bold text-emerald-600">{{ $sessions->where('session_date', '<=', now())->count() }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Dashboard</p>
                <a href="{{ route('therapy.dashboard') }}" class="text-purple-600 dark:text-purple-400 hover:underline font-semibold">
                    View Analytics →
                </a>
            </div>
        </div>

        <!-- Search -->
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" placeholder="Search by student name..." value="{{ request('search') }}" 
                class="flex-1 px-4 py-2 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 rounded-lg">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Search</button>
        </form>

        <!-- Sessions Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden border border-slate-100 dark:border-slate-700">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Student</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Therapist</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Duration</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Progress</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900 dark:text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($sessions as $session)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900 dark:text-white">{{ $session->student->user->name ?? 'N/A' }}</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $session->student->user->email ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                                {{ $session->therapist->name ?? 'Unassigned' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-lg text-sm font-medium">
                                    {{ $session->getTherapyTypeLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                                {{ $session->session_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                                {{ $session->getSessionDurationFormatted() }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-12 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 transition-all" style="width: {{ $session->getProgressPercentage() }}%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $session->getProgressPercentage() }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($session->isCompleted())
                                    <span class="inline-block px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-lg text-sm font-medium">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg text-sm font-medium">
                                        📅 Scheduled
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('therapy-sessions.show', $session) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">View</a>
                                @can('update', $session)
                                    <a href="{{ route('therapy-sessions.edit', $session) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">Edit</a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <p class="text-lg font-medium mb-2">No therapy sessions scheduled</p>
                                @can('create', App\Models\TherapySession::class)
                                    <a href="{{ route('therapy-sessions.create') }}" class="text-purple-600 dark:text-purple-400 hover:underline">Create your first session</a>
                                @endcan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $sessions->links() }}
        </div>
    </div>
</x-app-layout>
