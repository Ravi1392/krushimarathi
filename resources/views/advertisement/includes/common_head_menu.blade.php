<div class="navbar navbar-expand-md navbar-dark">
		{{-- <div class="navbar-brand"> --}}
			<a href="{{ url('/') }}" rel="home" class="d-inline-block">
                <img class="header-image is-logo-image" alt="Krushi Marathi Logo" src="{{asset('public/footer_logo.png')}}" width="250" height="50">
            </a>
		{{-- </div> --}}
		
		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		
		<div class="collapse navbar-collapse" id="navbar-mobile">
			@if(Auth::guard('customer')->check())
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
							<i class="icon-paragraph-justify3"></i>
						</a>
					</li>
				</ul>
			@endif
			<ul class="navbar-nav mr-md-auto">
				<li class="nav-item">
					<a href="{{url('/ads')}}" class="navbar-nav-link d-flex align-items-center" style="font-size: 18px;">
						<span>{{ __('common.home') }}</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{route('ads.buy')}}" class="navbar-nav-link d-flex align-items-center" style="font-size: 18px;">
						<span>{{ __('common.buy_menu') }}</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{route('ads.sell')}}" class="navbar-nav-link d-flex align-items-center" style="font-size: 18px;">
						<span>{{ __('common.sell_menu') }}</span>
					</a>
				</li>

				<!--<li class="nav-item">-->
				<!--	<a href="{{url('/')}}" class="navbar-nav-link d-flex align-items-center" style="font-size: 18px;">-->
				<!--		<span>{{ __('common.blog') }}</span>-->
				<!--	</a>-->
				<!--</li>-->
				
				<!--<li class="nav-item">-->
				<!--	<a href="{{route('ads.todays-bajarbhav')}}" class="navbar-nav-link d-flex align-items-center" style="font-size: 18px;">-->
				<!--		<span>{{ __('common.market_rates') }}</span>-->
				<!--	</a>-->
				<!--</li>-->
			</ul>

			<ul class="navbar-nav">

				@php
					$currentLocale = session('locale', 'en');

					$languages = [
						'en' => 'English',
						'hi' => 'हिंदी',
						'mr' => 'मराठी',
					];

					// Remove current locale from list
					$otherLanguages = array_filter($languages, function ($key) use ($currentLocale) {
						return $key !== $currentLocale;
					}, ARRAY_FILTER_USE_KEY);
				@endphp

				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-expanded="false" style="font-size: 18px;">
						<span>
							{{ $languages[$currentLocale] ?? 'English' }}
						</span>
					</a>

					<div class="dropdown-menu">
						@foreach ($otherLanguages as $lang => $label)
							<a href="{{ url('/ads/lang/' . $lang) }}" class="dropdown-item" style="font-size: 18px;">
								{{ $label }}
							</a>
						@endforeach
					</div>
				</li>
                
                @if(!Auth::guard('customer')->check())
                    <li class="nav-item">
                        <a href="{{route('ads.loginForm')}}" class="navbar-nav-link d-flex align-items-center" style="font-size: 18px;">
                            <span>{{ __('common.login') }}</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{route('ads.logout')}}" class="navbar-nav-link d-flex align-items-center" style="font-size: 18px;">
                            <span>{{ __('common.logout') }}</span>
                        </a>
                    </li>
                @endif

                @if(!Auth::guard('customer')->check())
                    <li class="nav-item">
                        <a href="{{route('ads.register')}}" class="navbar-nav-link d-flex align-items-center" style="font-size: 18px;">
                            <span>{{ __('common.register') }}</span>
                        </a>
                    </li>
                @endif
				<li class="nav-item">
					<a href="{{route('ads')}}" class="btn bg-success-400 d-flex align-items-center" style="font-size: 18px;"><i class="icon-cart mr-2"></i> <span>{{ __('common.buy') }}</span></a>
				</li>&nbsp;
				@if(!Auth::guard('customer')->check())
					<li class="nav-item">
						<a href="{{route('ads.post-advertisement')}}" class="btn bg-success-400 d-flex align-items-center" style="font-size: 18px;"><i class="icon-basket mr-2"></i> <span>{{ __('common.sell') }}</span></a>
					</li>
				@else
					<li class="nav-item">
						<a href="{{route('ads.post-requirement')}}" class="btn bg-success-400 d-flex align-items-center" style="font-size: 18px;"><i class="icon-basket mr-2"></i> <span>{{ __('common.sell') }}</span></a>
					</li>
				@endif
			</ul>
		</div>
	</div>