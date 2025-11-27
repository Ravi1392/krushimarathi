@extends('Admin.layouts.common')

@push('custom-scripts')
   <script>
        $(document).ready(function () {
            $('#formadd').validate({// initialize the plugin
                rules: {
                    google_ads: {
                        required: true
                    },
                    google_tag: {
                        required: true
                    },
                    adscode: {
                        required: true
                    }  
                },
                messages: {
                    google_ads: "Google ads field is required.",
                    google_tag: "Google Tag field is required.",
                    adscode: "Google Ads Code field is required." 
                },
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
                    <h5 class="panel-title">Setting</h5>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.setting.addSetting')}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            @foreach($setting_update as $setting) 
                                <div class="form-group">
                                    <b>{{ucfirst(str_replace("_", " ",$setting->key))}}(%)</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="{{$setting->key}}" placeholder="{{ucfirst(str_replace("_", " ",$setting->key))}}" readonly>{{$setting->value}}</textarea>
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
