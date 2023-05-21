<div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
            OrrangeTools
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                    class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                    class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                    data-ticon="disc"></i></a></li>
    </ul>
</div>
<div class="shadow-bottom"></div>
<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class=" nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                                                                  href="{{ route('home') }}"><i
                    data-feather="home"></i><span class="menu-title text-truncate"
                                                  data-i18n="Dashboard">Dashboard</span></a>
        </li>

        <li class="nav-item {{ request()->is('project') ? 'active' : '' }} mt-1">
            <a class="d-flex align-items-center" href="{{ route('project.index') }}"><i data-feather="home"></i><span
                    class="menu-title text-truncate"
                    data-i18n="Dashboard">Project</span></a>
        </li>

    </ul>
</div>
