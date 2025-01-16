@extends('website.app')
@section('contents')
    @include('website.desktop.desktop-style')
    <div class="content">
        <div class="row mt--3 mx-0 justify-content-center align-content-center">
            {{-- banner slide top has start --}}
            {{-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
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
            </div> --}}
            {{-- Banner slide top end --}}

            {{-- <div class="row justify-content-center">
                <div class="col-10 banner1 mt-4">
                    <img src="\website\upload\banner1.png" alt="not found">
                </div>
            </div> --}}
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
            {{-- <div class="row justify-content-center">
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
            </div> --}}

            {{-- <div class="row justify-content-center mt-4">
                <div class="col-md-10 brand">
                    <button class="btn active border-danger filter-btn" data-filter="all"
                        type="button">{{ __('All Product') }}</button>
                    <button class="btn border-danger filter-btn" data-filter="window"
                        type="button">{{ __('Window') }}</button>
                    <button class="btn border-danger filter-btn" data-filter="apple"
                        type="button">{{ __('Apple') }}</button>
                </div>
            </div> --}}
            <div class="col-md-10 mt-3 ">
                <div class="row shadow d-flex justify-content-between align-items-center"
                    style="background-color: #e3f4ff;border-radius: 15px">
                    <div class="col-md-5 p-4">
                        <h4 class="fw-bold">{{ $category->name }} {{ __('Product') }}</h4>
                        <span class="text-muted">{{ $productscount }} {{ __('items found') }}</span>
                    </div>
                    <div class="col-md-5 filters">
                        <!-- Button trigger modal -->
                        <a href="#"
                            class="float-end text-dark d-flex gap-2 text-decoration-none  justify-content-center align-items-center"
                            data-toggle="modal" data-target="#modelId">
                            <img width="15%" src="{{ asset('website/desktop/icon-filter.png') }}" alt="">
                            {{ __('Filter') }}
                        </a>

                        <!-- Modal -->
                        <div class="modal fade right-modal" id="modelId" tabindex="-1" role="dialog"
                            aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-slideout" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex gap-2 justify-content-between align-items-center">
                                        <img width="8%" src="{{ asset('website/desktop/icon-filter.png') }}"
                                            alt="">
                                        <h5 class="modal-title m-0">{{ __('Filter') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body  modal-body-filter">
                                        <div class="container-fluid">
                                            <div class="div">
                                                <!-- Sort By -->
                                                <div class="row container-filter">
                                                    <button class="btn w-100" type="button" data-toggle="collapse"
                                                        data-target="#collapseExample" aria-expanded="false"
                                                        aria-controls="collapseExample">
                                                        {{ __('Sort by') }}
                                                    </button>
                                                </div>
                                                <div class="collapse mt-1" id="collapseExample">
                                                    <div class="form-check">
                                                        <input class="check-input" type="radio" name="sort"
                                                            value="latest" id="latest">
                                                        <label class="check-label"
                                                            for="latest">{{ __('Latest Product') }}</label>
                                                    </div>
                                                    <hr class="m-0">
                                                    <div class="form-check">
                                                        <input class="check-input" type="radio" name="sort"
                                                            value="best_promotion" id="best_promotion">
                                                        <label class="check-label"
                                                            for="best_promotion">{{ __('Best Promotion Product') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Brand Filter -->
                                            <div class="div mt-2">
                                                <div class="row container-filter">
                                                    <button class="btn w-100" type="button" data-toggle="collapse"
                                                        data-target="#brand-filter" aria-expanded="false"
                                                        aria-controls="brand-filter">
                                                        {{ __('Brand') }}
                                                    </button>
                                                </div>
                                                <div class="collapse mt-1 gap-1" id="brand-filter">
                                                    @forelse ($brands as $brand)
                                                        <div class="form-check">
                                                            <input class="check-input" type="radio" name="brand_id"
                                                                value="{{ $brand->id }}" id="{{ $brand->id }}">
                                                            <label class="check-label"
                                                                for="{{ $brand->id }}">{{ $brand->name }}</label>
                                                        </div>
                                                    @empty
                                                        <p>{{ __('No brands found') }}</p>
                                                    @endforelse
                                                </div>
                                            </div>

                                            <div class="div mt-2">
                                                <div class="row container-filter">
                                                    <button class="btn w-100" type="button" data-toggle="collapse"
                                                        data-target="#price-filter" aria-expanded="false"
                                                        aria-controls="price-filter">
                                                        {{ __('Price') }}
                                                    </button>
                                                </div>
                                                <div class="collapse mt-1 gap-1" id="price-filter">
                                                    <div class="divv">
                                                        <fieldset class="filter-price">
                                                            <div class="price-field">
                                                                <input type="range" min="100" max="1000"
                                                                    value="100" id="lower">
                                                                <input type="range" min="100" max="1000"
                                                                    value="500" id="upper">
                                                            </div>
                                                            <div class="price-wrap">
                                                                {{-- <span class="price-title">FILTER</span> --}}
                                                                <div class="price-wrap-1">
                                                                    <input id="one">
                                                                    <label for="one">$</label>
                                                                </div>
                                                                <div class="price-wrap_line">-</div>
                                                                <div class="price-wrap-2">
                                                                    <input id="two">
                                                                    <label for="two">$</label>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer modal-footer-filter">
                                        <!-- Clear Filters Button -->
                                        <button style="background-color: red;" type="button"
                                            class="btn btn-secondary w-50 clearFilters">
                                            {{ __('Clear') }}
                                        </button>

                                        <!-- Apply Filter Button -->
                                        <button style="background-color: #1077B8;" type="button"
                                            class="btn btn-primary w-50 applyFilter">
                                            {{ __('Apply filter') }}
                                        </button>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row p-0 mt-3 mt-5 mx-0 justify-content-center align-content-center">
                {{-- Product content start --}}
                <div class="col-md-10 p-4 mb-3 shadow" style="background-color: #e3f4ff;border-radius: 15px">
                    <div class="row justify-content-center mb-3 ">
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-12">
                                <h5 class="position-relative" style="color: #1077B8;font-weight: 800">
                                    {{ __('All Product') }}
                                </h5>
                            </div>
                        </div>
                        <div class="row" id="product-list">
                            @include('website.desktop.partials.product_list')
                        </div>
                    </div>
                </div>
                {{-- Product content end --}}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let filters = {
            category_id: '{{ $category->id }}',
            sortBy: null,
            brand: null,
            priceRange: {
                min: parseInt($('#lower').val()),
                max: parseInt($('#upper').val())
            }
        };

        function applyFilters() {
            $.ajax({
                url: '{{ route('filter-products') }}',
                method: 'GET',
                data: filters,
                success: function(response) {
                    $('#product-list').html(response);
                },
                error: function(error) {
                    console.error('Error fetching products:', error);
                }
            });
        }

        $(document).ready(function() {
            $('input[name="sort"]').on('change', function() {
                filters.sortBy = $(this).val();
            });

            $('input[name="brand_id"]').on('change', function() {
                filters.brand = $(this).val();
            });

            $('#upper').on('input', function() {
                let lowerVal = parseInt($('#lower').val());
                let upperVal = parseInt($('#upper').val());
                if (upperVal < lowerVal + 4) {
                    $('#lower').val(upperVal - 4);
                }
                $('#two').val(upperVal);
                filters.priceRange.max = upperVal;
            });

            $('#lower').on('input', function() {
                let lowerVal = parseInt($('#lower').val());
                let upperVal = parseInt($('#upper').val());
                if (lowerVal > upperVal - 4) {
                    $('#upper').val(lowerVal + 4);
                }
                $('#one').val(lowerVal);
                filters.priceRange.min = lowerVal;
            });

            $('.applyFilter').on('click', function() {
                applyFilters();
            });

            // Clear Filters AJAX
            $('.clearFilters').on('click', function() {
                filters = {
                    category_id: '{{ $category->id }}',
                    sortBy: null,
                    brand: null,
                    priceRange: {
                        min: parseInt($('#lower').attr('min')),
                        max: parseInt($('#upper').attr('max'))
                    }
                    // category_id: "{{ $category->id }}"
                };
                $('#lower').val(filters.priceRange.min);
                $('#upper').val(filters.priceRange.max);
                $('#one').val(filters.priceRange.min);
                $('#two').val(filters.priceRange.max);
                $('input[name="sort"]').prop('checked', false);
                $('input[name="brand_id"]').prop('checked', false);
                $.ajax({
                    url: '{{ route('clear-filters') }}',
                    method: 'GET',
                    data: {
                        category_slug: "{{ $category->slug }}"
                    },
                    success: function(response) {
                        $('#product-list').html(response);
                    },
                    error: function(error) {
                        console.error('Error clearing filters:', error);
                    }
                });
            });
        });
    </script>
    @include('website.desktop.desktop-script')
@endpush
