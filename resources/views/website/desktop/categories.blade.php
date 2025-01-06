@extends('website.app')
@section('contents')
    {{-- @include('website.desktop.categories-style') --}}
    <style>
        body-cate {
            display: flex;
            justify-content: center;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .all-category {
            text-align: center;
            position: relative;
        }

        .img-container {
            align-content: center;
            align-items: center;
            position: relative;
            /* width: 12em; */
            display: inline-block;
        }

        .img-container img {
            /* width: 12em;
                                                                                                                height: 11em; */
            object-fit: cover;
            display: block;
            border-radius: 5px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background-color: rgba(161, 161, 161, 0.5);

        }

        .main-text-overlay {
            position: absolute;
            width: 100%;
            height: -webkit-fill-available;
            top: 0%;
            /* left: 1em; */
            border-radius: 7px;
            background-color: rgba(161, 161, 161, 0.5);
        }

        .text-overlay {
            position: absolute;
            top: 5%;
            left: 1em;
            color: white;
            text-align: center;
            border-radius: 5px;
            font-size: 15px;
        }

        .text-overlay h5,
        .text-overlay span {
            margin: 0;
        }

        .img-container {
            position: relative;
            /* overflow: hidden; */
        }

        .img-container img,
        .img-container .text-overlay,
        .img-container .main-text-overlay {
            transition: transform 0.5s ease;
        }

        .img-container img {
            padding: 10px;
            width: 17em;
            height: 11em;
            object-fit: contain;
        }



        .img-container:hover img,
        .img-container:hover .text-overlay,
        .img-container:hover .main-text-overlay {
            transform: scale(1.1);
        }

        .container {
            border-radius: 10px;
        }
    </style>
    <div class="content">
        <div class="col-md-10 mt-3 mx-auto d-flex justify-content-center  align-items-center">
            <div class="container p-4" style="background-color: #e3f4ff;">
                <h4 class="fw-bold">{{ __('Categories') }}</h4>
                <span class="text-muted">{{ __('Find your favourite categories and products') }}</span>
            </div>
        </div>
        <div class="col-md-10 mx-auto">
            <div class="row card-body  mb-5 body-cate justify-content-center mt-5">
                @forelse ($cate as $cates)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3 all-category text-center mb-4">
                        <div class="img-container position-relative">
                            <img src="
                                @if ($cates->thumbnails && file_exists(public_path('uploads/category/' . $cates->thumbnails))) {{ asset('uploads/category/' . $cates->thumbnails) }}
                                @else
                                    {{ asset('uploads/default.png') }} @endif
                                "
                                alt="{{ $cates->name }}" class="img-fluid">

                            <div
                                class="main-text-overlay position-absolute w-100 h-100 d-flex justify-content-center align-items-center">
                                <div class="text-overlay text-center">
                                    <a href="{{ route('category.show', ['slug' => $cates->slug]) }}"
                                        class="{{ Request::routeIs('category.show') && Request::route('slug') == $cates->slug ? 'active' : '' }}">
                                        <h5 class="mb-2">{{ $cates->name }}</h5>
                                    </a>
                                    <span>{{ $cates->products_count }} {{ __('products') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="no-products-message text-center">{{ __('No categories available') }}</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
