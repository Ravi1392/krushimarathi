@extends('frontend.layout.common')

@push('custom-meta')
    @include('frontend.components.home_meta',
        [
            'title' => "आजचा बाजार भाव ( Market Price ) | Todays Bajar Bhav, Market Yard Rates | आजचे शेती मालाचे भाव | भाजीपाला बाजार भाव | आवक व बाजारभाव माहिती | Krushi Marathi", 
            'description' => "आजचे शेती मालाचे बाजार भाव ( Sheti Malache Latest Bajar Bhav ) - महाराष्ट्रातील बाजारसमित्यांमध्ये शेतमालाचे आजचे बाजारभाव काय? याची संपूर्ण माहिती शेतकरी बांधवांना इथे वाचायला मिळले.",
            'canonical' => Request::url(),
            'type' => 'website',
            'data1' =>  config('constants.user_name'),
            'updated_time' =>  $spec_category_info->content_updated_at->toIso8601String(),
            'published_time' => $spec_category_info->content_updated_at->toIso8601String(),
            'modified_time' => $spec_category_info->content_updated_at->toIso8601String(),
            'keywords' => $spec_category_info->meta_keywords,
            'tags' => explode(',', $spec_category_info->meta_keywords)
        ])
@endpush

@push('custom-search_script')
    <script type = "application/ld+json"> 
        {
        "@context": "https://schema.org",
        "@graph": [{
            "@type": ["Person", "Organization"],
            "@id": "{{ url('/#person') }}",
            "name": "Krushi Marathi",
            "sameAs": ["{{ config('constants.facebook') }}", "{{ config('constants.twitter') }}"],
            "logo": {
                "@type": "ImageObject",
                "@id": "{{ url('/#logo') }}",
                "url": "{{asset('public/logo.png')}}",
                "contentUrl": "{{asset('public/logo.png')}}",
                "caption": "Krushi Marathi",
                "inLanguage": "en-US"
            },
            "image": {
                "@type": "ImageObject",
                "@id": "{{ url('/#logo') }}",
                "url": "{{asset('public/logo.png')}}",
                "contentUrl": "{{asset('public/logo.png')}}",
                "caption": "Krushi Marathi",
                "inLanguage": "en-US"
            }
        }, {
            "@type": "WebSite",
            "@id": "{{ url('/#website') }}",
            "url": "{{ url('/') }}",
            "name": "Krushi Marathi",
            "publisher": {
                "@id": "{{ url('/#person') }}"
            },
            "inLanguage": "en-US"
        }, {
            "@type": "BreadcrumbList",
            "@id": "{{ url('/#breadcrumb') }}",
            "itemListElement": [{
                "@type": "ListItem",
                "position": "1",
                "item": {
                    "@id": "{{ url('/') }}",
                    "name": "Home"
                }
            }, {
                "@type": "ListItem",
                "position": "2",
                "item": {
                    "@id": "{{ url()->current() }}",
                    "name": "बाजारभाव"
                }
            }]
        }, {
            "@type": "AboutPage",
            "@id": "{{ url()->current() }}/#webpage",
            "url": "{{ url()->current() }}",
            "name": "बाजारभाव - Krushi Marathi",
            "datePublished": "{{ $spec_category_info->created_at->toIso8601String() }}",
            "dateModified": "{{ $spec_category_info->content_updated_at->toIso8601String() }}",
            "isPartOf": {
                "@id": "{{ url('/#website') }}"
            },
            "inLanguage": "en-US",
            "breadcrumb": {
                "@id": "{{ url()->current() }}/#breadcrumb"
            }
        }]
    } 
    </script>
@endpush

@push('custom-scripts')
    <script>
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });
    </script>
@endpush

@push('custom-css')
    <link href="{{asset('public/assets/front/css/more_for_u_card.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/front/css/ipl/ipl_custome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/front/css/ipl/schedule.css')}}" rel="stylesheet" type="text/css">
    <style>
        .tabs {
            /* display: grid; */
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); /* Auto-fit columns */
            gap: 10px;
        }
        /* Mobile View (screen width <= 768px) */
        @media (max-width: 768px) {
            .tabs {
                display: grid;
                grid-template-columns: repeat(3, 1fr); /* Two columns */
            }
        }

        /* Optional: Adjust for very small screens (e.g., < 480px) */
        @media (max-width: 480px) {
            .tabs {
                display: grid;
                grid-template-columns: repeat(3, 1fr); /* One column */
            }
        }
    </style>
@endpush

