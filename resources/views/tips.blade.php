<x-site-layout>
    <section class="bg-gradient-to-br from-[#d8b28c] via-[#ead8bd] to-[#f7efe3] px-6 py-16 sm:px-10">
        <div class="mx-auto max-w-6xl space-y-4">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-700">From the Beauty Rush community</p>
                <h1 class="text-5xl font-semibold text-slate-900">Tips &amp; Tricks</h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-700">Small ideas and simple techniques to make your everyday beauty routine feel even better.</p>
        </div>
    </section>
    
    <section class="border-b border-rose-100 bg-[#fff8ee] px-6 py-16 sm:px-10">
        <div class="rounded-3xl bg-[#fff8ee]/80 p-6 shadow-lg shadow-rose-200/30 sm:p-8">
            @auth
                <p class="text-sm font-semibold uppercase tracking-widest text-rose-600">Share your knowledge</p>
                <h2 class="mt-3 text-2xl font-semibold text-slate-900">Add a tip or trick</h2>
                <form method="POST" action="{{ route('account.tips.store') }}" class="mt-5 grid gap-4">
                    @csrf
                    <input name="title" type="text" required maxlength="120" placeholder="Tip title" class="rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400">
                    <textarea name="content" rows="3" required maxlength="1000" placeholder="Share your beauty tip..." class="rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400"></textarea>
                    <button type="submit" class="justify-self-start rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Add tip</button>
                </form>
            @else
                <p class="text-sm font-semibold uppercase tracking-widest text-rose-600">Join the community</p>
                <h2 class="mt-3 text-2xl font-semibold text-slate-900">Have a tip to share?</h2>
                <p class="mt-3 text-sm leading-6 text-slate-600">Log in to share your own beauty knowledge with other Beauty Rush members.</p>
                <a href="{{ route('login') }}" class="mt-5 inline-flex rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Log in to share</a>
            @endauth
        </div>

    <section class="mx-auto max-w-6xl px-6 py-16 sm:px-10">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($tips as $tip)
                <article class="rounded-3xl border border-rose-100 bg-[#fff8ee] p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <p class="text-3xl text-rose-400">✦</p>
                    <h2 class="mt-5 text-2xl font-semibold text-slate-900">{{ $tip->title }}</h2>
                    <p class="mt-4 leading-7 text-slate-600">{{ $tip->content }}</p>
                </article>
            @endforeach
        </div>
    </section>
</x-site-layout>
