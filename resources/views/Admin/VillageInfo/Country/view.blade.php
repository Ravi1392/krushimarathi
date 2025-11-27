@extends('Admin.layouts.common')

@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">View Country Details</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.country.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Country List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Country Name</b>
                                    <input type="text" name="name" value="{{$view->name}}" class="form-control required" placeholder="Enter Country name" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Capital Name</b>
                                    <input type="text" name="capital_name" value="{{$view->capital_name}}" class="form-control required" placeholder="Enter Capital name" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Code (IN)</b>
                                    <input type="text" name="code" value="{{$view->code}}" class="form-control" placeholder="Enter Code" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Country Code (+91)</b>
                                    <input type="text" name="country_code" value="{{$view->country_code}}" class="form-control" placeholder="Enter Country Code" readonly>
                                </div>
                            </div>
                            <hr>
                            <h4>Country Overview</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Towns (7,933)</b>
                                    <input type="text" name="total_towns" value="{{$view->total_towns}}" class="form-control" placeholder="Enter Total Towns" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Total Villages (640,932)</b>
                                    <input type="text" name="total_villages" value="{{$view->total_villages}}" class="form-control" placeholder="Enter Total Villages" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Total Area (3,287,469)</b>
                                    <input type="text" name="total_area" value="{{$view->total_area}}" class="form-control" placeholder="Enter Total Area" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Households (249,501,663)</b>
                                    <input type="text" name="households" value="{{$view->households}}" class="form-control" placeholder="Enter Households" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population Density (382.2)</b>
                                    <input type="text" name="population_density" value="{{$view->population_density}}" class="form-control" placeholder="Enter Population Density" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Court Name</b>
                                    <input type="text" name="court" value="{{$view->court}}" class="form-control" placeholder="Enter Court Name" readonly>
                                </div>
                            </div>
                            <hr>
                            <h4>Male/Female Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Male Population (623,270,258)</b>
                                    <input type="text" name="male_population" value="{{$view->male_population}}" class="form-control" placeholder="Enter Male Population" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Female Population (587,584,719)</b>
                                    <input type="text" name="female_population" value="{{$view->female_population}}" class="form-control" placeholder="Enter Female Population" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Total Population (1,210,854,977)</b>
                                    <input type="text" name="total_population" value="{{$view->total_population}}" class="form-control" placeholder="Enter Total Population" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>inhabited (5,97,608)</b>
                                    <input type="text" name="inhabited" value="{{$view->inhabited}}" class="form-control" placeholder="Enter Inhabited" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>uninhabited (5,97,608)</b>
                                    <input type="text" name="uninhabited" value="{{$view->uninhabited}}" class="form-control" placeholder="Enter Uninhabited" readonly>
                                </div>
                            </div>
                            <hr>
                            <h4>Total Villages Population</h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 1 (Less than 200)</b>
                                    <input type="text" name="population_1" value="{{$view->population_1}}" class="form-control" placeholder="Enter Population 1 (Less than 200)" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 2 (200-499)</b>
                                    <input type="text" name="population_2" value="{{$view->population_2}}" class="form-control" placeholder="Enter Population 2 (200-499)" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 3 (500-999)</b>
                                    <input type="text" name="population_3" value="{{$view->population_3}}" class="form-control" placeholder="Enter Population 3 (500-999)" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 4 (1000-1999)</b>
                                    <input type="text" name="population_4" value="{{$view->population_4}}" class="form-control" placeholder="Enter Population 4 (1000-1999)" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 5 (2000-4999)</b>
                                    <input type="text" name="population_5" value="{{$view->population_5}}" class="form-control" placeholder="Enter Population 5 (2000-4999)" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Population 6 (5000-9999)</b>
                                    <input type="text" name="population_6" value="{{$view->population_6}}" class="form-control" placeholder="Enter Population 6 (5000-9999)" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Population 7 (10000 and above)</b>
                                    <input type="text" name="population_7" value="{{$view->population_7}}" class="form-control" placeholder="Enter Population 7 (10000 and above)" readonly>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