@push('ads-script')

    <!--sidebar_ad_code-->
    <script>
        window.googletag = window.googletag || { cmd: [] };
        googletag.cmd.push(function () {
    
        const REFRESH_KEY = 'refresh';
        const REFRESH_VALUE = 'true';
        const SECONDS_TO_WAIT_AFTER_VIEWABILITY = 30;
        
        var desktopAndTabletSizes = [[728, 90]];

        var mobileSizes = [[300, 31], [300, 50], [300, 75], [300, 100], [300, 250], [320, 50], [320, 250], [320, 100], [468, 60]];
        
        var mapping = googletag.sizeMapping()
            .addSize([768, 0], desktopAndTabletSizes)
            .addSize([0, 0], mobileSizes)
            .build();
            
        //-------------Top Ad------------------
        googletag.defineSlot('/23289270189/bajarbhav_ad_top', [[728, 90], [300, 250], [320, 50], [300, 100]], 'div-gpt-ad-1758342315505-0')
            .defineSizeMapping(mapping)
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

@section('content')
<div id="page" class="site grid-container container hfeed">
    <div style="padding-top: 15px;padding-left: 10px;">
        @include('frontend.Ads.bajarbhav_ad_top')
        @include('frontend.components.breadcrumb_bar', ['blog_title' => $spec_category_info->name])
    </div>
    {{-- Bajar Bhav Table --}}
    <div id="content" class="section-padding">
        <div class="sectionWrapper">
            <div class="matches-container">
                <p style="color: white;text-align: center;margin-bottom: 0.5em;">Date :- {{Date("d-m-Y")}}</p>
                <hr style="background-color: rgb(255 255 255 / 67%);height: 1px;margin-bottom: 2px;">
                <!-- Tabs -->
                <div class="tabs">
                    <div class="tab active" title="भाजीपाला" data-tab="भाजीपाला">भाजीपाला</div>
                    <div class="tab" title="फळे" data-tab="फळे">फळे</div>
                    <div class="tab" title="कडधान्य" data-tab="कडधान्य">कडधान्य</div>
                    <div class="tab" title="फुले" data-tab="फुले">फुले</div>
                    <div class="tab" title="तेलबिया" data-tab="तेलबिया">तेलबिया</div>
                    <div class="tab" title="धान्य" data-tab="धान्य">धान्य</div>
                    <div class="tab" title="भुसार" data-tab="भुसार">भुसार</div>
                    <div class="tab" title="मसाले" data-tab="मसाले">मसाले</div>
                    <div class="tab" title="सुकामेवा" data-tab="सुकामेवा">सुकामेवा</div>
                </div>
                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- भाजीपाला Tab -->
                    <div class="tab-pane active" id="भाजीपाला">
                        @if (isset($vegetables) && $vegetables->isNotEmpty())
                            @include('frontend.components.bajarbhav_table', ['crop_rates' => $vegetables])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>
            
                    <!-- फळे Tab -->
                    <div class="tab-pane" id="फळे">
                        @if (isset($fruits) && $fruits->isNotEmpty())
                            @include('frontend.components.bajarbhav_table', ['crop_rates' => $fruits])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>
            
                    <!-- कडधान्य Tab -->
                    <div class="tab-pane" id="कडधान्य">
                        @if (isset($pulses) && $pulses->isNotEmpty())
                            @include('frontend.components.bajarbhav_table', ['crop_rates' => $pulses])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>

                    <!-- फुले Tab -->
                    <div class="tab-pane" id="फुले">
                        @if (isset($flowers) && $flowers->isNotEmpty())
                            @include('frontend.components.bajarbhav_table', ['crop_rates' => $flowers])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>

                     <!-- तेलबिया Tab -->
                     <div class="tab-pane" id="तेलबिया">
                        @if (isset($oilseeds) && $oilseeds->isNotEmpty())
                            @include('frontend.components.bajarbhav_table', ['crop_rates' => $oilseeds])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>

                    <!-- धान्य Tab -->
                    <div class="tab-pane" id="धान्य">
                        @if (isset($grains) && $grains->isNotEmpty())
                            @include('frontend.components.bajarbhav_table', ['crop_rates' => $grains])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>

                    <!-- भुसार Tab -->
                    <div class="tab-pane" id="भुसार">
                        @if (isset($fodder) && $fodder->isNotEmpty())
                            @include('frontend.components.bajarbhav_table', ['crop_rates' => $fodder])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>

                    <!-- मसाले Tab -->
                    <div class="tab-pane" id="मसाले">
                        @if (isset($spices) && $spices->isNotEmpty())
                            @include('frontend.components.bajarbhav_table', ['crop_rates' => $spices])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>

                    <!-- सुकामेवा Tab -->
                    <div class="tab-pane" id="सुकामेवा">
                        @if (isset($dry_fruits) && $dry_fruits->isNotEmpty())
                        @include('frontend.components.bajarbhav_table', ['crop_rates' => $dry_fruits])
                        @else
                            <p class="no-matches">No Records found</p>
                        @endif
                    </div>
                </div>
                <p style="color: white;">बाजारभाव हे बाजारसमित्यांमार्फत शासनाला दिले जातात व ते शासनाकडून आपल्यापर्यंत येतात. शासनाकडून आलेले बाजारभाव इथे पाहायला मिळतील, यात कृषी मराठी कोणतेही बदल करत नाही. याची नोंद घ्यावी.</p>
            </div>
        </div>
    </div>

    @include('frontend.components.more_for_u_card')
    @include('frontend.Adsence.home_page_ads_1')

    <div id="content" class="site-content section-padding">
        <div class="section section--alt main-card-shadow">
            <div class="sectionWrapper">
                <div class="sectionTitlebar sectionTitlebar--hasCta block">
                    <h1 class="sectionTitle archive-heading">बाजारभाव बातम्या</h1>
                </div>
                <div class="container">
                    <div id="blog-list" class="xpress_articleList">
                        @if (isset($bhajarbhav_news))
                            @foreach ($bhajarbhav_news as $bhajarbhav)
                                <article>
                                    <div class="sdn_aboutUs__Card card-shadow">
                                        <div class="media__object media--left">
                                            <div class="xpress_articleImage--full">
                                                <a title="{{$bhajarbhav->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $bhajarbhav->blog_slug]) }}">
                                                    <img width="768" height="432" src="{{ $bhajarbhav->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($bhajarbhav->blog_slug)}}" fetchpriority="high" sizes="(max-width: 768px) 100vw, 768px">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="block-body block-row">
                                            <a title="{{$bhajarbhav->blog_title}}" href="{{ route('blog.view', ['blog_slug' => $bhajarbhav->blog_slug]) }}">
                                                <h2 style="font-size: 16px;margin-bottom: 5px;">{{$bhajarbhav->blog_title}}</h2>
                                            </a>
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