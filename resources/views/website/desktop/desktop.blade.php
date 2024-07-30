@extends('website.app')
@section('content')
    @include('website.desktop.desktop-style')
    <div class="content">
        <div class="row mt--3 mx-0 justify-content-center align-content-center">
            {{-- banner slide top has start --}}
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
            {{-- Banner slide top end --}}

            <div class="row justify-content-center">
                <div class="col-10 banner1 mt-4">
                    <img src="\website\upload\banner1.png" alt="not found">
                </div>
            </div>
            {{-- Promote of the product start --}}
            {{-- <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card container-card mt-4  shadow-lg border-0">
                        <div class="latest-product d-flex">
                            <div class="col-7">
                                <img class="annimation" src="\website\upload\p1.png" alt="not found">
                            </div>
                            <div class="text-over">
                                <h3>New Arrival</h3>
                                <a href="#" class="cta-button">Contact Us Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- Promote of the product end --}}
            <div class="row justify-content-center">
                {{--  slide of brand product --}}
                <div class="col-12 main-product mt-4">
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
                {{-- slide brand product end --}}
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-10 brand">
                    <button class="btn active  border-danger " type="button">{{ __('All Product') }}</button>
                    <button class="btn  border-danger" type="button">{{ __('Window') }}</button>
                    <button class="btn  border-danger" type="button">{{ __('Apple') }}</button>
                </div>
            </div>

            <div class="row mt--3 mt-5 mx-0 justify-content-center align-content-center">
                {{-- Product content start  --}}
                <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <h5 class="fw-bolder" style="color: #1077B8;">{{ __('All Product') }}</h5>
                            </div>

                        </div>
                        @foreach ($products as $item)
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="card mt-5 mb-4 home-desktop border-0 shadow-lg">
                                    <div class="card-header head-img justify-content-center">
                                        <img src="{{ asset('uploads/products/' . $item->thumbnail) }}" alt="not found">
                                    </div>
                                    <div class="card-body desktop-body">
                                        <h6 class="card-title fw-bold" style="color: #1077B8;">{{ $item->name }}
                                        </h6>
                                        <p class="card-text fw-bold" style="margin-bottom: 0;color:#008E06">
                                            ${{ $item->price }}</p>
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
                        @endforeach
                    </div>
                </div>
                {{-- <div class="col-md-10">
                    <div class="row justify-content-center p-2">
                        <div class="row d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('') }}</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card home-desktop border-0 shadow-lg">
                                <div class="card-header head-img justify-content-center">
                                    <img src="/website/desktop/d-1.png" alt="not found">
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
                                    <img src="/website/desktop/l-1.png" alt="not found">
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
                                    <img src="/website/desktop/l-2.png" alt="not found">
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
                                    <img src="/website/desktop/m-d1.png" alt="not found">
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
                </div> --}}
                {{-- Product content end --}}
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const productContainer = document.querySelector(".product");
                const images = productContainer.querySelectorAll("img");
                const numberOfImages = images.length;

                // Duplicate the images to create a seamless loop
                for (let i = 0; i < numberOfImages; i++) {
                    const clone = images[i].cloneNode(true);
                    productContainer.appendChild(clone);
                }

                let scrollAmount = 0;

                function scrollImages() {
                    scrollAmount -= 1; // Adjust this value to control the speed
                    if (scrollAmount <= -productContainer.scrollWidth / 2) {
                        scrollAmount = 0;
                    }
                    productContainer.style.transform = `translateX(${scrollAmount}px)`;
                    requestAnimationFrame(scrollImages);
                }

                scrollImages();
            });
        </script>
    @endsection
