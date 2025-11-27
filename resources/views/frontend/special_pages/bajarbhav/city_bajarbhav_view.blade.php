@extends('frontend.layout.common')

@push('custom-meta')
    <title>{{ $cropName }} बाजारभाव – आजचे ताजे बाजारभाव | Krushi Marathi</title>
    <meta name="description" content="आजचे {{$cropName}} बाजारभाव जाणून घ्या. {{$cropName}} Bajar Bhav Today पाहून शेतकरी आपला माल विक्रीस योग्य दर निवडू शकतात."/>
    <link rel="canonical" href="{{url()->current()}}" />
    
    <meta name="url" content="{{url()->current()}}"/>
    <meta name="date" content='{{Date("Y-m-d H:i:s")}}'/>
    <meta property="og:title" content="{{ $cropName }} बाजारभाव – आजचे ताजे बाजारभाव (Live Rates) | Krushi Marathi"/>
    <meta property="og:description" content="आजचे {{$cropName}} बाजारभाव जाणून घ्या. {{$cropName}} Bajar Bhav Today पाहून शेतकरी आपला माल विक्रीस योग्य दर निवडू शकतात."/>
    <meta property="og:url" content="{{url()->current()}}"/>
    
    @if(@getimagesize($crop_image) && !empty($crop_image))
    <meta property="og:image" content="{{$crop_image}}"/>
    <meta property="og:image:secure_url" content="{{$crop_image}}"/>
    @endif
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="720" />
    <meta property="og:image:alt" content="{{ $pageTitle }}"/>
    <meta property="og:updated_time" content='{{now()->toIso8601String()}}'/>
    <meta property="article:published_time" content='{{now()->toIso8601String()}}'/>
    <meta property="article:modified_time" content='{{now()->toIso8601String()}}'/>
    <meta property="og:site_name" content="Krushi Marathi"/>
    <meta property="og:image:type" content="image/webp"/>
    <meta property="og:type" content="article"/>
    <meta property="og:locale" content="mr_IN" />
    <meta property="og:locale:alternate" content="en_US" />
    
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $cropName }} बाजारभाव – आजचे ताजे बाजारभाव (Live Rates) | Krushi Marathi" />
    <meta name="twitter:description" content="आजचे {{$cropName}} बाजारभाव जाणून घ्या. {{$cropName}} Bajar Bhav Today पाहून शेतकरी आपला माल विक्रीस योग्य दर निवडू शकतात."/>
    <meta name="twitter:site" content="{{ config('constants.twitter_creator') }}">
    <meta name="twitter:creator" content="{{ config('constants.twitter_creator') }}">
    <meta name="twitter:image" content="{{ $crop_image }}" />
    <meta name="twitter:label1" content="Written by" />
    <meta name="twitter:data1" content="{{ config('constants.user_name') }}" />
    <meta name="twitter:label2" content="Time to read">
    <meta name="twitter:data2" content="5 minutes">
@endpush

@push('custom-search_script')

@endpush

@push('custom-css')
    <link href="{{ config('constants.CDN_BASE') }}/front/css/bajarbhav.css" rel="stylesheet" type="text/css">
@endpush

@push('ads-script')

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
        @includeIf('frontend.Ads.bajarbhav_ad_top')
    </div>

    <div id="content" class="section-padding bajarbhav">
        <div class="section section--alt" style="padding: unset;">
            <div class="container">
                <div class="content-area" id="primary">
                    <article>
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title text-center" style="margin-bottom: unset;color:#fff;"><b>{{ $pageTitle }}</b></h1>
                            </div>
                            <div class="featured-image page-header-image-single grid-container grid-parent" style="position: relative; display: inline-block;margin-bottom: 20px;">
                                
                                <img width="720" height="700" src="{{$crop_image}}" class="attachment-full size-full wp-post-image" alt="{{ $pageTitle }}" fetchpriority="high">
                                
                                <div class="image-ad-overlay desktop-only" style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);width: 720px; height: 90px; text-align: center;">
                                    <div id="mys-content" style="width: 100%; height: 100%;">
                                        <span style="color: white;">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($bajarbhavData))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" style="font-size: 16px;">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th><b>बाजार समिती</b></th>
                                                <th><b>जात/प्रत</b></th>
                                                <th><b>परिमाण</b></th>
                                                <th><b>आवक</b></th>
                                                <th><b>कमीत कमी दर (रु.)</b></th>
                                                <th><b>जास्तीत जास्त दर (रु.)</b></th>
                                                <th><b>सरासरी दर (रु.)</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $currentDate = null;
                                            @endphp
                                            @foreach ($bajarbhavData as $item)
                                                @if (isset($item['date']) && $item['date'] !== $currentDate)
                                                    <tr>
                                                        <td colspan="7" class="date-row">
                                                            {{ \Carbon\Carbon::parse($item['date'])->locale('mr')->isoFormat('Do MMMM YYYY') }}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $currentDate = $item['date'];
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td>{{ $item['apmc_name'] ?? 'N/A' }}</td>
                                                    <td>{{ $item['variety'] ?? 'N/A' }}</td>
                                                    <td>{{ $item['unit'] ?? 'N/A' }}</td>
                                                    <td class="text-right">{{ $item['min_price'] ?? 'N/A' }}</td>
                                                    <td class="text-right">{{ $item['max_price'] ?? 'N/A' }}</td>
                                                    <td class="text-right">{{ $item['modal_price'] ?? 'N/A' }}</td>
                                                    <td class="text-right">{{ $item['avg_price'] ?? 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info text-center" role="alert">
                                    {{ $dataNotFound }}
                                </div>
                            @endif
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">{{ __('common.bajarbhav_disclaimer_title', [], 'mr') }}</h2>
                            </div>
                            <div class="card-body">
                                <p style="font-size: 17px; margin-bottom: unset;">{{ __('common.bajarbhav_disclaimer', [], 'mr') }}</p>
                            </div>
                        </div>

                        @include('frontend.components.bajarbhav.pik_name', ['crops' => $crops])
                        @include('frontend.components.bajarbhav.city_name', ['cities' => $cities])
                        @include('frontend.components.bajarbhav.bajar_samiti_name', ['samitis' => $samitis])
                    </article>
                </div>
            </div>
        </div>

        <div class="section section--alt main-card-shadow">
            <div class="sectionWrapper">
                <div class="sectionTitlebar sectionTitlebar--hasCta block">
                    <h2 class="sectionTitle archive-heading">ताज्या बातम्या</h2>
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
                                                    <img width="768" height="432" src="{{ $bhajarbhav->blog_image }}" class="attachment-medium_large size-medium_large wp-post-image" alt="{{GetSlug($bhajarbhav->blog_slug)}}" fetchpriority="high">
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
                                <h2>Coming Soon...</h2>
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