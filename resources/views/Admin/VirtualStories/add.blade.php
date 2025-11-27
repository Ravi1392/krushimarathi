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
                title: {
                    required: true,
                },
                slug: {
                    required: true,
                    remote: '{{route("admin.virtualStories.storySlugcheck")}}',
                },
                story_image: {
                    required: true,
                },
                type: {
                    required: true,
                }
            },
            messages: {
                title: "Web Story title field is required.",
                story_image: "Web Story Image field is required.",
                type: "Web Story type is required.",
                slug: {
                    required: "Web Story slug field is required.",
                    remote: "Web Story slug is not valid or already exist.",
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
    
</script>

@endpush
@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Add Web Story</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.virtualStories.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Web Story List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    
                    <form method="post"  action="{{route('admin.virtualStories.save')}}" id="formadd" enctype="multipart/form-data">
                        <h6>Cover Page</h6>
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Title</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="title" class="form-control required" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Story Slug</b>
                                    <span class="text-danger"> *</span>
                                    <input type="text" name="slug" class="form-control required" placeholder="Enter story slug">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Short Description</b>
                                    <textarea type="text" class="form-control" name="description" placeholder="Short Description"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story thumbail</b>
                                    <input type="file" class="file-styled checkImageWidthHeight required" name="story_image" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <hr>
                           
                            <p><b>Fixed Optional Page 1 : 1 layers (fill + vertical + vertical)</b></p>
                            <input type="hidden" name="image1" value="image1">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Title - 1</b>
                                    <input type="text" name="title1" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image - 1</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_image1"  id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Image Credit - 1</b>
                                    <input type="text" name="image_credit1" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Short Description - 1</b>
                                    <textarea type="text" class="form-control" name="story_description1" placeholder="Short Description"></textarea>
                                </div>
                            </div>

                            <input type="hidden" name="image2" value="image2">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Title - 2</b>
                                    <input type="text" name="title2" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image - 2</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_image2" id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Image Credit - 2</b>
                                    <input type="text" name="image_credit2" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Short Description - 2</b>
                                    <textarea type="text" class="form-control" name="story_description2" placeholder="Short Description"></textarea>
                                </div>
                            </div>

                            <input type="hidden" name="image3" value="image3">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Title - 3</b>
                                    <input type="text" name="title3" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image - 3</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_image3"  id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Image Credit - 3</b>
                                    <input type="text" name="image_credit3" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Short Description - 3</b>
                                    <textarea type="text" class="form-control" name="story_description3" placeholder="Short Description"></textarea>
                                </div>
                            </div>
                            
                            <input type="hidden" name="image4" value="image4">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Title - 4</b>
                                    <input type="text" name="title4" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image - 4</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_image4"  id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Image Credit - 4</b>
                                    <input type="text" name="image_credit4" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Short Description - 4</b>
                                    <textarea type="text" class="form-control" name="story_description4" placeholder="Short Description"></textarea>
                                </div>
                            </div>

                            <input type="hidden" name="image5" value="image5">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Title - 5</b>
                                    <input type="text" name="title5" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image - 5</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_image5"  id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Image Credit - 5</b>
                                    <input type="text" name="image_credit5" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Short Description - 5</b>
                                    <textarea type="text" class="form-control" name="story_description5" placeholder="Short Description"></textarea>
                                </div>
                            </div>
                            
                            <input type="hidden" name="image6" value="image6">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Title - 6</b>
                                    <input type="text" name="title6" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image - 6</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_image6"  id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Image Credit - 6</b>
                                    <input type="text" name="image_credit6" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Short Description - 6</b>
                                    <textarea type="text" class="form-control" name="story_description6" placeholder="Short Description"></textarea>
                                </div>
                            </div>
                            
                            <input type="hidden" name="image7" value="image7">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Title - 7</b>
                                    <input type="text" name="title7" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image - 7</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_image7"  id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Image Credit - 7</b>
                                    <input type="text" name="image_credit7" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Short Description - 7</b>
                                    <textarea type="text" class="form-control" name="story_description7" placeholder="Short Description"></textarea>
                                </div>
                            </div>

                            <p><b>Optional Video 1 : 1 layers (fill (video) + vertical + vertical)</b></p>
                            <input type="hidden" name="video1" value="video1">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Text</b>
                                    <input type="text" name="video_title1" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_video1"  id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Video Credit - 1</b>
                                    <input type="text" name="video_credit1" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Short Description</b>
                                    <textarea type="text" class="form-control" name="video_description1" placeholder="Video Description"></textarea>
                                </div>
                            </div>
                            <hr>
                            <p><b>Optional Page 1 : 1 layer (vertical)</b></p>
                            <input type="hidden" name="image4" value="image4">
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Story Text</b>
                                    <input type="text" name="title8" class="form-control" placeholder="Enter story title">
                                </div>
                                <div class="form-group col-md-6">
                                    <b class="display-block">Upload Story Image</b>
                                    <input type="file" class="file-styled checkImageWidthHeight" name="story_image8"  id="fileUpload">
                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="row content-block">
                                <div class="form-group col-md-6">
                                    <b >Image Credit - 8</b>
                                    <input type="text" name="image_credit8" class="form-control" placeholder="Enter Credit Name">
                                </div>
                                <div class="form-group col-sm-12">
                                    <b>Short Description</b>
                                    <textarea type="text" class="form-control" name="story_description8" placeholder="Short Description"></textarea>
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
