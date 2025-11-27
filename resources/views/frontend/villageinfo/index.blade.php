@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta',
        [
            'title' => "Indian Village Directory - Krushi Marathi", 
            'description' => "KrushiMarathi.in provides Indian Village related information like Map, Population and PinCode etc.",
            'canonical' => Request::url(),
            'type' => 'article',
            'data1' =>  "Krushi Marathi",
            'updated_time' =>  $country_data->content_updated_at->toIso8601String(),
            'published_time'=> $country_data->created_at->toIso8601String(),
            'modified_time' => $country_data->content_updated_at->toIso8601String()
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
        </div>
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow blog-view-card">
                <div class="container">
                    <div class="content-area" id="primary">
                        <article>
                            <div class="inside-article">
                                
                                <h1 class="entry-title entry-title-h1" itemprop="headline">{{$country_data->name}}</h1>
                                
                                <div class="entry-meta">
                                        {!! $country_data->about_us !!}
                                </div>
                                
                                <div class="code-block code-block-7" style="margin: 8px 0; clear: both;">
                                    @include('frontend.components.google_source')
                                </div>
                                
                                @includeIf('frontend.Ads.village_view_ads_1')
                                <br/>
                                
                                <div class="entry-content" itemprop="text">
                                    <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                        List of States and Union Territories of {{$country_data->name}}
                                    </h2>
                                    
                                    <p>Select a State or Union Territory to view its districts and villages.</p>
    
                                    @if (isset($country_data->states) && !empty($country_data->states))
                                        @include('frontend.villageinfo.components.country.state_list', ['states_data' => $country_data->states])
                                    @else
                                        <p>State data not found.</p>
                                    @endif
                                    
                                    
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
                        @include('frontend.villageinfo.components.country.country_overview', [
                            'name' => $country_data->name ?? 'NA',
                            'capital' => $country_data->capital_name ?? 'NA',
                            'total_towns' => $country_data->total_towns ?? 'NA',
                            'total_villages' => $country_data->total_villages ?? 'NA',
                            'total_area' => $country_data->total_area ?? 'NA',
                            'households' => $country_data->households ?? 'NA',
                            'population_density' => $country_data->population_density ?? 'NA',
                            'court' => $country_data->court ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="categories-3" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @include('frontend.villageinfo.components.villages_population', [
                            'name' => $country_data->name ?? 'NA',
                            'population_1' => $country_data->population_1 ?? 'NA',
                            'population_2' => $country_data->population_2 ?? 'NA',
                            'population_3' => $country_data->population_3 ?? 'NA',
                            'population_4' => $country_data->population_4 ?? 'NA',
                            'population_5' => $country_data->population_5 ?? 'NA',
                            'population_6' => $country_data->population_6 ?? 'NA',
                            'population_7' => $country_data->population_7 ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="block-1" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;height: 280px;">
                        <div class="adtext">Advertisement</div>
                        @includeIf('frontend.Ads.village_sidebar_view_ads_2')
                    </aside>
                    
                    <aside id="block-2" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                       @include('frontend.villageinfo.components.country.population_data', [
                            'total_population' => $country_data->total_population ?? 'NA',
                            'male_population' => $country_data->male_population ?? 'NA',
                            'female_population' => $country_data->female_population ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="block-3" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @include('frontend.villageinfo.components.country.villages_data', [
                            'inhabited' => $country_data->inhabited ?? 'NA',
                            'uninhabited' => $country_data->uninhabited ?? 'NA'
                        ])
                    </aside>
                    
                    <aside id="block-4" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @if (isset($other_countries) && !empty($other_countries) && $other_countries->isNotEmpty())
                            @include('frontend.villageinfo.components.country.other_countries', ['other_countries' => $other_countries])
                        @endif
                    </aside>
                    
                    <aside id="block-5" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Other Post</h2>
                        <hr style="margin-bottom: 12px;margin-top: 10px;">
                        @include('frontend.components.other_blogs_column', ['sidebar_blogs' => $sidebar_blogs])
                    </aside>
                    
                </div>
            </div>
        </div>
        
        @if ($country_data->code == "IN")
            <div class="site-content section-padding">
                <div class="section sdn_sectionAbout main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="container">
                            @include('frontend.villageinfo.components.country.country_msg', ['name' => $country_data->name])
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @if ($country_data->profilepoliticians->isNotEmpty())
            
            <div class="section-padding">
                <div class="section sdn_sectionAbout main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="container">
                            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;font-size:24px;">Council of Ministers of {{$country_data->name}} – Complete List with Portfolios</h2>
                            <hr style="margin-bottom: 12px;margin-top: 10px;">
                            @include('frontend.villageinfo.components.country.ministers_list', ['profilepoliticians' => $country_data->profilepoliticians])
                        </div>
                    </div>
                </div>
            </div>
            
        @endif
        
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