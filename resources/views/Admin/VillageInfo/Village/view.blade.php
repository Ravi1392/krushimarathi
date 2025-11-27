@extends('Admin.layouts.common')

@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">View Village</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.village.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Village List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Taluka Name</b>
                                <input type="text" name="taluka_id" value="{{$view->taluka->en_name}}" class="form-control" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>English Village Name</b>
                                <input type="text" name="en_name" value="{{$view->en_name}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Hindi Village Name</b>
                                <input type="text" name="mr_name" value="{{$view->mr_name}}" class="form-control" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Village Slug</b>
                                <input type="text" name="village_slug" value="{{$view->village_slug}}" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Village Latitude</b>
                                <input type="text" name="latitude" value="{{$view->latitude}}" class="form-control" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Village Longitude</b>
                                <input type="text" name="longitude" value="{{$view->longitude}}" class="form-control" readonly>
                            </div>
                        </div>

                        <hr>
                        <h4>Village Overview</h4>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Gram Panchayat Name</b>
                                <input type="text" name="gram_panchayat_name" value="{{$view->gram_panchayat_name}}" class="form-control" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Sex Ratio</b>
                                <input type="text" name="sex_ratio" value="{{$view->sex_ratio}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Total Area (3,287,469)</b>
                                <input type="text" name="area" class="form-control" value="{{$view->area}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Population (382.2)</b>
                                <input type="text" name="population" value="{{$view->population}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Pin code</b>
                                <input type="text" name="pincode" value="{{$view->pincode}}" class="form-control" readonly>
                            </div>
                            
                        </div>
                        
                        <hr>
                        <h4>Village</h4>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Village Code</b>
                                <input type="text" name="village_code" value="{{$view->village_code}}" value="{{$view->urban_total}}" class="form-control" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Panchayat Code</b>
                                <input type="text" name="panchayat_code" value="{{$view->panchayat_code}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Total Household (587,584,719)</b>
                                <input type="text" name="total_households" value="{{$view->total_households}}" class="form-control" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Nearest Villages</b>
                                <input type="text" name="nearest_villages" class="form-control" value="{{$view->nearest_villages}}" readonly>
                            </div>
                        </div>
                        
                        <hr>
                        <h4>Village Facilities</h4>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Public Bus</b>
                                <input type="text" name="public_bus" class="form-control" value="{{$view->villagefacilities->public_bus}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Railway Station</b>
                                <input type="text" name="railway_station" class="form-control" value="{{$view->villagefacilities->railway_station}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Communication</b>
                                <input type="text" name="communication" class="form-control" value="{{$view->villagefacilities->communication}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Electricity Supply</b>
                                <input type="text" name="electricity_supply" class="form-control" value="{{$view->villagefacilities->electricity_supply}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Domestic Electricity</b>
                                <input type="text" name="domestic_electricity" class="form-control" value="{{$view->villagefacilities->domestic_electricity}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Agri Electricity</b>
                                <input type="text" name="agri_electricity" class="form-control" value="{{$view->villagefacilities->agri_electricity}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Other Electricity Uses</b>
                                <input type="text" name="other_electricity_uses" class="form-control" value="{{$view->villagefacilities->other_electricity_uses}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>All Households Electrified</b>
                                <input type="text" name="all_households_electrified" class="form-control" value="{{$view->villagefacilities->all_households_electrified}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Primary School</b>
                                <input type="text" name="primary_school" class="form-control" value="{{$view->villagefacilities->primary_school}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Primary School Name</b>
                                <input type="text" name="primary_school_name" class="form-control" value="{{$view->villagefacilities->primary_school_name}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Secondary School</b>
                                <input type="text" name="secondary_school" class="form-control" value="{{$view->villagefacilities->secondary_school}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Secondary School Name</b>
                                <input type="text" name="secondary_school_name" class="form-control" value="{{$view->villagefacilities->secondary_school_name}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>College</b>
                                <input type="text" name="college" class="form-control" value="{{$view->villagefacilities->college}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>College Name</b>
                                <input type="text" name="college_name" class="form-control" value="{{$view->villagefacilities->college_name}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Hospital Facility</b>
                                <input type="text" name="hospital_facility" class="form-control" value="{{$view->villagefacilities->hospital_facility}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Primary Health Centre</b>
                                <input type="text" name="primary_health_centre" class="form-control" value="{{$view->villagefacilities->primary_health_centre}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Other Medical Centres</b>
                                <input type="text" name="other_medical_centres" class="form-control" value="{{$view->villagefacilities->other_medical_centres}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Tap Water</b>
                                <input type="text" name="tap_water" class="form-control" value="{{$view->villagefacilities->tap_water}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Well</b>
                                <input type="text" name="well" class="form-control" value="{{$view->villagefacilities->well}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Tank</b>
                                <input type="text" name="tank" class="form-control" value="{{$view->villagefacilities->tank}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Tubewell</b>
                                <input type="text" name="tubewell" class="form-control" value="{{$view->villagefacilities->tubewell}}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <b>Handpump</b>
                                <input type="text" name="handpump" class="form-control" value="{{$view->villagefacilities->handpump}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <b>Other Sources</b>
                                <input type="text" name="other_sources" class="form-control" value="{{$view->villagefacilities->other_sources}}" readonly>
                            </div>
                        </div>
                        <hr>
                        <h4>Village Statistics</h4>
                        <hr>
                        @foreach($village_population_categories as $category)
                            @php
                                $existing = $view->villagestatistics->firstWhere('category_id', $category->id);
                            @endphp

                            <div class="row mb-3">
                                <div class="form-group col-sm-3">
                                    <label><b>{{ $category->id }} : {{ $category->category_name }}</b></label>
                                    <input type="hidden" name="statistics[{{ $category->id }}][category_id]" value="{{ $category->id }}">
                                </div>

                                <div class="form-group col-sm-3">
                                    <label>Male</label>
                                    <input type="number" class="form-control" name="statistics[{{ $category->id }}][male]" value="{{ $existing->male ?? '' }}" readonly>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label>Female</label>
                                    <input type="number" class="form-control" name="statistics[{{ $category->id }}][female]" value="{{ $existing->female ?? '' }}" readonly>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label>Total</label>
                                    <input type="number" class="form-control" name="statistics[{{ $category->id }}][total]" value="{{ $existing->total ?? '' }}" readonly>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
