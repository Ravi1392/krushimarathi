@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => "Krushi Marathi Search Blogs | Latest News In Marathi", 
        'description' => "कृषी, शेती तंत्रज्ञान, पशुपालन, शासकीय योजना, सेंद्रिय शेती आणि अधिक माहिती मिळवा. तज्ज्ञांचे मार्गदर्शन आणि महत्त्वाच्या टिप्स जाणून घ्या.",
        'canonical' => url()->current(),
        'type' => 'website',
        'data1' =>  config('constants.user_name'),
        'updated_time' =>  "2025-06-28T19:51:26+05:30",
        'published_time' =>  "2025-06-28T19:51:26+05:30",
        'modified_time' =>  "2025-06-28T19:51:26+05:30"
    ])
@endpush

@push('custom-scripts')
    <script src="{{ config('constants.CDN_BASE') }}/front/js/jquery-3.6.0.min.js" ></script>
    
    <script>
    
        let page = 1; // Start at the first page
        let loading = false; // Prevent multiple requests
    
        $(window).scroll(function() {
            // Check if we're near the bottom of the page
            let scrollTop = $(window).scrollTop();
            let windowHeight = $(window).height();
            let documentHeight = $(document).height();
            let triggerPoint = documentHeight * 0.50;
    
            if (scrollTop + windowHeight >= triggerPoint) {
                if (!loading) {
                    let query = "{{$query}}";
                    loading = true;
                    page++;
    
                    var url = "{{ URL::to('search/blogs/load-more') }}";
                    url = url + "/"+ page + "/"+ query;
    
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data && data.length > 0) {
                                loading = false;
                                data.forEach(blog => {
                                    //console.log(blog);
                                    const blogUrl = "{{ URL::to('/') }}/" + blog.blog_slug;
    
                                    const articleHtml = `
                                    <article id="blog-${blog.id}">
                                        <div class="sdn_aboutUs__Card card-shadow">
                                            <div class="media__object media--left">
                                                <div class="xpress_articleImage--full">
                                                    <a title="${blog.blog_title}" href="${blogUrl}">
                                                        <img width="768" height="432" src="${blog.blog_image}" alt="${blog.blog_title}" fetchpriority="high" decoding="async" loading="lazy" sizes="(max-width: 768px) 100vw, 768px"> 
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="block-body block-row total_category_body_card">
                                                <a href="${blogUrl}"><h2 style="margin-bottom: 5px;">${blog.blog_title}</h2></a>
                                            </div>
                                        </div>
                                    </article>`;
                                    // Append the article to the blog list
                                    $('#blog-list').append(articleHtml);
                                    //console.log(articleHtml);
                                });
                            } else {
                                // No more blogs to load
                                $(window).off("scroll");
                                loading = true;
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("AJAX request failed:", textStatus, errorThrown);
                            loading = true; // Reset loading flag on error
                        }
                    });
                }
            }
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
    
        // --- Sidebar Ad ---
        googletag.defineSlot('/23289270189/sidebar_ad_code', [[300, 250], [320, 50], [300, 100]], 'div-gpt-ad-1758108573729-0')
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
            <br/>
            @includeIf('frontend.Ads.bajarbhav_ad_top')
        </div>
        <div id="content" class="site-content">
            <div class="section section--alt main-card-shadow">
                <div class="sectionWrapper">
                    <div class="sectionTitlebar sectionTitlebar--hasCta block">
                        <h1 class="sectionTitle">Search Result</h1>
                    </div>
                    <div class="container">
                        <div id="blog-list" class="xpress_articleList">
                            @if ($blogs->isNotEmpty())
                                @foreach ($blogs as $blog)
                                    <article>
                                        <div class="sdn_aboutUs__Card card-shadow">
                                            <div class="media__object media--left">
                                                <div class="xpress_articleImage--full">
                                                    <a title="{{$blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}">
                                                        <img width="768" height="432" src="{{ $blog->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px"> 
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="block-body block-row total_category_body_card">
                                                <a title="{{$blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}">
                                                    <h2 style="margin-bottom: 5px;">{{$blog->blog_title}}</h2>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            @else
                                <div class="coming-soon-wrapper">
                                    <h2>Search Value Not Found...</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{--Right Sidebar --}}
            @if (isset($sidebar_blogs) && !empty($sidebar_blogs))
                <div class="widget-area sidebar is-right-sidebar" id="right-sidebar">
                    <div class="inside-right-sidebar">
                        <aside id="block-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;">
                            <div class="adtext">Advertisement</div>
                            @includeIf('frontend.Ads.sidebar_ad_code')
                        </aside>
                        <aside id="categories-2" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                            <h2 class="widget-title" style="margin-bottom: 10px;">Related Posts</h2>
                            <hr style="margin-bottom: 12px;margin-top: 10px;">
                            @include('frontend.components.other_blogs_column', ['sidebar_blogs' => $sidebar_blogs])
                        </aside>
                        <aside id="block-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;">
                            <div class="adtext">Advertisement</div>
                            @includeIf('frontend.Adsence.sidebar_ad_code')
                        </aside>
                    </div>
                </div>
            @else
                <div class="coming-soon-wrapper">
                    <h2>Coming Soon...</h2>
                </div>
            @endif
            
              @include('frontend.Adsence.home_page_ads_1')
            
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



