<x-site-layout>

    <section class="mx-auto max-w-5xl px-6 py-16 sm:px-10">
        <div class="rounded-3xl border border-rose-100 bg-[#fff8ee] p-8 shadow-sm sm:p-12">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-500">Your space</p>
            <h1 class="mt-3 text-4xl font-semibold text-slate-900">My account</h1>
            <p class="mt-4 max-w-2xl text-lg leading-8 text-slate-600">Manage your profile and keep your Beauty Rush favorites close.</p>
            <a href="{{ route('profile.edit') }}" class="mt-8 inline-flex rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-rose-600">Edit profile</a>
        </div>
    </section>

</x-site-layout>
