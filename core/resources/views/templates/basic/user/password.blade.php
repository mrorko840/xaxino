@extends($activeTemplate.'layouts.master')
@section('content')

<!-- page content start -->
<main class="flex-shrink-0 main">
    @include(activeTemplate() . 'includes.top_nav_mini')

    <div class="main-container">
        <div class="container">

            <div class="card mb-4">
                
                <div class="row user-profile text-center">
                    <div  class="col-6 profile-thumb-wrapper text-center ms-1 mt-4 mb-3">
                        <div style="width: 7.25rem; height: 7.25rem;" class="profile-thumb">
                        <div class="avatar-preview">
                            <div style="width: 7.25rem; height: 7.25rem; background-image: url( '{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}' );" class="profilePicPreview rounded-circle" style=""></div>
                        </div>
                        @if (request()->path() == 'user/profile-setting')
                        <div class="avatar-edit">
                            <input type='file' class="profilePicUpload" id="image" name="image" accept=".png, .jpg, .jpeg" />
                            <label  style="width: 35px; height: 35px;" class="text-white" for="image"><span class="material-icons">edit</span></label>
                        </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-6 ">
                        <div class="align-middle pt-5">
                            <h6 class="title align-middle">{{ __($user->fullname) }}</h6>
                            <span class="align-middle">@lang('user id'): {{ __($user->username) }}</span>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="subtitle mb-0">
                        <div class="avatar avatar-40 bg-default-light text-default rounded mr-2"><span
                                class="material-icons vm">lock</span></div>
                        Change Password
                    </h6>
                </div>
                <form action="" method="post" class="register">
                    @csrf
                    <div class="card-body">

                        <div class="form-group float-label active">
                            <input id="password" type="password" class="form-control" 
                            name="current_password" required
                            autocomplete="current-password" autofocus>
                            <label class="form-control-label">Current Password</label>
                        </div>
                        <div class="form-group float-label">
                            <input id="confirm_password" type="password"
                            class="form-control" name="password" required
                            autocomplete="current-password" >
                            <label class="form-control-label">New Password</label>
                                @if ($general->secure_password)
                                    <div class="progress mt-2">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="text-danger my-1 capital">@lang('Minimum 1 capital letter is required')</p>
                                    <p class="text-danger my-1 number">@lang('Minimum 1 number is required')</p>
                                    <p class="text-danger my-1 special">@lang('Minimum 1 special character is required')</p>
                                @endif
                        </div>

                        <div class="form-group float-label">
                            <input id="password_confirmation" type="password"
                                class="form-control" name="password_confirmation" required
                                autocomplete="current-password">
                            <label class="form-control-label">Confirm New Password</label>
                        </div>

                    </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-block btn-default rounded" value="Update Password">
                </div>
            </form>
            </div>
        </div>
    </div>
</main>


{{-- <section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">@lang('Current Password')</label>
                                <input type="password" class="form-control form--control" name="current_password" required autocomplete="current-password">
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Password')</label>
                                <input type="password" class="form-control form--control" name="password" required autocomplete="current-password">
                                @if($general->secure_password)
                                <div class="input-popup">
                                    <p class="error lower">@lang('1 small letter minimum')</p>
                                    <p class="error capital">@lang('1 capital letter minimum')</p>
                                    <p class="error number">@lang('1 number minimum')</p>
                                    <p class="error special">@lang('1 special character minimum')</p>
                                    <p class="error minimum">@lang('6 character password')</p>
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Confirm Password')</label>
                                <input type="password" class="form-control form--control" name="password_confirmation" required autocomplete="current-password">
                            </div>
                            <button type="submit" class="cmn-btn w-100">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection
@if($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/build/css/intlTelInput.css')}}">
    <style>
        .intl-tel-input {
            position: relative;
            display: inline-block;
            width: 100% !important;
        }
        
        .profile-thumb {
            position: relative;
            width: 11.25rem;
            height: 11.25rem;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            display: inline-flex;
        }
        .profile-thumb .profilePicPreview {
            width: 11.25rem;
            height: 11.25rem;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            display: block;
            border: 3px solid #ffffff;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);
            background-size: cover;
            background-position: center;
        }
        .profile-thumb .profilePicUpload {
            font-size: 0;
            opacity: 0;
        }
        .profile-thumb .avatar-edit {
            position: absolute;
            right: -15px;
            bottom: -20px;
        }
        .profile-thumb .avatar-edit input {
            width: 0;
        }
        .profile-thumb .avatar-edit label {
            width: 45px;
            height: 45px;
            background-color: #37ebec;
            border-radius: 50%;
            text-align: center;
            line-height: 45px;
            border: 2px solid #ffffff;
            font-size: 18px;
            cursor: pointer;
            color: #000000;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";
        @if ($general->secure_password)
            $('input[name=password]').on('input', function() {
                var password = $(this).val();
                var width = 25;
                var capital = /[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/;
                var capital = capital.test(password);
                if (!capital) {
                    $('.capital').removeClass('d-none');
                } else {
                    width += 25;
                    $('.capital').addClass('d-none');
                }
                var number = /[123456790]/;
                var number = number.test(password);
                if (!number) {
                    $('.number').removeClass('d-none');
                } else {
                    width += 25;
                    $('.number').addClass('d-none');
                }
                var special = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            var special = special.test(password);
            if (!special) {
                $('.special').removeClass('d-none');
            } else {
                width += 25;
                $('.special').addClass('d-none');
            }

            if (width == 25) {
                var bg = 'red';
                var msg = 'Too Week'
            } else if (width == 50) {
                var msg = 'Week'
                var bg = '#D7A612';
            } else if (width == 75) {
                var msg = 'Medium'
                var bg = '#5210BF';
            } else if (width == 100) {
                var msg = 'Strong'
                var bg = 'green';
            }
            $('.progress-bar').attr('style', `width:${width}%;background:${bg};`);
                $('.progress-bar').text(msg);
            });
        @endif
    </script>
@endpush