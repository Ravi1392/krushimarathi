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
            delete_recodes();
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
            "url": "{{route('admin.news_flash.getDataList',$id)}}",
            "dataType": "json",
            "type": "POST",
            "data": {_token: "{{csrf_token()}}"}
        },
        "columns": [
            {"data": "action", "searchable": false, "sortable": false},
            {"data": "id"},
            {"data": "title"},
            {"data": "created_at"}
        ],
        rowCallback: function(row, data) {
            if (data.is_active === 0) {
                $(row).css('background-color', 'yellow');
            } 
            if (data.deleted_at !== null && data.deleted_at !== "") {
                $(row).css('color', 'white');
                $(row).css('background-color', 'red');
            }
        }
    });
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    
    function delete_recodes() {

        $('.delete_row').on('click', function () {
            var url = $(this).attr("data-value");

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        type: "get",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        }
                    }).done(function (data) {
                        swal({
                            title: "Deleted!",
                            text: "News Flash Data has been successfully deleted.",
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
                        text: "Your imaginary file is safe :)",
                        confirmButtonColor: "#2196F3",
                        type: "error"
                    });
                }
            });
        });

        $('.restore_row').on('click', function () {
            var url = $(this).attr("data-value");

            swal({
                title: "Are you sure?",
                text: "Do you want to restore this record?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745", // Green for restore
                confirmButtonText: "Yes, restore it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        }
                    }).done(function (data) {
                        swal({
                            title: "Restored!",
                            text: "The record has been successfully restored.",
                            type: "success",
                            confirmButtonColor: "#2196F3"
                        });

                        // Reload DataTable or update UI
                        $('.pending-table').DataTable().ajax.reload();
                    }).fail(function () {
                        swal({
                            title: "Error!",
                            text: "Something went wrong. Please try again.",
                            type: "error",
                            confirmButtonColor: "#d33"
                        });
                    });

                } else {
                    swal({
                        title: "Cancelled",
                        text: "The record was not restored.",
                        confirmButtonColor: "#2196F3",
                        type: "error"
                    });
                }
            });
        });

    }

});
</script>

@endpush
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Page length options -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">News Flash Data List</h5>
            <div class="heading-elements">
                <a href="{{route('admin.news_flash.index')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">News Flash List<b><i class="icon-menu7"></i></b></a>
                <a href="{{route('admin.news_flash.addFlashData',$id)}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn ajaxviewmodel">Add News Flash Data<b><i class="icon-menu7"></i></b></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table datatable-basic pending-table table-framed" >
                    <thead>
                        <tr>
                            <th width="100px">Action</th>
                            <th>#</th>
                            <th>Title</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection
