@extends('advertisement.layouts.common')

@push('custom-meta')
    @include('advertisement.components.home_meta',
        [
            'title' => "Krushi Marathi - Marketplace for Farmers, Buyers & Sellers",
            'description' => "Krushi Marathi is one of India’s largest online marketplaces for buying and selling agriculture products, farm tools, machinery, and more.",
            'canonical' => url()->current(),
            'type' => 'article',
            'data1' =>  config('constants.user_name'),
            'updated_time' =>  now()->toIso8601String()
        ])
            
@endpush

@push('custom-search_script')

@endpush

@push('custom-scripts')
    <script src="{{asset('public/assets/advertisement/js/plugins/forms/validation/validate.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/switch.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('public/assets/advertisement/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('public/assets/advertisement/js/plugins/notifications/sweet_alert.min.js')}}"></script>

    <script src="{{asset('public/global_assets/js/demo_pages/form_validation.js')}}"></script>
<script>

	//Enquiry Code Validation
	$('#quotes-requirement-form').validate({
		rules: {
			name: {
				required: true,
			},
			phone: {
				required: true,
			},
			requirement: {
				required: true,
			},
		},
		messages: {
			name: "{{ __('comment.validation.name_required') }}",
			phone: "{{ __('comment.validation.phone_required') }}",
			requirement: "{{ __('home.validation.requirement_required') }}",
		},
		errorClass: 'error m-error',
		errorElement: 'small',
		errorPlacement: function (error, element) {
			error.css({
				'font-size': '13px',
				'color': '#f44336'
			});

			error.insertAfter(element); // Default
		}
	});

	$(document).ready(function () {
        $('.toggle-wishlist').on('click', function () {

			var swalInit = swal.mixin({
				buttonsStyling: false,
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-light'
			});

            const button = $(this);
            const productId = button.data('product-id');

            @if (!auth('customer')->check())
                // User not logged in
                swalInit({
                    title: '{{ __('common.login_required') }}',
                    text: '{{ __('common.wishlist_login_required') }}',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('common.login') }}',
                    cancelButtonText: '{{ __('common.cancel') }}'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "{{ route('ads.login') }}";
                    }
                });
                return; // stop here if not logged in
            @endif

            $.ajax({
                url: '{{ route("ads.wishlist") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function (response) {
					const icon = button.find('i');

                    if (response.status === 'added') {

						icon.removeClass('icon-heart6').addClass('icon-heart5');

						swalInit({
							type: 'success',
							title: 'Added to Wishlist',
							text: 'Product has been added to your wishlist.',
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 2000
						});
                        
                    } else if (response.status === 'removed') {

						icon.removeClass('icon-heart5').addClass('icon-heart6');

                        swalInit({
							type: 'info',
							title: 'Removed from Wishlist',
							text: 'Product has been removed from your wishlist.',
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 2000
						});
                    }
                },
                error: function () {
                    swalInit({
						type: 'error',
						title: 'Error!',
						text: 'Something went wrong. Please try again.',
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 2000
					});
                }
            });
        });
    });

	// Quotes Requirement Form Code
	$(document).ready(function () {

		// Submit quote requirement form
		$('#quotes-requirement-form').submit(function (e) {
			e.preventDefault();

			// Form validation
			if (!$('#quotes-requirement-form').valid()) {
				toastr.error("{{ __('home.validation_required') }}");
				return;
			}

			let name = $('#name').val();
			let phone = $('#phone').val();
			let requirement = $('#requirement').val();
			let token = $('input[name="_token"]').val();

			$.ajax({
				url: '{{ route("ads.product.send-requirement") }}',
				type: 'POST',
				data: {
					_token: token,
					name: name,
					phone: phone,
					requirement: requirement
				},
				success: function (response) {
					if (response.status === 'success') {
						toastr.success("{{ __('home.success_message') }}", "{{ __('common.success_title') }}");
					} else {
						toastr.error("{{ __('home.error_message') }}", "{{ __('common.error_title') }}");
					}

					$('#name').val('');
					$('#phone').val('');
					$('#requirement').val('');
				},
				error: function () {
					toastr.error("{{ __('home.error_message') }}", "{{ __('common.error_title') }}");
				}
			});
		});
	});
	
	//Subscription form
	$('#subscription-form').on('submit', function (e) {
		e.preventDefault();

		var email = $('#subscriber-email').val();
		var messageBox = $('#subscription-message');
		messageBox.text('').removeClass('error success');

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url: "{{ url('/saveSubscription') }}",
			method: 'POST',
			data: {
				email: email,
				_token: '{{ csrf_token() }}'
			},
			success: function (response) {

				if (response.success) {
					toastr.success(response.message, "{{ __('common.success_title') }}");
					$('#subscriber-email').val('');
				} else {
					toastr.error(response.message, "{{ __('common.error_title') }}");
				}
			},
			error: function (xhr) {
				let err = xhr.responseJSON?.message || "Something went wrong!";
				toastr.error(err, "{{ __('common.error_title') }}");
			}
		});
	});

