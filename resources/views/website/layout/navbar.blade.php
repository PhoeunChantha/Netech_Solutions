<nav class="navbar bg-body-tertiary" style="background-color: white">
    <div class="container-fluid sticky1 justify-content-around p-2">
        <div class="nav-leftside text-center col-md-2">
            <a class="navbar-brand" href="{{ route('home') }}">
                {{-- <img src="\website\upload\weblogo.png" alt="not found" width="50%" class="logo"> --}}
                <img src="@if (session()->has('app_logo') && file_exists('uploads/business_settings/' . session()->get('app_logo'))) {{ asset('uploads/business_settings/' . session()->get('app_logo')) }} @else {{ asset('uploads/image/default.png') }} @endif"
                    alt="" width="60%" class="logo">
            </a>
        </div>
        <div class="col-md-2 phone-container">
            <div class="form-group phone-number">
                <i class="fa fa-phone fa-xl" style="color: #1077B8"></i>
                <span class="" style="color: #1077B8;font-weight: 600;">+855 123 456 789</span>
            </div>
        </div>
        <div class="col-md-5 search-container">
            <div class="row">
                <form action="#">
                    <div class="input-group">
                        <input type="search" id="searchs" class="form-control search"
                            placeholder="Search product here">
                        <div class="input-group-append btn-search">
                            <button type="submit" class="btn">
                                <i class="fa fa-search" style="color: #ffffff"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="checkin p-1 justify-content-center align-items-center">
            <a href="#">
                <i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff"></i>
                <span class="badge bg-danger badge-small">0</span>
            </a>
        </div>
        <div class="checkin p-1 justify-content-center align-items-center">
            <a href="#">
                <img src="{{ asset('/website/nav/bag.png') }}" alt="bag">
                <span class="badge bg-danger badge-small">0</span>
            </a>
        </div>
        @guest
            <div class="btn-login">
                {{-- <a href="{{ route('customer.login') }}" type="button" class="btn btn-login" data-toggle="modal" data-target="#exampleModal">
                    {{ __('Login') }}
                </a> --}}
                <a href="{{ route('customer.login') }}" type="button" class="btn btn-login" >
                    {{ __('Login') }}
                </a>
            </div>
        @endguest
        @auth
            <div class="dropdown dropdown-profile dropstart text-end btn-login ">

                <a type="button" id="dropdown-toggle" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                    <img width="25px" height="25px"
                        src="@if (auth()->user()->image && file_exists(public_path('uploads/users/' . auth()->user()->image ))) {{ asset('uploads/users/' .auth()->user()->image ) }}
                                              @else
                                                  {{ asset('uploads/default-profile.png') }} @endif"
                        alt="Preview Image">
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-front" style="display: none">
                    <a href="{{ route('account.profile') }}" class="dropdown-item">
                        <i class="fa fa-user"></i>
                        {{ __('Profile') }}
                    </a>
                    <a href="{{ route('web.logout') }}" class="dropdown-item text-danger">
                        <i class="fa fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>
                </ul>
            </div>
        @endauth
        <div class="dropdown align-content-center text-center">
            <a class="nav-link flag-country p-1 dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="flag-icon flag-icon-{{ $current_locale == 'en' ? 'gb' : $current_locale }}"></i>
                {{ array_search($current_locale, $available_locales) }}
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                @foreach ($available_locales as $locale_name => $available_locale)
                    @if ($available_locale === $current_locale)
                        <a href="{{ route('change_language', $available_locale) }}"
                            class="dropdown-item text-capitalize active dropdown-item-primary">
                            <i
                                class="flag-icon flag-icon-{{ $available_locale == 'en' ? 'gb' : $available_locale }} mr-2"></i>
                            {{ $locale_name }}
                        </a>
                    @else
                        <a href="{{ route('change_language', $available_locale) }}"
                            class="dropdown-item text-capitalize dropdown-item-primary">
                            <i
                                class="flag-icon flag-icon-{{ $available_locale == 'en' ? 'gb' : $available_locale }} mr-2"></i>
                            {{ $locale_name }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <style>
            .flag-country {
                border: 2px solid #1077B8;
                color: #1077B8 !important;
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
        </style>
        {{-- <div class="nav-rightside justify-content-center col-md-10 d-flex gap-3 hidden" id="">
        </div> --}}
    </div>
    <div id="sticky2" class="container-fluid sticky-top justify-content-around" style="background-color:#1077B8">
        <div class="nav-rightside1 justify-content-center col-md-12 d-flex " id="navRightside">
            <div class="row">
                {{-- <div class="col-md-12"> --}}
                <ul class="nav d-flex align-items-center justify-content-center gap-4">
                    <li class="nav-item p-1">
                        <a class="nav-link text-center fs-5 {{ Request::is('/') ? ' active' : '' }}"
                            aria-current="page" href="{{ route('home') }}"> <i
                                class="fas fa-home m-1"></i>{{ __('Home') }}</a>
                    </li>
                    {{-- @foreach ($categories as $item)
                        <li class="nav-item">
                            <a class="nav-link text-center fs-5 {{ Request::routeIs($item->slug . '.show') ? 'active' : '' }}"
                                href="{{ route($item->slug . '.show', $item->slug) }}">
                                <img src="
                            @if ($item->icon_images && file_exists(public_path('uploads/category/' . $item->icon_images))) {{ asset('uploads/category/' . $item->icon_images) }}
                            @else
                                {{ asset('uploads/default.png') }} @endif"
                                    alt="{{ $item->name }}">
                                {{ $item->name }}
                            </a>
                        </li>
                    @endforeach --}}
                    @foreach ($categories as $item)
                        <li class="nav-item ">
                            <a class="nav-link gap-1 d-flex justify-content-center align-items-center text-center fs-5 {{ Request::routeIs('category.show') && Request::route('slug') == $item->slug ? 'active' : '' }}"
                                href="{{ route('category.show', $item->slug) }}">
                                <img src="
                                    @if ($item->icon_images && file_exists(public_path('uploads/category/' . $item->icon_images))) {{ asset('uploads/category/' . $item->icon_images) }}
                                    @else
                                        {{ asset('uploads/default.png') }} @endif"
                                    alt="{{ $item->name }}">
                                {{ $item->name }}
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item p-1">
                        <a class="nav-link text-center {{ Request::routeIs('service.show') ? ' active' : '' }}"
                            href="{{ route('service.show') }}">
                            <img class="m-1 fs-5" src="/website/nav/about.png" alt="not found">{{ __('Services') }}
                        </a>
                    </li>

                    <li class="nav-item p-1">
                        <a class="nav-link   text-center {{ Request::routeIs('aboutus.show') ? ' active' : '' }}"
                            href="{{ route('aboutus.show') }}">
                            {{-- <i class="fa-solid fa-circle-exclamation px-2" style="color: #ffffff;"></i> --}}
                            <img class="m-1 fs-5" src="\website\nav\about.png" alt="not found">{{ __('ABOUT US') }}
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link   text-center  {{ Request::routeIs('contact.show') ? ' active' : '' }} "
                            href="{{ route('contact.show') }}">
                            {{-- <i class="fa-solid fa-user-pen px-2" style="color: #ffffff;"></i> --}}
                            <img class="m-1 fs-5" src="\website\nav\contact.png"
                                alt="not found">{{ __('Contact Us') }}
                        </a>
                    </li>
                </ul>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    @include('website.layout.modal_login')
</nav>
@push('js')
    {{-- <script>
        $(document).ready(function() {
            $('#dropdown-toggle').on('click', function() {
                $(this).next('.dropdown-menu').toggle();
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const darkToggle = document.querySelector('.dark-toggle');
            const body = document.body;

            darkToggle.addEventListener('click', function() {
                body.classList.toggle('dark');
            });
        });

        window.onscroll = function() {
            myFunction()
        };
        var navbar = document.getElementById("sticky2");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky");
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script> --}}
@endpush
