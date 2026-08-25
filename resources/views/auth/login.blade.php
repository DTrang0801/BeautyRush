<x-guest-layout>
    <div class="grid min-h-[34rem] md:grid-cols-2">
        <div class="flex flex-col justify-between bg-slate-900 p-8 text-white sm:p-12">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-300">Beauty Rush</p>
                <h1 class="mt-8 max-w-sm text-4xl font-semibold leading-tight sm:text-5xl">Your beauty routine, beautifully simple.</h1>
                <p class="mt-6 max-w-sm leading-7 text-slate-300">Discover trusted products, honest reviews, and inspiration made for your everyday glow.</p>
            </div>
            <p class="mt-12 text-sm text-slate-400">Curated with care for beauty lovers.</p>
        </div>

        <div class="flex flex-col justify-center px-6 py-10 sm:px-12">
            <div class="mb-8 space-y-2">
                <h2 class="text-3xl font-semibold text-slate-900">Welcome back! Please login to your account.</h2>
                <p class="text-sm text-slate-500">Sign in to continue your beauty journey.</p>
            </div>

            <x-breeze.auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <x-breeze.input-label for="email" :value="__('Email address')" class="font-medium text-slate-700" />
                    <x-breeze.text-input id="email" class="mt-2 block w-full border-0 border-b-2 border-slate-200 bg-transparent px-1 py-3 shadow-none focus:border-rose-400 focus:ring-0" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-breeze.input-label for="password" :value="__('Password')" class="font-medium text-slate-700" />
                    <x-breeze.text-input id="password" class="mt-2 block w-full border-0 border-b-2 border-slate-200 bg-transparent px-1 py-3 shadow-none focus:border-rose-400 focus:ring-0" type="password" name="password" required autocomplete="current-password" />
                    <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between gap-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-rose-600 shadow-sm focus:ring-rose-500" name="remember">
                        <span class="ms-2 text-sm text-slate-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-rose-600 hover:text-rose-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-breeze.primary-button class="w-full justify-center rounded-xl bg-slate-900 py-3 text-sm hover:bg-rose-600 focus:bg-rose-600 focus:ring-rose-400">
                    {{ __('Log in') }}
                </x-breeze.primary-button>

                <p class="pt-2 text-center text-sm text-slate-500">
                    New to Beauty Rush?
                    <a href="{{ route('register') }}" class="font-semibold text-rose-600 hover:text-rose-800">Sign up here</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
