
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                email: {
                    required: true,
                    remote: '{{route("admin.subscriber.subscriberCheckUpdate",$update->id)}}'
                }
            },
            messages: {
                email: {
                    required: "Subscriber email is required.",
                    remote: "Subscriber email is not valid or already exist."
                },
            },
        });
    });
</script>
<div class="modal-dialog ">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Subscriber</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.subscriber.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Subscriber email</b>
                    <span class="text-danger"> *</span>
                    <input type="email" name="email" class="form-control required" value="{{$update->email}}" placeholder="Enter Subscriber Email">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>