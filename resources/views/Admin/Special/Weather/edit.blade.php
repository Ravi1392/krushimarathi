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
                    <h5 class="panel-title">Edit Weather</h5>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.weather.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>City Name</b>
                                    <input type="text" name="city_id" value="{{$update->district->mr_name}} - ({{$update->district->en_name}})" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>AQI Value</b>
                                    <input type="text" name="aqi_value" value="{{$update->aqi_value}}" class="form-control" placeholder="Enter AQI Value">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Select Aqi Class (AQI css color class)</b>
                                    <select class="form-control select2 select" name="aqi_class">
                                        <option value="">Select AQI Class</option>
                                        <option value="good" {{ $update->aqi_class == 'good' ? 'selected' : '' }}>Good (0-50)</option>
                                        <option value="moderate" {{ $update->aqi_class == 'moderate' ? 'selected' : '' }}>Moderate (51-100)</option>
                                        <option value="poor" {{ $update->aqi_class == 'poor' ? 'selected' : '' }}>Poor (101-150)</option>
                                        <option value="unhealthy" {{ $update->aqi_class == 'unhealthy' ? 'selected' : '' }}>Unhealthy (151-200)</option>
                                        <option value="severe" {{ $update->aqi_class == 'severe' ? 'selected' : '' }}>Severe (201-250)</option>
                                        <option value="hazardous" {{ $update->aqi_class == 'hazardous' ? 'selected' : '' }}>Hazardous (251-300+)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Aqi Image</b>
                                    <select class="form-control select2 select" name="aqi_image">
                                        <option value="">Select AQI Image</option>
                                        <option value="good.webp" {{ $update->aqi_image_name == 'good.webp' ? 'selected' : '' }}>Good (0-50)</option>
                                        <option value="moderate.webp" {{ $update->aqi_image_name == 'moderate.webp' ? 'selected' : '' }}>Moderate (51-100)</option>
                                        <option value="poor.webp" {{ $update->aqi_image_name == 'poor.webp' ? 'selected' : '' }}>Poor (101-150)</option>
                                        <option value="unhealthy.webp" {{ $update->aqi_image_name == 'unhealthy.webp' ? 'selected' : '' }}>Unhealthy (151-200)</option>
                                        <option value="unhealthy.webp" {{ $update->aqi_image_name == 'unhealthy.webp' ? 'selected' : '' }}>Severe (201-250)</option>
                                        <option value="hazardous.webp" {{ $update->aqi_image_name == 'hazardous.webp' ? 'selected' : '' }}>Hazardous (251-300+)</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b class="display-block">AQI Image Preview</b> 
                                    <img src="{{ $update->aqi_image }}" class="machine_img_preview" />
                                </div>
                            </div>                           

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Temperature</b>
                                    <input type="text" name="temperature" value="{{$update->temperature}}" class="form-control" placeholder="Enter Temperature Value">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Weather Condition (Type)</b>
                                    <select class="form-control select2 select" name="weather_condition">
                                        <option value="">Select Weather Type</option>
                                        <option value="CLEAR" {{ $update->weather_condition == 'CLEAR' ? 'selected' : '' }}>Clear</option>
                                        <option value="CLOUDS" {{ $update->weather_condition == 'CLOUDS' ? 'selected' : '' }}>Clouds</option>
                                        <option value="RAIN" {{ $update->weather_condition == 'RAIN' ? 'selected' : '' }}>Rain</option>
                                        <option value="SNOW" {{ $update->weather_condition == 'SNOW' ? 'selected' : '' }}>Snow</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Weather Image</b>
                                    <select class="form-control select2 select" name="weather_image">
                                        <option value="">Select Weather Image</option>
                                        <option value="clear.webp" {{ $update->weather_image_name == 'clear.webp' ? 'selected' : '' }}>Clear - (clear.webp)</option>
                                        <option value="clouds.webp" {{ $update->weather_image_name == 'clouds.webp' ? 'selected' : '' }}>Clouds - (clouds.webp)</option>
                                        <option value="clouds_2.webp" {{ $update->weather_image_name == 'clouds_2.webp' ? 'selected' : '' }}>Clouds 2 - (clouds_2.webp)</option>
                                        <option value="rain.webp" {{ $update->weather_image_name == 'rain.webp' ? 'selected' : '' }}>Rain - (rain.webp)</option>
                                        <option value="snow.webp" {{ $update->weather_image_name == 'snow.webp' ? 'selected' : '' }}>Snow - (snow.webp)</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b class="display-block">Weather Image Preview</b> 
                                    <img src="{{ $update->weather_image }}" class="machine_img_preview" />
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
