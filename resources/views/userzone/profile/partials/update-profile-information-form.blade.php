<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-breeze.input-label for="username" :value="__('Username')" />
            <x-breeze.text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" autocomplete="nickname" />
            <x-breeze.input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-breeze.input-label for="name" :value="__('Name')" />
            <x-breeze.text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-breeze.input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-breeze.input-label for="birthday" :value="__('Birthday')" />
            <x-breeze.text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', optional($user->birthday)->format('Y-m-d'))" />
            <x-breeze.input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-breeze.input-label for="profile_photo" :value="__('Profile photo')" />
            <input id="profile_photo" name="profile_photo" type="file" accept="image/*" class="mt-1 block w-full text-sm text-slate-600">
            <x-breeze.input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-breeze.input-label for="about" :value="__('About me')" />
            <textarea id="about" name="about" rows="4" maxlength="1000" class="mt-1 block w-full rounded-xl border-slate-200 bg-[#fffaf3] focus:border-rose-400 focus:ring-rose-400">{{ old('about', $user->about) }}</textarea>
            <x-breeze.input-error class="mt-2" :messages="$errors->get('about')" />
        </div>

        <div>
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-breeze.input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-breeze.primary-button>{{ __('Save') }}</x-breeze.primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
