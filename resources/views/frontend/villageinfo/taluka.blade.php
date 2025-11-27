@extends('frontend.layout.common')

@php
    $year = date('Y');
@endphp
@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => "{$taluka_data?->en_name} Subdivision of {$taluka_data?->district?->en_name}, {$taluka_data?->district?->state?->en_name} | Krushi Marathi",
        'description' => "{$taluka_data?->en_name} Subdivision of {$taluka_data?->district?->en_name} in {$taluka_data?->district?->state?->en_name}, Get all information about Population of {$taluka_data?->en_name} Subdivision, Area, List of Villages in {$taluka_data?->en_name} Subdivision",
        'canonical' => Request::url(),
        'type' => 'article',
        'data1' => "Krushi Marathi",
        'updated_time' => $taluka_data->content_updated_at->toIso8601String(),
        'published_time'=> $taluka_data->created_at->toIso8601String(),
        'modified_time' => $taluka_data->content_updated_at->toIso8601String()
    ])
@endpush

@push('custom-css')
    <style>
    .google-source{
        width: 127px;
    }
    
    .is-blog-view-right-sidebar {
        width: 29%;
    }
    
    @media (max-width: 1120px) {
        .is-blog-view-right-sidebar {
            width: 100%;
        }
    }
    
    @media (max-width: 768px) {
        .google-source{
            width: 180px;
        }
        .desktop-only {
            display: none !important;
        }
        .is-blog-view-right-sidebar {
            width: 100%;
        }
    }
</style>
@endpush

