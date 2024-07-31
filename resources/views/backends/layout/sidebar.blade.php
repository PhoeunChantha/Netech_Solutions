<aside class="main-sidebar elevation-4 sidebar-light-info" style="">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link" style="">
        <img src="@if (session()->has('app_logo') && file_exists('uploads/business_settings/' . session()->get('app_logo'))) {{ asset('uploads/business_settings/' . session()->get('app_logo')) }} @else {{ asset('uploads/image/default.png') }} @endif"
            alt="AdminLTE Logo" class="brand-image pt-2"
            style="width: 100%; object-fit: contain; margin-left: 0; height: 60px; max-height: 60px;">
        {{-- <span class="brand-text font-weight pl-2 ml-0 mt-2">{{ session()->get('app_name') }}</span> --}}
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-theme-dark">
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Session::get('current_user')->profile_photo_path }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Session::get('current_user')->name }}</a>
            </div>
        </div> --}}
        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input style="background-color: #012e5a;" class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (request()->routeIs('admin.dashboard')) active @endif">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.banner.index') }}"
                        class="nav-link @if (request()->routeIs('admin.banner*')) active @endif">
                        {{-- <i class="nav-icon fa-baner"></i> --}}
                        <i class="nav-icon fa-regular fa-images"></i>
                        <p>
                            {{ __('Banner') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.brand.index') }}"
                        class="nav-link @if (request()->routeIs('admin.brand*')) active @endif">
                        <i class="nav-icon fa-solid fa-layer-group"></i>
                        <p>
                            {{ __('Brand') }}
                        </p>
                    </a>
                </li>
                @if (auth()->user()->can('banner.view'))
                @endif
                <li class="nav-item @if (request()->routeIs('admin.product.*') || request()->routeIs('admin.product-category.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.product.*') || request()->routeIs('admin.product-category.*')) active @endif">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            {{ __('Product Management') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->can('product.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.product.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.product.*')) active @endif">
                                    {{-- <i class="nav-icon fas fa-user-alt"></i> --}}
                                    <i class="nav-icon fas fa-dot-circle"></i>
                                    <p>{{ __('Product') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('pro_category.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.product-category.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.product-category.*')) active @endif">
                                    {{-- <i class="nav-icon fa-solid fa-user-gear"></i> --}}
                                    <i class="nav-icon fas fa-dot-circle"></i>
                                    <p>{{ __('Product Category') }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="nav-item @if (request()->routeIs('admin.user*') || request()->routeIs('admin.role*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.user*') || request()->routeIs('admin.role*')) active @endif">
                        <i class="nav-icon fa-solid fa-user-gear"></i>
                        <p>
                            {{ __('User Management') }}
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->can('user.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.user.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.user.*')) active @endif">
                                    {{-- <i class="nav-icon fas fa-user-alt"></i> --}}
                                    <i class="nav-icon fas fa-dot-circle"></i>
                                    <p>
                                        {{ __('User') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('role.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.role.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.role.*')) active @endif">
                                    {{-- <i class="nav-icon fas fa-users-cog"></i> --}}
                                    <i class="nav-icon fas fa-dot-circle"></i>
                                    <p>{{ __('Role') }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @if (auth()->user()->can('setting.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index') }}"
                            class="nav-link @if (request()->routeIs('admin.setting*')) active @endif">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                {{ __('Setting') }}
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
