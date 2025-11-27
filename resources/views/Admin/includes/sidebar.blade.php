<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <li class="{{ (Route::currentRouteName() == 'admin.home') ? 'active' : '' }}">
                        <a href="{{route('admin.home')}}">
                            <i class="icon-home4"></i> 
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @if (Auth::user()->role_id === 1)

                        @php
                            // Array of submenu routes
                            $CategoryRoutes = ['admin.category.index','admin.subcategory.index','admin.footercategory.index','admin.special_categories.index'];
                            $isCategoryActive = in_array(Route::currentRouteName(), $CategoryRoutes);
                        @endphp

                        <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open {{ $isCategoryActive ? 'active' : '' }}">
                            <a href="#" class="nav-link"><i class="icon-file-css"></i> <span>Manage Categories</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="JSON forms">
                                <li class="nav-item {{ $isCategoryActive ? 'active' : '' }}">
                                    <a href="{{route('admin.category.index')}}" class="nav-link active">Manage Category</a>
                                </li>
                                <li class="nav-item {{ $isCategoryActive ? 'active' : '' }}">
                                    <a href="{{route('admin.subcategory.index')}}" class="nav-link active">Manage Sub Category</a>
                                </li>
                                <li class="nav-item {{ $isCategoryActive ? 'active' : '' }}">
                                    <a href="{{route('admin.footercategory.index')}}" class="nav-link active">Manage Footer Category</a>
                                </li>
                                <li class="nav-item {{ $isCategoryActive ? 'active' : '' }}">
                                    <a href="{{route('admin.special_categories.index')}}" class="nav-link active">Manage Special Category</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    
                    <li class="{{ (Route::currentRouteName() == 'admin.blog.index') ? 'active' : '' }}">
                        <a href="{{route('admin.blog.index')}}">
                            <i class="icon-menu7"></i> 
                            <span>Blog List</span>
                        </a>
                    </li>
                    
                    @if (Auth::user()->role_id === 1)
                    <li class="{{ (Route::currentRouteName() == 'admin.virtualStories.index') ? 'active' : '' }}">
                        <a href="{{route('admin.virtualStories.index')}}">
                            <i class="icon-images3"></i> 
                            <span>Visual Stories</span>
                        </a>
                    </li>
                    @endif
                    
                    @php
                        // Array of submenu routes
                        $krushiRoutes = ['admin.weather.index','admin.live_update.index','admin.news_flash.index'];
                        $isKrushiActive = in_array(Route::currentRouteName(), $krushiRoutes);
                    @endphp

                    <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open {{ $isKrushiActive ? 'active' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-file-css"></i> <span>Krushi Marathi Special</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="JSON forms">
                            <li class="nav-item {{ $isKrushiActive ? 'active' : '' }}"><a href="{{route('admin.weather.index')}}" class="nav-link active">Weather</a></li>
                            @if (Auth::user()->role_id === 1)
                                <li class="nav-item {{ $isKrushiActive ? 'active' : '' }}"><a href="{{route('admin.live_update.index')}}" class="nav-link active">Live Update List</a></li>
                                <li class="nav-item {{ $isKrushiActive ? 'active' : '' }}"><a href="{{route('admin.news_flash.index')}}" class="nav-link active">News Flash List</a></li>
                            @endif
                        </ul>
                    </li>
                    
                    @php
                        // Array of submenu routes
                        $bajarbhavRoutes = ['admin.crop_name.index', 'admin.crop_rate.index', 'admin.bajarbhav.index'];
                        $isBajarbhavActive = in_array(Route::currentRouteName(), $bajarbhavRoutes);
                    @endphp

                    <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open {{ $isBajarbhavActive ? 'active' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-file-css"></i> <span>बाजारभाव स्पेशल</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="JSON forms">
                            <li class="nav-item {{ $isBajarbhavActive ? 'active' : '' }}"><a href="{{route('admin.crop_name.index')}}" class="nav-link active">पिकांची नावे</a></li>
                            <li class="nav-item {{ $isBajarbhavActive ? 'active' : '' }}"><a href="{{route('admin.crop_rate.index')}}" class="nav-link active">पिकांचे भाव</a></li>
                            <li class="nav-item {{ $isBajarbhavActive ? 'active' : '' }}"><a href="{{route('admin.bajarbhav.index')}}" class="nav-link active">बाजारभाव</a></li>
                        </ul>
                    </li>

                    @if (Auth::user()->role_id === 1)
                        @php
                            // Array of common routes
                            $commonRoutes = ['admin.comments.index','admin.contactUs.index','admin.setting.index','admin.subscriber.index','admin.mobile_user.index'];
                            $isCommonActive = in_array(Route::currentRouteName(), $commonRoutes);
                        @endphp

                        <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open {{ $isCommonActive ? 'active' : '' }}">
                            <a href="#" class="nav-link"><i class="icon-file-css"></i> <span>Only For Admin</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="JSON forms">
                                <li class="nav-item {{ $isCommonActive ? 'active' : '' }}"><a href="{{route('admin.comments.index')}}" class="nav-link active">Comment</a></li>
                                <li class="nav-item {{ $isCommonActive ? 'active' : '' }}"><a href="{{route('admin.contactUs.index')}}" class="nav-link active">Contact Us</a></li>
                                <li class="nav-item {{ $isCommonActive ? 'active' : '' }}"><a href="{{route('admin.subscriber.index')}}" class="nav-link active">Subscribers</a></li>
                                <li class="nav-item {{ $isCommonActive ? 'active' : '' }}"><a href="{{route('admin.mobile_user.index')}}" class="nav-link active">Mobile User</a></li>
                                <li class="nav-item {{ $isCommonActive ? 'active' : '' }}"><a href="{{route('admin.setting.index')}}" class="nav-link active">Setting</a></li>
                            </ul>
                        </li>
                        
                        @php
                            // Array of submenu routes
                            $TeamRoutes = ['admin.ipl.index','admin.match.index'];
                            $isTeamActive = in_array(Route::currentRouteName(), $TeamRoutes);
                        @endphp

                        <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open {{ $isTeamActive ? 'active' : '' }}">
                            <a href="#" class="nav-link"><i class="icon-file-css"></i> <span>IPL 2025</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="JSON forms">
                                <li class="nav-item {{ $isTeamActive ? 'active' : '' }}">
                                    <a href="{{route('admin.ipl.index')}}" class="nav-link active">Manage Team</a>
                                </li>
                                <li class="nav-item {{ $isTeamActive ? 'active' : '' }}">
                                    <a href="{{route('admin.match.index')}}" class="nav-link active">Manage Matched</a>
                                </li>
                            </ul>
                        </li>
                    
                        @php
                            // Array of My Village Info routes
                            $VillageRoutes = ['admin.country.index','admin.state.index','admin.district.index','admin.taluka.index','admin.village.index'];
                            $isVillageActive = in_array(Route::currentRouteName(), $VillageRoutes);
                        @endphp
    
                        <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open {{ $isVillageActive ? 'active' : '' }}">
                            <a href="#" class="nav-link"><i class="icon-file-css"></i> <span>My Village Info</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="JSON forms">
                                <li class="nav-item {{ $isVillageActive ? 'active' : '' }}">
                                    <a href="{{route('admin.country.index')}}" class="nav-link active">Manage Country</a>
                                </li>
                                <li class="nav-item {{ $isVillageActive ? 'active' : '' }}">
                                    <a href="{{route('admin.state.index')}}" class="nav-link active">Manage State and UT</a>
                                </li>
                                <li class="nav-item {{ $isVillageActive ? 'active' : '' }}">
                                    <a href="{{route('admin.district.index')}}" class="nav-link active">Manage District</a>
                                </li>
                                <li class="nav-item {{ $isVillageActive ? 'active' : '' }}">
                                    <a href="{{route('admin.taluka.index')}}" class="nav-link active">Manage Taluka</a>
                                </li>
                                <li class="nav-item {{ $isVillageActive ? 'active' : '' }}">
                                    <a href="{{route('admin.village.index')}}" class="nav-link active">Manage Village</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    
                    <li class="{{ (Route::currentRouteName() == 'admin.profile') ? 'active' : '' }}">
                        <a href="{{route('admin.profile')}}">
                            <i class="icon-user-plus"></i> 
                            <span>Profile</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.logout')}}">
                            <i class="icon-switch2"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->