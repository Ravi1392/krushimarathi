@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta', [
        'title' => ucwords(str_replace('-', ' ', $category->category_slug)) .' | Krushi Marathi',
        'description' => $category->meta_description,
        'canonical' => url()->current(),
        'type' => 'web_stories',
        'twitter_card' => 'summary',
        'updated_time' =>  $category->content_updated_at->toIso8601String(),
        'published_time' => $category->created_at->toIso8601String(),
        'modified_time' => $category->content_updated_at->toIso8601String(),
        'data1' =>  config('constants.user_name')
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
        let triggerPoint = documentHeight * 0.50;

        if (scrollTop + windowHeight >= triggerPoint) {
            if (!loading) {
                loading = true;
                page++;
                var category_id = '{{ $category->id }}';
               
                var url = "{{ URL::to('web-story') }}";
                url = url + "/" + category_id + "/" + page;
                
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data && data.length > 0) {
                            loading = false;
                            data.forEach(webstory => {
                                const webstoryUrl = "{{ URL::to('web-story/') }}/" + webstory.slug;

                                const articleHtml = `
                                    <article id="story-${webstory.id}">
                                        <div class="sdn_aboutUs__Card web-stories-home-shadow">
                                            <div class="block-container">
                                                <div class="media__object media--left">
                                                    <div class="xpress_articleImage--full">
                                                        <a title="${webstory.title}" href="${webstoryUrl}" target="_blank">
                                                            <img width="250" height="280" src="${webstory.file}" 
                                                                class="responsive-image attachment-medium_large size-medium_large wp-post-image" alt="${webstory.title}" fetchpriority="high" decoding="async" loading="lazy">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="web-stories-home-content">
                                                    <ul class="entry-meta listInline webstory_ul_font">
                                                        <li class="web-stories-date-font-size">
                                                            ${new Date(webstory.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}
                                                        </li>
                                                    </ul>
                                                    <a title="${webstory.title}" href="${webstoryUrl}" target="_blank">
                                                        <h5 class="web-stories-page-font-size">${webstory.title}</h5>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>`;
                                // Append the article to the blog list
                                $('#webstory-list').append(articleHtml);
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

@section('content')
    <div id="page" class="site grid-container container hfeed">
        <div id="content" class="site-content-width section-padding">
            <div class="section sdn_sectionProfessions" style="padding-bottom: 9px;">
                @include('frontend.components.web_stories_menu',['category_slug' => $category->category_slug,'categories' => $categories])
            </div>
            
            @include('frontend.Adsence.home_page_ads_1')
            
            <div class="section section--alt main-card-shadow">
                <div class="sectionWrapper">
                    <div class="sectionTitlebar sectionTitlebar--hasCta block">
                        <h2 class="sectionTitle archive-heading"><a title="वेब स्टोरीज़" href="{{ url("/", ["category_slug" => 'web-stories']) }}">वेब स्टोरीज़</a> - {{$category->name}}</h2>
                    </div>
                    <div class="container">
                        <div id="webstory-list" class="xpress_articleList virtual-story-grid">
                            @if ($visual_stories->isNotEmpty())
                                @foreach ($visual_stories as $visual_story)
                                    <article>
                                        <div class="sdn_aboutUs__Card web-stories-home-shadow">
                                            <div class="block-container">
                                                <div class="media__object media--left">
                                                    <div class="xpress_articleImage--full">
                                                        <a title="{{$visual_story->title}}" href="{{ route('webstory.show', ['story_slug' => $visual_story->slug]) }}" target="_blank">
                                                            <img width="250" height="280" src="{{$visual_story->file}}" class="responsive-image attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($visual_story->slug)}}" fetchpriority="high"> 
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="web-stories-home-content">
                                                    <ul class="entry-meta listInline webstory_ul_font">
                                                        <li class="web-stories-date-font-size">
                                                            {{Date('F j, Y', strtotime($visual_story->created_at))}}
                                                        </li>
                                                    </ul>
                                                    <a title="{{$visual_story->title}}" href="{{ route('webstory.show', ['story_slug' => $visual_story->slug]) }}" target="_blank">
                                                        <h5 class="web-stories-page-font-size">{{$visual_story->title}}</h5>
                                                    </a>
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
            
            @include('frontend.Adsence.home_page_ads_2')
            
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

