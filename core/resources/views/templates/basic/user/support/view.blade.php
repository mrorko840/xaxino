@extends($activeTemplate . 'layouts.' . $layout)

@section('content')

@php
use App\Models\Deposit;
use App\Models\Withdrawal;
    $user                       = auth()->user();
    $widget['total_balance']    = $user->balance;
    $widget['total_deposit']    = Deposit::successful()->where('user_id', $user->id)->sum('amount');
    $widget['total_withdrawn']  = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');
@endphp

<style>
    .custom-select {
        display: inline-block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        vertical-align: middle;
        background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right 0.75rem center/8px 10px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        appearance: none;
    }

    .custom-select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .custom-select:focus::-ms-value {
        color: #495057;
        background-color: #fff;
    }

    .custom-select[multiple],
    .custom-select[size]:not([size="1"]) {
        height: auto;
        padding-right: 0.75rem;
        background-image: none;
    }

    .custom-select:disabled {
        color: #6c757d;
        background-color: #e9ecef;
    }

    .custom-select::-ms-expand {
        display: none;
    }

    .custom-select:-moz-focusring {
        color: transparent;
        text-shadow: 0 0 0 #495057;
    }

    .custom-select-sm {
        height: calc(1.5em + 0.5rem + 2px);
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        font-size: 0.875rem;
    }

    .custom-select-lg {
        height: calc(1.5em + 1rem + 2px);
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 1rem;
        font-size: 1.25rem;
    }

    .custom-file {
        position: relative;
        display: inline-block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        margin-bottom: 0;
    }

    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        margin: 0;
        opacity: 0;
    }

    .custom-file-input:focus~.custom-file-label {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .custom-file-input[disabled]~.custom-file-label,
    .custom-file-input:disabled~.custom-file-label {
        background-color: #e9ecef;
    }

    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Browse";
    }

    .custom-file-input~.custom-file-label[data-browse]::after {
        content: attr(data-browse);
    }

    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .custom-file-label::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        display: block;
        height: calc(1.5em + 0.75rem);
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #495057;
        content: "Browse";
        background-color: #e9ecef;
        border-left: inherit;
        border-radius: 0 0.25rem 0.25rem 0;
    }
