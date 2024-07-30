<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title', 'Admin Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/x-icon"
        href="{{ session()->has('app_icon') && file_exists(public_path('uploads/business_settings/' . session()->get('app_icon'))) ? asset('uploads/business_settings/' . session()->get('app_icon')) : asset('uploads/image/default-icon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- flag-icon-css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- summernote --}}
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="{{ asset('backend/sweetalert2/css/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
        type="text/css" media="screen" />

    <link rel="stylesheet" href="{{ asset('backend/custom/css/app.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    @stack('css')
</head>

<style type="text/css">
    * {
        font-family: "Kantumruy Pro", sans-serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
        /* font-size: 15px; */
    }

    .pagination {
        float: right;
        margin-top: 10px;
    }

    .bootstrap-tagsinput {
        width: 100%;
    }

    .label-info {
        background-color: #17a2b8;

    }

    .label {
        display: inline-block;
        padding: .25em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out;
        border-color .15s ease-in-out,
        box-shadow .15s ease-in-out;
    }

    @font-face {
        font-family: 'Montserrat', sans-serif, 'Hanuman';
        src: url('public/font/Hanuman-Light.ttf') format('ttf');
        src: url('public/font/Montserrat-Light.ttf') format('ttf');
    }

    .required_lable::after {
        content: " *";
        color: red;

    }

    :root {
        --system-font: 'Montserrat', sans-serif, 'Hanuman';
    }
</style>
<style>
    body {}

    .text-sm .btn {
        font-size: 12px !important;
    }

    .dropdown-item {
        cursor: pointer;
    }

    /* Hide scrollbar for Chrome, Safari, and Opera */
    ::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for Firefox */
    * {
        scrollbar-width: none;
        /* Firefox */
    }

    /* Hide scrollbar for Internet Explorer, Edge */
    * {
        -ms-overflow-style: none;
        /* IE and Edge */
    }

    .layout-navbar-fixed.sidebar-mini.sidebar-collapse.text-sm .wrapper .brand-link {
        height: calc(4.9rem + 1px) !important;
    }
</style>
