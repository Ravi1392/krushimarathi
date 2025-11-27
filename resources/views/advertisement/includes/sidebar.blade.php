<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
	<!-- Sidebar mobile toggler -->
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Navigation
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<!-- /sidebar mobile toggler -->

	<!-- Sidebar content -->
	<div class="sidebar-content">
		<!-- Main navigation -->
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">
				<!-- Main -->
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
				<li class="nav-item">
					<a href="{{route('ads.dashboard')}}" class="nav-link">
						<i class="icon-home4"></i>
						<span>
							{{ __('dashboard.dashboard') }}
						</span>
					</a>
				</li>

				@php
					// Array of submenu routes
					$ProductRoutes = ['ads.sellProductList'];
					$currentRoute = Route::currentRouteName();
					$isProductActive = in_array($currentRoute, $ProductRoutes);
				@endphp

				<li class="nav-item nav-item-submenu {{ $isProductActive ? 'nav-item-open nav-item-expanded' : '' }}">
					<a href="#" class="nav-link"><i class="icon-file-css"></i> <span>{{ __('dashboard.manage_sell_buy') }}</span></a>
					<ul class="nav nav-group-sub" data-submenu-title="{{ __('dashboard.manage_sell_buy') }}">
						<li class="nav-item">
							<a href="{{ route('ads.sellProductList') }}" class="nav-link {{ $currentRoute === 'ads.sellProductList' ? 'active' : '' }}">{{ __('dashboard.sell_products') }}</a>
						</li>
					</ul>
				</li>

				{{-- <li class="nav-item">
					<a href="#" class="nav-link">
						<i class="icon-heart6"></i>
						<span>{{ __('dashboard.my_wishlist') }}</span>
					</a>
				</li> --}}

				<li class="nav-item {{ (Route::currentRouteName() == 'ads.profile') ? 'active' : '' }}">
					<a href="{{route('ads.profile')}}" class="nav-link">
						<i class="icon-user-plus"></i> 
						<span>{{ __('dashboard.profile') }}</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{route('ads.logout')}}" class="nav-link">
						<i class="icon-switch2"></i>
						<span>{{ __('dashboard.logout') }}</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- /main navigation -->
	</div>
	<!-- /sidebar content -->
</div>