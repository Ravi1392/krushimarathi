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
                country_id:{
                    required: true,
                },
                en_name: {
                    required: true,
                },
                state_slug: {
                    required: true,
                    remote: '{{route("admin.state.stateslugcheck")}}',
                },
            },
            messages: {
                country_id: "Country field is required.",
                en_name: "State English Name field is required.",
                state_slug: {
                    required: "State Slug is required.",
                    remote: "State Slug is not valid or already exist."
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
                    <h5 class="panel-title">Add State</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.state.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">State List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.state.save')}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Country</b>
                                    <span class="text-danger">*</span>
                                    <select class="form-control required select2 select" required="required" name="country_id">
                                        <option value="">Select Country</option>
                                        @foreach($country_lists as $country_list)
                                            <option value="{{$country_list->id}}">{{$country_list->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Census Code</b>
                                    <input type="text" name="census_code" class="form-control" placeholder="Enter Census Code">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Code (IN)</b>
                                    <input type="text" name="code" class="form-control" placeholder="Enter Code">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>English State Name</b>
                                    <input type="text" name="en_name" class="form-control" placeholder="Enter English State Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Marathi State Name</b>
                                    <input type="text" name="mr_name" class="form-control" placeholder="Enter Marathi State Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>State Slug</b>
                                    <input type="text" name="state_slug" class="form-control" placeholder="Enter State Slug">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Capital Name</b>
                                    <input type="text" name="capital_name" class="form-control required" placeholder="Enter Capital name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Establish Date</b>
                                    <input type="date" name="established" class="form-control" placeholder="Enter Establish Date">
                                </div>
                            </div>
                            
                            <hr>
                            <h4>Country Overview</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Type</b>
                                    <select class="form-control required select2 select" name="type">
                                        <option value="">Select Type</option>
                                        <option value="State">State</option>
                                        <option value="Union Territory">Union Territory</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Total Villages (640932)</b>
                                    <input type="text" name="total_villages" class="form-control" placeholder="Enter Total Villages">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Area (3,287,469)</b>
                                    <input type="text" name="total_area" class="form-control" placeholder="Enter Total Area">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>State Sex Ratio</b>
                                    <input type="text" name="sex_ratio" class="form-control" placeholder="Enter Sex Ratio">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Rural Density (382.2)</b>
                                    <input type="text" name="rural_density" class="form-control" placeholder="Enter Rural Density">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Urban Density</b>
                                    <input type="text" name="urban_density" class="form-control" placeholder="Enter Urban Density">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population Density (382.2)</b>
                                    <input type="text" name="population_density" class="form-control" placeholder="Enter Population Density">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Court Name</b>
                                    <input type="text" name="court" class="form-control" placeholder="Enter Court Name">
                                </div>
                            </div>
                            <hr>
                            <h4>Household</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Population (1,210,854,977)</b>
                                    <input type="text" name="total_population" class="form-control" placeholder="Enter Total Population">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Rural Household (623,270,258)</b>
                                    <input type="text" name="rural_household" class="form-control" placeholder="Enter Rural Household">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Urban Household (587,584,719)</b>
                                    <input type="text" name="urban_household" class="form-control" placeholder="Enter Urban Population">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Total Household (587,584,719)</b>
                                    <input type="text" name="total_households" class="form-control" placeholder="Enter Total Population">
                                </div>
                            </div>
                            <hr>
                            <h4>Total Villages Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 1 (Less than 200)</b>
                                    <input type="text" name="population_1" class="form-control" placeholder="Enter Population 1 (Less than 200)">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 2 (200-499)</b>
                                    <input type="text" name="population_2" class="form-control" placeholder="Enter Population 2 (200-499)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 3 (500-999)</b>
                                    <input type="text" name="population_3" class="form-control" placeholder="Enter Population 3 (500-999)">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 4 (1000-1999)</b>
                                    <input type="text" name="population_4" class="form-control" placeholder="Enter Population 4 (1000-1999)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 5 (2000-4999)</b>
                                    <input type="text" name="population_5" class="form-control" placeholder="Enter Population 5 (2000-4999)">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 6 (5000-9999)</b>
                                    <input type="text" name="population_6" class="form-control" placeholder="Enter Population 6 (5000-9999)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 7 (10000 and above)</b>
                                    <input type="text" name="population_7" class="form-control" placeholder="Enter Population 7 (10000 and above)">
                                </div>
                            </div>
                            <hr>
                            <h4>Male/Female Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Male Rural (17445803)</b>
                                    <input type="text" name="male_rural" class="form-control" placeholder="Enter Male Rural">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Male Urban (17445803)</b>
                                    <input type="text" name="male_urban" class="form-control" placeholder="Enter Male Urban">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Female Rural (17445803)</b>
                                    <input type="text" name="female_rural" class="form-control" placeholder="Enter Female Rural">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Female Urban (17445803)</b>
                                    <input type="text" name="female_urban" class="form-control" placeholder="Enter Female Urban">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Rural Total (Male Rural + Female Rural)</b>
                                    <input type="text" name="rural_total" class="form-control" placeholder="Enter Rural Total">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Urban Total (Male Urban + Female Urban)</b>
                                    <input type="text" name="urban_total" class="form-control" placeholder="Enter Urban Total">
                                </div>
                            </div>
                            
                            <hr>
                            <h4>About</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Nearest States</b>
                                    <input type="text" name="nearest_states" class="form-control" >
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>About Us</b>
                                    <textarea type="text" name="about_us" class="form-control" ></textarea>
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
