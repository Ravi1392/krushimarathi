<div class="sectionWrapper">
    <div class="container">
        <div class="xpress_articleList_home xpress_articleList">
            
            @if (isset($latest_blogs) && !empty($latest_blogs))
                @foreach ($latest_blogs as $latest_blog)
                    <article class="block sdn_featuredExcerpt">
                        <div class="block-container">
                            <div class="block-body">
                                <div class="media__container block-row">
                                    <div class="media__object media--left">
                                        <div class="xpress_articleImage--full">
                                            <a  title="{{$latest_blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $latest_blog->blog_slug]) }}">
                                                
                                                <img width="768" height="432" src="{{$latest_blog->blog_image}}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($latest_blog->blog_slug)}}" fetchpriority="high">
                                                
                                            </a>
                                        </div>
                                    </div>
                                    <div class="block-body">
                                        <a title="{{$latest_blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $latest_blog->blog_slug]) }}">
                                            <h2 class="entry-title">{{$latest_blog->blog_title}}</h2>
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