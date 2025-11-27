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
                name: {
                    required: true,
                },
                capital_name: {
                    required: true,
                },
            },
            messages: {
                name: "Name field is required.",
                capital_name: "Capital name field is required.",
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
                    <h5 class="panel-title">Edit Country</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.country.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Country List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.country.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Country Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="name" value="{{$update->name}}" class="form-control required" placeholder="Enter Country name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Capital Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="capital_name" value="{{$update->capital_name}}" class="form-control required" placeholder="Enter Capital name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Code (IN)</b>
                                    <input type="text" name="code" value="{{$update->code}}" class="form-control" placeholder="Enter Code">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Country Code (+91)</b>
                                    <input type="text" name="country_code" value="{{$update->country_code}}" class="form-control" placeholder="Enter Country Code">
                                </div>
                            </div>
                            <hr>
                            <h4>Country Overview</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Towns (7,933)</b>
                                    <input type="text" name="total_towns" value="{{$update->total_towns}}" class="form-control" placeholder="Enter Total Towns">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Total Villages (640,932)</b>
                                    <input type="text" name="total_villages" value="{{$update->total_villages}}" class="form-control" placeholder="Enter Total Villages">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Area (3,287,469)</b>
                                    <input type="text" name="total_area" value="{{$update->total_area}}" class="form-control" placeholder="Enter Total Area">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Households (249,501,663)</b>
                                    <input type="text" name="households" value="{{$update->households}}" class="form-control" placeholder="Enter Households">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population Density (382.2)</b>
                                    <input type="text" name="population_density" value="{{$update->population_density}}" class="form-control" placeholder="Enter Population Density">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Court Name</b>
                                    <input type="text" name="court" value="{{$update->court}}" class="form-control" placeholder="Enter Court Name">
                                </div>
                            </div>
                            <hr>
                            <h4>Male/Female Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Male Population (623,270,258)</b>
                                    <input type="text" name="male_population" value="{{$update->male_population}}" class="form-control" placeholder="Enter Male Population">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Female Population (587,584,719)</b>
                                    <input type="text" name="female_population" value="{{$update->female_population}}" class="form-control" placeholder="Enter Female Population">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Total Population (1,210,854,977)</b>
                                    <input type="text" name="total_population" value="{{$update->total_population}}" class="form-control" placeholder="Enter Total Population">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>inhabited (5,97,608)</b>
                                    <input type="text" name="inhabited" value="{{$update->inhabited}}" class="form-control" placeholder="Enter Inhabited">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>uninhabited (5,97,608)</b>
                                    <input type="text" name="uninhabited" value="{{$update->uninhabited}}" class="form-control" placeholder="Enter Uninhabited">
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
