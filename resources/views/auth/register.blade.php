@extends('layouts.auth')

@section('content')
<p class="login-box-msg">Register a new membership</p>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="input-group mb-3">
        <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror"
            name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus
            placeholder="First Name">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
            value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Last Name">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password" placeholder="Retype password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Register') }}
            </button>
        </div>
    <a href="{{route('login')}}" class="text-center mt-5">I already have a membership</a>
</form>
@endsection