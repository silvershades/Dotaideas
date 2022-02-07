@extends('layout')

@section('content')
    <x-auth-card>


                <div id="g_id_onload"
                     data-client_id="24038801474-8438smgdoc9g13ar1vlbpg1t8q6r7kjm.apps.googleusercontent.com"
                     data-context="signin"
                     data-ux_mode="popup"
                     data-login_uri="http://localhost/auth/google/callback"
                     data-auto_select="false"
                     data-_token="{{ csrf_token() }}"
                >
                </div>


        <div class="flex items-center justify-center mb-5 flex-col space-y-2">
            @include('svgs',['svg' => 'logo','classes' => 'w-10 h-10 text-primary-accent'])
            <div class="flex items-center space-x-2">
                @include('svgs',['svg' => 'lock','classes' => 'w-4 h-4 text-primary-accent'])
                <p class="text-primary-accent text-sm"><span class="font-semibold">Dota Ideas</span> Auth system</p>

            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4 bg-red-100 rounded p-6" :errors="$errors"/>
        <div class="flex items-center justify-center flex-col space-y-4">
            <p>Log in with</p>
            <div class="flex items-center justify-center flex-col space-y-4">
                <div class="g_id_signin"
                     data-type="standard"
                     data-shape="pill"
                     data-theme="filled_blue"
                     data-text="continue_with"
                     data-size="large"
                     data-logo_alignment="left">
                </div>
                <x-a-button href="{{route('auth.steam')}}" :icon="'steam'">Steam</x-a-button>
            </div>
        </div>
        <hr class="w-full border-primary-accent-sub my-8">
        <p class="text-center mb-2">Or with your account</p>
        <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full input-sm" type="email" name="email" :value="old('email')" required autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')"/>

                <x-input id="password" class="block mt-1 w-full input-sm"
                         type="password"
                         name="password"
                         required autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="text-primary-accent bg-stone-600 checkbox-sm rounded" name="remember">
                    <span class="ml-2 text-sm text-primary-text">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <x-a-link href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</x-a-link>

                @endif

                <x-di-button class="ml-3" :icon="''" type="submit">
                    {{ __('Log in') }}
                </x-di-button>
            </div>
        </form>
    </x-auth-card>
@endsection
