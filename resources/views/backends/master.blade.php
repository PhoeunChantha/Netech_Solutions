<!DOCTYPE html>
<html lang="en">
@include('backends.layout.head')
{{-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed"> --}}

<body class="sidebar-mini layout-fixed layout-navbar-fixed text-sm">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('backends.layout.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('backends.layout.sidebar')

        <div class="content-wrapper">

            @yield('contents')

        </div>
        <footer class="main-footer text-center">
            <div class="float-right d-none d-sm-block">
                {{-- <b>Version</b> 3.2.0 --}}
            </div>
            <strong>{{ session()->get('copy_right_text') }}</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('backends.layout.script')
    <script>
        $(function() {
            $('.dataTable').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

    </script>
</body>

</html>
