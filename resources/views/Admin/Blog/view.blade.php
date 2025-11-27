
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('frontend.components.meta', 
        [
            'title' => $blog->blog_title,
            'blog_slug' => $blog->blog_slug,
            'description' => $blog->meta_description,
            'canonical' => Request::url(),
            'type' => 'article',
            'img_secure_url' => $blog->blog_image,
            'data1' => $blog->user->name ." ".$blog->user->last_name,
            'section' => $blog->category->name,
            'published_time' => $blog->created_at,
            'updated_time' => $blog->updated_at,
            'modified_time' => $blog->updated_at
        ])
                
        <link rel="icon" href="{{ asset('public/favicon.ico') }}" type="image/x-icon">
        
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="preload" href="https://fonts.gstatic.com/s/mukta/v14/iJWKBXyXfNzjYGVTSmltFdK.ttf" as="font" type="font/woff2" crossorigin="anonymous">
        
        <link href="{{asset('public/assets/front/css/custome.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/front/css/main.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/front/css/style.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/front/css/style.css')}}" rel="stylesheet" type="text/css">
        
        
        <script src="{{asset('public/assets/front/js/jquery.min.js')}}" type="text/javascript" ></script>
        <script src="{{asset('public/assets/front/js/jquery-migrate.min.js')}}" type="text/javascript"></script> 
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <!-- Google Tag Manager -->
        {!! $googleTagInfo !!}
        <!-- End Google Tag Manager -->
    </head>
    <body class="page-template-default wp-custom-logo wp-embed-responsive no-sidebar nav-float-right separate-containers nav-search-enabled header-aligned-left dropdown-hover featured-image-active using-mouse">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MJ77XV6N"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->  
        <div id="page" class="site grid-container container hfeed">
            <div id="content" class="site-content">
                <div class="content-area" id="primary">
                    <main class="site-main" id="main">
                        <article>
                            <div class="inside-article main-card-shadow">
                                <header class="entry-header" aria-label="Content">
                                    <h1 class="entry-title entry-title-h1" itemprop="headline">{{$blog->blog_title}}</h1> 
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <time class="entry-date published" datetime="{{$blog->created_at}}" itemprop="dateModified">{{Date('F j, Y', strtotime($blog->created_at))}}</time>
                                        </span> 
                                        <span class="byline">by 
                                            <span class="author vcard">
                                                <a class="url fn n" href="{{ Route('auther.info', ['username' => $blog->user->username]) }}" title="View Auther Information" rel="author">
                                                    <span class="author-name" itemprop="name">{{$blog->user->name ." ".$blog->user->last_name}}</span>
                                                </a>
                                            </span>
                                        </span>
                                        <span style="float: right;">
                                            @include('frontend.components.social_sharing', ['blog_title' => $blog->blog_title, 'blog_url' => route('blog.view', ['blog_slug' => $blog->blog_slug])])
                                        </span>
                                    </div>
                                </header>
                                <div class="featured-image page-header-image-single grid-container grid-parent">
                                    @if(isset($blog->blogimages) && !empty($blog->blogimages))
                                        @php
                                            $srcset = $blog->blogimages->map(function ($image) {
                                                return "{$image->file} {$image->width}w";
                                            })->implode(', ');
                                        @endphp
                                            <img width="1200" height="700" src="{{$blog->blog_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" fetchpriority="high" srcset="{{ $srcset }}" sizes="(max-width: 1200px) 100vw, 1200px">
                                    @else
                                        <img width="1200" height="700" src="{{$blog->blog_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" fetchpriority="high" sizes="(max-width: 1200px) 100vw, 1200px">
                                    @endif
                                     
                                </div>
                                
                                <div class="entry-meta">
                                    <p class="post-modified-info">
                                        {!! $blog->short_description !!}
                                    </p>
                                </div>
                                
                                <div class="code-block code-block-7" style="margin: 8px 0; clear: both;">
                                    @include('frontend.components.social_group')
                                </div>
                                
                               <div class="entry-content" itemprop="text">
                                    @if (isset($blog->first_title) && !empty($blog->first_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->first_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->first_image) && !empty($blog->first_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->first_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" fetchpriority="high" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
    
                                    @if (isset($blog->first_description) && !empty($blog->first_description))
                                        {!! $blog->first_description !!}
                                    @endif
                                    
                                    @if (isset($blog->second_title) && !empty($blog->second_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->second_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->second_image) && !empty($blog->second_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->second_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" fetchpriority="high" sizes="(max-width: 1200px) 100vw, 1200px" decoding="async" loading="lazy">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->second_description) && !empty($blog->second_description))
                                        {!! $blog->second_description !!}
                                    @endif
                                    
                                    @if(isset($blog->relatedBlogs) && !empty($blog->relatedBlogs))
                                        <div class="alert alert-success" style="border: 3px solid #000000;animation: whatsapp-border-animation 1s infinite;">
                                            <strong>Also read this - </strong>
                                            <a href="{{ route('blog.view', ['blog_slug' => $blog->relatedBlogs->blog_slug]) }}" style="color: #007bff;background-color: transparent;">
                                                <strong>{{$blog->relatedBlogs->blog_title}}</strong>
                                            </a>
                                        </div>
                                    @endif

                                    @if (isset($blog->third_title) && !empty($blog->third_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->third_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->third_image) && !empty($blog->third_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->third_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->third_description) && !empty($blog->third_description))
                                       {!! $blog->third_description !!}
                                    @endif
                                    
                                    @if (isset($blog->fourth_title) && !empty($blog->fourth_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->fourth_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->fourth_image) && !empty($blog->fourth_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->fourth_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->fourth_description) && !empty($blog->fourth_description))
                                        {!! $blog->fourth_description !!}
                                    @endif
                                    
                                    @if (isset($blog->fifth_title) && !empty($blog->fifth_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->fifth_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->fifth_image) && !empty($blog->fifth_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->fifth_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->fifth_description) && !empty($blog->fifth_description))
                                        {!! $blog->fifth_description !!}
                                    @endif
                                    
                                    @if (isset($blog->six_title) && !empty($blog->six_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->six_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->six_image) && !empty($blog->six_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->six_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->six_description) && !empty($blog->six_description))
                                       {!! $blog->six_description !!}
                                    @endif
                                    
                                    @if (isset($blog->seven_title) && !empty($blog->seven_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->seven_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->seven_image) && !empty($blog->seven_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->seven_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->seven_description) && !empty($blog->seven_description))
                                        {!! $blog->seven_description !!}
                                    @endif
                                    
                                    @if (isset($blog->eight_title) && !empty($blog->eight_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->eight_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->eight_image) && !empty($blog->eight_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->eight_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->eight_description) && !empty($blog->eight_description))
                                        {!! $blog->eight_description !!}
                                    @endif
                                    
                                    @if (isset($blog->nine_title) && !empty($blog->nine_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->nine_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->nine_image) && !empty($blog->nine_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->nine_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->nine_description) && !empty($blog->nine_description))
                                       {!! $blog->nine_description !!}
                                    @endif
                                    
                                    @if (isset($blog->ten_title) && !empty($blog->ten_title))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->ten_title}}
                                        </h2>
                                    @endif

                                    @if (isset($blog->ten_image) && !empty($blog->ten_image))
                                        <div class="featured-image page-header-image-single grid-container grid-parent">
                                            <img width="1200" height="700" src="{{$blog->ten_image}}" class="attachment-full size-full wp-post-image" alt="{{$blog->blog_title}}" itemprop="image" decoding="async" fetchpriority="high" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px">
                                        </div>
                                    @endif
                                    
                                    @if (isset($blog->ten_description) && !empty($blog->ten_description))
                                       {!! $blog->ten_description !!}
                                    @endif
                                    
                                    @if (isset($blog->question) && !empty($blog->question))
                                        <h2 class="wp-block-heading wp-block-heading-h2" id="h-dress-for-success">
                                            {{$blog->question}}
                                        </h2>
                                    @endif
                                    
                                    @if (isset($blog->question_and_answare) && !empty($blog->question_and_answare))
                                        {!! $blog->question_and_answare !!}
                                    @endif
                                    
                                    @if(isset($blog->relatedSecondBlogs) && !empty($blog->relatedSecondBlogs))
                                        <div class="alert alert-success" style="border: 3px solid #000000;animation: whatsapp-border-animation 1s infinite;">
                                            <strong>Also read this - </strong>
                                            <a href="{{ route('blog.view', ['blog_slug' => $blog->relatedSecondBlogs->blog_slug]) }}" style="color: #007bff;background-color: transparent;">
                                                <strong>{{$blog->relatedSecondBlogs->blog_title}}</strong>
                                            </a>
                                        </div>
                                    @endif
                                    
                                </div>
                               
                            </div>
                        </article>
                    </main>
                </div>
    
                {{--Right Sidebar --}}
                <div class="widget-area sidebar is-right-sidebar" id="right-sidebar">
                    <div class="inside-right-sidebar">
                        <aside id="categories-2" class="widget inner-padding widget_categories main-card-shadow">
                            <h2 class="widget-title" style="margin-bottom: 10px;">Categories - {{$blog->category->name}}  ( {{ BlogCount($blog->category_id) }} )</h2>
                            @if (isset($sidebar_blogs) && !empty($sidebar_blogs)  && count($sidebar_blogs) > 0)
                                @foreach ($sidebar_blogs as $blog)
                                    <a title="{{$blog->blog_title}}" href="{{ route('admin.blog.view', ['id' => base64_encode($blog->id)]) }}">
                                        <div class="sdn_aboutUs__Card card-shadow" style="margin-bottom: 10px;">
                                            <div class="block-container">
                                                <div class="block-body">
                                                    <div class="wp-block-media-text_new is-stacked-on-mobile">
                                                        <figure class="wp-block-media-text__media" style="width: 260px;">
                                                            @if($blog->blogimages)
                                                                @php
                                                                    $srcset = $blog->blogimages->map(function ($image) {
                                                                        return "{$image->file} {$image->width}w";
                                                                    })->implode(', ');
                                                                @endphp

                                                                <img src="{{ $blog->blog_image }}" 
                                                                    srcset="{{ $srcset }}" class="wp-other-blogs-img" alt="{{$blog->blog_title}}" fetchpriority="high" loading="lazy" decoding="async" style="border-top-right-radius: 0px;border-bottom-left-radius: 8px;width: 157.11px; height: 88.38px;">
                                                            @else
                                                                <img  src="{{ $blog->blog_image }}" alt="{{$blog->blog_title}}" class="wp-other-blogs-img" style="border-top-right-radius: 0px;border-bottom-left-radius: 8px;width: 157.11px; height: 88.38px;" fetchpriority="high" loading="lazy" decoding="async">
                                                            @endif
                                                        </figure>
                                                        <h3 class="wp-font_size" style="font-size: 14px; font-weight: 600;">
                                                            {{$blog->blog_title}}
                                                        </h3>
                                                    </div>
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
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('public/assets/front/js/ssp-checkout-form.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/front/js/core.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/front/js/menu.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/front/js/navigation-search.min.js')}}" type="text/javascript"></script>

    </body>
</html>