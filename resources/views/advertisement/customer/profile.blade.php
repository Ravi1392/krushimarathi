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
                    business_type:{
                        required: true,
                    },
                    phone: {
                        required: true,
                        remote: '{{route("ads.phoneCheckUpdate",$user->id)}}'
                    },
                    email: {
                        required: true,
                        remote: '{{route("ads.emailCheckUpdate",$user->id)}}'
                    },
                },
                messages: {
                    name: "{{ __('profile.validation.name_required') }}",
                    last_name: "{{ __('profile.validation.last_name_required') }}",
                    business_type: "{{ __('profile.validation.business_type_required') }}",
                    phone: {
                        required: "{{ __('profile.validation.mobile_required') }}",
                        remote: "{{ __('profile.validation.mobile_remote') }}",
                    },
                    email: {
                        required: "{{ __('profile.validation.email_required') }}",
                        remote: "{{ __('profile.validation.email_remote') }}",
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

            $('#passwordformadd').validate({// initialize the plugin
                rules: {
                    old_pass: {
                        required: true,
                    },
                    new_pass: {
                        required: true,
                        minlength: 6
                    },
                    confirm_pass: {
                        required: true,
                        equalTo: "#new_pass"
                    }
                },
                messages: {
                    old_pass: "{{ __('profile.validation.old_pass_required') }}",
                    new_pass: {
                        required: "{{ __('profile.validation.new_pass_required') }}",
                        minlength: "{{ __('profile.validation.new_pass_min') }}"
                    },
                    confirm_pass: {
                        required: "{{ __('profile.validation.confirm_pass_required') }}",
                        equalTo: "{{ __('profile.validation.confirm_pass_equal') }}"
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
                    } else {
                        error.insertAfter(element); // default
                    }
                }
            });

        });

        const districtUrl = "{{ url('/ads/districts') }}";
        const talukaUrl = "{{ url('/ads/talukas') }}";
        const villageUrl = "{{ url('/ads/villages') }}";

        $('#state').change(function() {
            let state_id = $(this).val();
            $.get(districtUrl + '/' + state_id, function(data) {
                let options = '<option value="">Select District</option>';
                data.forEach(d => options += `<option value="${d.id}">${d.en_name}</option>`);
                $('#district').html(options);
                $('#taluka').html('<option value="">Select Sub Division (Taluka)</option>');
                $('#village').html('<option value="">Select Village</option>');
            });
        });

        $('#district').change(function() {
            let district_id = $(this).val();
            $.get(talukaUrl + '/' + district_id, function(data) {
                let options = '<option value="">Select Sub Division (Taluka)</option>';
                data.forEach(t => options += `<option value="${t.id}">${t.en_name}</option>`);
                $('#taluka').html(options);
                $('#village').html('<option value="">Select Village</option>');
            });
        });

        $('#taluka').change(function() {
            let taluka_id = $(this).val();
            $.get(villageUrl + '/' + taluka_id, function(data) {
                let options = '<option value="">Select Village</option>';
                data.forEach(v => options += `<option value="${v.id}">${v.en_name}</option>`);
                $('#village').html(options);
            });
        });

    </script>
@endpush
@push('custom-css')

@endpush
     
@section('content')
    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h2 class="card-title">{{ __('profile.personal_info') }}</h2>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{route('ads.updateProfile')}}" id="formadd" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <b>{{ __('profile.first_name') }}</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="name" class="form-control" placeholder="{{ __('profile.placeholder.first_name') }}" value="{{$user->name}}">
                                </div>

                                <div class="form-group col-lg-4">
                                    <b>Middle Name</b>
                                    <input type="text" name="middle_name" class="form-control" placeholder="Enter Your Middle Name" value="{{$user->middle_name}}">
                                </div>

                                <div class="form-group col-lg-4">
                                    <b>Last Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter Your Last Name (  Sirname)" value="{{$user->last_name}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label class="d-block font-weight-bold">Your Gender</label>
                                    <div class="form-check form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="gender" value="1" {{ old('gender', $user->gender ?? '') == 1 ? 'checked' : '' }}>
											Male
										</label>
									</div>
                                    <div class="form-check form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="gender" value="2" {{ old('gender', $user->gender ?? '') == 2 ? 'checked' : '' }}>
											Female
										</label>
									</div>
                                    <div class="form-check form-check-inline">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="gender" value="3" {{ old('gender', $user->gender ?? '') == 3 ? 'checked' : '' }}>
											Other
										</label>
									</div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <b>Mobile Number</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Your Mobile Number" value="{{$user->phone}}">
                                </div>

                                <div class="form-group col-lg-4">
                                    <b>Email Address</b>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address" value="{{$user->email}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <b>Business Name</b>
                                    <input type="text" name="business_name" class="form-control" placeholder="Enter Your Business" value="{{$user->business_name}}">
                                </div> 
                                
                                <div class="form-group col-lg-6">
                                    <b>Business Type</b>
                                    <span class="text-danger"> *</span>
                                    <select class="form-control required select2 select" name="business_type_id" id="business_type">
                                        <option value="">{{ __('common.select_role_heading') }}</option>
                                        @foreach($business_types as $business_type)
                                            <option value="{{$business_type->id}}" {{ $user->business_type_id == $business_type->id ? 'selected' : '' }}>{{$business_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <b>Address</b>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Your Address" value="{{$user->address}}">
                                </div>

                                <div class="form-group col-lg-6">
                                    <b>Select State</b>
                                    <select class="form-control select2 select" name="state_id" id="state">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" {{ $user->state_id == $state->id ? 'selected' : '' }}>{{$state->en_name}} ({{$state->mr_name}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <b>Select District</b>
                                    <select class="form-control select2 select" name="district_id" id="district">
                                        <option value="{{ $user->district_id }}">{{ $user->district->en_name ?? 'Select District' }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6">
                                    <b>Select Sub Division (Taluka)</b>
                                    <select class="form-control select2 select" name="division_id" id="taluka">
                                        <option value="{{ $user->division_id }}">{{ $user->taluka->en_name ?? 'Select Sub Division (Taluka)' }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <b>Select Village</b>
                                    <select class="form-control select2 select" name="village_id" id="village">
                                        <option value="{{ $user->village_id }}">{{ $user->village->en_name ?? 'Select Village' }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6">
                                    <b>Pincode</b>
                                    <input type="number" name="pincode" class="form-control" placeholder="Enter Your Pincode" value="{{$user->pincode}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <b>Profile Desc</b>
                                    <textarea type="text" class="form-control" name="profile_desc" placeholder="Short Description">{{$user->profile_desc}}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload profile image </b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="profile" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <b class="display-block">Preview</b> 
                                    <img src="{{ $user->file }}" class="machine_img_preview" width="70px"/>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h2 class="card-title">Change Password</h2>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{route('ads.updatePassword')}}" id="passwordformadd" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <b>Old Password <span style="color:red"> *</span></b>
                                    <input type="password" name="old_pass" class="form-control" placeholder="Enter Old Password">
                                </div>
                                <div class="form-group col-lg-4">
                                    <b>New Password <span style="color:red"> *</span></b>
                                    <input type="password" name="new_pass" class="form-control" placeholder="Enter New Password" id="new_pass">
                                </div>
                                <div class="form-group col-lg-4">
                                    <b>Confirm Password <span style="color:red"> *</span></b>
                                    <input type="text" name="confirm_pass" class="form-control" placeholder="Enter Confirm Password">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update Password <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /content area -->
@endsection
    