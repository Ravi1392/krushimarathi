@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => $category_info->name .' | '. $sub_category_name . ' | Krushi Marathi',  
        'description' => $sub_category_info->meta_description,
        'sub_category_slug' => $subcategory_slug,
        'canonical' => url()->current(),
        'type' => 'website',
        'published_time'=> $sub_category_info->created_at->toIso8601String(),
        'modified_time' => $sub_category_info->content_updated_at->toIso8601String(),
        'updated_time' =>  $sub_category_info->content_updated_at->toIso8601String(),
        'data1' =>  config('constants.user_name')
    ])
@endpush

@push('custom-search_script')

@endpush

@push('custom-scripts')
    <script src="{{ config('constants.CDN_BASE') }}/front/js/jquery-3.6.0.min.js" ></script>
    
    <script>
        function strLimit(string, wordLimit) {
            const words = string.trim().split(/\s+/);
            if (words.length > wordLimit) {
                
                return words.slice(0, wordLimit).join(' ') + '...';
            }
            return string
        }
    
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
                    loading = true;
                    page++;
                    var category_slug = '{{ $category_slug }}';
                    var sub_category_slug = '{{ $subcategory_slug }}';
                   
                    var url = "{{ URL::to('load-more') }}";
                    url = url + "/" + category_slug + "/" + sub_category_slug + "/" + page;
                    
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data && data.length > 0) {
                                loading = false;
                                data.forEach(blog => {
                                    const limitedDescription = strLimit(blog.short_description, 11);
                                    const blogUrl = "{{ URL::to('/') }}/" + blog.blog_slug;
    
                                    const articleHtml = `
                                    <article id="blog-${blog.id}">
                                        <div class="sdn_aboutUs__Card card-shadow">
                                            <div class="media__object media--left">
                                                <div class="xpress_articleImage--full">
                                                    <a title="${blog.blog_title}" href="${blogUrl}">
                                                        <img width="768" height="432" src="${blog.blog_image}" alt="" fetchpriority="high" decoding="async" loading="lazy" sizes="(max-width: 768px) 100vw, 768px"> 
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="block-body block-row">
                                                <a href="${blogUrl}"><h2 style="font-size: 16px;margin-bottom: 5px;">${blog.blog_title}</h2></a>
                                            </div>
                                        </div>
                                    </article>`;
                                    // Append the article to the blog list
                                    $('#blog-list').append(articleHtml);
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
            @include('frontend.components.breadcrumb_bar', ['category_name' => $category_info->name, 'category_slug' => $category_slug, 'sub_category_name' => $sub_category_name])
        </div>
        
        <div id="content" class="section-padding">
            <br/>
            @includeIf('frontend.Ads.bajarbhav_ad_top')
            @include('frontend.components.ad_banner')
        </div>
        
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow">
                <div class="sectionWrapper">
                    <div class="sectionTitlebar sectionTitlebar--hasCta block">
                        <h1 class="sectionTitle archive-heading">{{$sub_category_name}}</h1>
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
                                                        @if($blog->blogimages)
                                                            @php
                                                                $srcset = $blog->blogimages->map(function ($image) {
                                                                    return "{$image->file} {$image->width}w";
                                                                })->implode(', ');
                                                            @endphp
                        
                                                            <img width="768" height="432" src="{{ $blog->blog_image }}" 
                                                                srcset="{{ $srcset }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px">
                                                        @else
                                                            <img width="768" height="432" src="{{ $blog->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px">
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="block-body block-row">
                                                <a title="{{$blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}">
                                                    <h2 style="font-size: 16px;margin-bottom: 5px;">{{$blog->blog_title}}</h2>
                                                </a>
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

            @include('frontend.Adsence.home_page_ads_3')
            
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

