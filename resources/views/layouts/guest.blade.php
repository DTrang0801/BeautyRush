<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Beauty Rush</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS & Alpine.js via CDN -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden {{ request()->routeIs('login', 'password.request') ? 'bg-gradient-to-br from-[#d8b28c] via-[#ead8bd] to-[#f7efe3] px-6 py-10' : 'bg-stone-100 px-6 py-10' }}">
            <div class="pointer-events-none absolute -left-24 top-16 h-64 w-64 rounded-full bg-amber-100/60 blur-3xl"></div>
            <div class="pointer-events-none absolute -right-24 bottom-10 h-72 w-72 rounded-full bg-slate-200/70 blur-3xl"></div>

            <div @class([
                'relative w-full',
                'max-w-6xl' => request()->routeIs('login'),
                'mt-6 max-w-3xl overflow-hidden rounded-3xl bg-[#fff8ee] pb-10 shadow-xl shadow-slate-200' => request()->routeIs('password.request'),
                'mt-6 overflow-hidden rounded-3xl bg-white shadow-xl shadow-slate-200 sm:max-w-6xl' => ! request()->routeIs('login', 'password.request'),
            ])>
                @unless (request()->routeIs('login'))
                    <div class="flex justify-center border-b border-slate-100 px-6 py-5">
                        <a href="{{ route('welcome') }}" class="block">
                            <img src="{{ asset('images/logo.png') }}" alt="Beauty Rush" class="h-20 w-auto object-contain">
                        </a>
                    </div>
                @endunless

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
