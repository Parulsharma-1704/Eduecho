<x-app-layout>
    <x-slot name="header">Manage Invitations</x-slot>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4">
        <p class="text-emerald-800 dark:text-emerald-300 text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
    <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-4">
        <p class="text-red-800 dark:text-red-300 text-sm">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Create Invitation Button -->
    <div class="mb-8">
        <a href="{{ route('invitations.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-500/30 transition-all hover:scale-[1.02] active:scale-[0.98]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New Invitation
        </a>
    </div>

    <!-- Invitations Table -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden border border-slate-100 dark:border-slate-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-700 border-b border-slate-200 dark:border-slate-600">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Role</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Invited By</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Expires</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900 dark:text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invitations as $invitation)
                    <tr class="border-b border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-6 py-4">
                            <span class="text-slate-900 dark:text-white font-medium">{{ $invitation->email }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                {{ str_replace('_', ' ', ucfirst($invitation->role)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($invitation->used_at)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                                ✓ Used
                            </span>
                            @elseif($invitation->expires_at < now())
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                ✕ Expired
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                    ⏰ Pending
                                </span>
                                @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-slate-600 dark:text-slate-400 text-sm">{{ $invitation->invitedBy->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-slate-600 dark:text-slate-400 text-sm">{{ $invitation->expires_at->format('M d, Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('invitations.show', $invitation) }}" class="px-3 py-2 text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition">
                                    View
                                </a>
                                @if(!$invitation->used_at && $invitation->expires_at > now())
                                <a href="{{ route('invitations.edit', $invitation) }}" class="px-3 py-2 text-xs bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-lg hover:bg-amber-200 dark:hover:bg-amber-900/50 transition">
                                    Edit
                                </a>
                                <form action="{{ route('invitations.destroy', $invitation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="px-3 py-2 text-xs bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                                        Delete
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                            No invitations found. <a href="{{ route('invitations.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Create one now</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($invitations->hasPages())
    <div class="mt-6">
        {{ $invitations->links() }}
    </div>
    @endif
</x-app-layout>