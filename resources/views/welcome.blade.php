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
                            },
                            mustard: {
                                50: '#fefce8',
                                100: '#fef9c3',
                                200: '#fef08a',
                                300: '#fde047',
                                400: '#facc15',
                                500: '#eab308',
                                600: '#ca8a04',
                                700: '#a16207',
                                800: '#854d0e',
                                900: '#713f12',
                                950: '#422006',
                            },
                            accent: {
                                100: '#e0f2fe',
                                500: '#0ea5e9',
                            },
                            cheerful: {
                                pink: '#f472b6',
                                purple: '#8b5cf6',
                                teal: '#2dd4bf',
                                orange: '#fb923c'
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
            .cheerful-blob {
                animation: float 20s infinite alternate;
            }
            @keyframes float {
                0% { transform: translateY(0px) translateX(0px) rotate(0deg); }
                100% { transform: translateY(-50px) translateX(50px) rotate(10deg); }
            }
        </style>
    </head>
    <body class="antialiased bg-white dark:bg-slate-900 border-t-8 border-sky-400">
        <!-- Decoration blobs for that cheerful look -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10 bg-[#fafafa]">
            <div class="absolute top-[-5%] left-[-5%] w-[30%] h-[30%] bg-mustard-200/20 rounded-full blur-[80px] cheerful-blob"></div>
            <div class="absolute bottom-[20%] right-[-10%] w-[25%] h-[25%] bg-accent-100/30 rounded-full blur-[80px] cheerful-blob" style="animation-delay: -5s;"></div>
            <div class="absolute top-[40%] right-[10%] w-[15%] h-[15%] bg-cheerful-pink/5 rounded-full blur-[60px] cheerful-blob"></div>
            
            <!-- Floating shapes like in the image -->
            <svg class="absolute top-20 left-10 text-mustard-400/20 w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l2.4 7.2h7.6l-6.2 4.5 2.4 7.3-6.2-4.5-6.2 4.5 2.4-7.3-6.2-4.5h7.6z"/></svg>
            <svg class="absolute bottom-40 left-1/4 text-accent-500/10 w-8 h-8 rotate-12" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>
        </div>

        <!-- Navigation -->
        <nav class="fixed w-full bg-white/80 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 z-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center space-x-3">
                        <div class="w-11 h-11 rounded-2xl bg-mustard-400 flex items-center justify-center shadow-lg shadow-mustard-200 rotate-3 group-hover:rotate-0 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-black text-slate-800 tracking-tight">Edu<span class="text-mustard-500">Ecosystem</span></span>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#features" class="text-slate-600 font-semibold hover:text-mustard-500 transition">Features</a>
                        <a href="#everyone" class="text-slate-600 font-semibold hover:text-mustard-500 transition">For Everyone</a>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-3 rounded-2xl bg-slate-900 text-white font-bold hover:shadow-xl transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-700 font-bold hover:text-mustard-500 transition">Login</a>
                            <a href="{{ route('register') }}" class="px-7 py-3 rounded-2xl bg-mustard-400 text-white font-bold hover:bg-mustard-500 shadow-lg shadow-mustard-100 transition">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative pt-40 pb-20 px-6 lg:px-8 overflow-hidden">
            <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative z-10 text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-mustard-100 text-mustard-700 font-bold text-sm mb-8 animate-bounce">
                        <span>✨ Start Learning Today</span>
                    </div>
                    <h2 class="text-6xl lg:text-7xl font-black text-slate-900 leading-[1.1] mb-8">
                        The Best Platform for <span class="text-mustard-500">Inclusive</span> Education
                    </h2>
                    <p class="text-xl text-slate-600 mb-10 leading-relaxed max-w-lg">
                        Our mission is to empower specially-abled students with specialized tools, adaptive content, and holistic tracking.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-10 py-5 rounded-3xl bg-slate-900 text-white font-black text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-10 py-5 rounded-3xl bg-mustard-400 text-white font-black text-lg hover:bg-mustard-500 shadow-xl shadow-mustard-100 transition-all transform hover:-translate-y-1">
                                Enroll Now
                            </a>
                            <a href="#features" class="px-10 py-5 rounded-3xl bg-white border-2 border-slate-100 text-slate-900 font-black text-lg hover:bg-slate-50 transition-all transform hover:-translate-y-1">
                                Explore Features
                            </a>
                        @endauth
                    </div>
                </div>
                
                <div class="relative">
                    <!-- Image container with background elements like the picture -->
                    <div class="relative z-10 w-full aspect-square rounded-[3rem] overflow-hidden shadow-2xl rotate-2">
                        <img src="{{ asset('hero.png') }}" alt="Inclusive Education" class="w-full h-full object-cover">
                        <!-- LIGHTER BLACK OVERLAY -->
                        <div class="absolute inset-0 bg-black/10 backdrop-blur-[0.5px]"></div>
                        <!-- Gradient to make text on top (if added later) readable but keeping img visible -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <!-- Decoration elements around the image -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-accent-100 rounded-full -z-10 blur-2xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-mustard-200 rounded-full -z-10 blur-2xl"></div>
                    <!-- Cheerful icons -->
                    <div class="absolute top-1/4 -right-8 p-4 bg-white rounded-2xl shadow-xl animate-pulse">
                        <svg class="w-8 h-8 text-cheerful-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
            </div>
        </section>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-24 px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16 relative">
                    <span class="text-mustard-500 font-black uppercase tracking-[0.2em] text-sm mb-4 block">Our Expertise</span>
                    <h3 class="text-5xl font-black text-slate-900 mb-4">
                        Explore Our <span class="text-mustard-500">Categories</span>
                    </h3>
                    <p class="text-slate-500 max-w-xl mx-auto">Providing specialized support across all critical areas of student development.</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
                    <!-- Feature 1 -->
                    <div class="p-10 rounded-[2.5rem] bg-[#f8fafc] border-2 border-transparent hover:border-mustard-400 hover:bg-white transition-all duration-500 group shadow-sm hover:shadow-2xl">
                        <div class="w-16 h-16 rounded-[1.5rem] bg-mustard-100 flex items-center justify-center mb-8 group-hover:bg-mustard-400 group-hover:rotate-12 transition-all duration-300">
                            <svg class="w-8 h-8 text-mustard-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">IEP Tool</h4>
                        <p class="text-slate-600 leading-relaxed">Personalized education plans with customizable goals and accommodations.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-10 rounded-[2.5rem] bg-[#f8fafc] border-2 border-transparent hover:border-accent-500 hover:bg-white transition-all duration-500 group shadow-sm hover:shadow-2xl">
                        <div class="w-16 h-16 rounded-[1.5rem] bg-accent-100 flex items-center justify-center mb-8 group-hover:bg-accent-500 group-hover:-rotate-12 transition-all duration-300">
                            <svg class="w-8 h-8 text-accent-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">Accessibility</h4>
                        <p class="text-slate-600 leading-relaxed">WCAG 2.1 compliant interface ensuring every student can learn effectively.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-10 rounded-[2.5rem] bg-[#f8fafc] border-2 border-transparent hover:border-cheerful-pink hover:bg-white transition-all duration-500 group shadow-sm hover:shadow-2xl">
                        <div class="w-16 h-16 rounded-[1.5rem] bg-pink-100 flex items-center justify-center mb-8 group-hover:bg-cheerful-pink group-hover:rotate-12 transition-all duration-300">
                            <svg class="w-8 h-8 text-cheerful-pink group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">Therapy</h4>
                        <p class="text-slate-600 leading-relaxed">Tracking therapy sessions and progress for a holistic growth journey.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="p-10 rounded-[2.5rem] bg-[#f8fafc] border-2 border-transparent hover:border-cheerful-teal hover:bg-white transition-all duration-500 group shadow-sm hover:shadow-2xl">
                        <div class="w-16 h-16 rounded-[1.5rem] bg-teal-100 flex items-center justify-center mb-8 group-hover:bg-cheerful-teal group-hover:-rotate-12 transition-all duration-300">
                            <svg class="w-8 h-8 text-cheerful-teal group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">Compliance</h4>
                        <p class="text-slate-600 leading-relaxed">Automated governance and reporting for all educational standards.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Types Section -->
        <section id="everyone" class="py-24 px-6 lg:px-8 bg-[#fafafa]">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <h3 class="text-5xl font-black text-slate-900">
                        Built For <span class="text-mustard-500">Everyone</span>
                    </h3>
                </div>
                <div class="grid md:grid-cols-2 gap-12">
                    <!-- Students -->
                    <div class="relative p-10 rounded-[3rem] bg-white border-2 border-slate-100 transition-all cursor-default group overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-mustard-400/10 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="flex items-center gap-6 mb-8">
                            <div class="w-16 h-16 rounded-2xl bg-mustard-400 flex items-center justify-center text-white shadow-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                            </div>
                            <h4 class="text-3xl font-black text-slate-900">Students</h4>
                        </div>
                        <ul class="space-y-4 text-lg font-medium text-slate-600">
                            <li class="flex items-center gap-3"><span class="w-6 h-6 rounded-full bg-mustard-100 text-mustard-600 flex items-center justify-center text-xs">✓</span> Personalized learning paths</li>
                            <li class="flex items-center gap-3"><span class="w-6 h-6 rounded-full bg-mustard-100 text-mustard-600 flex items-center justify-center text-xs">✓</span> Track your progress</li>
                            <li class="flex items-center gap-3"><span class="w-6 h-6 rounded-full bg-mustard-100 text-mustard-600 flex items-center justify-center text-xs">✓</span> Adaptive accommodations</li>
                        </ul>
                    </div>

                    <!-- Educators -->
                    <div class="relative p-10 rounded-[3rem] bg-white border-2 border-slate-100 transition-all cursor-default group overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-accent-500/10 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="flex items-center gap-6 mb-8">
                            <div class="w-16 h-16 rounded-2xl bg-accent-500 flex items-center justify-center text-white shadow-lg shadow-accent-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h4 class="text-3xl font-black text-slate-900">Educators</h4>
                        </div>
                        <ul class="space-y-4 text-lg font-medium text-slate-600">
                            <li class="flex items-center gap-3"><span class="w-6 h-6 rounded-full bg-accent-100 text-accent-500 flex items-center justify-center text-xs">✓</span> Manage student IEPs</li>
                            <li class="flex items-center gap-3"><span class="w-6 h-6 rounded-full bg-accent-100 text-accent-500 flex items-center justify-center text-xs">✓</span> Monitor engagement</li>
                            <li class="flex items-center gap-3"><span class="w-6 h-6 rounded-full bg-accent-100 text-accent-500 flex items-center justify-center text-xs">✓</span> Collaborative tools</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 px-6 lg:px-8">
            <div class="max-w-5xl mx-auto relative group">
                <!-- Background decoration behind CTA -->
                <div class="absolute inset-0 bg-pink-100 rounded-[4rem] rotate-1 group-hover:rotate-0 transition-transform duration-500"></div>
                <div class="relative bg-cheerful-pink rounded-[4rem] p-16 text-center text-white shadow-2xl -rotate-1 group-hover:rotate-0 transition-transform duration-500">
                    <h3 class="text-5xl font-black mb-8">Ready to <span class="text-white">transform</span> learning?</h3>
                    <p class="text-xl mb-12 text-white/90 max-w-2xl mx-auto leading-relaxed">Join a community dedicated to breaking educational barriers for specially-abled students.</p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-12 py-5 rounded-3xl bg-white text-cheerful-pink font-black text-xl hover:shadow-xl transition-all shadow-xl">
                                Enter Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-12 py-5 rounded-3xl bg-white text-cheerful-pink font-black text-xl hover:shadow-xl transition-all shadow-xl">
                                Create Free Account
                            </a>
                            <a href="{{ route('login') }}" class="px-12 py-5 rounded-3xl border-2 border-white/40 text-white font-black text-xl hover:bg-white/10 transition-all">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-950 py-24 px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-16 mb-20">
                    <div class="col-span-1 md:col-span-1">
                        <div class="flex items-center space-x-3 mb-8">
                            <div class="w-11 h-11 rounded-2xl bg-mustard-400 flex items-center justify-center shadow-lg shadow-mustard-400/20 rotate-3">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                            </div>
                            <span class="font-black text-white text-2xl tracking-tighter">Edu<span class="text-mustard-400">E</span></span>
                        </div>
                        <p class="text-slate-400 leading-relaxed font-medium">Empowering every learner through specialized technology and inclusive care.</p>
                    </div>
                    <div>
                        <h5 class="font-black text-white mb-10 uppercase tracking-widest text-xs opacity-50">Quick Links</h5>
                        <ul class="space-y-5">
                            <li><a href="#" class="text-slate-300 hover:text-mustard-400 font-bold transition-all">Home</a></li>
                            <li><a href="#features" class="text-slate-300 hover:text-mustard-400 font-bold transition-all">Features</a></li>
                            <li><a href="#everyone" class="text-slate-300 hover:text-mustard-400 font-bold transition-all">For Everyone</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-black text-white mb-10 uppercase tracking-widest text-xs opacity-50">Support</h5>
                        <ul class="space-y-5">
                            <li><a href="#" class="text-slate-300 hover:text-mustard-400 font-bold transition-all">Documentation</a></li>
                            <li><a href="#" class="text-slate-300 hover:text-mustard-400 font-bold transition-all">Help Center</a></li>
                            <li><a href="#" class="text-slate-300 hover:text-mustard-400 font-bold transition-all">Privacy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-black text-white mb-10 uppercase tracking-widest text-xs opacity-50">Contact</h5>
                        <ul class="space-y-4">
                            <li class="text-slate-300 font-bold">hello@eduecosystem.com</li>
                            <li class="text-slate-300 font-bold">+1 (555) 000-0000</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-white/5 pt-12 flex flex-col md:flex-row justify-between items-center gap-8">
                    <p class="text-slate-500 font-bold text-sm">&copy; 2026 <span class="text-mustard-400">EduEcosystem</span>. All rights reserved.</p>
                    <div class="flex gap-6">
                        <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-slate-400 hover:bg-mustard-400 hover:text-white transition-all cursor-pointer group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>