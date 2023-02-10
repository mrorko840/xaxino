<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>

    @include('partials.seo')
    <!-- Custom Css -->

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{ asset($activeTemplateTrue . 'assets/manifest.json') }}" />
    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/css/swiper.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset($activeTemplateTrue . 'assets/css/style.css') }}" rel="stylesheet" id="style">


    <style>
        a {
            text-decoration: none;
        }

        .btn-mini {
            font-size: 0.6rem;
            line-height: 1;
            border-radius: 80.19999999999999rem;
        }

        .btn-mini2 {
            font-size: 0.7rem;
            line-height: 1.7;
            border-radius: 80.19999999999999rem;
        }

        .gp-btn {
            background-color: #3facf7;
            border-color: #3facf7;
        }

        .gp-btn:hover {
            background-color: #2694dd;
            border-color: #2694dd;
        }

        .bl-btn {
            background-color: #ef6f38;
            border-color: #ef6f38;
        }

        .bl-btn:hover {
            background-color: #da5530;
            border-color: #da5530;
        }

        .robi-btn {
            background-color: #e23530;
            border-color: #e23530;
        }

        .robi-btn:hover {
            background-color: #b11d17;
            border-color: #b11d17;
        }

        .airtel-btn {
            background-color: #ed3833;
            border-color: #ed3833;
        }

        .airtel-btn:hover {
            background-color: #b11d17;
            border-color: #b11d17;
        }

        .teletalk-btn {
            background-color: #6ac537;
            border-color: #6ac537;
        }

        .teletalk-btn:hover {
            background-color: #4d9e1e;
            border-color: #4d9e1e;
        }

        .skitto-btn {
            background-color: #b13fb5;
            border-color: #b13fb5;
        }

        .skitto-btn:hover {
            background-color: #822286;
            border-color: #822286;
        }

        .border-custom {
            border-radius: 1.3rem !important;
        }

        .avatar.avatar-200 {
            height: 200px;
            line-height: 200px;
            width: 200px;
        }

        /* custom */

        .single-select.active {
            position: relative;
            border-color: #e6a25d;
        }
        .single-select {
            padding: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
            border-radius: 8px;
        }

        .win-loss-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 100vh;
            background-color: transparent;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transform: scale(0.5);
            transition: all 0.5s ease-in-out;
            opacity: 0;
            visibility: hidden;
        }

        .win-loss-popup.active {
            transform: scale(1);
            opacity: 1;
            visibility: visible;
        }

        .win-loss-popup__inner {
            width: 480px;
            max-width: 100%;
            text-align: center;
            background-color: #01162f;
            border-radius: 8px;
            border: 3px solid rgba(255, 255, 255, 0.15);
        }

        @media (max-width: 575px) {
            .win-loss-popup__inner {
                width: 300px;
            }
        }

        .win-loss-popup__header {
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .win-loss-popup__body {
            padding: 20px 30px;
        }

        .win-loss-popup__body .icon {
            font-size: 200px;
            line-height: 1;
            color: #ed1569;
            text-shadow: 0 5px 15px #ed1569;
        }

        .win-loss-popup__footer {
            padding: 20px 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .text--base {
            color: #ed1569;
        }

        .img-glow {
            animation: imgGlow 2s infinite linear;
        }

        @keyframes imgGlow {
            0% {
                opacity: 1;
            }

            25% {
                opacity: 0.75;
            }

            50% {
                opacity: 1;
            }

            75% {
                opacity: 0.65;
            }

            100% {
                opacity: 1;
            }
        }
    </style>

    {{-- <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/line-awesome.min.css') }}" rel="stylesheet" />

    {{-- <link href="{{ asset($activeTemplateTrue . 'css/lightcase.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/vendor/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/vendor/slick.css') }}" rel="stylesheet"> --}}

    {{-- <link href="{{ asset($activeTemplateTrue . 'css/main.css') }}" rel="stylesheet"> --}}

    {{-- <link href="{{ asset($activeTemplateTrue . 'css/custom.css') }}" rel="stylesheet">
    <link href="{{asset($activeTemplateTrue.'css/color.php?color='.$general->base_color)}}" rel="stylesheet"> --}}
    @stack('style-lib')
    @stack('style')
</head>

<body>
    @stack('fbComment')

    <!-- screen loader -->
    <div class="container-fluid h-100 loader-display">
        <div class="row h-100">
            <div class="align-self-center col">
                <div class="logo-loading">
                    <div class="icon icon-100 mb-4 rounded-circle shadow-sm">
                        <img src="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}" alt=""
                            class="w-100">
                    </div>
                    <h4 class="text-primary">{{ $general->site_name }}</h4>
                    <p class="text-secondary">{{ __($pageTitle) }}</p>
                    <div class="loader-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="preloader">
        <div class="preloader__inner">
            <div class="preloader__thumb">
                <img class="loaderLogo mt-3" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="imge">
                <img class="loadercircle" src="{{ asset($activeTemplateTrue . 'images/preloader-dice.png') }}" alt="image">
            </div>
        </div>
    </div> --}}

    <div class="page-wrapper" id="main-scrollbar" data-scrollbar>

        @yield('app')

    </div>

    <div class="win-loss-popup">
        <div class="win-loss-popup__bg card shawow">
            <div class="win-loss-popup__inner bg-warning shawow">
                <div class="win-loss-popup__body">
                    <img width="200px" class="img-glow lose d-none"
                        src="{{ asset($activeTemplateTrue . 'images/play/lose-message.png') }}"
                        alt="lose message image">
                    <img width="200px" class="img-glow win d-none"
                        src="{{ asset($activeTemplateTrue . 'images/play/win-message.png') }}" alt="win message image">
                </div>
                <div class="win-loss-popup__footer">
                    <h5 class="result-text"> The result is <span class="data-result"></span></h5>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="scroll-to-top">
        <span class="scroll-icon">
            <i class="las la-arrow-up"></i>
        </span>
    </div> --}}

    {{-- @php
    $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    @endphp

    @if ($cookie->data_values->status == Status::ENABLE && !\Cookie::get('gdpr_cookie'))
    <div class="cookies-card hide text-center">
        <div class="cookies-card__icon bg--base">
            <i class="las la-cookie-bite"></i>
        </div>
        <p class="cookies-card__content mt-4">{{ $cookie->data_values->short_desc }} <a class="text--base" href="{{ route('cookie.policy') }}" target="_blank">@lang('learn more')</a></p>
        <div class="cookies-card__btn mt-4">
            <a class="cmn-btn w-100 policy text-white" href="javascript:void(0)">@lang('Allow')</a>
        </div>
    </div>
    @endif --}}

    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>

    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')

    <!-- Required jquery and libraries -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/js/popper.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery.cookie.js') }}"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/js/swiper.min.js') }}"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/js/swiper.min.js') }}"></script>


    <!-- chart js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/utils.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/chart-js-data.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/main.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/js/color-scheme-demo.js') }}"></script>

    <!-- PWA app service registration and works -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/pwa-services.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/app.js') }}"></script>




    <script src="{{ asset($activeTemplateTrue . '/js/vendor/lightcase.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . '/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . '/js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . '/js/app.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],[type=password],[type=email],[type=number],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });


        })(jQuery);
    </script>

</body>

</html>
