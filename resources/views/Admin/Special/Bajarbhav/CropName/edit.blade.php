
<script>
    $(document).ready(function () {
        $('#formadd').validate({// initialize the plugin
            rules: {
                crop_type_id: {
                    required: true,
                },
                en_crop_name: {
                    required: true,
                },
                mr_crop_name: {
                    required: true,
                    remote: '{{route("admin.crop_name.cropNameCheckUpdate",$update->id)}}',
                },
            },
            messages: {
                crop_type_id: "Select Crop Type field is required.",
                en_crop_name:"English Crop Name field is required.",
                mr_crop_name: {
                    required: "Marathi Crop Name is required.",
                    remote: "Marathi Crop Name is not valid or already exist."
                },
            },
        });
    });
</script>
<div class="modal-dialog ">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Crop Name</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.crop_name.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Select Crop Type</b>
                    <span class="text-danger"> *</span>
                    <select class="form-control required select2 select" required="required" name="crop_type_id">
                        <option value="">Select Crop Type</option>
                        @foreach($data as $cropType)
                            @if($cropType->id == $update->crop_type_id)
                                <option value="{{$cropType->id}}" selected>{{$cropType->mr_crop_type}}</option>
                            @else
                            <option value="{{$cropType->id}}">{{$cropType->mr_crop_type}}</option>
                            @endif
                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <b>English Crop Name</b>
                    <span class="text-danger"> *</span>
                    <input type="text" name="en_crop_name" class="form-control required" value="{{$update->en_crop_name}}" placeholder="Enter English Crop Name">
                </div>
                <div class="form-group">
                    <b>Marathi Crop Name</b>
                    <span class="text-danger"> *</span>
                    <input type="text" name="mr_crop_name" value="{{$update->mr_crop_name}}" class="form-control required" placeholder="Enter Marathi Crop Name">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>