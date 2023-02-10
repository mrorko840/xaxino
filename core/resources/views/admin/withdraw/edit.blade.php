@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.withdraw.method.update', $method->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="payment-method-item">
                            
                            <div class="payment-method-header d-flex flex-wrap">

                                <div class="thumb col-auto">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url('{{getImage(imagePath()['gateway']['path'].'/'. $method->image,imagePath()['gateway']['path'])}}')"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                        <label for="image" class="bg-primary"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>@lang('Name')</label>
                                <input class="form-control" name="name" type="text" value="{{ $method->name }}" required />
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Currency')</label>
                                        <div class="input-group">
                                            <input class="form-control border-radius-5" name="currency" type="text" value="{{ $method->currency }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Rate')</label>
                                        <div class="input-group">
                                            <span class="input-group-text">1 {{ __($general->cur_text) }}
                                                =
                                            </span>
                                            <input class="form-control" name="rate" type="text" value="{{ getAmount($method->rate) }}" required />
                                            <span class="currency_symbol input-group-text"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card border--primary mb-2">
                                            <h5 class="card-header bg--primary">@lang('Range')</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>@lang('Minimum Amount')</label>
                                                    <div class="input-group">
                                                        <input class="form-control" name="min_limit" type="text" value="{{ getAmount($method->min_limit) }}" required />
                                                        <span class="input-group-text"> {{ __($general->cur_text) }} </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>@lang('Maximum Amount')</label>
                                                    <div class="input-group">
                                                        <input class="form-control" name="max_limit" type="text" value="{{ getAmount($method->max_limit) }}" required />
                                                        <span class="input-group-text"> {{ __($general->cur_text) }} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card border--primary">
                                            <h5 class="card-header bg--primary">@lang('Charge')</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>@lang('Fixed Charge')</label>
                                                    <div class="input-group">
                                                        <input class="form-control" name="fixed_charge" type="text" value="{{ getAmount($method->fixed_charge) }}" required />
                                                        <span class="input-group-text"> {{ __($general->cur_text) }} </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>@lang('Percent Charge')</label>
                                                    <div class="input-group">
                                                        <input class="form-control" name="percent_charge" type="text" value="{{ getAmount($method->percent_charge) }}" required>
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--dark my-2">
                                            <h5 class="card-header bg--dark">@lang('Withdraw Instruction') </h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control border-radius-5 nicEdit" name="instruction" rows="5">{{ $method->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--primary mt-3">
                                            <div class="card-header bg--primary d-flex justify-content-between">
                                                <h5 class="text-white">@lang('User Data')</h5>
                                                <button class="btn btn-sm btn-outline-light float-end form-generate-btn" type="button"> <i class="la la-fw la-plus"></i>@lang('Add New')</button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row addedField">
                                                    @if ($form)
                                                        @foreach ($form->form_data as $formData)
                                                            <div class="col-md-4">
                                                                <div class="card mb-3 border" id="{{ $loop->index }}">
                                                                    <input name="form_generator[is_required][]" type="hidden" value="{{ $formData->is_required }}">
                                                                    <input name="form_generator[extensions][]" type="hidden" value="{{ $formData->extensions }}">
                                                                    <input name="form_generator[options][]" type="hidden" value="{{ implode(',', $formData->options) }}">

                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <label>@lang('Label')</label>
                                                                            <input class="form-control" name="form_generator[form_label][]" type="text" value="{{ $formData->name }}" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>@lang('Type')</label>
                                                                            <input class="form-control" name="form_generator[form_type][]" type="text" value="{{ $formData->type }}" readonly>
                                                                        </div>
                                                                        @php
                                                                            $jsonData = json_encode([
                                                                                'type' => $formData->type,
                                                                                'is_required' => $formData->is_required,
                                                                                'label' => $formData->name,
                                                                                'extensions' => explode(',', $formData->extensions) ?? 'null',
                                                                                'options' => $formData->options,
                                                                                'old_id' => '',
                                                                            ]);
                                                                        @endphp
                                                                        <div class="btn-group w-100">
                                                                            <button class="btn btn--primary editFormData" data-form_item="{{ $jsonData }}" data-update_id="{{ $loop->index }}" type="button"><i class="las la-pen"></i></button>
                                                                            <button class="btn btn--danger removeFormData" type="button"><i class="las la-times"></i></button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>

    <x-form-generator />
@endsection

@push('script')
    <script>
        "use strict"
        var formGenerator = new FormGenerator();
        formGenerator.totalField = {{ $form ? count((array) $form->form_data) : 0 }}
    </script>

    <script src="{{ asset('assets/global/js/form_actions.js') }}"></script>
@endpush

@push('breadcrumb-plugins')
        <x-back route="{{ route('admin.withdraw.method.index') }}" />
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('input[name=currency]').on('input', function() {
                $('.currency_symbol').text($(this).val());
            });
            $('.currency_symbol').text($('input[name=currency]').val());

            $('.addUserData').on('click', function() {
                var html = `
                <div class="col-md-12 user-data">
                    <div class="form-group">
                        <div class="input-group mb-md-0 mb-4">
                            <div class="col-md-4">
                                <input name="field_name[]" class="form-control" type="text" required>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="type[]" class="form-control" required>
                                    <option value="text" > @lang('Input Text') </option>
                                    <option value="textarea" > @lang('Textarea') </option>
                                    <option value="file"> @lang('File') </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="validation[]"
                                        class="form-control" required>
                                    <option value="required"> @lang('Required') </option>
                                    <option value="nullable">  @lang('Optional') </option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2 text-end">
                                <span class="input-group-btn">
                                    <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>`;

                $('.addedField').append(html);
            });


            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.user-data').remove();
            });

            @if (old('currency'))
                $('input[name=currency]').trigger('input');
            @endif
        })(jQuery);
    </script>
@endpush