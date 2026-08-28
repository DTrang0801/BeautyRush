<x-site-layout>
    <section class="mx-auto max-w-6xl px-6 py-16 sm:px-10">
        <div class="flex items-end justify-between gap-4">
        <div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Administration</p>
                <h1 class="mt-2 text-4xl font-semibold text-slate-900">Manage FAQs</h1>
            </div>
            <a href="{{ route('admin.faqs.create') }}" class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-rose-600">Add FAQ</a>
        </div>
        <div class="mt-8 space-y-4">
            @foreach ($faqs as $faq)
                <article class="rounded-2xl border border-rose-100 bg-[#fff8ee] p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-rose-500">{{ $faq->category->name }}</p>
                            <h2 class="mt-2 text-xl font-semibold text-slate-900">{{ $faq->question }}</h2>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-sm font-semibold text-rose-600">Edit</a>
                            <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm font-semibold text-red-600" onclick="return confirm('Delete this FAQ?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    <p class="mt-3 leading-7 text-slate-600">{{ $faq->answer }}</p>
                </article>
            @endforeach
        </div>
    </section>
</x-site-layout>
