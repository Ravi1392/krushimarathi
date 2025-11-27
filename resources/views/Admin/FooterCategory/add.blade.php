
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                name: {
                    required: true,
                    remote: '{{route("admin.footercategory.footercategorycheck")}}',
                },
                category_slug: {
                    required: true,
                    minlength: 4,
                    maxlength: 28,
                    pattern: /^[a-zA-Z0-9\- ]+$/,
                    remote: '{{route("admin.footercategory.footercategoryslugcheck")}}',
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
                    required: "Footer Category name is required.",
                    remote: "Footer Category name is not valid or already exist."
                },
                category_slug: {
                    required: "Footer Category slug is required.",
                    minlength: "Slug must be at least 4 characters long.",
                    maxlength: "Slug must not exceed 28 characters.",
                    pattern: "Slug can only contain letters, numbers, and dashes.",
                    remote: "Footer Category slug is not valid or already exist."
                },
            },
        });
    });
</script>
<div class="modal-dialog ">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Footer Category</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.footercategory.save')}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Footer Category Name</b>
                    <span class="text-danger"> *</span>
                    <input type="text" name="name" class="form-control required" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <b>Slug Name</b>
                    <span class="text-danger"> *</span>
                    <input type="text" name="category_slug" class="form-control required" placeholder="Enter Slug Name">
                </div>

                <div class="form-group">
                    <b>Meta Keywords</b>
                    <span class="text-danger"> *</span>
                    <textarea type="text" class="form-control required" name="meta_keywords" placeholder="Meta Keywords"></textarea>
                </div>

                <div class="form-group">
                    <b>Meta Description</b>
                    <span class="text-danger"> *</span>
                    <textarea type="text" class="form-control required" name="meta_description" placeholder="Meta Description"></textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>