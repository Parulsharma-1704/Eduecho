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
                            slate: { 950: '#020617' }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 dark:bg-slate-900 border-t-4 border-blue-600">
        <!-- Decoration blobs -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-400/10 rounded-full blur-3xl"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-4">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg group-hover:shadow-blue-500/50 transition-all duration-300 transform group-hover:-rotate-6">
                        <span class="text-white font-bold text-2xl">🎓</span>
                    </div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">EduEcosystem</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white dark:bg-slate-800 shadow-[0_20px_50px_rgba(8,_112,_184,_0.1)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-hidden sm:rounded-2xl border border-slate-100 dark:border-slate-700">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-slate-500 dark:text-slate-400 text-sm">
                &copy; {{ date('Y') }} EduEcosystem. All rights reserved.
            </div>
        </div>
    </body>
</html>
