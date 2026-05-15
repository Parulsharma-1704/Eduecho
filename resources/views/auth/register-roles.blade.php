<x-guest-layout>
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-2xl bg-teal-100 text-teal-700 font-bold text-xs mb-4">
            <i data-lucide="accessibility" class="w-3 h-3"></i> Accessibility First
        </div>
        <h1 class="text-4xl font-black text-indigo-700 mb-2">Choose Your Account Type</h1>
        <p class="text-slate-600">Select how you'll use EduEcho</p>
    </div>

    <div class="space-y-4">
        <!-- Student Registration -->
        <a href="{{ route('register.student') }}" class="block p-6 rounded-2xl border-2 border-teal-200 hover:border-teal-500 hover:bg-teal-50 transition-all cursor-pointer group">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-xl bg-teal-100 group-hover:bg-teal-200 flex items-center justify-center flex-shrink-0 transition">
                    <i class="ti ti-school text-2xl text-teal-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-black text-indigo-700 mb-2 flex items-center gap-2">
                        <i data-lucide="book" class="w-5 h-5"></i> Student
                    </h3>
                    <p class="text-sm text-slate-600 mb-3">
                        Get immediate access to personalized learning, courses, assessments, and support.
                    </p>
                    <div class="text-xs text-teal-600 font-semibold">
                        ✓ Instant access • ✓ No approval needed • ✓ Choose accessibility settings
                    </div>
                </div>
                <div class="flex items-center justify-center w-6 h-6 rounded-full border-2 border-teal-400 group-hover:bg-teal-400 transition"></div>
            </div>
        </a>

        <!-- Educator Registration -->
        <a href="{{ route('register.educator') }}" class="block p-6 rounded-2xl border-2 border-violet-200 hover:border-violet-500 hover:bg-violet-50 transition-all cursor-pointer group">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-xl bg-violet-100 group-hover:bg-violet-200 flex items-center justify-center flex-shrink-0 transition">
                    <i class="ti ti-briefcase text-2xl text-violet-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-black text-indigo-700 mb-2 flex items-center gap-2">
                        <i data-lucide="presentation" class="w-5 h-5"></i> Educator / Tutor
                    </h3>
                    <p class="text-sm text-slate-600 mb-3">
                        Help students with special needs. Manage courses, IEPs, and provide personalized support.
                    </p>
                    <div class="text-xs text-violet-600 font-semibold">
                        ✓ Professional profile • ✓ Admin verification • ✓ Active earning potential
                    </div>
                </div>
                <div class="flex items-center justify-center w-6 h-6 rounded-full border-2 border-violet-400 group-hover:bg-violet-400 transition"></div>
            </div>
        </a>

        <!-- Therapist Registration -->
        <a href="{{ route('register.therapist') }}" class="block p-6 rounded-2xl border-2 border-rose-200 hover:border-rose-500 hover:bg-rose-50 transition-all cursor-pointer group">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-xl bg-rose-100 group-hover:bg-rose-200 flex items-center justify-center flex-shrink-0 transition">
                    <i class="ti ti-heart text-2xl text-rose-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-black text-indigo-700 mb-2 flex items-center gap-2">
                        <i data-lucide="heart" class="w-5 h-5 text-rose-500"></i> Therapist / Specialist
                    </h3>
                    <p class="text-sm text-slate-600 mb-3">
                        Provide therapy sessions and behavioral support for students in the platform.
                    </p>
                    <div class="text-xs text-rose-600 font-semibold">
                        ✓ Session management • ✓ Admin verification • ✓ Progress tracking
                    </div>
                </div>
                <div class="flex items-center justify-center w-6 h-6 rounded-full border-2 border-rose-400 group-hover:bg-rose-400 transition"></div>
            </div>
        </a>
    </div>

    <div class="mt-8 pt-6 border-t border-lavender-200">
        <p class="text-center text-sm text-slate-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-black text-teal-500 hover:text-teal-600 transition">
                Sign in
            </a>
        </p>
    </div>
</x-guest-layout>