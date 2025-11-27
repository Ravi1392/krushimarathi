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
			
            'keywords' => "Agriculture marketplace, buy sell agriculture products, online farmer market, farm tools, seeds, farming news, agricultural machinery, farmer b2b platform India, organic farming, sell crops online, agri business platform, Agricultural Marathi News, marathi krushi news, krushi news, Farmer News, Agriculture News in Marathi, Krushimarathi, Krushi marathi, Other Information, Goverment Scheme, Yojana",

            'tags' => ['Market','News','Other Information','Goverment Scheme','Yojana','Sarkari Yojana','Agriculture marketplace','buy sell agriculture products','online farmer market','farm tools','seeds','farming news','agricultural machinery','farmer b2b platform India','organic farming','sell crops online','agri business platform']
        ])
            
@endpush

@push('custom-search_script')
    <script type="application/ld+json">
        {
            "@context":"https://schema.org",
            "@type":"Article",
            "headline":"{{$customer_profile->full_name}} | Krushi Marathi - Marketplace for Farmers, Buyers & Sellers",
            "datePublished":"{{ now()->toIso8601String() }}",
            "author":
            {
                "@type":"Person",
                "name":"Krushi Marathi",
                "url": "{{ Route('auther.info', ['username' => 'krushimarathi']) }}"
            },
            "publisher":
            {
                "@type":"Organization",
                "name":"Krushi Marathi",
                "logo":
                {
                    "@type":"ImageObject",
                    "url":"{{ asset('public/favicon.ico') }}"
                }
            },
            "mainEntityOfPage":
            {
                "@type":"Article",
                "@id":"{{url()->current()}}"
            },
            "isPartOf":
            {
                "@type":"WebSite",
                "name":"Krushi Marathi",
                "url":"{{url('/')}}"
            },
            "description": "Krushi Marathi is one of India’s largest online marketplaces for buying and selling agriculture products, farm tools, machinery, and more."
        }
    </script>
@endpush

@push('custom-scripts')

@endpush
@push('custom-css')
<link href="{{asset('public/assets/advertisement/css/home.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/assets/front/css/villageinfo/stylehome.css')}}" rel="stylesheet" type="text/css">

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
            <div class="col-lg-10">
                <div class="bg-w card_radius" style="color: black;">
                    <div class="dmprof-dtls-cntr ">
                        <div class="dm-prof-icon">
                            <img src="{{$customer_profile->file}}" alt="{{$customer_profile->full_name}}" title="{{$customer_profile->full_name}}">
                        </div>
                        <h2 class="dm-name">{{$customer_profile->full_name}}</h2>
                        <div class="dmprof-details">
                            <ul style="list-style-type: none;font-size: 17px;">
                                <li>Name:&nbsp; <span class="break-all"><b>{{$customer_profile->full_name ?? "NA"}}</b></span></li>

                                <li>
                                    Status:&nbsp;
                                    @if ($customer_profile->status == "Pending")
                                        <span class="badge bg-blue">Pending</span>
                                    @elseif ($customer_profile->status == "Verified")
                                        <span class="badge bg-success-400">Verified</span>
                                    @elseif ($customer_profile->status == "Rejected")
                                        <span class="badge bg-danger">Rejected</span>
                                    @elseif ($customer_profile->status == "Fraud")
                                        <span class="badge bg-grey-400">Fraud</span>
                                    @endif
                                </li>

                                <li>Business / Role Name:&nbsp; <b>{{ $customer_profile->business_name ?? "NA" }}</b></li>

                                <li>Role:&nbsp; <b>{{$customer_profile->business_type->name ?? "NA"}}</b></li>
                                
                                <li>Phone / Mobile Number:&nbsp; <b>NA</b></li>
                                
                                <li>Email:&nbsp; <b>NA</b></li>
                                
                                <li>Address:&nbsp; <b>{{$customer_profile->address ?? "NA"}}</b></li>
                                
                                <li class="dm-address-single">State:&nbsp; <b>{{$customer_profile->state->name ?? "NA"}}</b></li>
                                
                                <li class="dm-address-single">District:&nbsp; <b>{{$customer_profile->district->name ?? "NA"}}</b></li>
                                
                                <li class="dm-address-single">Sub Division (Block / Taluka):&nbsp; <b>{{$customer_profile->taluka->name ?? "NA"}}</b></li>

                                <li>Village:&nbsp; <span class="break-all"><b>{{$customer_profile->village->name ?? "NA"}}</b></span></li>

                                <li>Pin Code:&nbsp; <span class="break-all"><b>{{$customer_profile->pincode ?? "NA"}}</b></span></li>

                                <li>Register Date:&nbsp; <span class="break-all"><b>{{ date('j M Y', strtotime($customer_profile->created_at)) }}</b></span></li>

                                <li>Bio:&nbsp; <span class="break-all"><b>{{$customer_profile->profile_desc ?? "NA"}}</b></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                @include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'product_view_ad_3'])
                
            </div>
            <div class="col-lg-1">
                <!-- Right Side 160x600 Ad -->
                <div class="gutter-ad">
                   @include('frontend.Adsence.bajar_sticky_ad_2')
                </div>
            </div>
        </div>

		<hr>
        
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
		
		@include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'product_view_ad_4'])
		
	</div>
@endsection
    