<section class="more-for-you-section mb-3">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 justify-content-center">

            <div class="col">
                <div class="more-for-you-card card h-100 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-between">
                        <div class="icon-wrapper mb-3">
                            <div class="icon-circle-wrapper"> <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">{{ __('extra_card.villages') }}</h5>
                        <a href="{{url('/in')}}" class="btn more-for-you-btn mt-auto">{{ __('extra_card.view_more') }}</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="more-for-you-card card h-100 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-between">
                        <div class="icon-wrapper mb-3">
                            <div class="icon-circle-wrapper"> <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zm-8.7-16.7L4.3 9h15.4l-2-7H8.3zM4 14h15.5c1.38 0 2.5-1.12 2.5-2.5S20.88 9 19.5 9H4c-1.38 0-2.5 1.12-2.5 2.5S2.62 14 4 14z"/>
                                </svg>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">{{ __('extra_card.shop') }}</h5>
                        <a href="{{url('/ads')}}" class="btn more-for-you-btn mt-auto">{{ __('extra_card.buy_now') }}</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="more-for-you-card card h-100 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-between">
                        <div class="icon-wrapper mb-3">
                            <div class="icon-circle-wrapper"> <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M5 9.22h3V18H5zM10.5 5h3v13h-3zM16 13h3v5h-3z"/>
                                </svg>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">{{ __('extra_card.rates') }}</h5>
                        <a href="{{url('/ads/todays-bajarbhav')}}" class="btn more-for-you-btn mt-auto">{{ __('extra_card.see_rates') }}</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="more-for-you-card card h-100 text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-between">
                        <div class="icon-wrapper mb-3">
                            <div class="icon-circle-wrapper"> <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M21 4H3c-1.1 0-2 .9-2 2v13c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 15H4c-.55 0-1-.45-1-1V6c0-.55.45-1 1-1h16c.55 0 1 .45 1 1v12c0 .55-.45 1-1 1zM9 10h6v1.5H9zM9 13h6v1.5H9zM9 16h6v1.5H9z"/>
                                </svg>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">{{ __('extra_card.blogs') }}</h5>
                        @php
                            $locale = session('locale', 'en'); 

                            $readLink = match ($locale) {
                                'mr' => url('/krushi'),
                                'hi' => url('/hindi'),
                                'en' => url('/english'),
                                default => url('/english'),
                            };
                        @endphp
                        <a href="{{ $readLink }}" class="btn more-for-you-btn mt-auto">{{ __('extra_card.read') }}</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>