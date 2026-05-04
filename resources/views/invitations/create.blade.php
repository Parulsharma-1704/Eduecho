<x-app-layout>
    <x-slot name="header">Create Invitation</x-slot>

    <div class="max-w-2xl">
        <!-- Info Box -->
        <div class="mb-8 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">How Invitations Work</h3>
            <ul class="text-sm text-blue-800 dark:text-blue-300 space-y-2">
                <li>✓ You create an invitation with an email and role</li>
                <li>✓ An invitation link is generated (valid for 7 days)</li>
                <li>✓ Share the link with the invitee</li>
                <li>✓ They click the link and complete registration</li>
                <li>✓ They're automatically assigned the specified role</li>
            </ul>
        </div>

        <!-- Form -->
        <form action="{{ route('invitations.store') }}" method="POST" class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-semibold mb-2" />
                <x-text-input
                    id="email"
                    class="block w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    placeholder="educator@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Role Selection -->
            <div class="mb-8">
                <x-input-label for="role" :value="__('Role')" class="text-slate-700 dark:text-slate-300 font-semibold mb-2" />
                <select name="role" id="role" required class="block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200">
                    <option value="">-- Select Role --</option>
                    <option value="special_educator" {{ old('role') === 'special_educator' ? 'selected' : '' }}>
                        Special Educator (👨‍🏫)
                    </option>
                    <option value="therapist" {{ old('role') === 'therapist' ? 'selected' : '' }}>
                        Therapist (🏥)
                    </option>
                    <option value="care_giver" {{ old('role') === 'care_giver' ? 'selected' : '' }}>
                        Care Giver (❤️)
                    </option>
                    <option value="support_staff" {{ old('role') === 'support_staff' ? 'selected' : '' }}>
                        Support Staff (🤝)
                    </option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                        Administrator (👑)
                    </option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Select the role this person will have in the system</p>
            </div>

            <!-- Role Descriptions -->
            <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-4" id="roleDescriptions">
                <div id="desc-special_educator" class="hidden bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg p-4 border border-blue-200 dark:border-blue-800">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">👨‍🏫 Special Educator</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Can manage IEPs, assessments, and student learning plans</p>
                </div>
                <div id="desc-therapist" class="hidden bg-gradient-to-br from-rose-50 to-pink-50 dark:from-rose-900/20 dark:to-pink-900/20 rounded-lg p-4 border border-rose-200 dark:border-rose-800">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">🏥 Therapist</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Can schedule and track therapy sessions</p>
                </div>
                <div id="desc-care_giver" class="hidden bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-lg p-4 border border-amber-200 dark:border-amber-800">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">❤️ Care Giver</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Can monitor student progress and support activities</p>
                </div>
                <div id="desc-support_staff" class="hidden bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-lg p-4 border border-emerald-200 dark:border-emerald-800">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">🤝 Support Staff</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Can assist educators and manage student records</p>
                </div>
                <div id="desc-admin" class="hidden bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-lg p-4 border border-purple-200 dark:border-purple-800">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">👑 Administrator</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Full system access and user management</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-4">
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-500/30 transition-all hover:scale-[1.02] active:scale-[0.98] font-semibold">
                    Create Invitation
                </button>
                <a href="{{ route('invitations.index') }}" class="px-8 py-3 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white rounded-xl hover:bg-slate-300 dark:hover:bg-slate-600 transition font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Role Description Toggle Script -->
    <script>
        const roleSelect = document.getElementById('role');
        const roleDescriptions = document.getElementById('roleDescriptions');

        function updateRoleDescription() {
            // Hide all descriptions
            document.querySelectorAll('[id^="desc-"]').forEach(el => el.classList.add('hidden'));

            // Show selected description
            if (roleSelect.value) {
                const desc = document.getElementById('desc-' + roleSelect.value);
                if (desc) desc.classList.remove('hidden');
            }
        }

        roleSelect.addEventListener('change', updateRoleDescription);

        // Initialize on page load
        if (roleSelect.value) updateRoleDescription();
    </script>
</x-app-layout>