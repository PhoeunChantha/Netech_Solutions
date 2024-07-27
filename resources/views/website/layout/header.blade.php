    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon"
        href="{{ session()->has('app_icon') && file_exists(public_path('uploads/business_settings/' . session()->get('app_icon'))) ? asset('uploads/business_settings/' . session()->get('app_icon')) : asset('uploads/image/default-icon.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- bootstrap5 --}}
    <link rel="stylesheet" href="{{ asset('website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <script src="{{ asset('website/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- custom --}}
    <link rel="stylesheet" href="{{ asset('website/custom/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    {{-- <link rel="stylesheet" href="{{ asset('website/sweetalert2/css/sweetalert2.min.css') }}"> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">


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

        svg {
            width: 200px;
        }

        .preloader {
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
        }

        .content {
            display: none;
            /* Hide content initially */
        }

        .wavy {
            position: relative;
            /* top: 27em; */

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
        }
    </style>
