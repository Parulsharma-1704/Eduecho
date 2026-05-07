<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-cheerful-purple/10 flex items-center justify-center text-cheerful-purple">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <span>Create Assessment</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none sm:rounded-[2.5rem] border border-slate-100 dark:border-slate-700">
                <div class="p-8 md:p-12">
                    <div class="text-center mb-10">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-mustard-100 text-mustard-600 mb-6 rotate-3">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-2">New Assessment</h3>
                        <p class="text-slate-500 font-medium">Create a tailored assessment to track student progress.</p>
                    </div>

                    <div class="bg-slate-50 dark:bg-slate-900/50 rounded-[2rem] p-8 border-2 border-dashed border-slate-200 dark:border-slate-700 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 bg-white dark:bg-slate-800 rounded-2xl shadow-sm flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-cheerful-purple animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Under Construction</h4>
                        <p class="text-slate-500 mb-8 max-w-sm">The assessment builder is being refined to include adaptive content support and multi-media inputs.</p>
                        
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-4 bg-mustard-400 hover:bg-mustard-500 text-white font-black rounded-2xl transition-all shadow-lg shadow-mustard-100">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
