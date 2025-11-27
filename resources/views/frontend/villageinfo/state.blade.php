@extends('frontend.layout.common')
@php
    $year = date('Y');
@endphp
@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => "{$state_data?->en_name} Population, Area, Villages, List of District | Krushi Marathi",
        'description' => "Explore {$state_data?->en_name}'s Administrative Divisions: List of Districts in {$state_data?->en_name}, India",
        'canonical' => Request::url(),
        'type' => 'article',
        'data1' => "Krushi Marathi",
        'updated_time' => $state_data->content_updated_at->toIso8601String(),
        'published_time'=> $state_data->created_at->toIso8601String(),
        'modified_time' => $state_data->content_updated_at->toIso8601String()
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
            
            @include('frontend.villageinfo.components.breadcrumb_bar',['title' => $state_data->en_name])
        </div>
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow blog-view-card">
                <div class="container">
                    <div class="content-area" id="primary">
                        <article>
                            <div class="inside-article">
                                
                                <h1 class="entry-title entry-title-h1" itemprop="headline">{{$state_data->en_name}}</h1>
                                
                                <div class="entry-meta">
                                        {!! $state_data->about_us !!}
                                </div>
                                
                                <div class="code-block code-block-7" style="margin: 8px 0; clear: both;">
                                    @include('frontend.components.google_source')
                                </div>
                                
                                @includeIf('frontend.Ads.village_view_ads_1')
                                <br/>
                                
                                <div class="entry-content" itemprop="text">
                                    <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                        List Of District in {{$state_data->en_name}}
                                    </h2>
                                    
                                    <hr>
                                    <p>In {{$state_data->en_name}}, villages are categorized based on their population. Here’s a breakdown of the number of villages within each population range:</p>
    
                                   @if ($state_data->districts)
                                        @include('frontend.villageinfo.components.state.district_list', ['districts_data' => $state_data->districts])
                                    @else
                                        <p>Districts data not found.</p>
                                    @endif
                                    
                                    @includeIf('frontend.Ads.village_view_ads_1')
                                    <br/>
                                    @include('frontend.villageinfo.components.state.population_state', [
                                        'en_name' => $state_data->en_name,
                                        'male_rural' => $state_data->male_rural,
                                        'male_urban' => $state_data->male_urban,
                                        'female_rural' => $state_data->female_rural,
                                        'female_urban' => $state_data->female_urban,
                                        'rural_total' => $state_data->rural_total,
                                        'urban_total' => $state_data->urban_total,
                                        'population_density' => $state_data->population_density ?? 'NA'
                                    ])
                                    
                                    @include('frontend.villageinfo.components.state.population_density', [
                                        'en_name' => $state_data->en_name ?? 'NA',
                                        'rural_density' => $state_data->rural_density ?? 'NA',
                                        'urban_density' => $state_data->urban_density ?? 'NA',
                                        'population_density' => $state_data->population_density ?? 'NA'
                                    ])
                                    
                                    @include('frontend.villageinfo.components.state.household', [
                                        'en_name' => $state_data->en_name ?? 'NA',
                                        'rural_household' => $state_data->rural_household ?? 'NA',
                                        'urban_household' => $state_data->urban_household ?? 'NA',
                                        'total_households' => $state_data->total_households ?? 'NA'
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
                        @include('frontend.villageinfo.components.state.state_overview', [
                            'en_name' => $state_data->en_name ?? 'NA',
                            'mr_name' => $state_data->mr_name ?? 'NA',
                            'capital' => $state_data->capital_name ?? 'NA',
                            'established' => $state_data->established ?? 'NA',
                            'total_area' => $state_data->total_area ?? 'NA',
                            'total_villages' => $state_data->total_villages ?? 'NA',
                            'sex_ratio' => $state_data->sex_ratio ?? 'NA',
                            'population_density' => $state_data->population_density ?? 'NA',
                            'court' => $state_data->court ?? 'NA',
                            'total_population' => $state_data->total_population ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="categories-3" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @include('frontend.villageinfo.components.villages_population', [
                            'name' => $state_data->en_name ?? 'NA',
                            'population_1' => $state_data->population_1 ?? 'NA',
                            'population_2' => $state_data->population_2 ?? 'NA',
                            'population_3' => $state_data->population_3 ?? 'NA',
                            'population_4' => $state_data->population_4 ?? 'NA',
                            'population_5' => $state_data->population_5 ?? 'NA',
                            'population_6' => $state_data->population_6 ?? 'NA',
                            'population_7' => $state_data->population_7 ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="block-1" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;height: 280px;">
                        <div class="adtext">Advertisement</div>
                        @includeIf('frontend.Ads.village_sidebar_view_ads_2')
                    </aside>
                    
                    <aside id="block-2" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @include('frontend.villageinfo.components.state.nearest_states', [
                            'name' => $state_data->en_name ?? 'NA',
                            'nearest_states' => $state_data->nearest_states
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
                        @include('frontend.villageinfo.components.state.state_msg', ['name' => $state_data->en_name])
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