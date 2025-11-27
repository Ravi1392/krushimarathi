
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                title: {
                    required: true,
                },
            },
            messages: {
                title: {
                    required: "News Field Data Title field is required.",
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
        <h5 class="modal-title">Add News Flash Data</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.news_flash.saveData')}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" class="form-control" value="{{$id}}">
            <div class="panel-body">
                <div class="form-group">
                    <b>Title</b>
                    <span class="text-danger"> *</span>
                    <textarea type="text" class="form-control required" name="title" placeholder="Enter News Flash Data Title"></textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>