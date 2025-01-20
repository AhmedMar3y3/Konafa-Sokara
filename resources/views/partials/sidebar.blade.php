<!-- resources/views/partials/sidebar.blade.php -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="sidebar-brand-wrapper d-lg-flex align-items-center justify-content-center fixed-top ">

        <li class="nav-item dropdown me-5" style="list-style-type: none;">
            <a class="nav-link " id="profileDropdown" href="#" data-bs-toggle="dropdown">
            <div class="navbar-profile d-flex gap-2">
                
                <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::guard('admin')->user()->name }}</p>
                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                <img class="img-xs rounded-circle" src="{{ asset("../../../assets/images/dashboard/avatar.png") }}" alt="">
            </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="profileDropdown">
            <h6 class="p-3 mb-0">Profile</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-logout text-danger"></i>
                </div>
                </div>
                <div class="preview-item-content">
                <p class="preview-subject mb-1">Log out</p>
                </div>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </div>
        </li>
    </ul>
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
        <li class="nav-item menu-items">
            <a class="nav-link d-flex d-block w-100 justify-content-end" href="{{ route('admin.additions.index') }}">
              
                <span class="menu-title me-2">الإضافات</span>
                <span class="menu-icon">
                    <i class="fa fa-plus-circle"></i>
                </span>
            </a>
        </li>
       <li class="nav-item menu-items">
            <a class="nav-link d-flex d-block w-100 justify-content-end" href="{{ route('admin.faqs.index') }}"> 
                <span class="menu-title me-2">الاسئلة الشائعة</span>
                <span class="menu-icon">
                    <i class="fa fa-question-circle"></i>
                </span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link d-flex d-block w-100 justify-content-end" href="{{ route('admin.banners.index') }}">
              
                <span class="menu-title me-2">البانرات</span>
                <span class="menu-icon">
                    <i class="fa fa-image"></i>
                </span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link d-flex d-block w-100 justify-content-end" href="{{ route('admin.settings.index') }}">
                <span class="menu-title me-2">الإعدادات</span>
                <span class="menu-icon">
                    <i class="fa fa-cogs"></i>
                </span>
            </a>
        </li>
    </ul>
</nav>