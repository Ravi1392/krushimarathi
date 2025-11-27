@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.meta', 
        [
            'title' => $blog->blog_title, 
            'blog_slug' => $blog->blog_slug, 
            'description' => $blog->meta_description,
            'canonical' => url()->current(),
            'type' => 'article',
            'img_secure_url' => $blog->blog_image,
            'data1' => $blog->user->full_name,
            'section' => $blog->category->name,
            'published_time' => $blog->created_at->toIso8601String(),
            'updated_time' => $blog->content_updated_at->toIso8601String(),
            'modified_time' => $blog->content_updated_at->toIso8601String(),
            'amp_url' => url()->current(). '/amp'
        ])
@endpush

@push('custom-search_script')

@endpush

@push('custom-css')
<style>
    .google-source{
        width: 127px;
    }
    
    @media (max-width: 768px) {
        .google-source{
            width: 180px;
        }
        .desktop-only {
            display: none !important;
        }
    }
</style>
@endpush

@push('custom-scripts')
    <script async src="https://platform.twitter.com/widgets.js"></script>
    <script async src="//www.instagram.com/embed.js"></script>
    
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
    
        // --- Sidebar Ad ---
        googletag.defineSlot('/23289270189/sidebar_ad_code', [[300, 250], [320, 50], [300, 100]], 'div-gpt-ad-1758108573729-0')
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
    
        // --- Blog View Ad 2 ---
        googletag.defineSlot('/23289270189/blog_view_ads_2', [[728, 90], [320, 250], [300, 100], [300, 75], [250, 250], [300, 50]], 'div-gpt-ad-1758106579763-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
    
        // --- Blog View Ad 3 ---
        googletag.defineSlot('/23289270189/blog_view_ads_4', [[728, 90], [320, 250], [300, 100], [300, 75], [250, 250], [300, 50]], 'div-gpt-ad-1758108473622-0')
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
        <div style="padding-top: 15px;padding-left: 10px;">
            @includeIf('frontend.Ads.bajarbhav_ad_top')
        	 <br/>
            @include('frontend.components.breadcrumb_bar', ['blog_title' => $blog->blog_title])
        </div>
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow blog-view-card">
                <div class="container">
                    <div class="content-area" id="primary">
                        <article  itemscope itemtype="https://schema.org/Article">
                            <div class="inside-article">
                                <header class="entry-header" aria-label="Content">
                                    <h1 class="entry-title entry-title-h1" itemprop="headline">{{$blog->blog_title}}</h1> 
                                    <div class="entry-meta" style="font-size: 15px;">
                                        <span class="posted-on">
                                            <time class="entry-date published" datetime="{{$blog->created_at}}" itemprop="dateModified">{{Date('F j, Y', strtotime($blog->created_at))}}</time>
                                        </span> 
                                        <span class="byline">by 
                                            <span class="author vcard">
                                                <a class="url fn n" href="{{ Route('auther.info', ['username' => $blog->user->username]) }}" title="View Auther Information" rel="author">
                                                    <span class="author-name" itemprop="name">{{$blog->user->name ." ".$blog->user->last_name}}</span>
                                                </a>
                                            </span>
                                        </span>
                                        <span style="float: right;">
                                            @include('frontend.components.social_sharing', ['blog_title' => $blog->blog_title, 'blog_url' => Request::url()])
                                        </span>
                                    </div>
                                </header>
                                <div class="featured-image page-header-image-single grid-container grid-parent" style="position: relative; display: inline-block;">
                                    @if(isset($blog->blogimages) && !empty($blog->blogimages))
                                        @php
                                            $srcset = $blog->blogimages->map(function ($image) {
                                                return "{$image->file} {$image->width}w";
                                            })->implode(', ');
                                        @endphp
                                            <img width="1200" height="700" src="{{$blog->blog_image}}" class="attachment-full size-full wp-post-image" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" srcset="{{ $srcset }}" sizes="(max-width: 1200px) 100vw, 1200px">
                                    @else
                                        <img width="1200" height="700" src="{{$blog->blog_image}}" class="attachment-full size-full wp-post-image" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" sizes="(max-width: 1200px) 100vw, 1200px">
                                    @endif
                                    
                                    <div class="image-ad-overlay desktop-only" style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);width: 720px; height: 90px; text-align: center;">
                                        <div id="mys-content" style="width: 100%; height: 100%;">
                                            <span style="color: white;">
                                                @includeIf('frontend.Adsence.image_over_ad')
                                            </span>
                                        </div>
                                    </div>
    
                                </div>
                                
                                <div class="entry-meta">
                                    <!--<p class="post-modified-info">-->
                                        {!! $blog->short_description !!}
                                    <!--</p>-->
                                </div>
                                
                                <div class="code-block code-block-7" style="margin: 8px 0; clear: both;">
                                    @include('frontend.components.google_source')
                                </div>
                                
                                @includeIf('frontend.Ads.blog_view_ads_2')
                                <br/>
                                
                                <div class="entry-content" itemprop="text">
                                    @if (isset($blog->first_title) && !empty($blog->first_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->first_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->first_image) && !empty($blog->first_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->first_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" fetchpriority="high" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
    
                                    @if (isset($blog->first_description) && !empty($blog->first_description))
                                        {!! $blog->first_description !!}
                                    @endif
                                    
                                    <div class="code-block code-block-7" style="margin: 8px 0; clear: both;">
                                        @include('frontend.components.social_group')
                                    </div>
                                    
                                    @includeIf('frontend.Adsence.InFeed.blog_view_ads_1')
                                    
                                    @if (isset($blog->second_title) && !empty($blog->second_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->second_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->second_image) && !empty($blog->second_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->second_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" fetchpriority="high" sizes="(max-width: 1200px) 100vw, 1200px" decoding="async" loading="lazy">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->second_description) && !empty($blog->second_description))
                                        {!! $blog->second_description !!}
                                    @endif
                                    
                                    @includeIf('frontend.Ads.blog_view_ads_3')
                                    <br/>
                                    @if(isset($blog->relatedBlogs) && !empty($blog->relatedBlogs))
                                        <div class="alert alert-success" style="border: 3px solid #000000;animation: whatsapp-border-animation 1s infinite;">
                                            <strong>Also read this - </strong>
                                            <a href="{{ route('blog.view', ['blog_slug' => $blog->relatedBlogs->blog_slug]) }}" title="{{$blog->relatedBlogs->blog_title}}" aria-label="Read more about {{$blog->relatedBlogs->blog_title}}"  rel="noopener noreferrer" style="color: #007bff;background-color: transparent;">
                                                <strong>{{$blog->relatedBlogs->blog_title}}</strong>
                                            </a>
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->third_title) && !empty($blog->third_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->third_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->third_image) && !empty($blog->third_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->third_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->third_description) && !empty($blog->third_description))
                                        {!! $blog->third_description !!}
                                        @includeIf('frontend.Adsence.InFeed.blog_view_ads_3')
                                        <br/>
                                    @endif
                                    
                                    @if (isset($blog->fourth_title) && !empty($blog->fourth_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->fourth_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->fourth_image) && !empty($blog->fourth_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->fourth_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->fourth_description) && !empty($blog->fourth_description))
                                        {!! $blog->fourth_description !!}
                                        @includeIf('frontend.Adsence.InFeed.blog_view_ads_2')
                                        <br/>
                                    @endif
                                    
                                    @if (isset($blog->fifth_title) && !empty($blog->fifth_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->fifth_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->fifth_image) && !empty($blog->fifth_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->fifth_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->fifth_description) && !empty($blog->fifth_description))
                                        {!! $blog->fifth_description !!}
                                        @includeIf('frontend.Adsence.InFeed.blog_view_ads_4')
                                    @endif
                                    
                                    @if (isset($blog->six_title) && !empty($blog->six_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->six_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->six_image) && !empty($blog->six_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->six_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->six_description) && !empty($blog->six_description))
                                        {!! $blog->six_description !!}
                                    @endif
                                    
                                    @if (isset($blog->seven_title) && !empty($blog->seven_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->seven_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->seven_image) && !empty($blog->seven_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->seven_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->seven_description) && !empty($blog->seven_description))
                                        {!! $blog->seven_description !!}
                                        @includeIf('frontend.Adsence.InFeed.blog_view_ads_5')
                                    @endif
                                    
                                    @if (isset($blog->eight_title) && !empty($blog->eight_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->eight_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->eight_image) && !empty($blog->eight_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->eight_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->eight_description) && !empty($blog->eight_description))
                                        {!! $blog->eight_description !!}
                                        
                                    @endif
                                    
                                    @if (isset($blog->nine_title) && !empty($blog->nine_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->nine_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->nine_image) && !empty($blog->nine_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->nine_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->nine_description) && !empty($blog->nine_description))
                                        {!! $blog->nine_description !!}
                                        @includeIf('frontend.Adsence.InFeed.blog_view_ads_6')
                                    @endif
                                    
                                    @if (isset($blog->ten_title) && !empty($blog->ten_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->ten_title !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->ten_image) && !empty($blog->ten_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->ten_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->ten_description) && !empty($blog->ten_description))
                                        {!! $blog->ten_description !!}
                                        @includeIf('frontend.Adsence.InFeed.blog_view_ads_7')
                                    @endif
                                    
                                    @if (isset($blog->question) && !empty($blog->question))
                                        <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                            {!! $blog->question !!}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->question_and_answare) && !empty($blog->question_and_answare))
                                        {!! $blog->question_and_answare !!}
                                    @endif
                                    
                                    @if(isset($blog->relatedSecondBlogs) && !empty($blog->relatedSecondBlogs))
                                        <div class="alert alert-success" style="border: 3px solid #000000;animation: whatsapp-border-animation 1s infinite;">
                                            <strong>Also read this - </strong>
                                            <a href="{{ route('blog.view', ['blog_slug' => $blog->relatedSecondBlogs->blog_slug]) }}" rel="noopener noreferrer" title="{{$blog->relatedSecondBlogs->blog_title}}" aria-label="Read more about {{$blog->relatedSecondBlogs->blog_title}}" style="color: #007bff;background-color: transparent;">
                                                <strong>{{$blog->relatedSecondBlogs->blog_title}}</strong>
                                            </a>
                                        </div>
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
                    <aside id="block-2" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;height: 280px;">
                        <div class="adtext">Advertisement</div>
                        @includeIf('frontend.Ads.sidebar_ad_code')
                    </aside>
                    <aside id="categories-2" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Latest Post</h2>
                        <hr style="margin-bottom: 12px;margin-top: 10px;">
                        @include('frontend.components.other_blogs_column', ['sidebar_blogs' => $sidebar_blogs])
                    </aside>
                    <aside id="categories-3" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                        @include('frontend.components.whatsapp_qr_code')
                    </aside>
                    <aside id="block-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;height: 280px;">
                        @includeIf('frontend.Adsence.sidebar_ad_code')
                    </aside>
                </div>
            </div>
        </div>
        
        <div class="site-content section-padding">
            <div class="section section--alt main-card-shadow blog-view-card">
                <div class="inside-article main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="container">
                            <div class="xpress_articleList" style="grid-template-columns: repeat(1, 1fr);">
                                <h2 class="wp-block-heading wp-block-heading-h2 archive-heading">
                                    Leave a Comment
                                </h2>
                            </div>
                            @include('frontend.components.comments', ['blog_id' => $blog->id, 'comments' => $blog->comments, 'totalComments' => $totalComments])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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