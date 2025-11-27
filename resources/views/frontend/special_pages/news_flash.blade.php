@extends('frontend.layout.common')

@php

    $meta_title = isset($news_flash->newsflashsdata) ? $news_flash->newsflashsdata->last() : null;
    $meta_title1 = $meta_title && is_object($meta_title) ? $meta_title->title : null;
    
    $dateForTitle = now()->format('d F Y');
    $dayHindi = now()->translatedFormat('l');

   
    if ($news_flash) {
        $modifiedAt = $news_flash && $news_flash->max('content_updated_at') ? \Carbon\Carbon::parse($news_flash->max('content_updated_at'))->toIso8601String() : now()->toIso8601String();

        $publishedAt = $news_flash && $news_flash->max('created_at') ? \Carbon\Carbon::parse($news_flash->max('created_at'))->toIso8601String() : now()->toIso8601String();
    } else {
        $modifiedAt = now()->toIso8601String();
        $publishedAt = now()->toIso8601String();
    }
    
    $newsFlash = isset($news_flash->newsflashsdata) ? $news_flash->newsflashsdata->first() : "";
    use Carbon\Carbon;
    $now = Carbon::now();
    if($news_flash->language_id == 1){
        Carbon::setLocale('mr');
        $date = $now->translatedFormat("d F Y, l | \\व\\े\\ळ: h:i A");
        
        $title = "फक्त एका क्लिकमध्ये वाचा {$dateForTitle}, {$dayHindi} च्या महत्वाच्या बातम्या - Latest Breaking News in Marathi {$dateForTitle} - KrushiMarathi";

        $metaDescription = "देश, जग, राज्य, शहर, क्रीडा, आर्थिक आणि बॉलिवूडमधील प्रत्येक मोठी बातमी जाणून घ्या। वाचा {$dateForTitle}, {$dayHindi} च्या ताज्या घडामोडी आणि ब्रेकिंग न्यूज लाईव्ह...";
        
    }elseif($news_flash->language_id == 2){
        Carbon::setLocale('hi');
        $date = $now->translatedFormat("d F Y, l | \\स\\म\\य: h:i A");
        
        $title = "एक क्लिक में पढ़ें {$dateForTitle}, {$dayHindi} की प्रमुख खबरें - Latest Breaking News in Hindi {$dateForTitle} - KrushiMarathi";

        $metaDescription = "देश, दुनिया, राज्य, महानगर, खेल, आर्थिक और बॉलीवुड की हर बड़ी खबर अब एक ही जगह। पढ़ें {$dateForTitle}, {$dayHindi} की ताज़ा अपडेट्स और ब्रेकिंग न्यूज़ लाइव...";
        
    }elseif ($news_flash->language_id == 3) {
        Carbon::setLocale('en');
        $date = $now->translatedFormat("d F Y, l | \\T\\i\\m\\e: h:i A");
        
        $title = "Top Headlines on {$dateForTitle}, {$dayHindi} – Latest Breaking News Updates in Hindi {$dateForTitle} - KrushiMarathi";

        $metaDescription = "Stay updated with the biggest stories from India and the world. Read {$dateForTitle}, {$dayHindi} live news updates on politics, sports, business, entertainment and more...";

    }else {
        Carbon::setLocale('hi');
        $date = $now->translatedFormat("d F Y, l | \\स\\म\\य: h:i A");
        
        $title = "एक क्लिक में पढ़ें {$dateForTitle}, {$dayHindi} की प्रमुख खबरें - Latest Breaking News in Hindi {$dateForTitle} - KrushiMarathi";

        $metaDescription = "देश, दुनिया, राज्य, महानगर, खेल, आर्थिक और बॉलीवुड की हर बड़ी खबर अब एक ही जगह। पढ़ें {$dateForTitle}, {$dayHindi} की ताज़ा अपडेट्स और ब्रेकिंग न्यूज़ लाइव...";
    }

@endphp

@push('custom-meta')
    @include('frontend.components.meta', 
        [
            'title' => $title,  
            'description' => $metaDescription,
            'canonical' => url()->current(),
            'type' => 'Article',
            'img_secure_url' => asset('public/news_flash.webp'),
            'data1' => config('constants.user_name'),
            'section' => 'हिंदी',
            'published_time' => $publishedAt,
            'updated_time' => $modifiedAt,
            'modified_time' => $modifiedAt,
        ])
@endpush

