@extends('advertisement.layouts.common')

@push('custom-meta')
    @include('advertisement.components.home_meta',
        [
            'title' => "आजचा बाजार भाव ( Market Price ) | Todays Bajar Bhav, Market Yard Rates | आजचे शेती मालाचे भाव | Krushi Marathi",
            'description' => "आजचे शेती मालाचे बाजार भाव ( Sheti Malache Latest Bajar Bhav ) - महाराष्ट्रातील बाजारसमित्यांमध्ये शेतमालाचे आजचे बाजारभाव काय? याची संपूर्ण माहिती शेतकरी बांधवांना इथे वाचायला मिळले.",
            'canonical' => url()->current(),
            'type' => 'article',
            'data1' =>  config('constants.user_name'),
            'updated_time' =>  now()->toIso8601String(),
			
            'keywords' => "Todays Bajarbhav, Live Bajarbhav, Market Yard Rates, ajache taje bajarbhav, Aajcha Maha Bazar Bhav, bajar bhav, Krushi Marathi, Market Rates, आजचे ताजे बाजारभाव, आजचे बाजार भाव",

            'tags' => ['आजचे बाजार भाव', 'Bajar Bhav', 'Latest Bajar Bhav', 'Todays Bajar Bhav', 'Market Yard Rates', 'आजचे ताजे बाजारभाव', 'भाजीपाला आजचे बाजार भाव']
        ])
            
@endpush

@push('custom-search_script')

@endpush

@push('custom-scripts')

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
    // googletag.pubads().collapseEmptyDivs();

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

@push('custom-css')
<link href="{{asset('public/assets/advertisement/css/home.css')}}" rel="stylesheet" type="text/css">
<style>

    .row .col-lg-1{
        padding-right: unset;
    }
    
    .row .col-lg-1 a.btn{
        padding: .6375rem .150rem;
    }
    
    .gutter-ad {
        position: fixed;
        top: 90px;
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
            <div class="col-sm-1">
                <!-- Left Side 160x600 Ad -->
                <div class="gutter-ad">
                   @include('frontend.Adsence.bajar_sticky_ad_1')
                </div>
            </div>
            <div class="col-sm-10">
        	    @includeIf('frontend.Ads.bajarbhav_ad_top')
        	    <br/>
        		@include('advertisement.components.bajarbhav.pik_name')
                @include('advertisement.components.bajarbhav.city_name')
                @include('advertisement.components.bajarbhav.bajar_samiti_name')
                
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
                @include('advertisement.components.bajarbhav.ad_banner',['fileName' => 'bajarbhav_ad_2'])
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
    