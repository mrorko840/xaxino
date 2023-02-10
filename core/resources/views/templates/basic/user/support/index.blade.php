
@extends($activeTemplate . 'layouts.master')
@section('content')
@php
    use App\Models\Deposit;
    use App\Models\Withdrawal;
    $user                       = auth()->user();
    $widget['total_balance']    = $user->balance;
    $widget['total_deposit']    = Deposit::successful()->where('user_id', $user->id)->sum('amount');
    $widget['total_withdrawn']  = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');
@endphp

<!-- Begin page content -->
<main class="flex-shrink-0 main">
    <!-- Fixed navbar -->
    @include(activeTemplate() . 'includes.top_nav_mini')
  
    <div class="main-container">
      @forelse($supports as $key => $support) 
        <div class="container">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto pr-0">
                          <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle text-danger">
                            <i class="material-icons vm text-template">support_agent</i>
                          </div>
                        </div>
                        <div class="col align-self-center pr-0">
                            <h6 class="font-weight-normal mb-1"><a class="text-primary" href="{{ route('ticket.view', $support->ticket) }}">{{ __($support->subject) }}</a></h6>
                            <p class="small text-secondary">[Ticket#{{ $support->ticket }}]</p>
                            <p class="small text-info">
                              Last Reply {{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }}
                            </p>
                        </div>
  
                        <div align="center" class="col-auto">
                            <a href="{{ route('ticket.view', $support->ticket) }}"><span class="material-icons btn btn-sm btn-mini btn-warning text-white">visibility</span></a>
                            <br>
                            @if($support->status == 0)
                                <span align="center" class="badge badge-secondary style--light border-custom">@lang('Open')</span>
                            @elseif($support->status == 1)
                                <span align="center" class="badge badge-primary style--light">@lang('Answered')</span>
                            @elseif($support->status == 2)
                                <span align="center" class="badge badge-info style--light">@lang('Replied')</span>
                            @elseif($support->status == 3)
                                <span align="center" class="badge badge-danger style--light">@lang('Closed')</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <tr>
                <td colspan="100%" class="text-center">@lang('Data Not Found')!</td>
            </tr>
        @endforelse 
    </div>
</main>



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
                                            <th>@lang('Subject')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Priority')</th>
                                            <th>@lang('Last Reply')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($supports as $support)
                                            <tr>
                                                <td>
                                                    <a class="fw-bold text-end" href="{{ route('ticket.view', $support->ticket) }}"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a>
                                                </td>
                                                <td>
                                                    @php echo $support->statusBadge; @endphp
                                                </td>
                                                <td>
                                                    @if ($support->priority == Status::PRIORITY_LOW)
                                                        <span class="badge badge--warning">@lang('Low')</span>
                                                    @elseif($support->priority == Status::PRIORITY_MEDIUM)
                                                        <span class="badge badge--success">@lang('Medium')</span>
                                                    @elseif($support->priority == Status::PRIORITY_HIGH)
                                                        <span class="badge badge--primary">@lang('High')</span>
                                                    @endif
                                                </td>
                                                <td>{{ diffForHumans($support->last_reply) }} </td>

                                                <td>
                                                    <a class="btn base--bg btn-sm" href="{{ route('ticket.view', $support->ticket) }}">
                                                        <i class="fa fa-desktop"></i>
                                                    </a>
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
                    </div>
                    {{ paginateLinks($supports) }}
                </div>
            </div>
        </div>
    </div> --}}
@endsection
