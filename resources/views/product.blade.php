<x-site-layout>
    <section class="bg-gradient-to-br from-[#d8b28c] via-[#ead8bd] to-[#f7efe3] px-6 py-16 text-slate-900 sm:px-10">
        <div class="mx-auto max-w-6xl space-y-4">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-300">The full edit</p>
            <h1 class="text-4xl font-semibold sm:text-5xl">Find your beauty essentials</h1>
            <p class="max-w-2xl text-lg leading-8 text-slate-700">Explore our community-loved products across complexion, cheeks, eyes, lips, skincare, and tools.</p>
        </div>
    </section>

    <main x-data="{ selectedProduct: null, favoriteReviews: @js($favoriteReviews) }" class="mx-auto max-w-6xl px-6 py-16 sm:px-10">
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
                        <button type="button" x-on:click="selectedProduct = @js($product)" class="self-start text-sm font-semibold text-rose-600 hover:text-rose-800">View details →</button>
                        <div class="border-t border-rose-100 pt-5">
                            <p class="text-sm font-semibold text-rose-600">★★★★★ {{ $product['rating'] }}</p>
                            <blockquote class="mt-3 text-sm italic leading-6 text-slate-600">“{{ $product['review'] }}”</blockquote>
                            <p class="mt-3 text-xs font-semibold uppercase tracking-wider text-slate-400">{{ $product['reviewer'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div x-show="selectedProduct" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 px-6 py-8" x-on:click.self="selectedProduct = null">
            <div class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-3xl bg-[#fff8ee] p-6 shadow-2xl sm:p-10">
                <div class="flex items-start justify-between gap-6">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500" x-text="selectedProduct?.type"></p>
                        <h2 class="mt-2 text-3xl font-semibold text-slate-900" x-text="selectedProduct?.name"></h2>
                    </div>
                    <button type="button" x-on:click="selectedProduct = null" class="text-2xl text-slate-400 hover:text-slate-700" aria-label="Close product details">×</button>
                </div>

                <div class="mt-8 grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl bg-rose-100/50 p-5">
                        <p class="text-sm font-semibold text-rose-600">About this product</p>
                        <p class="mt-3 text-sm leading-6 text-slate-600" x-text="selectedProduct?.details"></p>
                    </div>
                    <div class="rounded-2xl bg-[#ead8bd]/50 p-5">
                        <p class="text-sm font-semibold text-rose-600">Community rating</p>
                        <p class="mt-3 text-2xl font-semibold text-slate-900">★★★★★ <span x-text="selectedProduct?.rating"></span></p>
                        <p class="mt-2 text-sm text-slate-600">Loved by the Beauty Rush community.</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-2xl font-semibold text-slate-900">Reviews</h3>
                    <div class="mt-4 space-y-4">
                        <template x-for="review in selectedProduct?.reviews ?? []" :key="review.reviewer">
                            <article class="rounded-2xl border border-rose-100 bg-white/60 p-5">
                                <div class="flex items-center justify-between gap-4">
                                    <p class="font-semibold text-slate-900" x-text="review.reviewer"></p>
                                    <div class="flex items-center gap-3">
                                        <p class="text-sm font-semibold text-rose-600">★★★★★ <span x-text="review.rating"></span></p>
                                        <form method="POST" action="{{ route('products.reviews.favorite') }}">
                                            @csrf
                                            <input type="hidden" name="review_key" x-bind:value="selectedProduct.name + '|' + review.reviewer">
                                            <button type="submit" class="text-xl text-rose-500 hover:text-rose-700" x-text="favoriteReviews.includes(selectedProduct.name + '|' + review.reviewer) ? '♥' : '♡'" aria-label="Save review"></button>
                                        </form>
                                    </div>
                                </div>
                                <p class="mt-3 text-sm italic leading-6 text-slate-600" x-text="`“${review.text}”`"></p>
                            </article>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-site-layout>
