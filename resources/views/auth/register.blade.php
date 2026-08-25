<x-guest-layout>
    <div class="mx-auto max-w-md">
        <div class="mb-8 space-y-2 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-rose-500">Beauty Rush</p>
            <h1 class="text-3xl font-semibold text-slate-900">Create your account</h1>
            <p class="text-sm text-slate-500">Join our beauty community and save your favorites.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-breeze.input-label for="name" :value="__('Name')" class="font-medium text-slate-700" />
                <x-breeze.text-input id="name" class="mt-2 block w-full rounded-xl border-slate-200 px-4 py-3 focus:border-rose-400 focus:ring-rose-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-breeze.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-breeze.input-label for="email" :value="__('Email')" class="font-medium text-slate-700" />
                <x-breeze.text-input id="email" class="mt-2 block w-full rounded-xl border-slate-200 px-4 py-3 focus:border-rose-400 focus:ring-rose-400" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-breeze.input-label for="password" :value="__('Password')" class="font-medium text-slate-700" />
                <x-breeze.text-input id="password" class="mt-2 block w-full rounded-xl border-slate-200 px-4 py-3 focus:border-rose-400 focus:ring-rose-400" type="password" name="password" required autocomplete="new-password" />
                <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-breeze.input-label for="password_confirmation" :value="__('Confirm Password')" class="font-medium text-slate-700" />
                <x-breeze.text-input id="password_confirmation" class="mt-2 block w-full rounded-xl border-slate-200 px-4 py-3 focus:border-rose-400 focus:ring-rose-400" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-breeze.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between gap-4 pt-2">
                <a class="text-sm font-medium text-rose-600 hover:text-rose-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-breeze.primary-button class="rounded-xl bg-slate-900 px-6 py-3 text-sm hover:bg-rose-600 focus:bg-rose-600 focus:ring-rose-400">
                    {{ __('Register') }}
                </x-breeze.primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
