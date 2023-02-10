@extends($activeTemplate.'layouts.master')

@section('content')

<style>
    .form-control {
        line-height: 1.2 !important;
    }
</style>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">

        @include(activeTemplate() . 'includes.top_nav_mini')

        <section class="pt-120 pb-120 section--bg">
            <div class="main-container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="">
                            <div class="card-body">
                                <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p class="text-center mt-2">@lang('You have requested') <b class="text-success">{{ showAmount($data['amount']) }} {{__($general->cur_text)}}</b> , @lang('Please pay')
                                                <b class="text-success">{{showAmount($data['final_amo']) .' '.$data['method_currency'] }} </b> @lang('for successful payment')
                                            </p>
                                            <h5 class="text-center mb-4">@lang('Please follow the instruction')</h5>
        
                                            <p class="my-4 text-center">@php echo $data->gateway->description @endphp</p>

                                        <div class="text-left">
                                            <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />
                                        </div>
                                            
        
                                        </div>
        
                                        
        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary border-custom w-100">@lang('Pay Now')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>
</body>




{{-- <div class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body  ">
                        <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p class="text-center mt-2">@lang('You have requested') <b class="text--success">{{ showAmount($data['amount']) }} {{__($general->cur_text)}}</b> , @lang('Please pay')
                                        <b class="text--success">{{showAmount($data['final_amo']) .' '.$data['method_currency'] }} </b> @lang('for successful payment')
                                    </p>
                                    <h4 class="text-center mb-4">@lang('Please follow the instruction below')</h4>

                                    <p class="my-4 text-center">@php echo $data->gateway->description @endphp</p>

                                </div>

                                <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />

                                <div>
                                    <button type="submit" class="cmn-btn w-100">@lang('Pay Now')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
