@extends('advertisement.layouts.common')

@push('custom-meta')
    <title>{{ $cropName }} बाजार समिती – आजचे ताजे शेतमाल बाजारभाव (Live Rates) | Krushi Marathi</title>
    <meta name="description" content="{{ $cropName }} बाजार समितीचे आजचे ताजे शेतमाल निहाय बाजारभाव येथे पहा – दररोज अद्ययावत Live Rates केवळ Krushi Marathi वर."/>
    <link rel="canonical" href="{{url()->current()}}" />
    <meta name="keywords" content="Todays Bajarbhav, Live Bajarbhav, Market Yard Rates, ajache taje bajarbhav, Aajcha Maha Bazar Bhav, bajar bhav, Krushi Marathi, {{ $cropName }} Market Rates, आजचे ताजे बाजारभाव, आजचे बाजार भाव">
    
    <meta name="url" content="{{url()->current()}}"/>
    <meta name="date" content='{{Date("Y-m-d H:i:s")}}'/>
    <meta property="og:title" content="{{ $cropName }} बाजार समिती – आजचे ताजे शेतमाल बाजारभाव (Live Rates) | Krushi Marathi"/>
    <meta property="og:description" content="{{ $cropName }} बाजार समितीचे आजचे ताजे शेतमाल निहाय बाजारभाव येथे पहा – दररोज अद्ययावत Live Rates केवळ Krushi Marathi वर."/>
    <meta property="og:url" content="{{url()->current()}}"/>
    
    @if(@getimagesize($crop_image) && !empty($crop_image))
    <meta property="og:image" content="{{$crop_image}}"/>
    <meta property="og:image:secure_url" content="{{$crop_image}}"/>
    @endif
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="720" />
    <meta property="og:image:alt" content="{{ $pageTitle }}"/>
    <meta property="og:updated_time" content='{{now()->toIso8601String()}}'/>
    <meta property="article:published_time" content='{{now()->toIso8601String()}}'/>
    <meta property="article:modified_time" content='{{now()->toIso8601String()}}'/>
    <meta property="og:site_name" content="Krushi Marathi"/>
    <meta property="og:image:type" content="image/webp"/>
    <meta property="og:type" content="article"/>
    <meta property="og:locale" content="mr_IN" />
    <meta property="og:locale:alternate" content="en_US" />
    
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $cropName }} बाजार समिती – आजचे ताजे शेतमाल बाजारभाव (Live Rates) | Krushi Marathi" />
    <meta name="twitter:description" content="{{ $cropName }} बाजार समितीचे आजचे ताजे शेतमाल निहाय बाजारभाव येथे पहा – दररोज अद्ययावत Live Rates केवळ Krushi Marathi वर."/>
    <meta name="twitter:site" content="{{ config('constants.twitter_creator') }}">
    <meta name="twitter:creator" content="{{ config('constants.twitter_creator') }}">
    <meta name="twitter:image" content="{{ $crop_image }}" />
    <meta name="twitter:label1" content="Written by" />
    <meta name="twitter:data1" content="{{ config('constants.user_name') }}" />
    <meta name="twitter:label2" content="Time to read">
    <meta name="twitter:data2" content="3 minutes">

@endpush

@push('custom-search_script')

@endpush

@push('ads-script')

    <!--sidebar_ad_code-->
    <script>
        window.googletag = window.googletag || { cmd: [] };
        googletag.cmd.push(function () {
    
        const REFRESH_KEY = 'refresh';
        const REFRESH_VALUE = 'true';
        const SECONDS_TO_WAIT_AFTER_VIEWABILITY = 30;
    
        // --- Sidebar Ad ---
        googletag.defineSlot('/23289270189/bajarbhav_ad_top', [[728, 90], [250, 250], [168, 42], [320, 50], [468, 60], [292, 30], [216, 54], [300, 75], [300, 100], [200, 200], [180, 150], [300, 50], [234, 60], [120, 30], [216, 36], [125, 125], [300, 250], [120, 20], [220, 90], [300, 31], [120, 60]], 'div-gpt-ad-1758342315505-0')
          .setTargeting(REFRESH_KEY, REFRESH_VALUE)
          .addService(googletag.pubads());
    
        // Enable Single Request and Collapse Empty Divs
        googletag.pubads().enableSingleRequest();
        googletag.pubads().collapseEmptyDivs();
    
        // Auto-refresh after viewable
        googletag.pubads().addEventListener('impressionViewable', function (event) {
          const slot = event.slot;
          if (slot.getTargeting(REFRESH_KEY).indexOf(REFRESH_VALUE) > -1) {
            setTimeout(function () {
              googletag.pubads().refresh([slot]);
            }, SECONDS_TO_WAIT_AFTER_VIEWABILITY * 1000);
          }
        });
    
        googletag.enableServices();
      });
    </script>
    
@endpush


@push('custom-scripts')

@endpush

