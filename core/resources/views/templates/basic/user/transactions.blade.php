@extends($activeTemplate . 'layouts.master')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    
    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="main-container">

            <div class="container">

                <div class="card responsive-filter-card mb-4">
                    <div class="card-body">
                        <form action="">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('Transaction Number')</label>
                                    <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                                </div>
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('Type')</label>
                                    <select class="form-control form-select" name="trx_type">
                                        <option value="">@lang('All')</option>
                                        <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                        <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('Remark')</label>
                                    <select class="form-control form-select" name="remark">
                                        <option value="">@lang('Any')</option>
                                        @foreach ($remarks as $remark)
                                        <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>{{ __(keyToTitle($remark->remark)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-grow-1 align-self-end p-1">
                                    <button class="btn btn-warning border-custom w-100">@lang('Filter')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            @forelse($transactions as $trx)  
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-50 rounded">
                                  <div class="background">
                                    @if($trx->logo_type == 'deposit' || $trx->remark == 'deposit')
                                        <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $trx->trx_logo,imagePath()['gateway']['size'])}}" alt="">
                                    @elseif($trx->logo_type == 'withdraw' || $trx->remark == 'withdraw')
                                        <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $trx->trx_logo,imagePath()['gateway']['size'])}}" alt="">
                                    @elseif($trx->logo_type == 'admin' || ($trx->remark == 'balance_add') || ($trx->remark == 'balance_subtract') || ($trx->remark == 'register_bonus'))
                                        <img src="{{ asset($activeTemplateTrue . '/assets/img/services/' . $trx->trx_logo ) }}" alt="">
                                    @elseif(($trx->remark == 'invest') || ($trx->remark == 'Win_Bonus') || ($trx->remark == 'invest_back'))
                                        <img src="{{ getImage(getFilePath('game') . '/' . $trx->trx_logo, getFileSize('game')) }}" alt="">
                                    @endif
                                </div>
                                </div>
                            </div>

                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1"> {{ __(@$trx->details) }}</h6>
                                <p class="small text-secondary">{{ showDateTime($trx->created_at, 'd-m-Y') }} | 
                                    {{ diffForHumans($trx->created_at) }}
                                    <br>
                                    Trx: <b class="text-info">{{ $trx->trx }}</b>
                                </p>
                                
                                
                            </div>
      
                            <div class="col-auto">

                              <h6 class="@if(($trx->trx_type)=='+') {{'text-success'}} @else {{'text-danger'}} @endif">
      
                                  @if(getAmount($trx->amount) != 0)
                                  {{ __($trx->trx_type) }}
                                  {{ __($general->cur_sym) }}
                                  {{ getAmount($trx->amount) }}
                                  
                                  @else
                                  {{ __($trx->trx_type) }}
                                  {{ __($general->cur_sym) }}
                                  {{ getAmount($trx->charge) }}
                                  @endif
                                  
                              </h6>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @empty
              <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
            @endforelse 

            @if ($transactions->hasPages())
            <div class="container">
                <div style="margin: 0 auto; justify-content: center;" class="row-12">
                        {{ paginateLinks($transactions) }}
                </div>
                
            </div>
            @endif


        </div>

    </main>

</body>







{{-- <div class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="show-filter text-end mb-3">
                    <button class="cmn-btn showFilterBtn btn-sm" type="button"><i class="las la-filter"></i> @lang('Filter')</button>
                </div>
                <div class="card responsive-filter-card mb-4">
                    <div class="card-body">
                        <form action="">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="flex-grow-1">
                                    <label>@lang('Transaction Number')</label>
                                    <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                                </div>
                                <div class="flex-grow-1">
                                    <label>@lang('Type')</label>
                                    <select class="form-control form-select" name="trx_type">
                                        <option value="">@lang('All')</option>
                                        <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                        <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1">
                                    <label>@lang('Remark')</label>
                                    <select class="form-control form-select" name="remark">
                                        <option value="">@lang('Any')</option>
                                        @foreach ($remarks as $remark)
                                        <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>{{ __(keyToTitle($remark->remark)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-grow-1 align-self-end">
                                    <button class="cmn-btn w-100"><i class="las la-filter"></i> @lang('Filter')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table--responsive">
                            <table class="style--two table">
                                <thead>
                                    <tr>
                                        <th>@lang('Trx')</th>
                                        <th>@lang('Transacted')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Post Balance')</th>
                                        <th>@lang('Detail')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $trx)
                                    <tr>
                                        <td>
                                            <strong>{{ $trx->trx }}</strong>
                                        </td>

                                        <td>
                                            {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                        </td>

                                        <td class="budget">
                                            <span class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                                {{ $trx->trx_type }} {{ showAmount($trx->amount) }} {{ $general->cur_text }}
                                            </span>
                                        </td>

                                        <td class="budget">
                                            {{ showAmount($trx->post_balance) }} {{ __($general->cur_text) }}
                                        </td>

                                        <td>{{ __($trx->details) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($transactions->hasPages())
                    <div class="card-footer">
                        {{ paginateLinks($transactions) }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection