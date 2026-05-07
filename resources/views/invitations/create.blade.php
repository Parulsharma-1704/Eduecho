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
                        Special Educator
                    </option>
                    <option value="therapist" {{ old('role') === 'therapist' ? 'selected' : '' }}>
                        Therapist
                    </option>
                    <option value="care_giver" {{ old('role') === 'care_giver' ? 'selected' : '' }}>
                        Care Giver
                    </option>
                    <option value="support_staff" {{ old('role') === 'support_staff' ? 'selected' : '' }}>
                        Support Staff
                    </option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                        Administrator
                    </option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Select the role this person will have in the system</p>
            </div>

            <!-- Role Descriptions -->
            <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-4" id="roleDescriptions">
                <div id="desc-special_educator" class="hidden bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg p-4 border border-blue-200 dark:border-blue-800 transition-all duration-300">
                    <div class="flex items-center space-x-2 text-blue-600 dark:text-blue-400 mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <p class="text-sm font-black uppercase tracking-wider">Special Educator</p>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Can manage IEPs, assessments, and student learning plans</p>
                </div>
                <div id="desc-therapist" class="hidden bg-gradient-to-br from-rose-50 to-pink-50 dark:from-rose-900/20 dark:to-pink-900/20 rounded-lg p-4 border border-rose-200 dark:border-rose-800 transition-all duration-300">
                    <div class="flex items-center space-x-2 text-rose-500 mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <p class="text-sm font-black uppercase tracking-wider">Therapist</p>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Can schedule and track therapy sessions</p>
                </div>
                <div id="desc-care_giver" class="hidden bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-lg p-4 border border-amber-200 dark:border-amber-800 transition-all duration-300">
                    <div class="flex items-center space-x-2 text-amber-500 mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <p class="text-sm font-black uppercase tracking-wider">Care Giver</p>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Can monitor student progress and support activities</p>
                </div>
                <div id="desc-support_staff" class="hidden bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-emerald-900/20 rounded-lg p-4 border border-emerald-200 dark:border-emerald-800 transition-all duration-300">
                    <div class="flex items-center space-x-2 text-emerald-500 mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <p class="text-sm font-black uppercase tracking-wider">Support Staff</p>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Can assist educators and manage student records</p>
                </div>
                <div id="desc-admin" class="hidden bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-lg p-4 border border-purple-200 dark:border-purple-800 transition-all duration-300">
                    <div class="flex items-center space-x-2 text-purple-600 mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <p class="text-sm font-black uppercase tracking-wider">Administrator</p>
                    </div>
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