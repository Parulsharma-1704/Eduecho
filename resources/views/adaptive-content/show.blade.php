<x-app-layout>
    <x-slot name="header">
        {{ $adaptiveContent->courseResource->title ?? 'Adaptive Content' }}
    </x-slot>

    <div class="space-y-6">
        <!-- Content Details Card -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">
                        {{ $adaptiveContent->courseResource->title ?? 'Content' }}
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400">{{ $adaptiveContent->description }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('adaptive-content.edit', $adaptiveContent) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Edit
                    </a>
                    <form action="{{ route('adaptive-content.destroy', $adaptiveContent) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this content?')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg">
                    <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase">Type</p>
                    <p class="text-lg font-bold text-slate-900 dark:text-white">{{ ucfirst($adaptiveContent->content_type) }}</p>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg">
                    <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase">Difficulty</p>
                    <p class="text-lg font-bold text-slate-900 dark:text-white">{{ ucfirst($adaptiveContent->difficulty_level) }}</p>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg">
                    <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase">Variations</p>
                    <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $adaptiveContent->variations()->count() }}</p>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg">
                    <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase">Status</p>
                    <p class="text-lg font-bold {{ $adaptiveContent->is_active ? 'text-emerald-600' : 'text-slate-600' }}">
                        {{ $adaptiveContent->is_active ? '✓ Active' : 'Inactive' }}
                    </p>
                </div>
            </div>

            <!-- Original Content Preview -->
            <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">Original Content</h3>
                <div class="p-4 bg-slate-50 dark:bg-slate-900 rounded-lg text-slate-600 dark:text-slate-300">
                    {{ $adaptiveContent->original_content }}
                </div>
            </div>
        </div>

        <!-- Variations Section -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Content Variations</h3>
                <button onclick="document.getElementById('variationForm').classList.toggle('hidden')" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                    + Add Variation
                </button>
            </div>

            <!-- Create Variation Form (Hidden by default) -->
            <div id="variationForm" class="hidden mb-6 p-6 bg-slate-50 dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-700">
                <h4 class="font-semibold text-slate-900 dark:text-white mb-4">Create New Variation</h4>
                <form action="{{ route('adaptive-content.variations.create', $adaptiveContent) }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="variation_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Variation Type *
                            </label>
                            <select name="variation_type" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg" required>
                                <option value="">Select type</option>
                                <option value="simplified">Simplified</option>
                                <option value="detailed">Detailed</option>
                                <option value="visual">Visual</option>
                                <option value="audio">Audio</option>
                                <option value="kinesthetic">Kinesthetic</option>
                                <option value="multimodal">Multimodal</option>
                            </select>
                        </div>
                        <div>
                            <label for="target_disability" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Target Disability
                            </label>
                            <select name="target_disability" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg">
                                <option value="">Any</option>
                                <option value="hearing">Hearing Impairment</option>
                                <option value="visual">Visual Impairment</option>
                                <option value="mobility">Mobility Issues</option>
                                <option value="cognitive">Cognitive Disability</option>
                                <option value="learning">Learning Disability</option>
                                <option value="speech">Speech Disorder</option>
                                <option value="multiple">Multiple Disabilities</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="adapted_content" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Adapted Content *
                        </label>
                        <textarea name="adapted_content" rows="6" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg" placeholder="Enter adapted content..." required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="recommendation_score" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Recommendation Score (0-100)
                            </label>
                            <input type="number" name="recommendation_score" min="0" max="100" value="50" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg">
                        </div>
                        <div class="flex items-end">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_default" value="1" class="w-4 h-4 rounded">
                                <span class="ml-2 text-sm font-medium text-slate-700 dark:text-slate-300">Set as Default</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Create Variation
                        </button>
                        <button type="button" onclick="document.getElementById('variationForm').classList.toggle('hidden')" class="px-4 py-2 bg-slate-300 dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

            <!-- Variations List -->
            <div class="space-y-4">
                @forelse($variations as $variation)
                    <div class="p-4 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <h4 class="font-semibold text-slate-900 dark:text-white">{{ ucfirst($variation->variation_type) }} Variation</h4>
                                    @if($variation->is_default)
                                        <span class="px-2 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded text-xs font-medium">Default</span>
                                    @endif
                                    @if($variation->target_disability)
                                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded text-xs font-medium">
                                            {{ ucfirst(str_replace('_', ' ', $variation->target_disability)) }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-slate-600 dark:text-slate-400 mb-2">{{ Str::limit($variation->adapted_content, 200) }}</p>
                                <div class="flex gap-4 text-sm text-slate-500 dark:text-slate-400">
                                    <span>Score: {{ $variation->recommendation_score }}</span>
                                    <span>Used: {{ $variation->usage_count ?? 0 }} times</span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="alert('Edit variation feature coming soon')" class="px-3 py-1 text-indigo-600 dark:text-indigo-400 hover:underline text-sm">
                                    Edit
                                </button>
                                <form action="{{ route('adaptive-content.variations.destroy', [$adaptiveContent, $variation]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this variation?')" class="px-3 py-1 text-red-600 dark:text-red-400 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-slate-500 dark:text-slate-400 py-6">
                        No variations yet. Create one to get started!
                    </p>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($variations->hasPages())
                <div class="mt-6">
                    {{ $variations->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
