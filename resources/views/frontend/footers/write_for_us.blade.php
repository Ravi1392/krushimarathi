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
                                <p>Are you passionate about agricultural schemes, agricultural information, new technologies, useful tips, new updates, online forms, online information, agricultural information, goverment schemes and Latest News? Do you have valuable insights, practical tips, or inspiring stories to share? We invite enthusiastic writers to contribute to our platform in Marathi, English, or Hindi and connect with our diverse, growing audience.</p>

                                <p>By writing for Krushi Marathi, you’ll have the chance to reach thousands of readers, showcase your expertise, and contribute to a vibrant community dedicated to farming, sustainability, and cultural heritage.</p>

                                <h2 class="archive-heading" style="font-size: 26px;">Why Write for Krushi Marathi?</h2>

                                <p>Here’s why contributing to Krushi Marathi is a rewarding opportunity:</p>

                                <p>✅ <strong>Engage a Wide Audience:</strong> Your articles will reach a dedicated readership across Marathi, English, and Hindi-speaking communities interested in agriculture, rural development, and cultural topics.</p>
                                <p>✅ <strong>Establish Your Authority:</strong> Share your knowledge on farming techniques, agribusiness, or rural lifestyles and build your reputation as a thought leader.</p>
                                <p>✅ <strong>Enhance Your Portfolio:</strong> Get published on a trusted platform with bylined articles to strengthen your writing credentials.</p>
                                <p>✅ <strong>Join a Passionate Community:</strong> Connect with writers, farmers, and enthusiasts who value impactful, meaningful content.</p>
                                <p>✅ <strong>Promote Yourself:</strong> Include an author bio with links to your blog, website, or social media to boost your online presence.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_1')
                                
                                <h2 class="archive-heading" style="font-size: 26px;">Submission Guidelines</h2>

                                <p>To ensure your content aligns with our standards, please adhere to these guidelines:</p>
                                <p>✅ <strong>Content Focus:</strong> Articles should focus on agriculture, farming, rural life, Marathi culture, or sustainability. Topics may include modern farming methods, organic agriculture, rural entrepreneurship, traditional practices, or success stories relevant to our audience.</p>

                                <p>✅ <strong>Language:</strong> Submissions are accepted in <strong>Marathi, English, or Hindi</strong>. Ensure clarity and correctness in your chosen language. If approved, we may translate your article to other languages for broader reach.</p>

                                <p>✅ <strong>Originality:</strong> Submit only original content not published elsewhere. Plagiarized or repurposed content will be rejected.</p>

                                <p>✅ <strong>Length:</strong> Articles should be 800–1,500 words to provide depth while remaining engaging.</p>

                                <p>✅ <strong>Tone and Style:</strong> Use a conversational yet informative tone. Content should be well-researched, easy to understand, and appealing to a general audience.</p>

                                <p>✅ <strong>Formatting:</strong> Organize your article with clear paragraphs, headings, and subheadings. Use bullet points or numbered lists where appropriate.</p>

                                <p>✅ <strong>Images:</strong> Include high-quality, relevant images (with proper credits or permissions) to enhance your article’s visual appeal, if possible.</p>

                                <p>✅ <strong>No Promotional Content:</strong> Focus on providing value to readers. Avoid overly promotional content or direct advertisements.</p>

                                @include('frontend.Adsence.InFeed.footer_page_ads_2')

                                <h2 class="archive-heading" style="font-size: 26px;">How to Submit</h2>

                                <p>Ready to share your ideas? Follow these steps:</p>
                                <p>✅ <strong>Pitch Your Idea:</strong> Send a brief outline of your article, including the topic, key points, and its relevance to our audience. Specify your preferred language <strong>(Marathi, English, or Hindi)</strong>.</p>

                                <p>✅ <strong>Submit Your Article:</strong> Upon pitch approval, submit your full article in a Word document or Google Doc. Include an author bio (50–100 words) with a link to your website or social media.</p>

                                <p>✅ <strong>Email Us:</strong> Send your pitch or article to <strong>support@krushimarathi.in</strong> with the subject <strong>“Guest Post Submission – Your Article Topic – Language”</strong>.</p>

                                <p>✅ <strong>Review Process:</strong> Our editorial team will review your submission within 2–3 business days. We may suggest edits to align with our standards.</p>

                                <p>✅ <strong>Publication:</strong> Once approved, your article will be published, and we’ll share the live link with you.</p>

                                <h2 class="archive-heading" style="font-size: 26px;">Contact information</h2>

                                <p>Have questions about contributing to Krushi Marathi?, you can reach me at <strong>support@krushimarathi.in</strong>. Or, you can also contact us through our Contact Us form. For that, go to our Contact Us page –&gt; <a href="{{url('/contact-us')}}" data-type="link" data-id="{{url('/contact-us')}}"><strong style="color: #0000ff;">Contact Us</strong></a>. We’re excited to collaborate with you and showcase your work in Marathi, English, or Hindi!</p>

                                <p>Thank you for visiting the Krushi Marathi website.</p>
                                
                                @include('frontend.Adsence.footer_page_ads_3')
                                
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