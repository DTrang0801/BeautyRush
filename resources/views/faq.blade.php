<x-site-layout>

<!--blok1-->
    <section class="bg-gradient-to-br from-[#d8b28c] via-[#ead8bd] to-[#f7efe3] px-6 py-16 sm:px-10">
        <div class="mx-auto flex max-w-6xl flex-col justify-between gap-6 sm:flex-row sm:items-end">
            <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-700">Need a little guidance?</p>
            <h1 class="mt-3 text-5xl font-semibold text-slate-900">Frequently asked questions</h1>
            <p class="mt-4 max-w-2xl text-lg leading-8 text-slate-700">Find quick answers about Beauty Rush, reviews, and sharing beauty tips.</p>
            </div>
            @auth
                @if (Auth::user()->is_admin)
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.categories.create') }}" class="inline-flex shrink-0 rounded-full border border-slate-900 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-white">Add category</a>
                        <a href="{{ route('admin.faqs.index') }}" class="inline-flex shrink-0 rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-rose-600">Manage FAQs</a>
                    </div>
                @endif
            @endauth
        </div>
    </section>

<!--blok2-->
    <section class="mx-auto max-w-4xl space-y-10 px-6 py-16 sm:px-10">
        @foreach ($categories as $category)
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">{{ $category->name }}</h2>
                <div class="mt-4 divide-y divide-rose-100 rounded-2xl border border-rose-100 bg-[#fff8ee] px-6">
                    @forelse ($category->faqs as $faq)
                        <details class="py-5">
                            <summary class="cursor-pointer text-lg font-medium text-slate-900">{{ $faq->question }}</summary>
                            <p class="mt-3 leading-7 text-slate-600">{{ $faq->answer }}</p>
                        </details>
                    @empty
                        <p class="py-5 text-sm text-slate-500">No questions in this category yet.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </section>
</x-site-layout>
