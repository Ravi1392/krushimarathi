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
            "url": "{{route('admin.district.getData')}}",
            "dataType": "json",
            "type": "POST",
            "data": {_token: "{{csrf_token()}}"}
        },
        "columns": [
            {"data": "action", "searchable": false, "sortable": false},
            {"data": "id"},
            {"data": "state_name"},
            {"data": "en_name"},
            {"data": "total_tahsils"},
            {"data": "total_villages"},
            {"data": "views"},
            {"data": "active"}
        ],
        rowCallback: function(row, data) {
            if (data.is_active === 0) {
                $(row).css('background-color', 'yellow');
            }
            if (data.deleted_at !== null) {
                $(row).css({
                    'background-color': 'red',
                    'color': '#ffffff'
                });
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
                text: "You will not be able to recover this state data!",
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
                            text: "District data has been successfully deleted..",
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
                        text: "Your state data is safe :)",
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

        var i = 0;
        if (Array.prototype.forEach) {

            var elems = $('.switchery');
            $.each(elems, function (key, value) {
                var $size = "", $color = "", $sizeClass = "", $colorCode = "";
                $size = $(this).data('size');
                var $sizes = {
                    'lg': "large",
                    'sm': "small",
                    'xs': "xsmall"
                };
                if ($(this).data('size') !== undefined) {
                    $sizeClass = "switchery switchery-" + $sizes[$size];
                } else {
                    $sizeClass = "switchery";
                }

                $color = $(this).data('color');
                var $colors = {
                    'primary': "#967ADC",
                    'success': "#37BC9B",
                    'danger': "#DA4453",
                    'warning': "#F6BB42",
                    'info': "#3BAFDA"
                };
                if ($color !== undefined) {
                    $colorCode = $colors[$color];
                }
                else {
                    $colorCode = "#37BC9B";
                }

                var switchery = new Switchery($(this)[0], {className: $sizeClass, color: $colorCode});
            });
        } else {
            var elems1 = document.querySelectorAll('.switchery');
            for (i = 0; i < elems1.length; i++) {
                var $size = elems1[i].data('size');
                var $color = elems1[i].data('color');
                var switchery = new Switchery(elems1[i], {color: '#37BC9B'});
            }
        }
        $(".switch").change(function () {
            var id = $(this).attr("data-value");

            var status = 0;
            if ($(this).prop("checked") == true) {
                status = 1;
            }
            else if ($(this).prop("checked") == false) {
                status = 0;
            }
            var url = "{{URL::to('admin/districtactivedeactive')}}";
            url = url + "/" + id + "/" + status;
            $.ajax({
                url: url
            }).done(function (data) {
                if (data == 1)
                {
                    if (status == 1)
                    {
                        toastr.success('District data has been Activated', 'Activated');
                    } else
                    {
                        toastr.error('District data has been Deactivated', 'Deactivated');
                    }
                    // Reload DataTable or update UI
                    $('.pending-table').DataTable().ajax.reload();
                } else
                {
                    toastr.error('Something went wrong..', 'Error');
                }

            });
        });
    }
    
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
                var url = "{{URL::to('admin/districtResetViews')}}";
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    }
                }).done(function (data) {
                    swal({
                        title: "Deleted!",
                        text: "Views has been successfully Reset.",
                        type: "success",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonColor: "#2196F3"
                    });
                    $('.pending-table').DataTable().ajax.reload();
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
            <h5 class="panel-title">District list</h5>
            <div class="heading-elements">
                <span class="btn btn-labeled btn-labeled-right bg-blue heading-btn reset_views">Reset Views<b><i class="icon-menu7"></i></b></span>
                <a href="{{route('admin.district.addDistrict')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Add District<b><i class="icon-menu7"></i></b></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table datatable-basic pending-table table-framed" >
                    <thead>
                        <tr>
                            <th width="100px">Action</th>
                            <th>#</th>
                            <th>State Name</th>
                            <th>District Name</th>
                            <th>Total Tahsil</th>
                            <th>Total Villages</th>
                            <th>Views</th>
                            <th style="width: 10%;">Active</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @endsection
