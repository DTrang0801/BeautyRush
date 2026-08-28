<x-site-layout>
    <section class="mx-auto max-w-2xl px-6 py-16 sm:px-10">
        <div class="rounded-3xl border border-rose-100 bg-[#fff8ee] p-8 shadow-sm sm:p-10">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Administration</p>
            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Create FAQ</h1>
            <form method="POST" action="{{ route('admin.faqs.store') }}" class="mt-8 grid gap-5">
                @csrf
                <select name="category_id" required class="rounded-xl border-rose-100 bg-white px-4 py-3">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <input name="question" value="{{ old('question') }}" required placeholder="Question" class="rounded-xl border-rose-100 bg-white px-4 py-3">
                <textarea name="answer" required rows="5" placeholder="Answer" class="rounded-xl border-rose-100 bg-white px-4 py-3">{{ old('answer') }}</textarea>
                <button type="submit" class="justify-self-start rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-rose-600">Create FAQ</button>
            </form>
        </div>
    </section>
</x-site-layout>
