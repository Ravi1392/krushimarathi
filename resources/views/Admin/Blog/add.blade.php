@extends('Admin.layouts.common')

@push('custom-scripts')
<!-- Theme JS files -->
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/css/switch.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/assets//admin/css/switchery.min.css')}}">
<script src="{{asset('public/assets/admin/js/switchery.js')}}" type="text/javascript"></script>  
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/notifications/sweet_alert.min.js')}}"></script>

<script src="{{ asset('public/assets/admin/js/plugins/ckeditor/ckeditor.js') }}"></script>
<!-- /theme JS files -->

<script type="text/javascript">
var my_url = 'http://example.com'; // Define my_url
    $(document).ready(function () {
        $('.select2').select2();
        $('#formadd').validate({// initialize the plugin
            rules: {
                category_id: {
                    required: true,
                },
                sub_category_id: {
                    required: true,
                },
                blog_title: {
                    required: true,
                    remote: {
                        url: '{{ route("admin.blog.blogCheck") }}',
                        type: "get",
                        data: {
                            category_id: function() {
                                return $('select[name="category_id"]').val();
                            }
                        }
                    },
                },
                blog_slug: {
                    required: true,
                    minlength: 30,
                    pattern: /^[a-zA-Z0-9\- ]+$/,
                    remote: '{{route("admin.blog.blogSlugCheck")}}',
                },
                short_description: {
                    required: true,
                },
                blog_image: {
                    required: true,
                },
                meta_description: {
                    required: true,
                },
                first_title: {
                    required: true,
                },
                first_description: {
                    required: true,
                },
            },
            messages: {
                category_id: "Select Category field is required.",
                sub_category_id: "Select Sub category field is required.",
                short_description: "Short description field is required.",
                blog_image: "Blog Image field is required.",
                meta_description: "Meta description field is required.",
                first_title: "First title field is required.",
                first_description: "First description field is required.",
                blog_title: {
                    required: "Blog title field is required.",
                    remote: "Blog title is not valid or already exist.",
                },
                blog_slug: {
                    required: "Blog slug field is required.",
                    minlength: "Blog slug must be at least 30 characters long.",
                    pattern: "Slug can only contain letters, numbers, and dashes.",
                    remote: "Blog slug is not valid or already exist.",
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
            },
        });
    });

    //Get Sub Category
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                var url = "{{URL::to('admin/getSubCategories')}}";
                url = url + "/" + categoryId;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#sub_category_id').empty();
                        $('#sub_category_id').append('<option value="">Select Sub Category</option>');
                        $.each(data, function(key, value) {
                            $('#sub_category_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        // Revalidate field after population
                        $('#category_id').valid(); // Revalidate category field
                        $('#sub_category_id').valid(); // Revalidate subcategory field
                    }
                });
            } else {
                $('#sub_category_id').empty();
                $('#sub_category_id').append('<option value="">Select Sub Category</option>');
            }
        });
        // Revalidate subcategory dropdown when selected
        $('#sub_category_id').on('change', function() {
            $(this).valid();
        });
    });

    CKEDITOR.replace( 'first_description' );
    CKEDITOR.replace( 'second_description' );
    CKEDITOR.replace( 'third_description' );
    CKEDITOR.replace( 'fourth_description' );
    
    CKEDITOR.replace( 'fifth_description' );
    CKEDITOR.replace( 'six_description' );
    CKEDITOR.replace( 'seven_description' );
    CKEDITOR.replace( 'eight_description' );
    CKEDITOR.replace( 'nine_description' );
    CKEDITOR.replace( 'ten_description' );
    CKEDITOR.replace( 'question_and_answare' );
    
</script>

@endpush
@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Add Blog</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.blog.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Blogs List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.blog.save')}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Category</b>
                                    <span class="text-danger"> *</span>
                                    <select class="form-control required select2 select" required="required" name="category_id" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories  as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Select Sub Category</b>
                                    <span class="text-danger"> *</span>
                                    <select class="form-control required select2 select" id="sub_category_id" name="sub_category_id">
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Blog Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="blog_title" class="form-control required" placeholder="Enter blog title">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Blog Slug</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="blog_slug" class="form-control required" placeholder="Enter blog slug">
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Short Description</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="short_description" placeholder="Short Description"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload blog image</b>
                                    <input type="file" class="file-styled checkImageWidthHeight required" name="blog_image" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <b >Meta Description</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="meta_description" placeholder="Meta Description"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Related Blog</b>
                                    <select class="form-control select2 select" name="related_blog_id" id="related_blog_id">
                                        <option value="">Select Related Blog</option>
                                        @foreach($blogs  as $blog)
                                            <option value="{{$blog->id}}">{{$blog->blog_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Title - 1</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="first_title" placeholder="Enter Title - 1"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Image - 1</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="first_image" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 1</b>
                                    <span class="text-danger"> *</span>
                                    <textarea name="first_description" id="first_description" rows="10" class="form-control required" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Title - 2</b>
                                    <textarea type="text" class="form-control" name="second_title" placeholder="Enter Title - 2"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Image - 2</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="second_image" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 2</b>
                                    <textarea name="second_description" id="second_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Title - 3</b>
                                    <textarea type="text" class="form-control" name="third_title" placeholder="Enter Title - 3"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Image - 3</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="third_image" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 3</b>
                                    <textarea name="third_description" id="third_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Title - 4</b>
                                    <textarea type="text" class="form-control" name="fourth_title" placeholder="Enter Title - 4"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Image - 4</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="fourth_image" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 4</b>
                                    <textarea name="fourth_description" id="fourth_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 5</b>
                                    <textarea type="text" class="form-control" name="fifth_title" placeholder="Enter Title - 5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 5</b>
                                    <textarea name="fifth_description" id="fifth_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 6</b>
                                    <textarea type="text" class="form-control" name="six_title" placeholder="Enter Title - 6"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 6</b>
                                    <textarea name="six_description" id="six_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 7</b>
                                    <textarea type="text" class="form-control" name="seven_title" placeholder="Enter Title - 7"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 7</b>
                                    <textarea name="seven_description" id="seven_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 8</b>
                                    <textarea type="text" class="form-control" name="eight_title" placeholder="Enter Title - 8"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 8</b>
                                    <textarea name="eight_description" id="eight_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 9</b>
                                    <textarea type="text" class="form-control" name="nine_title" placeholder="Enter Title - 9"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 9</b>
                                    <textarea name="nine_description" id="nine_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 10</b>
                                    <textarea type="text" class="form-control" name="ten_title" placeholder="Enter Title - 10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 10</b>
                                    <textarea name="ten_description" id="ten_description" rows="10" class="form-control" placeholder="Enter content here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>FAQs Title</b>
                                    <textarea type="text" class="form-control" name="question" placeholder="Enter FAQs Title"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>FAQs Description</b>
                                    <textarea name="question_and_answare" id="question_and_answare" rows="10" class="form-control" placeholder="Enter content here"></textarea>
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
