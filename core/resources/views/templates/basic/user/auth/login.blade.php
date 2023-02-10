@extends($activeTemplate.'layouts.app')
@section('app')
@php
$login = getContent('login.content',true);
@endphp

<body class="body-scroll d-flex flex-column h-100 menu-overlay">




    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">

        <!-- Fixed navbar -->
        <header class="header">
            <div class="row">
                <div class="col-auto px-0">
                    <button class="menu-btn btn btn-40 btn-link back-btn" type="button">
                        <span class="material-icons">keyboard_arrow_left</span>
                    </button>
                </div>
                <div class="text-left col align-self-center">
                   
                </div>
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{ route('user.register') }}" class="text-white">
                        Sign up
                    </a>
                </div>
            </div>
        </header>
        
    <form method="POST" action="{{ route('user.login')}}" class="login-form mt-50 verify-gcaptcha">
        @csrf
            <div class="container h-100 text-white">
                <div class="row h-100">
                    <div class="col-12 align-self-center mb-4">
                        <div class="row justify-content-center">
                            <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                                <h2 class="font-weight-normal mb-5">Login into<br>your account</h2>
                                <div class="form-group float-label active">
                                    <input type="text" class="form-control text-white" value="{{ old('username') }}" name="username" required>
                                    <label class="form-control-label text-white">Username/Email</label>
                                </div>
                                <div class="form-group float-label position-relative">
                                    <input type="password" class="form-control text-white" name="password" required>
                                    <label class="form-control-label text-white">Password</label>
                                </div>  
                                <p class="text-right"><a href="{{ route('user.password.request') }}" class="text-white">Forgot Password?</a></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </main>

        <!-- footer-->
        <div class="footer no-bg-shadow py-3">
            <div class="row justify-content-center">
                <div class="col">
                    <button type="submit" id="recaptcha" class="btn btn-default rounded btn-block">@lang('Login Now')</button>
                </div>
            </div>
        </div>

    </form>

    
</body>





{{-- <section class="login-section bg_img" style="background-image: url( {{ getImage('assets/images/frontend/login/' . @$login->data_values->image, '1920x1280') }} );">
    <div class="login-area">
        <div class="login-area-inner">
            <div class="text-center">
                <a class="site-logo mb-4" href="{{ route('home') }}">
                    <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="site-logo">
                </a>
                <h2 class="title mb-2">{{ __(@$login->data_values->title) }}</h2>
                <p>{{ __(@$login->data_values->subtitle) }}</p>
            </div>
            <form method="POST" action="{{ route('user.login')}}" class="login-form mt-50 verify-gcaptcha">
                @csrf
                <div class="form-group">
                    <label>@lang('Username or Email')</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="las la-user"></i></div>
                        <input type="text" class="form-control" value="{{ old('username') }}" name="username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>@lang('Password')</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="las la-key"></i></div>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <x-captcha />

                <div class="mt-5">
                    <button type="submit" id="recaptcha" class="cmn-btn rounded-0 w-100">@lang('Login Now')</button>
                    <div class="mt-20 d-flex flex-wrap justify-content-between">
                        @if ($general->registration)
                        <p>@lang("Haven't an account?") <a href="{{ route('user.register') }}" class="text--base">@lang('Create an account')</a></p>
                        @endif
                        <p><a href="{{ route('user.password.request') }}" class="text--base">@lang('Forget password?')</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section> --}}


@endsection
