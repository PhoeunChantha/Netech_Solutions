@extends('website.app')
@section('contents')
    @include('website.accessories.accessories-style')
    <div class="content">
        <div class="row mt--3 mx-0 justify-content-center align-content-center">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banners as $key => $banner)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="
                            @if ($banner->image_url && file_exists(public_path('uploads/banner/' . $banner->image_url))) {{ asset('uploads/banner/' . $banner->image_url) }} @endif
                            "
                                class="d-block w-100" alt="Banner">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10 banner1 mt-5">
                    <img src="\website\upload\banner1.png" alt="not found">
                </div>
            </div>
            <div class="row justify-content-center p-2">
                <div class="col-md-10">
                    <div class="row justify-content-center p-2 mt-5">
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-6">
                                <h5 class="fw-bolder" style="color: #1077B8;">{{ __(' All Accessories') }}</h5>
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
                    <div class="row justify-content-center p-2 mt-5">
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
                    <div class="row justify-content-center p-2 mt-5">
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
                    <div class="row justify-content-center p-2 mt-3">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Computer Accessories') }}</h5>
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
                    <div class="row justify-content-center p-2 mt-5">


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
                    <div class="row justify-content-center p-2 mt-3">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Network Accessories') }}</h5>
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
                    <div class="row justify-content-center p-2 mt-5">


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
                    <div class="row justify-content-center p-2 mt-3">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('CCTV Accessories') }}</h5>
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
                    <div class="row justify-content-center p-2 mt-5">


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
                {{-- <div class="col-md-10">
                    <div class="row justify-content-center p-2 mt-3">
                    </div>
                </div> --}}
                <div class="col-md-10">
                    <div class="row justify-content-center p-2 ">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Printer Accessories') }}</h5>
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
                    <div class="row justify-content-center p-2 mt-5">


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

            </div>
        </div>
    </div>
    </div>
@endsection
