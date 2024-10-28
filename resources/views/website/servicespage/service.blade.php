@extends('website.app')
@section('contents')
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
            <div class="row justify-content-center">
                {{-- <div class="col-md-10 banner1 mt-5" bis_skin_checked="1">
                    <img src="website/Accessories/banner1.png" alt="not found">
                </div> --}}
                <div class="col-md-10">
                    <div class="card mt-5 mb-4 border-0">
                        <div class="row justify-content-center mt-4">
                            <div class="text-center px-5">
                                <h3 class="fw-bolder fs-2" style="color: #000000;">{{ __('All Services ') }}</h3>
                                <div class="div p-3 fs-5">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum
                                    has
                                    been the industry's standard dummy text ever since the 1500s,
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex gap-2 justify-content-center mt-3 mb-4">
                            @forelse ($services as $service)
                                <div class="col-md-5">
                                    <div class="card card-service p-1">
                                        <div class="card-header p-0 service-thumbnail">
                                            <img width="50%"
                                                src="
                                                @if ($service->thumbnails && file_exists(public_path('uploads/serviceimg/' . $service->thumbnails))) {{ asset('uploads/serviceimg/' . $service->thumbnails) }}
                                                @else
                                                    {{ asset('uploads/defualt.png') }} @endif
                                                "
                                                alt="{{ $service->title }}" class="card-img-top shadow">
                                        </div>
                                        <div class="card-body p-2">
                                            <h3 class="card-title">{{ $service->name }}</h3>
                                            <div class="card-text fs-5">
                                                {!! $service->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>{{ __('No services available') }}</p>
                            @endforelse

                            {{-- <div class="col-md-6">
                                <div class="card card-service">
                                    <div class="card-header p-0 service-thumbnail">
                                        <img src="\website\servicepage\ser1.png" class="card-img-top" alt="...">
                                    </div>
                                    <div class="card-body p-2">
                                        <h3 class="card-title">{{ __('Iphone 15 Pro Max') }}</h3>
                                        <div class="card-text fs-5">
                                            Lorem Ipsum is simply dummy text of theprinting and
                                            typesetting
                                            industry.Lorem Lorem Ipsum is simply dummy text of the printing antypesetting
                                            industry.Lorem
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
