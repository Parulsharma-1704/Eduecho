<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-4xl font-black text-edu-navy mb-2">Verify Your Email</h1>
        <p class="text-edu-gray-text">Confirm your email address to activate your account</p>
    </div>

    <div class="mb-6 p-4 rounded-lg bg-edu-teal-light border border-edu-teal/20">
        <p class="text-sm text-edu-navy">Thanks for signing up! We've sent a verification link to your email. Click the link in the email to confirm your account.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 rounded-lg bg-edu-yellow-light border border-edu-yellow/30">
            <p class="text-sm font-bold text-edu-navy">
                ✓ A new verification link has been sent to your email!
            </p>
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
            <button 
                type="submit"
                class="w-full py-4 px-6 rounded-lg bg-edu-yellow text-edu-navy font-black text-base transition-all duration-300 hover:-translate-y-1 shadow-yellow hover:shadow-hover active:translate-y-0"
            >
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button 
                type="submit"
                class="w-full py-3 px-6 rounded-lg border-1.5 border-edu-gray-bg text-edu-navy font-black text-base transition-all duration-300 hover:bg-edu-gray-bg active:translate-y-0"
            >
                {{ __('Sign Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
