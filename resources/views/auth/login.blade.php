<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-4xl font-black text-slate-900 dark:text-white mb-2 tracking-tight">Welcome Back</h2>
        <p class="text-slate-500 dark:text-slate-400 font-medium">Please enter your details to sign in</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between ml-1">
                <x-input-label for="password" :value="__('Password')" class="text-slate-700 dark:text-slate-300 font-bold" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-cheerful-purple dark:text-cheerful-purple hover:opacity-80" href="{{ route('password.request') }}">
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
        <div class="flex items-center justify-between px-1">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-lg border-slate-300 dark:border-slate-700 text-cheerful-purple shadow-sm focus:ring-cheerful-purple transition-all cursor-pointer" name="remember">
                <span class="ms-3 text-sm font-bold text-slate-500 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition-colors">{{ __('Stay signed in') }}</span>
            </label>
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full text-lg py-4 !bg-cheerful-purple shadow-cheerful-purple/20 hover:!bg-cheerful-purple/90">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <p class="text-center text-sm font-semibold text-slate-600 dark:text-slate-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-black text-cheerful-purple dark:text-cheerful-purple hover:opacity-80">
                    Create one now
                </a>
            </p>
        @endif

        <!-- Invited User Info -->
        <div class="bg-cheerful-purple/5 dark:bg-cheerful-purple/10 border border-cheerful-purple/10 dark:border-cheerful-purple/20 rounded-2xl p-6 mt-8">
            <p class="text-xs text-slate-600 dark:text-slate-400 text-center leading-relaxed font-medium">
                <span class="font-bold text-slate-800 dark:text-slate-200">Invited as an Educator, Therapist, or Staff?</span><br>
                Check your email for your invitation link to complete registration with your assigned role.
            </p>
        </div>
    </form>
</x-guest-layout>
