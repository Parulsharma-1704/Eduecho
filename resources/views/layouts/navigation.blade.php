<nav x-data="{ open: false, dropdownOpen: false }" class="fixed w-full bg-white/95 dark:bg-slate-900/95 backdrop-blur border-b border-slate-200 dark:border-slate-700 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg group-hover:shadow-blue-500/50 transition-all">
                            <span class="text-white font-bold text-lg">🎓</span>
                        </div>
                        <span class="hidden md:block text-lg font-bold text-slate-900 dark:text-white">EduEcosystem</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 md:flex md:items-center md:ms-10">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition {{ request()->routeIs('dashboard') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                        Dashboard
                    </a>

                    @can('viewAny', App\Models\Student::class)
                        <a href="{{ route('students.index') }}" class="px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition {{ request()->routeIs('students.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                            Students
                        </a>
                    @endcan

                    @can('viewAny', App\Models\Course::class)
                        <a href="{{ route('courses.index') }}" class="px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition {{ request()->routeIs('courses.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                            Courses
                        </a>
                    @endcan

                    @can('viewAny', App\Models\IEP::class)
                        <a href="{{ route('ieps.index') }}" class="px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition {{ request()->routeIs('ieps.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                            IEPs
                        </a>
                    @endcan

                    @can('viewAny', App\Models\Assessment::class)
                        <a href="{{ route('assessments.index') }}" class="px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition {{ request()->routeIs('assessments.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                            Assessments
                        </a>
                    @endcan

                    @can('viewAny', App\Models\TherapySession::class)
                        <a href="{{ route('therapy-sessions.index') }}" class="px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition {{ request()->routeIs('therapy-sessions.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                            Therapy
                        </a>
                    @endcan

                    @can('viewAny', App\Models\ProgressReport::class)
                        <a href="{{ route('progress-reports.index') }}" class="px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition {{ request()->routeIs('progress-reports.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                            Reports
                        </a>
                    @endcan

                    @can('viewAny', App\Models\Invitation::class)
                        <a href="{{ route('invitations.index') }}" class="px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition {{ request()->routeIs('invitations.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : '' }}">
                            Invitations
                        </a>
                    @endcan
                </div>
            </div>

            <!-- Right Side Menu -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- User Dropdown -->
                <div class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 px-4 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-white text-sm font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-t-xl text-sm font-medium">
                            ⚙️ Profile Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-b-xl text-sm font-medium">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
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
