@extends('layout')

@section('content')
    <div class="container mx-auto">
        <div class="">
            <div class="bg-primary-card p-6 w-96 mx-auto text-center rounded">
                <div class="mb-5">
                    <div class="flex items-center justify-center mb-5 flex-col space-y-2">
                        @include('svgs',['svg' => 'logo','classes' => 'w-10 h-10 text-primary-accent-sub'])
                        <div class="flex items-center space-x-2">
                            @include('svgs',['svg' => 'lock','classes' => 'w-4 h-4 text-primary-accent-sub'])
                            <p class="text-primary-accent-sub text-sm"><span class="font-semibold">Dota Ideas</span> Auth system</p>

                        </div>
                    </div>
                    <p class="font-semibold text-xl mb-2 ">Password change request</p>
                    <p class="text-sm">Enter your email address below and click the button to receive an email to reset your password.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success mb-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="w-64 mx-auto">
                        <x-label for="password" class="text-left" :value="__('E-mail address')"/>
                        <div>
                            <input id="email" type="email" class="mb-4 w-full input-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class=" mb-2">
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-sm no-animation">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
