@extends('website.app')
@section('content')
    @include('website.servicespage.service-style')
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
            <div class="row justify-content-center p-2">
                <div class="col-10 banner1 mt-5" bis_skin_checked="1">
                    <img src="website/Accessories/banner1.png" alt="not found">
                </div>
                <div class="col-md-10">
                    <div class="row justify-content-center p-2 mt-4">
                    </div>
                </div>
            </div>
            <div class="text-center p-5">
                <h2 class="fw-bolder" style="color: #000000;">{{ __(' Our Solutions ') }}</h2>
                <h4 style="color: #000000;"></h4>Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
                popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more
                recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</h5>
            </div>
            <div class="row justify-content-center p-1">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card">
                            <img src="/website/service/network.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="card-title">Solution</h2>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                    has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining
                                    essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                    sheets
                                    containing Lorem Ipsum passages, and more recently with desktop publishing software like
                                    Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <img src="/website/service/network.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="card-title">Solution</h2>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                    has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining
                                    essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                    sheets
                                    containing Lorem Ipsum passages, and more recently with desktop publishing software like
                                    Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row justify-content-center p-2 mt-5">
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="/website/service/network.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="card-title">Our Services </h2>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                    has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining
                                    essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                    sheets
                                    containing Lorem Ipsum passages, and more recently with desktop publishing software like
                                    Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="/website/service/network.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="card-title">Network Solution</h2>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                    has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining
                                    essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                    sheets
                                    containing Lorem Ipsum passages, and more recently with desktop publishing software like
                                    Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row justify-content-center p-2 mt-5">
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="/website/service/network.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="card-title">Camera Services</h2>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                    has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining
                                    essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                    sheets
                                    containing Lorem Ipsum passages, and more recently with desktop publishing software like
                                    Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="/website/service/network.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="card-title">Service maintainnace</h2>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                    has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining
                                    essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                    sheets
                                    containing Lorem Ipsum passages, and more recently with desktop publishing software like
                                    Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row justify-content-center p-2 mt-5">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
