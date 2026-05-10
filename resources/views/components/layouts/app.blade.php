<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'DevRadar') }}</title>
        <link rel="icon" type="image/png" href="/favicon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Outfit', sans-serif;
                background: radial-gradient(circle at 50% -20%, #1e293b, #0f172a 60%, #020617 100%);
                background-attachment: fixed;
            }
            .glass-nav {
                background: rgba(15, 23, 42, 0.65);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }
        </style>
        @livewireStyles
    </head>
    <body class="antialiased text-slate-200">
        <div class="flex flex-col justify-between min-h-screen relative overflow-x-hidden">
            
            <!-- Ambient background light effect -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-30 animate-pulse pointer-events-none"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-cyan-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-30 animate-pulse delay-700 pointer-events-none"></div>

            <!-- Navbar -->
            <nav class="navbar sticky top-0 z-50 glass-nav mb-12 shadow-lg px-4">
                <div class="container mx-auto flex justify-between items-center">
                    
                    <!-- Left Section - Logo -->
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-cyan-500 to-blue-600 p-2 rounded-xl shadow-lg shadow-cyan-500/20">
                             <img src="/favicon.png" alt="DevRadar" class="h-6 w-6 object-contain invert brightness-200">
                        </div>
                        <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-blue-500">
                            DevRadar
                        </a>
                    </div>

                    <!-- Right Section - Links -->
                    <div class="flex gap-2">
                        <a href="{{ route('home') }}" class="btn btn-ghost btn-md rounded-xl font-semibold hover:bg-white/5">
                            Home
                        </a>
                        <a href="{{ route('about') }}" class="btn btn-ghost btn-md rounded-xl font-semibold hover:bg-white/5">
                            About
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="container mx-auto px-4 pb-12 flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            @if(!request()->routeIs('about'))
            <footer class="footer p-8 mt-auto border-t border-white/5 bg-slate-900/50 backdrop-blur text-slate-400 footer-center">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2 opacity-80">
                        <img src="/favicon.png" alt="Logo" width="30" height="30" class="inline-block opacity-50" />
                        <span class="font-bold tracking-wider uppercase text-xs">DevRadar</span>
                    </div>
                    <p class="text-sm">&copy; {{ date('Y') }} • Forahia Solutions</p>
                </div>
            </footer>
            @endif
        </div>

        @livewireScripts
    </body>
</html>
