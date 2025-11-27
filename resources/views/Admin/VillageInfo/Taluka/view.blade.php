@extends('Admin.layouts.common')

@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Taluka View</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.taluka.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Taluka List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>District Name</b>
                                    <input type="text" name="en_name" value="{{$view->district->en_name}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>English Taluka Name</b>
                                    <input type="text" name="en_name" value="{{$view->en_name}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Hindi Taluka Name</b>
                                    <input type="text" name="mr_name" value="{{$view->mr_name}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Taluka Slug</b>
                                    <input type="text" name="taluka_slug" value="{{$view->taluka_slug}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Taluka Latitude</b>
                                    <input type="text" name="latitude" value="{{$view->latitude}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Taluka Longitude</b>
                                    <input type="text" name="longitude" value="{{$view->longitude}}" class="form-control" readonly>
                                </div>
                            </div>

                            <hr>
                            <h4>Taluka Overview</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Villages</b>
                                    <input type="text" name="total_villages" value="{{$view->total_villages}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Sex Ratio</b>
                                    <input type="text" name="sex_ratio" value="{{$view->sex_ratio}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Area (3,287,469)</b>
                                    <input type="text" name="area" class="form-control" readonly value="{{$view->area}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population (382.2)</b>
                                    <input type="text" name="population" value="{{$view->population}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Density (382.2)</b>
                                    <input type="text" name="density" value="{{$view->density}}" class="form-control" readonly>
                                </div>
                                
                            </div>
                            
                            <hr>
                            <h4>Household</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Rural Household (623,270,258)</b>
                                    <input type="text" name="rural_household" value="{{$view->rural_household}}" value="{{$view->urban_total}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Urban Household (587,584,719)</b>
                                    <input type="text" name="urban_household" value="{{$view->urban_household}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Household (587,584,719)</b>
                                    <input type="text" name="total_households" value="{{$view->total_households}}" class="form-control" readonly>
                                </div>
                            </div>
                            <hr>
                            <h4>Total Villages Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 1 (Less than 200)</b>
                                    <input type="text" name="population_1" value="{{$view->population_1}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 2 (200-499)</b>
                                    <input type="text" name="population_2" value="{{$view->population_2}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 3 (500-999)</b>
                                    <input type="text" name="population_3" value="{{$view->population_3}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 4 (1000-1999)</b>
                                    <input type="text" name="population_4" value="{{$view->population_4}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 5 (2000-4999)</b>
                                    <input type="text" name="population_5" value="{{$view->population_5}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 6 (5000-9999)</b>
                                    <input type="text" name="population_6" value="{{$view->population_6}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 7 (10000 and above)</b>
                                    <input type="text" name="population_7" value="{{$view->population_7}}" class="form-control" readonly>
                                </div>
                            </div>
                            <hr>
                            <h4>Male/Female Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Male Rural (17445803)</b>
                                    <input type="text" name="male_rural" value="{{$view->male_rural}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Male Urban (17445803)</b>
                                    <input type="text" name="male_urban" value="{{$view->male_urban}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Female Rural (17445803)</b>
                                    <input type="text" name="female_rural" value="{{$view->female_rural}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Female Urban (17445803)</b>
                                    <input type="text" name="female_urban" value="{{$view->female_urban}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Rural Total (Male Rural + Female Rural)</b>
                                    <input type="text" name="rural_total" value="{{$view->rural_total}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Urban Total (Male Urban + Female Urban)</b>
                                    <input type="text" name="urban_total" value="{{$view->urban_total}}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <hr>
                            <h4>About</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Nearest Talukas</b>
                                    <input type="text" name="nearest_talukas" value="{{$view->nearest_talukas}}" class="form-control" readonly >
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>STD Code</b>
                                    <input type="text" name="std_code" class="form-control" readonly value="{{$view->std_code}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>PIN Code</b>
                                    <input type="text" name="pin_code" class="form-control" readonly value="{{$view->pin_code}}">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
