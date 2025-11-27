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
                                <h1 class="entry-title" style="font-size: 28px;">Contact Us</h1>
                            </header>
                            <div class="entry-content" itemprop="text">
                                
                                @include('frontend.Adsence.footer_page_ads_1')
                                
                                <p> If you have any questions, suggestions, or would like to get in touch with us for any reason, feel free to reach out.</p>
                                @if(session('success') || session('error'))
                                    @include('frontend.components.success_error_msg',['msg_value' => session('msg_value'), 'msg' => session('msg')]) 
                                @endif
                                <div id="respond" class="comment-respond">
                                    <form action="{{ route('front.saveContactUs') }}" method="POST" id="commentform" class="comment-form">
                                        @csrf
                                        <p class="comment-form-comment">
                                            <input name="name" type="text" placeholder="Your name *" class="input_name_box" required>
                                        </p>
                                        <p class="comment-form-comment">
                                            <input id="email" name="email" type="email" placeholder="Your Email *" class="input_email_box" required>
                                        </p>
                                        <p class="comment-form-comment">
                                            <input name="subject" type="text" placeholder="Subject *" class="input_name_box" required>
                                        </p>
                                        <p class="comment-form-comment" style="margin-bottom: 0px;">
                                            <textarea id="comment" name="comment" cols="8" rows="4" placeholder="Comment"></textarea>
                                        </p>
                                        
                                        <p class="form-submit" style="margin-bottom: 0px;">
                                            <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                                        </p>
                                    </form>
                                </div>

                                <p>Thank you for reaching out, and we appreciate your interest in <b>Krushi Marathi.</b></p>
                                @include('frontend.Adsence.footer_page_ads_2')
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