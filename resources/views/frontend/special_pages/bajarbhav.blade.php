@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta',
        [
            'title' => "आजचा बाजार भाव ( Market Price ) | Todays Bajar Bhav, Market Yard Rates | आजचे शेती मालाचे भाव | भाजीपाला बाजार भाव | आवक व बाजारभाव माहिती | Krushi Marathi", 
            'description' => "आजचे शेती मालाचे बाजार भाव ( Sheti Malache Latest Bajar Bhav ) - महाराष्ट्रातील बाजारसमित्यांमध्ये शेतमालाचे आजचे बाजारभाव काय? याची संपूर्ण माहिती शेतकरी बांधवांना इथे वाचायला मिळले.",
            'canonical' => Request::url(),
            'type' => 'website',
            'data1' =>  config('constants.user_name'),
            'updated_time' =>  $spec_category_info->content_updated_at->toIso8601String(),
            'published_time' => $spec_category_info->content_updated_at->toIso8601String(),
            'modified_time' => $spec_category_info->content_updated_at->toIso8601String()
        ])
@endpush

@push('custom-search_script')

@endpush

@push('custom-scripts')
    <script>
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });
    </script>
@endpush

@push('custom-css')
    <link href="{{ config('constants.CDN_BASE') }}/front/css/more_for_u_card.css" rel="stylesheet" type="text/css">
    <link href="{{ config('constants.CDN_BASE') }}/front/css/bajarbhav.css" rel="stylesheet" type="text/css">
@endpush

@push('ads-script')

    <!--sidebar_ad_code-->
    <script>
        window.googletag = window.googletag || { cmd: [] };
        googletag.cmd.push(function () {
    
        const REFRESH_KEY = 'refresh';
        const REFRESH_VALUE = 'true';
        const SECONDS_TO_WAIT_AFTER_VIEWABILITY = 30;
        
        var mapping = googletag.sizeMapping()
            .addSize([1024, 0], [[728, 90], [970, 90]]) // Desktop
            .addSize([768, 0], [[468, 60], [320, 100]]) // Tablet
            .addSize([0, 0], [[300, 250], [320, 100], [320, 50]]) // Mobile
            .build();

        //-------------Top Ad------------------
        googletag.defineSlot('/23289270189/bajarbhav_ad_top', [[728, 90], [300, 250], [320, 50], [300, 100]], 'div-gpt-ad-1758342315505-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
            
        // --- Blog View Ad 2 ---
        googletag.defineSlot('/23289270189/blog_view_ads_2', [[728, 90], [320, 250], [300, 100], [300, 75], [250, 250], [300, 50]], 'div-gpt-ad-1758106579763-0')
            .defineSizeMapping(mapping)
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

@section('content')
<div id="page" class="site grid-container container hfeed">
    <div style="padding-top: 15px;padding-left: 10px;">
        @includeIf('frontend.Ads.bajarbhav_ad_top')
    </div>
    {{-- Bajar Bhav Table --}}
    <div id="content" class="section-padding bajarbhav">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title" style="margin-bottom: unset;">आजचे बाजारभाव (Mandi Bhav Today)</h1>
            </div>
            <div class="card-body">
                <p style="font-size: 17px; margin-bottom: unset;">शेतकऱ्यांसाठी &lsquo;कृषी मराठी&rsquo; या पोर्टलवर आजचे 
<strong>ताजे आणि अचूक बाजारभाव (Mandi Rates)</strong> उपलब्ध आहेत. विविध राज्यांतील सर्व प्रमुख कृषी उत्पन्न बाजार समित्यांमध्ये (APMC) आज कोणत्या पिकाचा 
<strong>किमान आणि कमाल दर</strong> चालू आहे, हे तुम्ही येथे एका क्लिकमध्ये सहज पाहू शकता.</p>
            </div>
        </div>
        @include('frontend.components.bajarbhav.pik_name', ['crops' => $crops])
        @includeIf('frontend.Ads.blog_view_ads_2')
        @include('frontend.components.bajarbhav.city_name', ['cities' => $cities])
        @include('frontend.components.bajarbhav.bajar_samiti_name', ['samitis' => $samitis])
        
        <div class="card" style="margin-bottom: unset;">
            <div class="card-header">
                <h2 class="card-title">{{ __('common.bajarbhav_disclaimer_title', [], 'mr') }}</h2>
            </div>
            <div class="card-body">
                {{-- <div class="row">
                    <div class="card-body"> --}}
                        <p style="font-size: 17px; margin-bottom: unset;">{{ __('common.bajarbhav_disclaimer', [], 'mr') }}</p>
                    {{-- </div>
                </div> --}}
            </div>
        </div>
    </div>
    
    @include('frontend.components.more_for_u_card')

    <div class="site-content section-padding">
        <div class="section section--alt main-card-shadow">
            <div class="sectionWrapper">
                <div class="sectionTitlebar sectionTitlebar--hasCta block">
                    <h2 class="sectionTitle archive-heading">बाजारभाव बातम्या</h2>
                </div>
                <div class="container">
                    <div id="blog-list" class="xpress_articleList">
                        @if (isset($bhajarbhav_news))
                            @foreach ($bhajarbhav_news as $bhajarbhav)
                                <article>
                                    <div class="sdn_aboutUs__Card card-shadow">
                                        <div class="media__object media--left">
                                            <div class="xpress_articleImage--full">
                                                <a title="{{$bhajarbhav->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $bhajarbhav->blog_slug]) }}">
                                                    <img width="768" height="432" src="{{ $bhajarbhav->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($bhajarbhav->blog_slug)}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="block-body block-row">
                                            <a title="{{$bhajarbhav->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $bhajarbhav->blog_slug]) }}">
                                                <h2 style="font-size: 16px;margin-bottom: 5px;">{{$bhajarbhav->blog_title}}</h2>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <div class="coming-soon-wrapper">
                                <h2>Coming Soon...</h2>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Left Side 160x600 Ad -->
    <div class="gutter-ad left">
       @include('frontend.Adsence.sticky_ad_1')
    </div>

    <!-- Right Side 160x600 Ad -->
    <div class="gutter-ad right">
        @include('frontend.Adsence.sticky_ad_2')
    </div>
    @include('frontend.Adsence.multi_ads_1')
</div>
@endsection