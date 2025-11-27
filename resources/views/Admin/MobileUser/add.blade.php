
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                mobile: {
                    required: true,
                    remote: '{{route("admin.mobile_user.mobileUsercheck")}}',
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
        <h5 class="modal-title">Add Mobile Usesr</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.mobile_user.save')}}" id="formadd">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Name</b>
                    <input type="text" name="name" class="form-control" placeholder="Enter Mobile User Name">
                </div>
                <div class="form-group">
                    <b>Mobile number</b>
                    <span class="text-danger"> *</span>
                    <input type="number" name="mobile" class="form-control required" placeholder="Enter mobile number">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>