@push('custom-css')
    <link href="{{asset('public/assets/advertisement/css/home.css')}}" rel="stylesheet" type="text/css">
    <style>
        .row .col-lg-1{
            padding-right: unset;
        }
        
        .row .col-lg-1 a.btn{
            padding: .6375rem .150rem;
        }
        
        .date-row {
            font-weight: bold;
            background-color: #EBF6F0;
            text-align: center;
            color: #495057;
        }
        
        .gutter-ad {
            position: fixed;
            top: 90px;
            width: 120px;
            height: 600px;
            z-index: 1000;
        }
        
        .slot-view-ad .adsbygoogle {
            width: 320px !important;
            height: 250px !important;
        }
    
        @media (max-width: 768px) {
            .gutter-ad {
                display: none;
            }
            .ads-ad {
                display: none;
            }
            .desktop-only {
                display: none !important;
            }
        }
    </style>
@endpush
     
@section('content')
    <!-- Content area -->
	<div class="content">
	    
	    <div class="row">
            <div class="col-sm-1">
                <!-- Left Side 160x600 Ad -->
                <div class="gutter-ad">
                   @include('frontend.Adsence.bajar_sticky_ad_1')
                </div>
            </div>
            <div class="col-sm-10">
                @includeIf('frontend.Ads.bajarbhav_ad_top')
        	    <br/>
                @if(@getimagesize($crop_image) && !empty($crop_image))
                    <div class="row mb-1">
                        <div class="col-lg-2">
                            <div class="ads-ad">
                                @include('frontend.Adsence.bajarbhav_left_ad')
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3 text-center bajarbhav" style="position: relative; display: inline-block;">
                                <a href="#" class="d-inline-block">
                                    <img src="{{$crop_image}}" class="img-fluid" alt="{{ $pageTitle }}">
                                </a>
                                <div class="image-ad-overlay desktop-only" style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);width: 730px; height: 90px; text-align: center;">
                                    <div id="mys-content" style="width: 100%; height: 100%;">
                                        <span style="color: white;">
                                            @includeIf('frontend.Adsence.image_over_ad')
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="ads-ad">
                                @include('frontend.Adsence.bajarbhav_right_ad')
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title text-center"><b>{{ $pageTitle }}</b></h1>
                    </div>
                    <div class="card-body">
                        @if (!empty($bajarbhavData))
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" style="font-size: 16px;">
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th><b>शेतमाल</b></th>
                                            <th><b>जात/प्रत</b></th>
                                            <th><b>परिमाण</b></th>
                                            <th><b>आवक</b></th>
                                            <th><b>कमीत कमी दर (रु.)</b></th>
                                            <th><b>जास्तीत जास्त दर (रु.)</b></th>
                                            <th><b>सरासरी दर (रु.)</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $currentDate = null;
                                            $index = 1;
                                        @endphp
                                        @foreach ($bajarbhavData as $item)
                                            @if (isset($item['date']) && $item['date'] !== $currentDate)
                                                <tr>
                                                    <td colspan="7" class="date-row">
                                                        {{ \Carbon\Carbon::parse($item['date'])->locale('mr')->isoFormat('Do MMMM YYYY') }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $currentDate = $item['date'];
                                                    $index++;
                                                @endphp
                                            @endif
                                            <tr>
                                                <td>{{ $item['apmc_name'] ?? 'N/A' }}</td>
                                                <td>{{ $item['variety'] ?? 'N/A' }}</td>
                                                <td>{{ $item['unit'] ?? 'N/A' }}</td>
                                                <td class="text-right">{{ $item['min_price'] ?? 'N/A' }}</td>
                                                <td class="text-right">{{ $item['max_price'] ?? 'N/A' }}</td>
                                                <td class="text-right">{{ $item['modal_price'] ?? 'N/A' }}</td>
                                                <td class="text-right">{{ $item['avg_price'] ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center" role="alert">
                                {{ $dataNotFound }}
                            </div>
                        @endif
                    </div>
                </div>
                
                @include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'bajarbhav_ad_1'])
                <br/>
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h2 class="card-title"><b>{{ __('common.bajarbhav_disclaimer_title') }}</b></h2>
                    </div>
        
                    <div class="card-body">
                        <p style="font-size: 17px;">{{ __('common.bajarbhav_disclaimer') }}</p>
                    </div>
                </div>
                
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
                
                @include('advertisement.components.bajarbhav.bajar_samiti_name')
                @include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'bajarbhav_ad_2'])
                <br/>
                @include('advertisement.components.bajarbhav.city_name')
                @include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'bajarbhav_ad_3'])
                <br/>
                @include('advertisement.components.bajarbhav.pik_name')
                @include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'bajarbhav_ad_4'])
            </div>
            <div class="col-sm-1">
                <!-- Right Side 160x600 Ad -->
                <div class="gutter-ad">
                    @include('frontend.Adsence.bajar_sticky_ad_2')
                </div>
            </div>
        </div>
    </div>
@endsection
    