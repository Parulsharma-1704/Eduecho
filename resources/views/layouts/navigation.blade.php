<nav x-data="{ open: false, dropdownOpen: false }" class="sticky top-0 z-50 w-full" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); border-bottom: 1.5px solid rgba(123, 94, 248, 0.12);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center space-x-3">
                    <a href="{{ Auth::check() ? route('dashboard') : url('/') }}" class="flex items-center space-x-3 group">
                        <!-- Yellow Icon Circle -->
                        <div class="w-11 h-11 rounded-lg flex items-center justify-center shadow-lg transition-transform group-hover:scale-110" style="background-color: #FCD34D;">
                            <svg class="w-6 h-6 text-indigo-700 font-bold" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H4.75A3.25 3.25 0 001.5 4.75v10.5a3.25 3.25 0 003.25 3.25h10.5a3.25 3.25 0 003.25-3.25V9.5"></path>
                                <path d="M14 1.5v4m0 0h4m-4 0L10 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                            </svg>
                        </div>
                        <span class="hidden md:block text-xl font-black tracking-tight" style="color: #312E81;">Edu<span style="color: #FCD34D;">Ecosystem</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 md:flex md:items-center md:ms-10">
                    @auth
                        @can('viewAny', App\Models\Student::class)
                        <a href="{{ route('students.index') }}" class="px-5 py-2.5 rounded-full font-bold text-sm transition-all {{ request()->routeIs('students.*') ? 'text-white' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('students.*') ? 'background-color: #14B8A6; box-shadow: 0 8px 28px rgba(20, 184, 166, 0.32);' : '' }}">
                            Students
                        </a>
                    @endcan

                    @can('viewAny', App\Models\Course::class)
                        <a href="{{ route('courses.index') }}" class="px-5 py-2.5 rounded-full font-bold text-sm transition-all {{ request()->routeIs('courses.*') ? 'text-white' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('courses.*') ? 'background-color: #312E81; box-shadow: 0 8px 28px rgba(49, 46, 129, 0.32);' : '' }}">
                            Courses
                        </a>
                    @endcan

                    @can('viewAny', App\Models\IEP::class)
                        <a href="{{ route('ieps.index') }}" class="px-5 py-2.5 rounded-full font-bold text-sm transition-all {{ request()->routeIs('ieps.*') ? 'text-white' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('ieps.*') ? 'background-color: #4F46E5; box-shadow: 0 8px 28px rgba(79, 70, 229, 0.32);' : '' }}">
                            IEPs
                        </a>
                    @endcan

                    @can('viewAny', App\Models\TherapySession::class)
                        <a href="{{ route('therapy-sessions.index') }}" class="px-5 py-2.5 rounded-full font-bold text-sm transition-all {{ request()->routeIs('therapy-sessions.*') ? 'text-white' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('therapy-sessions.*') ? 'background-color: #FCD34D; box-shadow: 0 8px 28px rgba(252, 211, 77, 0.32);' : '' }}">
                            Therapy
                        </a>
                    @endcan

                    @can('viewAny', App\Models\ProgressReport::class)
                        <a href="{{ route('progress-reports.index') }}" class="px-5 py-2.5 rounded-full font-bold text-sm transition-all {{ request()->routeIs('progress-reports.*') ? 'text-white' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('progress-reports.*') ? 'background-color: #D97706; box-shadow: 0 8px 28px rgba(217, 119, 6, 0.32);' : '' }}">
                            Reports
                        </a>
                    @endcan

                    @can('viewAny', App\Models\Invitation::class)
                        <a href="{{ route('invitations.index') }}" class="px-5 py-2.5 rounded-full font-bold text-sm transition-all {{ request()->routeIs('invitations.*') ? 'text-white' : 'text-gray-600 hover:text-gray-900' }}" style="{{ request()->routeIs('invitations.*') ? 'background-color: #FFB800; box-shadow: 0 8px 28px rgba(255, 184, 0, 0.32);' : '' }}">
                            Invites
                        </a>
                    @endcan
                    @endauth
                </div>
            </div>

            <!-- Right Side Menu -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 px-4 py-2 rounded-full text-white font-bold transition-all" style="background-color: #312E81; box-shadow: 0 8px 24px rgba(49, 46, 129, 0.24);">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-indigo-700 text-xs font-black" style="background-color: #FCD34D;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm hidden sm:inline">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden p-2 z-50" style="box-shadow: 0 12px 40px rgba(26, 31, 54, 0.12);">
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-bold transition-all hover:bg-gray-50" style="color: #6B7280;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #FCD34D;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Profile Settings</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-bold transition-all hover:bg-red-50" style="color: #FF4D8F;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Sign In / Register Buttons -->
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-full font-bold text-sm transition-all text-gray-600 hover:text-gray-900">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full font-bold text-sm transition-all text-white" style="background-color: #14B8A6; box-shadow: 0 8px 28px rgba(20, 184, 166, 0.32);">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg transition-all" style="background-color: #F0F4FF;">
                    <svg class="h-6 w-6" :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #312E81;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" :class="{'hidden': !open, 'inline-flex': open}" class="hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #312E81;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden pb-4 border-t" style="border-color: rgba(49, 46, 129, 0.12);">
            @can('viewAny', App\Models\Student::class)
                <a href="{{ route('students.index') }}" class="block px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-gray-100" style="color: #6B7280;">Students</a>
            @endcan

            @can('viewAny', App\Models\Course::class)
                <a href="{{ route('courses.index') }}" class="block px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-gray-100" style="color: #6B7280;">Courses</a>
            @endcan

            @can('viewAny', App\Models\IEP::class)
                <a href="{{ route('ieps.index') }}" class="block px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-gray-100" style="color: #6B7280;">IEPs</a>
            @endcan

            @can('viewAny', App\Models\TherapySession::class)
                <a href="{{ route('therapy-sessions.index') }}" class="block px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-gray-100" style="color: #6B7280;">Therapy</a>
            @endcan

            @can('viewAny', App\Models\ProgressReport::class)
                <a href="{{ route('progress-reports.index') }}" class="block px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-gray-100" style="color: #6B7280;">Reports</a>
            @endcan

            @can('viewAny', App\Models\Invitation::class)
                <a href="{{ route('invitations.index') }}" class="block px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-gray-100" style="color: #6B7280;">Invites</a>
            @endcan

            @auth
                <div class="px-4 py-2 mt-4 border-t pt-4" style="border-color: rgba(123, 94, 248, 0.12);">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-gray-100" style="color: #6B7280;">
                        Profile Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-red-50" style="color: #FF4D8F;">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="px-4 py-2 mt-4 border-t pt-4" style="border-color: rgba(123, 94, 248, 0.12);">
                    <a href="{{ route('login') }}" class="block px-4 py-2 rounded-lg text-sm font-bold transition-all hover:bg-gray-100" style="color: #6B7280;">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 mt-2 rounded-lg text-sm font-bold transition-all text-white" style="background-color: #14B8A6; box-shadow: 0 8px 28px rgba(20, 184, 166, 0.32);">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
