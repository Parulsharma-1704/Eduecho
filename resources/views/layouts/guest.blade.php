<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>EduEcho</title>
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234338ca' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z'/%3E%3Cpath d='m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65'/%3E%3Cpath d='m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65'/%3E%3C/svg%3E">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/lucide@latest"></script>
        
        <style>
            html { scroll-behavior: smooth; }
            h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; font-weight: 800; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50">
        <!-- Warm background blobs -->
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-lavender-50/50 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 right-0 w-80 h-80 bg-indigo-50/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-teal-300/10 rounded-full blur-3xl"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="w-full sm:max-w-md">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group justify-center mb-8">
                    <i data-lucide="layers" class="w-10 h-10 text-indigo-700"></i>
                    <span class="text-2xl font-black text-indigo-700">EduEcho</span>
                </a>

                <!-- Content Card -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-lavender-100">
                    <div class="p-8 sm:p-10">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Footer -->
                <p class="text-center text-sm text-slate-500 mt-8">
                    © {{ date('Y') }} EduEcho. Empowering inclusive learning.
                </p>
            </div>
        </div>
        <script>
            lucide.createIcons();
        </script>
    </body>
</html>
