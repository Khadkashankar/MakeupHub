@extends('layouts.app')

@section('title')
Register
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
        max-width: 550px;
        margin-left: 13%; /* Centering the container */
        margin-top: 0px;
        height:535px;

       /* Adjust top margin as needed */
        
    }

     .card-header {
        background-color: transparent;
        border-bottom: none;
    }

    .card-header h3 {
        color: #dc3545;
        margin-top: 30px;
    }

    .form-control {
        border-radius: 5px;
    
        color: white; /* Ensuring the text color remains black */
    }
    

    .btn-primary {
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
        margin-top:-3px;
        margin-left:30px;
        
        
        
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
    .dam{
    color: #dc3545;
  
    }
    </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card login-container">
                <div class="card-header h3 text-center dam "> <i class="fas fa-sign-up" aria-hidden="true"></i>Register</div><hr>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="color: white; ">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right" style="color: white; " >{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('name') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="color: white; ">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="color: white; ">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="color: white; ">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right" style="color: white; ">{{ __('What kind of person you are?') }}</label>

                            <div class="form-group">
                            <label for="MakeupType" style="color: black; ">Makeup Type: </label>
                             <div class="makeuptype">
                             <div class="checkbox checkbox-success">
                            <input type="checkbox" id="MakeupType" name="type[]" value="1" > <span class="text-white">Skincare</span>
                                </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" id="MakeupType" name="type[]" value="2"> <span class="text-white">Beauty</span>
                         </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" id="MakeupType" name="type[]" value="3"> <span class="text-white">Haircare</span>
                         </div>
                    </div>
                  </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
