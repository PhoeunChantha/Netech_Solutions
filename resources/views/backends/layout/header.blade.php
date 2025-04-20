<style>
    .img-circle {
        object-fit: cover;
    }

    .pos-style {
        padding: 5px 11px !important;
        background-color: green !important;
        color: white !important;
        border-radius: 10px;
    }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav ">
        <li class="nav-item sidebar-toggle-system">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
        </li> --}}
        <li class="nav-item d-none" id="logo-pos" style="margin-left: 20px;">
            <img width="30%" src="@if (session()->has('app_logo') && file_exists('uploads/business_settings/' . session()->get('app_logo'))) {{ asset('uploads/business_settings/' . session()->get('app_logo')) }} @else {{ asset('uploads/image/default.png') }} @endif"
                alt="AdminLTE Logo" class=""
                style="">
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none" id="search-product" >
            <div class="product-search" style="width: 41rem; border:1px solid #ccc;border-radius: 8px;">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" id="product-search" class="form-control"
                        placeholder="Search for products">
                </div>
            </div>
        </li>
        <li class="nav-item d-flex align-items-center justify-content-center ml-3" id="back-button">
            <a class="btn btn-primary" href="{{ route('admin.dashboard') }}" class="" style="">
               <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
            </a>
        </li>
        <li class="nav-item dropdown" id="url-website">
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <img width="24px" class="" class="" src="{{ asset('svgs/www.png') }}" alt="">
                {{ __('website') }}
            </a>
        </li>
        
        @if (auth()->user()->can('pos.view'))
            <li class="nav-item" id="url-pos">
                <a href="{{ route('admin.pos.index', request(['type' => 'pos'])) }}"
                    class="nav-link pos-style d-flex align-items-center justify-content-center @if (request()->routeIs('admin.pos.index')) active @endif">
                    <img width="24px" class="nav-icon" src="{{ asset('svgs/POS.png') }}" alt="">
                    <p class="m-0">
                        {{ __('POS') }}
                    </p>
                </a>
            </li>
        @endif
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-headset"></i>
                <span style="right: 7px;top: 5px;" class="badge badge-warning navbar-badge">{{ $contactmail }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Message</span>
                <div class="dropdown-divider"></div>
                @foreach ($contacts as $mail)
                    <a href="{{ route('admin.contact.index') }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ $mail->name }}
                        <span class="float-right text-muted text-sm">{{ $mail->created_at->format('D-M-Y H:i') }}</span>
                    </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.contact.index') }}" class="dropdown-item dropdown-footer">See All
                    Notifications</a>
            </div>
        </li> --}}
        <li class="nav-item dropdown" id="change-language">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="flag-icon flag-icon-{{ $current_locale == 'en' ? 'gb' : $current_locale }}"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                @foreach ($available_locales as $locale_name => $available_locale)
                    @if ($available_locale === $current_locale)
                        <a href="{{ route('change_language', $available_locale) }}"
                            class="dropdown-item text-capitalize active">
                            <i
                                class="flag-icon flag-icon-{{ $available_locale == 'en' ? 'gb' : $available_locale }} mr-2"></i>
                            {{ $locale_name }}
                        </a>
                    @else
                        <a href="{{ route('change_language', $available_locale) }}"
                            class="dropdown-item text-capitalize">
                            <i
                                class="flag-icon flag-icon-{{ $available_locale == 'en' ? 'gb' : $available_locale }} mr-2"></i>
                            {{ $locale_name }}
                        </a>
                    @endif
                @endforeach
            </div>
        </li>

        <li class="nav-item dropdown user-menu" id="user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                {{-- <img src="{{ asset('uploads/default-profile.png') }}" class="user-image img-circle elevation-2"
                    alt="User Image"> --}}
                {{-- @if (Auth::user()->image)
                    <img class="user-image img-circle elevation-2 object-fit-cover "
                        src="{{ asset('uploads/users/' . Auth::user()->image) }}" alt="User Image">
                @else
                    <img class=" user-image img-circle elevation-2 object-fit-cover "
                        src="{{ asset('uploads/default-profile.png') }}" alt="Default Profile Image">
                @endif --}}
                @if (auth()->check() && auth()->user()->image)
                    <img class="user-image img-circle elevation-2 object-fit-cover"
                        src="{{ asset('uploads/users/' . auth()->user()->image) }}" alt="User Image">
                @else
                    <img class="user-image img-circle elevation-2 object-fit-cover"
                        src="{{ asset('uploads/default-profile.png') }}" alt="Default Profile Image">
                @endif

                {{-- <span class="d-none d-md-inline">veha</span> --}}
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <!-- User image -->
                <li class="user-header bg-primary">
                    {{-- <img src="{{ asset('uploads/default-profile.png') }}" class="img-circle elevation-2"
                        alt="User Image"> --}}
                    {{-- @if (Auth::user()->image)
                        <img class="img-circle elevation-2 object-fit-cover"
                            src="{{ asset('uploads/users/' . Auth::user()->image) }}" alt="User Image">
                    @else
                        <img class="img-circle elevation-2" src="{{ asset('uploads/default-profile.png') }}"
                            alt="Default Profile Image">
                    @endif --}}
                    @if (auth()->check() && auth()->user()->image)
                        <img class="user-image img-circle elevation-2 object-fit-cover"
                            src="{{ asset('uploads/users/' . auth()->user()->image) }}" alt="User Image">
                    @elseif (auth()->check())
                        <img class="user-image img-circle elevation-2 object-fit-cover"
                            src="{{ asset('uploads/default-profile.png') }}" alt="Default Profile Image">
                    @else
                        <img class="user-image img-circle elevation-2 object-fit-cover"
                            src="{{ asset('uploads/default-profile.png') }}" alt="Default Profile Image">
                    @endif


                    <p class="justify-content-center">
                        {{-- {{ Session::get('current_user')->name }} --}}
                        {{-- <h6>{{ Auth::user()->name }} | <small>Role :
                            {{ implode(', ', Auth::user()->roles()->pluck('name')->toArray()) }}</small></h6> --}}
                        {{-- <small>Member since {{ Auth::user()->created_at->format('d-M-Y') }}</small> --}}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ auth('user')->check() ? route('admin.header.edit', auth('user')->user()->id) : route('admin.login') }}"
                        class="btn btn-primary btn-flat float-left">
                        <i class="fas fa-pencil-alt"></i>
                        {{ __('Edit') }}
                    </a>
                    {{-- @if (auth()->user() && auth()->user()->can('user.edit'))
                    @endif --}}
                    <a href="{{ route('admin.admin-logout') }}"
                        class="btn btn-default btn-flat float-right">{{ __('Sign out') }}</a>
                </li>
            </ul>
        </li>
        <li class="nav-item d-flex align-items-center justify-content-center">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
