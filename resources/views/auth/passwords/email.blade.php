@extends('layouts.app')

@section('content')
<section class="forgotForm__page">
<div class="container forgotForm">
    <div class="text-center logo__section">
        <img src="{!! asset('theme/dist/img/logo.png') !!}" class="img-fluid">
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4 col-sm-6 text-right imgBox">
            <img src="{!! asset('theme/dist/img/forgot-password.png') !!}" class="img-fluid">
        </div>
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6  formGroup__section">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('forgot your password') }}</h2>
                    <p class="text-center">Here you can easily retrieve a new password.</p>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                            <span class="inputFeild__icons"><i class="icon-login"></i></span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="bgn__group">
                            <button type="submit" class="btn">
                                {{ __('Submit Now') }}
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
