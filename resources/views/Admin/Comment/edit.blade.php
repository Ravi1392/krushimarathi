
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                name: {
                    required: true,
                },
                comment: {
                    required: true,
                },
            },
            messages: {
                name:"Name field is required.",
                comment:"Comment field is required.",
            },
        });
    });
</script>
<div class="modal-dialog ">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Comment</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.comments.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Name</b>
                    <span class="text-danger"> *</span>
                    <input type="text" name="name" class="form-control required" value="{{$update->name}}" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <b>Comment</b>
                    <span class="text-danger"> *</span>
                    <textarea type="text" class="form-control required" name="comment" placeholder="Enter Comment">{{$update->comment}}</textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>