@extends('frontend.layout.common')
@push('custom-meta')
    @include('frontend.components.home_meta',
        [
            'title' => $auther_profile->full_name . " | Krushi Marathi", 
            'description' => "I am a writer and developer at Krushi Marathi, where I create insightful content focused on agriculture, technology, and current affairs.",
            'canonical' => url()->current(),
            'type' => 'profile',
            'data1' =>  $auther_profile->full_name,
            'updated_time' =>  now()->toIso8601String(),
            'published_time' => now()->toIso8601String(),
            'modified_time' => now()->toIso8601String()
        ])
@endpush
@push('custom-scripts')
    <script src="{{ config('constants.CDN_BASE') }}/front/js/jquery-3.6.0.min.js" ></script>
    <script>

        let page = 1;
        let loading = false;

        $(window).scroll(function() {
            // Check if we're near the bottom of the page
            let scrollTop = $(window).scrollTop();
            let windowHeight = $(window).height();
            let documentHeight = $(document).height();

            if (scrollTop + windowHeight >= documentHeight - 100) {
                if (!loading) {
                    loading = true;
                    page++;
                    let user_id = '{{ $auther_profile->id }}';
                    
                    $.ajax({
                        url: "{{ route('auther.loadMore', ['user_id' => '__USER_ID__', 'page' => '__PAGE__']) }}"
                        .replace('__USER_ID__', user_id)
                        .replace('__PAGE__', page),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data && data.length > 0) {
                                loading = false;
                                data.forEach(blog => {
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

@push('custom-css')
    <link href="{{ config('constants.CDN_BASE') }}/front/css/more_for_u_card.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div id="page" class="site grid-container container hfeed">
    <div class="section-padding">
        <header class="page-header section section--alt section-padding" aria-label="Page" style="margin-bottom: 0px;">
                
            <h1 class="page-title">
                <img alt="{{$auther_profile->full_name}}" src="{{$auther_profile->file}}" class="avatar avatar-50 photo" height="100" width="100" decoding="async">
                <span class="vcard" style="font-size: 31px;">{{$auther_profile->full_name}}</span>
            </h1>

            <div class="author-info">{!!$auther_profile->profile_desc!!}</div>
        </header>
    </div>
    
    @include('frontend.components.more_for_u_card')
    @include('frontend.Adsence.home_page_ads_1')
    
    @if (isset($auther_blogs) && !empty($auther_blogs) && $auther_blogs->isNotEmpty())
        <div id="content" class="site-content section-padding">
            <div class="section section--alt main-card-shadow">
                <div class="sectionWrapper">
                    <div class="container">
                        <div id="blog-list" class="xpress_articleList">
                            @foreach ($auther_blogs as $auther_blog)
                                <article>
                                    <div class="sdn_aboutUs__Card card-shadow">
                                        <div class="media__object media--left">
                                            <div class="xpress_articleImage--full">
                                                <a title="{{$auther_blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $auther_blog->blog_slug]) }}">
                                                    <img width="768" height="432" src="{{ $auther_blog->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($auther_blog->blog_slug)}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="block-body block-row">
                                            <a title="{{$auther_blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $auther_blog->blog_slug]) }}">
                                                <h2 style="font-size: 16px;margin-bottom: 5px;">{{$auther_blog->blog_title}}</h2>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
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