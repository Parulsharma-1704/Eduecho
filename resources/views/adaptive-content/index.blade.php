<x-app-layout>
    <x-slot name="header">
        Adaptive Content Library
    </x-slot>

    <div class="space-y-6">
        <!-- Header with Create Button -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Content Variations</h2>
            <a href="{{ route('adaptive-content.create') }}" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition">
                + Create Adaptive Content
            </a>
        </div>

        <!-- Content Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden border border-slate-100 dark:border-slate-700">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Resource</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Difficulty</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Variations</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Created By</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900 dark:text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($adaptiveContents as $content)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900 dark:text-white">{{ $content->courseResource->title ?? 'N/A' }}</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ Str::limit($content->description, 50) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg text-sm font-medium">
                                    {{ ucfirst($content->content_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 {{ $content->difficulty_level === 'beginner' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300' : ($content->difficulty_level === 'intermediate' ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300' : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300') }} rounded-lg text-sm font-medium">
                                    {{ ucfirst($content->difficulty_level) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">
                                {{ $content->variations()->count() }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                {{ $content->creator->name ?? 'System' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 {{ $content->is_active ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300' : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300' }} rounded-lg text-sm font-medium">
                                    {{ $content->is_active ? '✓ Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('adaptive-content.show', $content) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">View</a>
                                <a href="{{ route('adaptive-content.edit', $content) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">Edit</a>
                                <form action="{{ route('adaptive-content.destroy', $content) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this content?')" class="text-red-600 dark:text-red-400 hover:underline text-sm font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <p class="text-lg font-medium mb-2">No adaptive content yet</p>
                                <a href="{{ route('adaptive-content.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Create your first adaptive content</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $adaptiveContents->links() }}
        </div>
    </div>
</x-app-layout>
