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
            "url": "{{route('admin.footercategory.getData')}}",
            "dataType": "json",
            "type": "POST",
            "data": {_token: "{{csrf_token()}}"}
        },
        "columns": [
            {"data": "action", "searchable": false, "sortable": false},
            {"data": "id"},
            {"data": "name"},
            {"data": "views"},
            {"data": "active"}
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
                            text: "Footer Category has been successfully deleted.",
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
            var url = "{{URL::to('admin/footerCategoryactivedeactive')}}";
            url = url + "/" + id + "/" + status;
            $.ajax({
                url: url
            }).done(function (data) {
                if (data == 1)
                {
                    if (status == 1)
                    {
                        toastr.success('Footer Category has been Activated', 'Activated');
                    } else
                    {
                        toastr.error('Footer Category has been Deactivated', 'Deactivated');
                    }
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
                var url = "{{URL::to('admin/footerCategoryResetViews')}}";
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
            <h5 class="panel-title">Footer Category list</h5>
            <div class="heading-elements">
                <span class="btn btn-labeled btn-labeled-right bg-blue heading-btn reset_views">Reset Views<b><i class="icon-menu7"></i></b></span>
                <a href="{{route('admin.footercategory.addfootercategory')}}" class="btn btn-labeled btn-labeled-right bg-blue heading-btn ajaxviewmodel">Add Footer Category<b><i class="icon-menu7"></i></b></a>
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
                            <th style="width: 10%;">Active</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @endsection
