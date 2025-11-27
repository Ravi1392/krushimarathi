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
            "url": "{{route('admin.bajarbhav.getData')}}",
            "dataType": "json",
            "type": "POST",
            "data": {_token: "{{csrf_token()}}"}
        },
        "columns": [
            {"data": "id", "searchable": false, "sortable": false},
            {"data": "id"},
            {"data": "name"},
            {"data": "views"}
        ],
        rowCallback: function(row, data) {
            if (data.is_active === 0) {
                $(row).css('background-color', 'yellow');
            }
        }
    });
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    
    // empty views
    $('.reset_views').on('click', function () {
            
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Views",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, Clear it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    var url = "{{URL::to('admin/bajarbhavResetViews')}}";
                    $.ajax({
                        url: url,
                        type: "get",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        }
                    }).done(function (data) {
                        swal({
                            title: "Reset!",
                            text: "Views has been successfully Reset.",
                            type: "success",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            confirmButtonColor: "#2196F3"
                        });
                        $('.pending-table').DataTable().row($(this).parents('tr')).remove().draw();
                    });

                }
                else {
                    swal({
                        title: "Cancelled",
                        text: "Your Views is safe :)",
                        confirmButtonColor: "#2196F3",
                        type: "error"
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
                <h5 class="panel-title">BajarBhav Data List</h5>
                <div class="heading-elements">
                    @if (Auth::user()->role_id === 1)
                        <span class="btn btn-labeled btn-labeled-right bg-blue heading-btn reset_views">Reset Views<b><i class="icon-menu7"></i></b></span>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table datatable-basic pending-table table-framed" >
                        <thead>
                            <tr>
                                <th width="100px">Action</th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

@endsection
