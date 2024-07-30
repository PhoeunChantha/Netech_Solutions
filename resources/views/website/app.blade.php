<!DOCTYPE html>
<html lang="en">

<head>
    @include('website.layout.header')
    

</head>

<body>

    <div class="wrapper">
        {{-- <div class="preloader">
            @include('website.layout.preloader')
        </div> --}}
        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            @include('website.layout.preloader')
        </div> --}}

        <!-- Navbar -->
        @include('website.layout.navbar')
        <!-- End Navbar -->

        <!-- Main Content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- End Main Content -->

        <!-- Footer -->
        @include('website.layout.footer')
        <!-- End Footer -->

    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-solid fa-angle-double-up fa-bounce fa-lg"></i>
    </button>

    @include('website.layout.script')
</body>

</html>
