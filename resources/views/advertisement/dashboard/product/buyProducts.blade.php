@extends('advertisement.layouts.common') 
@push('custom-scripts')
    <script src="{{asset('public/assets/advertisement/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/switch.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('public/assets/advertisement/js/plugins/notifications/sweet_alert.min.js')}}"></script>

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
            $('.datatable-basic').DataTable({
                "processing": true,
                "serverSide": true,
                "select": true,
                "ajax": {
                    "url": "{{route('ads.getBuyProductData')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "action", "searchable": false, "sortable": false},
                    {"data": "id"},
                    {"data": "category_name"},
                    {"data": "sub_category_name"},
                    {"data": "title"},
                    {"data": "price"},
                    {"data": "status"},
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

                    var swalInit = swal.mixin({
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-primary',
                        cancelButtonClass: 'btn btn-light'
                    });

                    var url = $(this).attr("data-value");

                    swalInit({
                        title: "Are you sure?",
                        text: "You will not be able to recover this product!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel pls!",
                    }).then((result) => {

                        if (result.value) {
                            $.ajax({
                                url: url,
                                type: "GET",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                }
                            }).done(function (data) {
                                swalInit({
                                    title: "Deleted!",
                                    text: "Product has been successfully deleted..",
                                    type: "success",
                                });

                                $('.datatable-basic').DataTable().ajax.reload(null, false);

                            }).fail(function (jqXHR, textStatus, errorThrown) {
                                // Handle AJAX errors
                                console.error("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);
                                swalInit({
                                    title: "Error!",
                                    text: "Something went wrong during deletion: " + (jqXHR.responseJSON && jqXHR.responseJSON.message ? jqXHR.responseJSON.message : errorThrown),
                                    type: "error",
                                });
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel) {
                            swalInit({
                                title: "Cancelled",
                                text: "Your product data is safe :)",
                                type: "error",
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
                    var url = "{{URL::to('ads/productactivedeactive')}}";
                    url = url + "/" + id + "/" + status;
                    $.ajax({
                        url: url
                    }).done(function (data) {
                        console.log(data);
                        if (data == 1)
                        {
                            if (status == 1)
                            {
                                toastr.success('Product has been Activated', 'Activated');
                            } else
                            {
                                toastr.error('Product has been Deactivated', 'Deactivated');
                            }
                        } else
                        {
                            toastr.error('Something went wrong..', 'Error');
                        }

                    });
                });
                
            }

        });
    </script>

@endpush
@push('custom-css')

@endpush
     
@section('content')
    <!-- Content area -->
    <div class="content">
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
					<div class="card-header header-elements-inline">
						<h3 class="card-title">{{ __('common.buy') }}</h3>
						<div class="header-elements">
							<a href="{{route('ads.post-requirement')}}" class="btn btn-labeled btn-labeled-right bg-success heading-btn">{{ __('common.sell') }} / {{ __('common.buy') }}<b><i class="icon-menu7"></i></b></a>
	                	</div>
					</div>

					<table class="table datatable-basic">
						<thead>
							<tr>
                                <th>Action</th>
                                <th>#</th>
								<th>Category Name</th>
								<th>Sub Category Name</th>
								<th>Title</th>
                                <th>Price</th>
								<th>Status</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						
					</table>
				</div>
            </div>
        </div>

    </div>
    <!-- /content area -->
@endsection
    