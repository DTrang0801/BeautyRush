<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Beauty Rush</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>


<body class="mr-4">

<nav class="mb-4 bg-pink-100 flex items-center px-4 py-2">

    <a href="/" class="mr-8">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="BeautyRush logo"
            class="h-20 w-auto"
        >
    </a>

    <div class="flex gap-6">
        <a class="hover:font-bold" href="/">Home</a>
        <a class="hover:font-bold" href="/products">Products</a>
        <a class="hover:font-bold" href="/account">Account</a>
    </div>

</nav>


<main>
    {{ $slot }}
</main>


<footer class="mt-4 mb-4 bg-pink-200 flex gap-6">

    <a class="ml-8 mr-4 hover:font-bold" href="/contact">Contact</a>
    <a class="hover:font-bold" href="/faq">FAQ</a>

</footer>

</body>
</html>