@push('custom-css')
    <style>
        .left-sidebar {
            width: 70%;
        }
        .right-content h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .right-content ul {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 400px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #4CAF50 #f4f4f4;
        }
        /* Styles for WebKit browsers (Chrome, Safari, Edge) */
        .right-content ul::-webkit-scrollbar {
            width: 6px;
        }
        .right-content ul::-webkit-scrollbar-track {
            background: #f4f4f4;
        }
        .right-content ul::-webkit-scrollbar-thumb {
            background-color: #4CAF50;
            border-radius: 10px;
            border: 3px solid #f4f4f4;
        }
        .right-content li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: relative;
            border: 1px solid #ddd;
        }
        .right-content li:hover {
            background-color: #e6e6e6;
        }

        .right-content a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            display: block;
        }
        .right-content .time {
            color: #777;
            font-weight: normal;
            font-size: 12px;
        }
        .right-content p {
            font-size: 16px;
            font-weight: 100;
            line-height: 30px;
            margin: 0;
        }
        .right-content {
            width: 30%;
            /*padding-left: 20px;*/
        }
        .header {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #c04a4a;
            margin: 0 0 10px 0;
        }
        .header h1 span {
            color: red;
        }
        .header img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 16px;
            color: #333;
            margin: 5px 0;
        }
        /*.update-item {*/
        /*    background-color: #fff;*/
        /*    padding: 15px;*/
        /*    border-radius: 5px;*/
        /*    box-shadow: 0 2px 4px rgba(0,0,0,0.1);*/
        /*    margin-bottom: 20px;*/
        /*    position: relative;*/
        /*}*/
        .update-item .time {
            font-size: 12px;
            color: #666;
            display: block;
            margin-bottom: 5px;
        }
        .update-item h2 {
            font-size: 22px;
            color: #000000;
            margin: 5px 0;
        }

        .update-item::before, .update-item::after {
            display: none;
        }

        #backToTopBtn {
            display: none;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            font-size: 1.5rem;
            border: none;
            outline: none;
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            cursor: pointer;
            padding: 1rem;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            transition: opacity 0.3s ease, transform 0.3s ease, background 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            opacity: 0.8;
        }

        #backToTopBtn:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: scale(1.1);
            opacity: 1;
        }

        #backToTopBtn:focus {
            outline: 2px solid #fff;
            outline-offset: 2px;
        }

        #backToTopBtn svg {
            width: 100%;
            height: 100%;
            fill: currentColor;
        }

        @media (max-width: 768px) {
            #page.container {
                flex-direction: column;
                padding: 10px;
            }
            .left-sidebar, .right-content {
                width: 100%;
                padding: 0;
            }
            .left-sidebar {
                border-bottom: 2px solid #ddd;
            }
            .right-content {
                padding-left: 0;
                margin-top: 15px;
            }
            .header h1 {
                font-size: 20px;
            }
            .header p {
                font-size: 12px;
            }
            .update-item .time {
                font-size: 10px;
            }
            .update-item h2 {
                font-size: 14px;
            }
            .update-item p {
                font-size: 12px;
            }
            .update-item .posted-by {
                font-size: 10px;
            }
            .site-content {
                padding-top: 0px;
            }
            .desktop-only {
                display: none !important;
            }

        }
        @media (max-width: 600px) {
            #backToTopBtn {
                bottom: 1.5rem;
                right: 1.5rem;
                width: 50px;
                height: 50px;
                padding: 0.8rem;
            }
        }

        @media (max-width: 400px) {
            #backToTopBtn {
                width: 40px;
                height: 40px;
                padding: 0.6rem;
            }
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
@endpush

@push('custom-scripts')
    <script>
        const backToTopBtn = document.getElementById("backToTopBtn");

        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                backToTopBtn.style.display = 'block';
                backToTopBtn.style.opacity = '0.8';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Keyboard accessibility
        backToTopBtn.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    </script>
@endpush

@push('ads-script')

    <!--sidebar_ad_code-->
    <script>
        window.googletag = window.googletag || { cmd: [] };
        googletag.cmd.push(function () {
    
        const REFRESH_KEY = 'refresh';
        const REFRESH_VALUE = 'true';
        const SECONDS_TO_WAIT_AFTER_VIEWABILITY = 30;
        
        var mapping = googletag.sizeMapping()
            .addSize([1024, 0], [[728, 90], [970, 90]]) // Desktop
            .addSize([768, 0], [[468, 60], [320, 100]]) // Tablet
            .addSize([0, 0], [[300, 250], [320, 100], [320, 50]]) // Mobile
            .build();
            
        //-------------Top Ad------------------
        googletag.defineSlot('/23289270189/bajarbhav_ad_top', [[728, 90], [300, 250], [320, 50], [300, 100]], 'div-gpt-ad-1758342315505-0')
            .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
    
        // --- Sidebar Ad ---
        googletag.defineSlot('/23289270189/sidebar_ad_code', [[300, 250], [320, 50], [300, 100]], 'div-gpt-ad-1758108573729-0')
            // .defineSizeMapping(mapping)
            .setTargeting(REFRESH_KEY, REFRESH_VALUE)
            .addService(googletag.pubads());
    
        // Enable Single Request and Collapse Empty Divs
        googletag.pubads().enableSingleRequest();
        // googletag.pubads().collapseEmptyDivs();
    
        // Auto-refresh after viewable
        googletag.pubads().addEventListener('impressionViewable', function (event) {
          const slot = event.slot;
          if (slot.getTargeting(REFRESH_KEY).indexOf(REFRESH_VALUE) > -1) {
            setTimeout(function () {
              googletag.pubads().refresh([slot]);
            }, SECONDS_TO_WAIT_AFTER_VIEWABILITY * 1000);
          }
        });
    
        googletag.enableServices();
      });
    </script>
