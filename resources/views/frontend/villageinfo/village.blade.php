@extends('frontend.layout.common')

@php
    $year = date('Y');
@endphp
@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => "{$village_data?->en_name} Village (Pincode: {$village_data?->pincode}) | Krushi Marathi",
        
        'description' => "{$village_data?->en_name} village is located in {$village_data?->taluka?->en_name} Tehsil of {$village_data?->taluka?->district?->en_name} district in {$village_data?->taluka?->district?->state?->en_name}, India. Get Detailed information about {$village_data?->en_name} village like History, Population, Census, Pincode, STD Code etc.",
        
        'canonical' => Request::url(),
        'type' => 'article',
        'data1' => "Krushi Marathi",
        'updated_time' => $village_data->content_updated_at->toIso8601String(),
        'published_time'=> $village_data->created_at->toIso8601String(),
        'modified_time' => $village_data->content_updated_at->toIso8601String()
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
            
            @include('frontend.villageinfo.components.breadcrumb_bar',['state_name' => $village_data?->taluka?->district?->state?->en_name, 'state_slug' => $village_data->taluka->district->state->state_slug, 'district_name' => $village_data?->taluka?->district?->en_name, 'district_slug' => $village_data->taluka->district->district_slug, 'taluka_name' => $village_data?->taluka?->en_name, 'taluka_slug' => $village_data->taluka->taluka_slug, 'title' => $village_data?->en_name])
        </div>
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow blog-view-card">
                <div class="container">
                    <div class="content-area" id="primary">
                        <article>
                            <div class="inside-article">
                                
                                <h1 class="h4" style="margin-bottom: 0px;">
                                    <strong>{{$village_data?->en_name}}</strong>
                                </h1>
                                
                                <div class="entry-meta">
                                    <p>
                                        {{$village_data?->en_name}} is a village situated in the Sindkhede taluka of Dhule district in Maharashtra, India. Spanning a total geographical area of 1,090.89 hectares (approximately 10.9 square kilometers), Achhi is identified by the village code 526140. The village falls under the administrative jurisdiction of the Sindkhede subdivision, with the nearest police station located in Sindkhede itself.
                                    </p>
                                    <p>
                                        This article offers a detailed overview of Achhi, encompassing its demographic profile, population statistics, household data, administrative setup, connectivity, geographical features, availability of educational and healthcare facilities, electricity and drinking water infrastructure, and information about nearby villages.
                                    </p>
                                </div>
                                
                                <div class="code-block code-block-7" style="margin: 8px 0; clear: both;">
                                    @include('frontend.components.google_source')
                                </div>
                                
                                @includeIf('frontend.Ads.village_view_ads_1')
                                <br/>
                                
                                <div class="entry-content" itemprop="text">
                                    @include('frontend.villageinfo.components.village.village_map', [
                                        'en_name' => $village_data?->en_name,
                                        'latitude' => $village_data->latitude,
                                        'longitude' => $village_data->longitude,
                                        'place_id' => "",
                                        'state' => $village_data?->taluka?->district?->state?->en_name,
                                        'pin_code' => $village_data->pincode,
                                        'zoom' => 30000,
                                    ])
                                    
                                    @includeIf('frontend.Adsence.village_view_ads_1')
                                    <br/>
                                    
                                    @include('frontend.villageinfo.components.village.village_population', [
                                        'en_name' => $village_data?->en_name,
                                        'villagestatistics' => $village_data->villagestatistics,
                                        'population' => $village_data->population ?? 'NA'
                                    ])
                                    
                                    @include('frontend.villageinfo.components.village.village_connectivity', [
                                        'en_name' => $village_data?->en_name ?? 'NA',
                                        'public_bus' => $village_data->villagefacilities->public_bus ?? 'NA',
                                        'railway_station' => $village_data->villagefacilities->railway_station ?? 'NA',
                                        'communication' => $village_data->villagefacilities->communication ?? 'NA',
                                        
                                    ])
                            
                                    @include('frontend.villageinfo.components.village.village_drinking_water', [
                                        'en_name' => $village_data?->en_name ?? 'NA',
                                        'tap_water' => $village_data->villagefacilities->tap_water ?? 'NA',
                                        'well' => $village_data->villagefacilities->well ?? 'NA',
                                        'tank' => $village_data->villagefacilities->tank ?? 'NA',
                                        'tubewell' => $village_data->villagefacilities->tubewell ?? 'NA',
                                        'handpump' => $village_data->villagefacilities->handpump ?? 'NA',
                                        'other_sources' => $village_data->villagefacilities->other_sources ?? 'NA',
                                    ])
                                    
                                    @includeIf('frontend.Ads.village_view_ads_2')
                                    <br/>
                                    
                                    @include('frontend.villageinfo.components.village.village_medical', [
                                        'en_name' => $village_data?->en_name,
                                        'primary_health_centre' => $village_data->villagefacilities->primary_health_centre ?? 'NA',
                                        'hospital_facility' => $village_data->villagefacilities->hospital_facility ?? 'NA',
                                        'other_medical_centres' => $village_data->villagefacilities->other_medical_centres ?? 'NA',
                                    ])
                            
                                    @include('frontend.villageinfo.components.village.village_education', [
                                        'en_name' => $village_data?->en_name,
                                        'primary_school' => $village_data->villagefacilities->primary_school ?? 'NA',
                                        'primary_school_name' => $village_data->villagefacilities->primary_school_name ?? 'NA',
                                        'secondary_school' => $village_data->villagefacilities->secondary_school ?? 'NA',
                                        'secondary_school_name' => $village_data->villagefacilities->secondary_school_name ?? 'NA',
                                        'college' => $village_data->villagefacilities->college ?? 'NA',
                                        'college_name' => $village_data->villagefacilities->college_name ?? 'NA',
                                    ])
                                    
                                    @includeIf('frontend.Adsence.village_view_ads_2')
                                    <br/>
                                    
                                    @include('frontend.villageinfo.components.village.village_electricity', [
                                        'en_name' => $village_data?->en_name,
                                        'electricity_supply' => $village_data->villagefacilities->electricity_supply ?? 'NA',
                                        'domestic_electricity' => $village_data->villagefacilities->domestic_electricity ?? 'NA',
                                        'agri_electricity' => $village_data->villagefacilities->agri_electricity ?? 'NA',
                                        'other_electricity_uses' => $village_data->villagefacilities->other_electricity_uses ?? 'NA',
                                        'all_households_electrified' => $village_data->villagefacilities->all_households_electrified ?? 'NA',
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
                        @include('frontend.villageinfo.components.village.village_overview', [
                            'en_name' => $village_data?->en_name ?? 'NA',
                            'mr_name' => $village_data->mr_name ?? 'NA',
                            'pincode' => $village_data->pincode ?? 'NA',
                            'total_area' => $village_data->area ?? 0,
                            'village_code' => $village_data->village_code ?? 'NA',
                            'taluka_name' => $village_data?->taluka?->en_name ?? 'NA',
                            'district_name' => $village_data?->taluka?->district?->en_name ?? 'NA',
                            'state_name' => $village_data?->taluka?->district?->state?->en_name ?? 'NA',
                            'gram_panchayat_name' => $village_data->gram_panchayat_name ?? 0,
                            'panchayat_code' => $village_data->panchayat_code ?? 0,
                            'sex_ratio' => $village_data->sex_ratio ?? 'NA',
                            'population_density' => $village_data->total_households ?? 'NA',
                            'total_population' => $village_data->population ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="categories-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;height: 280px;">
                        <div class="adtext">Advertisement</div>
                        @includeIf('frontend.Ads.village_sidebar_view_ads_2')
                    </aside>
                    
                    <aside id="block-1" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @include('frontend.villageinfo.components.village.nearest_villages', [
                            'name' => $village_data?->en_name ?? 'NA',
                            'nearest_villages' => $village_data->nearest_villages
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
                        @include('frontend.villageinfo.components.village.village_msg', ['name' => $village_data->en_name])
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