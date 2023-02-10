@extends($activeTemplate . 'layouts.master')
@section('content')
@include('templates.basic.liveonline')
    @php
        $kyc = getContent('user_kyc.content', true);
        $fake_reviews = getContent('fake_review.element');
        $noticeCaption = getContent('notice.content',true);
    @endphp

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Top navbar -->
    @include($activeTemplate . 'includes.side_nav')

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav')

        <div class="container mt-3 mb-4 text-center">
            <h2 class="text-white">{{ $general->cur_sym }} {{ showAmount($widget['total_balance']) }}</h2>
            <p class="text-white mb-4">Total Balance</p>
        </div>

        <div class="main-container">
            <!-- page content start -->

            <div class="row pt-1 mx-2 mb-3">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-body p-0 px-2">
                            <div class="row">
                                <div class="col-auto d-flex align-items-center justify-content-center border-custom bg-warning">
                                    <span class="material-icons">campaign</span>
                                </div>
                                <div class="col align-items-center px-0 mx-0 pt-2">
                                    <marquee behavior="scroll" direction="left">
                                        @php 
                                            echo $noticeCaption->data_values->scrolingNotice; 
                                        @endphp
                                    </marquee>
                                </div>
                                <div style="font-size: 10px" class="col-auto d-flex align-items-center justify-content-center border-custom bg-default-secondary">
                                    <span style="font-size: 17px" class="material-icons">groups</span>{{'-'}} <b id="dynamic_counter"></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-4 text-center">
                <div class="card bg-default-secondary shadow-default">
                    <div class="card-body">
                        <!-- Swiper -->
                        <div class="swiper-container addsendcarousel text-center">
                            <div class="swiper-wrapper mb-4">
                                <a href="{{ route('user.deposit.index') }}" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">add</span></div>
                                    <p><small>Add Fund</small></p>
                                </a>
                                <a href="{{ route('user.withdraw') }}" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">call_received</span></div>
                                    <p><small>Withdraw</small></p>
                                </a>
                                <a href="{{ route('user.game.log') }}" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">swap_horiz</span></div>
                                    <p><small>Game Log</small></p>
                                </a>
                                <a href="{{ route('user.deposit.history') }}" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">history</span></div>
                                    <p><small>Deposit</small></p>
                                </a>
                                <a href="{{ route('user.withdraw.history') }}" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">update</span></div>
                                    <p><small>Withdraw</small></p>
                                </a>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Swiper Games -->
            <div class="container mb-4">
                <div class="swiper-container swiper-users text-center ">
                    <div class="swiper-wrapper">

                        @forelse($games as $game)
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body p-2">
                                    <div class="avatar avatar-200 rounded mb-1">
                                        <div class="background">
                                            <img src="{{ getImage(getFilePath('game') . '/' . $game->image, getFileSize('game')) }}" width="300px" height="300px" alt="">
                                        </div>
                                    </div>
                                    <h5 class="text-info"><small><b>{{ __($game->name) }}</b></small></h5>
                                    <a class="btn btn-warning w-100 border-custom shadow-sm" href="{{ route('user.play.game', $game->alias) }}">PLAY NOW</a>
                                </div>
                            </div>
                        </div>
                        @empty

                        @endforelse

                    </div>
                </div>
            </div>

            {{-- <div class="container mb-4">
                <div class="card">
                    <div class="card-body text-center ">
                        <div class="row justify-content-equal no-gutters">
                            <div class="col-4 col-md-2 mb-3">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">qr_code_2</span></div>
                                <p class="text-secondary"><small>Pay</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">swap_horiz</span></div>
                                <p class="text-secondary"><small>Transfer</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">sim_card</span></div>
                                <p class="text-secondary"><small>Reacharge</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">account_circle</span></div>
                                <p class="text-secondary"><small>Send</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">receipt</span></div>
                                <p class="text-secondary"><small>Bill</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">wb_incandescent</span></div>
                                <p class="text-secondary"><small>Electricity</small></p>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary rounded" id="more-expand-btn">Show more <span class="ml-2 small material-icons">expand_more</span></button>
                        <div class="row justify-content-equal no-gutters" id="more-expand">
                            <div class="col-4 col-md-2">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">beach_access</span></div>
                                <p class="text-secondary"><small>Insurance</small></p>
                            </div>
                            <div class="col-4 col-md-2">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">drive_eta</span></div>
                                <p class="text-secondary"><small>Car</small></p>
                            </div>
                            <div class="col-4 col-md-2">
                                <div class="icon icon-50 rounded-circle mb-1 bg-default-light text-default"><span class="material-icons">flight</span></div>
                                <p class="text-secondary"><small>Flight</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="container mb-4">
                <div class="row">
                    <div class="col">
                        <h6 class="subtitle mb-3">Status </h6>
                    </div>
                    <div class="col-auto"><a href="" class="text-default" hidden>View all</a></div>
                </div>
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-50 border-0 bg-success-light rounded-circle text-success">
                                            <i class="material-icons vm text-template">wallet</i>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-center">
                                        <h6 class="mb-1">Deposit</h6>
                                        <p class="small text-secondary">(Total)</p>
                                    </div>
                                    <div class="col-auto align-self-center border-left">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($widget['total_deposit']) }}</h6>
                                        <p class="small text-secondary">Due: 15-12-2019</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-50 border-0 bg-warning-light rounded-circle text-warning">
                                            <i class="material-icons vm text-template">account_balance</i>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-center">
                                        <h6 class="mb-1">Withdraw</h6>
                                        <p class="small text-secondary">(Total)</p>
                                    </div>
                                    <div class="col-auto align-self-center border-left">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($widget['total_withdrawn']) }}</h6>
                                        <p class="small text-secondary">Due: 18-12-2019</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- PWA add to home display -->
            <div class="container mb-4">
                <div class="card" id="addtodevice">
                    <div class="card-body text-center">
                        <div class="row mb-3">
                            <div class="col-10 col-md-4 mx-auto"><img src="{{ asset($activeTemplateTrue . 'assets/img/install-app.png') }}" alt="" class="mw-100"></div>
                        </div>

                        <h5 class="text-dark">Add to <span class="font-weight-bold">Home screen</span></h5>
                        <p class="text-secondary">See  as in fullscreen on your device.</p>
                        <button class="btn btn-sm btn-default px-4 rounded" id="addtohome">Install</button>
                    </div>
                </div>
            </div>
            <!-- PWA add to home display -->

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
                                <h6 class="mb-1">3 Gift Cards</h6>
                                <p class="small text-secondary">Click here to see gift cards</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Upcoming Payments </h6>
                    </div>
                    <div class="col-auto"><a href="allpayment.html" class="float-right small">View All</a></div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1">$ 1548.00 </h5>
                                        <p class="text-secondary">20d to pay electricity bill</p>

                                    </div>
                                    <div class="col-auto pl-0">
                                        <button class="btn btn-40 bg-default-light text-default rounded-circle">
                                            <i class="material-icons">local_atm</i>
                                        </button>
                                    </div>
                                </div>
                                <div class="progress h-5 mt-3">
                                    <div class="progress-bar bg-default" role="progressbar" style="width:35%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1">$ 106.00</h5>
                                        <p class="text-secondary">33 days to pay gas bill</p>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <button class="btn btn-40 bg-default-light text-default rounded-circle">
                                            <i class="material-icons">local_atm</i>
                                        </button>
                                    </div>
                                </div>
                                <div class="progress h-5 mt-3">
                                    <div class="progress-bar bg-default" role="progressbar" style="width: 65%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="container mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-1">Select Menu Type</h6>
                        <p class="text-secondary small">Open menu after selecting style</p>
                        <div class="row">
                            <div class="col-6 col-md-auto">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="menustyle" class="custom-control-input" id="menu-overlay" checked="">
                                    <label class="custom-control-label" for="menu-overlay">Overlay</label>
                                </div>
                            </div>
                            <div class="col-6 col-md-auto">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="menustyle" class="custom-control-input" id="menu-pushcontent">
                                    <label class="custom-control-label" for="menu-pushcontent">Reveal</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="container ">
                <div class="row" hidden>
                    <div class="col text-center" >
                        <h5 class="subtitle">Most Exciting Feature</h5>
                        <p class="text-secondary">Take a look at our services</p>
                    </div>
                </div>
                <div class="row text-center mt-3">

                    {{-- <div class="col-6 col-md-3">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="avatar avatar-60 bg-default-light rounded-circle text-default">
                                    <i class="material-icons vm md-36 text-template">card_giftcard</i>
                                </div>
                                <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($widget['total_deposit']) }}</h3>
                                <p class="text-secondary small">Total Deposit</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="avatar avatar-60 bg-default-light rounded-circle text-default">
                                    <i class="material-icons vm md-36 text-template">subscriptions</i>
                                </div>
                                <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($widget['total_withdrawn']) }}</h3>
                                <p class="text-secondary small">Total Withdraw</p>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-6 col-md-3">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="avatar avatar-60 bg-warning-light rounded-circle text-warning">
                                    <i class="material-icons vm md-36 text-template">savings</i>
                                </div>
                                <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($widget['total_invest']) }}</h3>
                                <p class="text-secondary small">Total Invest</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="avatar avatar-60 bg-success-light rounded-circle text-success">
                                    <i class="material-icons vm md-36 text-template">add_shopping_cart</i>
                                </div>
                                <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($widget['total_win']) }}</h3>
                                <p class="text-secondary small">Total Earned</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Swiper Our Reviews-->
            <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Our Reviews</h6>
                    </div>
                </div>
                <div class="swiper-container swiper-users ">
                    <div class="swiper-wrapper">
                        @forelse($fake_reviews as $review)

                        <div class="swiper-slide">
                            <div style="min-height: 180px; width: 320px;" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="avatar avatar-60 rounded mb-1">
                                                <div class="background"><img src="{{ getImage('assets/images/frontend/fake_review/'.@$review->data_values->image) }}" alt=""></div>
                                            </div>
                                            <p class="text-secondary mb-0"><small>{{ @$review->data_values->name }}</small></p>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col ">
                                            <p class="mb-1">{{@$review->data_values->review_text}}<small class="text-success" hidden>28% <span class="material-icons small" hidden>call_made</span></small></p>
                                            <p class="text-secondary small">{{ showDateTime(@$review->updated_at, 'd-m-Y, h:i a') }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @empty

                        @endforelse
                        
                    </div>
                </div>
            </div>


            
            

        </div>
    </main>

    <!-- footer-->
    @include($activeTemplate . 'includes.bottom_nav')


    
</body>






    {{-- <section class="pt-120 pb-120">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    @if ($user->kv == 0)
                        <div class="d-widget" role="alert">
                            <h4 class="alert-heading text--danger">@lang('KYC Verification required')</h4>
                            <hr>
                            <p class="mb-0">{{ __($kyc->data_values->verification_content) }} <a class="text--base" href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a></p>
                        </div>
                    @elseif($user->kv == 2)
                        <div class="d-widget" role="alert">
                            <h4 class="alert-heading text--warning">@lang('KYC Verification pending')</h4>
                            <hr>
                            <p class="mb-0">{{ __($kyc->data_values->pending_content) }} <a class="text--base" href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-balance">
                        <div class="d-widget-icon">
                            <i class="las la-money-bill-wave"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Balance')</p>
                            <h2 class="title">{{ showAmount($widget['total_balance']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-deposit">
                        <div class="d-widget-icon">
                            <i class="las la-wallet"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Deposit')</p>
                            <h2 class="title">{{ showAmount($widget['total_deposit']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-withdraw">
                        <div class="d-widget-icon">
                            <i class="las la-hand-holding-usd"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Withdraw')</p>
                            <h2 class="title">{{ showAmount($widget['total_withdrawn']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-invest">
                        <div class="d-widget-icon">
                            <i class="las la-cash-register"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Invest')</p>
                            <h2 class="title">{{ showAmount($widget['total_invest']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-win">
                        <div class="d-widget-icon">
                            <i class="las la-trophy"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Win')</p>
                            <h2 class="title">{{ showAmount($widget['total_win']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="d-widget dashbaord-widget-card d-widget-loss">
                        <div class="d-widget-icon">
                            <i class="las la-money-bill-alt"></i>
                        </div>
                        <div class="d-widget-content">
                            <p>@lang('Total Loss')</p>
                            <h2 class="title">{{ showAmount($widget['total_loss']) }} {{ $general->cur_text }}</h2>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row justify-content-center">
                @forelse($games as $game)
                    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                        <div class="game-card style--two">
                            <div class="game-card__thumb">
                                <img src="{{ getImage(getFilePath('game') . '/' . $game->image, getFileSize('game')) }}" alt="image">
                            </div>
                            <div class="game-card__content">
                                <h4 class="game-name">{{ __($game->name) }}</h4>
                                <a class="cmn-btn d-block btn-sm btn--capsule mt-3 text-center" href="{{ route('user.play.game', $game->alias) }}">@lang('Play Now')</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">{{ __($emptyMessage) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>


        </div>
    </section> --}}

@endsection
