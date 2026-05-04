<x-app-layout>
    <x-slot name="header">Invitation Details</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Details -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                <!-- Status Badge -->
                <div class="mb-6">
                    @if($invitation->used_at)
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                        ✓ Used on {{ $invitation->used_at->format('M d, Y H:i') }}
                    </span>
                    @elseif($invitation->expires_at < now())
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                        ✕ Expired on {{ $invitation->expires_at->format('M d, Y') }}
                        </span>
                        @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                            ⏰ Active - Expires {{ $invitation->expires_at->format('M d, Y') }}
                        </span>
                        @endif
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Email -->
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Email Address</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $invitation->email }}</p>
                    </div>

                    <!-- Role -->
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Assigned Role</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white capitalize">{{ str_replace('_', ' ', $invitation->role) }}</p>
                    </div>

                    <!-- Invited By -->
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Invited By</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $invitation->invitedBy->name }}</p>
                    </div>

                    <!-- Created -->
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Created</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $invitation->created_at->format('M d, Y H:i') }}</p>
                    </div>

                    <!-- Expires -->
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Expires</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $invitation->expires_at->format('M d, Y H:i') }}</p>
                    </div>

                    <!-- Used -->
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Status</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">
                            @if($invitation->used_at)
                            Used
                            @else
                            Pending
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Invitation Link (if not used) -->
                @if(!$invitation->used_at && $invitation->expires_at > now())
                <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-xl p-6 mb-8">
                    <p class="text-sm text-slate-700 dark:text-slate-300 mb-3 font-semibold">Invitation Link</p>
                    <div class="flex items-center space-x-2">
                        <input type="text" readonly value="{{ route('invitation.show', ['token' => $invitation->token]) }}" class="flex-1 px-4 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-900 dark:text-white" />
                        <button onclick="copyToClipboard(this)" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                            Copy
                        </button>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2">Share this link with the invitee. It will expire on {{ $invitation->expires_at->format('M d, Y') }}</p>
                </div>
                @endif

                <!-- Actions -->
                <div class="flex items-center space-x-4 border-t border-slate-200 dark:border-slate-700 pt-6">
                    @if(!$invitation->used_at && $invitation->expires_at > now())
                    <a href="{{ route('invitations.edit', $invitation) }}" class="px-6 py-2 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-lg hover:bg-amber-200 dark:hover:bg-amber-900/50 transition font-semibold text-sm">
                        Edit
                    </a>
                    <form action="{{ route('invitations.destroy', $invitation) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure? This will permanently delete the invitation.')" class="px-6 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition font-semibold text-sm">
                            Delete
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('invitations.index') }}" class="ml-auto px-6 py-2 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600 transition font-semibold text-sm">
                        Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Information Card -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6 border border-slate-100 dark:border-slate-700 mb-6">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4">📋 Information</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-slate-600 dark:text-slate-400 mb-1">Token Length</p>
                        <p class="text-slate-900 dark:text-white font-semibold">{{ strlen($invitation->token) }} characters</p>
                    </div>
                    <div>
                        <p class="text-slate-600 dark:text-slate-400 mb-1">Days Until Expiry</p>
                        <p class="text-slate-900 dark:text-white font-semibold">
                            @if($invitation->expires_at < now())
                                Expired
                                @else
                                {{ $invitation->expires_at->diffInDays(now()) }} days
                                @endif
                                </p>
                    </div>
                </div>
            </div>

            <!-- Role Info Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-800">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4">🎯 Role Details</h3>
                <p class="text-sm text-slate-700 dark:text-slate-300 mb-4">
                    Once registered with this invitation, the user will have the following role:
                </p>
                <div class="bg-white dark:bg-slate-800 rounded-lg p-3">
                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400 capitalize">
                        {{ str_replace('_', ' ', $invitation->role) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Copy to Clipboard Script -->
    <script>
        function copyToClipboard(button) {
            const input = button.previousElementSibling;
            input.select();
            document.execCommand('copy');

            const originalText = button.textContent;
            button.textContent = 'Copied!';
            button.classList.add('bg-emerald-600');

            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-emerald-600');
            }, 2000);
        }
    </script>
</x-app-layout>