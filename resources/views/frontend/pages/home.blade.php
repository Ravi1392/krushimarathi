@extends('frontend.layout.common')
@push('custom-meta')

    @include('frontend.components.home_meta',
        [
            'title' => "Krushi Marathi | Banking, Loan, Credit Card, Market Updates",
            'description' => "Explore expert insights on Banking, Loans, Credit Cards, Market Trends, Stock Market, and Mutual Funds on Krushi Marathi.",
            'canonical' => url()->current(),
            'type' => 'website',
            'data1' =>  config('constants.user_name'),
            'updated_time' =>  "{{now()->toIso8601String()}}",
            'published_time' =>  "{{now()->toIso8601String()}}",
            'modified_time' =>  "{{now()->toIso8601String()}}"
        ])
            
@endpush

@push('custom-search_script')

@endpush

@push('custom-scripts')

<script src="{{ config('constants.CDN_BASE') }}/front/js/jquery-3.6.0.min.js" ></script>
<script>
    $('#subscription-form').on('submit', function (e) {
        e.preventDefault();

        var email = $('#subscriber-email').val();
        var messageBox = $('#subscription-message');
        messageBox.text('').removeClass('error success');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/saveSubscription') }}",
            method: 'POST',
            data: {
                email: email,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    messageBox.text(response.message).addClass('success').css('color', 'Green');
                    $('#subscriber-email').val('');
                } else {
                    messageBox.text(response.message).addClass('error').css('color', 'Red');
                }
                
                setTimeout(function () {
                    messageBox.text('').removeClass('success error').removeAttr('style');
                }, 3000);
            },
            error: function (xhr) {
                let err = xhr.responseJSON?.message || "Something went wrong!";
                messageBox.text(err).addClass('error').css('color', 'Red');
                
                setTimeout(function () {
                    messageBox.text('').removeClass('error').removeAttr('style');
                }, 3000);
            }
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
    <link href="{{ config('constants.CDN_BASE') }}/front/css/ai_sub.css" rel="stylesheet" type="text/css">
    <style>
        .group-card{
            margin-top: 15px;
            margin-bottom: 15px;
            background: #D0E4FE;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .google-source{
            width: 127px;
        }

        @media (max-width: 768px) {
            .group-card{
                margin-top: unset;
                margin-bottom: unset;
            }
            .google-source{
                width: 180px;
            }
        }
    </style>
    
@endpush

@section('content')
<div id="page" class="site grid-container container hfeed">
    
    <div class="section-padding" style="margin-top: 15px;">
        @includeIf('frontend.Ads.bajarbhav_ad_top')
        
        @include('frontend.components.ad_banner')
    </div>
    
    <div class="site-content section-padding">
        <div class="section section--alt latest-margin">
            @include('frontend.components.latest',['latest_blog' => $latest_blogs, 'live_update' => $live_update])
        </div>
        {{--Right Sidebar --}}
        <div class="widget-area section section--alt sidebar is-right-sidebar" id="right-sidebar">
            <div class="inside-right-sidebar-padding">
                <aside id="categories-2" class="widget inner-padding widget_categories">
                    @include('frontend.components.home_sidebar_blogs', ['sidebar_blogs' => $home_sidebar])
                </aside>
            </div>
        </div>
    </div>
    
    <div class="section-padding">
        @include('frontend.components.google_source')
    </div>
    
    {{-- Top Blogs --}}
    @if(!$blogs_for_row->isEmpty())
        <div class="site-content section-padding">
            <div class="section sdn_sectionAbout main-card-shadow" style="background: #129ea9;">
                <div class="sectionWrapper">
                    <div class="container">
                        <h2 class="widget-title archive-heading" style="color:#ffffff;margin-bottom: 10px;font-size:24px;">लोकप्रिय बातम्या</h2>
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
    
    <div class="section-padding">
        <br>
        @include('frontend.components.ai_banner')
    </div>
    
    @include('frontend.Adsence.home_page_ads_2')
    
    {{-- Today's Your City Weather --}}
    @if(!$weather_data->isEmpty())
        <div class="site-content section-padding">
            <div class="section sdn_sectionAbout main-card-shadow" style="background: transparent linear-gradient(180deg, #a6fa9e 30%, #8dabdd 90%) 0% 0% no-repeat padding-box;">
                <div class="sectionWrapper">
                    <div class="sectionTitlebar sectionTitlebar--hasCta block">
                        <a href="{{url('/weather-special')}}" title="हवामान स्पेशल"> 
                         <h2 class="sectionTitle archive-heading">हवामान</h2></a>
                         <div class="sectionTitle--opposite">
                             <a href="{{url('/weather-special')}}" title="हवामान स्पेशल" style="background: #55555e;color: #fff;padding: 2px 10px 5px;border-radius: 25px;">All Cities Weather</a>
                         </div>
                     </div>
                    <div class="container">
                        <div class="xpress_articleList virtual-story-home-grid">
                            @include('frontend.components.top_cities_weather', ['weather_data' => $weather_data, 'font_color' => "#ffffff"])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <div class="section-padding">
        @include('frontend.components.subscription')
    </div>
    
    @include('frontend.Adsence.home_page_ads_3')
    
    {{-- category wise records --}}
    <div class="site-content-width section-padding">
        @if (isset($category_blogs) && !empty($category_blogs))
            @php
                $index = 0;
                $ad_file_counter = 0;
            @endphp
            @foreach ($category_blogs as $category)
                @php $index++; @endphp
                <div class="section sdn_sectionAbout main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="sectionTitlebar sectionTitlebar--hasCta block">
                           <a href="{{ route('front.show', ['slug' => $category->category_slug]) }}"> 
                            <h2 class="sectionTitle archive-heading">{{$category->name}}</h2></a>
                            <div class="sectionTitle--opposite">
                            <a href="{{ route('front.show', ['slug' => $category->category_slug]) }}" style="background: #55555e;color: #fff;padding: 2px 10px 5px;border-radius: 25px;">View All</a>
                            </div>
                        </div>
                        @php
                            $firstHalf = $category['blogs']->slice(0, 3);
                            $secondHalf = $category['blogs']->slice(3, 3);
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
                    @include('frontend.components.more_for_u_card')
                @endif
                
                @if ($index == 4)
                    <div class="site-content section-padding" style="gap: 15px;">
                        <div class="widget-area section section--alt sidebar is-right-sidebar">
                            <div class="inside-right-sidebar-padding">
                                <aside class="widget inner-padding widget_categories">
                                    @include('frontend.components.home_sidebar_blogs', ['sidebar_blogs' => $home_sidebar1])
                                </aside>
                            </div>
                        </div>
                        <div class="widget-area section section--alt sidebar is-right-sidebar">
                            <div class="inside-right-sidebar-padding">
                                <aside class="widget inner-padding widget_categories">
                                    @include('frontend.components.home_sidebar_blogs', ['sidebar_blogs' => $home_sidebar2])
                                </aside>
                            </div>
                        </div>
                        <div class="widget-area section section--alt sidebar is-right-sidebar">
                            <div class="inside-right-sidebar-padding">
                                <aside class="widget inner-padding widget_categories">
                                    @include('frontend.components.home_sidebar_blogs', ['sidebar_blogs' => $home_sidebar3])
                                </aside>
                            </div>
                        </div>
                    </div>
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
        @endif
        @if ((count($category_blogs) <= 0) || (count($category_blogs) <= 1))
            @include('frontend.components.more_for_u_card')
        @endif
    </div>
    
    {{-- market_desk --}}
    <div class="site-content-width section-padding">
        @if (isset($market_desk) && !empty($market_desk))
            <div class="section sdn_sectionAbout main-card-shadow">
                <div class="sectionWrapper">
                    <div class="sectionTitlebar sectionTitlebar--hasCta block">
                        <a href="{{ config('constants.BASE_URL') }}"> 
                            <h2 class="sectionTitle archive-heading">The MarketDesk</h2>
                        </a>
                        <div class="sectionTitle--opposite">
                            <a href="{{ config('constants.BASE_URL') }}" style="background: #55555e;color: #fff;padding: 2px 10px 5px;border-radius: 25px;">View All</a>
                        </div>
                    </div>

                    <div class="container">
                        <div class="xpress_articleList">
                            @include('frontend.components.marketdesk_blogs',['market_desk' => $market_desk])
                        </div>
                    </div>
                </div>
            </div>
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