@push('js')
    <script>
        $(document).ready(function() {
            const isPosRoute = window.location.pathname.includes('/pos');

            function toggleSidebar() {
                if (isPosRoute) {
                    $('.main-sidebar').addClass('d-none');
                    $('.sidebar-toggle-system').addClass('d-none');

                    $('.sidebar-mini.sidebar-collapse .content-wrapper').each(function() {
                        this.style.setProperty('margin-left', '0', 'important');
                    });
                    $('body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper')
                        .each(function() {
                            this.style.setProperty('margin-left', '0', 'important');
                        });
                    $('body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header')
                        .each(function() {
                            this.style.setProperty('margin-left', '0', 'important');
                        });
                    $('body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer')
                        .each(function() {
                            this.style.setProperty('margin-left', '0', 'important');
                        });
                    $('#logo-pos ,#search-product, #back-button').removeClass('d-none');
                    $('#change-language , #user-menu , #url-website , #url-pos').addClass('d-none');

                    $('body').addClass('sidebar-collapse sidebar-closed');
                } else {
                    $('.main-sidebar').removeClass('d-none');
                    $('.sidebar-toggle-system').removeClass('d-none');
                    $('#logo-pos ,#search-product, #back-button').addClass('d-none');
                    $('#back-button').removeClass('d-flex');
                    $('#back-button').addClass('d-none');
                    $('.content-wrapper').css('margin-left', '');
                    $('#change-language , #user-menu , #url-website , #url-pos').removeClass('d-none');

                    $('body').removeClass('sidebar-collapse sidebar-closed');
                }
            }

            toggleSidebar();

            $('a.pos-style').on('click', function() {
                if ($(this).attr('href').includes('type=pos')) {
                    localStorage.setItem('sidebarHidden', 'true');
                }
            });


        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            // Function to update unread count
            function updateUnreadCount() {
                $.ajax({
                    url: "{{ route('admin.unread.messages.count') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        // Update the unread count in the badge
                        $('.navbar-badge').text(response.unread_count);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching unread count:", error);
                    }
                });
            }

            // Initially fetch and update unread count with a delay
            setTimeout(function() {
                updateUnreadCount();
            }, 3000); // 3 seconds delay

            // Set interval to update unread count every 30 seconds (adjust as needed)
            setInterval(function() {
                updateUnreadCount();
            }, 15000); // 30 seconds interval
        });
    </script> --}}
@endpush
