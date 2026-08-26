<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-slate-900">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-3xl border border-rose-100 bg-[#fff8ee] shadow-sm">
                <div class="border-b border-rose-100 bg-gradient-to-br from-rose-100/70 via-[#fff8ee] to-[#ead8bd]/50 px-6 py-8 sm:px-10">
                    <div class="flex items-center gap-5">
                        <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-full bg-rose-100 ring-4 ring-white/70">
                            @if ($user->profile_photo_path)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($user->profile_photo_path) }}" alt="{{ $user->username ?: $user->name }}'s profile photo" class="h-full w-full object-cover">
                            @else
                                <img src="{{ asset('images/logo-transparent.png') }}" alt="Beauty Rush profile photo" class="h-20 w-20 object-contain">
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Your profile</p>
                            <h1 class="mt-2 text-3xl font-semibold text-slate-900 sm:text-4xl">{{ $user->username ?: $user->name }}</h1>
                            <p class="mt-1 text-slate-600">{{ $user->name }} · {{ $user->email }}</p>
                        </div>
                    </div>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">Manage your personal information and keep your Beauty Rush account secure.</p>
                </div>

                <div class="divide-y divide-rose-100 px-6 sm:px-10">
                    <div class="py-8">
                        <div class="max-w-xl">
                            @include('userzone.profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="py-8">
                        <div class="max-w-xl">
                            @include('userzone.profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="py-8">
                        <div class="max-w-xl">
                            @include('userzone.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
