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

</script>
@endpush
@push('custom-css')
<link href="{{asset('public/assets/advertisement/css/home.css')}}" rel="stylesheet" type="text/css">
@endpush

     
@section('content')
    <!-- Content area -->
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
		
		@include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'product_view_ad_4'])
		
	</div>
@endsection
    