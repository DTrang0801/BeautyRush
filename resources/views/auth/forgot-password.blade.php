<x-guest-layout>
    <div class="mx-auto max-w-md">
        <div class="mb-8 space-y-2 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Beauty Rush</p>
            <h1 class="text-3xl font-semibold text-slate-900">Reset your password</h1>
            <p class="text-sm leading-6 text-slate-500">Enter your email and we will send you a secure link to choose a new password.</p>
        </div>

        <x-breeze.auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <x-breeze.input-label for="email" :value="__('Email address')" class="font-medium text-slate-700" />
                <x-breeze.text-input id="email" class="mt-2 block w-full rounded-xl border-slate-200 px-4 py-3 focus:border-rose-400 focus:ring-rose-400" type="email" name="email" :value="old('email')" required autofocus />
                <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <x-breeze.primary-button class="w-full justify-center rounded-xl bg-slate-900 py-3 text-sm hover:bg-rose-600 focus:bg-rose-600 focus:ring-rose-400">
                {{ __('Email Password Reset Link') }}
            </x-breeze.primary-button>
        </form>
    </div>
</x-guest-layout>
