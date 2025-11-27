@extends('Admin.layouts.common')

@push('custom-scripts')
<!-- Theme JS files -->
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/admin/css/switch.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/assets//admin/css/switchery.min.css')}}">
<script src="{{asset('public/assets/admin/js/switchery.js')}}" type="text/javascript"></script>  
<script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/notifications/sweet_alert.min.js')}}"></script>
<!-- /theme JS files -->

<script type="text/javascript">
    $(function () {
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{
                    orderable: false,
                    width: '100px',
                    targets: [1]
                }],
            dom: '<"datatable-header"fBl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Search:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });
        $('.pending-table').DataTable({
            "processing": true,
            "serverSide": true,
            "select": true,
            "ajax": {
                "url": "{{route('admin.ipl.getData')}}",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}"}
            },
            "columns": [
                {"data": "action", "searchable": false, "sortable": false},
                {"data": "id"},
                {"data": "year"},
                {"data": "en_teamname"},
                {"data": "shortname"},
                {"data": "matches"},
                {"data": "wins"},
                {"data": "loss"},
                {"data": "ties"},
                {"data": "nr"},
                {"data": "pts"},
                {"data": "nrr"},
            ]
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });
    });

    $(document).ready(function () {
        $("#fetchTeams").click(function () {
            swal({
                title: "Are you sure?",
                text: "This will fetch and store the latest team data.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, Fetch it!",
                cancelButtonText: "No, Cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('admin.fetch.teams') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            swal({
                                title: "Success!",
                                text: "Teams have been fetched and stored successfully.",
                                icon: "success",
                                button: "OK",
                            });
                        },
                        error: function (xhr) {
                            swal({
                                title: "Error!",
                                text: "Something went wrong: " + xhr.responseJSON.message,
                                icon: "error",
                                button: "OK",
                            });
                        }
                    });
                }
                else {
                    swal({
                        title: "Cancelled",
                        text: "No changes were made.",
                        confirmButtonColor: "#2196F3",
                        type: "info"
                    });
                }
            });
        });
    });
</script>

@endpush
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Page length options -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Team list</h5>
            <div class="heading-elements">
                <button class="btn btn-labeled btn-labeled-right bg-blue heading-btn" id="fetchTeams">Update Data<b><i class="icon-menu7"></i></b></button >
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table datatable-basic pending-table table-framed" >
                    <thead>
                        <tr>
                            <th width="100px">Action</th>
                            <th>#</th>
                            <th>Year</th>
                            <th>Name</th>
                            <th>Short Name</th>
                            <th>Matches</th>
                            <th>Wins</th>
                            <th>Loss</th>
                            <th>Ties</th>
                            <th>No Result</th>
                            <th>Points</th>
                            <th>NRR</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @endsection
