<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
</div>
<x-site-layout>
    <section class="mx-auto max-w-2xl px-6 py-16 sm:px-10">
        <div class="rounded-3xl border border-rose-100 bg-[#fff8ee] p-8 shadow-sm sm:p-10">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Administration</p>
            <h1 class="mt-2 text-3xl font-semibold text-slate-900">Create user</h1>
            <form method="POST" action="{{ route('admin.users.store') }}" class="mt-8 grid gap-5">
                @csrf
                <div><label for="name" class="text-sm font-medium text-slate-700">Name</label><input id="name" name="name" value="{{ old('name') }}" required class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400"></div>
                <div><label for="username" class="text-sm font-medium text-slate-700">Username</label><input id="username" name="username" value="{{ old('username') }}" class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400"></div>
                <div><label for="email" class="text-sm font-medium text-slate-700">Email</label><input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400"></div>
                <div><label for="password" class="text-sm font-medium text-slate-700">Password</label><input id="password" name="password" type="password" required class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400"></div>
                <div><label for="password_confirmation" class="text-sm font-medium text-slate-700">Confirm password</label><input id="password_confirmation" name="password_confirmation" type="password" required class="mt-2 block w-full rounded-xl border-rose-100 bg-white px-4 py-3 focus:border-rose-400 focus:ring-rose-400"></div>
                <label class="flex items-center gap-3 text-sm text-slate-700"><input type="checkbox" name="is_admin" value="1" class="rounded border-rose-200 text-rose-600 focus:ring-rose-400"> Give admin rights</label>
                <button type="submit" class="justify-self-start rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-rose-600">Create user</button>
            </form>
        </div>
    </section>
</x-site-layout>
