<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PRE-DEV</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Master Data</div>

    <!-- Peserta -->
    <li class="nav-item {{ request()->routeIs('peserta.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('peserta.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Peserta</span>
        </a>
    </li>

    <!-- Event -->
    <li class="nav-item {{ request()->routeIs('event.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('event.index') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Event</span>
        </a>
    </li>



    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>