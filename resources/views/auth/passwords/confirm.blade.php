@extends('layout')

@section('content')
    <div class="container mx-auto">
        <div class="">
            <div class="bg-primary-card p-6 w-96 mx-auto text-center">
                <div class="flex items-center justify-center mb-5 flex-col space-y-2">
                    @include('svgs',['svg' => 'logo','classes' => 'w-10 h-10 text-primary-accent-sub'])
                    <div class="flex items-center space-x-2">
                        @include('svgs',['svg' => 'lock','classes' => 'w-4 h-4 text-primary-accent-sub'])
                        <p class="text-primary-accent-sub text-sm"><span class="font-semibold">Dota Ideas</span> Auth system</p>

                    </div>
                </div>
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">

                            <x-label for="password" class="text-left" :value="__('Password')"/>
                            <div class="col-md-6">
                                <input id="password" type="password" class="w-full input-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
