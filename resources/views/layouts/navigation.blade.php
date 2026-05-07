<nav x-data="{ open: false, dropdownOpen: false }" class="fixed w-full bg-white/80 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-11 h-11 rounded-2xl bg-mustard-400 flex items-center justify-center shadow-lg shadow-mustard-100 rotate-3 group-hover:rotate-0 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <span class="hidden md:block text-2xl font-black text-slate-800 dark:text-white tracking-tight">Edu<span class="text-mustard-500">Ecosystem</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 md:flex md:items-center md:ms-10">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('dashboard') ? 'bg-mustard-400 text-white shadow-lg shadow-mustard-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-mustard-500' }}">
                        Dashboard
                    </a>

                    @can('viewAny', App\Models\Student::class)
                        <a href="{{ route('students.index') }}" class="px-5 py-2.5 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('students.*') ? 'bg-mustard-400 text-white shadow-lg shadow-mustard-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-mustard-500' }}">
                            Students
                        </a>
                    @endcan

                    @can('viewAny', App\Models\Course::class)
                        <a href="{{ route('courses.index') }}" class="px-5 py-2.5 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('courses.*') ? 'bg-mustard-400 text-white shadow-lg shadow-mustard-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-mustard-500' }}">
                            Courses
                        </a>
                    @endcan

                    @can('viewAny', App\Models\IEP::class)
                        <a href="{{ route('ieps.index') }}" class="px-5 py-2.5 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('ieps.*') ? 'bg-mustard-400 text-white shadow-lg shadow-mustard-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-mustard-500' }}">
                            IEPs
                        </a>
                    @endcan

                    @can('viewAny', App\Models\TherapySession::class)
                        <a href="{{ route('therapy-sessions.index') }}" class="px-5 py-2.5 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('therapy-sessions.*') ? 'bg-mustard-400 text-white shadow-lg shadow-mustard-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-mustard-500' }}">
                            Therapy
                        </a>
                    @endcan

                    @can('viewAny', App\Models\ProgressReport::class)
                        <a href="{{ route('progress-reports.index') }}" class="px-5 py-2.5 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('progress-reports.*') ? 'bg-mustard-400 text-white shadow-lg shadow-mustard-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-mustard-500' }}">
                            Reports
                        </a>
                    @endcan

                    @can('viewAny', App\Models\Invitation::class)
                        <a href="{{ route('invitations.index') }}" class="px-5 py-2.5 rounded-2xl font-bold text-sm transition-all {{ request()->routeIs('invitations.*') ? 'bg-mustard-400 text-white shadow-lg shadow-mustard-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-mustard-500' }}">
                            Invites
                        </a>
                    @endcan
                </div>
            </div>

            <!-- Right Side Menu -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- User Dropdown -->
                <div class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-3 px-4 py-2 rounded-2xl bg-cheerful-purple text-white hover:bg-cheerful-purple/90 transition-all shadow-lg shadow-purple-100">
                        <div class="w-8 h-8 rounded-xl bg-mustard-400 flex items-center justify-center text-white text-sm font-black rotate-3">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="font-bold text-sm">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-transition class="absolute right-0 mt-3 w-56 bg-white dark:bg-slate-800 rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 dark:border-slate-700 overflow-hidden p-2 z-50">
                        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-700 dark:text-slate-300 hover:bg-mustard-50 dark:hover:bg-mustard-900/10 rounded-2xl text-sm font-bold transition-all">
                            <svg class="w-5 h-5 text-mustard-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Profile Settings</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-2xl text-sm font-bold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="inline-flex items-center justify-center p-3 rounded-2xl bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-mustard-400 hover:text-white transition-all">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden pb-4 border-t border-slate-200 dark:border-slate-700">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 mt-2">Dashboard</a>
            
            @can('viewAny', App\Models\Student::class)
                <a href="{{ route('students.index') }}" class="block px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Students</a>
            @endcan

            @can('viewAny', App\Models\Course::class)
                <a href="{{ route('courses.index') }}" class="block px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Courses</a>
            @endcan

            @can('viewAny', App\Models\IEP::class)
                <a href="{{ route('ieps.index') }}" class="block px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">IEPs</a>
            @endcan

            @can('viewAny', App\Models\Invitation::class)
                <a href="{{ route('invitations.index') }}" class="block px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Invitations</a>
            @endcan

            <div class="px-4 py-2 mt-4 border-t border-slate-200 dark:border-slate-700 pt-4">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 text-sm">
                    Profile Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
