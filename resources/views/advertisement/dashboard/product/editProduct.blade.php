@extends('advertisement.layouts.common') 
@push('custom-scripts')
    <script src="{{asset('public/assets/advertisement/js/plugins/forms/validation/validate.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/switch.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script src="{{asset('public/assets/advertisement/js/plugins/uploaders/dropzone.min.js')}}"></script>
    <script src="{{asset('public/assets/advertisement/js/plugins/editors/summernote/summernote.min.js')}}"></script>
   
    <script src="{{asset('public/global_assets/js/demo_pages/uploader_dropzone.js')}}"></script>
    <script src="{{asset('public/global_assets/js/demo_pages/editor_summernote.js')}}"></script>
    <script src="{{asset('public/global_assets/js/demo_pages/form_validation.js')}}"></script>
 
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
            $('#formadd').validate({// initialize the plugin
                rules: {
                    title: { 
                        required: true 
                    },
                    category_id: { 
                        required: true 
                    },
                    sub_category_id: { 
                        required: true 
                    },
                    quantity: { 
                        required: true 
                    },
                    unit_id: { 
                        required: true 
                    },
                    price: { 
                        required: true 
                    },
                    is_organic: { 
                        required: true 
                    },
                    selling_frequency: { 
                        required: true 
                    },
                    
                },
                messages: {
                    title: "{{ __('product.validation.ad_title_required') }}",
                    category_id: "{{ __('product.validation.category_required') }}",
                    sub_category_id: "{{ __('product.validation.sub_category_required') }}",
                    quantity: "{{ __('product.validation.quantity_required') }}",
                    unit_id: "{{ __('product.validation.unit_required') }}",
                    price: "{{ __('product.validation.price_required') }}",
                    is_organic: "{{ __('product.validation.is_organic_required') }}",
                    selling_frequency: "{{ __('product.validation.selling_frequency_required') }}",
                },
                errorClass: 'error m-error',
                errorElement: 'small',
                errorPlacement: function (error, element) {
                    error.css({
                        'font-size': '13px',
                        'color': '#f44336'
                    });

                    if (element.hasClass('select2-hidden-accessible')) {
                        error.insertAfter(element.next('span')); // select2
                        element.next('span').addClass('error').removeClass('valid');
                    } else if (element.attr("type") === "checkbox" || element.attr("type") === "radio") {
                        error.insertAfter(element.closest('.form-check, .custom-control')); // For checkbox
                    } else {
                        error.insertAfter(element); // Default
                    }
                }
            });
        });

        //Seller and Buyer Tab
        $('input[name="lead_type"]').on('change', function () {
            $('.nav-link').removeClass('active show');

            const selectedId = $(this).attr('id');
            $('label[for="' + selectedId + '"]').addClass('active show');
        });

        // State and district dependend dropdown
        const districtUrl = "{{ url('/ads/districts') }}";

        $('#state').change(function() {
            let state_id = $(this).val();
            $.get(districtUrl + '/' + state_id, function(data) {
                let options = '<option>{{ __('common.select_district') }}</option>';
                data.forEach(d => options += `<option value="${d.id}">${d.name}</option>`);
                $('#district').html(options);
            });
        });

        // Category and Sub Category dependend dropdown
        const subCategoryUrl = "{{ url('/ads/sub-categories') }}";

        $('#category').change(function() {
            let category_id = $(this).val();
            $.get(subCategoryUrl + '/' + category_id, function(data) {
                let options = '<option>{{ __('common.select_subcategory') }}</option>';
                data.forEach(d => options += `<option value="${d.id}">${d.name}</option>`);
                $('#sub_category').html(options);
            });
        });

        //code for image

        Dropzone.autoDiscover = false;

        const dropzone = new Dropzone("#dropzoneUploader", {
            url: "#",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 2,
            addRemoveLinks: true,
            acceptedFiles: ".jpg,.jpeg,.png",
            clickable: true,
            previewsContainer: "#dropzoneUploader",
            dictDefaultMessage: "{{ __('product.upload_product_image') }}",
            dictFileTooBig: "{{ __('product.validation.product_image_max') }}",
            dictInvalidFileType: "{{ __('product.validation.product_image_mimes') }}",

            init: function () {
                this.on("addedfile", function (file) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    document.querySelector('#uploaded_files').files = dataTransfer.files;
                });

                this.on("removedfile", function (file) {
                    document.querySelector('#uploaded_files').value = "";
                });

                // Error handler for size or format
                this.on("error", function (file, message) {
                    alert(message); // toast/warning वापरा
                    this.removeFile(file);
                });
            }
        });

        //Code for change Unit Price placehoder value
        $(document).ready(function () {
            const locale = "{{ $locale }}";
    
            const pricePlaceholders = {
                en: "{{ __('product.price_placeholder') }}",
                hi: "{{ __('product.price_placeholder') }}",
                mr: "{{ __('product.price_placeholder') }}"
            };

            // 3. Event listener for unit select
            $('#unit-price').on('change', function () {
                const selected = $(this).find('option:selected');
                const unitName = selected.data(locale);

                if (unitName) {
                    const template = pricePlaceholders[locale];
                    const message = template.replace(':unit', unitName);
                    $('#price-input').attr('placeholder', message);
                } else {
                    $('#price-input').attr('placeholder', "{{ __('product.enter_price') }}");
                }
            });
        });
        
        //TexEditor Script
        $('#summernote').summernote({
            height: 150,
            tabsize: 2
        });

        //For old and new address

        $(document).ready(function () {
            var form = $('#formadd');

            $('input[name="address_link"]').change(function () {
                if ($(this).val() === '1') { // value="1" means new address
                    $('#new-address-section').slideDown();

                    form.find('#state').rules('add', {
                        required: true,
                        messages: {
                            required: "{{ __('common.validation.state_required') }}"
                        }
                    });

                    form.find('#district').rules('add', {
                        required: true,
                        messages: {
                            required: "{{ __('common.validation.district_required') }}"
                        }
                    });

                    form.find('#address').rules('add', {
                        required: true,
                        messages: {
                            required: "{{ __('common.validation.address_required') }}"
                        }
                    });

                } else {
                    $('#new-address-section').slideUp();

                    form.find('#state').rules('remove', 'required');
                    form.find('#district').rules('remove', 'required');
                    form.find('#address').rules('remove', 'required');
                }
            });

            // Optional: trigger change on load if default is selected
            $('input[name="address_link"]:checked').trigger('change');
        });

    </script>
