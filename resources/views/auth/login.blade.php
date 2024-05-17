@extends('layouts.app')

@section('title')
Login
@endsection

@section('content')
<style>
    body {
        background-image: url("https://images.unsplash.com/photo-1669811247691-f59af80a9974?q=80&w=2625&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .login-container {
        background-color: rgba(1, 1, 1, 0.2);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(244, 1, 23, 0.5);
        max-width: 500px;
        margin-left: 16%; /* Centering the container */
        margin-top: 100px; /* Adjust top margin as needed */
    }

    .card-header {
        background-color: transparent;
        border-bottom: none;
    }

    .card-header h3 {
        color: #dc3545;
        margin-bottom: 0;
    }

    .form-control {
        border-radius: 5px;
        color: white; /* Ensuring the text color remains black */
    }

    .btn-primary {
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #c82333;
    }

    .btn-link {
        color: #000; /* Changed link color to black */
    }

    hr {
        border-top: 2px solid #dc3545;
        margin-top: 20px;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card login-container">
                <div class="card-header text-center">
                    <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
                </div>
                <hr>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right emails" style="color: white;">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right passwords" style="color: white;">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color: white;">
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
</div>
@endsection
