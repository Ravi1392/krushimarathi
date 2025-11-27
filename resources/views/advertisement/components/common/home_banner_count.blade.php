<section class="nw-banner-bottomcard-wrapper">
    <div class="container">
        <div class="nw-banner-card-wrapper">
            <div class="scroller mob-scroller" data-speed="slow" id="scrollerBanner" data-animated="true">
                <ul class="tag-list scroller__inner">
                    <li>
                        <div class="hm-banner-scroll-card">
                            <div class="hm-banner-scroll-icon">
                                <img src="{{asset('public/assets/advertisement/images/regiuser_icon.webp')}}" alt="Registered users" width="80px" height="80px">
                            </div>
                            <div class="hm-banner-scroll-contents">
                                <h5>{{ $registeredUsersCount }}</h5>
                                <p>{{ __('home.registered_users') }}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="hm-banner-scroll-card">
                            <div class="hm-banner-scroll-icon">
                                <img src="{{asset('public/assets/advertisement/images/sellreq_icon.webp')}}" alt="Sell Requirements" width="80px" height="80px">
                            </div>
                            <div class="hm-banner-scroll-contents">
                                <h5>{{ $sellProductCount }}</h5>
                                <p>{{ __('home.sell_requirements') }}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="hm-banner-scroll-card">
                            <div class="hm-banner-scroll-icon">
                                <img src="{{asset('public/assets/advertisement/images/buyrequ_icon.webp')}}" alt="Buy Requirements" width="80px" height="80px">
                            </div>
                            <div class="hm-banner-scroll-contents">
                                <h5>{{ $buyProductCount }}</h5>
                                <p>{{ __('home.buy_requirements') }}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="hm-banner-scroll-card">
                            <div class="hm-banner-scroll-icon">
                                <img src="{{asset('public/assets/advertisement/images/connectedusers_icon.webp')}}" alt="Connected users" width="80px" height="80px">
                            </div>
                            <div class="hm-banner-scroll-contents">
                                <h5>{{ $mobileUsersCount }}</h5>
                                <p>{{ __('home.connected_users') }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="deskscroller">
                <ul class="tag-list scroller__inner">
                    <li>
                        <div class="hm-banner-scroll-card">
                            <div class="hm-banner-scroll-icon">
                                <img src="{{asset('public/assets/advertisement/images/regiuser_icon.webp')}}" alt="Registered users" width="80px" height="80px">
                            </div>
                            <div class="hm-banner-scroll-contents">
                                <h5>{{ $registeredUsersCount }}</h5>
                                <p>{{ __('home.registered_users') }}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="hm-banner-scroll-card">
                            <div class="hm-banner-scroll-icon">
                                <img src="{{asset('public/assets/advertisement/images/sellreq_icon.webp')}}" alt="Sell Requirements" width="80px" height="80px">
                            </div>
                            <div class="hm-banner-scroll-contents">
                                <h5>{{ $sellProductCount }}</h5>
                                <p>{{ __('home.sell_requirements') }}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="hm-banner-scroll-card">
                            <div class="hm-banner-scroll-icon">
                                <img src="{{asset('public/assets/advertisement/images/buyrequ_icon.webp')}}" alt="Buy Requirements" width="80px" height="80px">
                            </div>
                            <div class="hm-banner-scroll-contents">
                                <h5>{{ $buyProductCount }}</h5>
                                <p>{{ __('home.buy_requirements') }}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="hm-banner-scroll-card">
                            <div class="hm-banner-scroll-icon">
                                <img src="{{asset('public/assets/advertisement/images/connectedusers_icon.webp')}}" alt="Connected users" width="80px" height="80px">
                            </div>
                            <div class="hm-banner-scroll-contents">
                                <h5>{{ $mobileUsersCount }}</h5>
                                <p>{{ __('home.connected_users') }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>