<x-site-layout>
    <section class="mx-auto max-w-4xl px-6 py-16 sm:px-10">
        <div class="overflow-hidden rounded-3xl border border-rose-100 bg-[#fff8ee] shadow-sm">
            <div class="bg-gradient-to-br from-[#d8b28c] via-[#ead8bd] to-[#f7efe3] px-8 py-10 sm:px-12">
                <div class="flex flex-col items-start gap-6 sm:flex-row sm:items-center">
                    <div class="flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-full bg-rose-100 ring-4 ring-white/70">
                        @if ($user->profile_photo_path)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($user->profile_photo_path) }}" alt="{{ $user->username ?: $user->name }}'s profile photo" class="h-full w-full object-cover">
                        @else
                            <img src="{{ asset('images/logo-transparent.png') }}" alt="Beauty Rush profile photo" class="h-24 w-24 object-contain">
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-800">Beauty Rush member</p>
                        <h1 class="mt-2 text-4xl font-semibold text-slate-900">{{ $user->username ?: $user->name }}</h1>
                        <p class="mt-2 text-slate-700">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="space-y-6 px-8 py-10 sm:px-12">
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900">About me</h2>
                    <p class="mt-3 leading-7 text-slate-600">{{ $user->about ?: 'This member has not added an about me text yet.' }}</p>
                </div>
                @if ($user->birthday)
                    <div class="border-t border-rose-100 pt-6">
                        <h2 class="text-lg font-semibold text-slate-900">Birthday</h2>
                        <p class="mt-2 text-slate-600">{{ $user->birthday->format('F j, Y') }}</p>
                    </div>
                @endif
                <div class="grid gap-8 border-t border-rose-100 pt-6 lg:grid-cols-2">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">Reviews</h2>
                        <div class="mt-4 space-y-4">
                            @forelse ($user->reviews as $review)
                                <article class="rounded-2xl border border-rose-100 bg-white/60 p-5">
                                    <div class="flex items-center justify-between gap-4">
                                        <h3 class="font-semibold text-slate-900">{{ $review->product_name }}</h3>
                                        <span class="text-sm font-semibold text-rose-600">★★★★★ {{ $review->rating }}/5</span>
                                    </div>
                                    <p class="mt-3 text-sm italic leading-6 text-slate-600">“{{ $review->content }}”</p>
                                </article>
                            @empty
                                <p class="text-sm text-slate-500">This member has not shared a review yet.</p>
                            @endforelse
                        </div>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">Beauty tips</h2>
                        <div class="mt-4 space-y-4">
                            @forelse ($user->tips as $tip)
                                <article class="rounded-2xl border border-rose-100 bg-rose-100/40 p-5">
                                    <h3 class="font-semibold text-slate-900">{{ $tip->title }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $tip->content }}</p>
                                </article>
                            @empty
                                <p class="text-sm text-slate-500">This member has not shared a beauty tip yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-site-layout>
