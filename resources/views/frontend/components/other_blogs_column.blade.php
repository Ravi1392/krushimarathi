@if (isset($sidebar_blogs) && !empty($sidebar_blogs)  && count($sidebar_blogs) > 0)
    @foreach ($sidebar_blogs as $blog)
        <a title="{{$blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}">
            <div class="sdn_aboutUs__Card" style="margin-bottom: 14px;">
                <div class="block-body">
                    <div class="wp-block-media-text_new is-stacked-on-mobile">
                        <figure class="wp-block-media-text__media">
                            @if($blog->blogimages)
                                @php
                                    $srcset = $blog->blogimages->map(function ($image) {
                                        return "{$image->file} {$image->width}w";
                                    })->implode(', ');
                                @endphp

                                <img src="{{ $blog->blog_image }}" 
                                    srcset="{{ $srcset }}" class="wp-other-blogs-img" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" loading="lazy" decoding="async" style="width: 170px; height: 90px;" sizes="(max-width: 768px) 100vw, 170px">
                            @else
                                <img  src="{{ $blog->blog_image }}" alt="{{GetSlug($blog->blog_slug)}}" class="wp-other-blogs-img" style="width: 170px; height: 90px;" fetchpriority="high" loading="lazy" decoding="async">
                            @endif
                        </figure>
                        <h2 class="wp-font_size" style="font-size: 16px; font-weight: 500;">{!! StrLimit($blog->blog_title, 14) !!}</h2>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    
    @includeIf('frontend.Adsence.InFeed.feed_sidebar_slot_ads_view_1')
    
@else
    <div class="coming-soon-wrapper">
        <h1>Coming Soon...</h1>
    </div>
@endif

