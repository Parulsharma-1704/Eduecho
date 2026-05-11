<x-guest-layout>
    <div class="mb-8">
        <div class="inline-block px-3 py-1 rounded-2xl bg-violet-100 text-violet-700 font-bold text-xs mb-4">
            👨‍🏫 Professional Profile
        </div>
        <h1 class="text-4xl font-black text-indigo-700 mb-2">Educator Registration</h1>
        <p class="text-slate-600">Help students achieve their full potential</p>
    </div>

    <form method="POST" action="{{ route('register.educator.store') }}" class="space-y-4" enctype="multipart/form-data">
        @csrf

        <!-- BASIC INFORMATION -->
        <div class="border-b border-lavender-200 pb-4 mb-4">
            <h3 class="text-lg font-black text-indigo-700 mb-4">Basic Information</h3>
            
            <!-- Name -->
            <div class="mb-3">
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
            <div class="mb-3">
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

            <!-- Phone -->
            <div class="mb-3">
                <x-input-label for="phone" :value="__('Phone Number')" class="text-indigo-700 font-bold mb-2" />
                <x-text-input 
                    id="phone" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50" 
                    type="tel" 
                    name="phone" 
                    :value="old('phone')" 
                    required 
                    placeholder="+1 (555) 000-0000" 
                />
                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Password -->
            <div class="grid grid-cols-2 gap-3">
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
            </div>
        </div>

        <!-- PROFESSIONAL DETAILS -->
        <div class="border-b border-lavender-200 pb-4 mb-4">
            <h3 class="text-lg font-black text-indigo-700 mb-4">Professional Details</h3>
            
            <!-- Qualification -->
            <div class="mb-3">
                <x-input-label for="qualification" :value="__('Educational Qualification *')" class="text-indigo-700 font-bold mb-2" />
                <x-text-input 
                    id="qualification" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50" 
                    type="text" 
                    name="qualification" 
                    :value="old('qualification')" 
                    required 
                    placeholder="e.g., Master's in Special Education, B.Ed" 
                />
                <x-input-error :messages="$errors->get('qualification')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Experience Years -->
            <div class="mb-3">
                <x-input-label for="experience_years" :value="__('Years of Experience *')" class="text-indigo-700 font-bold mb-2" />
                <x-text-input 
                    id="experience_years" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50" 
                    type="number" 
                    name="experience_years" 
                    :value="old('experience_years')" 
                    required 
                    min="0"
                    placeholder="Number of years" 
                />
                <x-input-error :messages="$errors->get('experience_years')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Experience Description -->
            <div class="mb-3">
                <x-input-label for="experience_description" :value="__('Describe Your Experience')" class="text-indigo-700 font-bold mb-2" />
                <textarea 
                    id="experience_description" 
                    name="experience_description" 
                    rows="3"
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50 text-indigo-700"
                    placeholder="Tell us about your experience working with students with special needs..."
                >{{ old('experience_description') }}</textarea>
                <x-input-error :messages="$errors->get('experience_description')" class="mt-2 text-red-500 text-sm" />
            </div>
        </div>

        <!-- SPECIALIZATIONS -->
        <div class="border-b border-lavender-200 pb-4 mb-4">
            <h3 class="text-lg font-black text-indigo-700 mb-4">Areas of Specialization *</h3>
            <p class="text-sm text-slate-600 mb-3">Select the disability types you specialize in:</p>
            
            <div class="grid grid-cols-2 gap-3">
                @foreach(['autism' => 'Autism Spectrum Disorder', 'adhd' => 'ADHD', 'dyslexia' => 'Dyslexia', 'hearing' => 'Hearing Impairment', 'visual' => 'Visual Impairment', 'mobility' => 'Mobility Impairment'] as $value => $label)
                    <label class="flex items-center p-3 rounded-lg border-2 border-lavender-200 hover:border-violet-400 hover:bg-violet-50 transition cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="specializations[]" 
                            value="{{ $value }}"
                            @if(in_array($value, old('specializations', []))) checked @endif
                            class="mr-3 w-4 h-4"
                        >
                        <span class="text-sm font-semibold text-indigo-700">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('specializations')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- OPTIONAL: Educator's Own Accessibility Needs -->
        <div class="border-b border-lavender-200 pb-4 mb-4">
            <h3 class="text-lg font-black text-indigo-700 mb-4">Your Accessibility Profile (Optional)</h3>
            <p class="text-sm text-slate-600 mb-3">Many excellent educators have disabilities. If applicable, share yours:</p>
            
            <!-- Disability Type -->
            <div class="mb-3">
                <x-input-label for="educator_disability_type" :value="__('Do you have a disability?')" class="text-indigo-700 font-bold mb-2" />
                <select 
                    id="educator_disability_type" 
                    name="educator_disability_type" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50 text-indigo-700"
                >
                    <option value="">-- No --</option>
                    <option value="autism" @if(old('educator_disability_type') === 'autism') selected @endif>Autism Spectrum Disorder</option>
                    <option value="adhd" @if(old('educator_disability_type') === 'adhd') selected @endif>ADHD</option>
                    <option value="dyslexia" @if(old('educator_disability_type') === 'dyslexia') selected @endif>Dyslexia</option>
                    <option value="hearing" @if(old('educator_disability_type') === 'hearing') selected @endif>Hearing Impairment</option>
                    <option value="visual" @if(old('educator_disability_type') === 'visual') selected @endif>Visual Impairment</option>
                    <option value="mobility" @if(old('educator_disability_type') === 'mobility') selected @endif>Mobility Impairment</option>
                </select>
                <x-input-error :messages="$errors->get('educator_disability_type')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Support Devices -->
            <div id="educator-support-section" style="display: none;">
                <x-input-label for="educator_support_devices" :value="__('Support Devices / Accommodations')" class="text-indigo-700 font-bold mb-2" />
                <textarea 
                    id="educator_support_devices" 
                    name="educator_support_devices" 
                    rows="2"
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50 text-indigo-700"
                    placeholder="e.g., standing desk, flexible scheduling, etc."
                >{{ old('educator_support_devices') }}</textarea>
                <x-input-error :messages="$errors->get('educator_support_devices')" class="mt-2 text-red-500 text-sm" />
            </div>
        </div>

        <!-- CERTIFICATION -->
        <div class="border-b border-lavender-200 pb-4 mb-4">
            <h3 class="text-lg font-black text-indigo-700 mb-4">Verification Documents (Optional)</h3>
            
            <!-- Resume -->
            <div class="mb-3">
                <x-input-label for="resume" :value="__('Upload Resume/CV')" class="text-indigo-700 font-bold mb-2" />
                <input 
                    type="file" 
                    id="resume" 
                    name="resume" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 px-4 py-3 transition-colors bg-slate-50"
                    accept=".pdf,.doc,.docx"
                >
                <p class="text-xs text-slate-500 mt-1">PDF, DOC, or DOCX (Max 5MB)</p>
                <x-input-error :messages="$errors->get('resume')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Certifications -->
            <div class="mb-3">
                <x-input-label for="certifications" :value="__('Upload Certification')" class="text-indigo-700 font-bold mb-2" />
                <input 
                    type="file" 
                    id="certifications" 
                    name="certifications" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 px-4 py-3 transition-colors bg-slate-50"
                    accept=".pdf,.jpg,.jpeg,.png"
                >
                <p class="text-xs text-slate-500 mt-1">PDF, JPG, or PNG file (Max 5MB)</p>
                <x-input-error :messages="$errors->get('certifications')" class="mt-2 text-red-500 text-sm" />
            </div>
        </div>

        <!-- MOTIVATION -->
        <div class="mb-6">
            <h3 class="text-lg font-black text-indigo-700 mb-4">Tell Us More</h3>
            
            <x-input-label for="motivation" :value="__('Why do you want to become an educator on EduEcho?')" class="text-indigo-700 font-bold mb-2" />
            <textarea 
                id="motivation" 
                name="motivation" 
                rows="3"
                class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50 text-indigo-700"
                placeholder="Share your passion and what you hope to achieve..."
            >{{ old('motivation') }}</textarea>
            <x-input-error :messages="$errors->get('motivation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Terms & Conditions -->
        <div class="mb-6 p-4 rounded-lg bg-lavender-50 border border-lavender-200">
            <label class="flex items-start gap-3 cursor-pointer">
                <input 
                    type="checkbox" 
                    name="terms_agreed" 
                    required
                    class="mt-1 w-4 h-4"
                >
                <span class="text-sm text-slate-700">
                    I understand that my account will be under <strong>admin review</strong> and I cannot teach until approved. I commit to the platform's code of conduct and student safety standards.
                </span>
            </label>
            <x-input-error :messages="$errors->get('terms_agreed')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full py-4 px-6 rounded-2xl bg-violet-600 text-white font-black text-base transition-all duration-300 hover:-translate-y-1 shadow-lg hover:shadow-xl active:translate-y-0"
        >
            {{ __('Submit Application') }}
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
        const disabilitySelect = document.getElementById('educator_disability_type');
        const supportSection = document.getElementById('educator-support-section');
        
        disabilitySelect.addEventListener('change', function() {
            supportSection.style.display = this.value !== '' ? 'block' : 'none';
        });

        if (disabilitySelect.value) {
            supportSection.style.display = 'block';
        }
    </script>
</x-guest-layout>