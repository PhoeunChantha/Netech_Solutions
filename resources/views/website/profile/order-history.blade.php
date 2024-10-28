@extends('website.profile.index')
@section('content')
    <div class="container order-container">
        <h3>My Order</h3>
        <!-- Order Card 1 -->
        <a href="http://">
            <div class="order-card col-12  mb-3">
                <div class="row d-flex align-items-center">
                    <div class="col-4 d-flex align-items-center">
                        <img src="path/to/logo.png" alt="Logo" class="order-logo">
                        <div class="order-details">
                            <p><strong>Order ID #100171</strong></p>
                            <p>1 Product</p>
                            <p>10 Jan, 2024 09:10 PM</p>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <p class="price">$500.00</p>
                    </div>
                    <div class="col-4">
                        <div class="order-price">
                            <span class="badge badge-primary">Processing</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="http://">
            <div class="order-card col-12  mb-3">
                <div class="row d-flex align-items-center">
                    <div class="col-4 d-flex align-items-center">
                        <img src="path/to/logo.png" alt="Logo" class="order-logo">
                        <div class="order-details">
                            <p><strong>Order ID #100171</strong></p>
                            <p>1 Product</p>
                            <p>10 Jan, 2024 09:10 PM</p>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <p class="price">$500.00</p>
                    </div>
                    <div class="col-4">
                        <div class="order-price">
                             <span class="badge badge-success">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endsection
