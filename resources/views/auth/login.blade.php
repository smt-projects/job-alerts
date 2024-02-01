@extends('layouts.app')

@section('content')
<section class="loginForm__page">
<div class="container loginForm">
    <div class="text-center logo__section">
        <img src="{!! asset('theme/dist/img/logo.png') !!}" class="img-fluid">
    </div>
    <div class="row d-flex justify-content-center align-items-center pb-sm-5">
        <div class="col-md-6 col-sm-6 text-right imgBox">
            <img src="{!! asset('theme/dist/img/admin-login-img.png') !!}" class="img-fluid">
        </div>
        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6 formGroup__section">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('Admin Login') }}</h2>
                    <p class="text-center">Sign In To Start Your Session</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Id" autofocus>
                            <!-- <span><i class="far fa-envelope"></i></span> -->
                            <span class="inputFeild__icons"><i class="icon-login"></i></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            <span class="inputFeild__icons"><i class="icon-password"></i></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="bgn__group">
                            <button type="submit" class="btn">
                                {{ __('Sign Now') }}
                            </button>
                        </div>
                        <div class="form-check float-left">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="forget-group float-right">
                            @if (Route::has('password.request'))
                                <a class="btn_link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
</section>
<section>
    <div class="footer__section">
        <p class="text-center">Copyright 2022 <a href="#">VanderHouwen </a>- All Rights Reserved</p>
    </div>
</section>
@endsection

