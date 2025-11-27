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
                    "url": "{{route('ads.quotesData')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id", "searchable": false, "sortable": false},
                    {"data": "name"},
                    {"data": "phone"},
                    {"data": "requirement"},
                    {"data": "created_at"}
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
						<h3 class="card-title">{{ __('dashboard.customer_requirements') }}</h3>
					</div>

					<table class="table datatable-basic">
						<thead>
							<tr>
                                <th>#</th>
								<th>Customer Name</th>
								<th>Phone</th>
								<th>Requirement</th>
								<th class="text-center">Date</th>
							</tr>
						</thead>
						
					</table>
				</div>
            </div>
        </div>

    </div>
    <!-- /content area -->
@endsection
    