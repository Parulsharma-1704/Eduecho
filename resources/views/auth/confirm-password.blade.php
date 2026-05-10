<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-4xl font-black text-edu-navy mb-2">Confirm Password</h1>
        <p class="text-edu-gray-text">This is a secure area. Please verify your password.</p>
    </div>

    <div class="mb-6 p-4 rounded-lg bg-edu-pink-light border border-edu-pink/20">
        <p class="text-sm text-edu-navy">🔒 For your security, please confirm your password to continue.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-edu-navy font-bold mb-2" />
            <x-text-input 
                id="password" 
                class="block w-full rounded-lg border-1.5 border-edu-gray-bg focus:border-edu-purple focus:ring-edu-purple px-4 py-3 transition-colors"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Primary Button -->
        <button 
            type="submit"
            class="w-full py-4 px-6 rounded-lg bg-edu-yellow text-edu-navy font-black text-base transition-all duration-300 hover:-translate-y-1 shadow-yellow hover:shadow-hover active:translate-y-0"
        >
            {{ __('Confirm') }}
        </button>
    </form>
</x-guest-layout>
