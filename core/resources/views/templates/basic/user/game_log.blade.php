@extends($activeTemplate . 'layouts.master')
@section('content')


<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        @include(activeTemplate() . 'includes.top_nav_mini')

        <div class="main-container">
            {{-- <div class="container">
                <form action="">
                    <div class="d-flex justify-content-end ms-auto table--form mb- mb-3 flex-wrap">
                        <div class="input-group">

                            <input class="form-control border-custom mr-2" name="search" type="text" value="{{ request()->search }}" placeholder="@lang('Search by transactions')">
                        
                            <button class="input-group-text text-white border-custom bg-warning">
                                <span class="material-icons">
                                    search
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div> --}}

            @forelse($logs as $log)
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-60 rounded">
                                    <div class="background">
                                        @if(@$log->game->image)
                                            <img src="{{ getImage(getFilePath('game') . '/' . $log->game->image, getFileSize('game')) }}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1">
                                    {{ __($log->game->name) }}
                                </h6>

                                <p class="small text-secondary">
                                    You Select: 
                                    <b class="@if($log->win_status != Status::LOSS) text-success @else text-danger @endif">
                                        @if (gettype(json_decode($log->user_select)) == 'array')
                                            {{ implode(', ', json_decode($log->user_select)) }}
                                        @else
                                            {{ __($log->user_select) }}
                                        @endif
                                    </b>
                                    <br>
                                    Result:
                                    <b class="@if($log->win_status != Status::LOSS) text-success @else text-danger @endif"> 
                                        @if (gettype(json_decode($log->result)) == 'array')
                                            {{ implode(', ', json_decode($log->result)) }}
                                        @else
                                            {{ __($log->result) }}
                                        @endif
                                    </b>
                                    <br>
                                    {{showDateTime($log->created_at, 'd-m-Y')}} | {{ diffForHumans($log->created_at) }}
                                </p>
                            </div>

                            <div class="col-auto text-center">
                                <b class="@if($log->win_status != Status::LOSS) text-success @else text-danger @endif">
                                    {{ $general->cur_sym }}{{getAmount($log->invest) }}
                                </b>
                                <br>
                                @if($log->win_status != Status::LOSS)
                                    <span class="badge badge-success style--light px-2">@lang('Win')</span>
                                @else
                                    <span class="badge badge-danger style--light px-2">@lang('Lost')</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
            @endforelse 

            @if ($logs->hasPages())
                <div class="">
                    {{ paginateLinks($logs) }}
                </div>
            @endif

        </div>

        

    </main>
</body>




    {{-- <div class="pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table--responsive">
                                <table class="style--two table">
                                    <thead>
                                        <tr>
                                            <th>@lang('Game Name')</th>
                                            <th>@lang('You Select')</th>
                                            <th>@lang('Result')</th>
                                            <th>@lang('Invest')</th>
                                            <th>@lang('Win or Lost')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($logs as $log)
                                            <tr>
                                                <td>
                                                    <span class="text-end">{{ __($log->game->name) }}</span>
                                                </td>
                                                <td>
                                                    <div>
                                                        @if (gettype(json_decode($log->user_select)) == 'array')
                                                            {{ implode(', ', json_decode($log->user_select)) }}
                                                        @else
                                                            {{ __($log->user_select) }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        @if (gettype(json_decode($log->result)) == 'array')
                                                            {{ implode(', ', json_decode($log->result)) }}
                                                        @else
                                                            {{ __($log->result) }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td><span>{{ $general->cur_sym }}{{getAmount($log->invest) }}</span> </td>
                                                <td>
                                                    @if ($log->win_status != Status::LOSS)
                                                        <span class="badge badge--success"><i class="las la-smile"></i> @lang('Win')</span>
                                                    @else
                                                        <span class="badge badge--danger"><i class="las la-frown"></i> @lang('Lost')</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($logs->hasPages())
                            <div class="card-footer">
                                {{ paginateLinks($logs) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


@endsection
