
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                slug: {
                    required: true,
                    minlength: 30,
                    pattern: /^[a-zA-Z0-9\- ]+$/,
                    remote: '{{route("admin.news_flash.newsFlashSlugCheck")}}',
                },
            },
            messages: {
                slug: {
                    required: "News Flash slug field is required.",
                    minlength: "News Flash slug must be at least 30 characters long.",
                    pattern: "Slug can only contain letters, numbers, and dashes.",
                    remote: "News Flash slug is not valid or already exist.",
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
<div class="modal-dialog ">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add News Flash</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.news_flash.save')}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Select Language</b>
                    <span class="text-danger"> *</span>
                    <select class="form-control required" required="required" name="language_id">
                        <option value="">Select Language</option>
                        <option value="1">Marathi</option>
                        <option value="2">Hindi</option>
                        <option value="3">English</option>
                    </select>
                </div>
                <div class="form-group">
                    <b>Slug Name</b>
                    <span class="text-danger"> *</span>
                    <input type="text" name="slug" class="form-control required" placeholder="Enter Slug Name">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>