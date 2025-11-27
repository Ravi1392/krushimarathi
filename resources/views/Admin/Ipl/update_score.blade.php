@extends('Admin.layouts.common')

@push('custom-scripts')
<!-- Theme JS files -->
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/css/switch.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/assets//admin/css/switchery.min.css')}}">
<script src="{{asset('public/assets/admin/js/switchery.js')}}" type="text/javascript"></script>  
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/notifications/sweet_alert.min.js')}}"></script>

<!-- /theme JS files -->

@endpush
@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Edit Match</h5>
                    <div class="heading-elements">
                        <a href="{{route('admin.match.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Match List<b><i class="icon-menu7"></i></b></a>
                    </div>
                </div>
                <div class="panel-body" style="display: block;">
                    <form method="post"  action="{{route('admin.match.editsave',base64_encode($update->id))}}" id="formadd" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Match Status</b>
                                    <input type="text" name="status" class="form-control" value="{{ $update->status }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Toss Winner</b>
                                    <input type="text" name="toss_winner" class="form-control" value="{{ $update->toss_winner }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Toss Choice</b>
                                    <input type="text" name="toss_choice" class="form-control" value="{{ $update->toss_choice }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Fantasy Enabled</b>
                                    <input type="text" name="fantasy_enabled" class="form-control" value="{{$update->fantasy_enabled }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>BBB Enabled</b>
                                    <input type="text" name="bbb_enabled" class="form-control" value="{{ $update->bbb_enabled }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Has Squad</b>
                                    <input type="text" name="has_squad" class="form-control" value="{{ $update->has_squad }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>Match Started</b>
                                    <input type="text" name="match_started" class="form-control" value="{{ $update->match_started }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>Match Ended</b>
                                    <input type="text" name="match_ended" class="form-control" value="{{ $update->match_ended }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" value="1" class="form-check-input" name="first_inning">
											1st Inning
										</label>
									</div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" value="2" class="form-check-input" name="second_inning">
											2nd Inning
										</label>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <input type="hidden" name="first_inning_id" class="form-control" value="{{ isset($update['scores'][0]['id']) ? $update['scores'][0]['id'] : '' }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="hidden" name="second_inning_id" class="form-control" value="{{ isset($update['scores'][1]['id']) ? $update['scores'][1]['id'] : '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>1st Inning Name</b>
                                    <input type="text" name="first_inning_name" class="form-control" placeholder="Enter 1st Inning Name" value="{{ isset($update['scores'][0]['inning']) ? $update['scores'][0]['inning'] : '' }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>2nd Inning Name</b>
                                    <input type="text" name="second_inning_name" class="form-control" placeholder="Enter 2nd Inning Name" value="{{ isset($update['scores'][1]['inning']) ? $update['scores'][1]['inning'] : '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>1st Inning Runs</b>
                                    <input type="text" name="first_inning_runs" class="form-control" placeholder="Enter 1st Inning Runs" value="{{ isset($update['scores'][0]['runs']) ? $update['scores'][0]['runs'] : '' }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>2nd Inning Runs</b>
                                    <input type="text" name="second_inning_runs" class="form-control" placeholder="Enter 2nd Inning Runs" value="{{ isset($update['scores'][1]['runs']) ? $update['scores'][1]['runs'] : '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>1st Inning Wickets</b>
                                    <input type="text" name="first_inning_wickets" class="form-control" placeholder="Enter 1st Inning Wickets" value="{{ isset($update['scores'][0]['wickets']) ? $update['scores'][0]['wickets'] : '' }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>2nd Inning Wickets</b>
                                    <input type="text" name="second_inning_wickets" class="form-control" placeholder="Enter 2nd Inning Wickets" value="{{ isset($update['scores'][1]['wickets']) ? $update['scores'][1]['wickets'] : '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <b>1st Inning Overs</b>
                                    <input type="text" name="first_inning_overs" class="form-control" placeholder="Enter 1st Inning Overs" value="{{ isset($update['scores'][0]['overs']) ? $update['scores'][0]['overs'] : '' }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <b>2nd Inning Overs</b>
                                    <input type="text" name="second_inning_overs" class="form-control" placeholder="Enter 2nd Inning Overs" value="{{ isset($update['scores'][1]['overs']) ? $update['scores'][1]['overs'] : '' }}">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
