<x-site-layout>

    <section class="mx-auto max-w-5xl px-6 py-16 sm:px-10">
        <div class="space-y-3">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-500">Your space</p>
            <h1 class="text-4xl font-semibold text-slate-900">Account Settings</h1>
            <p class="text-lg leading-8 text-slate-600 sm:whitespace-nowrap">Save your favorite discoveries and share your beauty experiences with the community.</p>
        </div>

        <div class="space-y-8 rounded-3xl border border-rose-100 bg-[#fff8ee] p-8 shadow-sm sm:p-12">
                <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-center">
                    <div class="flex items-center gap-5">
                        <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-full bg-rose-100 ring-4 ring-rose-50">
                            <img src="{{ asset('images/logo-transparent.png') }}" alt="Profile photo" class="h-20 w-20 object-contain">
                        </div>
                        <div>
                            @auth
                                <h2 class="text-2xl font-semibold text-slate-900">{{ Auth::user()->name }}</h2>
                                <p class="mt-1 text-slate-500">{{ Auth::user()->email }}</p>
                            @else
                                <h2 class="text-2xl font-semibold text-slate-900">Your profile</h2>
                                <p class="mt-1 text-slate-500">Log in to see your account details.</p>
                            @endauth
                        </div>
                    </div>
                    @auth
                        <a href="{{ route('profile.edit') }}" class="inline-flex shrink-0 rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Edit profile</a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex shrink-0 rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Log in</a>
                    @endauth
                </div>
                <div x-data="{ page: 0, totalPages: {{ max(1, (int) ceil($communityTips->count() / 3)) }}, editingTip: null }">
                        <div class="flex items-center justify-between gap-4">
                            <h2 class="text-2xl font-semibold text-slate-900">Your beauty tips</h2>
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-slate-500">{{ count($communityTips) }} shared</span>
                                @if ($communityTips->count() > 3)
                                    <button type="button" x-on:click="if (page > 0) page--" x-bind:disabled="page === 0" class="flex h-8 w-8 items-center justify-center rounded-full bg-rose-100 text-rose-600 transition hover:bg-rose-200 disabled:cursor-not-allowed disabled:opacity-40" aria-label="Show previous beauty tips">
                                        <span>←</span>
                                    </button>
                                    <button type="button" x-on:click="if (page < totalPages - 1) page++" x-bind:disabled="page === totalPages - 1" class="flex h-8 w-8 items-center justify-center rounded-full bg-rose-100 text-rose-600 transition hover:bg-rose-200 disabled:cursor-not-allowed disabled:opacity-40" aria-label="Show next beauty tips">
                                        <span>→</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 space-y-4">
                            @foreach ($communityTips as $tip)
                                <article x-show="{{ $loop->index }} >= page * 3 && {{ $loop->index }} < (page + 1) * 3" x-cloak class="rounded-2xl border border-rose-100 bg-rose-100/40 p-5">
                                    <div class="flex items-start justify-between gap-4">
                                        <h3 class="font-semibold text-slate-900">{{ $tip['title'] }}</h3>
                                        @if ($tip['editable'] ?? false)
                                            <button type="button" x-on:click="editingTip = { id: {{ $tip['id'] }}, title: @js($tip['title']), content: @js($tip['text']) }" class="shrink-0 text-sm font-semibold text-rose-600 hover:text-rose-800">Edit</button>
                                        @endif
                                    </div>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $tip['text'] }}</p>
                                    <p class="mt-4 text-xs font-semibold uppercase tracking-wider text-rose-500">Shared by {{ $tip['author'] ?? 'Beauty Rush community' }}</p>
                                </article>
                            @endforeach
                        </div>

                        <div x-show="editingTip" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 px-6 py-8" x-on:click.self="editingTip = null">
                            <div class="w-full max-w-lg rounded-3xl bg-[#fff8ee] p-6 shadow-2xl sm:p-8">
                                <div class="flex items-center justify-between gap-4">
                                    <h3 class="text-2xl font-semibold text-slate-900">Edit beauty tip</h3>
                                    <button type="button" x-on:click="editingTip = null" class="text-2xl text-slate-400 hover:text-slate-700" aria-label="Close edit window">×</button>
                                </div>
                                <form method="POST" x-bind:action="'/account/tips/' + editingTip.id" class="mt-6 grid gap-4">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="edit-tip-title" class="text-sm font-medium text-slate-700">Title</label>
                                        <input id="edit-tip-title" name="title" type="text" x-model="editingTip.title" required maxlength="120" class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400">
                                    </div>
                                    <div>
                                        <label for="edit-tip-content" class="text-sm font-medium text-slate-700">Your tip</label>
                                        <textarea id="edit-tip-content" name="content" rows="4" x-model="editingTip.content" required maxlength="1000" class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400"></textarea>
                                    </div>
                                    <div class="flex justify-end gap-3 pt-2">
                                        <form method="POST" x-bind:action="'/account/tips/' + editingTip.id" onsubmit="return confirm('Delete this beauty tip?')" class="mr-auto">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full px-5 py-3 text-sm font-semibold text-red-600 hover:bg-red-50">Delete tip</button>
                                        </form>
                                        <button type="button" x-on:click="editingTip = null" class="rounded-full px-5 py-3 text-sm font-semibold text-slate-600 hover:bg-rose-100">Cancel</button>
                                        <button type="submit" class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-rose-600">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <div x-data="{ page: 0, totalPages: {{ max(1, (int) ceil(count($savedTips) / 3)) }} }">
                    <div class="flex items-center justify-between gap-4">
                        <h2 class="text-2xl font-semibold text-slate-900">Saved tips</h2>
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-slate-500">{{ count($savedTips) }} saved</span>
                            @if (count($savedTips) > 3)
                                <button type="button" x-on:click="page = (page + 1) % totalPages" class="flex h-8 w-8 items-center justify-center rounded-full bg-rose-100 text-rose-600 transition hover:bg-rose-200" aria-label="Show next saved tips">
                                    <span>→</span>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 grid gap-4 md:grid-cols-3">
                        @foreach ($savedTips as $savedTip)
                            <article x-show="{{ $loop->index }} >= page * 3 && {{ $loop->index }} < (page + 1) * 3" x-cloak class="rounded-2xl border border-rose-100 bg-[#ead8bd]/40 p-5">
                                <p class="text-lg text-rose-500">♡</p>
                                <h3 class="mt-3 font-semibold text-slate-900">{{ $savedTip['title'] }}</h3>
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ $savedTip['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ page: 0, totalPages: {{ max(1, (int) ceil(count($reviews) / 3)) }} }">
                    <div class="flex items-center justify-between gap-4">
                        <h2 class="text-2xl font-semibold text-slate-900">My reviews</h2>
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-slate-500">{{ count($reviews) }} shared</span>
                            @if (count($reviews) > 3)
                                <button type="button" x-on:click="page = (page + 1) % totalPages" class="flex h-8 w-8 items-center justify-center rounded-full bg-rose-100 text-rose-600 transition hover:bg-rose-200" aria-label="Show next reviews">
                                    <span>→</span>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        @foreach ($reviews as $review)
                                <article x-show="{{ $loop->index }} >= page * 3 && {{ $loop->index }} < (page + 1) * 3" x-cloak class="rounded-2xl border border-rose-100 bg-white/60 p-5">
                                    <div class="flex items-center justify-between gap-4">
                                        <h3 class="font-semibold text-slate-900">{{ $review['product'] }}</h3>
                                        <span class="text-sm font-semibold text-rose-600">★★★★★ {{ $review['rating'] }}</span>
                                    </div>
                                    <p class="mt-3 text-sm italic leading-6 text-slate-600">“{{ $review['text'] }}”</p>
                                    @if ($review['editable'] ?? false)
                                        <form method="POST" action="{{ route('account.reviews.destroy', ['review' => $review['id']]) }}" class="mt-4 flex justify-end" onsubmit="return confirm('Delete this review?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-semibold text-rose-600 hover:text-rose-800">Delete review</button>
                                        </form>
                                    @endif
                                </article>
                        @endforeach
                    </div>
                </div>
        </div>
    </section>

</x-site-layout>
