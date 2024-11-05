@extends('website.profile.index')
@section('content')
    <style>
        .address-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 1.5em;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .address-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #eaeaea;
            margin-bottom: 10px;
        }

        .address-card .custom-location {
            font-size: 3.5rem;
            color: #1077B8;
        }

        .rounded-circle {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #F4F4F4;
        }

        .cus-address {
            flex: 1;
            margin-left: 15px;
        }

        .cus-address h4 {
            font-size: 1em;
            margin: 0;
            font-weight: 500;
        }

        .cus-address p {
            font-size: 0.9em;
            color: #6c757d;
            margin: 5px 0 0 0;
        }

        .icons {
            display: flex;
            gap: 15px;
            color: #007bff;
        }

        .custom-delete {
            color: red;
        }

        .icons .custom-edit,
        .icons .custom-delete {
            cursor: pointer;
            font-size: 1.3rem;
            transition: color 0.3s ease;
        }

        .icons .custom-edit:hover {
            color: #0056b3;
        }

        .icons .custom-delete:hover {
            color: #dc3545;
        }
    </style>
    <div class="container address-container">
        <h2 class="title">My Address</h2>
        <a class="d-flex justify-content-center align-items-center" href="{{ route('account.editAddress') }}">
            <div class="address-card">
                <div class="div rounded-circle">
                    <i class="fa-solid fa-location-arrow custom-location"></i>
                </div>
                <div class="cus-address">
                    <h4>Home</h4>
                    <p>Siem Reap Post Office, Pokambor Avenue, Siem Reap</p>
                </div>
                <div class="icons">
                    <a href="">
                        <i class="fa-solid fa-pen-to-square custom-edit"></i>
                    </a>
                    <a href="">
                        <i class="fa-solid fa-trash-can custom-delete"></i>
                    </a>
                </div>
            </div>
        </a>
        <a class="d-flex justify-content-center align-items-center" href="{{ route('account.editAddress') }}">
            <div class="address-card">
                <div class="div rounded-circle">
                    <i class="fa-solid fa-location-arrow custom-location"></i>
                </div>
                <div class="cus-address">
                    <h4>Home</h4>
                    <p>Siem Reap Post Office, Pokambor Avenue, Siem Reap</p>
                </div>
                <div class="icons">
                    <a href="">
                        <i class="fa-solid fa-pen-to-square custom-edit"></i>
                    </a>
                    <a href="">
                        <i class="fa-solid fa-trash-can custom-delete"></i>
                    </a>
                </div>
            </div>
        </a>
    </div>
@endsection
