@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', 
    [
        'title' => $category->name .' | '. ucwords(str_replace('-', ' ', $category->category_slug)) . " | Krushi Marathi",
        'description' => $category->meta_description,
        'category_slug' => $category->category_slug,
        'canonical' => url()->current(),
        'type' => 'website',
        'twitter_card' => 'summary',
        'published_time'=> $category->created_at->toIso8601String(),
        'modified_time' => $category->content_updated_at->toIso8601String(),
        'updated_time' =>  $category->content_updated_at->toIso8601String(),
        'data1' =>  config('constants.user_name')
    ])
@endpush
@push('custom-search_script')

@endpush
@push('custom-scripts')
    <script src="{{ config('constants.CDN_BASE') }}/front/js/jquery-3.6.0.min.js" ></script>
    <script>
        $(document).ready(function() {
        let isMouseDown = false;
        let startX, scrollLeft;
    
        $('.sdn_professionSlider').mousedown(function(e) {
            isMouseDown = true;
            startX = e.pageX - $(this).offset().left;
            scrollLeft = $(this).scrollLeft();
        });
    
        $('.sdn_professionSlider').mouseleave(function() {
            isMouseDown = false;
        });
    
        $('.sdn_professionSlider').mouseup(function() {
            isMouseDown = false;
        });
    
        $('.sdn_professionSlider').mousemove(function(e) {
            if (!isMouseDown) return;
            e.preventDefault();
            const x = e.pageX - $(this).offset().left;
            const walk = (x - startX) * 2;
            $(this).scrollLeft(scrollLeft - walk);
        });
    });
    </script>
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
    
        // loop_ads_2
        googletag.defineSlot('/23289270189/loop_ads_2', [[728, 90], [300, 250], [320, 50], [320, 100]], 'div-gpt-ad-1758373994370-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
            
        //loop_ads_4
        googletag.defineSlot('/23289270189/loop_ads_4', [[728, 90], [300, 250], [320, 50], [320, 100]], 'div-gpt-ad-1758374024098-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
        
        //loop_ads_6
        googletag.defineSlot('/23289270189/loop_ads_6', [[728, 90], [300, 250], [320, 50], [320, 100]], 'div-gpt-ad-1758374045182-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
        
        //loop_ads_8
        googletag.defineSlot('/23289270189/loop_ads_8', [[728, 90], [300, 250], [320, 50], [320, 100]], 'div-gpt-ad-1758374069494-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
        
        //loop_ads_10
        googletag.defineSlot('/23289270189/loop_ads_10', [[728, 90], [300, 250], [320, 50], [320, 100]], 'div-gpt-ad-1758374097227-0')
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

@push('custom-css')
    <link href="{{ config('constants.CDN_BASE') }}/front/css/more_for_u_card.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div id="page" class="site grid-container container hfeed">
    
    <div id="content" class="section-padding">
        <br/>
        @includeIf('frontend.Ads.bajarbhav_ad_top')
	    
        @include('frontend.components.ad_banner')
    </div>
    
    <div id="content" class="site-content-width section-padding">
        <div class="section sdn_sectionProfessions" style="padding-bottom: 9px;">
            @include('frontend.components.menu',['slug' => $category_slug,'sub_categories' => $sub_categories])
        </div>

        {{-- Top Blogs --}}
        @if(!$blogs_for_row->isEmpty())
            <div id="content" class="site-content section-padding">
                <div class="section sdn_sectionAbout main-card-shadow" style="background: #129ea9;">
                    <div class="sectionWrapper">
                        <div class="container">
                            <h2 class="widget-title archive-heading" style="color:#ffffff;margin-bottom: 10px;font-size:24px;">{{$title_name}}</h2>
                            <hr style="margin-bottom: 12px;margin-top: 10px; background:#e5e5e5">
                            <div class="xpress_articleList">
                                @include('frontend.components.other_blogs_row', ['blogs' => $blogs_for_row, 'font_color' => "#ffffff"])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @include('frontend.Adsence.home_page_ads_1')

        @if (isset($sub_categories) && !empty($sub_categories))
            @php
                $index = 0;
                $ad_file_counter = 0;
            @endphp
            
            @foreach ($sub_categories as $sub_category)
                @php $index++; @endphp
                <div class="section section--alt main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="sectionTitlebar sectionTitlebar--hasCta block">
                            <a href="{{ route('front.category_wise_view', ['slug' => $category_slug, 'sub_category' => $sub_category->subcategory_slug]) }}"> 
                                <h2 class="sectionTitle archive-heading">{{$sub_category->name}}</h2>
                            </a>
                            <div class="sectionTitle--opposite">
                                <a href="{{ route('front.category_wise_view', ['slug' => $category_slug, 'sub_category' => $sub_category->subcategory_slug]) }}" style="background: #55555e;color: #fff;padding: 2px 10px 5px;border-radius: 25px;">See More</a>
                            </div>
                         </div>
                        @php
                            $firstHalf = $sub_category['blogs']->slice(0, 3);
                            $secondHalf = $sub_category['blogs']->slice(3, 9);
                        @endphp
                        <div class="container">
                            <div class="xpress_articleList">
                                @include('frontend.components.category_wise',['blogs' => $firstHalf])
                            </div>
                        </div>
                        @if ($secondHalf->isNotEmpty())
                            <hr>
                            <div class="container">
                                <div class="xpress_articleList">
                                    @include('frontend.components.other_blogs_row',['blogs' => $secondHalf])
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                @if ($index == 2)
                    <!--@include('frontend.components.more_for_u_card')-->
                @endif

                @php
                    $ad_number = $ad_file_counter + 1;
                @endphp
                    
                @if ($index % 2 == 0)
                
                    @includeIf('frontend.Ads.loop_ads_' . $ad_number) 
                
                @elseif ($index % 2 != 0)
                    
                    @includeIf('frontend.Adsence.loop_ads_' . $ad_number) 
                    
                @endif
                
                @php
                    $ad_file_counter++;
                @endphp
                
            @endforeach
        @else
            <div class="coming-soon-wrapper">
                <h1>Coming Soon...</h1>
                @include('frontend.Adsence.home_page_ads_2')
            </div>
        @endif
        @if ((count($sub_categories) <= 0) || (count($sub_categories) <= 1))
            <!--@include('frontend.components.more_for_u_card')-->
        @endif
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