<x-site-layout>
    <section class="bg-gradient-to-br from-pink-50 via-white to-rose-50 px-6 py-16 sm:px-10">
        <div class="mx-auto grid max-w-6xl gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="space-y-6">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-500">Beauty, chosen well</p>
                <h1 class="max-w-xl text-5xl font-semibold leading-tight text-slate-900 sm:text-6xl" style="font-family: 'Parisienne', cursive;">
                    Your next beauty favorite starts here.
                </h1>
                <p class="max-w-xl text-lg leading-8 text-slate-600">
                    Discover thoughtful reviews, trusted essentials, and fresh inspiration for every part of your routine.
                </p>
                <a href="{{ route('products') }}" class="inline-flex rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">
                    Explore all products
                </a>
            </div>
            <div class="rounded-[2rem] bg-rose-200/70 p-8 shadow-xl shadow-rose-100 sm:p-12">
                <p class="text-sm font-semibold uppercase tracking-widest text-rose-700">The Beauty Rush edit</p>
                <p class="mt-5 text-3xl font-semibold leading-snug text-slate-900">Simple products. Honest opinions. More confident choices.</p>
                <div class="mt-8 flex gap-8 text-sm text-slate-700">
                    <div><p class="text-2xl font-bold text-slate-900">4.8/5</p><p>community rating</p></div>
                    <div><p class="text-2xl font-bold text-slate-900">100%</p><p>beauty inspired</p></div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-rose-100 bg-[#ead8bd]/40 px-6 py-14 sm:px-10">
        <div class="mx-auto max-w-6xl">
            <div class="max-w-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Why Beauty Rush?</p>
                <h2 class="mt-2 text-3xl font-semibold text-slate-900">A little more confidence in every choice.</h2>
            </div>
            <div class="mt-8 grid gap-5 md:grid-cols-3">
                <div class="rounded-2xl bg-[#fff8ee] p-6 shadow-sm">
                    <p class="text-2xl text-rose-400">01</p>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Honest reviews</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Real experiences that help you choose products with confidence.</p>
                </div>
                <div class="rounded-2xl bg-[#fff8ee] p-6 shadow-sm">
                    <p class="text-2xl text-rose-400">02</p>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Fresh inspiration</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Simple ideas, routines, and tips for every kind of beauty lover.</p>
                </div>
                <div class="rounded-2xl bg-[#fff8ee] p-6 shadow-sm">
                    <p class="text-2xl text-rose-400">03</p>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">A kind community</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Share what works for you and discover your next favorite together.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-rose-100 bg-[#fff8ee] px-6 py-16 sm:px-10">
        <div class="mx-auto max-w-6xl space-y-8">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">From our community</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-900">Beauty tips to try</h2>
                </div>
                <a href="{{ route('tips.index') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-800">Add & view more tips →</a>
            </div>
            <div class="grid gap-5 md:grid-cols-3">
                @foreach ($tips as $tip)
                    <article class="rounded-2xl border border-rose-100 bg-rose-100/40 p-6">
                        <p class="text-2xl text-rose-400">✦</p>
                        <h3 class="mt-4 text-lg font-semibold text-slate-900">{{ $tip['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $tip['text'] }}</p>
                        <p class="mt-5 text-xs font-semibold uppercase tracking-wider text-rose-500">Shared by {{ $tip['author'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl space-y-8 px-6 py-16 sm:px-10">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Community favorites</p>
                <h2 class="mt-2 text-3xl font-semibold text-slate-900">Products worth talking about</h2>
            </div>
            <a href="{{ route('products') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-800">View the collection →</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <article class="overflow-hidden rounded-3xl border border-rose-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex h-48 items-end bg-gradient-to-br {{ $product['tone'] }} p-6">
                        <span class="rounded-full bg-white/80 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-rose-700">{{ $product['type'] }}</span>
                    </div>
                    <div class="space-y-5 p-6">
                        <div class="flex items-start justify-between gap-4">
                            <h3 class="text-xl font-semibold text-slate-900">{{ $product['name'] }}</h3>
                            <span class="shrink-0 font-semibold text-slate-900">{{ $product['price'] }}</span>
                        </div>
                        <p class="text-sm leading-6 text-slate-600">{{ $product['description'] }}</p>
                        <div class="border-t border-rose-100 pt-5">
                            <div class="flex items-center justify-between text-sm font-semibold text-rose-600">
                                <span>★★★★★ {{ $product['rating'] }}</span>
                                <span class="text-slate-400">Verified review</span>
                            </div>
                            <blockquote class="mt-3 text-sm italic leading-6 text-slate-600">“{{ $product['review'] }}”</blockquote>
                            <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-400">{{ $product['reviewer'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</x-site-layout>
