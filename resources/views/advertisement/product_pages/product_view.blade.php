@extends('advertisement.layouts.common')

@push('custom-meta')
    @include('advertisement.components.home_meta',
        [
            'title' => "Krushi Marathi - Marketplace for Farmers, Buyers & Sellers",
            'description' => "Krushi Marathi is one of India’s largest online marketplaces for buying and selling agriculture products, farm tools, machinery, and more.",
            'canonical' => url()->current(),
            'type' => 'article',
            'data1' =>  config('constants.user_name'),
            'updated_time' => now()->toIso8601String()
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
        //Enquiry Code Validation
        $('#enquiry-form').validate({
            rules: {
                enquiry_message: {
                    required: true,
                },
                phone: {
                    required: true,
                },
            },
            messages: {
                enquiry_message: "{{ __('product.validation.ad_title_required') }}",
                phone: "{{ __('register.validation.phone_required') }}",
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

        //Login User Comment Validation
        $('#with-login-comment-form').validate({
            rules: {
                comment: {
                    required: true,
                },
            },
            messages: {
                comment: "{{ __('comment.validation.comment_required') }}",
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

        //Without Login User Comment Validation
        $('#without-login-comment-form').validate({
            rules: {
                name: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                email: {
                    required: true,
                },
                comment: {
                    required: true,
                },
            },
            messages: {
                name: "{{ __('comment.validation.name_required') }}",
                email: "{{ __('comment.validation.email_required') }}",
                phone: "{{ __('comment.validation.phone_required') }}",
                comment: "{{ __('comment.validation.comment_required') }}",
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
    });

    //Enquery Form Code
    $(document).ready(function () {
        // Show enquiry card
        $('#show-enquiry').click(function () {
            $('#enquiry-card').slideDown();
        });

        // Submit enquiry
        $('#enquiry-form').submit(function (e) {
            e.preventDefault();

            if (!$('#enquiry-form').valid()) {
                return;
            }

            let productId = "{{$product->id}}";
            let phone = $('#phone').val();
            let enquiry_message = $('#enquiry-message').val();
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route("ads.product.send-enquiry") }}',
                type: 'POST',
                data: {
                    _token: token,
                    phone: phone,
                    enquiry_message: enquiry_message,
                    product_id: productId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success('Your enquiry has been sent!', 'Activated');
                    } else if (response.status === 'removed') {
                        toastr.error('Something went wrong. Please login or try again.', 'Deactivated');
                    }
                    $('#enquiry-message').val('');
                    $('#enquiry-card').slideUp();
                },
                error: function (xhr) {
                    toastr.error('Something went wrong. Please login or try again.', 'Deactivated');
                }
            });
        });
    });

    //Login User Comment Code
    $(document).ready(function () {
        
        // Submit Coment
        $('#with-login-comment-form').submit(function (e) {
            e.preventDefault();

            if (!$('#with-login-comment-form').valid()) {
                return;
            }

            let productId = "{{$product->id}}";
            let comment = $('#comment').val();
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route("ads.product.send-comment") }}',
                type: 'POST',
                data: {
                    _token: token,
                    comment: comment,
                    product_id: productId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success("{{ __('comment.success_message') }}", 'Activated');
                    } else if (response.status === 'error') {
                        toastr.error("{{ __('comment.error_login_required') }}", 'Deactivated');
                    }
                    $('#comment').val('');
                },
                error: function (xhr) {
                    toastr.error("{{ __('comment.error_login_required') }}", 'Deactivated');
                }
            });
        });
    });

    //Without Login User Comment Code
    $(document).ready(function () {
        
        // Submit Coment
        $('#without-login-comment-form').submit(function (e) {
            e.preventDefault();

            if (!$('#without-login-comment-form').valid()) {
                return;
            }

            let productId = "{{$product->id}}";
            let name = $('#name').val();
            let phone = $('#phone').val();
            let email = $('#email').val();
            let comment = $('#comment').val();
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route("ads.product.send-comment") }}',
                type: 'POST',
                data: {
                    _token: token,
                    name: name,
                    phone: phone,
                    email: email,
                    comment: comment,
                    product_id: productId,
                },
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success("{{ __('comment.success_message') }}", 'Activated');
                    } else if (response.status === 'error') {
                        toastr.error("{{ __('comment.error_login_required') }}", 'Deactivated');
                    }
                    $('#name').val('');
                    $('#phone').val('');
                    $('#email').val('');
                    $('#comment').val('');
                },
                error: function (xhr) {
                    toastr.error("{{ __('comment.error_login_required') }}", 'Deactivated');
                }
            });
        });
    });

    $(document).ready(function () {

        var swalInit = swal.mixin({
				buttonsStyling: false,
				confirmButtonClass: 'btn btn-success',
				cancelButtonClass: 'btn btn-light'
			});

        $('.get_number').on('click', function () {

            const customerId = $(this).data('customer-id');

            @if (!auth('customer')->check())
                // User not logged in
                swalInit({
                    title: '{{ __('common.login_required') }}',
                    text: '{{ __('common.call_login_required') }}',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('common.login_now') }}',
                    cancelButtonText: '{{ __('common.cancel') }}'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "{{ route('ads.login') }}";
                    }
                });
                return; // stop here if not logged in
            @endif

            $.ajax({
                url: '{{ route("ads:get-customer-phone") }}',
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    customer_id: customerId
                },
                success: function (response) {
                    if (response.status === 'success') {

                        const phone = response.phone;
                        const whatsappLink = `https://wa.me/${phone}`;

                        swalInit({
                            title: "{{ __('common.call_title') }}",
                            html: `
                            <div style="font-size: 22px; font-weight: bold; margin-bottom: 5px;margin-bottom: 5px;">
                                <span id="phone-number">${phone}</span>
                            </div>
                            <div class="text-muted" style="font-size: 14px;">
                                {{ __('common.call_note') }} 🤝
                            </div>`,
                            type: "success",
                            showCancelButton: true,
                            showConfirmButton: true,
                            confirmButtonText: '<i class="fab fa-whatsapp"></i> WhatsApp',
                            cancelButtonText: 'Cancel',
                            reverseButtons: true,
                            type: 'success',
                            buttonsStyling: false,
                        }).then((result) => {
                            if (result.value === true) {
                                window.open(whatsappLink, '_blank');
                            }
                        });
                    } else {
                        swalInit('Oops!', response.message, 'error');
                    }
                },
                error: function () {
                    swalInit('Error', 'Unable to fetch contact number.', 'error');
                }
            });
        });
    });

