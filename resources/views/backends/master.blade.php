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
        $('.dataTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "initComplete": function(settings, json) {
                $('.dataTables_length').addClass('mt-2');
                $('.dataTables_filter input').addClass('mt-2 mr-2');
            }
        });
    </script>
</body>

</html>
