<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Beauty Rush</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>


<body class="bg-[#fffaf3] text-slate-900">

<nav class="flex flex-wrap items-center gap-4 border-b border-rose-100 bg-[#ead8bd] px-4 py-2">

    <a href="{{ route('welcome') }}" class="shrink-0">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="BeautyRush logo"
            class="h-20 w-auto"
        >
    </a>

    <div class="flex flex-1 flex-wrap items-center gap-x-6 gap-y-2">
        <a class="hover:font-bold" href="{{ route('welcome') }}">Home</a>
        <a class="hover:font-bold" href="{{ route('products') }}">Products</a>
        @auth
            <a class="hover:font-bold" href="{{ route('account') }}">Account</a>
        @endauth
        <a class="hover:font-bold" href="{{ route('contact') }}">Contact</a>
        <a class="hover:font-bold" href="{{ route('faq') }}">FAQ</a>
        <a class="ml-auto rounded-full bg-slate-900 px-5 py-2 text-white transition hover:bg-rose-600" href="{{ route('login') }}">Login</a>
    </div>

</nav>


<main class="bg-[#fffaf3]">
    {{ $slot }}
</main>


<footer class="flex gap-6 border-t border-rose-100 bg-rose-100 px-6 py-4 text-sm text-slate-700">

    <p>
        &copy; 2026 BeautyRush
    </p>

</footer>

</body>
</html>
