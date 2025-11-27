<!-- Main navbar -->
<div class="navbar navbar-default header-highlight">
    <div class="navbar-header navbar-header-color">
        <a class="navbar-brand navbar-brand-header" href="#">
            <!--<img src="{{asset('public/assets/images/logo/logo.png')}}" alt="">-->
        </a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav nav-hide">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
        <div class="navbar-right">
           
            <ul class="nav navbar-nav">	
                <li class="nav-hide1"><a href="{{route('admin.logout')}}"><i class="icon-switch2"></i> <span>Logout</span></a></li>           
                <li class="dropdown user user-menu nav-hide">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">My account</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ (Route::currentRouteName() == 'admin.profile') ? 'active' : '' }}"><a href="{{route('admin.profile')}}"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                        <li><a href="{{route('admin.logout')}}"><i class="icon-switch2"></i> <span>Logout</span></a></li>           
                    </ul>
                </li>
            </ul>    
        </div>
    </div>
</div>
<!-- /main navbar -->