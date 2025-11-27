@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => ucwords(str_replace('-', ' ', $spec_category_info->category_slug)) . ' | Air Quality Index, Weather, Weather Updates | Krushi Marathi | '. date('d-m-Y'),
        'description' => $spec_category_info->meta_description,
        'canonical' => url()->current(),
        'type' => 'website',
        'updated_time' =>  now()->toIso8601String(),
        'published_time' => now()->toIso8601String(),
        'modified_time' => now()->toIso8601String(),
        'data1' =>  config('constants.user_name')
    ])
@endpush

@push('custom-search_script')

@endpush

@push('custom-scripts')
    <script src="{{ config('constants.CDN_BASE') }}/front/js/jquery-3.6.0.min.js" ></script>
    
    <script>
        let page = 1;
        let loading = false;
    
        $(window).scroll(function () {
            
            let scrollTop = $(window).scrollTop();
            let windowHeight = $(window).height();
            let documentHeight = $(document).height();
            let triggerPoint = documentHeight * 0.50;
            
            if (scrollTop + windowHeight >= triggerPoint) {
                if (!loading) {
                    loading = true;
                    page++;
    
                    $.ajax({
                        url: "{{ route('weather.loadMore', '') }}/" + page, // Correct dynamic URL
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data.length > 0) {
                                loading = false;
                                data.forEach(item => {
                                    const weatherBox = `
                                        <div class="weather_box">
                                            <div class="aqi_weatherCityNm">
                                                <span class="weatherCityNm">${item.district.mr_name}</span>
                                                ${item.aqi_value ? `<span class="weatherValue">AQI :&nbsp;<span class="${item.aqi_class}">${item.aqi_value}</span>
                                                    <span class="aqi_rvw_icn">
                                                        <img src="${item.aqi_image}" alt="${item.aqi_class}">
                                                    </span></span>` : ''}
                                            </div>
                                            <div class="wheather_imgBx">
                                                <img src="${item.weather_image}" alt="${item.aqi_class}" height="100" width="100">
                                            </div>
                                            <div class="wheather_value_bx">
                                                <div class="weather_degreeVl">${item.temperature}<sup>o</sup><span class="cel_clas">C</span></div>
                                                <span>${item.weather_condition}</span>
                                            </div>
                                        </div>`;
    
                                    $('#weather-list').append(weatherBox);
                                });
                            } else {
                                $(window).off("scroll"); // Stop scrolling event if no more data
                                loading = true;
                            }
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error("AJAX request failed:", textStatus, errorThrown);
                            loading = true;
                        }
                    });
                }
            }
        });
    </script>

@endpush

@push('custom-css')

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
            
        // --- Sidebar Ad ---
        googletag.defineSlot('/23289270189/sidebar_ad_code', [[300, 250], [320, 50], [300, 100]], 'div-gpt-ad-1758108573729-0')
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
            @include('frontend.components.breadcrumb_bar',['blog_title' => $spec_category_info->name])
        </div>
        
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow" style="width: 100%;">
                <div class="sectionWrapper">
                    <div class="sectionTitlebar sectionTitlebar--hasCta block">
                        <h1 class="sectionTitle archive-heading">{{$spec_category_info->name}} | AQI - हवेची गुणवत्ता निर्देशांक आणि तापमान</h1>
                    </div>
                    <div class="container">
                        <div id="weather-list" class="xpress_articleList weather-special-grid">
                            @if(isset($Weather_data) && !empty($Weather_data))
                                @foreach ($Weather_data as $data)
                                    <div class="weather_box">
                                        <div class="aqi_weatherCityNm">
                                            <span class="weatherCityNm">{{ $data->district->mr_name }}</span>
                                            @if(isset($data->aqi_value) && !empty($data->aqi_value))
                                                <span class="weatherValue">AQI :&nbsp;<span class="{{ $data->aqi_class }}">{{ $data->aqi_value }}</span> 
                                                    <span class="aqi_rvw_icn">
                                                        <img src="{{ asset($data->aqi_image) }}" alt="{{ $data->aqi_class }}">
                                                    </span>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="wheather_imgBx">
                                            <img src="{{ asset($data->weather_image) }}" alt="{{ $data->aqi_class }}" height="100" width="100">
                                        </div>
                                        <div class="wheather_value_bx">
                                            <div class="weather_degreeVl">{{ $data->temperature }}<sup>o</sup><span class="cel_clas">C</span>
                                            </div>
                                            <span>{{ $data->weather_condition }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!--Right Sidebar-->
            <div class="widget-area sidebar is-right-sidebar" id="right-sidebar">
                <div class="inside-right-sidebar">
                    <aside id="block-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;">
                        <div class="adtext">Advertisement</div>
                        @includeIf('frontend.Ads.sidebar_ad_code')
                    </aside>
                    <aside id="categories-2" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Latest Posts</h2>
                        <hr style="margin-bottom: 12px;margin-top: 10px;">
                        @include('frontend.components.other_blogs_column', ['sidebar_blogs' => $sidebar])
                    </aside>
                    <aside id="block-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;">
                        <div class="adtext">Advertisement</div>
                        @includeIf('frontend.Adsence.sidebar_view_ads_1')
                    </aside>
                    <aside id="block-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;">
                        <div class="adtext">Advertisement</div>
                        @includeIf('frontend.Adsence.sidebar_view_ads_2')
                    </aside>
                </div>
            </div>
        </div>

        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow">
                <div class="sectionWrapper">
                    <div class="sectionTitlebar sectionTitlebar--hasCta block">
                        <h1 class="sectionTitle archive-heading">बाजारभाव बातम्या</h1>
                    </div>
                    <div class="container">
                        <div id="blog-list" class="xpress_articleList">
                            @if (isset($weather_news))
                                @foreach ($weather_news as $weather)
                                    <article>
                                        <div class="sdn_aboutUs__Card card-shadow">
                                            <div class="media__object media--left">
                                                <div class="xpress_articleImage--full">
                                                    <a title="{{$weather->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $weather->blog_slug]) }}">
                                                        <img width="768" height="432" src="{{ $weather->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($weather->blog_slug)}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="block-body block-row">
                                                <a title="{{$weather->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $weather->blog_slug]) }}">
                                                    <h2 style="font-size: 16px;margin-bottom: 5px;">{{$weather->blog_title}}</h2>
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

