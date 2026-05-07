<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-4xl font-black text-slate-900 dark:text-white mb-2 tracking-tight">Join Us as a Student</h2>
        <p class="text-slate-500 dark:text-slate-400 font-medium">Create your account to start learning</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Full Name')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="password_confirmation" class="block w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Student Disability Profile Section -->
        <div class="border-t-2 border-slate-200 dark:border-slate-700 pt-6">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6">Your Accessibility Profile</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">Help us personalize your learning experience by sharing information about your accessibility needs.</p>

            <!-- Disability Type -->
            <div class="space-y-2 mb-4">
                <x-input-label for="disability_type" :value="__('Do you have a registered disability?')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                <select id="disability_type" name="disability_type" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-white dark:bg-slate-800">
                    <option value="">-- No registered disability --</option>
                    <option value="autism" @if(old('disability_type') === 'autism') selected @endif>Autism Spectrum Disorder</option>
                    <option value="adhd" @if(old('disability_type') === 'adhd') selected @endif>ADHD (Attention-Deficit/Hyperactivity Disorder)</option>
                    <option value="dyslexia" @if(old('disability_type') === 'dyslexia') selected @endif>Dyslexia</option>
                    <option value="hearing" @if(old('disability_type') === 'hearing') selected @endif>Hearing Impairment</option>
                    <option value="visual" @if(old('disability_type') === 'visual') selected @endif>Visual Impairment</option>
                    <option value="mobility" @if(old('disability_type') === 'mobility') selected @endif>Mobility Impairment</option>
                </select>
                <x-input-error :messages="$errors->get('disability_type')" class="mt-2" />
            </div>

            <!-- Severity (shown when disability is selected) -->
            <div class="space-y-2 mb-4" id="severity-section" style="display: none;">
                <x-input-label for="severity" :value="__('Severity Level')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                <select id="severity" name="severity" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-white dark:bg-slate-800">
                    <option value="">-- Select severity --</option>
                    <option value="mild" @if(old('severity') === 'mild') selected @endif>Mild</option>
                    <option value="moderate" @if(old('severity') === 'moderate') selected @endif>Moderate</option>
                    <option value="severe" @if(old('severity') === 'severe') selected @endif>Severe</option>
                </select>
                <x-input-error :messages="$errors->get('severity')" class="mt-2" />
            </div>

            <!-- Support Devices -->
            <div class="space-y-2 mb-4" id="devices-section" style="display: none;">
                <x-input-label for="support_devices" :value="__('Support Devices / Assistive Technology (comma-separated)')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                <textarea id="support_devices" name="support_devices" rows="2" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-white dark:bg-slate-800" placeholder="e.g. screen reader, text-to-speech software, hearing aids">{{ old('support_devices') }}</textarea>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">List the assistive technology or devices you use</p>
                <x-input-error :messages="$errors->get('support_devices')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="space-y-2 mb-4" id="description-section" style="display: none;">
                <x-input-label for="description" :value="__('Additional Information (Optional)')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                <textarea id="description" name="description" rows="2" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-white dark:bg-slate-800" placeholder="Share any additional details about your needs...">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full text-lg py-4 !bg-cheerful-purple shadow-cheerful-purple/20 hover:!bg-cheerful-purple/90">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm font-semibold text-slate-600 dark:text-slate-400 mt-6">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-black text-cheerful-purple dark:text-cheerful-purple hover:opacity-80 transition-colors">
                Sign in instead
            </a>
        </p>

        <p class="text-center text-xs text-slate-500 dark:text-slate-400 pt-4 border-t border-slate-200 dark:border-slate-700">
            Are you a teacher or educator? 
            <span class="font-semibold">Please contact administration for an invitation link.</span>
        </p>
    </form>

    <script>
        const disabilityTypeSelect = document.getElementById('disability_type');

        // Show/hide disability fields
        disabilityTypeSelect.addEventListener('change', function() {
            const hasDisability = this.value !== '';
            document.getElementById('severity-section').style.display = hasDisability ? 'block' : 'none';
            document.getElementById('devices-section').style.display = hasDisability ? 'block' : 'none';
            document.getElementById('description-section').style.display = hasDisability ? 'block' : 'none';
        });

        // Initialize on page load
        if (disabilityTypeSelect.value) {
            disabilityTypeSelect.dispatchEvent(new Event('change'));
        }
    </script>
</x-guest-layout>
