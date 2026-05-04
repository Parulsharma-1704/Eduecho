<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EduEcosystem - Education for Specially-Abled Students</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            slate: {
                                950: '#020617',
                            }
                        }
                    }
                }
            }
        </script>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            html { scroll-behavior: smooth; }
            body { font-family: 'Figtree', sans-serif; line-height: 1.6; }
        </style>
    </head>
    <body class="antialiased bg-slate-50 dark:bg-slate-900 border-t-4 border-blue-600">
        <!-- Decoration blobs -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-400/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Navigation -->
        <nav class="fixed w-full bg-white/95 dark:bg-slate-900/95 backdrop-blur border-b border-slate-200 dark:border-slate-700 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">🎓</span>
                        </div>
                        <h1 class="text-xl font-bold text-slate-900 dark:text-white">EduEcosystem</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:shadow-lg transition">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-slate-800 dark:to-slate-900">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-5xl md:text-6xl font-bold text-slate-900 dark:text-white mb-6">
                    Inclusive Education for All
                </h2>
                <p class="text-xl text-slate-600 dark:text-slate-300 mb-8">
                    A comprehensive ecosystem designed specifically for specially-abled students, combining accessibility, personalized learning, and holistic support.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-4 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold hover:shadow-xl transition transform hover:-translate-y-1">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-4 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold hover:shadow-xl transition transform hover:-translate-y-1">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 rounded-lg border-2 border-slate-300 dark:border-slate-600 text-slate-900 dark:text-white font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <h3 class="text-4xl font-bold text-center text-slate-900 dark:text-white mb-16">
                    Platform Features
                </h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-8 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 dark:from-slate-800 dark:to-slate-700 hover:shadow-lg transition">
                        <div class="text-4xl mb-4">📋</div>
                        <h4 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">IEP Management</h4>
                        <p class="text-slate-600 dark:text-slate-300">Create and manage personalized Individualized Education Plans with customizable goals and accommodations.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 rounded-xl bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-slate-800 dark:to-slate-700 hover:shadow-lg transition">
                        <div class="text-4xl mb-4">♿</div>
                        <h4 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">Accessibility Profiles</h4>
                        <p class="text-slate-600 dark:text-slate-300">Define accessibility needs and accommodations to ensure inclusive learning experiences for every student.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 rounded-xl bg-gradient-to-br from-purple-50 to-purple-100 dark:from-slate-800 dark:to-slate-700 hover:shadow-lg transition">
                        <div class="text-4xl mb-4">🏥</div>
                        <h4 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">Therapy Tracking</h4>
                        <p class="text-slate-600 dark:text-slate-300">Monitor and track therapy sessions, progress, and outcomes for comprehensive student development.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="p-8 rounded-xl bg-gradient-to-br from-pink-50 to-pink-100 dark:from-slate-800 dark:to-slate-700 hover:shadow-lg transition">
                        <div class="text-4xl mb-4">📊</div>
                        <h4 class="text-xl font-semibold text-slate-900 dark:text-white mb-3">Compliance & Reporting</h4>
                        <p class="text-slate-600 dark:text-slate-300">Automated compliance tracking and detailed activity logging for governance and accountability.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Types Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 dark:bg-slate-800">
            <div class="max-w-6xl mx-auto">
                <h3 class="text-4xl font-bold text-center text-slate-900 dark:text-white mb-16">
                    For Everyone
                </h3>
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Students -->
                    <div class="p-8 rounded-xl border-2 border-slate-200 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-400 transition">
                        <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">👨‍🎓 Students</h4>
                        <ul class="space-y-3 text-slate-600 dark:text-slate-300">
                            <li>✓ Personalized learning paths</li>
                            <li>✓ Track your progress and achievements</li>
                            <li>✓ Access resources and support</li>
                            <li>✓ View your IEP and accommodations</li>
                        </ul>
                    </div>

                    <!-- Educators -->
                    <div class="p-8 rounded-xl border-2 border-slate-200 dark:border-slate-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition">
                        <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">👩‍🏫 Educators</h4>
                        <ul class="space-y-3 text-slate-600 dark:text-slate-300">
                            <li>✓ Manage student IEPs and progress</li>
                            <li>✓ Create and update assessments</li>
                            <li>✓ Monitor student engagement</li>
                            <li>✓ Collaborate with support teams</li>
                        </ul>
                    </div>

                    <!-- Therapists -->
                    <div class="p-8 rounded-xl border-2 border-slate-200 dark:border-slate-700 hover:border-purple-500 dark:hover:border-purple-400 transition">
                        <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">🏥 Therapists</h4>
                        <ul class="space-y-3 text-slate-600 dark:text-slate-300">
                            <li>✓ Schedule and manage sessions</li>
                            <li>✓ Track therapy progress</li>
                            <li>✓ Document observations and notes</li>
                            <li>✓ Communicate with educators</li>
                        </ul>
                    </div>

                    <!-- Administrators -->
                    <div class="p-8 rounded-xl border-2 border-slate-200 dark:border-slate-700 hover:border-pink-500 dark:hover:border-pink-400 transition">
                        <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">⚙️ Administrators</h4>
                        <ul class="space-y-3 text-slate-600 dark:text-slate-300">
                            <li>✓ Manage users and permissions</li>
                            <li>✓ Monitor system compliance</li>
                            <li>✓ Generate reports and analytics</li>
                            <li>✓ System configuration and settings</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-12 text-center text-white">
                <h3 class="text-4xl font-bold mb-6">Ready to Get Started?</h3>
                <p class="text-xl mb-8 opacity-90">Join thousands of educators, students, and support professionals creating a more inclusive education experience.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-4 rounded-lg bg-white text-blue-600 font-semibold hover:bg-slate-100 transition">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-4 rounded-lg bg-white text-blue-600 font-semibold hover:bg-slate-100 transition">
                            Create an Account
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 rounded-lg border-2 border-white text-white font-semibold hover:bg-white/10 transition">
                            Already have an account?
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 dark:bg-slate-950 text-slate-300 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center">
                                <span class="text-white font-bold text-sm">🎓</span>
                            </div>
                            <span class="font-bold text-white">EduEcosystem</span>
                        </div>
                        <p class="text-sm">Inclusive education designed for specially-abled students.</p>
                    </div>
                    <div>
                        <h5 class="font-semibold text-white mb-4">Quick Links</h5>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">Home</a></li>
                            <li><a href="#" class="hover:text-white transition">Features</a></li>
                            <li><a href="#" class="hover:text-white transition">Pricing</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-white mb-4">Support</h5>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">Documentation</a></li>
                            <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                            <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-white mb-4">Legal</h5>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                            <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-8 text-center text-sm">
                    <p>&copy; 2024 EduEcosystem. All rights reserved. Empowering inclusive education.</p>
                </div>
            </div>
        </footer>
    </body>
</html>