<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Behavioral Notes: {{ $student->user->name }}</h2>
            <a href="{{ route('therapy.student-progress', $student) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                ← Back to Progress
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Emotion Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($emotionStats as $stat)
                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-slate-100 dark:border-slate-700">
                    <p class="text-2xl mb-2">{{ match($stat->emotion_state) {
                        'happy' => '😊',
                        'calm' => '😌',
                        'anxious' => '😰',
                        'frustrated' => '😤',
                        'angry' => '😠',
                        'sad' => '😢',
                        default => '😐',
                    } }}</p>
                    <p class="font-semibold text-slate-900 dark:text-white capitalize">{{ $stat->emotion_state }}</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stat->count }}</p>
                </div>
            @empty
                <p class="text-slate-500 dark:text-slate-400">No data</p>
            @endforelse
        </div>

        <!-- Behavioral Notes List -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">All Behavioral Notes</h3>
            <div class="space-y-4">
                @forelse($notes as $note)
                    <div class="p-6 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl">{{ $note->getEmotionStateIcon() }}</span>
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">
                                        {{ $note->observation_date->format('M d, Y') }}
                                    </p>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">
                                        By: {{ $note->createdBy->name ?? 'System' }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 {{ 'bg-' . $note->getEmotionStateColor() . '-100 dark:bg-' . $note->getEmotionStateColor() . '-900/30 text-' . $note->getEmotionStateColor() . '-700 dark:text-' . $note->getEmotionStateColor() . '-300' }} rounded-lg text-sm font-semibold">
                                {{ ucfirst($note->emotion_state) }}
                            </span>
                        </div>
                        
                        <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg mb-3">
                            <p class="text-slate-700 dark:text-slate-300">{{ $note->observation }}</p>
                        </div>
                        
                        @if($note->support_provided)
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg border border-blue-200 dark:border-blue-800">
                                <p class="text-sm font-semibold text-blue-900 dark:text-blue-200 mb-2">Support Provided:</p>
                                <p class="text-blue-800 dark:text-blue-300">{{ $note->support_provided }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-12 text-slate-500 dark:text-slate-400">
                        <p class="text-lg font-medium mb-2">No behavioral notes recorded</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($notes->hasPages())
                <div class="mt-6">
                    {{ $notes->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
