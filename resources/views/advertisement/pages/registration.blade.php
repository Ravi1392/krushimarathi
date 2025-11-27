@extends('advertisement.layouts.common') 
@push('custom-scripts')
    <script src="{{asset('public/assets/advertisement/js/plugins/forms/validation/validate.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/switch.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/uniform.min.js')}}"></script>
   
    <script src="{{asset('public/global_assets/js/demo_pages/form_validation.js')}}"></script>
 
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
            $('#formadd').validate({// initialize the plugin
                rules: {
                    name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        remote: '{{route("ads.register.phoneCheck")}}',
                    },
                    email: {
                        required: true,
                        remote: '{{route("ads.register.emailCheck")}}',
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_password: {
                        required: true,
                        equalTo: '[name="password"]'
                    },
                },
                messages: {
                    name: "{{ __('register.validation.first_name_required') }}",
                    last_name: "{{ __('register.validation.last_name_required') }}",
                    phone: {
                        required: "{{ __('register.validation.phone_required') }}",
                        remote: "{{ __('register.validation.phone_exists') }}"
                    },
                    email: {
                        required: "{{ __('register.validation.email_required') }}",
                        remote: "{{ __('register.validation.email_exists') }}"
                    },
                    password: {
                        required: "{{ __('register.validation.password_required') }}",
                        minlength: "{{ __('register.validation.password_min') }}"
                    },
                    confirm_password: {
                        required: "{{ __('register.validation.confirm_password_required') }}",
                        equalTo: "{{ __('register.validation.confirm_password_match') }}"
                    }
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
                    } else if (element.attr("type") === "checkbox") {
                        error.insertAfter(element.closest('.form-check')); // For checkbox
                    } else {
                        error.insertAfter(element); // Default
                    }
                }
            });
        });
    </script>
@endpush
@push('custom-css')

@endpush

     
@section('content')
    <!-- Content area -->
    <div class="content d-flex justify-content-center align-items-center">
        <!-- Registration form -->
        <form method="post" class="flex-fill" action="{{route('ads.saveCustomer')}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h2 class="card-title">{{ __('register.title') }}</h2>
                                <p class="mb-4">{{ __('register.subtitle') }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" name="name" class="form-control" placeholder="{{ __('register.first_name') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" name="last_name" class="form-control" placeholder="{{ __('register.last_name') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" name="phone" class="form-control" placeholder="{{ __('register.phone') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-mobile text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="email" name="email" class="form-control" placeholder="{{ __('register.email') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-mention text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="password" name="password" class="form-control" placeholder="{{ __('register.password') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" name="confirm_password" class="form-control" placeholder="{{ __('register.confirm_password') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <div class="uniform-checker">
                                            <span>
                                                <input type="checkbox" name="check" class="form-input-styled" required data-fouc="">
                                            </span>
                                        </div>
                                        {{ __('register.accept') }}
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn bg-success-400 btn-labeled btn-labeled-right"><b><i class="icon-plus3"></i></b> {{ __('register.submit') }}</button>

                            <div class="text-center mb-3">
                                <p class="mb-4">{{ __('register.account') }} <a href="{{route('ads.loginForm')}}">{{ __('register.account_link') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /registration form -->
    </div>
    <!-- /content area -->
@endsection
    