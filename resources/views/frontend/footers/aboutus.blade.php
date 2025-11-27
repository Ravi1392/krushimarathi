@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', 
        [
            'title' => $category->name .' | Krushi Marathi',
            'description' => $category->meta_description,
            'canonical' => url()->current(),
            'type' => 'website',
            'twitter_card' => 'summary',
            'updated_time' =>  $category->updated_at->toIso8601String(),
            'published_time'=> $category->created_at->toIso8601String(),
            'modified_time' => $category->updated_at->toIso8601String(),
            'data1' =>  config('constants.user_name')
        ])
@endpush

@push('custom-search_script')

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
        <div id="content" class="section-padding">
            
            @includeIf('frontend.Ads.bajarbhav_ad_top')
            
            <div class="section section--alt main-card-shadow">
                <div class="container">
                    <div class="content-area" id="primary">
                        <div class="inside-article">
                            <header class="entry-header" aria-label="Content">
                                <h1 class="entry-title" style="font-size: 28px;">About Us</h1>
                            </header>
                            <div class="entry-content" itemprop="text">
                                <p>Hello everyone, welcome to <strong>krushimarathi.in</strong>.</p>
                                <p>Our website is designed to provide you with agricultural schemes, agricultural information, new technologies, useful tips, new updates, online forms and online information, agricultural information. We ensure that the information presented here is easy to read, useful and beneficial for your needs.</p>
                                
                                <h2 style="font-size: 26px;">Our goal</h2>

                                <p>We believe that sharing information advances the community. Therefore, we write on topics that suggest solutions to problems. We bring new information to farmers and the general public.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_1')
                                
                                <h2 style="font-size: 26px;">Our services</h2>

                                <ul style="margin-bottom: 1em;font-size: 18px;font-weight: 300;">
                                    <li>Detailed information about agricultural schemes</li>
                                    
                                    <li>Inspiring and informative articles for farmers</li>
                                    
                                    <li>Useful tips and guidance for farmers in the country and the state.</li>
                                    
                                    <li>Information on Government Decisions (GR) issued by the Central Government and State Governments</li>
                                    
                                    <li >About new schemes, new updates, online information, technology information and latest news.</li>
                                </ul>
                                <br/>
                                @include('frontend.Adsence.footer_page_ads_2')
                                
                                <h2 style="font-size: 26px;">Contact information</h2>

                                <p>From the information given above, you must have got complete information about this website. Now I am sharing my contact details with you.</p>

                                <p>If you would like to contact us, you can reach me at <strong>support@krushimarathi.in</strong>. Or, you can also contact us through our Contact Us form. For that, go to our Contact Us page –&gt; <a href="{{url('/contact-us')}}" data-type="link" data-id="{{url('/contact-us')}}"><strong>Contact Us</strong></a></p>

                                <p>Thank you for visiting the krushimarathi website.</p>
                                @include('frontend.Adsence.InFeed.footer_page_ads_3')
                            </div>
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