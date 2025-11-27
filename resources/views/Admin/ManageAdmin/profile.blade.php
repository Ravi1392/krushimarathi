@extends('Admin.layouts.common')

@push('custom-scripts')
    <script>
        $(document).ready(function () {
            $('#formadd').validate({// initialize the plugin
                rules: {
                    name: {
                        required: true,   
                    },
                    phone: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                   
                },
                messages: {
                    name: "Name field is required.",
                    last_name: "Last Name field is required.",
                    phone: "Contact number is required",
                  
                },
            });
            $('#passwordformadd').validate({// initialize the plugin
                rules: {
                    old_pass: {
                        required: true,
                    },
                    new_pass: {
                        required: true,
                    },
                    confirm_pass: {
                        required: true,
                        equalTo: "#new_pass"
                    }
                },
                messages: {
                    old_pass: " Enter strong Password",
                    new_pass: " Enter strong Password",
                    confirm_pass: " Enter Confirm Password Same as New Password",
                  
                },
            });
        });
    </script>
@endpush
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Page length options -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title">Profile</h3><hr>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <div class="chart-container">
                    <div class="chart" id="sales">
                        <form method="post" action="{{route('admin.updateProfile')}}" id="formadd" enctype="multipart/form-data" novalidate="novalidate">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>Name</b>
                                        <input type="text" class="form-control disabled" placeholder="Name" name="name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>Last Name</b>
                                        <input type="text" class="form-control  required" placeholder="Last Name" name="last_name" value="{{$user->last_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>Email</b>
                                        <input type="text" class="form-control disabled" disabled="" placeholder="Email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>Phone Number</b>
                                        <input type="text" class="form-control  required" placeholder="Phone Number" name="phone" value="{{$user->phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b class="display-block">Upload profile image </b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="profile" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                                <div class="col-md-6">
                                    <b class="display-block">Preview</b> 
                                    <img src="{{ $user->file }}" class="machine_img_preview" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary upload_btn">Save<i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3 class="panel-title">Change Password</h3><hr>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <div class="chart-container">
                    <div class="chart" id="sales">
                        <form method="post" action="{{route('admin.updatePassword')}}" id="passwordformadd" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>Old Password <span style="color:red"> *</span></b>
                                        <input type="password" class="form-control  required" placeholder="Enter Old Password" name="old_pass" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>New Password <span style="color:red"> *</span></b>
                                        <input type="password" class="form-control required" placeholder="Enter New Password" name="new_pass" id="new_pass" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>Confirm Password <span style="color:red"> *</span></b>
                                        <input type="password" class="form-control  required" placeholder="Enter Confirm Password" name="confirm_pass" value="">
                                    </div>

                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary upload_btn">Update Password <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
