@extends('website.app')
@section('content')
    @include('website.home.home-style')
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
                <div class="col-10">
                    <div class="card mt-5 main-card">
                        <div class="card-title mt-4">
                            <div class="row d-flex align-content-center">
                                <h2 class="text-center fw-bold" style="color: #1077B8">{{ __('All Categories') }}</h2>
                                <div class="see-all float-end">
                                    {{-- <a href="{{ route('category.show', ['slug' => 'desktop']) }}"
                                        class="float-end shadow-hover-cate {{ Request::routeIs('category.show') && Request::route('slug') == 'desktop' ? 'active' : '' }}">
                                        <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                    </a> --}}
                                    <a href="{{ route('category.show', ['slug' => 'desktop']) }}"
                                        class="float-end shadow-hover-cate {{ Request::routeIs('category.show') && Request::route('slug') == 'desktop' ? 'active' : '' }}">
                                        <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                    </a>


                                </div>
                            </div>
                        </div>
                        <div class="card-body body-cate">
                            <div class="col-3 all-category text-center">
                                <div class="img-container">
                                    <img src="\website\upload\img6.png" alt="not found">
                                    <div class="main-text-overlay">
                                        <div class="text-overlay">
                                            <h5>Desktop</h5>
                                            <span>430 products</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 all-category text-center">
                                <div class="img-container">
                                    <img src="/website/upload/image1.jpg" alt="not found">
                                    <div class="main-text-overlay">
                                        <div class="text-overlay ">
                                            <h5>Laptop</h5>
                                            <span>250 products</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 all-category text-center">
                                <div class="img-container">
                                    <img src="\website\upload\p1.png" alt="not found">
                                    <div class="main-text-overlay">
                                        <div class="text-overlay">
                                            <h5>Accesseries</h5>
                                            <span>120 products</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 all-category text-center">
                                <div class="img-container">
                                    <img src="\website\upload\img4.png" alt="not found">
                                    <div class="main-text-overlay">
                                        <div class="text-overlay">
                                            <h5 class="">Service</h5>
                                            <span>500 products</span>
                                        </div>
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
                        @foreach ($brands as $brand)
                            <img src="
                                @if ($brand->thumbnail && file_exists(public_path('uploads/brands/' . $brand->thumbnail))) {{ asset('uploads/brands/' . $brand->thumbnail) }} @endif
                                "
                                alt="brand">
                        @endforeach
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
                                                    <img src="\website\upload\img6.png" alt="not found">
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
                    <div class="row justify-content-center p-3">
                        <div class="card d-flex p-4 shadow border-0" style="background-color: #1077B8;">
                            <div class="row">
                                <div class="row d-flex justify-content-between mb-3">
                                    <div class="col-md-6">
                                        <h5 class="fw-bolder text-white">{{ __('Best Promotion') }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="float-end shadow-hover">
                                            <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                        </a>
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
                                <h5 class="fw-bolder" style="color: #1077B8;">{{ __('Desktop') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('category.show', ['slug' => 'desktop']) }}"
                                    class="float-end shadow-hover {{ Request::routeIs('category.show') && Request::route('slug') == 'desktop' ? 'active' : '' }}">
                                    <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                </a>

                            </div>
                        </div>
                        <div class="items-slider">
                            <div class="item p-3">
                                @forelse ($desktopProducts as $item)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="card home-desktop  border-0 shadow-lg">
                                            <div class="card-header head-img justify-content-center">
                                                <img src="{{ asset('uploads/products/' . $item->thumbnail) }}"
                                                    alt="not found">
                                            </div>
                                            <div class="card-body desktop-body">
                                                <h6 class="card-title fw-bold" style="color: #1077B8;">
                                                    {{ $item->name }}
                                                </h6>
                                                <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                    ${{ $item->price }}
                                                </p>
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
                                @empty
                                    <p>{{ __('No products available') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-3">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Laptop') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('category.show', ['slug' => 'laptop']) }}"
                                    class="float-end shadow-hover {{ Request::routeIs('category.show') && Request::route('slug') == 'laptop' ? 'active' : '' }}">
                                    <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                </a>
                            </div>
                        </div>
                        <div class="items-slider">
                            <div class="item p-3">
                                @forelse ($laptopProducts as $item)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="card home-desktop  border-0 shadow-lg">
                                            <div class="card-header head-img justify-content-center">
                                                <img src="{{ asset('uploads/products/' . $item->thumbnail) }}"
                                                    alt="not found">
                                            </div>
                                            <div class="card-body desktop-body">
                                                <h6 class="card-title fw-bold" style="color: #1077B8;">
                                                    {{ $item->name }}
                                                </h6>
                                                <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                    ${{ $item->price }}
                                                </p>
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
                                @empty
                                    <p>{{ __('No products available') }}</p>
                                @endforelse
                                {{-- <div class="col-md-3">
                                    <div class="card home-desktop border-0 shadow-lg">
                                        <div class="card-header head-img">
                                            <img src="/website/upload/image1.jpg" alt="not found">
                                        </div>
                                        <div class="card-body desktop-body">
                                            <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                            </h6>
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                </div> --}}
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
                                        <a href="#" class="float-end shadow-hover">
                                            <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                        </a>
                                    </div>
                                </div>
                                <div class="card border-1 p-0 shadow" style="background: none;">
                                    <div class="card card-background border-0" id="cardBackground"></div>
                                </div>
                                <div class="row main-service d-flex justify-content-center">
                                    <div class="col-md-7">
                                        <div class="card card-service border-0 shadow-lg h-100">
                                            <div class="col-md-12 p-4" id="contentContainer">
                                                <div class="col-md-12 div-title fw-bold  text-uppercase" id="divTitle"
                                                    style="color: #1077B8">Camera
                                                    security Installer</div>
                                                <div class="col-md-12 div-description fs-4" id="divDescription">Lorem
                                                    Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                    when an unknown printer took a galley of type and scrambled it to make a
                                                    ty
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <span class="text-danger fs-4 fw-bolder">$99.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 p-0 image-sticky">
                                        <img class="" src="/website/upload/service.png" alt=""
                                            id="serviceImage">
                                    </div>
                                    <div class="col p-0 text-center container-button">
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
                                <a href="#" class="float-end shadow-hover">
                                    <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                </a>
                            </div>
                        </div>
                        <div class="items-slider">
                            <div class="item p-2">
                                @forelse ($accessoriesProducts as $item)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="card home-desktop  border-0 shadow-lg">
                                            <div class="card-header head-img justify-content-center">
                                                <img src="{{ asset('uploads/products/' . $item->thumbnail) }}"
                                                    alt="not found">
                                            </div>
                                            <div class="card-body desktop-body">
                                                <h6 class="card-title fw-bold" style="color: #1077B8;">
                                                    {{ $item->name }}
                                                </h6>
                                                <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                    ${{ $item->price }}
                                                </p>
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
                                @empty
                                    <p>{{ __('No products available') }}</p>
                                @endforelse
                                {{-- <div class="col-md-3">
                                    <div class="card home-desktop border-0 shadow-lg">
                                        <div class="card-header head-img">
                                            <img src="/website/upload/image1.jpg" alt="not found">
                                        </div>
                                        <div class="card-body desktop-body">
                                            <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                            </h6>
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('CCTV') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="float-end shadow-hover">
                                    <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                </a>
                            </div>
                        </div>
                        <div class="items-slider">
                            <div class="item p-2">
                                @forelse ($cctvProducts as $item)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="card home-desktop  border-0 shadow-lg">
                                            <div class="card-header head-img justify-content-center">
                                                <img src="{{ asset('uploads/products/' . $item->thumbnail) }}"
                                                    alt="not found">
                                            </div>
                                            <div class="card-body desktop-body">
                                                <h6 class="card-title fw-bold" style="color: #1077B8;">
                                                    {{ $item->name }}
                                                </h6>
                                                <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                    ${{ $item->price }}
                                                </p>
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
                                @empty
                                    <p>{{ __('No products available') }}</p>
                                @endforelse
                                {{-- <div class="col-md-3">
                                    <div class="card home-desktop border-0 shadow-lg">
                                        <div class="card-header head-img">
                                            <img src="/website/upload/image1.jpg" alt="not found">
                                        </div>
                                        <div class="card-body desktop-body">
                                            <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                            </h6>
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                </div> --}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-6">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Printer') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="float-end shadow-hover">
                                    <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                </a>
                            </div>
                        </div>
                        <div class="items-slider">
                            <div class="item p-2">
                                @forelse ($printerProducts as $item)
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="card home-desktop  border-0 shadow-lg">
                                            <div class="card-header head-img justify-content-center">
                                                <img src="{{ asset('uploads/products/' . $item->thumbnail) }}"
                                                    alt="not found">
                                            </div>
                                            <div class="card-body desktop-body">
                                                <h6 class="card-title fw-bold" style="color: #1077B8;">
                                                    {{ $item->name }}
                                                </h6>
                                                <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                                    ${{ $item->price }}
                                                </p>
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
                                @empty
                                    <p>{{ __('No products available') }}</p>
                                @endforelse
                                {{-- <div class="col-md-3">
                                    <div class="card home-desktop border-0 shadow-lg">
                                        <div class="card-header head-img">
                                            <img src="/website/upload/image1.jpg" alt="not found">
                                        </div>
                                        <div class="card-body desktop-body">
                                            <h6 class="card-title fw-bold" style="color: #1077B8;">Acer desktop Series 5
                                            </h6>
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                            <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">$1200.00
                                            </p>
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
                                </div> --}}
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
                            <div class="items-slider">
                                <div class="item p-2">
                                    <div class="col-md-3">
                                        <div class="card home-desktop border-0 shadow-lg">
                                            <div class="card-header head-video justify-content-center">
                                                <img src="/website/upload/image1.jpg" alt="not found">
                                                <button class=" playvideo btn-video" data-bs-toggle="modal"
                                                    data-bs-target="#videoModal">
                                                    <i class="fa-solid fa-play fa-lg" style="color: white"></i>
                                                </button>
                                            </div>
                                            <div class="card-body desktop-body">
                                                <h6 class="card-title fw-bold" style="color: #1077B8;">Fixing computer
                                                </h6>
                                                <div class="discription fs-6">
                                                    Lorem Ipsum is simply dummy text of theprinting and typesetting
                                                    industry.Lorem
                                                    Lorem Ipsum is simply.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="videoModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body show-video">
                                                    <video id="modalvideo" width="100%" src="/website/video/video1.mp4"
                                                        controls></video>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
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
                                                    Lorem Ipsum is simply dummy text of theprinting and typesetting
                                                    industry.Lorem
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
                                                    Lorem Ipsum is simply dummy text of theprinting and typesetting
                                                    industry.Lorem
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
                                                    Lorem Ipsum is simply dummy text of theprinting and typesetting
                                                    industry.Lorem
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
                                                    Lorem Ipsum is simply dummy text of theprinting and typesetting
                                                    industry.Lorem
                                                    Lorem Ipsum is simply.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        @include('website.home.home-script')
    @endsection
