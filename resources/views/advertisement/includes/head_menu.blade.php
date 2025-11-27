<div class="navbar navbar-expand-md navbar-light">
	<div class="text-center d-md-none w-100">
		<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
			<i class="icon-unfold mr-2"></i>
			Menu List
		</button>
	</div>

	<div class="navbar-collapse collapse" id="navbar-navigation">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="{{route('ads.dashboard')}}" class="navbar-nav-link {{ (Route::currentRouteName() == 'ads.dashboard') ? 'active' : '' }}">
					<i class="icon-home4 mr-2"></i>
					{{ __('dashboard.dashboard') }}
				</a>
			</li>

			@php
				// Array of submenu routes
				$ProductRoutes = ['ads.sellProductList'];
				$currentRoute = Route::currentRouteName();
				$isProductActive = in_array($currentRoute, $ProductRoutes);
			@endphp

			<li class="nav-item dropdown {{ $isProductActive ? 'show' : '' }}">
				<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="{{ $isProductActive ? 'true' : 'false' }}">
					<i class="icon-strategy mr-2"></i>
					{{ __('dashboard.manage_sell_buy') }}
				</a>

				<div class="dropdown-menu {{ $isProductActive ? 'show' : '' }}">
					<a href="{{ route('ads.sellProductList') }}" class="dropdown-item {{ $currentRoute === 'ads.sellProductList' ? 'active' : '' }}"><i class="icon-align-center-horizontal"></i> {{ __('dashboard.sell_products') }}</a>
					<a href="{{ route('ads.buyProductList') }}" class="dropdown-item {{ $currentRoute === 'ads.buyProductList' ? 'active' : '' }}"><i class="icon-align-center-horizontal"></i> {{ __('dashboard.buy_products') }}</a>
				</div>
			</li>
			
			<li class="nav-item {{ (Route::currentRouteName() == 'ads.my_wishlist') ? 'active' : '' }}">
				<a href="{{route('ads.my_wishlist')}}" class="navbar-nav-link">
					<i class="icon-heart6 mr-2"></i>
					{{ __('common.wishlist_title') }}
				</a>
			</li>
			
			<li class="nav-item {{ (Route::currentRouteName() == 'ads.quotesList') ? 'active' : '' }}">
				<a href="{{route('ads.quotesList')}}" class="navbar-nav-link">
					<i class="icon-compose mr-2"></i>
					{{ __('dashboard.customer_requirements') }}
				</a>
			</li>
			
			<li class="nav-item {{ (Route::currentRouteName() == 'ads.profile') ? 'active' : '' }}">
				<a href="{{route('ads.profile')}}" class="navbar-nav-link">
					<i class="icon-user-plus mr-2"></i>
					{{ __('dashboard.profile') }}
				</a>
			</li>
			
		</ul>

		<ul class="navbar-nav ml-md-auto">
			<li class="nav-item">
				<a href="{{route('ads.logout')}}" class="navbar-nav-link">
					<i class="icon-switch2 mr-2"></i>
					{{ __('dashboard.logout') }}
				</a>
			</li>
		</ul>
	</div>
</div>