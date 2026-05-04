<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2">Complete Your Registration</h2>
        <p class="text-slate-500 dark:text-slate-400">You've been invited as a <span class="font-semibold capitalize">{{ str_replace('_', ' ', $invitation->role) }}</span></p>
    </div>

    <form method="POST" action="{{ route('invitation.store', ['token' => $invitation->token]) }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-1">
            <x-input-label for="name" :value="__('Full Name')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address (Read-only from invitation) -->
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <input id="email" class="block w-full border-slate-300 dark:border-slate-700 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm px-4 py-2 transition-all duration-200 bg-slate-100 dark:bg-slate-800 cursor-not-allowed" type="email" value="{{ $invitation->email }}" disabled />
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">This email was specified in your invitation</p>
        </div>

        <!-- Hidden email field for form submission -->
        <input type="hidden" name="email" value="{{ $invitation->email }}" />

        <!-- Password -->
        <div class="space-y-1">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <x-text-input id="password" class="block w-full"
                type="password"
                name="password"
                required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700 dark:text-slate-300 font-semibold" />
            <x-text-input id="password_confirmation" class="block w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role Display -->
        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <p class="text-sm text-slate-700 dark:text-slate-300">
                <span class="font-semibold">Your Role:</span>
                <span class="capitalize ml-2 text-blue-600 dark:text-blue-400 font-semibold">{{ str_replace('_', ' ', $invitation->role) }}</span>
            </p>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Create Account & Login') }}
            </x-primary-button>
        </div>

        <!-- Invitation Expiry Info -->
        <p class="text-xs text-slate-500 dark:text-slate-400 text-center">
            This invitation expires on <span class="font-semibold">{{ $invitation->expires_at->format('M d, Y') }}</span>
        </p>
    </form>
</x-guest-layout>