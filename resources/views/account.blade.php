<x-site-layout>

    <section class="mx-auto max-w-5xl px-6 py-16 sm:px-10">
        <div class="space-y-3">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-500">Your space</p>
            <h1 class="text-4xl font-semibold text-slate-900">Account Settings</h1>
            <p class="max-w-2xl text-lg leading-8 text-slate-600">Manage your profile, security, and Beauty Rush experience in one place.</p>
        </div>

        <div class="space-y-8 rounded-3xl border border-rose-100 bg-[#fff8ee] p-8 shadow-sm sm:p-12">
                <div class="flex flex-col items-start justify-between gap-6 rounded-3xl border border-rose-100 bg-white/60 p-6 sm:flex-row sm:items-center">
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

                <div class="rounded-2xl bg-rose-100/60 p-5">
                    <p class="text-sm font-semibold text-slate-900">Your Beauty Rush space</p>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Save your favorite discoveries and share your beauty experiences with the community.</p>
                </div>
        </div>
    </section>

</x-site-layout>
