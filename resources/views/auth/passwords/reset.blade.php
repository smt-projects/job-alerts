@extends('layouts.app')

@section('content')
<section class="password_changeForm__page">
<div class="container changePassword_form">
    <div class="text-center logo__section">
        <img src="{!! asset('theme/dist/img/logo.png') !!}" class="img-fluid">
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5 col-sm-6 text-right imgBox">
            <img src="{!! asset('theme/dist/img/change-password.png') !!}" class="img-fluid">
        </div>
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 formGroup__section">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('change password') }}</h2>
                    <p class="text-center">You are only one step a way from your new password, recover your password now.</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required placeholder="Email Address">
                            <span class="inputFeild__icons"><i class="icon-login"></i></span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-Password" placeholder="Password">
                            <span class="inputFeild__icons"><i class="icon-password"></i></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-Enter-Password">
                            <span class="inputFeild__icons"><i class="icon-password"></i></span>
                        </div>
                        <div class="bgn__group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Change Password') }}
                            </button>
                        </div>
                    </form>
                    <div class="content__section">
                        <p class="text-center">Already have an account <a href="#">Login Now</a></p>
                    </div>
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
