@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => ucwords(str_replace('-', ' ', $spec_category_info->category_slug)) . ' | Krushi Marathi',
        'description' => $spec_category_info->meta_description,
        'canonical' => url()->current(),
        'type' => 'website',
        'updated_time' =>  $spec_category_info->content_updated_at->toIso8601String(),
        'published_time' => $spec_category_info->created_at->toIso8601String(),
        'modified_time' => $spec_category_info->content_updated_at->toIso8601String(),
        'data1' =>  config('constants.user_name')
    ])
@endpush

@push('custom-search_script')

@endpush

@push('custom-scripts')

<script src="{{ config('constants.CDN_BASE') }}/front/js/jquery-3.6.0.min.js" ></script>

<script>
    let page = 1;
    let loading = false;

    $(window).scroll(function () {

        let scrollTop = $(window).scrollTop();
        let windowHeight = $(window).height();
        let documentHeight = $(document).height();
        let triggerPoint = documentHeight * 0.50;

        if (scrollTop + windowHeight >= triggerPoint) {
            if (!loading) {
                loading = true;
                page++;

                $.ajax({
                    url: "{{ route('gallery.loadMore', '') }}/" + page, // Correct dynamic URL
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data && data.length > 0) {
                            loading = false;
                            data.forEach(blog => {
                                const blogUrl = "{{ URL::to('/') }}/" + blog.blog_slug;

                                const articleHtml = `
                                    <article id="blog-${blog.id}">
                                        <div class="sdn_aboutUs__Card card-shadow">
                                            <div class="media__object media--left">
                                                <div class="xpress_articleImage--full" style="position: relative; display: inline-block;">
                                                    <a title="${blog.blog_title}" href="${blogUrl}">
                                                        <img width="768" height="432" src="${blog.blog_image}" alt="${blog.blog_title}" fetchpriority="high" decoding="async" loading="lazy" sizes="(max-width: 768px) 100vw, 768px"> 
                                                    </a>

                                                    <div class="button-row" style="position: absolute; top: 10px; right: 10px; display: flex; gap: 8px;">
                                                        <a href="/blog/${blog.blog_slug}" class="view-btn" title="View blog">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </a>

                                                        <a href="${blog.blog_image}" class="download-btn" title="Download image" download>
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 15V3M12 15L8 11M12 15L16 11M4 13V19C4 20.1 4.9 21 6 21H18C19.1 21 20 20.1 20 19V13"
                                                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </a>
                                                    </div>

                                                </div>
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
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed:", textStatus, errorThrown);
                        loading = true;
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
        @include('frontend.Ads.bajarbhav_ad_top')
        @include('frontend.components.breadcrumb_bar', ['blog_title' => $spec_category_info->name])
    </div>

    <div id="content" class="site-content section-padding">
        <div class="section section--alt main-card-shadow">
            <div class="sectionWrapper">
                <div class="sectionTitlebar sectionTitlebar--hasCta block">
                    <h1 class="sectionTitle archive-heading">Gallery</h1>
                </div>
                <div class="container">
                    <div id="blog-list" class="xpress_articleList">
                        @if (isset($images))
                            @foreach ($images as $image)
                                <article>
                                    <div class="sdn_aboutUs__Card card-shadow">
                                        <div class="media__object media--left">
                                            <div class="xpress_articleImage--full image-container">
                                                <a title="{{$image->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $image->blog_slug]) }}">
                                                    <img width="768" height="432" src="{{ $image->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($image->blog_slug)}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px">
                                                </a>

                                                <div class="button-row">
                                                    <a href="{{ route('blog.view', ['blog_slug' => $image->blog_slug]) }}" class="view-btn" title="View blog">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                    
                                                    <a href="{{ $image->blog_image }}" class="download-btn" title="Download image">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 15V3M12 15L8 11M12 15L16 11M4 13V19C4 20.1 4.9 21 6 21H18C19.1 21 20 20.1 20 19V13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <div class="coming-soon-wrapper">
                                <h1>Coming Soon...</h1>
                            </div>
                        @endif
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