<div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
</div>
<x-site-layout>
    <section class="bg-gradient-to-br from-[#d8b28c] via-[#ead8bd] to-[#f7efe3] px-6 py-16 sm:px-10">
        <div class="mx-auto max-w-6xl space-y-4">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-700">From the Beauty Rush community</p>
            <h1 class="text-5xl font-semibold text-slate-900">Tips &amp; Tricks</h1>
            <p class="max-w-2xl text-lg leading-8 text-slate-700">Small ideas and simple techniques to make your everyday beauty routine feel even better.</p>
        </div>
    </section>

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