@push('custom-scripts')
    <link href="{{ config('constants.CDN_BASE') }}/front/css/villageinfo/stylehome.css" rel="stylesheet" type="text/css">
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const closeButtons = document.querySelectorAll('.alert .close');

            closeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    this.parentElement.style.display = 'none'; // Hide the alert box
                });
            });
        });
        
        // stick ads StopIteration
        
        function hideGutterAdsIfMobileDesktopMode() {
            const isMobileDevice = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
            const isWideScreen = window.innerWidth > 768; // desktop width
        
            if (isMobileDevice && isWideScreen) {
                // Hide the gutter ads
                const leftAd = document.querySelector('.left-gutter-ad');
                const rightAd = document.querySelector('.right-gutter-ad');
        
                if (leftAd) leftAd.style.display = 'none';
                if (rightAd) rightAd.style.display = 'none';
            }
        }
    
        // Run on load and resize
        window.addEventListener('load', hideGutterAdsIfMobileDesktopMode);
        window.addEventListener('resize', hideGutterAdsIfMobileDesktopMode);
        
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
    
        // --- village_view_ads 1 ---
        googletag.defineSlot('/23289270189/village_view_ads_1', [[728, 90], [300, 250], [320, 50], [320, 100]], 'div-gpt-ad-1757763842347-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
    
        // --- village_view_ads 2 ---
        googletag.defineSlot('/23289270189/village_view_ads_2', [[728, 90], [300, 250], [320, 50], [320, 100]], 'div-gpt-ad-1757764116155-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
    
        // --- village_sidebar_view_ads 2 ---
        googletag.defineSlot('/23289270189/village_sidebar_view_ads_2', [[300, 250], [320, 50], [250, 250], [300, 100], [320, 100], [320, 250]], 'div-gpt-ad-1757764225162-0')
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
        	 <br/>
            @if (session('error') == true)
                @include('frontend.components.success_error_msg',['msg_value' => session('msg_value'), 'msg' => session('msg')])
            @endif
            
            @include('frontend.villageinfo.components.breadcrumb_bar',['state_name' => $taluka_data?->district?->state?->en_name, 'state_slug' => $taluka_data?->district?->state?->state_slug, 'district_name' => $taluka_data?->district?->en_name, 'district_slug' => $taluka_data?->district?->district_slug, 'title' => $taluka_data?->en_name])
        </div>
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow blog-view-card">
                <div class="container">
                    <div class="content-area" id="primary">
                        <article>
                            <div class="inside-article">
                                
                                <h1 class="entry-title entry-title-h1" itemprop="headline">{{$taluka_data?->en_name}}</h1>
                                
                                <div class="entry-meta">
                                    <p>{{$taluka_data?->en_name}} is a subdivision and city located in the state of {{$taluka_data?->district?->state?->en_name}}, India. This article offers a detailed overview of {{$taluka_data?->en_name}} Sub-District, including its population, demographic information, household data, administration details, and a comprehensive list of villages in the {{$taluka_data?->en_name}} Subdivision.</p>

                                    <p>{{$taluka_data?->en_name}} is a subdivision located in the {{$taluka_data?->district?->en_name}} District of {{$taluka_data?->district?->state?->en_name}}, India. Covering an area of {{$taluka_data->area ?? 0}} km², {{$taluka_data?->en_name}} is home to a population of {{$taluka_data->population}} people, according to the 2011 Census. The sub-district has a high population density of {{$taluka_data->density}} /km² (people per squar km), making it one of the densely populated regions in the district.</p>
                                </div>
                                
                                <div class="code-block code-block-7" style="margin: 8px 0; clear: both;">
                                    @include('frontend.components.google_source')
                                </div>
                                
                                @includeIf('frontend.Ads.village_view_ads_1')
                                <br/>
                                
                                <div class="entry-content" itemprop="text">
                                    <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                        List Of Villages in {{$taluka_data->en_name}}
                                    </h2>
                                    
                                    <hr>
                                    <p>In {{$taluka_data->en_name}}, villages are categorized based on their population. Here’s a breakdown of the number of villages within each population range:</p>
                                    
                                    @if ($taluka_data->villages)
                                        @include('frontend.villageinfo.components.taluka.village_list', ['villages_data' => $taluka_data->villages])
                                    @else
                                        <p><strong>Data not found.</strong></p>
                                    @endif
                                    
                                    @includeIf('frontend.Adsence.village_view_ads_1')
                                    <br/>
                                    @include('frontend.villageinfo.components.taluka.taluka_population', [
                                        'en_name' => $taluka_data->en_name,
                                        'male_rural' => $taluka_data->male_rural,
                                        'male_urban' => $taluka_data->male_urban,
                                        'female_rural' => $taluka_data->female_rural,
                                        'female_urban' => $taluka_data->female_urban,
                                        'rural_total' => $taluka_data->rural_total,
                                        'urban_total' => $taluka_data->urban_total,
                                        'population_density' => $taluka_data->density ?? 'NA'
                                    ])
                            
                                    @include('frontend.villageinfo.components.taluka.household', [
                                        'en_name' => $taluka_data->en_name ?? 'NA',
                                        'rural_household' => $taluka_data->rural_household ?? 'NA',
                                        'urban_household' => $taluka_data->urban_household ?? 'NA',
                                        'total_households' => $taluka_data->total_households ?? 'NA'
                                    ])
                                    
                                    👉 To see amazing offers from <b>'Smart Deals'</b> for shopping &nbsp;<strong><a aria-label="content" title="Smart Shopping" target="_blank" href="{{url('/smart-shopping')}}" style="font-size: 20px; font-weight: 500;color: #017afd;">Click here</a></strong>
                                    
                                    @includeIf('frontend.Adsence.blog_view_ads_7')
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

            <!--Right Sidebar-->
            <div class="widget-area sidebar is-blog-view-right-sidebar" id="right-sidebar">
                <div class="inside-right-sidebar">
                    
                    <aside id="categories-2" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @include('frontend.villageinfo.components.taluka.taluka_overview', [
                            'en_name' => $taluka_data->en_name ?? 'NA',
                            'mr_name' => $taluka_data->mr_name ?? 'NA',
                            'district_en_name' => $taluka_data->district->en_name ?? 'NA',
                            'state_en_name' => $taluka_data->district->state->en_name ?? 'NA',
                            'total_area' => $taluka_data->area ?? 0,
                            'total_villages' => $taluka_data->total_villages ?? 0,
                            'sex_ratio' => $taluka_data->sex_ratio ?? 'NA',
                            'population_density' => $taluka_data->density ?? 'NA',
                            'total_population' => $taluka_data->population ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="categories-3" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @include('frontend.villageinfo.components.villages_population', [
                            'name' => $taluka_data->en_name ?? 'NA',
                            'population_1' => $taluka_data->population_1 ?? 'NA',
                            'population_2' => $taluka_data->population_2 ?? 'NA',
                            'population_3' => $taluka_data->population_3 ?? 'NA',
                            'population_4' => $taluka_data->population_4 ?? 'NA',
                            'population_5' => $taluka_data->population_5 ?? 'NA',
                            'population_6' => $taluka_data->population_6 ?? 'NA',
                            'population_7' => $taluka_data->population_7 ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="block-1" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;height: 280px;">
                        <div class="adtext">Advertisement</div>
                        @includeIf('frontend.Ads.village_sidebar_view_ads_2')
                    </aside>
                    
                    <aside id="block-2" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                       @include('frontend.villageinfo.components.taluka.nearest_talukas', [
                            'name' => $taluka_data->en_name ?? 'NA',
                            'nearest_talukas' => $taluka_data->nearest_talukas
                        ])
                    </aside>
                    
                    <aside id="block-3" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Other Post</h2>
                        <hr style="margin-bottom: 12px;margin-top: 10px;">
                        @include('frontend.components.other_blogs_column', ['sidebar_blogs' => $sidebar_blogs])
                    </aside>
                    
                </div>
            </div>
        </div>
        
        
        <div class="site-content section-padding">
            <div class="section sdn_sectionAbout main-card-shadow">
                <div class="sectionWrapper">
                    <div class="container">
                        @include('frontend.villageinfo.components.important_msg')
                    </div>
                </div>
            </div>
        </div>
        
        <div class="site-content section-padding">
            <div class="section sdn_sectionAbout main-card-shadow">
                <div class="sectionWrapper">
                    <div class="container">
                        @include('frontend.villageinfo.components.taluka.taluka_msg', ['name' => $taluka_data->en_name])
                    </div>
                </div>
            </div>
        </div>
        
        @include('frontend.Adsence.village_page_ads_1')
        
        @if(!$blogs_for_row->isEmpty())
            <div class="site-content section-padding">
                <div class="section sdn_sectionAbout main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="container">
                            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;font-size:24px;">Related Blogs</h2>
                            <hr style="margin-bottom: 12px;margin-top: 10px;">
                            <div class="xpress_articleList">
                                @include('frontend.components.other_blogs_row', ['blogs' => $blogs_for_row])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
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