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
                    phone: {
                        required: true,
                        remote: '{{route("ads.login.verifyPhoneNo")}}',
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    phone: {
                        required: "Mobile number field is required.",
                        remote: "🔒 We couldn’t find your mobile number. Please register before logging in.",
                    },
                    password: {
                        required: "Password field is required.",
                    },
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
                    } else {
                        error.insertAfter(element); // default
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
        <!-- Login form -->
        <form class="login-form" method="post" action="{{route('ads.login')}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="icon-reading icon-2x text-success-300 border-success-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">{{ __('login.login_title') }}</h5>
                        <span class="d-block text-muted">{{ __('login.login_subtitle') }}</span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="text" name="phone" class="form-control" placeholder="{{ __('login.mobile_placeholder') }}">
                        <div class="form-control-feedback">
                            <i class="icon-mobile text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" name="password" class="form-control" placeholder="{{ __('login.password_placeholder') }}">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>
                    <div class="text-right mb-2">
                        <a href="#">{{ __('login.forgot') }}</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('login.button') }} <i class="icon-circle-right2 ml-2"></i></button>
                    </div>
                    
                    <div class="form-group text-center text-muted content-divider">
                        <span class="px-2">{{ __('login.no_account') }}</span>
                    </div>
                    <div class="form-group">
                        <a href="{{route('ads.register')}}" class="btn btn-light btn-block">{{ __('login.sign_up') }}</a>
                    </div>
                    
                </div>
            </div>
        </form>
        <!-- /login form -->
    </div>
    <!-- /content area -->
@endsection
    