<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-4xl font-black text-edu-navy mb-2">Reset Password</h1>
        <p class="text-edu-gray-text">Enter your email to receive a password reset link</p>
    </div>

    <div class="mb-6 p-4 rounded-lg bg-edu-purple-light border border-edu-purple/20">
        <p class="text-sm text-edu-navy">Forgot your password? No problem! We'll send you a link to reset it.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-edu-navy font-bold mb-2" />
            <x-text-input 
                id="email" 
                class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                placeholder="you@example.com" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Primary Button -->
        <button 
            type="submit"
            class="w-full py-4 px-6 rounded-lg bg-edu-yellow text-edu-navy font-black text-base transition-all duration-300 hover:-translate-y-1 shadow-yellow hover:shadow-hover active:translate-y-0"
        >
            {{ __('Send Reset Link') }}
        </button>

        <p class="text-center text-sm text-edu-gray-text">
            Remember your password? 
            <a href="{{ route('login') }}" class="font-black text-edu-purple hover:text-edu-purple/80 transition">
                Sign in
            </a>
        </p>
    </form>
</x-guest-layout>
