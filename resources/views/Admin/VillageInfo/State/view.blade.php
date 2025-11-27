@extends('Admin.layouts.common')

@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">View State Details</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.state.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">State List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Country Name</b>
                                    <input type="text" name="country_id" value="{{$view->country->name}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Census Code</b>
                                    <input type="text" name="census_code" value="{{$view->census_code}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>State Name</b>
                                    <input type="text" name="en_name" value="{{$view->en_name}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Capital Name</b>
                                    <input type="text" name="capital_name" value="{{$view->capital_name}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Code (IN)</b>
                                    <input type="text" name="code" value="{{$view->code}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Established Date</b>
                                    <input type="date" name="established" value="{{$view->established}}" class="form-control" readonly>
                                </div>
                            </div>
                            <hr>
                            <h4>Country Overview</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Villages (640,932)</b>
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
                                    <input type="text" name="total_area" value="{{$view->total_area}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population Density (382.2)</b>
                                    <input type="text" name="population_density" value="{{$view->population_density}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Court Name</b>
                                    <input type="text" name="court" value="{{$view->court}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Total Population (3,287,469)</b>
                                    <input type="text" name="total_population" value="{{$view->total_population}}" class="form-control" readonly>
                                </div>
                            </div>
                            <hr>
                            <h4>Density</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Rural Density (210.94)</b>
                                    <input type="text" name="rural_density" value="{{$view->rural_density}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Urban Density (210.94)</b>
                                    <input type="text" name="urban_density" value="{{$view->urban_density}}" class="form-control" readonly>
                                </div>
                            </div>
                            <hr>
                            <h4>Household</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Rural Household (3,287,469)</b>
                                    <input type="text" name="rural_household" value="{{$view->rural_household}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Urban Household (3,287,469)</b>
                                    <input type="text" name="urban_household" value="{{$view->urban_household}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Household (3,287,469)</b>
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
                            <h4>Population Of {{$view->en_name}}</h4>
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
                            <h4>About Us</h4>
                            <hr>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Nearest States</b>
                                    <input type="text" name="nearest_states" value="{{$view->nearest_states}}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>About Us</b>
                                    <textarea type="text" name="about_us" class="form-control" readonly>{{$view->about_us}}</textarea>
                                </div>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
