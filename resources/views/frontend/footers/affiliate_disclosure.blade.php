@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', 
        [
            'title' => $category->name .' | Krushi Marathi',
            'description' => $category->meta_description,
            'canonical' => Request::url(),
            'type' => 'website',
            'twitter_card' => 'summary',
            'category_feed' => false,
            'sub_category_feed' => false,
            'footer_page_feed' => true,
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
                                <h1 class="entry-title" style="font-size: 28px;">Affiliate Disclosure</h1>
                            </header>
                            <div class="entry-content" itemprop="text">
                                <p><strong>Effective Date:</strong>&nbsp;17/03/2025</p>
                                <h2 style="font-size: 26px;">1. Affiliate Disclosure for krushimarathi.in</h2>

                                <p>At <strong>krushimarathi.in</strong>, we are committed to providing accurate, trustworthy, and valuable information to our readers. Some of the links on our website may be affiliate links, which means we may receive a small commission if you make a purchase through those links. This commission helps us continue providing free content and does not result in any additional cost to you.</p>
                                
                                
                                <h2 style="font-size: 26px;">2. Purpose of Our Affiliate Partnerships</h2>

                                <p>Our goal is to recommend only those products and services that we genuinely believe can benefit our readers. We only endorse products or services that align with our standards and have either been personally tested or thoroughly researched. Purchases made through our affiliate links help us continue to operate and improve the quality of our content.</p>
                                
                                @includeIf('frontend.Adsence.InFeed.footer_page_ads_1')
                                
                                <h2 style="font-size: 26px;">3. Transparency and Trust</h2>

                                <p>We are committed to being transparent and trustworthy with our readers. Our intention is not to persuade you to make purchases but to offer thorough, reliable information to aid your decision-making process.</p>
                                
                                @includeIf('frontend.Adsence.footer_page_ads_3')
                                
                                <h2 style="font-size: 26px;">4. Note:</h2>

                                <p>Revenue earned from affiliate links and advertisements supports our website’s maintenance and helps us deliver high-quality information and services to our readers.</p>
                                
                                <h2 style="font-size: 26px;">9. Contact Information</h2>

                                <p>If you have any questions or feedback about our affiliate partnerships, feel free to reach out at:</p>
                                <p><strong>Email:</strong> support@krushimarathi.in<br><strong>Phone:</strong>&nbsp;—–</p>
                                <p>Thank you!</p>
                                @includeIf('frontend.Adsence.InFeed.footer_page_ads_4')
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