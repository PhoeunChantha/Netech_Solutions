@extends('website.app')
@section('contents')
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
            <h2 class="fw-bolder about-title">{{ __('Our Team Structure') }}</h2>
            {{-- <p class="fw-bolder about-desc">{{ __(' There Is the better way we build it. ') }}</p> --}}
        </div>
        <div class="col-10 mx-auto">
            <div class="row d-flex justify-content-center align-items-center">
                <div style="width: 74rem !important" class="uk-slider-container-offset" uk-slider>
                    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                        <div class=" uk-slider-items uk-child-width-1-3@s
uk-grid">
                            @forelse ($teams as $team)
                                <div style="padding-left: 0 !important;width: 25rem" class="">
                                    <div class="uk-card about-card uk-card-default about-card">
                                        <div class="uk-card-media-top about-card-top">
                                            <img src="  @if ($team->image && file_exists(public_path('uploads/employee/' . $team->image))) {{ asset('uploads/employee/' . $team->image) }}
                                                    @else
                                                        {{ asset('uploads/defualt.png') }} @endif"
                                                alt="not found">
                                        </div>
                                        <div class="uk-card-body about-card-body">
                                            <h3 class="uk-card-title mb-0">{{ $team->name }}</h3>
                                            <p class="mt-0">{{ $team->position }}</p>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>{{ __('No team available') }}</p>
                            @endforelse
                        </div>

                        <a class="uk-position-center-left uk-position-small uk-hidden-hover custom-prev-left" href
                            uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover custom-prev-right" href
                            uk-slidenav-next uk-slider-item="next"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10 mx-auto">
            <div class="p-2 px-0 my-5 d-flex justify-content-center">
                <div class="col-6 our-company">
                    {{-- <h2 class="company-title">{{ __('About Our Company') }}</h2> --}}
                    <p class="mt-0 fs-5  text-left">
                        {!! $about_company !!}
                    </p>
                </div>
                <div class="col-5 bg-info">
                    <div class="image-company">
                        <img src=" @if ($about_company_image && file_exists('uploads/business_settings/' . $about_company_image)) {{ asset('uploads/business_settings/' . $about_company_image) }}
                                                            @else
                                                                {{ asset('uploads/defualt.png') }} @endif"
                            alt="error" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10  mx-auto pb-5">
            <div class="card px-0   justify-content-center">
                <div class="col-12 pb-0 company-mission">
                    {{-- <h2 class="mission-title ">{{ __('Mission') }}</h2> --}}
                    <p class="fs-6  text-left">
                        {!! $mission_and_vision !!}
                    </p>
                </div>
                {{-- <div class="col-12  company-vision">
                    <h2 class="vision-title">{{ __('Vission') }}</h2>
                    <p class="fs-6  text-left">
                        {{ __('Ask CDCR San Quintin State Prison 2008. We installed Purex dispensers throughout the prison to combat diseases…and it was a Roaring Success (as in Roaring Drunk) I mean we had Long lines of prisoners fist fighting to use them.Ask CDCR San Quintin State Prison 2008.Ask CDCR San Quintin State Prison 2008. We installed Purex dispensers throughout the prison to combat diseases…and it was a Roaring Success (as in Roaring Drunk) I mean we had Long lines of prisoners fist fighting to use them.Ask CDCR San Quintin State Prison 2008.') }}
                    </p>

                </div> --}}
            </div>
        </div>
    </div>
@endsection
