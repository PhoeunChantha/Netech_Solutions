<aside class="main-sidebar elevation-4 sidebar-light-info" style="">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link" style="">
        <img src="@if (session()->has('app_logo') && file_exists('uploads/business_settings/' . session()->get('app_logo'))) {{ asset('uploads/business_settings/' . session()->get('app_logo')) }} @else {{ asset('uploads/image/default.png') }} @endif"
            alt="AdminLTE Logo" class="brand-image pt-2"
            style="width: 100%; object-fit: contain; margin-left: 0; height: 60px; max-height: 60px;">
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-theme-dark">
        <!-- Sidebar Menu -->
        <nav class="mt-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (request()->routeIs('admin.dashboard')) active @endif">
                        <img class="nav-icon" src="{{ asset('svgs/dashboard.svg') }}" alt="">
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item @if (request()->routeIs('admin.user*') ||
                        request()->routeIs('admin.role*') ||
                        request()->routeIs('admin.employee*') ||
                        request()->routeIs('admin.customer*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.user*') ||
                            request()->routeIs('admin.role*') ||
                            request()->routeIs('admin.employee*') ||
                            request()->routeIs('admin.customer*')) active @endif">
                        <img class="nav-icon" src="{{ asset('svgs/user-management.png') }}" alt="">

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
                                    <img class="nav-icon" src="{{ asset('svgs/user.png') }}" alt="">
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
                                    <img class="nav-icon" src="{{ asset('svgs/roles.png') }}" alt="">
                                    <p>{{ __('Role') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('employee.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.employee.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.employee*')) active @endif">
                                    <img class="nav-icon" src="{{ asset('svgs/employee.png') }}" alt="">
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
                                    <img class="nav-icon" src="{{ asset('svgs/customer.png') }}" alt="">
                                    <p>
                                        {{ __('Customer') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item @if (request()->routeIs('admin.video.*') || request()->routeIs('admin.banner.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.video.*') || request()->routeIs('admin.banner.*')) active @endif">
                        <img class="nav-icon" src="{{ asset('svgs/web-management.png') }}" alt="">
                        <p>
                            {{ __('Website Management') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->can('video.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.video.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.video*')) active @endif">
                                    <img class="nav-icon" src="{{ asset('svgs/video-editor.png') }}" alt="">
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
                                    <img class="nav-icon" src="{{ asset('svgs/banner.png') }}" alt="">
                                    <p>
                                        {{ __('Banner') }}
                                    </p>
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
                        <img class="nav-icon" src="{{ asset('svgs/communicate.png') }}" alt="">
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
                                    <img class="nav-icon" src="{{ asset('svgs/message.png') }}" alt="">
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
                                    <img class="nav-icon" src="{{ asset('svgs/mail-config.png') }}" alt="">
                                    <p>
                                        {{ __('Email Config') }}
                                    </p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
                <li class="nav-item @if (request()->routeIs('admin.product.*') ||
                        request()->routeIs('admin.product-category.*') ||
                        request()->routeIs('admin.discount.*') ||
                        request()->routeIs('admin.brand.*') ||
                        request()->routeIs('admin.service.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.product.*') ||
                            request()->routeIs('admin.product-category.*') ||
                            request()->routeIs('admin.discount.*') ||
                            request()->routeIs('admin.brand.*') ||
                            request()->routeIs('admin.service.*')) active @endif">
                        <img class="nav-icon" src="{{ asset('svgs/inventory-management.png') }}" alt="">
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
                                    {{-- <i class="nav-icon fas fa-dot-circle"></i> --}}
                                    <img class="nav-icon" src="{{ asset('svgs/product.png') }}" alt="">
                                    <p>{{ __('Product') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('product_category.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.product-category.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.product-category.*')) active @endif">
                                    <img class="nav-icon" src="{{ asset('svgs/category.png') }}" alt="">
                                    <p>{{ __('Product Category') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('discount.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.discount.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.discount*')) active @endif">
                                    <img class="nav-icon" src="{{ asset('svgs/discount.png') }}" alt="">
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
                                    <img class="nav-icon" src="{{ asset('svgs/service.png') }}" alt="">
                                    <p>
                                        {{ __('Service') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('brand.view'))
                            <li class="nav-item">
                                <a href="{{ route('admin.brand.index') }}"
                                    class="nav-link @if (request()->routeIs('admin.brand*')) active @endif">
                                    <img class="nav-icon" src="{{ asset('svgs/brand.png') }}" alt="">
                                    <p>
                                        {{ __('Brand') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @if (auth()->user()->can('purchase.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.purchases.index') }}"
                            class="nav-link @if (request()->routeIs('admin.purchases.index')) active @endif">
                            <img class="nav-icon" src="{{ asset('svgs/purchase.svg') }}" alt="">

                            <p>
                                {{ __('Purchases') }}
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->can('transaction.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.transactions.index') }}"
                            class="nav-link @if (request()->routeIs('admin.transactions.index')) active @endif">
                            <img class="nav-icon" src="{{ asset('svgs/transaction.png') }}" alt="">

                            <p>
                                {{ __('Transactions') }}
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->can('stock.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.stock.index') }}"
                            class="nav-link @if (request()->routeIs('admin.stock.index')) active @endif">
                            <img class="nav-icon" src="{{ asset('svgs/stock.png') }}" alt="">
                            <p>
                                {{ __('Stock') }}
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('supplier.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.supplier.index') }}"
                            class="nav-link @if (request()->routeIs('admin.supplier.index')) active @endif">
                            <img class="nav-icon" src="{{ asset('svgs/supplier.png') }}" alt="">
                            <p>
                                {{ __('Suppliers') }}
                            </p>
                        </a>
                    </li>
                @endif


                @if (auth()->user()->can('report.view'))
                    <li class="nav-item @if (request()->routeIs('admin.report.*') ||
                            request()->routeIs('admin.expense-report.expense') ||
                            request()->routeIs('admin.income-report.income')) menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if (request()->routeIs('admin.report.*')) active @endif">
                            <img class="nav-icon" src="{{ asset('svgs/report-management.png') }}" alt="">
                            <p>
                                {{ __('Reports Management') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->can('sell_report.view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.report.index') }}"
                                        class="nav-link @if (request()->routeIs('admin.report.index')) active @endif">
                                        <img class="nav-icon" src="{{ asset('svgs/sales.png') }}" alt="">
                                        <p>
                                            {{ __('Product Sell Report') }}
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->can('purchase_report.view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.expense-report.expense') }}"
                                        class="nav-link @if (request()->routeIs('admin.expense-report.expense')) active @endif">
                                        <img class="nav-icon" src="{{ asset('svgs/accounting.png') }}"
                                            alt="">
                                        <p>
                                            {{ __('Purchase Report') }}
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->can('income_report.view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.income-report.income') }}"
                                        class="nav-link @if (request()->routeIs('admin.income-report.income')) active @endif">
                                        <img class="nav-icon" src="{{ asset('svgs/financial.png') }}"
                                            alt="">
                                        <p>
                                            {{ __('Income Report') }}
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif


                <li class="nav-item @if (request()->routeIs('admin.policy') || request()->routeIs('admin.term_and_condition')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.policy') || request()->routeIs('admin.term_and_condition')) active @endif">
                        <img class="nav-icon" src="{{ asset('svgs/term-policy.png') }}" alt="">
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
                                    <img class="nav-icon" src="{{ asset('svgs/policy.png') }}" alt="">
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
                                    <img class="nav-icon" src="{{ asset('svgs/term.png') }}" alt="">
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
                            <img class="nav-icon" src="{{ asset('svgs/setting.png') }}" alt="">
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
