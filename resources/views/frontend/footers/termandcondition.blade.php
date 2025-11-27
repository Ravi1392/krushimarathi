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
                                <h1 class="entry-title" style="font-size: 28px;">Terms and Conditions</h1>
                            </header>
                            <div class="entry-content" itemprop="text">
                                <p><strong>Effective Date:</strong>&nbsp;07/02/2025</p>

                                <p>Welcome to&nbsp;<strong>krushimarathi.in</strong>! By accessing and using this website (the “Site”), you agree to comply with and be bound by the following terms and conditions (“Terms”). If you do not agree with these Terms, please refrain from using the Site.</p>

                                <h2 style="font-size: 26px;">1. Acceptance of Terms</h2>

                                <p>By visiting and using this Site, you agree to abide by these Terms and any additional terms and conditions posted on the Site. These Terms may be updated periodically, and we recommend reviewing them regularly. The “Effective Date” at the top of this page reflects the most recent update.</p>
                                
                                <h2 style="font-size: 26px;">2. Use of the Site</h2>

                                <p>You agree to use this Site only for lawful purposes. You will not use the Site in any way that could damage, disable, overburden, or impair the Site or interfere with any other party’s use of the Site.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_1')
                                
                                <h2 style="font-size: 26px;">3. Intellectual Property Rights</h2>

                                <p>All content on this Site, including but not limited to text, images, graphics, logos, videos, and other material (collectively “Content”), is the property of&nbsp;<strong><strong>krushimarathi.in</strong></strong>&nbsp;or its content providers and is protected by copyright laws. You may not copy, reproduce, distribute, transmit, display, or create derivative works from the Content without prior written consent.</p>
                                
                                <h2 style="font-size: 26px;">4. User-Generated Content</h2>

                                <p>If you submit any content to the Site, including comments, suggestions, or questions, you grant&nbsp;<strong><strong><strong>krushimarathi.in</strong></strong></strong>&nbsp;a non-exclusive, royalty-free, perpetual, and irrevocable license to use, edit, modify, and publish that content in any media, now known or hereafter developed, for any purpose. You represent and warrant that you own or control the rights to the content you submit.</p>
                                
                                 @include('frontend.Adsence.InFeed.footer_page_ads_2')

                                <h2 style="font-size: 26px;">5. Accuracy of Information</h2>

                                <p>The information provided on this Site is for general informational purposes only. While we strive to provide accurate and up-to-date content, we make no warranties or representations regarding the accuracy, completeness, or timeliness of the information. We encourage you to verify any information independently before acting on it.</p>
                                
                                <h2 style="font-size: 26px;">6. Links to Third-Party Websites</h2>

                                <p>This Site may contain links to third-party websites. These links are provided for your convenience and informational purposes. We do not control or endorse the content of these external sites and are not responsible for their availability, legality, or accuracy. Visiting these third-party websites is at your own risk.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_3')
                                
                                <h2 style="font-size: 26px;">7. Limitation of Liability</h2>

                                <p>To the maximum extent permitted by law,&nbsp;<strong><strong><strong><strong>krushimarathi.in</strong></strong></strong></strong>&nbsp;and its affiliates shall not be liable for any direct, indirect, incidental, special, consequential, or punitive damages arising out of or related to your use of or inability to use the Site, including any damages resulting from errors or omissions in the content.</p>

                                <h2 style="font-size: 26px;">8. Privacy Policy</h2>

                                <p>Your use of this Site is governed by our <strong><a href="{{ url('/privacy-policy') }}" data-type="link">Privacy Policy</a></strong> (which should be a separate link to your Privacy Policy page). Please review our Privacy Policy to understand how we collect, use, and protect your personal information.</p>
                                
                                <h2 style="font-size: 26px;">9. Indemnification</h2>

                                <p>You agree to indemnify, defend, and hold harmless&nbsp;<strong><strong><strong><strong><strong>krushimarathi.in</strong></strong></strong></strong></strong>, its affiliates, officers, employees, agents, and other partners from any claims, damages, liabilities, or expenses (including attorneys’ fees) arising from your use of the Site or violation of these Terms.</p>

                                <h2 style="font-size: 26px;">10. Termination</h2>

                                <p>We reserve the right, at our sole discretion, to suspend or terminate your access to the Site at any time, without notice, for any reason, including if you violate these Terms.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_4')

                                <h2 style="font-size: 26px;">11. Governing Law</h2>

                                <p>These Terms are governed by and construed in accordance with the laws of India, without regard to its conflict of law principles. Any dispute arising under or in connection with these Terms will be subject to the exclusive jurisdiction of the courts in Dhule.</p>
                                
                                <h2 style="font-size: 26px;">12. Changes to Terms</h2>

                                <p>We reserve the right to update, modify, or change these Terms at any time. Any changes will be effective immediately upon posting on this page. We encourage you to review this page periodically to stay informed of any updates.</p>

                                <h2 style="font-size: 26px;">13. Legal Disclaimer</h2>

                                <p><strong>Note</strong>: This is a general template and should be customized to fit the specific needs of your website. Depending on the legal requirements of your jurisdiction, you might want to consult a legal professional to ensure your terms and conditions are fully compliant with applicable laws.</p>
                                
                                @include('frontend.Adsence.InFeed.footer_page_ads_5')
                                
                                <h2 style="font-size: 26px;">14. Contact Information</h2>

                                <p>If you have any questions about these Terms &amp; Conditions, please contact us via email at</p>
                                <p><strong>Email:</strong> support@krushimarathi.in<br><strong>Address:</strong>&nbsp;Dhule, Maharashtra, India – 425407</p>

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