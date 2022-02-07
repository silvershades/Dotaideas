@extends('layout')

@section('content')
    <div class="container mx-auto">
        <div class="bg-primary-card p-6 w-96 mx-auto text-center rounded">
            <div class="flex items-center justify-center mb-5 flex-col space-y-2">
                @include('svgs',['svg' => 'logo','classes' => 'w-10 h-10 text-primary-accent-sub'])
                <div class="flex items-center space-x-2">
                    @include('svgs',['svg' => 'lock','classes' => 'w-4 h-4 text-primary-accent-sub'])
                    <p class="text-primary-accent-sub text-sm"><span class="font-semibold">Dota Ideas</span> Auth system</p>

                </div>
            </div>
            <div class="">Reset your password</div>

            <div class="">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">

                        <x-label for="email" class="text-left" :value="__('E-mail address')"/>
                        <div class="col-md-6">
                            <input id="email" type="email" class="w-full input-sm @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <x-label for="password" class="text-left" :value="__('Password')"/>
                        <div class="col-md-6">
                            <input id="password" type="password" class="w-full input-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <x-label for="password-confirm" class="text-left" :value="__('Confirm Password')"/>

                        <div class="">
                            <input id="password-confirm" type="password" class="w-full input-sm" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-sm no-animation">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
