@extends('website.app')
@section('content')
    @include('website.aboutus.about-us-style')
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
        </div>
        <div class="text-center p-5">
            <h1 class="fw-bolder" style="color: #ff0000;">{{ __(' Wanted To Hear Our Story... ') }}</h1>
            <h1 class="fw-bolder" style="color: #000000;">{{ __(' There Is the better way we build it. ') }}</h1>
        </div>
    </div>
@endsection
