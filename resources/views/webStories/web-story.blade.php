<!DOCTYPE html>
<html amp lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{ $webstories->title ?? 'Krushi Marathi' }} - Krushi Marathi</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="amp-story-generator-name" content="AMP-Story-Creator">
    <link rel="icon" href="{{ asset('public/favicon.ico') }}" type="image/x-icon">
    
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

    <!-- AMP Scripts -->
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <script async custom-element="amp-story-auto-ads" src="https://cdn.ampproject.org/v0/amp-story-auto-ads-0.1.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet" />
    <style amp-custom>
        amp-story {
            font-family: "Oswald", sans-serif;
            color: #fff;
        }
        amp-story-page {
            background-color: #000;
        }
        h1 {
            font-weight: bold;
            font-size: 1.5em;
            font-weight: 700;
            line-height: 1.500;
        }
        p {
            font-weight: normal;
            font-size: 1em;
            line-height: 1.5em;
            color: #fff;
        }
        q {
            font-weight: 300;
            font-size: 1.1em;
        }
        amp-story-grid-layer.bottom {
            align-content: end;
        }
        amp-story-grid-layer.noedge {
            padding: 0px;
        }
        amp-story-grid-layer.center-text {
            align-content: center;
        }
        .wrapper {
            display: grid;
            grid-template-columns: 50% 50%;
            grid-template-rows: 50% 50%;
        }
        .banner-text {
            text-align: center;
            background-color: #000;
            line-height: 2em;
        }
        .logo {
            position: absolute;
            top: 15px;
            left: 12px;
            width: 40px;
            height: 40px;
            z-index: 10;
        }
        .righ-corner{
            text-align: right;
            font-size: 12px;
        }
    </style>
  </head>

  <body>
    <amp-story
      standalone
      title="{{ $webstories->title ?? 'Krushi Marathi' }}"
      publisher="Krushi Marathi"
      publisher-logo-src="{{ asset('public/assets/visual_stories/logo.png') }}"
      poster-portrait-src="{{ isset($webstories->file_name) ? $webstories->file : '' }}"
    >
      <!-- Place amp-story-auto-ads inside amp-story -->
      <amp-story-auto-ads>
        <script type="application/json">
          {
            "ad-attributes": {
              "type": "adsense",
              "data-ad-client": "ca-pub-2316241226563215",
              "data-ad-slot": "5628832244"
            }
          }
        </script>
      </amp-story-auto-ads>

      <!-- Cover page -->
      <amp-story-page id="cover">
        <amp-story-grid-layer template="fill">
          <amp-img
            src="{{$webstories->file}}"
            width="720"
            height="1280"
            layout="responsive"
          >
          </amp-img>
        </amp-story-grid-layer>
        <amp-story-grid-layer template="vertical">
          <h1>{{$webstories->title}}</h1>
          <p>By {{$webstories->description}}</p>
          <amp-img class="logo"
            src="{{ asset('public/assets/visual_stories/logo.png') }}"
            alt="Krushi Marathi"
            width="30"
            height="30"
            layout="fixed">
          </amp-img>
        </amp-story-grid-layer>
      </amp-story-page>

      @if (isset($webstories) && !empty($webstories) && !empty($webstories->webstories_data))
        @foreach ($webstories->webstories_data as $key => $webstories_data)
          @if ($webstories_data->value == "image1")
            <amp-story-page id="page2">
              <amp-story-grid-layer template="fill">
                <amp-img
                  src="{{ $webstories_data->file }}"
                  width="720"
                  height="1280"
                  layout="responsive"
                >
                </amp-img>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical">
                <h1>{{ $webstories_data->story_title }}</h1>
                <amp-img class="logo"
                  src="{{ asset('public/assets/visual_stories/logo.png') }}"
                  alt="Krushi Marathi"
                  width="30"
                  height="30"
                  layout="fixed">
                </amp-img>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical" class="bottom">
                <q>{{ $webstories_data->story_description }}</q>
                <p class="righ-corner">Image credit : {{$webstories_data->image_credit}}</p>
              </amp-story-grid-layer>
            </amp-story-page>
          @endif
      
          @if ($webstories_data->value == "image2")
            <amp-story-page id="page3">
              <amp-story-grid-layer template="fill">
                <amp-img
                  src="{{ $webstories_data->file }}"
                  width="720"
                  height="1280"
                  layout="responsive"
                >
                </amp-img>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical">
                <h1>{{ $webstories_data->story_title }}</h1>
                <amp-img class="logo"
                  src="{{ asset('public/assets/visual_stories/logo.png') }}"
                  alt="Krushi Marathi"
                  width="30"
                  height="30"
                  layout="fixed">
                </amp-img>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical" class="bottom">
                <q>{{ $webstories_data->story_description }}</q>
                <p class="righ-corner">Image credit : {{$webstories_data->image_credit}}</p>
              </amp-story-grid-layer>
            </amp-story-page>
          @endif
          
          @if ($webstories_data->value == "image3")
            <amp-story-page id="page5">
              <amp-story-grid-layer template="fill">
                <amp-img
                  src="{{ $webstories_data->file }}"
                  width="720"
                  height="1280"
                  layout="responsive"
                >
                </amp-img>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical">
                <h1>{{ $webstories_data->story_title }}</h1>
                <amp-img class="logo"
                  src="{{ asset('public/assets/visual_stories/logo.png') }}"
                  alt="Krushi Marathi"
                  width="30"
                  height="30"
                  layout="fixed">
                </amp-img>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical" class="bottom">
                <q>{{ $webstories_data->story_description }}</q>
                <p class="righ-corner">Image credit : {{$webstories_data->image_credit}}</p>
              </amp-story-grid-layer>
            </amp-story-page>
          @endif
          
          @if ($webstories_data->value == "video1")
            <amp-story-page id="page4">
              <amp-story-grid-layer template="fill">
                <amp-video
                  autoplay
                  loop
                  width="720"
                  height="1280"
                  poster="{{$webstories->file}}"
                  layout="responsive"
                >
                  <source src="{{ $webstories_data->file }}" type="video/mp4" />
                </amp-video>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical">
                <h1>{{ $webstories_data->story_title }}</h1>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical" class="bottom">
                <p>{{ $webstories_data->story_description }}</p>
                <amp-img class="logo"
                  src="{{ asset('public/assets/visual_stories/logo.png') }}"
                  alt="Krushi Marathi"
                  width="30"
                  height="30"
                  layout="fixed">
                </amp-img>
                <p class="righ-corner">Image credit : {{$webstories_data->image_credit}}</p>
              </amp-story-grid-layer>
            </amp-story-page>
          @endif

          @if ($webstories_data->value == "image4")
            <amp-story-page id="page1">
              <amp-story-grid-layer template="vertical">
                <h1>{{ $webstories_data->story_title }}</h1>
                <amp-img
                  src="{{ $webstories_data->file }}"
                  width="720"
                  height="1280"
                  layout="responsive"
                >
                </amp-img>
                <amp-img class="logo"
                  src="{{ asset('public/assets/visual_stories/logo.png') }}"
                  alt="Krushi Marathi"
                  width="30"
                  height="30"
                  layout="fixed">
                </amp-img>
                <q>{{ $webstories_data->story_description }}</q>
                <p class="righ-corner">Image credit : {{$webstories_data->image_credit}}</p>
              </amp-story-grid-layer>
            </amp-story-page>
          @endif
        @endforeach
      @endif
    </amp-story>
  </body>
</html>