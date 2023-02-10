@extends($activeTemplate.'layouts.frontend')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay">

    <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form row gap-2">
        @csrf

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
            
            
            <div class="container h-100 text-white">
                <div class="row h-100">
                    <div class="col-12 mb-4">
                        <div class="row justify-content-center">
                            <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                                <h2 class="font-weight-normal mb-3">Forgot<br>your password?</h2>
                                <p class="mb-5">Provide Verification OTP Code.</p>
                                <div class="form-group float-label active">
                                    <h4 class="text-center">@lang('Verification Code') </h4>
                                    <input type="hidden" name="email" value="{{ $email }}">
                                    {{-- <p class="pt-3">
                                        @lang('A 6 digit verification code sent to your email address') :  
                                        {{ showEmailAddress($email) }}
                                    </p> --}}
                                    

                                    <div id="phoneInput">
                                        <div class="field-wrapper">
                                            <div class="">
                                                <input type="text" name="code" 
                                                    class="form-control bg-white border-custom text-center shadow"
                                                    pattern="[0-9]*" inputmode="numeric" maxlength="6">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <p class="text-center">@lang('Please check including your Junk/Spam Folder.<br>If not found, you can') <a href="{{ route('user.password.request') }}" class="base--color">@lang('Try to send again')...</a></p>
                            
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
                    <button type="submit" class="btn btn-default rounded btn-block">Reset Password</button>
                </div>
            </div>
        </div>

    </form>
</body>




{{-- <section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="d-flex justify-content-center">
                    <div class="verification-code-wrapper">
                        <div class="verification-area">
                            <h5 class="pb-3 text-center border-bottom">@lang('Verify Email Address')</h5>
                            <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form row gap-2">
                                @csrf
                                <p class="pt-3">@lang('A 6 digit verification code sent to your email address') :  {{ showEmailAddress($email) }}</p>
                                <input type="hidden" name="email" value="{{ $email }}">
    
                                @include($activeTemplate.'partials.verification_code')
    
                                <div class="form-group">
                                    <button type="submit" class="cmn-btn w-100">@lang('Submit')</button>
                                </div>
    
                                <div>
                                    @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                    <a href="{{ route('user.password.request') }}" class="text--base">@lang('Try to send again')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

@endsection



@push('style')
    <link href="{{ asset('assets/global/css/verification-code.css') }}" rel="stylesheet">
@endpush

@push('style')
    <style>

        #phoneInput .field-wrapper {
            position: relative;
            text-align: center;
        }

        #phoneInput .form-group {
            min-width: 300px;
            width: 50%;
            margin: 4em auto;
            display: flex;
            border: 1px solid rgba(96, 100, 104, 0.3);
        }

        #phoneInput .letter {
            height: 50px;
            border-radius: 0;
            text-align: center;
            max-width: calc((100% / 7) - 1px);
            flex-grow: 1;
            flex-shrink: 1;
            flex-basis: calc(100% / 10);
            outline-style: none;
            padding: 5px 0;
            font-size: 18px;
            font-weight: bold;
            color: red;
            border: 1px solid #0e0d35;
        }

        #phoneInput .letter + .letter {
        }

        @media (max-width: 480px) {
            #phoneInput .field-wrapper {
                width: 100%;
            }

            #phoneInput .letter {
                font-size: 16px;
                padding: 2px 0;
                height: 35px;
            }
        }

    </style>
@endpush

@push('script')
    <script>
        (function($){
            "use strict";
            $('#phoneInput').letteringInput({
                inputClass: 'letter',
                onLetterKeyup: function ($item, event) {
                    console.log('$item:', $item);
                    console.log('event:', event);
                },
                onSet: function ($el, event, value) {
                    console.log('element:', $el);
                    console.log('event:', event);
                    console.log('value:', value);
                }
            });
        })(jQuery);
    </script>
@endpush

{{-- @push('script')
    <script>
        $('#verification-code').on('input', function() {
            $(this).val(function(i, val) {
                if (val.length >= 6) {
                    $('.submit-form').find('button[type=submit]').html('<i class="las la-spinner fa-spin"></i>');
                    $('.submit-form').submit()
                }
                if (val.length > 6) {
                    return val.substring(0, val.length - 1);
                }
                return val;
            });
            for (let index = $(this).val().length; index >= 0; index--) {
                $($('.boxes span')[index]).html('');
            }
        });
    </script>
@endpush --}}
