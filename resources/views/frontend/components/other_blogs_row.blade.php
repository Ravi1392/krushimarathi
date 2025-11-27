@if(isset($blogs) && !empty($blogs))
    @foreach ($blogs as $blog)
        <a title="{{$blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}">
            <div class="sdn_aboutUs__Card">
                <div class="block-body">
                    <div class="wp-block-media-text_new is-stacked-on-mobile">
                        <figure class="wp-block-media-text__media">
                            @if($blog->blogimages)
                                @php
                                    $srcset = $blog->blogimages->map(function ($image) {
                                        return "{$image->file} {$image->width}w";
                                    })->implode(', ');
                                @endphp

                                <img src="{{ $blog->blog_image }}" srcset="{{ $srcset }}" class="wp-other-blogs-img" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" loading="lazy" decoding="async" style="width: 170px; height: 90px;" sizes="(max-width: 768px) 100vw, 170px">
                            @else
                                <img src="{{ $blog->blog_image }}" alt="{{GetSlug($blog->blog_slug)}}" fetchpriority="high" decoding="async" loading="lazy" class="wp-other-blogs-img" style="width: 157.11px; height: 88.38px;">
                            @endif
                        </figure>
                        <h3 class="wp-font_size" style="font-size: 17px; font-weight: 500; color: {{isset($font_color) ? $font_color : '#000000'}}" >{!! StrLimit($blog->blog_title, 14) !!}</h3>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
@else
    <div class="coming-soon-wrapper">
        <h1>Coming Soon...</h1>
    </div>
@endif