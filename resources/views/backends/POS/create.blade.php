@extends('backends.master')
<style>
    .category-tabs {
        display: flex;
        justify-content: space-around;
        /* Adjust card alignment */
        background-color: #f4f4f4;
        padding: 5px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        gap: 5px;
        /* Add space between cards */
    }

    .category-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 88px;
        /* Reduced width */
        padding: 5px;
        /* Tighter padding */
        border-radius: 8px;
        /* Smaller rounding */
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        background-color: white;
        margin: 0 5px;
        /* Add horizontal space between cards */
    }

    .category-card img {
        width: 30px;
        /* Smaller image */
        height: 30px;
        margin-bottom: 3px;
        /* Reduced spacing */
    }

    .category-card p {
        font-size: 12px;
        /* Smaller font */
        margin: 0;
        color: #333;
    }

    .category-card:hover {
        border: 1px solid #007bff;
    }

    .category-card.selected {
        border: 1px solid #007bff;
        box-shadow: 0 2px 6px rgba(0, 123, 255, 0.3);
        /* Lighter shadow */
    }

    /* style card desktop */

    /* .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 20px;
    padding: 20px;
} */

    .product-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card img {
        width: 100px;
        height: 100px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .product-card .product-title {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin: 5px 0;
    }

    .product-card .product-price {
        font-size: 14px;
        color: green;
    }

    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .product-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card img {
        width: 150px;
        height: 120px;

        object-fit: contain;
        margin-bottom: 10px;
    }
    /* img{
        width: 100px;
        height: 100px;
    } */

    .product-card .product-title {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin: 5px 0;
    }

    .product-card .product-price {
        font-size: 14px;
        color: green;
    }

    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .pay {
        margin-top: 390px;
        /* background: red; */
    }

    .line {

        border-top: 1px solid #ccc;


    }
</style>
@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 d-flex flex-column">
                    <div class="content">
                        <div class="mt-1">
                            <div class="row mt-3">
                                <div>
                                    <select class="form-control" style="width: 450px;">
                                        <option>Walk In Customer</option>
                                        <option>Registered Customer</option>
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-primary ml-2" style="height: 37px">Add Customer</button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="row">
                                <table class="table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Product</td>
                                            <td>Quantity</td>
                                            <td>Unit Price</td>
                                            <td>Subtotal</td>


                                        </tr>
                                    </tbody>
                                </table>
                                <div class="pay col-12">

                                    <div class="card w-100">
                                        <div class="container text-center">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="d-flex">
                                                        <div class="p-2 col-md-6">Subtotal</div>
                                                        <div class="p-2 col-md-6">4.00$</div>
                                                    </div>

                                                    <div class="d-flex line w-100">
                                                        <div class="p-2 col-md-6">Discount</div>
                                                        <div class="p-2 col-md-6">0.00$</div>
                                                    </div>

                                                    <div class="d-flex line w-100">
                                                        <div class="p-2 col-md-6">Total</div>
                                                        <div class="p-2 col-md-6">4.00$</div>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-primary w-75 m-3" >Discount</button>
                                                    <button class="btn btn-primary w-75 " >Total</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Cart Section -->

                <div class="col-md-6 mt-3">
                    <div class="category-tabs">
                        <div class="category-card">
                            <img src="all.png" alt="All">
                            <p>All</p>
                        </div>
                        <div class="category-card selected">
                            <img src="desktop.png" alt="Desktop">
                            <p>Desktop</p>
                        </div>
                        <div class="category-card">
                            <img src="laptop.png" alt="Laptop">
                            <p>Laptop</p>
                        </div>
                        <div class="category-card">
                            <img src="accessories.png" alt="Accessories">
                            <p>Accessories</p>
                        </div>
                        <div class="category-card">
                            <img src="cctv.png" alt="CCTV">
                            <p>CCTV</p>
                        </div>
                        <div class="category-card">
                            <img src="cctv.png" alt="CCTV">
                            <p>CCTV</p>
                        </div>
                        <div class="category-card">
                            <img src="cctv.png" alt="CCTV">
                            <p>CCTV</p>
                        </div>
                    </div>
                    <div class="product-grid">
                        <div class="product-card">
                            <img src="uploads/posimg1.png" alt="Dell Desktop">
                            <p class="product-title">Dell desktop</p>
                            <p class="product-price">$2000.00</p>
                        </div>
                        <div class="product-card">
                            <img src="uploads/posimg1.png" alt="Dell Desktop">
                            <p class="product-title">Dell desktop</p>
                            <p class="product-price">$2000.00</p>
                        </div>
                        <div class="product-card">
                            <img src="uploads/posimg1.png" alt="Dell Desktop">
                            <p class="product-title">Dell desktop</p>
                            <p class="product-price">$2000.00</p>
                        </div>
                        <div class="product-card">
                            <img src="uploads/posimg1.png" alt="Dell Desktop">
                            <p class="product-title">Dell desktop</p>
                            <p class="product-price">$2000.00</p>
                        </div>
                        <div class="product-card">
                            <img src="uploads/posimg1.png" alt="Dell Desktop">
                            <p class="product-title">Dell desktop</p>
                            <p class="product-price">$2000.00</p>
                        </div>
                        <div class="product-card">
                            <img src="uploads/posimg1.png" alt="Dell Desktop">
                            <p class="product-title">Dell desktop</p>
                            <p class="product-price">$2000.00</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>


    </section>
@endsection
