<x-guest-layout>
    <div class="mb-8">
        <div class="inline-block px-3 py-1 rounded-2xl bg-rose-100 text-rose-700 font-bold text-xs mb-4">
            💚 Healthcare Professional
        </div>
        <h1 class="text-4xl font-black text-indigo-700 mb-2">Therapist Registration</h1>
        <p class="text-slate-600">Provide therapeutic support for students</p>
    </div>

    <form method="POST" action="{{ route('register.therapist.store') }}" class="space-y-4" enctype="multipart/form-data">
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
            
            <!-- License Type -->
            <div class="mb-3">
                <x-input-label for="license_type" :value="__('Type of License/Certification *')" class="text-indigo-700 font-bold mb-2" />
                <select 
                    id="license_type" 
                    name="license_type" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50 text-indigo-700"
                    required
                >
                    <option value="">-- Select --</option>
                    <option value="clinical_psychologist" @if(old('license_type') === 'clinical_psychologist') selected @endif>Clinical Psychologist</option>
                    <option value="speech_therapist" @if(old('license_type') === 'speech_therapist') selected @endif>Speech-Language Pathologist</option>
                    <option value="occupational_therapist" @if(old('license_type') === 'occupational_therapist') selected @endif>Occupational Therapist</option>
                    <option value="behavioral_analyst" @if(old('license_type') === 'behavioral_analyst') selected @endif>Behavior Analyst</option>
                    <option value="school_counselor" @if(old('license_type') === 'school_counselor') selected @endif>School Counselor</option>
                    <option value="special_education_specialist" @if(old('license_type') === 'special_education_specialist') selected @endif>Special Education Specialist</option>
                    <option value="other" @if(old('license_type') === 'other') selected @endif>Other</option>
                </select>
                <x-input-error :messages="$errors->get('license_type')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- License Number -->
            <div class="mb-3">
                <x-input-label for="license_number" :value="__('License Number *')" class="text-indigo-700 font-bold mb-2" />
                <x-text-input 
                    id="license_number" 
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50" 
                    type="text" 
                    name="license_number" 
                    :value="old('license_number')" 
                    required 
                    placeholder="Your license number" 
                />
                <x-input-error :messages="$errors->get('license_number')" class="mt-2 text-red-500 text-sm" />
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
                    placeholder="Tell us about your experience with therapy and special needs students..."
                >{{ old('experience_description') }}</textarea>
                <x-input-error :messages="$errors->get('experience_description')" class="mt-2 text-red-500 text-sm" />
            </div>
        </div>

        <!-- SPECIALIZATIONS -->
        <div class="border-b border-lavender-200 pb-4 mb-4">
            <h3 class="text-lg font-black text-indigo-700 mb-4">Areas of Specialization *</h3>
            <p class="text-sm text-slate-600 mb-3">Select the conditions/disabilities you specialize in:</p>
            
            <div class="grid grid-cols-2 gap-3">
                @foreach(['autism' => 'Autism Spectrum Disorder', 'adhd' => 'ADHD', 'dyslexia' => 'Dyslexia', 'hearing' => 'Hearing Impairment', 'visual' => 'Visual Impairment', 'mobility' => 'Mobility Impairment', 'anxiety' => 'Anxiety Disorders', 'depression' => 'Depression'] as $value => $label)
                    <label class="flex items-center p-3 rounded-lg border-2 border-lavender-200 hover:border-rose-400 hover:bg-rose-50 transition cursor-pointer">
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

        <!-- CREDENTIALS -->
        <div class="border-b border-lavender-200 pb-4 mb-4">
            <h3 class="text-lg font-black text-indigo-700 mb-4">Verification Documents</h3>
            
            <!-- License Certificate -->
            <div class="mb-3">
                <x-input-label for="license_certificate" :value="__('License Certificate *')" class="text-indigo-700 font-bold mb-2" />
                <input 
                    type="file" 
                    id="license_certificate" 
                    name="license_certificate" 
                    required
                    class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 px-4 py-3 transition-colors bg-slate-50"
                    accept=".pdf,.jpg,.jpeg,.png"
                >
                <p class="text-xs text-slate-500 mt-1">PDF, JPG, or PNG (Max 5MB)</p>
                <x-input-error :messages="$errors->get('license_certificate')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Additional Certifications -->
            <div class="mb-3">
                <x-input-label for="certifications" :value="__('Additional Certification (Optional)')" class="text-indigo-700 font-bold mb-2" />
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
            
            <x-input-label for="motivation" :value="__('Why do you want to provide therapy on EduEcho?')" class="text-indigo-700 font-bold mb-2" />
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
                    I understand that my account will be under <strong>admin review</strong> and I cannot provide therapy sessions until approved. I commit to maintaining confidentiality and the platform's code of conduct.
                </span>
            </label>
            <x-input-error :messages="$errors->get('terms_agreed')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full py-4 px-6 rounded-2xl bg-rose-600 text-white font-black text-base transition-all duration-300 hover:-translate-y-1 shadow-lg hover:shadow-xl active:translate-y-0"
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
</x-guest-layout>