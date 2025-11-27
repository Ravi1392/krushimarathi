<!--footer-bar-fix-position-->
<div class="site-footer footer-bar-active footer-bar-align-right">
    <footer class="site-info" aria-label="Site">
        <div id="footer-widgets" class="site footer-widgets">
            <div class="footer-widgets-container grid-container">
                <div class="inside-footer-widgets">
                    <div class="footer-widget-1">
                        <aside class="widget inner-padding widget_block">
                            <div class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-3 wp-block-columns-is-layout-flex">
                                <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:100%">
                                    <div class="wp-block-group alignwide">
                                        <div class="wp-block-group__inner-container is-layout-flow wp-block-group-is-layout-flow">
                                            <div class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-2 wp-block-columns-is-layout-flex">
                                                <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:37%">
                                                    <div class="site-logo" style="display: flex;flex-direction: column;align-items: center;">
                                                        <a href="{{ url('/') }}" rel="home">
                                                            <img class="header-image is-logo-image" alt="Krushi Marathi Logo" src="{{asset('public/footer_logo.png')}}" width="300" height="70">
                                                        </a>
                                                        <!--<p style="margin-bottom: 0.5em;">आमची वेबसाइट तुम्हाला कृषी योजना, कृषि माहिती, नवीन तंत्रज्ञान, उपयुक्त टिप्स, नवीन अपडेट्स, ऑनलाईन फॉर्म, नवीन योजना आणि शेती विषयक माहिती देण्यासाठी तयार केली आहे.</p>-->
                                                        <p style="margin-bottom: 0;">Krushi Marathi is a platform where you will get information on a variety of topics, whether they are trending subjects or matters related to people's interests.</p>
                                                        @include('frontend.components.footer_social_profile')
                                                    </div>
                                                </div>
                                                <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:18%;">
                                                    <div class="widget widget_nav_menu">
                                                        <div class="menu-footer-container">
                                                            <h2 style="font-size: 22px;margin-bottom: 10px;font-weight: 600;">Quick Links</h2>
                                                            {{FooterMenu()}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:18%;">
                                                    <div class="widget widget_nav_menu">
                                                        <div class="menu-footer-container">
                                                            <h2 style="font-size: 22px;margin-bottom: 10px;font-weight: 600;">Other Links</h2>
                                                            {{FooterMenuFour()}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:18%;">
                                                    <div class="widget widget_nav_menu">
                                                        <div class="menu-footer-container">
                                                            <h2 style="font-size: 22px;margin-bottom: 10px;font-weight: 600;">Category Links</h2>
                                                            {{FooterMenuTwo()}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:18%;">
                                                    <div class="widget widget_nav_menu">
                                                        <div class="menu-footer-container">
                                                            <h2 style="font-size: 22px;margin-bottom: 10px;font-weight: 600;">Special Links</h2>
                                                            {{FooterMenuThree()}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside> 
                    </div>
                    <hr style="margin-bottom: 5px;margin-top: 5px;background-color: #ffffff;">
                    <div class="copyright-bar" style="text-align: center;">
                        © {{Date('Y')}} <a href="{{ url('/') }}">Krushi Marathi</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ config('constants.CDN_BASE') }}/front/js/ssp-checkout-form.js"></script>
<script src="{{ config('constants.CDN_BASE') }}/front/js/core.min.js"></script>
<script src="{{ config('constants.CDN_BASE') }}/front/js/menu.min.js"></script>
<script src="{{ config('constants.CDN_BASE') }}/front/js/navigation-search.min.js"></script>
