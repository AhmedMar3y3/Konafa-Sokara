<!-- resources/views/partials/sidebar.blade.php -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset("assets/images/logo.svg") }}" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{ asset("assets/images/logo-mini.svg") }}" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ asset("assets/images/dashboard/avatar.png") }}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ Auth::guard('admin')->user()->name }}</h5>
                        <span>online</span>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        {{-- <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <span class="menu-icon">
                    <i class="fa fa-tags"></i>
                </span>
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.places.index') }}">
                <span class="menu-icon">
                    <i class="fa fa-building-o"></i>
                </span>
                <span class="menu-title">Places</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.reviews.index') }}">
                <span class="menu-icon">
                    <i class="fa fa-drivers-license-o"></i>
                </span>
                <span class="menu-title">Reviews</span>
                <i class="menu-arrow"></i>
            </a>
        </li> --}}
    </ul>
</nav>