@endpush
@push('custom-css')
<style>
    form.dropzone {
        border: none !important;
    }
</style>
@endpush

@section('content')
    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h2 class="card-title">Required information</h2> --}}
                        <div class="text-center mb-3">
                            <i class="icon-pencil5 icon-2x text-success border-success border-3 rounded-round p-3 mb-2 mt-1"></i>
                            <h1 class="card-title">{{ __('product.title') }}</h1>
                            <p class="mb-4">{{ __('product.subtitle') }}</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" class="flex-fill dropzone" action="{{route('ads.editAdsProduct',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>{{ __('product.lead_title') }}</b>
                                            <div class="nav nav-pills nav-pills-bordered mt-2">
                                                <input type="radio" class="d-none" name="lead_type" value="0" id="active_tab" {{ old('lead_type', $update->lead_type) == 0 ? 'checked' : '' }}>
                                                <label for="active_tab" class="nav-link rounded-round {{ old('lead_type', $update->lead_type) == 0 ? 'active' : '' }} show mr-2" style="cursor: pointer;"><b>{{ __('common.sell') }}</b></label>

                                                <input type="radio" class="d-none" name="lead_type" value="1" id="inactive_tab" {{ old('lead_type', $update->lead_type) == 1 ? 'checked' : '' }}>
                                                <label for="inactive_tab" class="nav-link rounded-round {{ old('lead_type', $update->lead_type) == 1 ? 'active' : '' }}" style="cursor: pointer;"><b>{{ __('common.buy') }}</b></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
                                                <input type="text" name="title" class="form-control" placeholder="{{ __('product.ad_title_placeholder') }}" value="{{$update->title}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-pen-plus text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <select class="form-control required select2 select" name="category_id" id="category">
                                                <option value="">{{ __('common.select_category') }}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{ $update->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <select class="form-control required select2 select" name="sub_category_id" id="sub_category">
                                                <option value="{{$update->sub_category_id}}">{{ $update->subcategory->name ?? __('common.select_subcategory') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
                                                <input type="text" name="variety" class="form-control" placeholder="{{ __('product.enter_variety') }}" value="{{$update->variety}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-pen-plus text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
                                                <input type="text" name="quantity" class="form-control" placeholder="{{ __('product.enter_quantity') }}" value="{{$update->quantity}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-pen-plus text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <select class="form-control required select2 select" name="unit_id" id="unit-price">
                                                <option value="">{{ __('common.select_unit') }}</option>
                                                @foreach($units as $unit)
                                                    <option value="{{$unit->id}}" data-en="{{ $unit->en_name }}" data-hi="{{ $unit->hi_name }}" data-mr="{{ $unit->mr_name }}" {{ $update->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit[$locale . '_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
                                                <input type="text" name="price" id="price-input" class="form-control" placeholder="{{ __('product.enter_price') }}" value="{{$update->price}}">
                                                <div class="form-control-feedback">
                                                    <i class="icon-pen-plus text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12 mb-3">
                                            <label class="d-block font-weight-semibold mb-2"><b>{{ __('product.is_organic') }}</b></label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="is_organic" id="organic_yes" value="1" {{ old('is_organic', $update->is_organic) == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="organic_yes">{{ __('product.yes') }}</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="is_organic" id="organic_no" value="0" {{ old('is_organic', $update->is_organic) == 0 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="organic_no">{{ __('product.no') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12 mb-3">
                                            <label class="d-block font-weight-semibold mb-2"><b>{{ __('product.selling_frequency_question') }}</b></label>

                                            @php
                                                $selectedFrequency = old('selling', $update->selling ?? '');
                                            @endphp

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="selling_frequency" id="sell_once" value="Once" {{ $selectedFrequency == 'Once' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="sell_once">{{ __('product.once') }}</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="selling_frequency" id="sell_daily" value="Daily" {{ $selectedFrequency == 'Daily' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="sell_daily">{{ __('product.daily') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="selling_frequency" id="sell_weekly" value="Weekly" {{ $selectedFrequency == 'Weekly' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="sell_weekly">{{ __('product.weekly') }}</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="selling_frequency" id="sell_monthly" value="Monthly" {{ $selectedFrequency == 'Monthly' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="sell_monthly">{{ __('product.monthly') }}</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="selling_frequency" id="sell_seasonal" value="Seasonal" {{ $selectedFrequency == 'Seasonal' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="sell_seasonal">{{ __('product.seasonal') }}</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="selling_frequency" id="sell_ondemand" value="On-demand" {{ $selectedFrequency == 'On-demand' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="sell_ondemand">{{ __('product.on_demand') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <!--Dropzone area -->
                                            <div class="dropzone" id="dropzoneUploader"></div>

                                            <!--Hidden input to store uploaded file names -->
                                            <input type="file" name="uploaded_files" class="form-control" id="uploaded_files" hidden>
                                            <small class="text-muted d-block mt-2">
                                                {{ __('product.upload_image_note') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="row">
                                        <div class="form-group col-lg-12 mb-3">
                                            <label class="d-block font-weight-semibold mb-2"><b>{{ __('product.use_old_address') }}</b></label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="address_link" id="yes_old_address" value="2" {{ old('address_link', $update->address_link) == 2 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="yes_old_address">{{ __('product.yes_old_address') }}</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="address_link" id="no_new_address" value="1" {{ old('address_link', $update->address_link) == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="no_new_address">{{ __('product.no_new_address') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="new-address-section" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <input type="text" name="address" class="form-control" placeholder="{{ __('common.full_address') }}" id="address" value="{{$update->address}}">
                                                    <div class="form-control-feedback">
                                                        <i class="icon-pen-plus text-muted"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <select class="form-control required select2 select" name="state_id" id="state">
                                                    <option value="">{{ __('common.select_state') }}</option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{ $update->state_id == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <select class="form-control required select2 select" name="district_id" id="district">
                                                    <option value="{{$update->district_id}}">{{ $update->district->name ?? __('common.select_district') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="description"><b>{{ __('product.description_help') }}</b></label>
                                            <textarea id="summernote" name="description" class="form-control">{{$update->product_description}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-lg-10 ml-lg-auto text-right">
                                    <button type="submit" class="btn bg-success-400 ml-3">{{ __('product.post') }} <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <!-- /content area -->
@endsection
    