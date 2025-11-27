@extends('Admin.layouts.common')

@push('custom-scripts')
<!-- Theme JS files -->
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/css/switch.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/assets//admin/css/switchery.min.css')}}">
<script src="{{asset('public/assets/admin/js/switchery.js')}}" type="text/javascript"></script>  
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/notifications/sweet_alert.min.js')}}"></script>

<script src="{{ asset('public/assets/admin/js/plugins/ckeditor/ckeditor.js') }}"></script>
<!-- /theme JS files -->

<script type="text/javascript">
var my_url = 'http://example.com';
    $(document).ready(function () {
        $('#formadd').validate({
            rules: {
                title: {
                    required: true,
                },
                description: {
                    required: true,
                },
            },
            messages: {
                title: "Live Data Title field is required.",
                description: "Live Data Description field is required.",
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
            },
        });
    });

    CKEDITOR.replace( 'description' );
    
</script>

@endpush
@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Add Live Update Data</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.live_update.liveData',$id)}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Live Update Data<b><i class="icon-menu7"></i></b></a>
                     </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.live_update.saveLiveData')}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <input type="hidden" name="id" class="form-control" value="{{$id}}">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Title</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="title" placeholder="Enter Title - 1"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description</b>
                                    <span class="text-danger"> *</span>
                                    <textarea name="description" id="description" rows="10" class="form-control required" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
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
