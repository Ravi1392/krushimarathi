
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                name: {
                    required: true,
                    remote: '{{route("admin.specialcategory.specialCategoryCheckUpdate",$update->id)}}'
                },
                category_slug: {
                    required: true,
                    minlength: 4,
                    maxlength: 28,
                    pattern: /^[a-zA-Z0-9\- ]+$/,
                    remote: '{{route("admin.specialcategory.specialCategorySlugCheckUpdate",$update->id)}}',
                },
                meta_keywords: {
                    required: true,
                },
                meta_description: {
                    required: true,
                },
            },
            messages: {
                meta_description:"Meta Description field is required.",
                meta_keywords:"Meta Keywords field is required.",
                name: {
                    remote: "Category name is not valid or already exist."
                },
                category_slug: {
                    required: "Category slug is required.",
                    minlength: "Slug must be at least 4 characters long.",
                    maxlength: "Slug must not exceed 28 characters.",
                    pattern: "Slug can only contain letters, numbers, and dashes.",
                    remote: "Category Slug is not valid or already exist."
                },
            },
        });
    });
</script>
<div class="modal-dialog ">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Special Category</h5>
    </div>        
    <div class="modal-body">
        <form method="post" action="{{route('admin.special_categories.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Name</b>
                    <span class="text-danger"> *</span>
                    <input type="text" name="name" class="form-control required" value="{{$update->name}}" placeholder="Enter Name">
                </div>
                
                <div class="form-group">
                    <b>Slug Name</b>
                    <span class="text-danger"> *</span>
                    <input type="text" name="category_slug" value="{{$update->category_slug}}" class="form-control required" placeholder="Enter Slug Name">
                </div>

                <div class="form-group">
                    <b>Meta Keywords</b>
                    <span class="text-danger"> *</span>
                    <textarea type="text" class="form-control required" name="meta_keywords" placeholder="Meta Keywords">{{$update->meta_keywords}}</textarea>
                </div>

                <div class="form-group">
                    <b>Meta Description</b>
                    <span class="text-danger"> *</span>
                    <textarea type="text" class="form-control required" name="meta_description" placeholder="Meta Description">{{$update->meta_description}}</textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>