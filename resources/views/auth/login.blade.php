<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2">Welcome Back</h2>
        <p class="text-slate-500 dark:text-slate-400">Please enter your details to sign in</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" class="text-slate-700 dark:text-slate-300 font-semibold" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 dark:border-slate-700 text-blue-600 shadow-sm focus:ring-blue-500 transition-all cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-slate-600 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition-colors">{{ __('Stay signed in') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <p class="text-center text-sm text-slate-600 dark:text-slate-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-blue-600 dark:text-blue-400 hover:text-blue-500">
                    Create one now
                </a>
            </p>
        @endif

        <!-- Invited User Info -->
        <div class="bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-200 dark:border-indigo-800 rounded-xl p-4 mt-8">
            <p class="text-xs text-indigo-800 dark:text-indigo-300 text-center">
                <span class="font-semibold">Invited as an Educator, Therapist, or Staff?</span><br>
                Check your email for your invitation link to complete registration with your assigned role.
            </p>
        </div>
    </form>
</x-guest-layout>
