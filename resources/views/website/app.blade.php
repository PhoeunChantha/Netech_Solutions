<!DOCTYPE html>
<html lang="en">

<head>
    @include('website.layout.header')
</head>

<body>
    <div class="wrapper">
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
    @include('website.layout.script')
</body>

</html>
