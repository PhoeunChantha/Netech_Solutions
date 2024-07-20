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
                            <h2 class="text-center">{{ __('All Categories') }}</h2>
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
                    <div class="card container-card mt-5 mb-5 p-4">
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
            {{-- <div class="col-md-10">
                <div class="row justify-content-center">
                    <div class="row">
                        <h6 style="margin-right:10em;">{{ __('Desktop') }}</h6>
                        <h6 class="">{{ __('See All') }}</h6>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}
            <div class="col-md-10">
                <div class="row justify-content-center">
                    <div class="row w-100 d-flex justify-content-between">
                        <h5>{{ __('Desktop') }}</h5>
                        <h6>{{ __('See All') }}</h6>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

{{-- <script>
    let currentIndex = 0;

    function showSlide(index) {
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

      //  Hide all slides
        // for (let i = 0; i < totalSlides; i++) {
        //     slides[i].style.display = "none";
        // }

        // Show the current slide
        if (index >= totalSlides) {
            currentIndex = 0; // Go back to the first slide
        } else if (index < 0) {
            currentIndex = totalSlides - 1; // Go to the last slide
        } else {
            currentIndex = index;
        }

        slides[currentIndex].style.display = "block";
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    // Auto slide every 3 seconds
    setInterval(nextSlide, 2000);

    // Initialize the first slide
    showSlide(currentIndex);
</script> --}}
