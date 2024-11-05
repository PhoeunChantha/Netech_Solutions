@extends('website.profile.index')
<style>
    /* .order-container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    } */

    .order-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: bold;
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .order-id {
        color: #333;
    }

    .order-status {
        padding: 5px 10px;
        background-color: #d9ecff;
        color: #007bff;
        border-radius: 15px;
        font-size: 0.9em;
    }

    .order-date {
        font-size: 0.9em;
        color: #666;
        margin-bottom: 10px;
    }

    .product-section {
        display: flex;
        /* align-items: center; */
        gap: 15px;
        margin-bottom: 15px;
    }

    .product-section img {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-info {
        flex: 1;
    }

    .product-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
    }

    .product-variant {
        font-size: 15px;
        color: #888;
    }

    .review-section {
        font-size: 0.9em;
        color: #333;
        margin-bottom: 15px;
    }

    .review-stars {
        /* display: flex; */
        align-items: center;
        font-size: 1em;
        color: #FFD43B;
        margin-bottom: 5px;
    }

    .review-stars i {
        margin-right: 2px;
    }

    .review-text {
        color: #555;
        font-size: 16px;
    }

    .review-image img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        margin-top: 5px;
    }

    .update-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #1077B8;
        color: #fff;
        font-weight: bold;
        text-align: center;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        margin-top: 15px;
        float: right;
    }

    .update-button:hover {
        background-color: #0056b3;
    }
</style>
@section('content')
    <div class="container order-detail-container card-outline card-outline-tabs">
        <div class="card p-4">
            <h4 class="fw-bold text-dark fs-5 mb-2">Order ID #100216 <span class="order-status">Processing</span></h4>
            <small>17th Jan, 2023 03:01 PM</small>
            @include('website.order-history.partials.tab')
            <div class="tab-content mt-3" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                    aria-labelledby="custom-tabs-four-home-tab">
                    <div class="mt-2">
                        <div class="row">
                            <div class="order-container">
                                <!-- Product Section -->
                                <div class="product-section">
                                    <img src="https://via.placeholder.com/80" alt="Product Image">
                                    <div class="product-information mt-0">
                                        <div class="product-title">Exclusive And Fashion suit for woman</div>
                                        <div class="product-variant">Variant: Amethyst-s</div>
                                    </div>
                                </div>

                                <!-- Review Section -->
                                <div class="review-section">
                                    <div class="review-stars">
                                        <span>5.0</span>
                                        <i class="fa fa-star"></i>
                                        <span>My Reviews</span>
                                    </div>
                                    <div class="review-text">good</div>
                                    <div class="review-image">
                                        <img src="https://via.placeholder.com/50" alt="Review Image">
                                    </div>
                                </div>

                                <!-- Update Review Button -->
                                <div class="update-review">
                                    <button class="update-button">Update Review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('website.order-history.rating')
@endsection
