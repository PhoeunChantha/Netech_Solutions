@extends('website.app')
@section('content')
@include('website.mac.mac-style')
<div class="content">

    <div class="row mt--3 mx-0 justify-content-center align-content-center">

        {{-- banner slide top has start --}}
        <div id="carouselExampleSlidesOnly" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="website/upload/banner.png" class="d-block w-100" alt="Banner 1">
                </div>

                <div class="carousel-item">
                    <img src="website/upload/banner2.png" class="d-block w-100" alt="Banner 3">
                </div>
                <div class="carousel-item">
                    <img src="website/upload/banner3.png" class="d-block w-100" alt="Banner 4">
                </div>
            </div>
        </div>
        {{-- Banner slide top end --}}

        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card mt-4 main-card">
                    <div class="card-title mt-4">
                        <h2 class="text-center fw-bold" style="color: #1077B8">{{ __('All Categories') }}</h2>
                    </div>
                    <div class="card-body body-cate">
                        <div class="col-4 all-category text-center">
                            <div class="img-container">
                                <img src="\website\mac\windowandmac.png" alt="not found">
                                <div class="text-overlay">
                                    <h3>All Product</h3>
                                    <span>430 products</span>
                                </div>
                            </div>

                        </div>

                        <div class="col-4 all-category text-center">
                            <div class="img-container">
                                <img src="\website\mac\window.png" alt="not found">
                                <div class="text-overlay">
                                    <h3>All Product</h3>
                                    <span>430 products</span>
                                </div>
                            </div>

                        </div>
                        <div class="col-4 all-category text-center">
                            <div class="img-container">
                                <img src="\website\mac\macbook.png" alt="not found">
                                <div class="text-overlay">
                                    <h3>All Product</h3>
                                    <span>430 products</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 banner1 mt-3">
                <img src="\website\upload\banner1.png" alt="not found">
            </div>
        </div>
        <div class="row justify-content-center">
            {{--  slide of brand product --}}
            <div class="col-12 main-product mt-3">
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


        <div class="row mt--3 mt-4 mx-0 justify-content-center align-content-center">
            {{-- Product content start  --}}
            <div class="col-md-10">
                <div class="row justify-content-center p-2">
                    <div class="row d-flex justify-content-between mb-3">
                        <div class="col-md-12">
                            <h5 class="fw-bolder" style="color: #1077B8;">{{ __('All Product') }}</h5>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card home-desktop border-0 shadow-lg">
                            <div class="card-header head-img justify-content-center">
                                <img src="/website/mac/d-1.png" alt="not found">
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
                                <img src="/website/mac/d-2.png" alt="not found">
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
                                <img src="/website/mac/d-3.png" alt="not found">
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
                                <img src="/website/mac/md-2.png" alt="not found">
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
                <div class="row justify-content-center p-2">
                    <div class="row d-flex justify-content-between mb-3">
                        <div class="col-md-12">
                            <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('') }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card home-desktop border-0 shadow-lg">
                            <div class="card-header head-img justify-content-center">
                                <img src="/website/mac/d-1.png" alt="not found">
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
                                <img src="/website/mac/l-1.png" alt="not found">
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
                                <img src="/website/mac/l-2.png" alt="not found">
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
                                <img src="/website/mac/m-d1.png" alt="not found">
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
                <div class="row justify-content-center p-2">
                    <div class="row d-flex justify-content-between mb-3">
                        <div class="col-md-12">
                            <h5 class="fw-bolder fs-4" style="color: #1077B8;">{{ __('') }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card home-desktop border-0 shadow-lg">
                            <div class="card-header head-img justify-content-center">
                                <img src="/website/mac/d-1.png" alt="not found">
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
                                <img src="/website/mac/l-1.png" alt="not found">
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
                                <img src="/website/mac/l-2.png" alt="not found">
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
                                <img src="/website/mac/m-d1.png" alt="not found">
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
            {{-- Product content end --}}
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
    </script> --}}
@endsection
