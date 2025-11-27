<div class="modal-dialog ">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Edit Team</h5>
    </div>        
    <div class="modal-body">
        <form method="post"  action="{{route('admin.ipl.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="panel-body">
                <div class="form-group">
                    <b>Team Name</b>
                    <input type="text" name="en_teamname" class="form-control" value="{{$update->en_teamname}}" readonly>
                </div>
                
                <div class="form-group">
                    <b>matches</b>
                    <input type="text" name="matches" value="{{$update->matches}}" class="form-control" placeholder="Enter Matches">
                </div>

                <div class="form-group">
                    <b>Wins</b>
                    <input type="text" class="form-control" name="wins" value="{{$update->wins}}" placeholder="Enter Wins">
                </div>

                <div class="form-group">
                    <b>Loss</b>
                    <input type="text" class="form-control" name="loss" value="{{$update->loss}}" placeholder="Enter Loss">
                </div>

                <div class="form-group">
                    <b>Ties</b>
                    <input type="text" class="form-control" name="ties" value="{{$update->ties}}" placeholder="Enter Ties">
                </div>

                <div class="form-group">
                    <b>No Result</b>
                    <input type="text" class="form-control" name="nr" value="{{$update->nr}}" placeholder="Enter No Result Data">
                </div>

                <div class="form-group">
                    <b>Points</b>
                    <input type="text" class="form-control" name="pts" value="{{$update->pts}}" placeholder="Enter Points">
                </div>

                <div class="form-group">
                    <b>Net Run Rate</b>
                    <input type="text" class="form-control" name="nrr" value="{{$update->nrr}}" placeholder="Enter Net Run Rate">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>