<x-guest-layout>
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-2xl bg-teal-100 text-teal-700 font-bold text-xs mb-4">
            <i data-lucide="accessibility" class="w-3 h-3"></i> Accessibility First
        </div>
        <h1 class="text-4xl font-black text-indigo-700 mb-2">Student Registration</h1>
        <p class="text-slate-600">Join EduEcho and start your learning journey</p>
    </div>

    <form method="POST" action="{{ route('register.student.store') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-indigo-700 font-bold mb-2" />
            <x-text-input 
                id="name" 
                class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                placeholder="Your full name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-indigo-700 font-bold mb-2" />
            <x-text-input 
                id="email" 
                class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                placeholder="you@example.com" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-indigo-700 font-bold mb-2" />
            <x-text-input 
                id="password" 
                class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50"
                type="password"
                name="password"
                required 
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-indigo-700 font-bold mb-2" />
            <x-text-input 
                id="password_confirmation" 
                class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50"
                type="password"
                name="password_confirmation" 
                required 
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Accessibility Profile Section -->
        <div class="border-t border-lavender-200 pt-4 mt-4">
            <h3 class="text-lg font-black text-indigo-700 mb-3 flex items-center gap-2">
                <i data-lucide="accessibility" class="w-5 h-5"></i> Your Accessibility Profile
            </h3>

            <!-- Disability Type -->
            <div class="mb-3">
                <x-input-label for="disability_type" :value="__('Do you have a registered disability? (Optional)')" class="text-indigo-700 font-bold mb-2" />
                <select 
                    id="disability_type" 
                    name="disability_type" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50 text-indigo-700"
                >
                    <option value="">-- No registered disability --</option>
                    <option value="autism" @if(old('disability_type') === 'autism') selected @endif>Autism Spectrum Disorder</option>
                    <option value="adhd" @if(old('disability_type') === 'adhd') selected @endif>ADHD</option>
                    <option value="dyslexia" @if(old('disability_type') === 'dyslexia') selected @endif>Dyslexia</option>
                    <option value="hearing" @if(old('disability_type') === 'hearing') selected @endif>Hearing Impairment</option>
                    <option value="visual" @if(old('disability_type') === 'visual') selected @endif>Visual Impairment</option>
                    <option value="mobility" @if(old('disability_type') === 'mobility') selected @endif>Mobility Impairment</option>
                </select>
                <x-input-error :messages="$errors->get('disability_type')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Severity -->
            <div class="mb-3" id="severity-section" style="display: none;">
                <x-input-label for="severity" :value="__('Severity Level')" class="text-indigo-700 font-bold mb-2" />
                <select 
                    id="severity" 
                    name="severity" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50 text-indigo-700"
                >
                    <option value="">-- Select --</option>
                    <option value="mild" @if(old('severity') === 'mild') selected @endif>Mild</option>
                    <option value="moderate" @if(old('severity') === 'moderate') selected @endif>Moderate</option>
                    <option value="severe" @if(old('severity') === 'severe') selected @endif>Severe</option>
                </select>
                <x-input-error :messages="$errors->get('severity')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Support Devices -->
            <div class="mb-3" id="devices-section" style="display: none;">
                <x-input-label for="support_devices" :value="__('Support Devices / Assistive Technology')" class="text-indigo-700 font-bold mb-2" />
                <textarea 
                    id="support_devices" 
                    name="support_devices" 
                    rows="2" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50 text-indigo-700" 
                    placeholder="e.g., screen reader, text-to-speech"
                >{{ old('support_devices') }}</textarea>
                <x-input-error :messages="$errors->get('support_devices')" class="mt-2 text-red-500 text-sm" />
            </div>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full py-4 px-6 rounded-2xl bg-teal-500 text-white font-black text-base transition-all duration-300 hover:-translate-y-1 shadow-lg hover:shadow-xl active:translate-y-0 mt-6"
        >
            {{ __('Create Student Account') }}
        </button>

        <p class="text-center text-sm text-slate-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-black text-teal-500 hover:text-teal-600 transition">
                Sign in
            </a>
        </p>

        <p class="text-center text-xs text-slate-500 pt-3 border-t border-lavender-200">
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-bold">← Back to role selection</a>
        </p>
    </form>

    <script>
        const disabilityTypeSelect = document.getElementById('disability_type');
        
        disabilityTypeSelect.addEventListener('change', function() {
            const hasDisability = this.value !== '';
            document.getElementById('severity-section').style.display = hasDisability ? 'block' : 'none';
            document.getElementById('devices-section').style.display = hasDisability ? 'block' : 'none';
        });

        if (disabilityTypeSelect.value) {
            disabilityTypeSelect.dispatchEvent(new Event('change'));
        }
    </script>
</x-guest-layout>