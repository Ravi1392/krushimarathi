
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                mobile: {
                    required: true,
                    remote: '{{route("admin.mobile_user.mobileUserCheckUpdate",$update->id)}}'
                }
            },
            messages: {
                mobile: {
                    required: "Mobile number is required.",
                    remote: "Mobile number is not valid or already exist."
                },
            },
        });
    });
</script>
<div class="modal-dialog ">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Mobile Number</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.mobile_user.editsave',base64_encode($update->id))}}" id="formadd">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Name</b>
                    <input type="text" name="name" class="form-control" value="{{$update->name}}" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <b>Mobile number</b>
                    <span class="text-danger"> *</span>
                    <input type="number" name="mobile" class="form-control required" value="{{$update->mobile}}" placeholder="Enter Mobile number">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>