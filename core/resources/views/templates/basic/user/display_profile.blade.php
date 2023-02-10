@extends($activeTemplate.'layouts.master')
@section('content')
@php
        $noticeCaption = getContent('notice.content',true);
@endphp
    
<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">

        @include(activeTemplate().'includes.side_nav')

        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">
            <!-- Fixed navbar -->
            @include(activeTemplate().'includes.top_nav')

            <!-- page content start -->
            <div class="container-fluid px-0">
                <div class="card overflow-hidden">
                    <div class="card-body p-0 h-150">
                        <div class="background">
                            <img src="{{ asset($activeTemplateTrue.'assets/img/image10.jpg') }}" alt="" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid top-70 text-center mb-4">
                <div class="avatar avatar-140 rounded-circle mx-auto shadow">
                    <div class="background">
                        <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="">
                    </div>
                </div>
            </div>

            <div class="container mb-4 text-center text-white">
                <h6 class="mb-1">{{ __($user->fullname) }}</h6>
                <p>{{@$user->address->country}}</p>
                {{-- <p class="mb-1">{{$user->email}}</p>
                <p>+{{$user->mobile}}</p> --}}
            </div>

            <div class="main-container">

                
                <div class="container mb-4">
                    <div class="row mb-4">
                        <div class="col-6">
                            <button class="btn btn-outline-default px-2 btn-block rounded" data-toggle="modal" data-target="#QrCodeModal"><span class="material-icons mr-1">qr_code_scanner</span> Share QR</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-outline-default px-2 btn-block rounded"><span class="material-icons mr-1">receipt_long</span> Send Bill</button>
                        </div>
                    </div>

                    <!-- Recent Transactions -->
                    <div class="row">

                        <div class="col-12 col-md-6 pb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1">Total Win: <span class="text-success">{{ (@$widget['win_count']) }} Match</span></h6>
                                            <p class="text-secondary">Win Rario: 
                                                <span class="text-success">
                                                    {{ round(@$widget['win_raito']) }} %
                                                </span>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="progress h-5 mt-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:{{ @$widget['win_raito'] }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1">Total Loss: <span class="text-danger">{{ (@$widget['loss_count']) }} Match</span></h6>
                                            <p class="text-secondary">Loss Rario: <span class="text-danger">{{ round(@$widget['loss_raito']) }} %</span></p>

                                        </div>
                                    </div>
                                    <div class="progress h-5 mt-3">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width:{{ @$widget['loss_raito'] }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Recent Transactions -->
                <div class="container mb-4">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h6 class="mb-0">Recent Transactions</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <ul class="list-group list-group-flush">

                                @forelse($transactions as $singleTrx)

                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto pr-0">
                                            <div class="avatar avatar-40 rounded">
                                                <div class="background">
                                                    @if($singleTrx->logo_type == 'deposit' || $singleTrx->remark == 'deposit')
                                                        <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $singleTrx->trx_logo,imagePath()['gateway']['size'])}}" alt="">
                                                    @elseif($singleTrx->logo_type == 'withdraw' || $singleTrx->remark == 'withdraw')
                                                        <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $singleTrx->trx_logo,imagePath()['gateway']['size'])}}" alt="">
                                                    @elseif($singleTrx->logo_type == 'admin' || ($singleTrx->remark == 'balance_add') || ($singleTrx->remark == 'balance_subtract') || ($singleTrx->remark == 'register_bonus'))
                                                        <img src="{{ asset($activeTemplateTrue . '/assets/img/services/' . $singleTrx->trx_logo ) }}" alt="">
                                                    @elseif(($singleTrx->remark == 'invest') || ($singleTrx->remark == 'Win_Bonus') || ($singleTrx->remark == 'invest_back'))
                                                        <img src="{{ getImage(getFilePath('game') . '/' . $singleTrx->trx_logo, getFileSize('game')) }}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pr-0">
                                            <h6 class="font-weight-normal mb-1">{{ __($singleTrx->details) }}</h6>
                                            <p class="small text-secondary">{{ showDateTime($singleTrx->created_at, 'd-m-Y, h:i a') }}</p>
                                        </div>

                                        <div class="col-auto">
                                            <h6 class="@if(($singleTrx->trx_type)=='+') {{'text-success'}} @else {{'text-danger'}} @endif">

                                                @if(getAmount($singleTrx->amount) != 0)
                                                {{ __($singleTrx->trx_type) }}
                                                {{ __($general->cur_sym) }}
                                                {{ getAmount($singleTrx->amount) }}
                                                
                                                @else
                                                {{ __($singleTrx->trx_type) }}
                                                {{ __($general->cur_sym) }}
                                                {{ getAmount($singleTrx->charge) }}
                                                @endif

                                            </h6>
                                        </div>

                                    </div>
                                </li>

                                @break($loop->index == 2)

                                @empty
                                    <div colspan="100%" class="text-center text-danger mt-2">No Transactions Found!</div>
                                @endforelse

                            </ul>
                            @forelse($transactions as $singleTrx)
                            <div align="center" class="card-footer p-0">
                                <a href="{{ route('user.transactions') }}" class="btn btn-sm btn-mini btn-outline-secondary rounded">Show more</a>
                            </div>
                            @break($loop->index == 0)

                            @empty

                            @endforelse
                            
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Services</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                
                                <a href="{{ route('user.profile.setting') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded">
                                                <span class="material-icons">manage_accounts</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Profile Setting</h6>
                                            <p class="text-secondary">Update account informations</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('user.change.password') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded">
                                                <span class="material-icons">lock_open</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Security Settings</h6>
                                            <p class="text-secondary">Change Password</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('user.address.setting') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded">
                                                <span class="material-icons">location_city</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">My Address</h6>
                                            <p class="text-secondary">Update Address informations</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="{{ $noticeCaption->data_values->appLink }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded">
                                                <span class="material-icons">android</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">App Download</h6>
                                            <p class="text-secondary">Our Official App Download</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('user.logout') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-danger-light text-danger rounded">
                                                <span class="material-icons">power_settings_new</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Logout</h6>
                                            <p class="text-secondary">Logout from the application</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- QrCode Modal -->

        <div class="modal fade" id="QrCodeModal" tabindex="-1" role="dialog" aria-labelledby="QrCodeModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="QrCodeModalCenterTitle">Invite with - QR Code</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div align="center" class="modal-body">
                        <img src="https://chart.googleapis.com/chart?cht=qr&chl={{ route('home') }}?reference={{ auth()->user()->username }}&chs=180x180&choe=UTF-8&chld=L|2" alt="QR Code">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

</body>










    @include(activeTemplate() . 'includes.bottom_nav')
@endsection
