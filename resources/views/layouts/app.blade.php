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
                100% { transform: translateY(-30px) translateX(30px) rotate(5deg); }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-white dark:bg-slate-900 border-t-8 border-sky-400">
        <!-- Decoration blobs -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10 bg-[#fafafa]">
            <div class="absolute top-[-5%] left-[-5%] w-[30%] h-[30%] bg-mustard-200/10 rounded-full blur-[100px] cheerful-blob"></div>
            <div class="absolute bottom-[10%] right-[-10%] w-[25%] h-[25%] bg-accent-100/20 rounded-full blur-[100px] cheerful-blob" style="animation-delay: -5s;"></div>
            <div class="absolute top-[30%] right-[10%] w-[15%] h-[15%] bg-cheerful-pink/5 rounded-full blur-[80px] cheerful-blob"></div>
        </div>

        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 dark:bg-slate-800/80 backdrop-blur border-b border-slate-200 dark:border-slate-700 sticky top-16 z-40 mt-16">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="text-2xl font-bold text-slate-900 dark:text-white">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
