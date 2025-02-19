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

                @if (auth()->user()->can('pos.view'))
                @endif
                @if (auth()->user()->can('report.view'))
                @endif
                <li class="nav-item">
                    <a href="{{ route('report') }}" class="nav-link @if (request()->routeIs('report')) active @endif">
                        <i class=" nav-icon fas fa-chart-line"></i>
                        <p>
                            {{ __('report') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item @if (request()->routeIs('admin.video.*') || request()->routeIs('admin.brand.*') || request()->routeIs('admin.banner.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.video.*') || request()->routeIs('admin.brand.*') || request()->routeIs('admin.banner.*')) active @endif">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            {{ __('Website Management') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->can('brand.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.brand.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.brand*')) active @endif">
                                    <i class="nav-icon fa-solid fa-layer-group"></i>
                                    <p>
                                        {{ __('Brand') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('video.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.video.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.video*')) active @endif">
                                    <i class="nav-icon fas fa-play"></i>
                                    <p>
                                        {{ __('Video') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('banner.view'))
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
                        @endif

                    </ul>
                </li>

                <li class="nav-item @if (request()->routeIs('admin.product.*') ||
                        request()->routeIs('admin.product-category.*') ||
                        request()->routeIs('admin.discount*') ||
                        request()->routeIs('admin.service.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.product.*') ||
                            request()->routeIs('admin.product-category.*') ||
                            request()->routeIs('admin.discount*') ||
                            request()->routeIs('admin.service*')) active @endif">
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
                        @if (auth()->user()->can('product_category.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.product-category.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.product-category.*')) active @endif">
                                    {{-- <i class="nav-icon fa-solid fa-user-gear"></i> --}}
                                    <i class="nav-icon fas fa-dot-circle"></i>
                                    <p>{{ __('Product Category') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('discount.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.discount.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.discount*')) active @endif">
                                    <i class="nav-icon fas fa-percentage"></i>
                                    <p>
                                        {{ __('Discount') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('service.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.service.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.service*')) active @endif">
                                    <i class="nav-icon fa-solid fa-layer-group"></i>
                                    <p>
                                        {{ __('Service') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>


                @if (auth()->user()->can('employee.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.employee.index') }}"
                            class="nav-link @if (request()->routeIs('admin.employee*')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{ __('Employee') }}
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->can('customer.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.customer.index') }}"
                            class="nav-link @if (request()->routeIs('admin.customer*')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{ __('Customer') }}
                            </p>
                        </a>
                    </li>
                @endif
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
                <li class="nav-item @if (request()->routeIs('admin.contact*') ||
                        request()->routeIs('admin.email_config_form*') ||
                        request()->routeIs('admin.email_configuration')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.contact*') ||
                            request()->routeIs('admin.email_config_form*') ||
                            request()->routeIs('admin.email_configuration')) active @endif">
                        {{-- <i class="nav-icon  fa-solid fa-envelope"></i> --}}
                        <i class="nav-icon fa-solid fa-envelope-open-text"></i>
                        <p>
                            {{ __('Contact') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->can('message.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.contact.index') }}"
                                    class="nav-link treeview-link @if (request()->routeIs('admin.contact.index')) active @endif">
                                    {{-- <i class="nav-icon fa-solid fa-message"></i> --}}
                                    <i class="nav-icon fa-solid fa-comment-sms"></i>
                                    <p>
                                        {{ __('Message') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('email.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.email_config_form') }}"
                                    class="nav-link treeview-link @if (request()->routeIs('admin.email_config_form*')) active @endif">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        {{ __('Email Config') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.email-configuration') }}"
                                class="nav-link treeview-link @if (request()->routeIs('admin.email-configuration')) active @endif">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    {{ __('Email Configuration Mail') }}
                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item @if (request()->routeIs('admin.policy') || request()->routeIs('admin.term_and_condition')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.policy') || request()->routeIs('admin.term_and_condition')) active @endif">
                        <i class="nav-icon fa-solid fa-user-gear"></i>
                        <p>
                            {{ __('Term And Policy') }}
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->can('policy.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.policy') }}"
                                    class="nav-link @if (request()->routeIs('admin.policy')) active @endif">
                                    {{-- <i class="nav-icon fas fa-user-alt"></i> --}}
                                    <i class="nav-icon fa-solid fa-circle-info"></i>
                                    <p>
                                        {{ __('Policy Privacy') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('term.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.term_and_condition') }}"
                                    class="nav-link @if (request()->routeIs('admin.term_and_condition')) active @endif">
                                    {{-- <i class="nav-icon fas fa-users-cog"></i> --}}
                                    <i class="nav-icon fa-solid fa-circle-info"></i>
                                    <p>{{ __('Term & Condition') }}</p>
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
