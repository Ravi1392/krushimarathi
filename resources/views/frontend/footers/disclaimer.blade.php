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
                                <h1 class="entry-title" style="font-size: 28px;">Disclaimer</h1>
                            </header>
                            <div class="entry-content" itemprop="text">
                                <p><strong>Effective Date:</strong>&nbsp;07/02/2025</p>
                                <h2 style="font-size: 26px;">1. Disclaimers for krushimarathi.in</h2>

                                <p>The information provided on <strong>krushimarathi.in</strong> the “Website” is for general informational purposes only. By accessing or using the Website, you agree to be bound by this disclaimer and our terms of use. If you do not agree with this disclaimer, please refrain from using the Website.</p>
                                
                                @include('frontend.Adsence.InFeed.footer_page_ads_1')
                                
                                <h2 style="font-size: 26px;">2. General Information</h2>

                                <p>The content of the Website is intended to offer general information about government schemes, policies, and other related resources. All information provided on this Website is based on publicly available information and other reliable sources. However, we do not guarantee the accuracy, completeness, or reliability of the information, and we strongly encourage visitors to verify any details before making any decisions based on the content.</p>
                                
                                
                                <h2 style="font-size: 26px;">3. No Professional Advice</h2>

                                <p>The content of the Website is not intended to constitute professional advice, and it should not be relied upon as such. You should consult a qualified professional (e.g., financial advisor, government official, or legal expert) for advice specific to your situation.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_2')

                                <h2 style="font-size: 26px;">4. Accuracy of Information</h2>

                                <p>We make every effort to ensure that the information on the Website is up to date and accurate. However, since government policies and schemes are subject to change, we do not make any guarantees regarding the accuracy, timeliness, or completeness of the information. You are encouraged to independently verify any details or updates before acting on them.</p>
                                
                                <h2 style="font-size: 26px;">5. External Links</h2>

                                <p>The Website may contain links to external websites for the convenience of our users. These links are provided solely for informational purposes and do not imply endorsement or approval of the linked website’s content. We are not responsible for the content or privacy practices of third-party websites.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_3')
                                
                                <h2 style="font-size: 26px;">6. Limitation of Liability</h2>

                                <p>In no event shall <strong>krushimarathi.in</strong>, its owners, affiliates, employees, or agents be held liable for any direct, indirect, incidental, consequential, or punitive damages arising from your use or inability to use the Website, or from any errors, omissions, interruptions, or delays in the operation or transmission of the Website’s content.</p>

                                <h2 style="font-size: 26px;">7. Changes to the Disclaimer</h2>

                                <p>We reserve the right to update, amend, or modify this Disclaimer at any time. Any changes will be reflected on this page, and the effective date will be updated accordingly. We encourage you to review this page periodically for any updates.</p>
                                
                                @include('frontend.Adsence.footer_page_ads_4')

                                <h2 style="font-size: 26px;">8. User Responsibility</h2>

                                <p>By accessing the Website, you agree to use the information provided responsibly. You acknowledge that any reliance on the materials, information, or services available on the Website is at your own risk.</p>

                                <h2 style="font-size: 26px;">9. Contact Information</h2>

                                <p>If you have any questions about this Disclaimer or the Website’s content, please contact us at:</p>
                                <p><strong>Email:</strong> support@krushimarathi.in<br><strong>Phone:</strong>&nbsp;—–</p>
                            </div>
                            <br/>
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