</script>

@endpush
@push('custom-css')
<link href="{{asset('public/assets/advertisement/css/home.css')}}" rel="stylesheet" type="text/css">

<style>

    .row .col-lg-1{
        padding-right: unset;
    }

    .gutter-ad {
        position: fixed;
        top: 60px;
        width: 120px;
        height: 600px;
        z-index: 1000;
    }

    @media (max-width: 768px) {
        .gutter-ad {
            display: none;
        }
    }
</style>

@endpush

     
@section('content')
    <!-- Content area -->
	<div class="content">
		<div class="row">
            <div class="col-lg-1">
                <!-- Left Side 160x600 Ad -->
                <div class="gutter-ad">
                   @include('frontend.Adsence.bajar_sticky_ad_1')
                </div>
            </div>
            <div class="col-lg-7">
                <!-- Blog layout #2 with video -->
                <div class="card blog-horizontal">
                    <div class="card-body">

                        <div class="card-img-actions mr-3" style="position: relative;">
                            <div class="card-img embed-responsive">
                                <img class="img-fluid"
                                    src="{{ $product->photo ?? 'https://via.placeholder.com/300x200' }}"
                                    alt="{{ $product->title }}">

                                {{-- Sale/Buy badge on image --}}
                                <span class="badge badge-pill {{ $product->lead_type == 0 ? 'bg-success' : 'bg-primary' }}"
                                    style="position: absolute; top: 10px; left: 10px; z-index: 5; font-size: 13px;padding: 6px 12px 6px 12px;">
                                    {{ $product->lead_type == 0 ? __('common.sell') : __('common.buy') }}
                                </span>

                                {{-- Existing header elements --}}
                                {{-- <div class="header-elements" style="position: absolute; bottom: 10px; right: 10px;">
                                    <span class="badge bg-success badge-pill">{{ $product->active_ads_count ?? '0' }} active</span>
                                </div> --}}
                            </div>
                        </div>

                        <h2 class="font-weight-semibold mb-2">
                            {{ $product->title }}
                        </h2>
                        
                        @if($product->price <= 0)
                            <h3 class="mb-2 font-weight-semibold text-danger">
                                {{ __('common.price_zero') }}
                            </h3>
                        @else
                            <h3 class="mb-2 font-weight-semibold">
                                ₹ {{ number_format($product->price, 2) }} /{{ __('common.per') }} {{ $product->unit->name }}
                            </h3>
                        @endif

                        <ul class="list list-unstyled">
                            <li>
                                <i class="icon-checkmark3 text-success mr-2"></i>
                                <b>Category &nbsp;:- </b>&nbsp; <a href="{{ route('ads.product.product_category', ['product_category' => $product->category->slug]) }}">{{$product->category->name}}</a>
                            </li>
                            <li>
                                <i class="icon-checkmark3 text-success mr-2"></i>
                                <b>Sub Category &nbsp;:- </b>&nbsp; <a href="{{ route('ads.product.product_sub_category', ['product_category' => $product->category->slug, 'product_sub_category' => $product->subcategory->slug]) }}">{{$product->subcategory->name}}</a>
                            </li>
                            <li>
                                <i class="icon-checkmark3 text-success mr-2"></i>
                                <b>Variety / Type &nbsp;:- </b>&nbsp; {{$product->variety}}
                            </li>
                            <li>
                                <i class="icon-checkmark3 text-success mr-2"></i>
                                <b>Quantity &nbsp;:- </b>&nbsp; {{$product->quantity}}
                            </li>
                            <li>
                                <i class="icon-location4 text-success mr-2"></i>
                                <b>Address &nbsp;:- </b>&nbsp;
                                @php
                                    if ($product->address_link == 1) {
                                        $address = $product->address ?? '';
                                        $state = $product->state->name ?? '';
                                        $district = $product->district->name ?? '';
                                        $pincode = '';
                                    } elseif ($product->address_link == 2 && $product->customer) {
                                        $address = $product->customer->address ?? '';
                                        $state = $product->customer->state->name ?? '';
                                        $district = $product->customer->district->name ?? '';
                                        $pincode = $product->customer->pincode ?? '';
                                    } else {
                                        $address = $state = $district = $pincode = '';
                                    }

                                    $locationParts = array_filter([$address, $district, $state, $pincode]);
                                    $location = implode(', ', $locationParts);
                                @endphp
                                {{ !empty($location) ? $location : __('Location not available') }}
                            </li>
                            {{-- <li>
                                <i class="icon-alarm text-success mr-2"></i>
                                <b>Posted &nbsp;:- </b>&nbsp; {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}
                            </li> --}}
                            
                        </ul>
                    </div>

                    <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
                        <ul class="list-inline list-inline-dotted mb-3 mb-sm-0">
                            <li class="list-inline-item"><i class="icon-user"></i>&nbsp;&nbsp; By <a href="{{ url('ads/profile', ['customer_id' => base64_encode($product->customer->id)]) }}">{{ $product->customer->full_name ?? 'Krushi Marathi' }}</a></li>
                            <li class="list-inline-item"><i class="icon-calendar3"></i>&nbsp;&nbsp; {{date('F jS, Y', strtotime($product->created_at))}}</li>
                            <li class="list-inline-item"><i class="icon-comment"></i>&nbsp;&nbsp; {{count($product->comments)}} comments</li>
                            <li class="list-inline-item"><i class="icon-eye"></i>&nbsp;&nbsp; {{ $product->views ?? 0 }}</li>
                        </ul>
                        <a href="#" class="text-default"><i class="icon-heart6 text-pink mr-2"></i> {{$product->wishlists_count}}</a>
                    </div>
                </div>
                
                @include('frontend.Adsence.product_view_ad_1')

                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h4 class="card-title">Product Description</h4>
                    </div>

                    <div class="media card-body flex-column flex-md-row m-0">
                        <div class="media-body">
                            @if (isset($product->product_description) && !empty($product->product_description))
                                {!! $product->product_description !!}
                            @endif
                        </div>
                    </div>
                </div>
                
                @include('frontend.Adsence.product_view_ad_2')
                
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Comments</h6>
                    </div>

                    <div class="card-body">
                        @if ($product->comments->isEmpty())
                            <p class="text-muted mb-0">{{ __('comment.no_comments') }}</p>
                        @else
                            @include('advertisement.components.comment_card', ['comments' => $product->comments])
                        @endif
                    </div>

                    <hr class="m-0">

                    <div class="card-body">
                        @if (Auth::guard('customer')->check())
                            @include('advertisement.components.login_customer_comment_card')
                        @else
                            @include('advertisement.components.without_login_customer_comment_card')
                        @endif
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar-content">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="card-img-actions d-inline-block mb-3">
                                <img class="img-fluid rounded-circle" src="{{$product->customer->file}}" width="170" height="170" alt="">
                                <div class="card-img-actions-overlay card-img rounded-circle">
                                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                        <i class="icon-plus3"></i>
                                    </a>
                                    <a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                        <i class="icon-link"></i>
                                    </a>
                                </div>
                            </div>

                            <h6 class="font-weight-semibold mb-0">{{ $product->customer->full_name ?? 'Krushi Marathi' }}</h6>
                            <span class="d-block text-muted">{{ $product->customer->business_type->name ?? 'Other' }}</span>

                            <div class="list-icons list-icons-extended mt-3">
                                <a href="javascript:void(0);" class="btn bg-success get_number" data-customer-id="{{ $product->customer->id }}"><i class="icon-phone-outgoing mr-1"></i> Call</a>
                                <button type="button" class="btn bg-success" id="show-enquiry"><i class="icon-paperplane mr-1"></i> Enquery</button>
                                <a href="{{ url('ads/profile', ['customer_id' => base64_encode($product->customer->id)]) }}" class="btn bg-success">
                                    <i class="icon-user mr-1"></i> Profile</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card" id="enquiry-card" style="display: none;">
                        <div class="card-header bg-transparent header-elements-inline">
                            <span class="card-title font-weight-semibold">Send your enquiry</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="enquiry-form">
                                {{csrf_field()}}
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('register.phone') }}">
                                </div>

                                <textarea name="enquiry_message" id="enquiry-message" class="form-control" rows="3" cols="1" placeholder="Enter your message..."></textarea>

                                <div class="d-flex align-items-center mt-3">
                                    <button type="submit" class="btn bg-blue btn-labeled btn-labeled-right ml-auto" id="send-enquiry"><b><i class="icon-paperplane"></i></b> Send Now</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Categories -->
                    @include('advertisement.components.sidebar_category_card', ['filtered_categories' => $filtered_categories])
                    <!-- /categories -->
                    
                    @include('frontend.Adsence.product_sidebar_view_ad_1')
                    
                    @include('frontend.Adsence.product_sidebar_view_ad_2')
                    
                </div>
            </div>
            <div class="col-lg-1">
                <!-- Right Side 160x600 Ad -->
                <div class="gutter-ad">
                   @include('frontend.Adsence.bajar_sticky_ad_2')
                </div>
            </div>
        </div>
        
        <hr>
        <div class="row">
			<div class="titBox">
				<h2>
					Product for BUY &amp; SELL
				</h2>
			</div>
		</div>
		<div class="row">
			<!-- Right sidebar component -->
			@if($related_product_data->isNotEmpty() && isset($related_product_data) && !empty($related_product_data))
                @include('advertisement.components.related_product_card',['products' => $related_product_data])
            @else
                <div class="col-12 text-center">
                    <h3 class="text-center mb-4">{{ __('home.no_ads_in_product') }}</h3>
                </div>
            @endif
			<!-- /right sidebar component -->
		</div>
		
		@include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'product_view_ad_3'])
		<br/>
		<hr>
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
    