<x-app-layout>
    <x-slot name="header">Edit Invitation</x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('invitations.update', $invitation) }}" method="POST" class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            @csrf
            @method('PUT')

            <!-- Email (Read-only) -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-semibold mb-2" />
                <input
                    type="email"
                    value="{{ $invitation->email }}"
                    disabled
                    class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 rounded-lg shadow-sm px-4 py-2 bg-slate-100 dark:bg-slate-800 cursor-not-allowed" />
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Email cannot be changed</p>
            </div>

            <!-- Role Selection -->
            <div class="mb-6">
                <x-input-label for="role" :value="__('Role')" class="text-slate-700 dark:text-slate-300 font-semibold mb-2" />
                <select name="role" id="role" required class="block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200">
                    <option value="special_educator" {{ $invitation->role === 'special_educator' ? 'selected' : '' }}>
                        Special Educator (👨‍🏫)
                    </option>
                    <option value="therapist" {{ $invitation->role === 'therapist' ? 'selected' : '' }}>
                        Therapist (🏥)
                    </option>
                    <option value="care_giver" {{ $invitation->role === 'care_giver' ? 'selected' : '' }}>
                        Care Giver (❤️)
                    </option>
                    <option value="support_staff" {{ $invitation->role === 'support_staff' ? 'selected' : '' }}>
                        Support Staff (🤝)
                    </option>
                    <option value="admin" {{ $invitation->role === 'admin' ? 'selected' : '' }}>
                        Administrator (👑)
                    </option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Expiration Date -->
            <div class="mb-8">
                <x-input-label for="expires_at" :value="__('Expiration Date & Time')" class="text-slate-700 dark:text-slate-300 font-semibold mb-2" />
                <input
                    type="datetime-local"
                    id="expires_at"
                    name="expires_at"
                    value="{{ $invitation->expires_at->format('Y-m-d\TH:i') }}"
                    required
                    class="block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200" />
                <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Current expiration: {{ $invitation->expires_at->format('M d, Y H:i') }}</p>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-xl p-6 mb-8">
                <p class="text-sm text-blue-800 dark:text-blue-300">
                    <span class="font-semibold">Note:</span> The invitee's email address cannot be changed after creation. Only the role and expiration date can be modified.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-4">
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-500/30 transition-all hover:scale-[1.02] active:scale-[0.98] font-semibold">
                    Save Changes
                </button>
                <a href="{{ route('invitations.show', $invitation) }}" class="px-8 py-3 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white rounded-xl hover:bg-slate-300 dark:hover:bg-slate-600 transition font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>