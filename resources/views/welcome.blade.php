<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduEcho - Inclusive Learning Platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; font-weight: 800; }
        .gradient-lavender {
            background: linear-gradient(135deg, #F3EEFF 0%, #E5D9FF 100%);
        }
        .gradient-indigo {
            background: linear-gradient(135deg, #312E81 0%, #2C2669 100%);
        }
        .glassmorphism {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Warm background blobs -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-lavender-50/50 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 right-0 w-80 h-80 bg-indigo-50/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-teal-300/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Sticky Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-white/60 backdrop-blur-2xl border-b border-lavender-100">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-indigo flex items-center justify-center text-white font-black text-xl">
                    E
                </div>
                <span class="text-2xl font-black text-indigo-700">EduEcho</span>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a href="#why" class="text-slate-700 font-semibold hover:text-indigo-700 transition">Why Us</a>
                <a href="#features" class="text-slate-700 font-semibold hover:text-indigo-700 transition">Features</a>
                <a href="#everyone" class="text-slate-700 font-semibold hover:text-indigo-700 transition">For Everyone</a>
                @if (Auth::check())
                    <a href="{{ route('dashboard') }}" class="text-slate-700 font-bold hover:text-indigo-700">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-6 py-3 rounded-2xl bg-red-500 text-white font-bold hover:shadow-warm transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-slate-700 font-bold hover:text-indigo-700">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-3 rounded-2xl bg-teal-500 text-white font-bold hover:shadow-warm transition">Get Started</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in">
                <div class="inline-block px-4 py-2 rounded-2xl bg-teal-100 text-teal-700 font-bold text-sm mb-6">
                    ♿ Accessibility First Platform
                </div>
                <h1 class="text-6xl lg:text-7xl font-black text-indigo-700 leading-tight mb-6">
                    Learning Without <span class="text-teal-500">Barriers</span>
                </h1>
                <p class="text-xl text-slate-600 mb-10 leading-relaxed max-w-lg">
                    Comprehensive support for students with special needs. Personalized learning, therapy tracking, and holistic development in one inclusive platform.
                </p>
                <div class="flex flex-wrap gap-4">
                    @if (Auth::check())
                        <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-3xl bg-teal-500 text-white font-bold hover:shadow-warm-lg transition-all transform hover:-translate-y-1">
                            Go to Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-8 py-4 rounded-3xl bg-red-500 text-white font-bold hover:shadow-warm-lg transition-all transform hover:-translate-y-1">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-4 rounded-3xl bg-teal-500 text-white font-bold hover:shadow-warm-lg transition-all transform hover:-translate-y-1">
                            Let's Get Started
                        </a>
                        <a href="#features" class="px-8 py-4 rounded-3xl bg-white border-2 border-lavender-200 text-indigo-700 font-bold hover:bg-lavender-50 transition">
                            Explore Platform
                        </a>
                    @endif
                </div>
            </div>
            <div class="relative">
                <div class="relative z-10 rounded-3xl overflow-hidden shadow-warm-lg">
                    <!-- Hero Image -->
                    <img src="{{ asset('Untitled design.png') }}" alt="EduEcho Platform Illustration" class="w-full h-auto object-cover rounded-3xl">
                </div>
                <!-- Decorative elements -->
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-coral-300/30 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-teal-300/20 rounded-full blur-2xl"></div>
            </div>
        </div>
    </section>

    <!-- Why Us Section -->
    <section id="why" class="py-24 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-indigo-700 font-bold text-sm uppercase tracking-wider">Why Choose EduEcho</span>
                <h2 class="text-5xl font-black text-slate-900 mt-4 mb-4">
                    Built for <span class="text-teal-500">Inclusive Excellence</span>
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">We combine compassion with cutting-edge technology to support every learner's unique journey.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Accessibility -->
                <div class="group p-8 rounded-3xl glassmorphism hover:shadow-warm-lg transition-all transform hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-teal-100 flex items-center justify-center text-3xl mb-6 group-hover:bg-teal-500 group-hover:text-white transition">♿</div>
                    <h3 class="text-2xl font-black text-slate-900 mb-3">Accessibility</h3>
                    <p class="text-slate-600">WCAG 2.1 AA compliant. Designed for all abilities with multiple input methods and display options.</p>
                </div>

                <!-- Card 2: Personalized -->
                <div class="group p-8 rounded-3xl glassmorphism hover:shadow-warm-lg transition-all transform hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center text-3xl mb-6 group-hover:bg-indigo-700 group-hover:text-white transition">🧠</div>
                    <h3 class="text-2xl font-black text-slate-900 mb-3">AI-Powered</h3>
                    <p class="text-slate-600">Adaptive learning content that adjusts to each student's pace, learning style, and needs.</p>
                </div>

                <!-- Card 3: Therapy -->
                <div class="group p-8 rounded-3xl glassmorphism hover:shadow-warm-lg transition-all transform hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-coral-300/30 flex items-center justify-center text-3xl mb-6 group-hover:bg-coral-500 group-hover:text-white transition">🩺</div>
                    <h3 class="text-2xl font-black text-slate-900 mb-3">Therapy Tracking</h3>
                    <p class="text-slate-600">Integrated therapy session management with progress tracking and multi-discipline collaboration.</p>
                </div>

                <!-- Card 4: Compliance -->
                <div class="group p-8 rounded-3xl glassmorphism hover:shadow-warm-lg transition-all transform hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-mint-300/40 flex items-center justify-center text-3xl mb-6 group-hover:bg-mint-500 group-hover:text-white transition">📋</div>
                    <h3 class="text-2xl font-black text-slate-900 mb-3">Compliance</h3>
                    <p class="text-slate-600">IEP management, FERPA-compliant data handling, and comprehensive compliance tracking.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- For Everyone Section -->
    <section id="everyone" class="py-24 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-black text-slate-900 mb-4">
                    Built for <span class="text-indigo-700">Everyone</span>
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">Different roles, different needs. One powerful platform.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Students -->
                <div class="p-10 rounded-3xl bg-gradient-lavender border-2 border-lavender-100 hover:shadow-warm-lg transition">
                    <div class="text-5xl mb-6">👨‍🎓</div>
                    <h3 class="text-3xl font-black text-indigo-700 mb-4">Students</h3>
                    <ul class="space-y-3 text-slate-700">
                        <li class="flex gap-3"><span class="text-teal-500 font-black">✓</span> Personalized learning paths</li>
                        <li class="flex gap-3"><span class="text-teal-500 font-black">✓</span> Adaptive content</li>
                        <li class="flex gap-3"><span class="text-teal-500 font-black">✓</span> Progress tracking</li>
                        <li class="flex gap-3"><span class="text-teal-500 font-black">✓</span> Accessibility tools</li>
                    </ul>
                </div>

                <!-- Parents -->
                <div class="p-10 rounded-3xl bg-indigo-50 border-2 border-indigo-100 hover:shadow-warm-lg transition">
                    <div class="text-5xl mb-6">👨‍👩‍👧</div>
                    <h3 class="text-3xl font-black text-indigo-700 mb-4">Parents</h3>
                    <ul class="space-y-3 text-slate-700">
                        <li class="flex gap-3"><span class="text-coral-500 font-black">✓</span> Real-time progress updates</li>
                        <li class="flex gap-3"><span class="text-coral-500 font-black">✓</span> Therapist communication</li>
                        <li class="flex gap-3"><span class="text-coral-500 font-black">✓</span> Appointment scheduling</li>
                        <li class="flex gap-3"><span class="text-coral-500 font-black">✓</span> Growth insights</li>
                    </ul>
                </div>

                <!-- Educators -->
                <div class="p-10 rounded-3xl bg-slate-100 border-2 border-slate-200 hover:shadow-warm-lg transition">
                    <div class="text-5xl mb-6">👨‍🏫</div>
                    <h3 class="text-3xl font-black text-indigo-700 mb-4">Educators</h3>
                    <ul class="space-y-3 text-slate-700">
                        <li class="flex gap-3"><span class="text-mint-500 font-black">✓</span> IEP management</li>
                        <li class="flex gap-3"><span class="text-mint-500 font-black">✓</span> Student analytics</li>
                        <li class="flex gap-3"><span class="text-mint-500 font-black">✓</span> Resource library</li>
                        <li class="flex gap-3"><span class="text-mint-500 font-black">✓</span> Team collaboration</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section id="features" class="py-24 px-6 bg-white/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-black text-slate-900 mb-4">
                    Powerful <span class="text-teal-500">Features</span>
                </h2>
                <p class="text-xl text-slate-600">Everything you need to support inclusive education.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature cards -->
                <div class="p-8 rounded-3xl bg-white border-2 border-lavender-100 hover:border-teal-300 hover:shadow-warm transition group">
                    <div class="w-14 h-14 rounded-2xl bg-lavender-50 flex items-center justify-center text-2xl mb-6 group-hover:bg-teal-500 group-hover:text-white transition">📚</div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">Learning Hub</h4>
                    <p class="text-slate-600">Structured courses with adaptive difficulty, multimedia content, and progress tracking.</p>
                </div>

                <div class="p-8 rounded-3xl bg-white border-2 border-indigo-100 hover:border-indigo-300 hover:shadow-warm transition group">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-2xl mb-6 group-hover:bg-indigo-700 group-hover:text-white transition">🧠</div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">AI Assistant</h4>
                    <p class="text-slate-600">Smart recommendations, adaptive difficulty, and personalized learning suggestions.</p>
                </div>

                <div class="p-8 rounded-3xl bg-white border-2 border-coral-200 hover:border-coral-400 hover:shadow-warm transition group">
                    <div class="w-14 h-14 rounded-2xl bg-coral-100 flex items-center justify-center text-2xl mb-6 group-hover:bg-coral-500 group-hover:text-white transition">📊</div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">Analytics</h4>
                    <p class="text-slate-600">Comprehensive progress reports, learning analytics, and growth insights.</p>
                </div>

                <div class="p-8 rounded-3xl bg-white border-2 border-mint-200 hover:border-mint-400 hover:shadow-warm transition group">
                    <div class="w-14 h-14 rounded-2xl bg-mint-100 flex items-center justify-center text-2xl mb-6 group-hover:bg-mint-500 group-hover:text-white transition">🩺</div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">Therapy Tracker</h4>
                    <p class="text-slate-600">Session scheduling, progress tracking, multi-discipline collaboration tools.</p>
                </div>

                <div class="p-8 rounded-3xl bg-white border-2 border-teal-200 hover:border-teal-400 hover:shadow-warm transition group">
                    <div class="w-14 h-14 rounded-2xl bg-teal-100 flex items-center justify-center text-2xl mb-6 group-hover:bg-teal-500 group-hover:text-white transition">♿</div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">Accessibility</h4>
                    <p class="text-slate-600">Text-to-speech, dyslexia fonts, dark mode, keyboard navigation, high contrast.</p>
                </div>

                <div class="p-8 rounded-3xl bg-white border-2 border-peach-200 hover:border-peach-400 hover:shadow-warm transition group">
                    <div class="w-14 h-14 rounded-2xl bg-peach-100 flex items-center justify-center text-2xl mb-6 group-hover:bg-peach-500 group-hover:text-white transition">📋</div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">Compliance</h4>
                    <p class="text-slate-600">IEP management, compliance tracking, audit logs, FERPA-compliant data.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-6 gradient-indigo relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-40 h-40 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-50 h-50 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto text-center relative z-10">
            <h2 class="text-5xl font-black text-white mb-6">
                Transform Inclusive Education Today
            </h2>
            <p class="text-xl text-indigo-100 mb-10 leading-relaxed">
                Join educators, therapists, and families revolutionizing special education support. Start free today.
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ route('register') }}" class="px-10 py-5 rounded-3xl bg-teal-500 text-white font-black text-lg hover:bg-teal-600 shadow-lg transition-all transform hover:-translate-y-1">
                    Let's Get Started
                </a>
                <a href="{{ route('login') }}" class="px-10 py-5 rounded-3xl bg-white/20 text-white font-black text-lg border-2 border-white hover:bg-white/30 transition-all transform hover:-translate-y-1">
                    Sign In
                </a>
            </div>
        </div>
    </section>

    <!-- Accessibility Panel -->
    <div id="accessibility-panel" class="fixed bottom-8 right-8 z-40">
        <button id="accessibility-toggle" class="w-16 h-16 rounded-full bg-teal-500 text-white font-black text-2xl shadow-lg hover:shadow-warm-lg hover:-translate-y-1 transition-all flex items-center justify-center">
            ♿
        </button>
        
        <!-- Accessibility Options (hidden by default) -->
        <div id="accessibility-options" class="hidden absolute bottom-20 right-0 w-64 rounded-3xl glassmorphism p-6 shadow-warm-lg">
            <h3 class="font-black text-slate-900 mb-4">Accessibility Options</h3>
            <div class="space-y-3">
                <label class="flex items-center gap-3 cursor-pointer hover:bg-lavender-50 p-2 rounded-lg">
                    <input type="checkbox" id="large-font" class="w-5 h-5 rounded text-teal-500">
                    <span class="text-slate-700 font-semibold">🔤 Large Font</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer hover:bg-lavender-50 p-2 rounded-lg">
                    <input type="checkbox" id="dyslexia-font" class="w-5 h-5 rounded text-teal-500">
                    <span class="text-slate-700 font-semibold">📖 Dyslexia Font</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer hover:bg-lavender-50 p-2 rounded-lg">
                    <input type="checkbox" id="dark-mode" class="w-5 h-5 rounded text-teal-500">
                    <span class="text-slate-700 font-semibold">🌙 Dark Mode</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer hover:bg-lavender-50 p-2 rounded-lg">
                    <input type="checkbox" id="text-speech" class="w-5 h-5 rounded text-teal-500">
                    <span class="text-slate-700 font-semibold">🔊 Text-to-Speech</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer hover:bg-lavender-50 p-2 rounded-lg">
                    <input type="checkbox" id="high-contrast" class="w-5 h-5 rounded text-teal-500">
                    <span class="text-slate-700 font-semibold">⚪ High Contrast</span>
                </label>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white/50 border-t border-lavender-100 py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-indigo flex items-center justify-center text-white font-black">E</div>
                        <span class="text-xl font-black text-indigo-700">EduEcho</span>
                    </div>
                    <p class="text-slate-600">Inclusive education for every learner.</p>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 mb-4">Product</h4>
                    <ul class="space-y-2 text-slate-600">
                        <li><a href="#features" class="hover:text-teal-500 transition">Features</a></li>
                        <li><a href="#" class="hover:text-teal-500 transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-teal-500 transition">Security</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 mb-4">Company</h4>
                    <ul class="space-y-2 text-slate-600">
                        <li><a href="#" class="hover:text-teal-500 transition">About</a></li>
                        <li><a href="#" class="hover:text-teal-500 transition">Blog</a></li>
                        <li><a href="#" class="hover:text-teal-500 transition">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 mb-4">Legal</h4>
                    <ul class="space-y-2 text-slate-600">
                        <li><a href="#" class="hover:text-teal-500 transition">Privacy</a></li>
                        <li><a href="#" class="hover:text-teal-500 transition">Terms</a></li>
                        <li><a href="#" class="hover:text-teal-500 transition">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-lavender-100 pt-8">
                <p class="text-center text-slate-600">© 2026 EduEcho. All rights reserved. Designed with compassion for inclusive education.</p>
            </div>
        </div>
    </footer>

    <script>
        // Accessibility toggle
        const toggle = document.getElementById('accessibility-toggle');
        const options = document.getElementById('accessibility-options');
        
        toggle.addEventListener('click', () => {
            options.classList.toggle('hidden');
        });

        // Accessibility features
        document.getElementById('large-font').addEventListener('change', function() {
            if (this.checked) {
                document.body.style.fontSize = '18px';
            } else {
                document.body.style.fontSize = '16px';
            }
        });

        document.getElementById('dark-mode').addEventListener('change', function() {
            document.documentElement.classList.toggle('dark', this.checked);
        });

        document.getElementById('high-contrast').addEventListener('change', function() {
            if (this.checked) {
                document.body.style.filter = 'contrast(1.5)';
            } else {
                document.body.style.filter = 'contrast(1)';
            }
        });

        document.getElementById('text-speech').addEventListener('change', function() {
            if (this.checked && 'speechSynthesis' in window) {
                const text = document.body.innerText.substring(0, 500);
                const utterance = new SpeechSynthesisUtterance(text);
                speechSynthesis.speak(utterance);
            }
        });
    </script>
</body>
</html>
