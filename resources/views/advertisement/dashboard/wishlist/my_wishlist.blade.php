@extends('advertisement.layouts.common')

@push('custom-meta')
    @include('advertisement.components.home_meta',
        [
            'title' => "Krushi Marathi - Marketplace for Farmers, Buyers & Sellers",
            'description' => "Krushi Marathi is one of India’s largest online marketplaces for buying and selling agriculture products, farm tools, machinery, and more.",
            'canonical' => url()->current(),
            'type' => 'article',
            'data1' =>  config('constants.user_name'),
            'updated_time' =>  Date("Y-m-d H:i:s"),
			
            'keywords' => "Agriculture marketplace, buy sell agriculture products, online farmer market, farm tools, seeds, farming news, agricultural machinery, farmer b2b platform India, organic farming, sell crops online, agri business platform, Agricultural Marathi News, marathi krushi news, krushi news, Farmer News, Agriculture News in Marathi,Agricultural Hindi News, hindi krushi news, Agriculture News in Hindi, Krushimarathi, Krushi marathi, Other Information, Goverment Scheme, Yojana",

            'tags' => ['Market','News','Other Information','Goverment Scheme','Yojana','Sarkari Yojana','Agriculture marketplace','buy sell agriculture products','online farmer market','farm tools','seeds','farming news','agricultural machinery','farmer b2b platform India','organic farming','sell crops online','agri business platform']
        ])
            
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

                            setTimeout(function () {
                                location.reload();
                            }, 1000);
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

@endpush
   
@section('content')
    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="titBox">
                <h2>
                    {{ __('common.wishlist_title') }}
                </h2>
            </div>
        </div>
        @if ($my_wishlists->isNotEmpty() && isset($my_wishlists) && !empty($my_wishlists))
            <div class="row">
                @foreach ($my_wishlists as $my_wishlist)
                    
                    @if(isset($my_wishlist->products) && !empty($my_wishlist->products))
                        @include('advertisement.components.wishlist_product_card',['products' => $my_wishlist->products])
                    @else
                        <div class="col-12 text-center">
                            <p>{{ __('No ads found in this category.') }}</p>
                        </div>
                    @endif
                    
                @endforeach
            </div>
		@else
			<h1 class="text-center mb-4">{{ __('common.empty_wishlist_msg') }}</h1>
		@endif
    </div>
    <!-- /content area -->
@endsection
