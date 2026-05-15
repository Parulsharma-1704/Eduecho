<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-4xl font-black text-edu-navy mb-2">Complete Registration</h1>
        <p class="text-edu-gray-text">You're invited as a <span class="font-black text-edu-purple capitalize">{{ str_replace('_', ' ', $invitation->role) }}</span></p>
    </div>

    <form method="POST" action="{{ route('invitation.store', ['token' => $invitation->token]) }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-edu-navy font-bold mb-2" />
            <x-text-input 
                id="name" 
                class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="Your full name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email Address (Read-only from invitation) -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-edu-navy font-bold mb-2" />
            <input 
                id="email" 
                class="block w-full rounded-lg border-1.5 border-edu-gray-bg bg-edu-gray-bg text-edu-gray-text px-4 py-3 cursor-not-allowed" 
                type="email" 
                value="{{ $invitation->email }}" 
                disabled 
            />
            <p class="text-xs text-edu-gray-muted mt-1">From your invitation</p>
        </div>

        <!-- Hidden email field for form submission -->
        <input type="hidden" name="email" value="{{ $invitation->email }}" />

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-edu-navy font-bold mb-2" />
            <x-text-input 
                id="password" 
                class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors"
                type="password"
                name="password"
                required 
                autocomplete="new-password"
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-edu-navy font-bold mb-2" />
            <x-text-input 
                id="password_confirmation" 
                class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Role Display -->
        <div class="p-4 rounded-lg bg-edu-purple-light border border-edu-purple/20">
            <p class="text-sm font-bold text-edu-navy flex items-center gap-2">
                <i data-lucide="user" class="w-4 h-4 text-edu-purple"></i> Your Role: <span class="text-edu-purple capitalize">{{ str_replace('_', ' ', $invitation->role) }}</span>
            </p>
        </div>

        <!-- Student Disability Profile Section -->
        @if($invitation->role === 'student')
            <div class="border-t border-edu-gray-bg pt-4 mt-4">
                <h3 class="text-lg font-black text-edu-navy mb-3 flex items-center gap-2">
                    <i data-lucide="accessibility" class="w-5 h-5"></i> Your Accessibility Profile
                </h3>

                <!-- Disability Type -->
                <div class="mb-3">
                    <x-input-label for="disability_type" :value="__('Do you have a registered disability?')" class="text-edu-navy font-bold mb-2" />
                    <select 
                        id="disability_type" 
                        name="disability_type" 
                        class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors bg-edu-white text-edu-navy"
                    >
                        <option value="">-- No registered disability --</option>
                        <option value="autism">Autism Spectrum Disorder</option>
                        <option value="adhd">ADHD</option>
                        <option value="dyslexia">Dyslexia</option>
                        <option value="hearing">Hearing Impairment</option>
                        <option value="visual">Visual Impairment</option>
                        <option value="mobility">Mobility Impairment</option>
                    </select>
                    <x-input-error :messages="$errors->get('disability_type')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Severity (shown when disability is selected) -->
                <div class="mb-3" id="severity-section" style="display: none;">
                    <x-input-label for="severity" :value="__('Severity Level')" class="text-edu-navy font-bold mb-2" />
                    <select 
                        id="severity" 
                        name="severity" 
                        class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors bg-edu-white text-edu-navy"
                    >
                        <option value="">-- Select --</option>
                        <option value="mild">Mild</option>
                        <option value="moderate">Moderate</option>
                        <option value="severe">Severe</option>
                    </select>
                    <x-input-error :messages="$errors->get('severity')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Support Devices -->
                <div class="mb-3" id="devices-section" style="display: none;">
                    <x-input-label for="support_devices" :value="__('Support Devices / Assistive Technology')" class="text-edu-navy font-bold mb-2" />
                    <textarea 
                        id="support_devices" 
                        name="support_devices" 
                        rows="2" 
                        class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors bg-edu-white text-edu-navy" 
                        placeholder="e.g., screen reader, text-to-speech"
                    ></textarea>
                    <x-input-error :messages="$errors->get('support_devices')" class="mt-2 text-red-500 text-sm" />
                </div>

                <script>
                    document.getElementById('disability_type').addEventListener('change', function() {
                        const hasDisability = this.value !== '';
                        document.getElementById('severity-section').style.display = hasDisability ? 'block' : 'none';
                        document.getElementById('devices-section').style.display = hasDisability ? 'block' : 'none';
                    });
                </script>
            </div>
        @elseif($invitation->role === 'special_educator')
            <div class="border-t border-edu-gray-bg pt-4 mt-4">
                <h3 class="text-lg font-black text-edu-navy mb-3 flex items-center gap-2">
                    <i data-lucide="graduation-cap" class="w-5 h-5 text-edu-purple"></i> Teaching Specializations
                </h3>

                <!-- Specialization Checkboxes -->
                <div class="space-y-2 mb-4">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="specialization_autism" 
                            name="specializations[]" 
                            value="autism" 
                            class="rounded border-1.5 border-edu-gray-bg accent-edu-purple cursor-pointer"
                        >
                        <label for="specialization_autism" class="ml-3 text-sm font-bold text-edu-navy cursor-pointer">Autism Spectrum Disorder</label>
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="specialization_adhd" 
                            name="specializations[]" 
                            value="adhd" 
                            class="rounded border-1.5 border-edu-gray-bg accent-edu-purple cursor-pointer"
                        >
                        <label for="specialization_adhd" class="ml-3 text-sm font-bold text-edu-navy cursor-pointer">ADHD</label>
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="specialization_dyslexia" 
                            name="specializations[]" 
                            value="dyslexia" 
                            class="rounded border-1.5 border-edu-gray-bg accent-edu-purple cursor-pointer"
                        >
                        <label for="specialization_dyslexia" class="ml-3 text-sm font-bold text-edu-navy cursor-pointer">Dyslexia</label>
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="specialization_hearing" 
                            name="specializations[]" 
                            value="hearing" 
                            class="rounded border-1.5 border-edu-gray-bg accent-edu-purple cursor-pointer"
                        >
                        <label for="specialization_hearing" class="ml-3 text-sm font-bold text-edu-navy cursor-pointer">Hearing Impairment</label>
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="specialization_visual" 
                            name="specializations[]" 
                            value="visual" 
                            class="rounded border-1.5 border-edu-gray-bg accent-edu-purple cursor-pointer"
                        >
                        <label for="specialization_visual" class="ml-3 text-sm font-bold text-edu-navy cursor-pointer">Visual Impairment</label>
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="specialization_mobility" 
                            name="specializations[]" 
                            value="mobility" 
                            class="rounded border-1.5 border-edu-gray-bg accent-edu-purple cursor-pointer"
                        >
                        <label for="specialization_mobility" class="ml-3 text-sm font-bold text-edu-navy cursor-pointer">Mobility Impairment</label>
                    </div>
                    <x-input-error :messages="$errors->get('specializations')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Experience Level -->
                <div>
                    <x-input-label for="experience_years" :value="__('Years of Teaching Experience')" class="text-edu-navy font-bold mb-2" />
                    <x-text-input 
                        id="experience_years" 
                        class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors" 
                        type="number" 
                        name="experience_years" 
                        min="0" 
                        max="70" 
                        placeholder="5" 
                    />
                    <x-input-error :messages="$errors->get('experience_years')" class="mt-2 text-red-500 text-sm" />
                </div>
            </div>
        @endif

        <div class="pt-4">
            <x-primary-button class="w-full text-lg py-4 !bg-teal-500 !text-white !font-black shadow-lg shadow-teal-300/30 hover:!bg-teal-600 hover:shadow-lg transition-all transform hover:-translate-y-1">
                {{ __('Create Account & Login') }}
            </x-primary-button>
        </div>

        <!-- Invitation Expiry Info -->
        <p class="text-xs text-slate-500 text-center pt-4 border-t border-lavender-200 flex items-center justify-center gap-2">
            <i data-lucide="clock" class="w-3 h-3 text-indigo-700"></i> This invitation expires on <span class="font-bold text-indigo-700">{{ $invitation->expires_at->format('M d, Y') }}</span>
        </p>
    </form>
</x-guest-layout>