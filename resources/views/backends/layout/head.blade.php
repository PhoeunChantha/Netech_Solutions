<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title', 'Admin Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon"
        href="{{ session()->has('app_icon') && file_exists(public_path('uploads/business_settings/' . session()->get('app_icon'))) ? asset('uploads/business_settings/' . session()->get('app_icon')) : asset('uploads/image/default-icon.png') }}">

    <!-- Google Font: Source Sans Pro -->
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
    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
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
    {{-- DataTable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<style>
    .tooltip-inner {
        background-color: white !important;
        color: black !important;
        border: 1px solid #ccc !important;
    }

    .tooltip-arrow {
        border-top-color: white !important;
    }

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

    .required_label::after {
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
    /* ✅ default-dataTable */
    #defaultdataTableButtons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #defaultdataTableButtons .dt-buttons {
        display: flex;
    }

    #defaultdataTableButtons .dt-buttons .dt-button {
        margin: 0;
        background-color: #f4f4f4;
        color: #444;
        border-color: #ddd;
        padding: .3rem .65rem;
        font-size: 10px;
    }

    /* ✅ Search Bar & Pagination */
    #defaultdataTableButtons input[type="search"] {
        height: 27px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        width: 120px;
    }

    #defaultdataTable_length label {
        font-size: 12px;
        margin-top: .5rem !important;
    }

    #defaultdataTable_length label select {
        width: 4rem;
        height: 1.5rem;
        border-radius: 5px;
    }

    #defaultdataTable_filter label {
        margin: 0;
    }

    #defaultdataTable_info {
        padding-top: 1.5rem;
    }

    #defaultdataTable_paginate {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
    }
    
     /* ✅ Discount Table */
     #discountTableButtons,#sellreportTableButtons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #discountTableButtons .dt-buttons , #sellreportTableButtons .dt-buttons{
        display: flex;
    }

    #discountTableButtons .dt-buttons .dt-button , #sellreportTableButtons .dt-buttons .dt-button{
        margin: 0;
        background-color: #f4f4f4;
        color: #444;
        border-color: #ddd;
        padding: .3rem .65rem;
        font-size: 10px;
    }

    /* ✅ Search Bar & Pagination */
    #discountTableButtons input[type="search"], #sellreportTableButtons input[type="search"]{
        height: 27px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        width: 120px;
    }

    #defaultdataTable_length label,#sellreportTable_length label {
        font-size: 12px;
        margin-top: .5rem !important;
    }

    #discountTable_length label select, #sellreportTable_length label select{
        width: 4rem;
        height: 1.5rem;
        border-radius: 5px;
    }

    #discountTable_filter label, #sellreportTable_filter label{
        margin: 0;
    }

     #sellreportTable_info{
        padding-top: 1.5rem;
    }

    #sellreportTable_paginate{
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
    }
    #discountTable_info{
        padding: 1rem;
    }

    #discountTable_paginate{
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
        margin: 1rem;
    }

    /* ✅ purchase Table Buttons */
    #purchaseTableButtons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #purchaseTableButtons .dt-buttons {
        display: flex;
    }

    #purchaseTableButtons .dt-buttons .dt-button {
        margin: 0;
        background-color: #f4f4f4;
        color: #444;
        border-color: #ddd;
        padding: .3rem .65rem;
        font-size: 10px;
    }

    /* ✅ Search Bar & Pagination */
    #purchaseTableButtons input[type="search"] {
        height: 27px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        width: 120px;
    }

    #purchaseTable_length label {
        font-size: 12px;
        margin-top: .5rem !important;
    }

    #purchaseTable_length label select {
        width: 4rem;
        height: 1.5rem;
        border-radius: 5px;
    }

    #purchaseTable_filter label {
        margin: 0;
    }

    #purchaseTable_info {
        padding-top: 1.5rem;
    }

    #purchaseTable_paginate {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
    }

    /* ✅ Purchase Table Buttons */
    #purchaseTableButtons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #purchaseTableButtons .dt-buttons {
        display: flex;
    }

    #purchaseTableButtons .dt-buttons .dt-button {
        margin: 0;
        background-color: #f4f4f4;
        color: #444;
        border-color: #ddd;
        padding: .3rem .65rem;
        font-size: 10px;
    }

    /* ✅ Search Bar & Pagination */
    #purchaseTableButtons input[type="search"] {
        height: 27px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        width: 120px;
    }

    #purchaseTable_length label {
        font-size: 12px;
        margin-top: .5rem !important;
    }

    #purchaseTable_length label select {
        width: 4rem;
        height: 1.5rem;
        border-radius: 5px;
    }

    #purchaseTable_filter label {
        margin: 0;
    }

    #purchaseTable_info {
        padding-top: 1.5rem;
    }

    #purchaseTable_paginate {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
    }

    /* ✅ purchase Table Buttons */
    #purchaseTableButtons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #purchaseTableButtons .dt-buttons {
        display: flex;
    }

    #purchaseTableButtons .dt-buttons .dt-button {
        margin: 0;
        background-color: #f4f4f4;
        color: #444;
        border-color: #ddd;
        padding: .3rem .65rem;
        font-size: 10px;
    }

    /* ✅ Search Bar & Pagination */
    #purchaseTableButtons input[type="search"] {
        height: 27px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        width: 120px;
    }

    #purchaseTable_length label {
        font-size: 12px;
        margin-top: .5rem !important;
    }

    #purchaseTable_length label select {
        width: 4rem;
        height: 1.5rem;
        border-radius: 5px;
    }

    #purchaseTable_filter label {
        margin: 0;
    }

    #purchaseTable_info {
        padding-top: 1.5rem;
    }

    #purchaseTable_paginate {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
    }

    /* ✅ Transaction Table Buttons */
    #transactionTableButtons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #transactionTableButtons .dt-buttons {
        display: flex;
    }

    #transactionTableButtons .dt-buttons .dt-button {
        margin: 0;
        background-color: #f4f4f4;
        color: #444;
        border-color: #ddd;
        padding: .3rem .65rem;
        font-size: 10px;
    }

    /* ✅ Search Bar & Pagination */
    #transactionTableButtons input[type="search"] {
        height: 27px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        width: 120px;
    }

    #transactionTable_length label {
        font-size: 12px;
        margin-top: .5rem !important;
    }

    #transactionTable_length label select {
        width: 4rem;
        height: 1.5rem;
        border-radius: 5px;
    }

    #transactionTable_filter label {
        margin: 0;
    }

    #transactionTable_info {
        padding-top: 1.5rem;
    }

    #transactionTable_paginate {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-block: 0rem;
        margin-block: 1rem;
    }

    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before {
        content: " 🠗" !important;
        font-size: 18px !important;
        opacity: 1;
        color: #000;
        padding-right: 6px;
        line-height: 0 !important;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_desc:after {
        content: " 🠕" !important;
        font-size: 18px !important;
        line-height: 0 !important;
    }

    .table-wrapper {
        overflow-x: auto;
        -ms-overflow-style: none;
        /* Hide scrollbar for IE and Edge */
        scrollbar-width: none;
        /* Hide scrollbar for Firefox */
    }

    .table-wrapper::-webkit-scrollbar {
        display: none;
        /* Hide scrollbar for Chrome, Safari, and Opera */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.first,
    .dataTables_wrapper .dataTables_paginate .paginate_button.last {
        display: none !important;
        /* Hide first and last pagination buttons */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(90deg,
                rgba(243, 49, 247, 1) 8%,
                rgba(87, 158, 255, 1) 70%) !important;
        border: 1px solid  rgba(243, 49, 247, 1) !important;
        color: #F2F6F9 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: linear-gradient(90deg,
                rgba(243, 49, 247, 1) 8%,
                rgba(87, 158, 255, 1) 70%) !important;
        border: 1px solid  rgba(243, 49, 247, 1);
        color: #F2F6F9 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #F2F6F9 !important;
    }
</style>
@stack('css')
