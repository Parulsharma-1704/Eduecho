<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Assessment Results: {{ $student->user->name }}</h2>
            <a href="{{ route('students.show', $student) }}" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Summary Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Total Assessments</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $totalCount }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Completed</p>
                <p class="text-3xl font-bold text-green-600">{{ $completedCount }}</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">Average Score</p>
                <p class="text-3xl font-bold text-blue-600">{{ round($averageScore) }}%</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase mb-2">In Progress</p>
                <p class="text-3xl font-bold text-amber-600">{{ $totalCount - $completedCount }}</p>
            </div>
        </div>

        <!-- Assessment Results Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden border border-slate-100 dark:border-slate-700">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Assessment</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Course</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Score</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Date</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900 dark:text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($responses as $response)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900 dark:text-white">{{ $response->assessment->title }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                {{ $response->assessment->course->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($response->isCompleted())
                                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg text-sm font-semibold">
                                        ✓ Completed
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-lg text-sm font-semibold">
                                        ⏳ In Progress
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($response->isCompleted())
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500" style="width: {{ $response->getScorePercentage() }}%"></div>
                                        </div>
                                        <span class="font-bold text-slate-900 dark:text-white">{{ $response->getScorePercentage() }}%</span>
                                    </div>
                                @else
                                    <span class="text-slate-500 dark:text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                {{ $response->completed_at?->format('M d, Y') ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @if($response->isCompleted())
                                    <a href="{{ route('assessments.results', [$response->assessment, $student]) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                        View Results
                                    </a>
                                @else
                                    <a href="{{ route('assessments.take', [$response->assessment, $student]) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">
                                        Continue
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <p class="text-lg font-medium mb-2">No assessments yet</p>
                                <p class="text-sm">Assessments will appear here once assigned</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($responses->hasPages())
            <div class="mt-6">
                {{ $responses->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
