<!DOCTYPE html>
<html amp lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $webstories->title ?? 'informationkatta' }} - Information Katta</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="amp-story-generator-name" content="AMP-Story-Creator">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    
    <!-- AMP Scripts -->
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <!--<script async custom-element="amp-story-auto-ads" src="https://cdn.ampproject.org/v0/amp-story-auto-ads-0.1.js"></script>-->
    <!--<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>-->
    
    <style amp-custom>
        body {
            font-family: sans-serif;
        }
        amp-story {
            font-family: 'Arial', sans-serif;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 10px;
            width: 40px;
            height: 40px;
            z-index: 10;
        }

        .background-image {
            position: relative;
            width: 100%;
            height: 100vh; /* Full viewport height */
            overflow: hidden; /* Prevent overflow */
        }
        amp-img {
            width: 100%;
            height: auto;
        }
    </style>

</head>
<body>
    
    <amp-story standalone
        title="{{ $webstories->title ?? 'Information Katta' }}"
        publisher="Information Katta"
        publisher-logo-src="{{ asset('public/assets/visual_stories/logo.png') }}"
        poster-portrait-src="{{ isset($webstories->file_name) ? $webstories->file : '' }}">
        
         <!-- Google Tag Manager -->
        <!--<amp-analytics config="https://www.googletagmanager.com/amp.json?id=GTM-PN6X5GZL&gtm.url=SOURCE_URL" data-credentials="include"></amp-analytics>-->
        
        <!-- First page Text -->
        @if (isset($webstories) && !empty($webstories) && ($webstories->type == 'text'))
            <amp-story-page id="page-{{ $webstory->id + 001 }}">
                <amp-story-grid-layer template="vertical" style="align-content: unset;padding: 0px 0px 0px;">
                    @if (isset($webstories->title))
                        <h1>{{ $webstories->title ?? 'Information Katta' }}</h1>
                    @endif
                    @if (isset($webstories->description))
                        <p>{{ $webstories->description ?? 'Information Katta' }}</p>
                    @endif
                    
                    <!-- Logo Overlay -->
                    <amp-img class="logo"
                         src="{{ asset('public/assets/visual_stories/logo.png') }}"
                         alt="Information Katta"
                         width="40"
                         height="40"
                         layout="fixed">
                    </amp-img>
                    </amp-story-grid-layer>
            </amp-story-page>
        @endif

        <!-- Second page Image -->
        @if (isset($webstories) && !empty($webstories) && ($webstories->type == 'image') && !empty($webstories->webstories_data))
            @foreach ($webstories->webstories_data as $webstory)
                <amp-story-page id="page-{{ $webstory->id + 001 }}">
                    <amp-story-grid-layer template="vertical" style="align-content: unset;padding: 0px 0px 0px;">
                        <amp-img src="{{$webstory->file}}" width="720" height="1280" layout="responsive" alt="{{ $webstories->title ?? 'Information Katta' }}"></amp-img>
                        @if (isset($webstories->description))
                            <p>{{ $webstories->description ?? 'Information Katta' }}</p>
                        @endif
                        <amp-img class="logo"
                         src="{{ asset('public/assets/visual_stories/logo.png') }}"
                         alt="Information Katta"
                         width="40"
                         height="40"
                         layout="fixed"></amp-img>
                    </amp-story-grid-layer>
                </amp-story-page>
            @endforeach
        @endif
        
    	<!--<amp-story-auto-ads -->
     <!--       data-ad-client="ca-pub-3711521361842002" -->
     <!--       data-ad-slot="7535951142">-->
     <!--   </amp-story-auto-ads>-->
        
        <!-- Third page video -->
        @if (isset($webstories) && !empty($webstories) && ($webstories->type == 'video') && !empty($webstories->webstories_data))
            @foreach ($webstories->webstories_data as $webstory)
                <amp-story-page id="page-{{ $webstory->id + 001 }}">
                    <amp-story-grid-layer template="vertical" style="align-content: unset;padding: 0px 0px 0px;">
                        <amp-video 
                            width="720" 
                            height="1280" 
                            layout="responsive" 
                            autoplay
                            loop
                            poster="{{ $webstories->file }}"
                            >
                            <source src="{{$webstory->file}}" type="video/mp4" />
                        </amp-video>
                        @if (isset($webstories->description))
                            <p>{{ $webstories->description ?? 'Information Katta' }}</p>
                        @endif
                        <amp-img class="logo"
                         src="{{ asset('public/assets/visual_stories/logo.png') }}"
                         alt="Information Katta"
                         width="40"
                         height="40""
                         layout="fixed"></amp-img>
                    </amp-story-grid-layer>
                </amp-story-page>
            @endforeach
        @endif
      	
    </amp-story>
</body>
</html>