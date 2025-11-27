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
                crop_type_id: {
                    required: true,
                },
                crop_id: {
                    required: true,
                },
                market_name: {
                    required: true,
                },
                variety: {
                    required: true,
                },
                unit: {
                    required: true,
                },
                arrival: {
                    required: true,
                },
                minimum_rate: {
                    required: true,
                },
                maximum_rate: {
                    required: true,
                },
                average_rate: {
                    required: true,
                },
            },
            messages: {
                crop_type_id: "Select Crop Type field is required.",
                crop_id: "Select Crop Name is required.",
                market_name: "Market Name field is required.",
                variety: "Variety field is required.",
                unit: "Unit field is required.",
                arrival: "Arrival field is required.",
                minimum_rate: "Minimun Rate field is required.",
                maximum_rate: "Maximum Rate field is required.",
                average_rate: "Average Rate field is required.",
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

    //Get Crop Rate
    $(document).ready(function() {
        $('#crop_type_id').on('change', function() {
            var cropTypeId = $(this).val();
            if (cropTypeId) {
                var url = "{{URL::to('admin/getCropNames')}}";
                url = url + "/" + cropTypeId;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#crop_id').empty();
                        $('#crop_id').append('<option value="">Select Crop Name</option>');
                        $.each(data, function(key, value) {
                            $('#crop_id').append('<option value="' + value.id + '">' + value.mr_crop_name + ' - ' + value.en_crop_name + '</option>');
                        });
                        // Revalidate field after population
                        $('#crop_type_id').valid(); // Revalidate category field
                        $('#crop_id').valid(); // Revalidate subcategory field
                    }
                });
            } else {
                $('#crop_id').empty();
                $('#crop_id').append('<option value="">Select Crop Name</option>');
            }
        });
        // Revalidate subcategory dropdown when selected
        $('#crop_id').on('change', function() {
            $(this).valid();
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
                    <h5 class="panel-title">Add Crop Rates</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.crop_rate.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Crop Rates List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.crop_rate.save')}}" id="formadd">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Crop Type</b>
                                    <span class="text-danger"> *</span>
                                    <select class="form-control required select2 select" required="required" name="crop_type_id" id="crop_type_id">
                                        <option value="">Select Crop Type</option>
                                        @foreach($data as $cropType)
                                            <option value="{{$cropType->id}}">{{$cropType->mr_crop_type .' - '. $cropType->en_crop_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Select Crop Name</b>
                                    <span class="text-danger"> *</span>
                                    <select class="form-control required select2 select" id="crop_id" name="crop_id">
                                        <option value="">Select Crop Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>बाजार समिती - Market Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="market_name" class="form-control required" placeholder="बाजार समिती - Market Committee City Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>जात /प्रत - Variety Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="variety" class="form-control required" placeholder="जात /प्रत - Variety/Grade">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>परिमाण - Unit/Measure</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="unit" class="form-control required" placeholder="परिमाण - Unit/Measure">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>आवक - Arrival</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="arrival" class="form-control required" placeholder="आवक - Arrival">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <b>कमीत कमी दर (रु.) - Minimum Rate (Rs.)</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="minimum_rate" class="form-control required" placeholder="कमीत कमी दर (रु.) - Minimum Rate (Rs.)">
                                </div>
                                <div class="form-group col-sm-4">
                                    <b>जास्तीत जास्त दर (रु.) - Maximum Rate (Rs.)</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="maximum_rate" class="form-control required" placeholder="जास्तीत जास्त दर (रु.) - Maximum Rate (Rs.)">
                                </div>
                                <div class="form-group col-sm-4">
                                    <b>सरासरी दर (रु.) - Average Rate (Rs.)</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="average_rate" class="form-control required" placeholder="सरासरी दर (रु.) - Average Rate (Rs.)">
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
