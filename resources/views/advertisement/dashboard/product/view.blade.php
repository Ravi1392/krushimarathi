@extends('advertisement.layouts.common') 
@push('custom-scripts')

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
                                        $taluka = '';
                                        $village = '';
                                        $pincode = '';
                                    } elseif ($product->address_link == 2 && $product->customer) {
                                        $address = $product->customer->address ?? '';
                                        $state = $product->customer->state->name ?? '';
                                        $district = $product->customer->district->name ?? '';
                                        $taluka = $product->customer->taluka->name ?? '';
                                        $village = $product->customer->village->name ?? '';
                                        $pincode = $product->customer->pincode ?? '';
                                    } else {
                                        $address = $state = $district = $taluka = $village = $pincode = '';
                                    }

                                    $locationParts = array_filter([$address, $village, $taluka, $district, $state, $pincode]);
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
                
                @include('frontend.Adsence.product_view_ad_1')
                
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
                
                @include('frontend.Adsence.product_view_ad_2')
                
            </div>
            <div class="col-lg-3">
                <div class="sidebar-content">
                    <!-- Categories -->
                    @include('advertisement.components.sidebar_category_card', ['filtered_categories' => $filtered_categories])
                    <!-- /categories -->
                    
                    @include('frontend.Adsence.product_sidebar_view_ad_1')
                    
                </div>
            </div>
            <div class="col-lg-1">
                <!-- Right Side 160x600 Ad -->
                <div class="gutter-ad">
                   @include('frontend.Adsence.bajar_sticky_ad_2')
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
@endsection
    