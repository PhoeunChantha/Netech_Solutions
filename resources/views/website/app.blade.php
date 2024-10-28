<!DOCTYPE html>
<html lang="en">
<head>
    @include('website.layout.header')
</head>
<body>

    <div class="wrapper">
        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            @include('website.layout.preloader')
        </div> --}}

        <!-- Navbar -->
        @include('website.layout.navbar')
        <!-- End Navbar -->

        <!-- Main Content -->
        <div class="content-wrapper">
            @yield('contents')
        </div>
        <!-- End Main Content -->

        <!-- Footer -->
        @include('website.layout.footer')
        <!-- End Footer -->

    </div>
    <div class="go-up">
        <button onclick="topFunction()" id="myBtn" title="Go to top">
            <i class="fa-solid fa-chevron-up fa-lg"></i>
        </button>
    </div>
    @include('website.layout.script')
</body>
</html>
