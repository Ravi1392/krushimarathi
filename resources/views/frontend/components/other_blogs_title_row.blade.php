@if(isset($blogs) && !empty($blogs))
    @foreach ($blogs as $blog)
        <a title="{{$blog->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}">
            <div class="sdn_aboutUs__Card">
                <div class="block-body">
                    <div class="wp-block-media-text_new is-stacked-on-mobile">
                        <h3 class="wp-font_size" style="font-size: 17px; font-weight: 500; color: {{isset($font_color) ? $font_color : '#000000'}}" >{!! $blog->blog_title !!}</h3>
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