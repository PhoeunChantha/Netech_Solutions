@extends('website.app')
@section('content')
    @include('website.home.home-style')
    <div class="content">
        <div class="row mt--3 mx-0 justify-content-center align-content-center">
            <div id="carouselExampleSlidesOnly" class="carousel slide " data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="website/upload/banner.png" class="d-block w-100" alt="Banner 1">
                    </div>
                    {{-- <div class="carousel-item">
                        <img src="website/upload/banner1.png" class="d-block w-100" alt="Banner 2">
                    </div> --}}
                    <div class="carousel-item">
                        <img src="website/upload/banner2.png" class="d-block w-100" alt="Banner 3">
                    </div>
                    <div class="carousel-item">
                        <img src="website/upload/banner3.png" class="d-block w-100" alt="Banner 4">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card mt-5 main-card">
                        <div class="card-title mt-4">
                            <h2 class="text-center fw-bold" style="color: #1077B8">{{ __('All Categories') }}</h2>
                        </div>
                        <div class="card-body body-cate">
                            <div class="col-3 all-category text-center">
                                <div class="img-container">
                                    <img src="\website\upload\img1.png" alt="not found">
                                    <div class="text-overlay">
                                        <h5>Desktop</h5>
                                        <span>430 products</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 all-category text-center">
                                <div class="img-container">
                                    <img src="\website\upload\img2.png" alt="not found">
                                    <div class="text-overlay">
                                        <h5>Laptop</h5>
                                        <span>250 products</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 all-category text-center">
                                <div class="img-container">
                                    <img src="\website\upload\img3.png" alt="not found">
                                    <div class="text-overlay">
                                        <h5>Accesseries</h5>
                                        <span>120 products</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 all-category text-center">
                                <div class="img-container">
                                    <img src="\website\upload\img4.png" alt="not found">
                                    <div class="text-overlay">
                                        <h5 class="">Service</h5>
                                        <span>500 products</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10 banner1 mt-5">
                    <img src="\website\upload\banner1.png" alt="not found">
                </div>
            </div>
            <div class="row mt--3 mx-0 justify-content-center align-content-center">
                <div class="col-12 main-product mt-5">
                    <div class="product">
                        <img src="\website\upload\pro1.png" alt="not found">
                        <img src="\website\upload\pro2.png" alt="not found">
                        <img src="\website\upload\pro3.png" alt="not found">
                        <img src="\website\upload\pro4.png" alt="not found">
                        <img src="\website\upload\pro5.png" alt="not found">
                        <img src="\website\upload\pro6.png" alt="not found">
                        <img src="\website\upload\pro7.png" alt="not found">
                        <img src="\website\upload\pro8.png" alt="not found">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="card container-card mt-5 mb-5 p-4 shadow-lg border-0">
                            <div class="row">
                                <h5 class="p-2 title">{{ __('Latest Product') }}</h5>
                                <div class="col-6">
                                    <div class="latest-product d-flex">
                                        <div class="col-7">
                                            <img class="annimation" src="\website\upload\p1.png" alt="not found">
                                        </div>
                                        <div class="col-5 main-price">
                                            <img class="best-price" src="\website\upload\p2.png" alt="not found">
                                            <span class="name">Asus Laptop <br> LatopPro 11</span>
                                            <span class="price">$500</span>
                                            <a href="" name="" id=""
                                                class="btn btn-sm mt-3">{{ __('Learn more') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row ">
                                        <div class="card col-md-12 card-pro d-flex justify-content-center">
                                            <div class="main-text ">
                                                <span class="text-pro">Asus Laptop <br> LatopPro 11</span><br>
                                                <span class="">$300</span><br>
                                                <a href="#" class="btn btn-sm">
                                                    {{ __('Buy Now') }}</i></a>
                                            </div>
                                            <div class="main-img">
                                                <img class="img5" src="\website\upload\img5.png" alt="not found">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="container-card"> --}}
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 d-flex gap-1 justify-content-center">
                                            <div class="col-4 mt-3 text-center">
                                                <div class="card card-img">
                                                    <div class="text-price">
                                                        <h6>DeskTop1</h6>
                                                        <span>$500</span>
                                                    </div>
                                                    <img src="/website/upload/image1.jpg" alt="not found">
                                                </div>
                                            </div>
                                            <div class="col-4 mt-3 text-center">
                                                <div class="card card-img">
                                                    <div class="text-price">
                                                        <h6>DeskTop2</h6>
                                                        <span>$500</span>
                                                    </div>
                                                    <img src="/website/upload/image1.jpg" alt="not found">
                                                </div>
                                            </div>
                                            <div class="col-4 mt-3 text-center">
                                                <div class="card card-img">
                                                    <div class="text-price">
                                                        <h6>DeskTop3</h6>
                                                        <span>$500</span>
                                                    </div>
                                                    <img src="/website/upload/image1.jpg" alt="not found">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder" style="color: #1077B8;">{{ __('Desktop') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h6 class="float-end fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img justify-content-center">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-3">
                        <div class="card d-flex p-4 shadow border-0" style="background-color: #1077B8;">
                            <div class="row">
                                <div class="row d-flex justify-content-between mb-3">
                                    <div class="col-md-6">
                                        <h5 class="fw-bolder text-white">{{ __('Best Promotion') }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="float-end fw-bold text-white">{{ __('See All') }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-promotion border-0 shadow-lg">
                                        <div class="card-header head-img">
                                            <img src="/website/upload/image1.jpg" alt="not found">
                                        </div>
                                        <div class="card-body promotion-body">
                                            <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                            </h6>
                                            <div class="row d-flex">
                                                <div class="col-12 d-flex gap-4">
                                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                        $1200.00</p>
                                                    <p class="text-decoration-line-through text-secondary text-opacity-50">
                                                        $1000.00</p>
                                                </div>
                                            </div>
                                            <div class="rate-promotion">
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <span>(5)</span>
                                                <div class="addcard float-end">
                                                    <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-promotion border-0 shadow-lg">
                                        <div class="card-header head-img">
                                            <img src="/website/upload/image1.jpg" alt="not found">
                                        </div>
                                        <div class="card-body promotion-body">
                                            <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                            </h6>
                                            <div class="row d-flex">
                                                <div class="col-12 d-flex gap-4">
                                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                        $1200.00</p>
                                                    <p class="text-decoration-line-through text-secondary text-opacity-50">
                                                        $1000.00</p>
                                                </div>
                                            </div>
                                            <div class="rate-promotion">
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <span>(5)</span>
                                                <div class="addcard float-end">
                                                    <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-promotion border-0 shadow-lg">
                                        <div class="card-header head-img">
                                            <img src="/website/upload/image1.jpg" alt="not found">
                                        </div>
                                        <div class="card-body promotion-body">
                                            <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                            </h6>
                                            <div class="row d-flex">
                                                <div class="col-12 d-flex gap-4">
                                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                        $1200.00</p>
                                                    <p class="text-decoration-line-through text-secondary text-opacity-50">
                                                        $1000.00</p>
                                                </div>
                                            </div>
                                            <div class="rate-promotion">
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <span>(5)</span>
                                                <div class="addcard float-end">
                                                    <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-promotion border-0 shadow-lg">
                                        <div class="card-header head-img">
                                            <img src="/website/upload/image1.jpg" alt="not found">
                                        </div>
                                        <div class="card-body promotion-body">
                                            <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                            </h6>
                                            <div class="row d-flex">
                                                <div class="col-12 d-flex gap-4">
                                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                        $1200.00</p>
                                                    <p class="text-decoration-line-through text-secondary text-opacity-50">
                                                        $1000.00</p>
                                                </div>
                                            </div>
                                            <div class="rate-promotion">
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                <span>(5)</span>
                                                <div class="addcard float-end">
                                                    <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Laptop') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h6 class="float-end fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img justify-content-center">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-3">
                        <div class="card d-flex p-4 border-0" style="background: none;">
                            <div class="row">
                                <div class="row d-flex justify-content-between mb-3 service-title">
                                    <div class="col-md-6">
                                        <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Service') }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="float-end fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                    </div>
                                </div>
                                <div class="card border-1 p-0 shadow" style="background: none;">
                                    <div class="card card-background border-0" id="cardBackground"></div>
                                </div>
                                <div class="row main-service d-flex justify-content-center">
                                    <div class="col-md-7">
                                        <div class="card card-service border-0 shadow-lg">
                                            <div class="col-md-10 p-4" id="contentContainer">
                                                <div class="col-md-11 div-title bg-secondary" id="divTitle">Camera
                                                    security Installer</div>
                                                <div class="col-md-11 div-description fs-5" id="divDescription">Lorem
                                                    Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                    when an unknown printer took a galley of type and scrambled it to make a
                                                    ty
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="text-danger fs-5 fw-bolder">$99.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img width="100%" src="/website/upload/service.png" alt=""
                                            id="serviceImage">
                                    </div>
                                    <div class="col text-center container-button">
                                        <button class="carousel-button next" type="button" id="nextButton">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                        <button class="carousel-button prev mt-5" type="button" id="prevButton">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Accessories') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h6 class="float-end fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img justify-content-center">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                </div>
                                <div class="card-body desktop-body">
                                    <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                    </h6>
                                    <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00</p>
                                    <div class="rate ">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <div class="addcard float-end">
                                            <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12"> --}}
                <div class="row mt-3 video-container justify-content-center" style="background-color:#EBF7FF">
                    <div class="col-md-10 mt-4 mb-5 ">
                        <div class="row justify-content-center">
                            <div class="row d-flex justify-content-between mb-3">
                                <div class="col-md-6">
                                    <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Video') }}</h5>
                                </div>
                                {{-- <div class="col-md-6">
                                        <h6 class="float-end fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                    </div> --}}
                            </div>
                            <div class="col-md-3">
                                <div class="card home-desktop border-0 shadow-lg">
                                    <div class="card-header head-video justify-content-center">
                                        <img src="/website/upload/image1.jpg" alt="not found">
                                    </div>
                                    <div class="card-body desktop-body">
                                        <h6 class="card-title fw-bold" style="color: #1077B8;">Fixing computer
                                        </h6>
                                        <div class="discription fs-6">
                                            Lorem Ipsum is simply dummy text of theprinting and typesetting industry.Lorem
                                            Lorem Ipsum is simply.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card home-desktop border-0 shadow-lg">
                                    <div class="card-header head-video justify-content-center">
                                        <img src="/website/upload/image1.jpg" alt="not found">
                                    </div>
                                    <div class="card-body desktop-body">
                                        <h6 class="card-title fw-bold" style="color: #1077B8;">Fixing computer
                                        </h6>
                                        <div class="discription fs-6">
                                            Lorem Ipsum is simply dummy text of theprinting and typesetting industry.Lorem
                                            Lorem Ipsum is simply.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card home-desktop border-0 shadow-lg">
                                    <div class="card-header head-video justify-content-center">
                                        <img src="/website/upload/image1.jpg" alt="not found">
                                    </div>
                                    <div class="card-body desktop-body">
                                        <h6 class="card-title fw-bold" style="color: #1077B8;">Fixing computer
                                        </h6>
                                        <div class="discription fs-6">
                                            Lorem Ipsum is simply dummy text of theprinting and typesetting industry.Lorem
                                            Lorem Ipsum is simply.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card home-desktop border-0 shadow-lg">
                                    <div class="card-header head-video justify-content-center">
                                        <img src="/website/upload/image1.jpg" alt="not found">
                                    </div>
                                    <div class="card-body desktop-body">
                                        <h6 class="card-title fw-bold" style="color: #1077B8;">Fixing computer
                                        </h6>
                                        <div class="discription fs-6">
                                            Lorem Ipsum is simply dummy text of theprinting and typesetting industry.Lorem
                                            Lorem Ipsum is simply.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-md-12">
                <div class="btn-up float-end shadow-lg">
                    <button onclick="topFunction()" id="myBtngoup" class="btn" title="Go to top">
                        <i class="fa-solid fa-chevron-up"></i>
                    </button>
                </div>
            </div>

        </div>
        {{-- <script>
            const content = [{
                    title: 'Camera security Installer',
                    description: 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty',
                    image: '/website/upload/service.png',
                    backgroundImage: '/website/upload/service.png'
                },
                {
                    title: 'Set up and install network',
                    description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s  when an unknown printer took a galley of type and scrambled it to make a ty',
                    image: '/website/upload/service1.png',
                    backgroundImage: '/website/upload/service1.png'
                },
                {
                    title: 'Wifi solution',
                    description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s  when an unknown printer took a galley of type and scrambled it to make a ty',
                    image: '/website/upload/service2.png',
                    backgroundImage: '/website/upload/service2.png'
                },
                {
                    title: 'Solution for data back up',
                    description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty',
                    image: '/website/upload/service3.png',
                    backgroundImage: '/website/upload/service3.png'
                }
                // Add more objects for additional items
            ];

            let currentIndex = 0;

            document.getElementById('nextButton').addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % content.length;
                updateContent();
            });

            document.getElementById('prevButton').addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + content.length) % content.length;
                updateContent();
            });

            function updateContent() {
                const contentContainer = document.getElementById('contentContainer');
                contentContainer.classList.add('translate-up');
                setTimeout(() => {
                    const currentContent = content[currentIndex];
                    document.getElementById('divTitle').textContent = currentContent.title;
                    document.getElementById('divDescription').textContent = currentContent.description;
                    document.getElementById('serviceImage').src = currentContent.image;
                    document.getElementById('cardBackground').style.backgroundImage =
                        `url(${currentContent.backgroundImage})`;
                    contentContainer.classList.remove('translate-up');
                    contentContainer.classList.add('translate-reset');
                }, 500); // Match the CSS transition duration
                setTimeout(() => {
                    contentContainer.classList.remove('translate-reset');
                }, 1000); // Match the CSS transition duration
            }

            // Initial content load
            updateContent();
        </script> --}}
        <script>
            const content = [{
                    title: 'Camera security Installer',
                    description: 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty',
                    image: '/website/upload/service.png',
                    backgroundImage: '/website/upload/service.png'
                },
                {
                    title: 'Set up and install network',
                    description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s  when an unknown printer took a galley of type and scrambled it to make a ty',
                    image: '/website/upload/service1.png',
                    backgroundImage: '/website/upload/service1.png'
                },
                {
                    title: 'Wifi solution',
                    description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s  when an unknown printer took a galley of type and scrambled it to make a ty',
                    image: '/website/upload/service2.png',
                    backgroundImage: '/website/upload/service2.png'
                },
                {
                    title: 'Solution for data back up',
                    description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty',
                    image: '/website/upload/service3.png',
                    backgroundImage: '/website/upload/service3.png'
                }

                // Add more objects for additional items
            ];

            let currentIndex = 0;

            document.getElementById('nextButton').addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % content.length;
                updateContent();
            });

            document.getElementById('prevButton').addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + content.length) % content.length;
                updateContent();
            });

            function updateContent() {
                const contentContainer = document.getElementById('contentContainer');
                contentContainer.classList.add('fade-out');
                setTimeout(() => {
                    const currentContent = content[currentIndex];
                    document.getElementById('divTitle').textContent = currentContent.title;
                    document.getElementById('divDescription').textContent = currentContent.description;
                    document.getElementById('serviceImage').src = currentContent.image;
                    document.getElementById('cardBackground').style.backgroundImage =
                        `url(${currentContent.backgroundImage})`;
                    contentContainer.classList.remove('fade-out');
                    contentContainer.classList.add('fade-in');
                }, 500); // Match the CSS transition duration
                setTimeout(() => {
                    contentContainer.classList.remove('fade-in');
                }, 1000); // Match the CSS transition duration
            }

            // Initial content load
            updateContent();
        </script>

    @endsection
