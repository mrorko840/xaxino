@extends($activeTemplate.'layouts.master')
@section('content')
<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">
    <!-- Top navbar -->
    @include($activeTemplate . 'includes.side_nav')

    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav')

        <form action="{{route('user.deposit.insert')}}" method="post">
            @csrf
            <input type="hidden" name="method_code">
            <input type="hidden" name="currency">

        <div class="main-container">
            <div class="container mb-4">
                <p class="text-center text-secondary mb-1">Enter Amount to Add</p>
                <div class="form-group mb-1">
                    <input type="number" step="any" name="amount" class="form-control large-gift-card" value="{{ old('amount') }}" autocomplete="off" placeholder="00.00" required>
                </div>
                <p class="text-center text-secondary mb-4">Available: {{ $general->cur_sym }} {{ showAmount($widget['total_balance']) }} </p>
                <div class="form-group position-relative">
                    <div class="bottom-right mb-1 mr-1">
                        <button class="btn btn-sm btn-success rounded">Apply</button>
                    </div>
                    <input type="text" class="form-control" placeholder="Promo Code (optional)">
                </div>
                {{-- <div class="alert alert-success">
                    <div class="media">
                        <div class="icon icon-40 bg-white text-success mr-2 rounded-circle"><i class="material-icons">local_offer</i></div>
                        <div class="media-inner">
                            <h6 class="mb-0 font-weight-normal">
                                <b>10%</b> season discount<br>
                                <small class="text-mute">Offer applied you will get <b>$ 10</b></small>
                            </h6>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="container mb-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="paynow" class="custom-control-input" id="pay3" checked="">
                                    <label class="custom-control-label" for="pay3"></label>
                                </div>
                            </div>

                            <div class="col pl-0">
                                <h6 class="subtitle mb-0">Add via</h6>
                            </div>
                            <div class="col-7">
                                <select style="height: fit-content;" class="form-control form-select p-0 ps-1" name="gateway" required>
                                    <option value="">@lang('Select One')</option>
                                    @foreach($gatewayCurrency as $data)
                                    <option value="{{$data->method_code}}" @selected(old('gateway')==$data->method_code) data-gateway="{{ $data }}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-4 preview-details d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <ul class="list-group list-group-flush payment-list">
                                    <li style="border-width: 0 0 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Limit')</span>
                                        <span><span class="min fw-bold">0</span> {{__($general->cur_text)}} - <span class="max fw-bold">0</span> {{__($general->cur_text)}}</span>
                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Charge')</span>
                                        <span><span class="charge fw-bold">0</span> {{__($general->cur_text)}}</span>
                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item d-flex justify-content-between">
                                        <span>@lang('Payable')</span> <span><span class="payable fw-bold"> 0</span> {{__($general->cur_text)}}</span>
                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item justify-content-between d-none rate-element">

                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item justify-content-between d-none in-site-cur">
                                        <span>@lang('In') <span class="method_currency"></span></span>
                                        <span class="final_amo fw-bold">0</span>
                                    </li>
                                    <li style="border-width: 0 0 0;" class="list-group-item justify-content-center crypto_currency d-none">
                                        <span>@lang('Conversion with') <span class="method_currency"></span> @lang('and final value will Show on next step')</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="container mb-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <div class="custom-control custom-switch">
                                    <input type="radio" name="paynow" class="custom-control-input" id="pay2" checked="">
                                    <label class="custom-control-label" for="pay2"></label>
                                </div>
                            </div>
                            <div class="col pl-0">
                                <h6 class="subtitle mb-0">Add using card</h6>
                            </div>
                            <div class="col-auto pl-0">
                                <p class="text-secondary text-center"><a href="addcard.html">Add </a></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="swiper-container swipercards">
                            <div class="swiper-wrapper pb-4">
                                <div class="swiper-slide ">
                                    <div class="card border-0 bg-default text-white">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <i class="material-icons vm text-template">credit_card</i>
                                                </div>
                                                <div class="col pl-0">
                                                    <h6 class="mb-1">Visa</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="mb-0 mt-3">4444 5264 2541 26651</h5>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="mb-0">26/21</p>
                                                    <p class="small ">Expiry date</p>
                                                </div>
                                                <div class="col-auto align-self-center text-right">
                                                    <p class="mb-0">Agnish Carvan</p>
                                                    <p class="small">Card Holder</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide ">
                                    <div class="card border-0 bg-warning text-white">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <i class="material-icons vm text-template">credit_card</i>
                                                </div>
                                                <div class="col pl-0">
                                                    <h6 class="mb-1">Maestro</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="mb-0 mt-3">4444 5264 2541 26651</h5>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="mb-0">26/21</p>
                                                    <p class="small ">Expiry date</p>
                                                </div>
                                                <div class="col-auto align-self-center text-right">
                                                    <p class="mb-0">Agnish Carvan</p>
                                                    <p class="small">Card Holder</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card border-0 bg-danger text-white">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <i class="material-icons vm text-template">credit_card</i>
                                                </div>
                                                <div class="col pl-0">
                                                    <h6 class="mb-1">Payme</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="mb-0 mt-3">4444 5264 2541 26651</h5>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="mb-0">26/21</p>
                                                    <p class="small ">Expiry date</p>
                                                </div>
                                                <div class="col-auto align-self-center text-right">
                                                    <p class="mb-0">Agnish Carvan</p>
                                                    <p class="small">Card Holder</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            

            <div class="container text-center">
                <button type="submit" class="btn btn-default mb-2 mx-auto rounded">Add Money</button>
                {{-- <a href="thank_you.html" class="btn btn-default mb-2 mx-auto rounded">Add Money</a> --}}
            </div>
        </div>

        <div style="height: 70px"></div>

        </form>

    </main>



    <!-- footer-->
    @include($activeTemplate . 'includes.bottom_nav')

        
</body>






{{-- <div class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="{{route('user.deposit.insert')}}" method="post">
                    @csrf
                    <input type="hidden" name="method_code">
                    <input type="hidden" name="currency">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="form-group">
                                    <label class="form-label">@lang('Select Gateway')</label>
                                    <select class="form-control form--control form-select" name="gateway" required>
                                        <option value="">@lang('Select One')</option>
                                        @foreach($gatewayCurrency as $data)
                                        <option value="{{$data->method_code}}" @selected(old('gateway')==$data->method_code) data-gateway="{{ $data }}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">@lang('Amount')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="amount" class="form-control form--control" value="{{ old('amount') }}" autocomplete="off" required>
                                        <span class="input-group-text">{{ $general->cur_text }}</span>
                                    </div>
                                </div>

                                <div class="preview-details d-none">
                                    <ul class="list-group list-group-flush payment-list">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>@lang('Limit')</span>
                                            <span><span class="min fw-bold">0</span> {{__($general->cur_text)}} - <span class="max fw-bold">0</span> {{__($general->cur_text)}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>@lang('Charge')</span>
                                            <span><span class="charge fw-bold">0</span> {{__($general->cur_text)}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>@lang('Payable')</span> <span><span class="payable fw-bold"> 0</span> {{__($general->cur_text)}}</span>
                                        </li>
                                        <li class="list-group-item justify-content-between d-none rate-element">

                                        </li>
                                        <li class="list-group-item justify-content-between d-none in-site-cur">
                                            <span>@lang('In') <span class="method_currency"></span></span>
                                            <span class="final_amo fw-bold">0</span>
                                        </li>
                                        <li class="list-group-item justify-content-center crypto_currency d-none">
                                            <span>@lang('Conversion with') <span class="method_currency"></span> @lang('and final value will Show on next step')</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button type="submit" class="cmn-btn w-100 mt-3">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection


@push('script')
<script>
    (function ($) {
            "use strict";
            $('select[name=gateway]').change(function(){
                if(!$('select[name=gateway]').val()){
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                var resource = $('select[name=gateway] option:selected').data('gateway');
                var fixed_charge = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate = parseFloat(resource.rate)
                if(resource.method.crypto == 1){
                    var toFixedDigit = 8;
                    $('.crypto_currency').removeClass('d-none');
                }else{
                    var toFixedDigit = 2;
                    $('.crypto_currency').addClass('d-none');
                }
                $('.min').text(parseFloat(resource.min_amount).toFixed(2));
                $('.max').text(parseFloat(resource.max_amount).toFixed(2));
                var amount = parseFloat($('input[name=amount]').val());
                if (!amount) {
                    amount = 0;
                }
                if(amount <= 0){
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                $('.preview-details').removeClass('d-none');
                var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                $('.charge').text(charge);
                var payable = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);
                $('.payable').text(payable);
                var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge)))*rate).toFixed(toFixedDigit);
                $('.final_amo').text(final_amo);
                if (resource.currency != '{{ $general->cur_text }}') {
                    var rateElement = `<span class="fw-bold">@lang('Conversion Rate')</span> <span><span  class="fw-bold">1 {{__($general->cur_text)}} = <span class="rate">${rate}</span>  <span class="method_currency">${resource.currency}</span></span></span>`;
                    $('.rate-element').html(rateElement)
                    $('.rate-element').removeClass('d-none');
                    $('.in-site-cur').removeClass('d-none');
                    $('.rate-element').addClass('d-flex');
                    $('.in-site-cur').addClass('d-flex');
                }else{
                    $('.rate-element').html('')
                    $('.rate-element').addClass('d-none');
                    $('.in-site-cur').addClass('d-none');
                    $('.rate-element').removeClass('d-flex');
                    $('.in-site-cur').removeClass('d-flex');
                }
                $('.method_currency').text(resource.currency);
                $('input[name=currency]').val(resource.currency);
                $('input[name=method_code]').val(resource.method_code);
                $('input[name=amount]').on('input');
            });
            $('input[name=amount]').on('input',function(){
                $('select[name=gateway]').change();
                $('.amount').text(parseFloat($(this).val()).toFixed(2));
            });
        })(jQuery);
</script>
@endpush