<!doctype html>
<html ⚡ lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>{{$blog->blog_title}} | Krushi Marathi</title>
    
    <link rel="canonical" href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}">
    <link href="https://fonts.googleapis.com/css?family=Segoe+UI&display=swap" rel="stylesheet">
    
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    
    <style amp-custom>
        /* General Styles */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffffff;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 0 15px;
        }
        h1, h2, h3 {
            color: #333;
            margin: 0;
            font-weight: bold;
        }
        h1 {
            font-size: 24px;
            line-height: 1.2;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 20px;
            margin-top: 0px;
            margin-bottom: 10px;
        }
        h3 {
            font-size: 18px;
        }
        p {
            margin: 0 0 15px 0;
            font-size: 16px;
            line-height: 1.6;
        }
        a {
            color: #276749;
            text-decoration: none;
        }
        img {
            max-width: 100%;
            height: auto;
        }

        /* Header & Menu */
        .header {
            padding: 5px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f7fafc; /* Changed header background color */
            border-bottom: 1px solid #eee;
        }
        .header-logo amp-img {
            margin-left: 0;
        }
        .header-menu {
            margin-right: 0;
        }
        .header-menu a {
            padding: 0 10px;
            font-weight: bold;
            color: #2d3748;
        }

        /* Entry Header and Title Padding */
        .entry-header {
            padding-top: 15px; /* Added padding to the top of the header */
            padding-bottom: 15px;
        }
        .entry-title {
            padding-bottom: 15px; /* Added padding to separate title from meta info */
        }
        .entry-meta-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .entry-meta-info {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
        }
        .entry-meta-info .byline {
            margin-left: 0;
        }
        .byline a {
            color: #2d3748;
            font-weight: bold;
        }
        .posted-on {
            font-size: 14px;
            color: #666;
        }

        /* Social Sharing */
        .social-share {
            display: flex;
            gap: 10px;
        }
        .social-share amp-social-share {
            border-radius: 50%;
            padding: 0;
            background-size: 24px;
            width: 32px;
            height: 32px;
            border: 1px solid #ccc;
        }

        /* Content */
        .featured-image {
            margin-top: 0px;
            margin-bottom: 20px;
        }
        .entry-content {
            padding: 0 0 0 0;
        }

        /* Related Blogs */
        .related-blogs-container {
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .related-blogs-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .related-blog-card {
            width: calc(50% - 7.5px);
            margin-bottom: 15px;
            text-align: center;
        }
        .related-blog-card a {
            display: block;
        }
        .related-blog-card amp-img {
            border-radius: 5px;
        }
        .related-blog-card h3 {
            font-size: 16px;
            margin-top: 5px;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            padding: 20px 0;
            border-top: 1px solid #eee;
        }
        .footer-logo {
            margin-bottom: 10px;
        }
        .footer-logo amp-img {
            height: 28px;
            width: 100px; /* Set a specific width for the logo */
            object-fit: contain;
        }
        .footer-links a {
            margin: 0 5px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            position: relative;
            border: 3px solid #3ea305;
        }
        
        /* Success alert styling */
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        
        /* Optional close button */
        .alert .close {
            position: absolute;
            top: -13px;
            right: 10px;
            color: #000;
            font-size: 44px;
            background: none;
            border: none;
            cursor: pointer;
            opacity: 0.6;
        }
        
        /* On hover, make the close button more visible */
        .alert .close:hover {
            opacity: 1;
        }
        
        .alert a{
            color: #007bff;background-color: transparent;
        }


        /* Mobile specific styles */
        @media (max-width: 600px) {
            .container {
                padding: 0 10px;
            }
            .header {
                flex-direction: column;
                text-align: center;
            }
            .header-logo {
                margin-left: 0;
                margin-bottom: 10px;
            }
            .header-menu {
                margin-right: 0;
            }
            .entry-meta-container {
                flex-direction: column;
                align-items: flex-start;
            }
            .entry-meta-info {
                gap: 5px;
                margin-bottom: 15px;
            }
            .social-share {
                justify-content: flex-start;
            }
            .related-blog-card {
                width: 100%;
            }
            .alert {
                font-size: 13px;
                padding: 10px;
                margin-bottom: 10px;
            }
        
            .alert .close {
        		top: -15px;
                right: 0px;
                font-size: 35px;
            }
        }
    </style>
</head>
<body>
    <amp-auto-ads type="adsense"
        data-ad-client="ca-pub-2316241226563215">
    </amp-auto-ads>
    {{-- Main Header --}}
    <header class="header">
        <a href="{{ url('/') }}" class="header-logo" title="Krushi Marathi Home">
            <amp-img src="{{ asset('public/logo.png') }}" width="260" height="51" alt="Krushi Marathi Logo"></amp-img>
        </a>
        <nav class="header-menu">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/krushi') }}">कृषी</a>
            <a href="{{ url('/maharashtra') }}">महाराष्ट्र</a>
            <a href="{{ url('/national-news') }}">देश</a>
            <a href="{{ url('/technology') }}">टेक्नोलॉजी</a>
            <a href="{{ url('/todays-bajarbhav') }}">बाजारभाव</a>
        </nav>
    </header>

    <div class="container">
        {{-- Main Article Content --}}
        <article>
            <div class="inside-article">
                <header class="entry-header">
                    <h1 class="entry-title">{{$blog->blog_title}}</h1> 
                    <div class="entry-meta-container">
                        <div class="entry-meta-info">
                            <span class="posted-on">
                                <time class="entry-date published" datetime="{{$blog->created_at->format('Y-m-d')}}">{{$blog->created_at->format('F j, Y')}}</time>
                            </span> 
                            <span class="byline">by 
                                <span class="author vcard">
                                    <a class="url fn n" href="{{ Route('auther.info', ['username' => $blog->user->username]) }}">
                                        <span class="author-name">{{$blog->user->full_name}}</span>
                                    </a>
                                </span>
                            </span>
                        </div>
                        <div class="social-share">
                            <amp-social-share type="whatsapp" width="32" height="32" data-param-text="{{$blog->blog_title}} - {{ Request::url() }}"></amp-social-share>
                            <amp-social-share type="facebook" width="32" height="32" data-param-text="{{$blog->blog_title}}" data-param-url="{{ Request::url() }}"></amp-social-share>
                            <amp-social-share type="twitter" width="32" height="32" data-param-text="{{$blog->blog_title}}" data-param-url="{{ Request::url() }}"></amp-social-share>
                        </div>
                    </div>
                </header>
                
                <div class="featured-image">
                    @if(isset($blog->blogimages) && !empty($blog->blogimages))
                        <amp-img 
                            src="{{$blog->blog_image}}"
                            width="1200"
                            height="700"
                            alt="{{$blog->blog_title}}"
                            layout="responsive">
                        </amp-img>
                    @else
                        <amp-img 
                            src="{{$blog->blog_image}}"
                            width="1200"
                            height="700"
                            alt="{{$blog->blog_title}}"
                            layout="responsive">
                        </amp-img>
                    @endif
                </div>

                <div class="entry-meta">
                    <p>{!! $blog->short_description !!}</p>
                </div>
                
                <div class="entry-content">
                    @if (isset($blog->first_title) && !empty($blog->first_title))
                        <h2>{!! $blog->first_title !!}</h2>
                    @endif
                    @if (isset($blog->first_image) && !empty($blog->first_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->first_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    @if (isset($blog->first_description) && !empty($blog->first_description))
                        {!! $blog->first_description !!}
                    @endif
                    
                    @if (isset($blog->second_title) && !empty($blog->second_title))
                        <h2>{!! $blog->second_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->second_image) && !empty($blog->second_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->second_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->second_description) && !empty($blog->second_description))
                        {!! $blog->second_description !!}
                    @endif
                    
                    @if(isset($blog->relatedBlogs) && !empty($blog->relatedBlogs))
                        <div class="alert">
                            <strong>Also read this - </strong>
                            <a href="{{ route('blog.view', ['blog_slug' => $blog->relatedBlogs->blog_slug]) }}" title="{{$blog->relatedBlogs->blog_title}}">
                                <strong>{{$blog->relatedBlogs->blog_title}}</strong>
                            </a>
                        </div>
                    @endif
                    
                    @if (isset($blog->third_title) && !empty($blog->third_title))
                        <h2>{!! $blog->third_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->third_image) && !empty($blog->third_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->third_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->third_description) && !empty($blog->third_description))
                        {!! $blog->third_description !!}
                    @endif
                    
                    @if (isset($blog->fourth_title) && !empty($blog->fourth_title))
                        <h2>{!! $blog->fourth_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->fourth_image) && !empty($blog->fourth_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->fourth_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->fourth_description) && !empty($blog->fourth_description))
                        {!! $blog->fourth_description !!}
                    @endif
                    
                    @if (isset($blog->fifth_title) && !empty($blog->fifth_title))
                        <h2>{!! $blog->fifth_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->fifth_image) && !empty($blog->fifth_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->fifth_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->fifth_description) && !empty($blog->fifth_description))
                        {!! $blog->fifth_description !!}
                    @endif
                    
                    @if (isset($blog->six_title) && !empty($blog->six_title))
                        <h2>{!! $blog->six_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->six_image) && !empty($blog->six_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->six_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->six_description) && !empty($blog->six_description))
                        {!! $blog->six_description !!}
                    @endif
                    
                    @if (isset($blog->seven_title) && !empty($blog->seven_title))
                        <h2>{!! $blog->seven_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->seven_image) && !empty($blog->seven_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->seven_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->seven_description) && !empty($blog->seven_description))
                        {!! $blog->seven_description !!}
                    @endif
                    
                    @if (isset($blog->eight_title) && !empty($blog->eight_title))
                        <h2>{!! $blog->eight_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->eight_image) && !empty($blog->eight_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->eight_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->eight_description) && !empty($blog->eight_description))
                        {!! $blog->eight_description !!}
                    @endif
                    
                    @if (isset($blog->nine_title) && !empty($blog->nine_title))
                        <h2>{!! $blog->nine_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->nine_image) && !empty($blog->nine_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->nine_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->nine_description) && !empty($blog->nine_description))
                        {!! $blog->nine_description !!}
                    @endif
                    
                    @if (isset($blog->ten_title) && !empty($blog->ten_title))
                        <h2>{!! $blog->ten_title !!}</h2>
                    @endif
                    
                    @if (isset($blog->ten_image) && !empty($blog->ten_image))
                        <div class="featured-image">
                            <amp-img src="{{$blog->ten_image}}" width="1200" height="700" alt="{{$blog->blog_title}}" layout="responsive"></amp-img>
                        </div>
                    @endif
                    
                    @if (isset($blog->ten_description) && !empty($blog->ten_description))
                        {!! $blog->ten_description !!}
                    @endif
                    
                    @if (isset($blog->question) && !empty($blog->question))
                        <h2>{!! $blog->question !!}</h2>
                    @endif
                    
                    @if (isset($blog->question_and_answare) && !empty($blog->question_and_answare))
                        {!! $blog->question_and_answare !!}
                    @endif
                    
                     @if(isset($blog->relatedSecondBlogs) && !empty($blog->relatedSecondBlogs))
                        <div class="alert">
                            <strong>Also read this - </strong>
                            <a href="{{ route('blog.view', ['blog_slug' => $blog->relatedSecondBlogs->blog_slug]) }}" title="{{$blog->relatedSecondBlogs->blog_title}}">
                                <strong>{{$blog->relatedSecondBlogs->blog_title}}</strong>
                            </a>
                        </div>
                    @endif
                    {{--  Rest of your blog content here --}}
                    
                    <amp-ad width="100vw" height="320"
                         type="adsense"
                         data-ad-client="ca-pub-2316241226563215"
                         data-ad-slot="5628832244"
                         data-auto-format="rspv"
                         data-full-width="">
                      <div overflow=""></div>
                    </amp-ad>
                    
                </div>
            </div>
        </article>

        {{-- Related Blogs Section --}}
        @if(!$blogs_for_row->isEmpty())
        <div class="related-blogs-container">
            <h2 class="widget-title">Related Blogs</h2>
            <div class="related-blogs-grid">
                @foreach($blogs_for_row as $relatedBlog)
                    <div class="related-blog-card">
                        <a href="{{ route('blog.view', ['blog_slug' => $relatedBlog->blog_slug]) }}">
                            <amp-img src="{{ $relatedBlog->blog_image }}" width="300" height="180" alt="{{ $relatedBlog->blog_title }}" layout="responsive"></amp-img>
                        </a>
                        <h3>
                            <a href="{{ route('blog.view', ['blog_slug' => $relatedBlog->blog_slug]) }}">
                                {{ $relatedBlog->blog_title }}
                            </a>
                        </h3>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        
        {{-- Footer --}}
        <div class="footer">
             <div class="footer-logo">
                 <amp-img src="{{ asset('public/logo.png') }}" alt="Krushi Marathi" width="260" height="51" layout="fixed"></amp-img>
             </div>
             <p>Thank you for reading. Stay connected with <strong>Krushi Marathi</strong>.</p>
             <div class="footer-links">
                <a href="{{ url('/') }}">Home</a> |
                <a href="{{ url('/aboutus') }}">About Us</a> |
                <a href="{{ url('/contact-us') }}">Contact</a> |
                <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
             </div>
             <p style="margin-top: 10px;">© {{date('Y')}} Krushi Marathi. All Rights Reserved.</p>
        </div>

    </div>
</body>
</html>