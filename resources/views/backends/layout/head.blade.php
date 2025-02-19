<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title', 'Admin Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
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
</head>
<style>
    /* input[type="radio"], */
    input[type="checkbox"] {
        cursor: pointer;
        outline-style: none;
        position: relative;
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        /* margin-bottom: -0.25em; */
        /* margin-right: 1px; */
        vertical-align: top;
    }


    input[type="checkbox"] {
        background-color: #fff;
        border: 1px solid gray;
        border-radius: 4px;
        color: #484848;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
    }

    input[type="radio"] {
        background-color: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 50px;
        color: #484848;
        outline-style: none;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
    }


    input[type="checkbox"]:checked:after

    /* input[type="radio"]:checked:after */
        {
        background: #060E9F;
        border: solid 1px #060E9F;
        color: #ffffff;
        font-weight: bold;
        position: absolute;
        text-align: center;
        width: 100%;
        height: 100%;

    }

    input[type="checkbox"]:checked:after {
        border-radius: 3px;
        content: "✓";
        /* font-size: 0.7em; */
        line-height: 1.1;
    }

    /* input[type="radio"]:disabled, */
    input[type="checkbox"]:disabled {
        background: #F2F6F9;
        border: solid 1px #e8e8e8;
        pointer-events: none;
    }

    .Checkbox-parent {
        height: 24px;
    }

    ul {
        list-style: none;
    }

    .Accordion-panel {
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }

    .Accordion-panel:last-of-type {
        /* border-bottom: solid 1px #e8e8e8; */
        /* padding-bottom: 16px; */
    }
</style>
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
<style>
   

    #bookingTableButtons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #bookingTableButtons .dt-buttons {
        display: flex;
    }

    #bookingTableButtons .dt-buttons .dt-button {
        margin: 0;
        border: 1px solid #DDDDDD;
        border-radius: 0;
        background: #A1E9C9;
        color: #229865;
        padding: .3rem .65rem;
        font-size: 10px;
    }

    #bookingTableButtons input[type="search"] {
        height: 27px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        width: 120px;
    }

    #bookingTable_length label {
        font-size: 12px;
        margin-top: .5rem;
    }

    #bookingTable_length label select {
        width: 4rem;
        height: 1.5rem;
        border-radius: 5px;
    }

    #bookingTable_filter label {
        margin: 0;
    }

    #bookingTable_info {
        padding-top: 1.5rem;
    }

    #bookingTable_paginate {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
    }

    .table-wrapper {
        overflow-x: auto;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .table-wrapper::-webkit-scrollbar {
        display: none;
    }
</style>
@stack('css')