</style>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">

    @include(activeTemplate().'includes.side_nav')

        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">
            <!-- Fixed navbar -->
            @include(activeTemplate().'includes.top_nav')

            
                <div class="main-container">
                    <div class="row justify-content-center">
                        <div class="px-4">
                            <div class="card">

                                <div class="button-contain-header d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex align-items-center m-2">
                                        @if($myTicket->status == 0)
                                            <span class="badge badge-success style--light py-2 px-3 border-custom">@lang('Open')</span>
                                        @elseif($myTicket->status == 1)
                                            <span class="badge badge-primary style--light py-2 px-3 border-custom">@lang('Answered')</span>
                                        @elseif($myTicket->status == 2)
                                            <span class="badge badge-info style--light py-2 px-3 border-custom">@lang('Replied')</span>
                                        @elseif($myTicket->status == 3)
                                            <span class="badge badge-dark style--light py-2 px-3 border-custom">@lang('Closed')</span>
                                    @endif
                                        &nbsp;<span>[@lang('Ticket')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}</span>
                                    </div>
                                    <div>
                                        <button class="add-more m-1 btn btn-warning btn-sm btn-mini" title="List">
                                            <a href="{{ route('ticket.index') }}">
                                                <p class="text-white">Ticket</p>
                                            </a>
                                        </button>
                                        @if($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                                        <button class="add-more m-1 btn btn-danger btn-sm btn-mini" data-question="@lang('Are you sure to close this ticket?')" data-action="{{ route('ticket.close', $myTicket->id) }}" data-modal_bg="section--bg" data-btn_class="cmn-btn btn-sm" type="button"><i class="fa fa-lg fa-times-circle"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="card-header card-header-bg d-flex justify-content-between align-items-center flex-wrap">
                                    <h5 class="mt-0 text-white">
                                        @php echo $myTicket->statusBadge; @endphp
                                        [@lang('Ticket')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}
                                    </h5>
                                    @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                                        <button class="btn btn-danger close-button btn-sm confirmationBtn" data-question="@lang('Are you sure to close this ticket?')" data-action="{{ route('ticket.close', $myTicket->id) }}" data-modal_bg="section--bg" data-btn_class="cmn-btn btn-sm" type="button"><i class="fa fa-lg fa-times-circle"></i>
                                        </button>
                                    @endif
                                </div> --}}
                                <div class="card-body">
                                    <form method="post" action="{{ route('ticket.reply', $myTicket->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row justify-content-between">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control form--control" name="message" rows="4">{{ old('message') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a class="cmn-btn btn-sm addFile" href="javascript:void(0)"><i class="fa fa-plus"></i> @lang('Add New')</a>
                                        </div>
                                        <div class="form-group">
                                            <small class="text--danger">@lang('Max 5 files can be uploaded'). @lang('Maximum upload size is') {{ ini_get('upload_max_filesize') }}</small>
                                            
                                            <div class="input-group mb-3">
                                                <div class="custom-file ">
                                                    <input type="file" name="attachments[]" id="inputAttachments" class="custom-file-input " aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label mb-0" for="inputAttachments">@lang('Attachments')</label>
                                                </div>
                                            </div>
                                            <div id="fileUploadsContainer"></div>
                                        </div>
                                        <p class="ticket-attachments-message text-muted my-2">
                                            @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                        </p>
                                        <button class="btn btn-warning border-custom w-100" type="submit"> <i class="fa fa-reply"></i> @lang('Reply')</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="reply-message-area mt-4 ">

                            @foreach ($messages as $message)
                                @if ($message->admin_id == 0)

                                    {{-- <div class="container">
                                        <div class="container">
                                            <div class="row border-info border-custom my-3 mx-2 border py-3" style="background-color: #67edff29">
                                                
                                                <div class="col-md-3 border-end text-end">
                                                    <h5 class="my-3">{{ $message->ticket->name }}</h5>
                                                </div>
                                                <div class=" col-md-9">
                                                    <span class="meta-date text-info">
                                                        @lang('Posted on'), {{ $message->created_at->format('l, dS F Y @ H:i') }}
                                                    </span>
                                                    <br><br>
                                                    <p>
                                                        {{ __($message->message) }}
                                                    </p>
                                                    @if($message->attachments()->count() > 0)
                                                        <div class="mt-2">
                                                            @foreach($message->attachments as $k=> $image)
                                                                <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="container">
                                        <div class="container">
                                            <div class="row border-info border-custom my-3 mx-2 border py-3" style="background-color: #67edff29">
                                             
                                                <div class="col-md-3 border-end text-end">
                                                    <h5 class="my-3">{{ $message->ticket->name }}</h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="text--base">
                                                        @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                                    <p>{{ $message->message }}</p>
                                                    @if ($message->attachments->count() > 0)
                                                        <div class="mt-2">
                                                            @foreach ($message->attachments as $k => $image)
                                                                <a class="me-3" href="{{ route('ticket.download', encrypt($image->id)) }}"><i class="fa fa-file"></i> @lang('Attachment') {{ ++$k }} </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @else

                                    <div class="container">
                                        <div class="container">

                                            <div class="row border-warning border-custom my-3 mx-2 border py-3" style="background-color: #ffd96729">
                                                
                                                <div class="col-md-3 border-end text-end">
                                                    <h5 class="my-3">{{ $message->admin->name }}</h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="text--base">
                                                        @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                                    <p>{{ $message->message }}</p>
                                                    @if ($message->attachments->count() > 0)
                                                        <div class="mt-2">
                                                            @foreach ($message->attachments as $k => $image)
                                                                <a class="me-3" href="{{ route('ticket.download', encrypt($image->id)) }}"><i class="fa fa-file"></i> @lang('Attachment') {{ ++$k }} </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>

                    </div>
                </div>

            <x-confirmation-modal />
        </main>
</body>


@endsection
@push('style')
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="form-group d-flex gap-2 my-2">
                        <div class="input-group mb-3">
                            <div class="custom-file ">
                                <input type="file" id="inputAttachments" name="attachments[]" class="custom-file-input " required/>
                                <label class="custom-file-label mb-0" for="inputAttachments">@lang('Choose file')</label>
                            </div>
                        </div>

                        <div class="add-area">
                            <button class="add-more ml-2 ml-md-4 icon-btn text-white bg-danger btn btn-mini border-custom remove-btn" onclick="extraTicketAttachment()" type="button">
                                <span class="material-icons">remove_circle</span>
                            </button>
                        </div>
                        
                        
                    </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.form-group').remove();
            });
        })(jQuery);
    </script>
@endpush