</script>
@endpush
@push('custom-css')
<link href="{{asset('public/assets/advertisement/css/home.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/assets/advertisement/css/custome.css')}}" rel="stylesheet" type="text/css">
@endpush

     
@section('content')
    <!-- Content area -->
    <div class="content" style="padding: 0">
        @include('advertisement.components.common.home_banner')
		@include('advertisement.components.common.home_banner_count', [
			'registeredUsersCount' => $registeredUsersCount,
            'sellProductCount' => $sellProductCount,
            'buyProductCount' => $buyProductCount,
            'mobileUsersCount' => $mobileUsersCount,
		])
    </div>
    <!-- /content area -->
	<div class="content">
		
		@if ($ads_categories->isNotEmpty() && isset($ads_categories) && !empty($ads_categories))
			@foreach ($ads_categories as $ads_category)
				<div class="row">
					<div class="titBox">
						<h2>
							{{$ads_category->name}}
						</h2>
						<a class="cmnBtn viewBtn" href="{{ route('ads.product.product_category', ['product_category' => $ads_category->slug]) }}">
							{{ __('common.view_all') }}
						</a>
					</div>
				</div>
				<div class="row">
					@if(isset($ads_category->products) && !empty($ads_category->products))
						@include('advertisement.components.product_card',['products' => $ads_category->products])
					@else
						<div class="col-12 text-center">
							<p>{{ __('No ads found in this category.') }}</p>
						</div>
					@endif
				</div>
			@endforeach
			
		@else
			<h1 class="text-center mb-4">{{ __('home.no_categories') }}</h1>
		@endif
		
		@include('advertisement.components.common.imp_links')
        @include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'bajarbhav_ad_1'])
        <br/>
		@include('advertisement.components.common.subscription_box')
		@include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'product_view_ad_3'])
		<br/>
		
		@if ($blogs->isNotEmpty() && isset($blogs) && !empty($blogs))
			<div class="row">
				<div class="titBox">
					<h2>{{ __('common.related_blogs') }}</h2>
				</div>
			</div>
			<div class="row">
				@include('advertisement.components.blog_card',['blogs' => $blogs])
			</div>
		@endif
		
		<div class="row">
			<div class="col-md-6">
				<div class="card border-success">
					<div class="card-header bg-success text-white header-elements-inline">
						<h3 class="card-title">{{ __('home.connecting_line') }}</h3>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-xl-12">
								<div class="media flex-column flex-sm-row mt-0 mb-4">
									<div class="mr-sm-3 mb-1 mb-sm-0">
										<div class="card-img-actions">
											<i class="icon-pencil7 icon-2x text-success-300 border-success-300 border-3 rounded-round p-2"></i>
										</div>
									</div>

									<div class="media-body">
										<h4 class="media-title">{{ __('home.tell_us_title') }}</h4>
										{{ __('home.tell_us_need') }}
									</div>
								</div>

								<div class="media flex-column flex-sm-row mt-0 mb-4">
									<div class="mr-sm-3 mb-1 mb-sm-0">
										<div class="card-img-actions">
											<i class="icon-file-text icon-2x text-success-300 border-success-300 border-3 rounded-round p-2"></i>
										</div>
									</div>

									<div class="media-body">
										<h4 class="media-title">{{ __('home.receive_quotes_title') }}</h4>
										{{ __('home.receive_quotes') }}
									</div>
								</div>
							
								<div class="media flex-column flex-sm-row mt-0 mb-0">
									<div class="mr-sm-3 mb-1 mb-sm-0">
										<div class="card-img-actions">
											<i class="icon-checkmark4 icon-2x text-success-300 border-success-300 border-3 rounded-round p-2"></i>
										</div>
									</div>

									<div class="media-body">
										<h4 class="media-title">{{ __('home.seal_deal_title') }}</h4>
										{{ __('home.seal_deal') }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card border-dark">
					<div class="card-header bg-dark text-white header-elements-inline">
						<h3 class="card-title">{{ __('home.enquiry_form') }}</h3>
					</div>

					<div class="card-body">
						@include('advertisement.components.common.quotes_card')
					</div>
				</div>
			</div>
		</div>
        @include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'product_view_ad_4'])
	</div>
@endsection
    