<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Welcome Section -->
    <div class="mb-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-blue-100 text-lg">You are logged in as: <span class="font-semibold text-white">{{ Auth::user()->roles->pluck('name')->map(fn($r) => ucfirst(str_replace('_', ' ', $r)))->join(', ') }}</span></p>
            </div>
            <div class="hidden md:block text-6xl opacity-20">🎓</div>
        </div>
    </div>

    <!-- Statistics Grid -->
    @if($stats && count($stats) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            @foreach($stats as $key => $value)
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow border border-slate-100 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 dark:text-slate-400 text-sm font-medium capitalize mb-1">{{ str_replace('_', ' ', $key) }}</p>
                            <div class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">{{ $value }}</div>
                        </div>
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 flex items-center justify-center text-3xl">
                            @switch($key)
                                @case('total_students')
                                    👥
                                @break
                                @case('total_courses')
                                    📚
                                @break
                                @case('total_ieps')
                                    📋
                                @break
                                @case('total_assessments')
                                    ✅
                                @break
                                @case('therapy_sessions')
                                    🏥
                                @break
                                @default
                                    📊
                            @endswitch
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-slate-100 dark:border-slate-700 mb-10">
            <p class="text-slate-600 dark:text-slate-400">No data available to display</p>
        </div>
    @endif

    <!-- Quick Actions -->
    <div>
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @can('create', App\Models\Student::class)
                <a href="{{ route('students.create') }}" class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-slate-100 dark:border-slate-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">👥</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Add Student</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Create new student profile</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('create', App\Models\Course::class)
                <a href="{{ route('courses.create') }}" class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-slate-100 dark:border-slate-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">📚</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">Create Course</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Add new course curriculum</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('create', App\Models\IEP::class)
                <a href="{{ route('ieps.create') }}" class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-slate-100 dark:border-slate-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-blue-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-900/30 dark:to-blue-900/30 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">📋</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition">Create IEP</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Draft new IEP document</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('create', App\Models\Assessment::class)
                <a href="{{ route('assessments.create') }}" class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-slate-100 dark:border-slate-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-600 to-orange-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">✅</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition">Create Assessment</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Conduct evaluation test</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('create', App\Models\TherapySession::class)
                <a href="{{ route('therapy-sessions.create') }}" class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-slate-100 dark:border-slate-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-rose-600 to-pink-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-rose-100 to-pink-100 dark:from-rose-900/30 dark:to-pink-900/30 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">🏥</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white group-hover:text-rose-600 dark:group-hover:text-rose-400 transition">Schedule Therapy</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Book therapy session</p>
                        </div>
                    </div>
                </a>
            @endcan

            @can('viewAny', App\Models\ProgressReport::class)
                <a href="{{ route('progress-reports.index') }}" class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-slate-100 dark:border-slate-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-violet-600 to-purple-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-violet-100 to-purple-100 dark:from-violet-900/30 dark:to-purple-900/30 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">📊</div>
                        <div>
                            <h4 class="font-semibold text-slate-900 dark:text-white group-hover:text-violet-600 dark:group-hover:text-violet-400 transition">View Reports</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Check progress reports</p>
                        </div>
                    </div>
                </a>
            @endcan
        </div>
    </div>
</x-app-layout>
