<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduEcosystem') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            .cheerful-blob {
                animation: float 20s infinite alternate;
            }
            @keyframes float {
                0% { transform: translateY(0px) translateX(0px) rotate(0deg); }
                100% { transform: translateY(-50px) translateX(50px) rotate(10deg); }
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-white dark:bg-slate-900 border-t-8 border-sky-400">
        <!-- Decoration blobs -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10 bg-[#fafafa]">
            <div class="absolute top-[-5%] left-[-5%] w-[30%] h-[30%] bg-mustard-200/20 rounded-full blur-[80px] cheerful-blob"></div>
            <div class="absolute bottom-[20%] right-[-10%] w-[25%] h-[25%] bg-accent-100/30 rounded-full blur-[80px] cheerful-blob" style="animation-delay: -5s;"></div>
            <div class="absolute top-[40%] right-[10%] w-[15%] h-[15%] bg-cheerful-pink/5 rounded-full blur-[60px] cheerful-blob"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-14 h-14 rounded-2xl bg-cheerful-purple flex items-center justify-center shadow-lg shadow-cheerful-purple/20 rotate-3 group-hover:rotate-0 transition-transform">
                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-black text-slate-800 tracking-tight">Edu<span class="text-cheerful-purple">Ecosystem</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white dark:bg-slate-800 shadow-[0_20px_60px_rgba(167,139,250,0.1)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-hidden sm:rounded-[2.5rem] border border-slate-100 dark:border-slate-700">
                {{ $slot }}
            </div>
            
            <div class="mt-12 text-slate-400 dark:text-slate-500 font-bold text-sm">
                &copy; {{ date('Y') }} <span class="text-cheerful-purple">EduEcosystem</span>. All rights reserved.
            </div>
        </div>
    </body>
</html>
