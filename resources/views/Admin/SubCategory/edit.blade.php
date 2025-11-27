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
                category_id: {
                    required: true,
                },
                name: {
                    required: true,
                    remote: {
                        url: '{{ route("admin.subcategory.subCategoryCheckUpdate",$update->id) }}',
                        type: "get",
                        data: {
                            category_id: function() {
                                return $('select[name="category_id"]').val();
                            }
                        }
                    },
                },
                subcategory_slug: {
                    required: true,
                    remote: '{{route("admin.subcategory.subCategorySlugCheckUpdate",$update->id)}}',
                },
                meta_description: {
                    required: true,
                },
                meta_keywords: {
                    required: true,
                }, 
            },
            messages: {
                category_id: "Select Category field is required.",
                meta_description: "Meta description field is required.",
                meta_keywords: "Meta keywords field is required.",
                name: {
                    required: "Sub Category Name is required.",
                    remote: "Sub Category name is not valid or already exist.",
                },
                subcategory_slug: {
                    required: "Sub Category slug is required.",
                    remote: "Sub Category slug is not valid or already exist.",
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
                    <h5 class="panel-title">Edit Sub Category</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.subcategory.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Sub Category List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.subcategory.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Category</b>
                                    <span class="text-danger"> *</span>
                                    <select class="form-control required select2 select" required="required" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($data as $category)
                                            @if($category->id == $update->category_id)
                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Sub Category Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="name" value="{{$update->name}}" class="form-control required" placeholder="Enter sub category name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Sub Category Slug Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="subcategory_slug" value="{{$update->subcategory_slug}}" class="form-control required" placeholder="Enter sub category slug name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Meta Description</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="meta_description" placeholder="Meta Description">{{$update->meta_description}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Meta Keywords</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="meta_keywords" placeholder="Meta Keywords">{{$update->meta_keywords}}</textarea>
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
