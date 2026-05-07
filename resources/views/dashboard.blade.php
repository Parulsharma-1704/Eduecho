<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Welcome Section -->
    <div class="mb-12">
        @if(Auth::user()->hasRole('admin'))
            <div class="bg-slate-900 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group min-h-[300px] flex items-center">
                <!-- Background Image with Overlay -->
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                         alt="Admin Background" 
                         class="w-full h-full object-cover opacity-40 scale-105 group-hover:scale-100 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-mustard-400/20 to-transparent"></div>
                </div>

                <div class="relative z-10 p-10 w-full">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="text-center md:text-left mb-6 md:mb-0">
                            <div class="inline-flex items-center space-x-2 bg-mustard-400 px-4 py-2 rounded-2xl mb-6 shadow-lg rotate-[-2deg]">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm font-black uppercase tracking-widest text-white">Administrator Portal</span>
                            </div>
                            <h2 class="text-6xl font-black mb-4 tracking-tighter">Welcome, {{ Auth::user()->name }}</h2>
                            <p class="text-slate-300 text-xl font-medium max-w-xl leading-relaxed">
                                Access high-level analytics and management tools for the 
                                <span class="text-mustard-400 font-black">EduEcosystem</span>.
                            </p>
                        </div>
                        
                        <div class="hidden lg:block">
                            <div class="bg-white/10 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/20 shadow-2xl scale-90 hover:scale-100 transition-transform duration-500">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 rounded-2xl bg-mustard-400 flex items-center justify-center shadow-lg">
                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/60 text-xs font-black uppercase tracking-[0.2em]">System Status</p>
                                        <p class="text-2xl font-black">Fully Operational</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->hasRole('special_educator') || Auth::user()->hasRole('therapist'))
            <div class="rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden group min-h-[160px] flex items-center">
                <!-- Background Image with Overlay -->
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1544717297-fa154daaf762?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                         alt="Educator Background" 
                         class="w-full h-full object-cover opacity-80 scale-105 group-hover:scale-100 transition-transform duration-1000">
                </div>

                <div class="relative z-10 p-8 w-full">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="text-center md:text-left">
                            <div class="inline-flex items-center space-x-2 bg-cheerful-purple px-3 py-1 rounded-xl mb-3 shadow-lg rotate-[1deg]">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <span class="text-xs font-black uppercase tracking-widest text-white">
                                    {{ Auth::user()->hasRole('special_educator') ? 'Educator Dashboard' : 'Therapist Dashboard' }}
                                </span>
                            </div>
                            <h2 class="text-4xl font-black tracking-tighter text-white">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h2>
                        </div>
                        
                        <div class="hidden lg:block text-right">
                           <div class="bg-white/5 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10">
                                <p class="text-indigo-300 text-xs font-bold italic">Focus on progress</p>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->hasRole('support_staff'))
            <div class="rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden group min-h-[160px] flex items-center">
                <!-- Background Image with Overlay -->
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                         alt="Support Staff Background" 
                         class="w-full h-full object-cover opacity-80 scale-105 group-hover:scale-100 transition-transform duration-1000">
                </div>

                <div class="relative z-10 p-8 w-full">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="text-center md:text-left">
                            <div class="inline-flex items-center space-x-2 bg-teal-500 px-3 py-1 rounded-xl mb-3 shadow-lg rotate-[1deg]">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="text-xs font-black uppercase tracking-widest text-white">Support Staff Dashboard</span>
                            </div>
                            <h2 class="text-4xl font-black tracking-tighter text-white">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h2>
                        </div>
                        
                        <div class="hidden lg:block text-right">
                           <div class="bg-white/5 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10">
                                <p class="text-emerald-300 text-xs font-bold italic">Supporting excellence</p>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->hasRole('care_giver'))
            <div class="bg-amber-950 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden group min-h-[160px] flex items-center">
                <!-- Background Image with Overlay -->
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                         alt="Care Giver Background" 
                         class="w-full h-full object-cover opacity-30 scale-105 group-hover:scale-100 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-950 via-amber-950/80 to-transparent"></div>
                </div>

                <div class="relative z-10 p-8 w-full">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="text-center md:text-left">
                            <div class="inline-flex items-center space-x-2 bg-orange-500 px-3 py-1 rounded-xl mb-3 shadow-lg rotate-[1deg]">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="text-xs font-black uppercase tracking-widest text-white">Care Giver Dashboard</span>
                            </div>
                            <h2 class="text-4xl font-black tracking-tighter text-white">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h2>
                        </div>
                        
                        <div class="hidden lg:block text-right">
                           <div class="bg-white/5 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10">
                                <p class="text-amber-300 text-xs font-bold italic">Care with compassion</p>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->hasRole('student'))
            <div class="bg-mustard-50 dark:bg-slate-900/50 rounded-[3rem] p-10 relative overflow-hidden group border-2 border-mustard-100 dark:border-slate-800">
                <div class="relative z-10 flex flex-col md:flex-row md:items-end justify-between">
                    <div>
                        <p class="text-mustard-500 font-black uppercase tracking-[0.2em] text-sm mb-4">My Student Dashboard</p>
                        <h2 class="text-6xl font-black text-slate-800 dark:text-white tracking-tighter">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h2>
                        <p class="mt-4 text-slate-500 font-medium text-lg">Ready to continue your <span class="text-slate-900 dark:text-white font-bold underline decoration-mustard-400 decoration-4">learning journey</span> today?</p>
                    </div>
                    <div class="hidden lg:block">
                        <div class="w-32 h-32 bg-mustard-400 rounded-full flex items-center justify-center animate-bounce shadow-2xl">
                             <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                             </svg>
                        </div>
                    </div>
                </div>
                <!-- Decorative Circle -->
                <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-mustard-400/10 rounded-full blur-3xl group-hover:bg-mustard-400/20 transition-colors duration-500"></div>
            </div>
        @endif
    </div>

    <!-- Statistics Grid -->
    @if($stats && count($stats) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            @foreach($stats as $key => $value)
                <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.05)] hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-50 dark:border-slate-700 group">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-2xl bg-slate-50 dark:bg-slate-700 flex items-center justify-center mb-6 group-hover:bg-mustard-400 group-hover:text-white transition-all duration-300 rotate-3 group-hover:rotate-0 shadow-lg shadow-slate-100">
                            @switch($key)
                                @case('total_students')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                @break
                                @case('total_courses')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                @break
                                @case('total_ieps')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                @break
                                @case('total_assessments')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @break
                                @case('therapy_sessions')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                @break
                                @default
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                            @endswitch
                        </div>
                        <div>
                            <p class="text-slate-400 dark:text-slate-500 text-xs font-black uppercase tracking-widest mb-2">{{ str_replace('_', ' ', $key) }}</p>
                            <div class="text-5xl font-black text-slate-800 dark:text-white tracking-tighter">{{ $value }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-12 text-center shadow-lg border border-slate-50 dark:border-slate-700 mb-16">
            <p class="text-slate-400 font-bold">No active statistics to display yet</p>
        </div>
    @endif

    @if(Auth::user()->hasRole('student'))
        <!-- Student Therapy & Booking Section -->
        <div class="mt-12 bg-white dark:bg-slate-800 rounded-[2.5rem] p-10 shadow-xl border border-slate-50 dark:border-slate-700">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 space-y-4 md:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 flex items-center justify-center text-rose-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">Therapy & Wellness</h3>
                        <p class="text-sm text-slate-500">Manage your sessions and appointments</p>
                    </div>
                </div>
                <a href="{{ route('therapy-sessions.create') }}" class="inline-flex items-center justify-center px-8 py-4 bg-rose-500 text-white font-black rounded-[1.5rem] shadow-lg shadow-rose-200 hover:scale-105 transition-all text-sm uppercase tracking-wider">
                    Book New Session
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($upcomingSessions as $session)
                    <div class="p-6 rounded-[2rem] bg-slate-50 dark:bg-slate-900/50 border-2 border-transparent hover:border-rose-100 transition-all">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center shadow-sm">
                                <span class="text-rose-500 font-bold">{{ \Carbon\Carbon::parse($session->session_date)->format('d') }}</span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase">{{ \Carbon\Carbon::parse($session->session_date)->format('M Y') }}</p>
                                <p class="text-sm font-black text-slate-700 dark:text-white">{{ \Carbon\Carbon::parse($session->session_date)->format('h:i A') }}</p>
                            </div>
                        </div>
                        <h4 class="font-bold text-slate-800 dark:text-white mb-2 line-clamp-1">{{ $session->notes ?? 'Therapy Session' }}</h4>
                        <div class="flex items-center space-x-2 text-xs text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>{{ $session->therapist->name ?? 'Assigned Therapist' }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10">
                        <div class="w-16 h-16 bg-slate-50 dark:bg-slate-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                        </div>
                        <p class="text-slate-400 font-medium">No upcoming therapy sessions scheduled.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Student Active Tasks -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-12 pb-12">
            <!-- Take Class Section -->
            <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-10 shadow-xl border border-slate-50 dark:border-slate-700">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-mustard-100 flex items-center justify-center text-mustard-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">Active Classes</h3>
                    </div>
                </div>

                <div class="space-y-4">
                    @forelse($enrolledCourses as $course)
                        <div class="group flex items-center justify-between p-5 rounded-[2rem] bg-slate-50 dark:bg-slate-900/50 hover:bg-mustard-50 transition-colors border-2 border-transparent hover:border-mustard-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-2 h-12 bg-mustard-400 rounded-full"></div>
                                <div>
                                    <h4 class="font-bold text-slate-900 dark:text-white">{{ $course->name }}</h4>
                                    <p class="text-sm text-slate-500 italic">By {{ $course->creator->name }}</p>
                                </div>
                            </div>
                            <a href="{{ route('courses.show', $course) }}" class="px-6 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white font-black rounded-2xl shadow-sm hover:bg-mustard-400 hover:text-white transition-all">
                                Enter Class
                            </a>
                        </div>
                    @empty
                        <p class="text-slate-400 font-medium text-center py-6">You are not enrolled in any classes yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Take Assessment Section -->
            <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-10 shadow-xl border border-slate-50 dark:border-slate-700">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-cheerful-purple/10 flex items-center justify-center text-cheerful-purple">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">Pending Tests</h3>
                    </div>
                </div>

                <div class="space-y-4">
                    @forelse($pendingAssessments as $assessment)
                        <div class="group flex items-center justify-between p-5 rounded-[2rem] bg-slate-50 dark:bg-slate-900/50 hover:bg-purple-50 transition-colors border-2 border-transparent hover:border-purple-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-2 h-12 bg-cheerful-purple rounded-full"></div>
                                <div>
                                    <h4 class="font-bold text-slate-900 dark:text-white">{{ $assessment->title }}</h4>
                                    <p class="text-sm text-slate-500">{{ $assessment->course->name }}</p>
                                </div>
                            </div>
                            <a href="{{ route('assessments.take', [$assessment, Auth::user()->student]) }}" class="px-6 py-3 bg-cheerful-purple text-white font-black rounded-2xl shadow-lg shadow-purple-100 hover:scale-105 transition-all">
                                Start Test
                            </a>
                        </div>
                    @empty
                        <p class="text-slate-400 font-medium text-center py-6">No pending assessments at this time.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Student Disability Profile & Support Section -->
        @isset($disabilityProfile)
            <div class="mt-12 bg-gradient-to-br from-purple-50 dark:from-purple-900/20 to-pink-50 dark:to-pink-900/20 rounded-[2.5rem] p-10 shadow-xl border border-purple-100 dark:border-purple-700">
                <div class="flex items-center space-x-4 mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500 flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5a4 4 0 100-8 4 4 0 000 8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">Your Disability Support Profile</h3>
                        <p class="text-sm text-slate-500">Personalized accommodations and resources</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Disability Type & Severity -->
                    <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg border border-slate-50 dark:border-slate-700">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-black text-slate-800 dark:text-white">Disability Type</h4>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-slate-500 font-bold uppercase mb-2">Type</p>
                                <span class="inline-block px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 font-bold rounded-full text-sm capitalize">
                                    {{ str_replace('_', ' ', $disabilityProfile->disability_type) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-bold uppercase mb-2">Severity Level</p>
                                <span class="inline-block px-4 py-2 
                                    @if($disabilityProfile->severity === 'mild') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300
                                    @elseif($disabilityProfile->severity === 'moderate') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300
                                    @else bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300
                                    @endif
                                    font-bold rounded-full text-sm capitalize">
                                    {{ $disabilityProfile->severity }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Support Devices & Accommodations -->
                    <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg border border-slate-50 dark:border-slate-700">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-black text-slate-800 dark:text-white">Support Devices</h4>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-bold uppercase mb-3">Assigned Devices</p>
                            @if($disabilityProfile->support_devices)
                                <div class="space-y-2">
                                    @foreach(json_decode($disabilityProfile->support_devices, true) ?? [] as $device)
                                        <div class="flex items-center space-x-2 p-3 bg-slate-50 dark:bg-slate-900/50 rounded-lg">
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $device }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-slate-400 text-sm">No specific devices registered</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description & Medical Info -->
                @if($disabilityProfile->description)
                    <div class="mt-6 bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg border border-slate-50 dark:border-slate-700">
                        <h4 class="text-lg font-black text-slate-800 dark:text-white mb-4">Profile Details</h4>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">{{ $disabilityProfile->description }}</p>
                    </div>
                @endif

                <!-- Recommended Resources -->
                @if($disabilityResources->count() > 0)
                    <div class="mt-6 bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg border border-slate-50 dark:border-slate-700">
                        <h4 class="text-lg font-black text-slate-800 dark:text-white mb-6">Recommended Resources</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($disabilityResources as $resource)
                                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 hover:border-purple-300 transition-colors">
                                    <h5 class="font-bold text-slate-800 dark:text-white mb-2">{{ $resource->name }}</h5>
                                    <p class="text-xs text-slate-500 mb-4 line-clamp-2">{{ $resource->description }}</p>
                                    <a href="{{ route('courses.show', $resource) }}" class="text-purple-600 dark:text-purple-400 font-bold text-sm hover:underline">
                                        Access Resource →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endisset

    @if(Auth::user()->hasRole('support_staff'))
        <!-- Support Staff Tools Section -->
        <div class="mt-12 bg-gradient-to-br from-emerald-50 dark:from-emerald-900/20 to-teal-50 dark:to-teal-900/20 rounded-[2.5rem] p-10 shadow-xl border border-emerald-100 dark:border-emerald-700">
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-12 h-12 rounded-2xl bg-teal-500 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white">Support Staff Tools</h3>
                    <p class="text-sm text-slate-500">Manage records and assist educators</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- View Students Card -->
                <a href="{{ route('students.index') }}" class="group bg-white dark:bg-slate-800 rounded-[1.5rem] p-6 shadow-lg hover:shadow-xl transition-all border border-slate-50 dark:border-slate-700 hover:border-teal-200 dark:hover:border-teal-600">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 rounded-xl bg-teal-100 dark:bg-teal-900/20 flex items-center justify-center text-teal-600 mb-3 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 dark:text-white mb-1">View Students</h4>
                        <p class="text-xs text-slate-500">Manage all student records</p>
                    </div>
                </a>

                <!-- Create IEP Card -->
                <a href="{{ route('ieps.create') }}" class="group bg-white dark:bg-slate-800 rounded-[1.5rem] p-6 shadow-lg hover:shadow-xl transition-all border border-slate-50 dark:border-slate-700 hover:border-emerald-200 dark:hover:border-emerald-600">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600 mb-3 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 dark:text-white mb-1">Create IEP</h4>
                        <p class="text-xs text-slate-500">New educational plan</p>
                    </div>
                </a>

                <!-- Manage Accommodations Card -->
                <a href="#" class="group bg-white dark:bg-slate-800 rounded-[1.5rem] p-6 shadow-lg hover:shadow-xl transition-all border border-slate-50 dark:border-slate-700 hover:border-blue-200 dark:hover:border-blue-600">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 mb-3 group-hover:scale-110 group-hover:bg-blue-500 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 dark:text-white mb-1">Accommodations</h4>
                        <p class="text-xs text-slate-500">Manage support needs</p>
                    </div>
                </a>

                <!-- Compliance Logs Card -->
                <a href="#" class="group bg-white dark:bg-slate-800 rounded-[1.5rem] p-6 shadow-lg hover:shadow-xl transition-all border border-slate-50 dark:border-slate-700 hover:border-orange-200 dark:hover:border-orange-600">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-900/20 flex items-center justify-center text-orange-600 mb-3 group-hover:scale-110 group-hover:bg-orange-500 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 dark:text-white mb-1">Compliance</h4>
                        <p class="text-xs text-slate-500">Log compliance events</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="mt-12 bg-white dark:bg-slate-800 rounded-[2.5rem] p-10 shadow-xl border border-slate-50 dark:border-slate-700">
            <h3 class="text-2xl font-black text-slate-800 dark:text-white mb-8">Recent Records Activity</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-5 rounded-[1.5rem] bg-slate-50 dark:bg-slate-900/50 border-l-4 border-emerald-500">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 dark:text-white">New Student Records Created</p>
                            <p class="text-xs text-slate-500">Last updated today</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-full text-xs font-bold">Active</span>
                </div>

                <div class="flex items-center justify-between p-5 rounded-[1.5rem] bg-slate-50 dark:bg-slate-900/50 border-l-4 border-teal-500">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-lg bg-teal-100 dark:bg-teal-900/20 flex items-center justify-center text-teal-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 dark:text-white">Accommodations Updated</p>
                            <p class="text-xs text-slate-500">Support modifications completed</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 rounded-full text-xs font-bold">Updated</span>
                </div>

                <div class="flex items-center justify-between p-5 rounded-[1.5rem] bg-slate-50 dark:bg-slate-900/50 border-l-4 border-blue-500">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 dark:text-white">Compliance Logged</p>
                            <p class="text-xs text-slate-500">Documentation requirements met</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full text-xs font-bold">Complete</span>
                </div>
            </div>
        </div>
    @endif

    <!-- Educator Specialized Disabilities Section -->
    @isset($studentsWithSpecializedDisabilities)
        @if(Auth::user()->hasRole('special_educator') && $studentsWithSpecializedDisabilities->count() > 0)
        <div class="mt-12 bg-gradient-to-br from-indigo-50 dark:from-indigo-900/20 to-blue-50 dark:to-blue-900/20 rounded-[2.5rem] p-10 shadow-xl border border-indigo-100 dark:border-indigo-700">
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-12 h-12 rounded-2xl bg-indigo-500 flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white">Students with Your Specializations</h3>
                    <p class="text-sm text-slate-500">Students matching your disability expertise</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($studentsWithSpecializedDisabilities as $student)
                    <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-6 shadow-lg border border-slate-50 dark:border-slate-700 hover:shadow-xl transition-shadow">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-800 dark:text-white">{{ $student->user->name }}</h4>
                                <p class="text-xs text-slate-500">Student ID: #{{ $student->id }}</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="p-3 rounded-lg bg-slate-50 dark:bg-slate-900/50">
                                <p class="text-xs text-slate-500 font-bold uppercase mb-1">Disability Type</p>
                                <span class="inline-block px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 font-bold rounded-full text-xs capitalize">
                                    {{ str_replace('_', ' ', $student->disabilityProfile->disability_type) }}
                                </span>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div class="flex-1">
                                    <p class="text-xs text-slate-500 font-bold uppercase">Severity</p>
                                    <span class="inline-block px-2 py-1 
                                        @if($student->disabilityProfile->severity === 'mild') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300
                                        @elseif($student->disabilityProfile->severity === 'moderate') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300
                                        @else bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300
                                        @endif
                                        font-bold rounded text-xs capitalize">
                                        {{ $student->disabilityProfile->severity }}
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('students.show', $student) }}" class="block w-full text-center px-4 py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-bold rounded-xl transition-colors">
                                View Student Profile
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    @endisset
    @if(Auth::user()->hasRole('care_giver'))
        <div class="mt-12 bg-white dark:bg-slate-800 rounded-[2.5rem] p-10 shadow-xl border border-slate-50 dark:border-slate-700">
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white">Care Giver Tools</h3>
                    <p class="text-sm text-slate-500">Monitor and support student progress</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('progress-reports.index') }}" class="group bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 rounded-[2rem] p-6 shadow-lg hover:shadow-xl transition-all border border-orange-100 dark:border-orange-700">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-500 flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 dark:text-white">Progress Updates</h4>
                            <p class="text-xs text-slate-500">View latest achievements</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('therapy-sessions.index') }}" class="group bg-gradient-to-br from-amber-50 to-yellow-50 dark:from-amber-900/20 dark:to-yellow-900/20 rounded-[2rem] p-6 shadow-lg hover:shadow-xl transition-all border border-amber-100 dark:border-amber-700">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-500 flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 dark:text-white">Appointments</h4>
                            <p class="text-xs text-slate-500">Schedule & manage sessions</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('progress-reports.index') }}" class="group bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-[2rem] p-6 shadow-lg hover:shadow-xl transition-all border border-yellow-100 dark:border-yellow-700">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-yellow-500 flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 dark:text-white">Reports</h4>
                            <p class="text-xs text-slate-500">View performance reports</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endif

    <!-- Quick Actions -->
    @if(!Auth::user()->hasRole('student') && !Auth::user()->hasRole('support_staff') && !Auth::user()->hasRole('care_giver'))
    <div>
        <div class="flex items-center space-x-4 mb-10">
            <div class="h-10 w-3 bg-mustard-400 rounded-full"></div>
            <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">Quick Actions</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @can('create', App\Models\Student::class)
                <a href="{{ route('students.create') }}" class="group relative bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg hover:shadow-2xl transition-all border border-slate-50 dark:border-slate-700 overflow-hidden">
                    <div class="absolute inset-0 bg-mustard-400 opacity-0 group-hover:opacity-[0.03] transition-opacity"></div>
                    <div class="relative flex items-center space-x-5">
                        <div class="w-16 h-16 rounded-2xl bg-mustard-50 dark:bg-mustard-900/10 flex items-center justify-center text-mustard-500 group-hover:bg-mustard-400 group-hover:text-white group-hover:scale-110 group-hover:-rotate-6 transition-all shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 dark:text-white group-hover:text-mustard-500 transition-colors text-lg">Add Student</h4>
                            <p class="text-sm text-slate-500 font-medium">Create new student profile</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('create', App\Models\Course::class)
                <a href="{{ route('courses.create') }}" class="group relative bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg hover:shadow-2xl transition-all border border-slate-50 dark:border-slate-700 overflow-hidden">
                    <div class="absolute inset-0 bg-accent-500 opacity-0 group-hover:opacity-[0.03] transition-opacity"></div>
                    <div class="relative flex items-center space-x-5">
                        <div class="w-16 h-16 rounded-2xl bg-accent-100/50 dark:bg-accent-900/10 flex items-center justify-center text-accent-500 group-hover:bg-accent-500 group-hover:text-white group-hover:scale-110 group-hover:-rotate-6 transition-all shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 dark:text-white group-hover:text-accent-500 transition-colors text-lg">Create Course</h4>
                            <p class="text-sm text-slate-500 font-medium">Add new course curriculum</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('create', App\Models\IEP::class)
                <a href="{{ route('ieps.create') }}" class="group relative bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg hover:shadow-2xl transition-all border border-slate-50 dark:border-slate-700 overflow-hidden">
                    <div class="absolute inset-0 bg-cheerful-pink opacity-0 group-hover:opacity-[0.03] transition-opacity"></div>
                    <div class="relative flex items-center space-x-5">
                        <div class="w-16 h-16 rounded-2xl bg-cheerful-pink/10 flex items-center justify-center text-cheerful-pink group-hover:bg-cheerful-pink group-hover:text-white group-hover:scale-110 group-hover:-rotate-6 transition-all shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 dark:text-white group-hover:text-cheerful-pink transition-colors text-lg">Create IEP</h4>
                            <p class="text-sm text-slate-500 font-medium">Draft new IEP document</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('create', App\Models\Assessment::class)
                <a href="{{ route('assessments.create') }}" class="group relative bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg hover:shadow-2xl transition-all border border-slate-50 dark:border-slate-700 overflow-hidden">
                    <div class="absolute inset-0 bg-cheerful-purple opacity-0 group-hover:opacity-[0.03] transition-opacity"></div>
                    <div class="relative flex items-center space-x-5">
                        <div class="w-16 h-16 rounded-2xl bg-cheerful-purple/10 flex items-center justify-center text-cheerful-purple group-hover:bg-cheerful-purple group-hover:text-white group-hover:scale-110 group-hover:-rotate-6 transition-all shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 dark:text-white group-hover:text-cheerful-purple transition-colors text-lg">Create Assessment</h4>
                            <p class="text-sm text-slate-500 font-medium">Conduct evaluation test</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('create', App\Models\TherapySession::class)
                <a href="{{ route('therapy-sessions.create') }}" class="group relative bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg hover:shadow-2xl transition-all border border-slate-50 dark:border-slate-700 overflow-hidden">
                    <div class="absolute inset-0 bg-rose-500 opacity-0 group-hover:opacity-[0.03] transition-opacity"></div>
                    <div class="relative flex items-center space-x-5">
                        <div class="w-16 h-16 rounded-2xl bg-rose-100/50 dark:bg-rose-900/10 flex items-center justify-center text-rose-500 group-hover:bg-rose-500 group-hover:text-white group-hover:scale-110 group-hover:-rotate-6 transition-all shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 dark:text-white group-hover:text-rose-500 transition-colors text-lg">Schedule Therapy</h4>
                            <p class="text-sm text-slate-500 font-medium">Book therapy session</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('viewAny', App\Models\ProgressReport::class)
                <a href="{{ route('progress-reports.index') }}" class="group relative bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-lg hover:shadow-2xl transition-all border border-slate-50 dark:border-slate-700 overflow-hidden">
                    <div class="absolute inset-0 bg-violet-600 opacity-0 group-hover:opacity-[0.03] transition-opacity"></div>
                    <div class="relative flex items-center space-x-5">
                        <div class="w-16 h-16 rounded-2xl bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center text-violet-600 group-hover:bg-violet-600 group-hover:text-white group-hover:scale-110 group-hover:-rotate-6 transition-all shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 dark:text-white group-hover:text-violet-600 transition-colors text-lg">View Reports</h4>
                            <p class="text-sm text-slate-500 font-medium">Check progress reports</p>
                        </div>
                    </div>
                </a>
            @endcan
        </div>
    </div>
    @endif
</x-app-layout>
