<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
</div>
<x-site-layout>
    <section class="mx-auto max-w-6xl px-6 py-16 sm:px-10">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Administration</p>
                <h1 class="mt-2 text-4xl font-semibold text-slate-900">Manage users</h1>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-rose-600">Add user</a>
        </div>

        @if (session('status'))
            <p class="mt-6 rounded-2xl bg-rose-100/60 p-4 text-sm font-medium text-rose-700">{{ session('status') }}</p>
        @endif

        <div class="mt-8 overflow-hidden rounded-3xl border border-rose-100 bg-[#fff8ee] shadow-sm">
            @foreach ($users as $user)
                <div class="flex flex-col justify-between gap-4 border-b border-rose-100 p-6 last:border-0 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">{{ $user->username ?: $user->name }}</h2>
                        <p class="text-sm text-slate-500">{{ $user->email }}</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $user->is_admin ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-600' }}">{{ $user->is_admin ? 'Admin' : 'User' }}</span>
                        <form method="POST" action="{{ route('admin.users.update', $user) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_admin" value="{{ $user->is_admin ? 0 : 1 }}">
                            <button type="submit" class="text-sm font-semibold text-rose-600 hover:text-rose-800">{{ $user->is_admin ? 'Remove admin' : 'Make admin' }}</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-site-layout>
