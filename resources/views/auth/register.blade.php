@extends('layout')
@section('content')
    <x-auth-card>
        <div class="flex items-center justify-center mb-5 flex-col space-y-2">
            @include('svgs',['svg' => 'logo','classes' => 'w-10 h-10 text-primary-accent'])
            <div class="flex items-center space-x-2">
                @include('svgs',['svg' => 'lock','classes' => 'w-4 h-4 text-primary-accent'])
                <p class="text-primary-accent text-sm"><span class="font-semibold">Dota Ideas</span> Auth system</p>

            </div>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <div class="flex items-center justify-center flex-col space-y-4">
            <p>Sign up with</p>
            <div class="flex items-center justify-center space-x-4">
                <x-di-button type="button" :icon="'google'">Google</x-di-button>
                <x-di-button type="button" :icon="'steam'">Steam</x-di-button>
            </div>
        </div>
        <hr class="w-full border-primary-accent-sub my-8">

        <p class="text-center mb-2">Or create your account</p>
        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')"/>

                <x-input id="name" class="block mt-1 w-full input-sm" type="text" name="name" :value="old('name')" required autofocus/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full input-sm" type="email" name="email" :value="old('email')" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')"/>

                <x-input id="password" class="block mt-1 w-full input-sm"
                         type="password"
                         name="password"
                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full input-sm"
                         type="password"
                         name="password_confirmation" required/>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-a-link href="{{ route('login') }}">{{ __('Already registered?') }}</x-a-link>
                <x-di-button class="ml-3" :icon="''" type="submit">
                    {{ __('Register') }}
                </x-di-button>

            </div>
        </form>
    </x-auth-card>

@endsection