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

    <script src="{{asset('public/assets/advertisement/js/plugins/notifications/sweet_alert.min.js')}}"></script>
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

        $(document).ready(function () {
            $('#productFilterForm').on('submit', function (e) {
                e.preventDefault();

                const priceValues = $('input[name="price[]"]:checked').map(function () {
                    return this.value;
                }).get();

                const dateValues = $('input[name="date_range[]"]:checked').map(function () {
                    return this.value;
                }).get();

                const params = new URLSearchParams(window.location.search);

                if (priceValues.length > 0) {
                    params.set('price', priceValues.join(','));
                } else {
                    params.delete('price');
                }

                if (dateValues.length > 0) {
                    params.set('date_range', dateValues.join(','));
                } else {
                    params.delete('date_range');
                }

                // Redirect with updated query params
                window.location.href = window.location.pathname + '?' + params.toString();
            });
        });

        $('.toggle-submenu').click(function (e) {
            e.preventDefault();
            const s = $(this).closest('li').find('.nav-group-sub').first();
            $('.nav-group-sub').not(s).slideUp().addClass('d-none');
            s.slideToggle().toggleClass('d-none');
        });
    </script>

@endpush
@push('custom-css')
<link href="{{asset('public/assets/advertisement/css/home.css')}}" rel="stylesheet" type="text/css">
@endpush

     
@section('content')
    <!-- Content area -->
	<div class="content">
		<div class="d-flex align-items-start flex-column flex-md-row">
            <!-- Right sidebar component -->
            <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left border-0 shadow-0 order-2 order-md-1 sidebar-expand-md">
                <!-- Sidebar content -->
                <div class="sidebar-content">
                    
                    @include('advertisement.components.product_filter')
                    @include('advertisement.components.category_filter',['filtered_categories' => $filtered_categories])
                    @include('frontend.Adsence.product_sidebar_view_ad_2')
                </div>
                <!-- /sidebar content -->
            </div>
            <!-- /right sidebar component -->
            <!-- Left content -->
            <div class="w-100 order-1 order-md-2">
                @if ($subcategories->isNotEmpty() && isset($subcategories) && !empty($subcategories))
                    @foreach ($subcategories as $subcategory)
                        <div class="row">
                            <div class="titBox">
                                <h2>
                                    {{$subcategory->name}}
                                </h2>
                                <a class="cmnBtn viewBtn" href="{{ route('ads.product.product_sub_category', ['product_category' => $category->slug, 'product_sub_category' => $subcategory->slug]) }}">
                                    {{ __('common.view_all') }}
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            @if(isset($subcategory->products) && !empty($subcategory->products))
                                @include('advertisement.components.category_product_card',['products' => $subcategory->products])
                            @else
                                <div class="col-12 text-center">
                                    <h1 class="text-center mb-4">{{ __('home.no_ads_in_category') }}</h1>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <h1 class="text-center mb-4">{{ __('home.no_categories') }}</h1>
                @endif

                <!-- Pagination -->
                {{-- <div class="d-flex justify-content-center pt-3 mb-3">
                    <ul class="pagination">
                        <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-small-right"></i></a></li>
                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-small-left"></i></a></li>
                    </ul>
                </div> --}}
                <!-- /pagination -->
                
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
            <!-- /left content -->
        </div>
	</div>
@endsection
    