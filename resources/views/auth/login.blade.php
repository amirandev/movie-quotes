@extends('layouts.secondary',['pagetitle' => __('main.loginToDashboard')])
@section('content')
    <h1 class="p-3 pb-0 m-auto text-center mt-4 mb-4">{{ __('main.loginToDashboard') }}</h1>

    <div class="p-5 pt-2">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('auth.email') }}</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="{{ __('auth.email') }}..." required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('auth.password') }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{ __('auth.password') }}..." required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('auth.remember_me') }}
                </label>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-gtu p-9-15">
                    {{ __('auth.login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link2" href="{{ route('password.request') }}">
                        {{ __('auth.forget_password') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
@endsection
