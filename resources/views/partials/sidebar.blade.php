<!-- resources/views/partials/sidebar.blade.php -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset("assets/images/logo.svg") }}" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{ asset("assets/images/logo-mini.svg") }}" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic d-flex align-items-center justify-content-end gap-2 w-100">
                   
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ Auth::guard('admin')->user()->name }}</h5>
                        <span>online</span>
                    </div>
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ asset("assets/images/dashboard/avatar.png") }}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link text-end w-100 d-block fs-5">التصفح</span>
        </li>
        <li class="nav-item menu-items my-1">
            <a class="nav-link d-flex gap-2" href="{{ route('admin.dashboard') }}">
              
                <span class="menu-title ms-5">الصفحة الرئيسية</span>
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link d-flex d-block w-100 justify-content-end" href="{{ route('admin.categories.index') }}">
              
                <span class="menu-title me-2">الفئات</span>
                <span class="menu-icon">
                    <i class="fa fa-tags"></i>
                </span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link d-flex d-block w-100 justify-content-end" href="{{ route('admin.products.index') }}">
              
                <span class="menu-title me-2">المنتجات</span>
                <span class="menu-icon">
                    <i class="fa fa-cubes"></i>
                </span>
            </a>
        </li>
    </ul>
</nav>