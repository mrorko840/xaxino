@extends($activeTemplate.'layouts.frontend')
@section('content')

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
                    <a href="{{ route('user.login') }}" class="text-white">
                        Sign In
                    </a>
                </div>
            </div>
        </header>
        
        <form method="POST" action="{{ route('user.password.email') }}">
            @csrf
            <div class="container h-100 text-white">
                <div class="row h-100">
                    <div class="col-12 align-self-center mb-4">
                        <div class="row justify-content-center">
                            <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                                <h2 class="font-weight-normal mb-3">Forgot<br>your password?</h2>
                                <p class="mb-5">Provide your registered email address to change password.</p>
                                <div class="form-group float-label active">
                                    <input type="text" class="form-control text-white" name="value" value="{{ old('value') }}" required autofocus="off">
                                    <label class="form-control-label text-white">Username/Email</label>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- footer-->
            <div class="footer no-bg-shadow py-3">
                <div class="row justify-content-center">
                    <div class="col">
                        <button type="submit" class="btn btn-default rounded btn-block">@lang('Reset Password')</button>
                    </div>
                </div>
            </div>
        </form>

    </main>

    

    
</body>


{{-- <section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="account-wrapper p-4">
                    <div class="mb-4">
                        <p>@lang('To recover your account please provide your email or username to find your account.')</p>
                    </div>
                    <form method="POST" action="{{ route('user.password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">@lang('Email or Username')</label>
                            <input type="text" class="form-control form--control" name="value" value="{{ old('value') }}" required autofocus="off">
                        </div>

                        <button type="submit" class="cmn-btn w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}

@endsection