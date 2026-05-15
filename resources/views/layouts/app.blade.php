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
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body class="font-sans antialiased bg-edu-soft" style="background-color: #F8F7FF;">
        <!-- Background Decorative Blobs -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
            <div class="absolute top-[-5%] left-[-5%] w-[30%] h-[30%] rounded-full blur-[100px] opacity-20" style="background-color: #FFF3CC;"></div>
            <div class="absolute bottom-[10%] right-[-10%] w-[25%] h-[25%] rounded-full blur-[100px] opacity-15" style="background-color: #EEE9FF;"></div>
            <div class="absolute top-[30%] right-[10%] w-[15%] h-[15%] rounded-full blur-[80px] opacity-10" style="background-color: #FFE6F1;"></div>
        </div>

        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="sticky top-[64px] z-40 backdrop-blur-sm border-b" style="background: rgba(255, 255, 255, 0.95); border-color: rgba(123, 94, 248, 0.12);">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="font-display text-2xl font-black" style="color: #1A1F36;">
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
        <script>
            lucide.createIcons();
        </script>
    </body>
</html>
