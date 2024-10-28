@extends('website.app')
@section('contents')
    @include('website.desktop.product-detail-style')
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 mt-4">
                    <div class="row  d-flex justify-content-center">
                        <div class="col-6 px-4">
                            <div class="row mb-5 d-flex justify-content-center px-3">
                                <div class="col-sm-3 sticky-sub-image">
                                    <div class="sub-img mb-2">
                                        <img src="{{ asset('website/upload/image1.png') }}" alt=""
                                            onclick="changeBigImage(this)">
                                    </div>
                                    <div class="sub-img mb-2    ">
                                        <img src="{{ asset('website/upload/img1.png') }}" alt=""
                                            onclick="changeBigImage(this)">
                                    </div>
                                    <div class="sub-img ">
                                        <img src="{{ asset('website/upload/img2.png') }}" alt=""
                                            onclick="changeBigImage(this)">
                                    </div>
                                    <div class="sub-img ">
                                        <img src="{{ asset('website/upload/img3.png') }}" alt=""
                                            onclick="changeBigImage(this)">
                                    </div>
                                    <div class="sub-img ">
                                        <img src="{{ asset('website/upload/img4.png') }}" alt=""
                                            onclick="changeBigImage(this)">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="big-img">
                                        <img id="bigImage" src="{{ asset('website/upload/image1.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 shadow-sm overview p-4 mb-5">
                                <div class="d-flex gap-4 mb-3">
                                    <button class="btn btn-primary" type="button">Overview</button>
                                    <button class="btn btn-danger" type="button">Review</button>
                                </div>
                                <div class="row mb-3">
                                    <h5 class="fs-4">Description</h5>
                                    <div class="description">
                                        Welcome to dinoclaire.my shop! We provide the best service and the best beauty
                                        products.Wholesale please. Wholesale please. Lorem ipsum dolor sit amet consectetur.
                                        Ultrices nulla eu nibh est sagittis eget in. Porttitor tempus cursus mauris enim sit
                                        ut
                                        elementum sed nunc. Phasellus ac sagittis in elit a in amet porttitor. Id potenti
                                        ultricies egestas turpis massa Phasellus ac sagittis in elit a in amet porttitor. .
                                    </div>
                                </div>
                                <div class="row">
                                    <h5 class="fs-4">Specification</h5>
                                    <div class="Specification">
                                        - Ram: 16 GB LPDDR5x 7467MT/s- SSD: 1TB PCiE Gen 4- Optical Drive: None- VGA:
                                        Intel Arc Graphics- WiFi 7, Bluetooth 5.4- 1080P RGB Webcam with IR- Finger
                                        Print, Backlit KeyboardScreen 13.4'' WUXGA FHD+ 500Nits 120Hz Eyesafe
                                        infinityEdgeOS: Windows 11H LicenseWeight: 1.19Kg, Color: GraphiteBattery 3Cell
                                        55Whr
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="padding-right: 0" class="row justify-content-center px-5 ">
                                <div class="product-detail">
                                    <h4 class="fw-bold">Acer desktop Series 5</h4>
                                    <div class="star">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <span>1 review</span>
                                    </div>
                                    <div class="container-price d-flex gap-2 mt-3 align-items-center">
                                        <div style="color: #008E06" class="price fs-3 fw-bold">$1200.00</div>
                                        <div class="discount-price text-decoration-line-through text-muted fs-5">$1300.00
                                        </div>
                                    </div>
                                    <div class="add-cart mt-3 d-flex gap-3">
                                        <button style="background-color: #008E06;" class="btn btn-primary"
                                            type="button">Buy
                                            Now</button>
                                        <button style="background-color: #025492" class="btn btn-primary">Add to
                                            cart</button>
                                    </div>
                                </div>
                                <div class="related-product mt-5">
                                    <div class="col-12">
                                        <div class="row d-flex justify-content-center">
                                            <h4 style="color: #025492;font-weight: 700" class="">Related Products</h4>
                                            <div class="list-products">
                                                <div class="card border-0 shadow-sm mb-3 p-2 w-100 d-flex flex-row align-items-center">
                                                    <div class="card-image mx-2">
                                                        <img width="100" src="{{ asset('website/upload/image1.png') }}"
                                                            alt="">
                                                            <span>50% off</span>
                                                    </div>
                                                    <div class="card-body product-body py-0">
                                                        <h5 class="card-title">Gentle Skin Cleanser</h5>
                                                        <div class="star">
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <span>(5)</span>
                                                        </div>
                                                        <div class="card-price d-flex gap-2 mt-1 align-items-center">
                                                            <div style="color: #008E06;font-weight: 600"
                                                                class="price fs-5 ">$1200.00
                                                            </div>
                                                            <div
                                                                class="discount-price text-decoration-line-through text-muted fs-6">
                                                                $1300.00</div>
                                                        </div>
                                                        <div class="card-shop">
                                                            <i class="fa-solid fa-cart-shopping fa-sm"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card border-0 shadow-sm p-2 w-100 d-flex flex-row align-items-center">
                                                    <div class="card-image mx-2">
                                                        <img width="100" src="{{ asset('website/upload/image1.png') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="card-body product-body py-0">
                                                        <h5 class="card-title">Gentle Skin Cleanser</h5>
                                                        <div class="star">
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            <span>(5)</span>
                                                        </div>
                                                        <div class="card-price d-flex gap-2 mt-1 align-items-center">
                                                            <div style="color: #008E06;font-weight: 600"
                                                                class="price fs-5 ">$1200.00
                                                            </div>
                                                            <div
                                                                class="discount-price text-decoration-line-through text-muted fs-6">
                                                                $1300.00</div>
                                                        </div>
                                                        <div class="card-shop">
                                                            <i class="fa-solid fa-cart-shopping fa-sm"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function changeBigImage(element) {
        var bigImage = document.getElementById('bigImage');
        bigImage.src = element.src;
    }
</script>
