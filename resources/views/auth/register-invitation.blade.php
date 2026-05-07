<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2">Complete Your Registration</h2>
        <p class="text-slate-500 dark:text-slate-400">You've been invited as a <span class="font-semibold capitalize">{{ str_replace('_', ' ', $invitation->role) }}</span></p>
    </div>

    <form method="POST" action="{{ route('invitation.store', ['token' => $invitation->token]) }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-1">
            <x-input-label for="name" :value="__('Full Name')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address (Read-only from invitation) -->
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <input id="email" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-slate-100 dark:bg-slate-800 cursor-not-allowed" type="email" value="{{ $invitation->email }}" disabled />
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">This email was specified in your invitation</p>
        </div>

        <!-- Hidden email field for form submission -->
        <input type="hidden" name="email" value="{{ $invitation->email }}" />

        <!-- Password -->
        <div class="space-y-1">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <x-text-input id="password" class="block w-full"
                type="password"
                name="password"
                required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <x-text-input id="password_confirmation" class="block w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role Display -->
        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <p class="text-sm text-slate-700 dark:text-slate-300">
                <span class="font-semibold">Your Role:</span>
                <span class="capitalize ml-2 text-blue-600 dark:text-blue-400 font-semibold">{{ str_replace('_', ' ', $invitation->role) }}</span>
            </p>
        </div>

        <!-- Student Disability Profile Section -->
        @if($invitation->role === 'student')
            <div class="border-t-2 border-slate-200 dark:border-slate-700 pt-8">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6">Your Accessibility Profile</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">Help us personalize your learning experience by sharing information about your accessibility needs.</p>

                <!-- Disability Type -->
                <div class="space-y-1 mb-4">
                    <x-input-label for="disability_type" :value="__('Do you have a registered disability?')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                    <select id="disability_type" name="disability_type" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-white dark:bg-slate-800">
                        <option value="">-- No registered disability --</option>
                        <option value="autism">Autism Spectrum Disorder</option>
                        <option value="adhd">ADHD (Attention-Deficit/Hyperactivity Disorder)</option>
                        <option value="dyslexia">Dyslexia</option>
                        <option value="hearing">Hearing Impairment</option>
                        <option value="visual">Visual Impairment</option>
                        <option value="mobility">Mobility Impairment</option>
                    </select>
                    <x-input-error :messages="$errors->get('disability_type')" class="mt-2" />
                </div>

                <!-- Severity (shown when disability is selected) -->
                <div class="space-y-1 mb-4" id="severity-section" style="display: none;">
                    <x-input-label for="severity" :value="__('Severity Level')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                    <select id="severity" name="severity" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-white dark:bg-slate-800">
                        <option value="">-- Select severity --</option>
                        <option value="mild">Mild</option>
                        <option value="moderate">Moderate</option>
                        <option value="severe">Severe</option>
                    </select>
                    <x-input-error :messages="$errors->get('severity')" class="mt-2" />
                </div>

                <!-- Support Devices -->
                <div class="space-y-1 mb-4" id="devices-section" style="display: none;">
                    <x-input-label for="support_devices" :value="__('Support Devices / Assistive Technology (comma-separated)')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                    <textarea id="support_devices" name="support_devices" rows="3" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-white dark:bg-slate-800" placeholder="e.g. screen reader, text-to-speech software, hearing aids"></textarea>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">List the assistive technology or devices you use</p>
                    <x-input-error :messages="$errors->get('support_devices')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="space-y-1 mb-4" id="description-section" style="display: none;">
                    <x-input-label for="description" :value="__('Additional Information (Optional)')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                    <textarea id="description" name="description" rows="3" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-white dark:bg-slate-800" placeholder="Share any additional details about your needs..."></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <script>
                    document.getElementById('disability_type').addEventListener('change', function() {
                        const hasDisability = this.value !== '';
                        document.getElementById('severity-section').style.display = hasDisability ? 'block' : 'none';
                        document.getElementById('devices-section').style.display = hasDisability ? 'block' : 'none';
                        document.getElementById('description-section').style.display = hasDisability ? 'block' : 'none';
                    });
                </script>
            </div>
        @elseif($invitation->role === 'special_educator')
            <div class="border-t-2 border-slate-200 dark:border-slate-700 pt-8">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6">Your Teaching Specializations</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">Select the disability types you specialize in teaching.</p>

                <!-- Specialization Checkboxes -->
                <div class="space-y-3 mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="specialization_autism" name="specializations[]" value="autism" class="rounded border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-cheerful-purple focus:ring-cheerful-purple">
                        <label for="specialization_autism" class="ml-3 text-sm font-medium text-slate-700 dark:text-slate-300">Autism Spectrum Disorder</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="specialization_adhd" name="specializations[]" value="adhd" class="rounded border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-cheerful-purple focus:ring-cheerful-purple">
                        <label for="specialization_adhd" class="ml-3 text-sm font-medium text-slate-700 dark:text-slate-300">ADHD</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="specialization_dyslexia" name="specializations[]" value="dyslexia" class="rounded border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-cheerful-purple focus:ring-cheerful-purple">
                        <label for="specialization_dyslexia" class="ml-3 text-sm font-medium text-slate-700 dark:text-slate-300">Dyslexia</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="specialization_hearing" name="specializations[]" value="hearing" class="rounded border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-cheerful-purple focus:ring-cheerful-purple">
                        <label for="specialization_hearing" class="ml-3 text-sm font-medium text-slate-700 dark:text-slate-300">Hearing Impairment</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="specialization_visual" name="specializations[]" value="visual" class="rounded border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-cheerful-purple focus:ring-cheerful-purple">
                        <label for="specialization_visual" class="ml-3 text-sm font-medium text-slate-700 dark:text-slate-300">Visual Impairment</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="specialization_mobility" name="specializations[]" value="mobility" class="rounded border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-cheerful-purple focus:ring-cheerful-purple">
                        <label for="specialization_mobility" class="ml-3 text-sm font-medium text-slate-700 dark:text-slate-300">Mobility Impairment</label>
                    </div>
                    <x-input-error :messages="$errors->get('specializations')" class="mt-2" />
                </div>

                <!-- Experience Level -->
                <div class="space-y-1">
                    <x-input-label for="experience_years" :value="__('Years of Teaching Experience')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                    <x-text-input id="experience_years" class="block w-full" type="number" name="experience_years" min="0" max="70" placeholder="5" />
                    <x-input-error :messages="$errors->get('experience_years')" class="mt-2" />
                </div>
            </div>
        @endif

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Create Account & Login') }}
            </x-primary-button>
        </div>

        <!-- Invitation Expiry Info -->
        <p class="text-xs text-slate-500 dark:text-slate-400 text-center">
            This invitation expires on <span class="font-semibold">{{ $invitation->expires_at->format('M d, Y') }}</span>
        </p>
    </form>
</x-guest-layout>