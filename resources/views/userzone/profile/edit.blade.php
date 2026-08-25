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
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Your profile</p>
                    <p class="mt-3 max-w-2xl text-lg leading-8 text-slate-600">Manage your personal information and keep your Beauty Rush account secure.</p>
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
