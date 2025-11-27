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
                taluka_id:{
                    required: true,
                },
                en_name: {
                    required: true,
                },
                village_slug: {
                    required: true,
                    remote: '{{route("admin.village.villageSlugCheckUpdate",$update->id)}}',
                },
            },
            messages: {
                en_name: "Village Name field is required.",
                village_id: "Village field is required.",
                village_slug: {
                    required: "Village Slug is required.",
                    remote: "Village Slug is not valid or already exist."
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
                    <h5 class="panel-title">Edit Village</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.village.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Village List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.village.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Taluka</b>
                                    <span class="text-danger">*</span>
                                    <select class="form-control required select2 select" required="required" name="taluka_id">
                                        <option value="">Select Taluka</option>
                                        @foreach($taluka_lists as $taluka_list)
                                            @if($taluka_list->id == $update->taluka_id)
                                                <option value="{{$taluka_list->id}}" selected>{{$taluka_list->en_name}}</option>
                                            @else
                                                <option value="{{$taluka_list->id}}">{{$taluka_list->en_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>English Village Name</b>
                                    <input type="text" name="en_name" value="{{$update->en_name}}" class="form-control" placeholder="Enter Village Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Hindi Village Name</b>
                                    <input type="text" name="mr_name" value="{{$update->mr_name}}" class="form-control" placeholder="Enter Hindi Village Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Village Slug</b>
                                    <input type="text" name="village_slug" value="{{$update->village_slug}}" class="form-control" placeholder="Enter Village Slug">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Village Latitude</b>
                                    <input type="text" name="latitude" value="{{$update->latitude}}" class="form-control" placeholder="Enter Village latitude">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Village Longitude</b>
                                    <input type="text" name="longitude" value="{{$update->longitude}}" class="form-control" placeholder="Enter Village longitude">
                                </div>
                            </div>

                            <hr>
                            <h4>Village Overview</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Gram Panchayat Name</b>
                                    <input type="text" name="gram_panchayat_name" value="{{$update->gram_panchayat_name}}" class="form-control" placeholder="Enter Gram Panchayat Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Sex Ratio</b>
                                    <input type="text" name="sex_ratio" value="{{$update->sex_ratio}}" class="form-control" placeholder="Enter Village Sex Ratio">
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
                                    <b>Pin code</b>
                                    <input type="text" name="pincode" value="{{$update->pincode}}" class="form-control" placeholder="Enter Pin Code">
                                </div>
                                
                            </div>
                            
                            <hr>
                            <h4>Village</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Village Code</b>
                                    <input type="text" name="village_code" value="{{$update->village_code}}" value="{{$update->urban_total}}" class="form-control" placeholder="Enter village_code">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Panchayat Code</b>
                                    <input type="text" name="panchayat_code" value="{{$update->panchayat_code}}" class="form-control" placeholder="Enter Panchayat Code">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Household (587,584,719)</b>
                                    <input type="text" name="total_households" value="{{$update->total_households}}" class="form-control" placeholder="Enter Total Population">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Nearest Villages</b>
                                    <input type="text" name="nearest_villages" class="form-control" value="{{$update->nearest_villages}}">
                                </div>
                            </div>
                            
                            <hr>
                            <h4>Village Facilities</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Public Bus</b>
                                    <input type="text" name="public_bus" class="form-control" value="{{$update->villagefacilities->public_bus ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Railway Station</b>
                                    <input type="text" name="railway_station" class="form-control" value="{{$update->villagefacilities->railway_station ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Communication</b>
                                    <input type="text" name="communication" class="form-control" value="{{$update->villagefacilities->communication ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Electricity Supply</b>
                                    <input type="text" name="electricity_supply" class="form-control" value="{{$update->villagefacilities->electricity_supply ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Domestic Electricity</b>
                                    <input type="text" name="domestic_electricity" class="form-control" value="{{$update->villagefacilities->domestic_electricity ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Agri Electricity</b>
                                    <input type="text" name="agri_electricity" class="form-control" value="{{$update->villagefacilities->agri_electricity ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Other Electricity Uses</b>
                                    <input type="text" name="other_electricity_uses" class="form-control" value="{{$update->villagefacilities->other_electricity_uses ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>All Households Electrified</b>
                                    <input type="text" name="all_households_electrified" class="form-control" value="{{$update->villagefacilities->all_households_electrified ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Primary School</b>
                                    <input type="text" name="primary_school" class="form-control" value="{{$update->villagefacilities->primary_school ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Primary School Name</b>
                                    <input type="text" name="primary_school_name" class="form-control" value="{{$update->villagefacilities->primary_school_name ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Secondary School</b>
                                    <input type="text" name="secondary_school" class="form-control" value="{{$update->villagefacilities->secondary_school ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Secondary School Name</b>
                                    <input type="text" name="secondary_school_name" class="form-control" value="{{$update->villagefacilities->secondary_school_name ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>College</b>
                                    <input type="text" name="college" class="form-control" value="{{$update->villagefacilities->college ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>College Name</b>
                                    <input type="text" name="college_name" class="form-control" value="{{$update->villagefacilities->college_name ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Hospital Facility</b>
                                    <input type="text" name="hospital_facility" class="form-control" value="{{$update->villagefacilities->hospital_facility ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Primary Health Centre</b>
                                    <input type="text" name="primary_health_centre" class="form-control" value="{{$update->villagefacilities->primary_health_centre ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Other Medical Centres</b>
                                    <input type="text" name="other_medical_centres" class="form-control" value="{{$update->villagefacilities->other_medical_centres ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Tap Water</b>
                                    <input type="text" name="tap_water" class="form-control" value="{{$update->villagefacilities->tap_water ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Well</b>
                                    <input type="text" name="well" class="form-control" value="{{$update->villagefacilities->well ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Tank</b>
                                    <input type="text" name="tank" class="form-control" value="{{$update->villagefacilities->tank ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Tubewell</b>
                                    <input type="text" name="tubewell" class="form-control" value="{{$update->villagefacilities->tubewell ?? ''}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Handpump</b>
                                    <input type="text" name="handpump" class="form-control" value="{{$update->villagefacilities->handpump ?? ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Other Sources</b>
                                    <input type="text" name="other_sources" class="form-control" value="{{$update->villagefacilities->other_sources ?? ''}}">
                                </div>
                            </div>
                            <hr>
                            <h4>Village Statistics</h4>
                            <hr>
                            @foreach($village_population_categories as $category)
                                @php
                                    $existing = $update->villagestatistics->firstWhere('category_id', $category->id);
                                @endphp

                                <div class="row mb-3">
                                    <div class="form-group col-sm-3">
                                        <label><b>{{ $category->id }} : {{ $category->category_name }}</b></label>
                                        <input type="hidden" name="statistics[{{ $category->id }}][category_id]" value="{{ $category->id }}">
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <label>Male</label>
                                        <input type="number" class="form-control" name="statistics[{{ $category->id }}][male]" value="{{ $existing->male ?? '' }}">
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <label>Female</label>
                                        <input type="number" class="form-control" name="statistics[{{ $category->id }}][female]" value="{{ $existing->female ?? '' }}">
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <label>Total</label>
                                        <input type="number" class="form-control" name="statistics[{{ $category->id }}][total]" value="{{ $existing->total ?? '' }}">
                                    </div>
                                </div>
                            @endforeach

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