@endpush

@push('custom-search_script')

@endpush

@section('content')
    <div id="page" class="site grid-container container hfeed">
        <div style="padding-top: 15px;padding-left: 10px;">
            @include('frontend.Ads.bajarbhav_ad_top')
        </div>
        <div id="content" class="site-content" style="padding-top: 5px;">

            <div class="left-sidebar">
                <div class="header">
                    
                    <h1>{{ $newsFlash ? $newsFlash->title : 'जल्द ही उपलब्ध होंगे…' }}</h1>
                    
                    <span><b>{{ $date }} </b></span>
    
                    <div style="position: relative; display: inline-block;">
                        <img src="{{$news_flash ? $news_flash->news_flash_image : asset('public/news_flash.webp')}}" alt="Breaking News Live Updates Today">
                        <!-- Ad overlay -->
                        <div class="image-ad-overlay desktop-only" 
                             style="position: absolute; bottom: 18px; left: 50%; transform: translateX(-50%);
                                    width: 720px; height: 90px; text-align: center;">
                            <div id="mys-content" style="width: 100%; height: 100%;">
                                @includeIf('frontend.Adsence.image_over_ad')
                            </div>
                        </div>
                    </div>
                

                    @if (isset($news_flash->newsflashsdata) && !empty($news_flash->newsflashsdata) && $news_flash->newsflashsdata->count() > 0)
                        
                        @php
                            $index = 0;
                            $ad_file_counter = 0;
                        @endphp
                        
                        @foreach ($news_flash->newsflashsdata->skip(1) as $newsflashdata)
                        
                            @php $index++; @endphp
                            
                            <div class="update-item">
                                <span class="time"><b>{{date("h:i A", strtotime($newsflashdata->created_at))}}</b></span>
                                <h2>{!!$newsflashdata->title!!}</h2>
                            </div>
                            <hr/>
                            
                            @if ($index % 7 == 0)
                                @php
                                    $ad_number = $ad_file_counter + 1;
                                @endphp
                                
                                @includeIf('frontend.Adsence.blog_view_ads_' . $ad_number) 
                                
                                @php
                                    $ad_file_counter++;
                                @endphp
                            @endif

                        @endforeach
                        
                    @else
                        <div id="nodata" class="update-item">
                            <p style="margin-bottom: unset;"><b>देश, दुनिया, राज्य, महानगर, खेल, आर्थिक और बॉलीवुड में क्या कुछ हुआ? पल-पल की बड़ी जानकारी और महत्वपूर्ण जानकारी मिलना शुरू हो जाएगी। इस पेज पर बार-बार विज़िट करते रहें ताकि कोई भी खबर मिस न हो।</b></p>
                        </div>
                    @endif
                    
                </div>
            </div>

            <div class="right-content widget-area sidebar is-blog-view-right-sidebar" id="right-sidebar">
                <aside id="block-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;">
                    <div class="adtext">Advertisement</div>
                    @includeIf('frontend.Ads.sidebar_ad_code')
                </aside>
                <aside id="categories-2" class="widget inner-padding widget_categories main-card-shadow" style="padding: 10px 10px 10px 10px;">
                    <h2 class="widget-title archive-heading" style="margin-bottom: 10px;">Latest Post</h2>
                    <hr style="margin-bottom: 12px;margin-top: 10px;">
                    @include('frontend.components.other_blogs_column', ['sidebar_blogs' => $sidebar_blogs])
                </aside>
                <aside id="block-3" class="inner-padding widget_block widget_search" style="text-align: -webkit-center;background: #e2e2e2;margin-bottom: 10px;">
                    <div class="adtext">Advertisement</div>
                    @includeIf('frontend.Adsence.sidebar_ad_code')
                </aside>
            </div>

            <button id="backToTopBtn" aria-label="Scroll back to top" title="Back to Top">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 4l-8 8h6v8h4v-8h6z" fill="currentColor"/>
                </svg>
            </button>

        </div>
        
        @if(!$blogs_result->isEmpty())
            <div id="content" class="site-content section-padding">
                <div class="section sdn_sectionAbout main-card-shadow">
                    <div class="sectionWrapper">
                        <div class="container">
                            <h2 class="widget-title archive-heading" style="margin-bottom: 10px;font-size:24px;">Related Blogs</h2>
                            <hr style="margin-bottom: 12px;margin-top: 10px;">
                            <div class="xpress_articleList">
                                @include('frontend.components.other_blogs_row', ['blogs' => $blogs_result])
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
        <!--<div class="gutter-ad right">-->
        
        <!--</div>-->
        
    </div>
@endsection