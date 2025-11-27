@extends('Admin.layouts.common')

@push('custom-scripts')
<!-- Theme JS files -->
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/css/switch.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/assets//admin/css/switchery.min.css')}}">
<script src="{{asset('public/assets/admin/js/switchery.js')}}" type="text/javascript"></script>  
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/notifications/sweet_alert.min.js')}}"></script>
<!-- /theme JS files -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
        $('#formadd').validate({// initialize the plugin
            rules: {
                district_id:{
                    required: true,
                },
                en_name: {
                    required: true,
                },
                taluka_slug: {
                    required: true,
                    remote: '{{route("admin.taluka.talukaSlugCheckUpdate",$update->id)}}',
                },
            },
            messages: {
                en_name: "Taluka Name field is required.",
                district_id: "District field is required.",
                taluka_slug: {
                    required: "Taluka Slug is required.",
                    remote: "Taluka Slug is not valid or already exist."
                },
            },
            errorClass: 'error m-error',
            errorElement: 'small',
            errorPlacement: function (error, element) {
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
@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Edit Taluka</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.taluka.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Taluka List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.taluka.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select District</b>
                                    <span class="text-danger">*</span>
                                    <select class="form-control required select2 select" required="required" name="district_id">
                                        <option value="">Select District</option>
                                        @foreach($district_lists as $district_list)
                                            @if($district_list->id == $update->district_id)
                                                <option value="{{$district_list->id}}" selected>{{$district_list->en_name}}</option>
                                            @else
                                                <option value="{{$district_list->id}}">{{$district_list->en_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>English Taluka Name</b>
                                    <input type="text" name="en_name" value="{{$update->en_name}}" class="form-control" placeholder="Enter English Taluka Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Hindi Taluka Name</b>
                                    <input type="text" name="mr_name" value="{{$update->mr_name}}" class="form-control" placeholder="Enter Hindi Taluka Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Taluka Slug</b>
                                    <input type="text" name="taluka_slug" value="{{$update->taluka_slug}}" class="form-control" placeholder="Enter Taluka Slug">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Taluka Latitude</b>
                                    <input type="text" name="latitude" value="{{$update->latitude}}" class="form-control" placeholder="Enter Taluka latitude">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Taluka Longitude</b>
                                    <input type="text" name="longitude" value="{{$update->longitude}}" class="form-control" placeholder="Enter Taluka longitude">
                                </div>
                            </div>

                            <hr>
                            <h4>Taluka Overview</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Villages</b>
                                    <input type="text" name="total_villages" value="{{$update->total_villages}}" class="form-control" placeholder="Enter Total Villages">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Sex Ratio</b>
                                    <input type="text" name="sex_ratio" value="{{$update->sex_ratio}}" class="form-control" placeholder="Enter Taluka Sex Ratio">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Area (3,287,469)</b>
                                    <input type="text" name="area" class="form-control" value="{{$update->area}}" placeholder="Enter Total Area">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population (382.2)</b>
                                    <input type="text" name="population" value="{{$update->population}}" class="form-control" placeholder="Enter Population">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Density (382.2)</b>
                                    <input type="text" name="density" value="{{$update->density}}" class="form-control" placeholder="Enter Density">
                                </div>
                                
                            </div>
                            
                            <hr>
                            <h4>Household</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Rural Household (623,270,258)</b>
                                    <input type="text" name="rural_household" value="{{$update->rural_household}}" value="{{$update->urban_total}}" class="form-control" placeholder="Enter Rural Household">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Urban Household (587,584,719)</b>
                                    <input type="text" name="urban_household" value="{{$update->urban_household}}" class="form-control" placeholder="Enter Urban Population">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Household (587,584,719)</b>
                                    <input type="text" name="total_households" value="{{$update->total_households}}" class="form-control" placeholder="Enter Total Population">
                                </div>
                            </div>
                            <hr>
                            <h4>Total Villages Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 1 (Less than 200)</b>
                                    <input type="text" name="population_1" value="{{$update->population_1}}" class="form-control" placeholder="Enter Population 1 (Less than 200)">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 2 (200-499)</b>
                                    <input type="text" name="population_2" value="{{$update->population_2}}" class="form-control" placeholder="Enter Population 2 (200-499)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 3 (500-999)</b>
                                    <input type="text" name="population_3" value="{{$update->population_3}}" class="form-control" placeholder="Enter Population 3 (500-999)">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 4 (1000-1999)</b>
                                    <input type="text" name="population_4" value="{{$update->population_4}}" class="form-control" placeholder="Enter Population 4 (1000-1999)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 5 (2000-4999)</b>
                                    <input type="text" name="population_5" value="{{$update->population_5}}" class="form-control" placeholder="Enter Population 5 (2000-4999)">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 6 (5000-9999)</b>
                                    <input type="text" name="population_6" value="{{$update->population_6}}" class="form-control" placeholder="Enter Population 6 (5000-9999)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 7 (10000 and above)</b>
                                    <input type="text" name="population_7" value="{{$update->population_7}}" class="form-control" placeholder="Enter Population 7 (10000 and above)">
                                </div>
                            </div>
                            <hr>
                            <h4>Male/Female Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Male Rural (17445803)</b>
                                    <input type="text" name="male_rural" value="{{$update->male_rural}}" class="form-control" placeholder="Enter Male Rural">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Male Urban (17445803)</b>
                                    <input type="text" name="male_urban" value="{{$update->male_urban}}" class="form-control" placeholder="Enter Male Urban">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Female Rural (17445803)</b>
                                    <input type="text" name="female_rural" value="{{$update->female_rural}}" class="form-control" placeholder="Enter Female Rural">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Female Urban (17445803)</b>
                                    <input type="text" name="female_urban" value="{{$update->female_urban}}" class="form-control" placeholder="Enter Female Urban">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Rural Total (Male Rural + Female Rural)</b>
                                    <input type="text" name="rural_total" value="{{$update->rural_total}}" class="form-control" placeholder="Enter Rural Total">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Urban Total (Male Urban + Female Urban)</b>
                                    <input type="text" name="urban_total" value="{{$update->urban_total}}" class="form-control" placeholder="Enter Urban Total">
                                </div>
                            </div>
                            
                            <hr>
                            <h4>About</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Nearest Talukas</b>
                                    <input type="text" name="nearest_talukas" value="{{$update->nearest_talukas}}" class="form-control" >
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>STD Code</b>
                                    <input type="text" name="std_code" class="form-control" value="{{$update->std_code}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>PIN Code</b>
                                    <input type="text" name="pin_code" class="form-control" value="{{$update->pin_code}}">
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
