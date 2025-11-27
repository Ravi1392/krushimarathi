@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta',
        [
            'title' => "IPL 2025 | Complete Match Schedule | IPLT20 | Krushi Marathi", 
            'description' => $spec_category_info->meta_description,
            'canonical' => Request::url(),
            'type' => 'website',
            'data1' =>  config('constants.user_name'),
            'updated_time' =>  $spec_category_info->updated_at->toIso8601String(),
            'published_time' => $spec_category_info->updated_at->toIso8601String(),
            'modified_time' => $spec_category_info->updated_at->toIso8601String()
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
    <link href="{{ config('constants.CDN_BASE') }}/front/css/ipl/ipl_custome.css" rel="stylesheet" type="text/css">
    <link href="{{ config('constants.CDN_BASE') }}/front/css/ipl/schedule.css" rel="stylesheet" type="text/css">
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
        @include('frontend.Ads.bajarbhav_ad_top')
        @include('frontend.components.breadcrumb_bar', ['blog_title' => $spec_category_info->name])
    </div>
    {{-- IPL --}}
    <div id="content" class="section-padding">
            <div class="sectionWrapper">
                @include('frontend.components.ipl.schedule',['matches' => $matches])
        </div>
    </div>
    
    @include('frontend.components.more_for_u_card')
    @include('frontend.Adsence.home_page_ads_1')

    <div id="content" class="site-content section-padding">
        <div class="section section--alt main-card-shadow">
            <div class="sectionWrapper">
                <div class="sectionTitlebar sectionTitlebar--hasCta block">
                    <h1 class="sectionTitle archive-heading">IPL 2025 News</h1>
                </div>
                <div class="container">
                    <div id="blog-list" class="xpress_articleList">
                        @if (isset($ipl_news))
                            @foreach ($ipl_news as $daily_update)
                                <article>
                                    <div class="sdn_aboutUs__Card card-shadow">
                                        <div class="media__object media--left">
                                            <div class="xpress_articleImage--full">
                                                <a title="{{$daily_update->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $daily_update->blog_slug]) }}">
                                                    <img width="768" height="432" src="{{ $daily_update->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{$daily_update->blog_title}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="block-body block-row">
                                            <a title="{{$daily_update->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $daily_update->blog_slug]) }}">
                                                <h2 style="font-size: 16px;margin-bottom: 5px;">{{$daily_update->blog_title}}</h2>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <div class="coming-soon-wrapper">
                                <h1>Coming Soon...</h1>
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
</div>
@endsection