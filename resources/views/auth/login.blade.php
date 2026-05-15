<x-guest-layout>
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-2xl bg-teal-100 text-teal-700 font-bold text-xs mb-4">
            <i data-lucide="accessibility" class="w-3 h-3"></i> Accessibility First
        </div>
        <h1 class="text-4xl font-black text-indigo-700 mb-2">Welcome Back!</h1>
        <p class="text-slate-600">Sign in to your account to continue learning</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-indigo-700 font-bold mb-2" />
            <x-text-input 
                id="email" 
                class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
                placeholder="you@example.com" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <x-input-label for="password" :value="__('Password')" class="text-indigo-700 font-bold" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-indigo-700 hover:text-teal-500 transition" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input 
                id="password" 
                class="block w-full rounded-2xl border-2 border-lavender-200 focus:border-teal-500 focus:ring-teal-500 px-4 py-3 transition-colors bg-slate-50"
                type="password"
                name="password"
                required 
                autocomplete="current-password"
                placeholder="••••••••" 
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input 
                id="remember_me" 
                type="checkbox" 
                class="rounded border-lavender-200 text-teal-500 focus:ring-teal-500 cursor-pointer" 
                name="remember"
            >
            <label for="remember_me" class="ms-3 text-sm font-semibold text-slate-600">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Primary Button -->
        <button 
            type="submit"
            class="w-full py-4 px-6 rounded-2xl bg-indigo-700 text-white font-black text-base transition-all duration-300 hover:-translate-y-1 shadow-lg hover:shadow-xl active:translate-y-0"
        >
            {{ __('Sign In') }}
        </button>

        @if (Route::has('register'))
            <p class="text-center text-sm text-slate-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-black text-teal-500 hover:text-teal-600 transition">
                    Create one
                </a>
            </p>
        @endif

        <!-- Info Box -->
        <div class="bg-lavender-50 rounded-2xl p-4 border border-lavender-200">
            <p class="text-xs text-indigo-700 font-semibold flex items-center gap-2">
                <i data-lucide="user" class="w-3 h-3"></i> <strong>Invited?</strong> Check your email for your invitation link to register with your assigned role.
            </p>
        </div>
    </form>
</x-guest-layout>
