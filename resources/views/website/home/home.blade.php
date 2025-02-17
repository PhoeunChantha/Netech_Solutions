@extends('website.app')
@section('contents')
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
                            <h2 class="text-center fw-bold" style="color: #1077B8">{{ __('All Categories') }}</h2>
                            <div class="see-all float-end">
                                {{-- <a href="{{ route('category.show', ['slug' => 'desktop']) }}"
                                    class="float-end shadow-hover-cate {{ Request::routeIs('category.show') && Request::route('slug') == 'desktop' ? 'active' : '' }}">
                                    <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                </a> --}}
                                <a href="{{ route('allcategory.show') }}" class="float-end shadow-hover-cate">
                                    <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                </a>
                            </div>
                            {{-- <div class="row d-flex align-content-center">
                            </div> --}}
                        </div>
                        <div class="card-body body-cate">
                            @forelse ($categories as $category)
                                <div class="col-3 all-category text-center category-item"
                                    data-category-id="{{ $category->id }}" data-category-slug="{{ $category->slug }}">
                                    <div class="img-container">
                                        @php
                                            $imagePath =
                                                $category->thumbnails &&
                                                file_exists(public_path('uploads/category/' . $category->thumbnails))
                                                    ? asset('uploads/category/' . $category->thumbnails)
                                                    : asset('uploads/default.png');
                                        @endphp

                                        <img src="{{ $imagePath }}" alt="Category Image">

                                        <div class="main-text-overlay">
                                            <div class="text-overlay">
                                                <a href="   ">
                                                    <h5>{{ $category->name }}</h5>
                                                </a>
                                                <span>{{ $category->products->count() }} products</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>{{ __('No categories available') }}</p>
                            @endforelse

                        </div>
                    </div>
                </div>
                {{-- <div class="col-10 banner1 mt-5">
                    <img src="\website\upload\banner1.png" alt="not found">
                </div> --}}
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
                <div class="col-md-10 best-promotion-col @if ($productdiscounted->count() > 0) @else d-none @endif">
                    <div class="row justify-content-center p-3">
                        <div class="card d-flex p-4 shadow border-0" style="background-color: #1077B8;">
                            <div class="row">
                                <div class="row d-flex justify-content-between mb-3">
                                    <div class="col-md-6">
                                        <h5 class="fw-bolder text-white fs-4">{{ __('Best Promotion') }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="float-end shadow-hover">
                                            <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                        </a>
                                    </div>
                                </div>
                                @foreach ($productdiscounted as $product)
                                    <div class="col-md-3">
                                        <div class="card card-promotion border-0 shadow-lg">
                                            <div class="card-header head-img">
                                                @if (!empty($product->thumbnail) && is_array($product->thumbnail) && isset($product->thumbnail[0]))
                                                    <img src="{{ asset('uploads/products/' . $product->thumbnail[0]) }}"
                                                        alt="not found">
                                                @else
                                                    <img src="{{ asset('uploads/default.png') }}" alt="not found">
                                                @endif
                                            </div>
                                            <div class="card-body promotion-body">
                                                <h5 class="card-title fw-bold" style="color: #1077B8;">
                                                    <a href="#">{{ $product->name }}</a>
                                                </h5>
                                                <div class="row d-flex">
                                                    <div class="col-12 d-flex gap-4">
                                                        @php
                                                            $discountValue = $discountMapping[$product->id] ?? 0;
                                                            $discountedPrice = $product->price;

                                                            if ($discountValue > 0) {
                                                                $discountedPrice =
                                                                    $product->price -
                                                                    $product->price * ($discountValue / 100);
                                                            }
                                                        @endphp
                                                        @if ($discountedPrice < $product->price)
                                                            <p class="card-text fw-bold"
                                                                style="margin-bottom: 0; color:#008E06">
                                                                ${{ number_format($discountedPrice, 2) }}
                                                            </p>
                                                        @endif
                                                        <p
                                                            class="p-0 m-0 text-decoration-line-through text-secondary text-opacity-50">
                                                            ${{ number_format($product->price, 2) }}
                                                        </p>

                                                    </div>
                                                </div>
                                                @if ($product->quantity <= 0)
                                                    <span class="stock badge bg-danger">{{ __('Out of stock') }}</span>
                                                @else
                                                    <span class="stock badge bg-success">{{ __('In stock') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="card container-card mt-5 mb-5 p-4 shadow-lg border-0">
                            <div class="row">
                                <h5 class="p-2 title">{{ __('Latest Product') }}</h5>
                                <div class="col-6">
                                    <div class="latest-product d-flex">
                                        @php
                                            $product = $latestProducts->first();
                                        @endphp
                                        <div class="col-7">
                                            @if (!empty($product->thumbnail) && is_array($product->thumbnail) && isset($product->thumbnail[0]))
                                                <img class="annimation"
                                                    src="{{ asset('uploads/products/' . $product->thumbnail[0]) }}"
                                                    alt="not found">
                                            @else
                                                <img src="{{ asset('uploads/defualt.png') }}" alt="not found">
                                            @endif
                                        </div>

                                        <div class="col-5 main-price">
                                            @if (!empty($product->discount->image))
                                                <img class="best-price"
                                                    src="{{ file_exists(public_path('uploads/discounts/' . $product->discount->image))
                                                        ? asset('uploads/discounts/' . $product->discount->image)
                                                        : asset('uploads/default.png') }}"
                                                    alt="Discount Image">
                                            @else
                                                <div class="col-12 no-discount">
                                                    {{-- <p>No discounts available.</p> --}}
                                                </div>
                                            @endif
                                            <span class="name">{{ $product->name }}</span><br>
                                            <span class="price">${{ $product->price }}</span>
                                            <a href="{{ route('product-detail', $product->id) }}" name=""
                                                id="" class="btn btn-sm mt-3">{{ __('See more') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row ">
                                        @php
                                            $product = $latestProducts->last();
                                        @endphp
                                        <div class="card col-md-12 card-pro d-flex ">
                                            <div class="main-text ">
                                                <span class="text-pro">{{ $product->name }}</span><br>
                                                <span class="">${{ $product->price }}</span><br>
                                                <a href="{{ route('product-detail', $product->id) }}" class="btn btn-sm">
                                                    {{ __('Buy Now') }}</i></a>
                                            </div>
                                            <div class="main-img">
                                                @if (!empty($product->thumbnail) && is_array($product->thumbnail) && isset($product->thumbnail[0]))
                                                    <img class="img5"
                                                        src="{{ asset('uploads/products/' . $product->thumbnail[0]) }}"
                                                        alt="not found">
                                                @else
                                                    <img src="{{ asset('uploads/default.png') }}" alt="not found">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="container-card"> --}}
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 d-flex gap-1 justify-content-center">
                                            @php
                                                $product = $latestProducts->skip(1)->take(3);
                                            @endphp
                                            @foreach ($product as $product)
                                                <div class="col-4 mt-3 text-center">
                                                    <div class="card card-img">
                                                        <div class="text-price">
                                                            <a href="{{ route('product-detail', $product->id) }}">
                                                                <h6>{{ $product->name }}</h6>
                                                            </a>
                                                            <span>${{ $product->price }}</span>
                                                        </div>
                                                        @if (!empty($product->thumbnail) && is_array($product->thumbnail) && isset($product->thumbnail[0]))
                                                            <img src="{{ asset('uploads/products/' . $product->thumbnail[0]) }}"
                                                                alt="not found">
                                                        @else
                                                            <img src="{{ asset('uploads/default.png') }}"
                                                                alt="not found">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
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
                                <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('Desktop') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('category.show', ['slug' => 'desktop']) }}"
                                    class="float-end shadow-hover {{ Request::routeIs('category.show') && Request::route('slug') == 'desktop' ? 'active' : '' }}">
                                    <h6 class="fw-bold" style="color: #1077B8;">{{ __('See All') }}</h6>
                                </a>

                            </div>
                        </div>
                        <div class="items-slider">
                            @include('website.home.partials.desktop_list')
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
                            @include('website.home.partials.laptop_list')
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
                                        <div class="card card-service border-0 shadow-lg">
                                            <div class="col-md-12 p-4" id="contentContainer">
                                                <div class="col-md-12 div-title fw-bold  text-uppercase" id="divTitle"
                                                    style="color: #1077B8">Camera
                                                    security Installer</div>
                                                <div class="col-md-12 div-description fs-4" id="divDescription">Lorem
                                                    Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                    when an unknown printer took a galley of type and scrambled it to make a
                                                    ty
                                                </div>
                                                {{-- <div class="col-md-12 mt-2">
                                                    <span class="text-danger fs-4 fw-bolder">$99.00</span>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pt-3 image-sticky">
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
                            @include('website.home.partials.accessory_list')
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
                            @include('website.home.partials.cctv_list')
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
                            @include('website.home.partials.printer_list')
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
                                @include('website.home.partials.video_list')
                            </div>

                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        @include('website.home.home-script')
    @endsection
    @push('js')
        <script>
            $(document).ready(function() {
                $('.category-item').on('click', function() {
                    let categorySlug = $(this).data('category-slug');

                    window.location.href = "/category/" + categorySlug;
                });
            });
            $(document).ready(function() {
                $('.product-card').on('click', function(e) {
                    if (!$(e.target).closest('.product-link').length) {
                        let productId = $(this).data('product-id');

                        window.location.href = "web/product-detail/" +
                            productId;
                    }
                });
            });
        </script>
        <script>
            // $(document).ready(function() {
            //     $(".owl-carousel").owlCarousel({
            //         loop: true,
            //         margin: 20,
            //         nav: true,
            //         navText: ["<i class='fa fa-chevron-left'></i>",
            //             "<i class='fa fa-chevron-right'></i>"
            //         ],
            //         responsive: {
            //             0: {
            //                 items: 1
            //             },
            //             600: {
            //                 items: 2
            //             },
            //             1000: {
            //                 items: 4
            //             }
            //         }
            //     });
            // });
            $(document).ready(function() {
                let productCount = $(".owl-carousel-desktop").data(
                    "product-count");
                $(".owl-carousel-desktop").owlCarousel({
                    loop: productCount > 4,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    // autoplayTimeout: 10000, 
                    autoplayTimeout: 6000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            });

            $(document).ready(function() {
                let productCount = $(".owl-carousel-laptop").data(
                    "product-count");
                $(".owl-carousel-laptop").owlCarousel({
                    loop: productCount > 4,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    // autoplayTimeout: 10000, 
                    autoplayTimeout: 7000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            });
            $(document).ready(function() {
                let productCount = $(".owl-carousel-printer").data(
                    "product-count");
                $(".owl-carousel-printer").owlCarousel({
                    loop: productCount > 4,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 8000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            });
            $(document).ready(function() {
                let productCount = $(".owl-carousel-accessory").data(
                    "product-count");
                $(".owl-carousel-accessory").owlCarousel({
                    loop: productCount > 4,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    // autoplayTimeout: 10000, 
                    autoplayTimeout: 8000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            });

            $(document).ready(function() {
                let productCount = $(".owl-carousel-cctv").data(
                    "product-count");

                $(".owl-carousel-cctv").owlCarousel({
                    loop: productCount > 4,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 10000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            });
            $(document).ready(function() {
                let productCount = $(".owl-carousel-video").data(
                    "video-count");
                $(".owl-carousel-video").owlCarousel({
                    loop: productCount > 4,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    // autoplayTimeout: 10000, 
                    autoplayTimeout: 6000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 4
                        }
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Fancybox.bind("[data-fancybox]", {
                    Toolbar: {
                        display: [
                            "close",
                        ],
                    },
                    video: {
                        autoStart: true,
                    },
                });
            });
        </script>

        {{-- <script>
            $(document).ready(function() {
                var currentDate = new Date();
                var hideContainer = true;
                $('.product-card').each(function() {
                    var discountStartDate = new Date($(this).data('discount-start'));
                    var discountEndDate = new Date($(this).data('discount-end'));
                    if (currentDate >= discountStartDate && currentDate <= discountEndDate) {
                        hideContainer = false;
                    }
                });
                if (hideContainer) {
                    $('.best-promotion-col').hide();
                }else{
                    $('.best-promotion-col').show();
                }
            });
        </script> --}}
    @endpush
