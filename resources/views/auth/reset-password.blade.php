<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-4xl font-black text-edu-navy mb-2">Set New Password</h1>
        <p class="text-edu-gray-text">Create a strong password for your account</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-edu-navy font-bold mb-2" />
            <input 
                id="email" 
                class="block w-full rounded-lg border-1.5 border-edu-gray-bg bg-edu-gray-bg text-edu-gray-text px-4 py-3 cursor-not-allowed" 
                type="email" 
                :value="old('email', $request->email)" 
                readonly 
            />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" class="text-edu-navy font-bold mb-2" />
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

        <!-- Primary Button -->
        <button 
            type="submit"
            class="w-full py-4 px-6 rounded-lg bg-edu-yellow text-edu-navy font-black text-base transition-all duration-300 hover:-translate-y-1 shadow-yellow hover:shadow-hover active:translate-y-0"
        >
            {{ __('Reset Password') }}
        </button>
    </form>
</x-guest-layout>
