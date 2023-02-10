@extends($activeTemplate . 'layouts.master')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">

        @include(activeTemplate() . 'includes.top_nav_mini')

        <!-- page content start -->
        <div class="container mb-4 text-center text-white">
            <div class="row">
                <div class="col col-sm-8 col-md-6 col-lg-5 mx-auto">
                    <img src="{{ asset($activeTemplateTrue . 'assets/img/refer.png') }}" alt="" class="mw-100 mb-4">
                    <h5>Invite your contacts<br>or Friends and Earn Rewards</h5>
                </div>
            </div>
        </div>
        <div class="main-container">
            <div class="container mb-4">
                <div class="card border-0 mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle text-danger">
                                    <i class="material-icons vm text-template">card_giftcard</i>
                                </div>
                            </div>
                            <div class="col-auto align-self-center">
                                <h6 class="mb-1">Refer and Earn Rewards</h6>
                                <p class="small text-secondary">Share your referal link and start earning</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mb-4">
                <div class="alert alert-success d-none" id="successmessage">Refferal link copied</div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="refferal Link"
                        value="{{ route('user.register') }}/{{ auth()->user()->username }}" id="link">
                    <div class="input-group-append">
                        <button class="btn btn-default rounded" type="button" id="basic-addon2"
                            onclick="copyRefLink()">Copy link</button>
                    </div>
                </div>
                <p class="text-center text-secondary">Share link to social</p>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="avatar avatar-40 rounded mx-2">
                            <div class="background">
                                <img src="{{ asset($activeTemplateTrue . 'assets/img/whatsapp.png') }}" alt="">
                            </div>
                        </div>
                        <div class="avatar avatar-40 rounded mx-2">
                            <div class="background">
                                <img src="{{ asset($activeTemplateTrue . 'assets/img/facebook.png') }}" alt="">
                            </div>
                        </div>
                        <div class="avatar avatar-40 rounded mx-2">
                            <div class="background">
                                <img src="{{ asset($activeTemplateTrue . 'assets/img/instagram.png') }}" alt="">
                            </div>
                        </div>
                        <div class="avatar avatar-40 rounded mx-2">
                            <div class="background">
                                <img src="{{ asset($activeTemplateTrue . 'assets/img/twitter.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            

            <div class="container mb-4">
                <h6 class="subtitle mb-3">Recently Invited friends</h6>
                <div class="swiper-container swiper-users text-center mb-4">
                    <div class="swiper-wrapper">

                        @forelse($downlines as $data)
                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="avatar avatar-60 rounded mb-1">
                                            <div class="background">
                                            <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . @$data->image, imagePath()['profile']['user']['size']) }}" alt="">
                                            </div>
                                        </div>
                                        <p class="text-secondary"><small>{{ __($data->firstname) }}</small></p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div>
                                <div align="center" colspan="100%" class="text-center">@lang('Data Not Found')!</div>
                            </div>
                        @endforelse

                    </div>
                </div>

                {{-- <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email addres">
                    <div class="input-group-append">
                        <button class="btn btn-default rounded" type="button" id="button-addon2">Invite</button>
                    </div>
                </div> --}}
                
            </div>
        </div>
    </main>
</body>







    {{-- <div class="pt-120 pb-120">
        <div class="container">
            <div class="row">
                @if (auth()->user()->referrer)
                    <h4 class="mb-2">@lang('You are referred by') {{ auth()->user()->referrer->fullname }}</h4>
                @endif
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control form-control-lg referralURL" type="text" value="{{ route('home') }}?reference={{ auth()->user()->username }}" readonly>
                            <button class="input-group-text bg--base -bottom-left-copytext" id="copyBoard" type="button"><i class="fas fa-copy"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($user->allReferrals->count() > 0 && $maxLevel > 0)
                                <div class="treeview-container">
                                    <ul class="treeview">
                                        <li class="items-expanded"> {{ $user->fullname }} ( {{ $user->username }} )
                                            @include($activeTemplate . 'partials.under_tree', ['user' => $user, 'layer' => 0, 'isFirst' => true])
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


@endsection

@push('style-lib')
    <link type="text/css" href="{{ asset($activeTemplateTrue . '/css/jquery.treeView.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . '/js/jquery.treeView.js') }}"></script>
@endpush
@push('style')
    <style type="text/css">
        .content-wrapper {
            margin-top: -90px;
            min-height: calc(100vh - 157px);
        }

        .copytext {
            cursor: pointer;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";

        $('.main-wrapper').addClass('section--bg');

        "use strict";

        const copyRefLink = () => {
            var copyText = document.getElementById("link");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            notify('success', "Copied: " + copyText.value);
        }
    </script>
@endpush

{{-- @push('script')
    <script>
        (function($) {
            "use strict";
            $('.treeview').treeView();

            $('#copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush --}}
