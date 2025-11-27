@if(isset($market_desk) && !empty($market_desk))
    @foreach ($market_desk as $blog)
        <a title="{{$blog->blog_title}}" href="{{ config('constants.BASE_URL') . route('blog.view', ['blog_slug' => $blog->blog_slug], false) }}">
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
        <h2>Coming Soon...</h2>
    </div>
@endif