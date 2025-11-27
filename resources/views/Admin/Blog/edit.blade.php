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
                    <h5 class="panel-title">Edit Blog</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.blog.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Blog List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.blog.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Blog Name</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="blog_title" class="form-control required" placeholder="Enter blog title" value="{{$update->blog_title}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Blog Slug</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="blog_slug" class="form-control required" placeholder="Enter blog slug" value="{{$update->blog_slug}}">
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Short Description</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="short_description" placeholder="Short Description">{{$update->short_description}}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <b >Meta Description</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="meta_description" placeholder="Meta Description">{{$update->meta_description}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Select Related Blog</b>
                                    <select class="form-control select2 select" name="related_blog_id" id="related_blog_id">
                                        <option value="">Select Related Blog</option>
                                        @foreach($blogs  as $blog)
                                            @if($blog->id == $update->related_blog_id)
                                                <option value="{{$blog->id}}" selected>{{$blog->blog_title}}</option>
                                            @else
                                                <option value="{{$blog->id}}">{{$blog->blog_title}}</option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 1</b>
                                    <span class="text-danger"> *</span>
                                    <textarea type="text" class="form-control required" name="first_title" placeholder="Enter Title - 1">{{$update->first_title}}</textarea>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 1</b>
                                    <span class="text-danger"> *</span>
                                    <textarea name="first_description" id="first_description" rows="10" class="form-control required" placeholder="Enter content here">{{$update->first_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 2</b>
                                    <textarea type="text" class="form-control" name="second_title" placeholder="Enter Title - 2">{{$update->second_title}}</textarea>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 2</b>
                                    <textarea name="second_description" id="second_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->second_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 3</b>
                                    <textarea type="text" class="form-control" name="third_title" placeholder="Enter Title - 3">{{$update->third_title}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 3</b>
                                    <textarea name="third_description" id="third_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->third_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 4</b>
                                    <textarea type="text" class="form-control" name="fourth_title" placeholder="Enter Title - 4">{{$update->fourth_title}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 4</b>
                                    <textarea name="fourth_description" id="fourth_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->fourth_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 5</b>
                                    <textarea type="text" class="form-control" name="fifth_title" placeholder="Enter Title - 5">{{$update->fifth_title}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 5</b>
                                    <textarea name="fifth_description" id="fifth_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->fifth_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 6</b>
                                    <textarea type="text" class="form-control" name="six_title" placeholder="Enter Title - 6">{{$update->six_title}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 6</b>
                                    <textarea name="six_description" id="six_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->six_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 7</b>
                                    <textarea type="text" class="form-control" name="seven_title" placeholder="Enter Title - 7">{{$update->seven_title}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 7</b>
                                    <textarea name="seven_description" id="seven_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->seven_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 8</b>
                                    <textarea type="text" class="form-control" name="eight_title" placeholder="Enter Title - 8">{{$update->eight_title}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 8</b>
                                    <textarea name="eight_description" id="eight_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->eight_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 9</b>
                                    <textarea type="text" class="form-control" name="nine_title" placeholder="Enter Title - 9">{{$update->nine_title}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 9</b>
                                    <textarea name="nine_description" id="nine_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->nine_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Title - 10</b>
                                    <textarea type="text" class="form-control" name="ten_title" placeholder="Enter Title - 10">{{$update->ten_title}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>Description - 10</b>
                                    <textarea name="ten_description" id="ten_description" rows="10" class="form-control" placeholder="Enter content here">{{$update->ten_description}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>FAQs Title</b>
                                    <textarea type="text" class="form-control" name="question" placeholder="Enter FAQs Title">{{$update->question}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <b>FAQs Description</b>
                                    <textarea name="question_and_answare" id="question_and_answare" rows="10" class="form-control" placeholder="Enter content here">{{$update->question_and_answare}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Tags</b>
                                    <textarea type="text" class="form-control required" name="tags" placeholder="Enter Tags">{{$update->tags}}</textarea>
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Second Related Blog</b>
                                    <select class="form-control select2 select" name="second_related_blog" id="second_related_blog">
                                        <option value="">Select Second Related Blog</option>
                                        @foreach($blogs  as $blog)
                                            @if($blog->id == $update->second_related_blog)
                                                <option value="{{$blog->id}}" selected>{{$blog->blog_title}}</option>
                                            @else
                                                <option value="{{$blog->id}}">{{$blog->blog_title}}</option>
                                            @endif
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
