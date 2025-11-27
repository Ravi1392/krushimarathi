@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', 
        [
            'title' => $category->name .' - Krushi Marathi',
            'description' => $category->meta_description,
            'canonical' => Request::url(),
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
                                <h1 class="entry-title" style="font-size: 28px;">Write For Us</h1>
                            </header>
                            <div class="entry-content" itemprop="text">
                                <p>Hello everyone, welcome to <strong>Krushi Marathi!</strong>.</p>
                                <p>Partner with us to reach farmers, rural entrepreneurs, and agri-enthusiasts across India.</p>

                                <h2 class="archive-heading" style="font-size: 26px;">Why Advertise on Krushi Marathi?</h2>

                                <p>Welcome to Krushi Marathi, India’s leading platform for agriculture, farming, and rural life. We deliver trusted content on farming, government schemes, agricultural schemes, latest news, rural development, practical farming tips and more in Marathi, English, and Hindi, attracting thousands of visitors from across India. Partner with us to showcase your brand to farmers, rural entrepreneurs, and agri-enthusiasts who rely on our insights.</p>

                                <h2 class="archive-heading" style="font-size: 26px;">Why Advertise on Krushi Marathi?</h2>

                                <p>✅ <strong>Nationwide Reach:</strong> Engage a diverse audience from Maharashtra to every corner of India, passionate about agriculture and rural development.</p>
                                <p>✅ <strong>Multilingual Impact:</strong> Advertise in Marathi, English, or Hindi to connect with readers in their preferred language.</p>
                                <p>✅ <strong>Trusted Platform:</strong> Benefit from our reputation for reliable, farmer-centric content that builds brand credibility.</p>
                                <p>✅ <strong>High Engagement:</strong> Tap into our growing traffic of readers seeking updates on schemes, news, and farming innovations.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_1')
                                
                                <h2 class="archive-heading" style="font-size: 26px;">Who Is Our Audience?</h2>

                                <p><strong>👨‍🌾 Progressive Farmers</strong> adopting new technology and schemes</p>
                                <p><strong>🚜 Agri-startups </strong> and rural business owners</p>
                                <p><strong>🛍️ Buyers of agri-products and rural services</strong></p>
                                <p><strong>🎓 Students, researchers, and professionals in agriculture</strong></p>
                                <p><strong>👩‍🌾 Rural youth and women</strong> interested in government initiatives and empowerment</p>

                                <h2 class="archive-heading" style="font-size: 26px;">📈 Platform Highlights:</h2>

                                <p>✅ <strong>Targeted Readership</strong> of farmers, citizens, youth, and agri-professionals</p>
                                <p>✅ <strong>Content in 3 Languages:</strong> Marathi, Hindi, and English</p>
                                <p>✅ <strong>Strong Organic Reach</strong> via Google Search and social platforms</p>
                                <p>✅ <strong>Popular Topics:</strong> Farming tips, Goverment schemes, Invesment Tips, latest news, agriculture news, scheme updates, agri-news, awareness content, and rural development</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_2')
                                
                                <h2 class="archive-heading" style="font-size: 26px;">Partner With Us</h2>

                                <p>Ready to grow your brand with India’s agricultural community? Contact us to discuss advertising opportunities tailored to your needs.</p>

                                <p><strong>📧 Email: </strong>support@krushimarathi.in<br/>
                                    <strong>🌐 Website: </strong><a href="{{url('/')}}" data-type="link" style="color: #0000ff;">www.krushimarathi.in</a></p>

                                <p>Join Krushi Marathi and let’s cultivate success together!</p>
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