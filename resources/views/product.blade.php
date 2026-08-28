<x-site-layout>

<!--blok1-->
    <section class="bg-gradient-to-br from-[#d8b28c] via-[#ead8bd] to-[#f7efe3] px-6 py-16 text-slate-900 sm:px-10">
        <div class="mx-auto max-w-6xl space-y-4">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-300">The full edit</p>
            <h1 class="text-4xl font-semibold sm:text-5xl">Find your beauty essentials</h1>
            <p class="max-w-2xl text-lg leading-8 text-slate-700">Explore our community-loved products across complexion, cheeks, eyes, lips, skincare, and tools.</p>
        </div>
    </section>

<!--blok2-->
    <main x-data="{ selectedProduct: null }" class="mx-auto max-w-6xl px-6 py-16 sm:px-10">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <article class="overflow-hidden rounded-3xl border border-rose-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex h-48 items-end justify-between bg-gradient-to-br {{ $product['tone'] }} p-6">
                        <span class="rounded-full bg-white/80 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-rose-700">{{ $product['type'] }}</span>
                        <form method="POST" action="{{ route('products.favorite.toggle', ['product' => $product['name']]) }}">
                            @csrf
                            <button type="submit" class="text-2xl text-rose-500 hover:text-rose-700" aria-label="{{ in_array($product['name'], $favoriteProducts, true) ? 'Remove saved product' : 'Save product' }}">
                                {{ in_array($product['name'], $favoriteProducts, true) ? '♥' : '♡' }}
                            </button>
                        </form>
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

<!--details product-->
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
                                    <p class="text-sm font-semibold text-rose-600">★★★★★ <span x-text="review.rating"></span></p>
                                </div>
                                <p class="mt-3 text-sm italic leading-6 text-slate-600" x-text="`“${review.text}”`"></p>
                            </article>
                        </template>
                    </div>
                    @auth
                        <form method="POST" action="{{ route('products.reviews.store') }}" class="mt-6 grid gap-4 rounded-2xl border border-rose-100 bg-rose-100/30 p-5">
                            @csrf
                            <h4 class="text-lg font-semibold text-slate-900">Write a review</h4>
                            <input type="hidden" name="product_name" x-bind:value="selectedProduct.name">
                            <div>
                                <label for="review-rating" class="text-sm font-medium text-slate-700">Your rating</label>
                                <select id="review-rating" name="rating" required class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400">
                                    <option value="">Choose a rating</option>
                                    <option value="5">5 / 5</option>
                                    <option value="4">4 / 5</option>
                                    <option value="3">3 / 5</option>
                                    <option value="2">2 / 5</option>
                                    <option value="1">1 / 5</option>
                                </select>
                            </div>
                            <div>
                                <label for="review-content" class="text-sm font-medium text-slate-700">Your review</label>
                                <textarea id="review-content" name="content" rows="3" required maxlength="1000" placeholder="What do you think about this product?" class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400"></textarea>
                            </div>
                            <button type="submit" class="justify-self-start rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-rose-600">Publish review</button>
                        </form>
                    @else
                        <p class="mt-6 rounded-2xl bg-rose-100/40 p-5 text-sm text-slate-600">
                            <a href="{{ route('login') }}" class="font-semibold text-rose-600 hover:text-rose-800">Log in</a> to write a review.
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </main>
</x-site-layout>
