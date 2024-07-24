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
                        <input type="search" class="form-control search" placeholder="Search product here">
                        <div class="input-group-append btn-search">
                            <button type="submit" class="btn">
                                <i class="fa fa-search" style="color: #ffffff"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="checkin p-1 justify-content-center">
            <a href="#">
                <i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff"></i>
                <span class="badge bg-danger badge-small">0</span>
            </a>
        </div>

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
        @guest
            <div class="btn-login">
                <a type="button" class="btn btn-login" data-toggle="modal" data-target="#exampleModal">
                    {{ __('Login') }}
                </a>
            </div>
        @endguest
        @auth
            <div class="dropdown dropdown-profile dropstart text-end btn-login ">
                <a type="button" id="dropdown-toggle" class="btn dropdown-toggle" data-bs-toggle="dropdown">
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
                <ul class="nav justify-content-center gap-3">
                    <li class="nav-item p-1">
                        <a class="nav-link active text-center gap-1" aria-current="page" href="#"> <i
                                class="fas fa-home"></i>{{ __('Home') }}</a>
                    </li>
                    @foreach ($cate as $item)
                        <li class="nav-item p-1">
                            <a class="nav-link active text-center gap-1" href="#"> <i
                                    class="fas fa-home"></i>{{ $item->name }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link active  text-center " href="#">
                            {{-- <i class="fa-solid fa-circle-exclamation px-2" style="color: #ffffff;"></i> --}}
                            <img class="m-1" src="\website\nav\about.png" alt="not found">{{ __('ABOUT US') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active  text-center " href="#">
                            {{-- <i class="fa-solid fa-user-pen px-2" style="color: #ffffff;"></i> --}}
                            <img class="m-1" src="\website\nav\contact.png" alt="not found">{{ __('Contact Us') }}
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
    <script>
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
    </script>
@endpush
