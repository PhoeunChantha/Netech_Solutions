    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon"
        href="{{ session()->has('app_icon') && file_exists(public_path('uploads/business_settings/' . session()->get('app_icon'))) ? asset('uploads/business_settings/' . session()->get('app_icon')) : asset('uploads/image/default-icon.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    {{-- <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500&display=swap"
        rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
    {{-- bootstrap5 --}}
    <link rel="stylesheet" href="{{ asset('website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    {{-- custom --}}
    <link rel="stylesheet" href="{{ asset('website/custom/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />


    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/css/uikit.min.css" />
    {{-- tel input --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- <script src="{{ asset('website/custom/js/app.js') }}"></script> --}}
    @stack('css')
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* ::-webkit-scrollbar {
            display: none;

        } */

        /* Hide scrollbar for Firefox */
        /* * {
            scrollbar-width: none;
        } */

        /* Hide scrollbar for Internet Explorer, Edge */
        /* * {
            -ms-overflow-style: none;
        } */

        /* svg {
            width: 200px;
        } */

        /* .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e7e7ed;
            z-index: 9999;
        } */

        /* .content {
            display: none;
        } */

        /* .wavy {
            position: relative;
            -webkit-box-reflect: below -12px linear-gradient(transparent, rgba(0, 0, 0, 0.2));
        }

        .wavy span {
            position: relative;
            display: inline-block;
            color: white;
            font-size: 2em;
            text-transform: uppercase;
            animation: animate 1s ease-in-out infinite;
            animation-delay: calc(0.1s * var(--i));
        }

        @keyframes animate {
            0% {
                transform: translateY(0px);
                color: yellow opacity: 0.2;
            }

            20% {
                transform: translateY(-20px);
                color: red;
                opacity: 0.3;
            }

            40%,
            100% {
                transform: translateY(0px);

            }
        } */

        /* #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            top: 30px;
            height: ;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: red;
            color: white;
            cursor: pointer;
            padding: 15px 10px;
            border-radius: 50% border-radius: 4px;
            animation: myfirst 5s linear 2s infinite alternate;
        } */
        .go-up {
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            justify-content: center;
            align-items: center;
        }

        #myBtn {

            border: none;
            outline: none;
            background-color: #555;
            color: white;
            cursor: pointer;
            padding: 15px;
            height: 51px;
            border-radius: 50%;
            transition: transform 0.3s ease, background-color 0.3s ease;

        }

        #myBtn:hover {
            background-color: #0a4569;
            transform: scale(1.10);

        }

        a {
            text-decoration: none !important;
        }

        .discount-amount {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 16px;
            color: #ffffff;
            padding: 4px 14px;
            border-top-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .category-link.active {
            background-color: #1077B8 !important;
            color: white !important;
        }
        .category-link:hover{
            background-color: #1077B8 !important;
            color: white !important;
        }
        .dropdown-menu-categories{
            width: 200px !important;
        }
    </style>
