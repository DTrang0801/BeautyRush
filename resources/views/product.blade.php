<x-site-layout>
    <section class="bg-slate-900 px-6 py-16 text-white sm:px-10">
        <div class="mx-auto max-w-6xl space-y-4">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-300">The full edit</p>
            <h1 class="text-4xl font-semibold sm:text-5xl">Find your beauty essentials</h1>
            <p class="max-w-2xl text-lg leading-8 text-slate-300">Explore our community-loved products across complexion, cheeks, eyes, lips, skincare, and tools.</p>
        </div>
    </section>

    <main class="mx-auto max-w-6xl px-6 py-16 sm:px-10">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <article class="overflow-hidden rounded-3xl border border-rose-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex h-48 items-end bg-gradient-to-br {{ $product['tone'] }} p-6">
                        <span class="rounded-full bg-white/80 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-rose-700">{{ $product['type'] }}</span>
                    </div>
                    <div class="space-y-5 p-6">
                        <div class="flex items-start justify-between gap-4">
                            <h2 class="text-xl font-semibold text-slate-900">{{ $product['name'] }}</h2>
                            <span class="shrink-0 font-semibold text-slate-900">{{ $product['price'] }}</span>
                        </div>
                        <p class="text-sm leading-6 text-slate-600">{{ $product['description'] }}</p>
                        <div class="border-t border-rose-100 pt-5">
                            <p class="text-sm font-semibold text-rose-600">★★★★★ {{ $product['rating'] }}</p>
                            <blockquote class="mt-3 text-sm italic leading-6 text-slate-600">“{{ $product['review'] }}”</blockquote>
                            <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-400">{{ $product['reviewer'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </main>
</x-site-layout>
