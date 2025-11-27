@if(isset($blogs) && !empty($blogs))
    @foreach ($blogs as $blog)
        <article>
            <div class="sdn_aboutUs__Card">
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
                                    srcset="{{ $srcset }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" decoding="async" loading="lazy" sizes="(max-width: 768px) 100vw, 768px">
                            @else
                                <img width="768" height="432" src="{{ $blog->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" decoding="async" loading="lazy">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="block-body block-row">
                    <a title="{{$blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}">
                        <h3 class="category-h3-font">{!! StrLimit($blog->blog_title, 14) !!}</h3>
                    </a>
                </div>
            </div>
        </article>
    @endforeach
    
    <!-- Fill remaining slots with ads if less than 3 blogs -->
    @php
        $blogCount = count($blogs);
        $remainingSlots = 3 - $blogCount;
        $index = 0;
    @endphp

    @if($blogCount < 3)
        @for($i = 0; $i < $remainingSlots; $i++)
            @php $index++; @endphp
            <article>
                <div class="sdn_aboutUs__Card ad-slot">
                    @if($i == 0)
                        @includeIf('frontend.Adsence.InFeed.slot_ads_view_' . $index)
                    @elseif($i == 1)
                        @includeIf('frontend.Adsence.InFeed.slot_ads_view_' . $index)
                    @endif
                </div>
            </article>
        @endfor
    @endif
    
@endif
