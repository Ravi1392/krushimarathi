<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('public/favicon.ico') }}" type="image/x-icon">
        <meta name="google-site-verification" content="aqKB2Y5OJx455FadC19ENwv07ekmR-u1kc67hzJgkNI" />
       
        <!-- Google Adz -->
        {!! $googleAdsInfo !!}
        <!-- Google Adz -->
        <!-- Google Tag Manager -->
        {!! $googleTagInfo !!}
        <!-- End Google Tag Manager -->
        
        <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js" crossorigin="anonymous"></script>
        
        @stack('custom-meta')
        
        <!--ad blocking recovery code start-->
        @include('ad_blocking_recovery')
        <!--ad blocking recovery code end-->
        
        @include('frontend.includes.head_script')
        @stack('custom-search_script')
        @stack('custom-css')
        @stack('ads-script')
        
        <script>
            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, "clarity", "script", "tngpqmd7we");
        </script>
        
    </head>
    <body class="page-template-default wp-custom-logo wp-embed-responsive nav-float-right separate-containers nav-search-enabled header-aligned-left dropdown-hover featured-image-active using-mouse">
        
       <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MJ77XV6N"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        
        @include('frontend.includes.top_header')
        @include('frontend.includes.head_menu')
        @include('frontend.components.marque')
        @yield('content')
        @include('frontend.includes.footer') 

        <div id="product_detail_loader"  class="preloader">
            <div class="inner-div-loader">
                <div class="lds-ripple"><div></div><div></div>   
                </div> 
           </div>
        </div>
        @stack('custom-scripts')
    </body>
</html>