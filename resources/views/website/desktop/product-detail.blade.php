@extends('website.app')
@section('contents')

    @include('website.desktop.product-detail-style')
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 mt-4">
                    <div class="row  d-flex justify-content-center">
                        <div class="col-6 px-4">
                            <div class="row mb-5 d-flex justify-content-center px-3">
                                {{-- <div class="sub-img mb-2">
                                    @if (!empty($product->thumbnail) && is_array($product->thumbnail) && isset($product->thumbnail[0]))
                                        <img src="{{ asset('uploads/products/' . $product->thumbnail[0]) }}"
                                            alt="not found" onclick="changeBigImage(this)">
                                    @else
                                        <img src="{{ asset('uploads/default.png') }}" alt="not found">
                                    @endif
                                </div> --}}
                                <div class="col-sm-3 sticky-sub-image">
                                    @if (is_array($product->thumbnail) && count($product->thumbnail))
                                        @foreach ($product->thumbnail as $image)
                                            <div class="sub-img mb-2">
                                                <img class="subImage" src="{{ asset('uploads/products/' . $image) }}"
                                                    alt="{{ $product->name ?? 'Product Image' }}" loading="lazy"
                                                    onclick="changeBigImage(this)">
                                            </div>
                                        @endforeach
                                    @else
                                        <img src="{{ asset('uploads/default.png') }}" alt="Default Image">
                                    @endif
                                </div>
                                <div class="col-sm-9">
                                    <div class="big-img">
                                        <img id="bigImage"
                                            src="{{ asset('uploads/products/' . ($product->thumbnail[0] ?? 'default.png')) }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 shadow-sm overview p-4 mb-5">
                                {{-- <div class="d-flex gap-4 mb-3">
                                    <button class="btn btn-primary" type="button">{{ __('Overview') }}</button>
                                    <button class="btn btn-danger" type="button">{{ __('Review') }}</button>
                                </div> --}}
                                <div class="row mb-3">
                                    <h5 class="fs-4">{{ __('Description') }}</h5>
                                    <div class="description" id="product-description">
                                        {{ $product->description }}
                                    </div>
                                </div>
                                <div class="row">
                                    <h5 class="fs-4">{{ __('Specification') }}</h5>
                                    <div class="Specification" id="product-specification">
                                        {!! $product->specification !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="padding-right: 0" class="row justify-content-center px-5 ">
                                <div class="product-detail">
                                    <h4 class="fw-bold" id="product-name">{{ $product->name }}</h4>
                                    {{-- <div class="star">
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                        <span>(5)</span>
                                        <span>1 review</span>
                                    </div> --}}
                                    {{-- <div class="container-price d-flex gap-2 mt-3 align-items-center">
                                        @php
                                            $discountValue = $product->discount
                                                ? $product->discount->discount_value
                                                : 0;

                                            $discountedPrice = $product->price;

                                            if ($discountValue > 0) {
                                                $discountedPrice =
                                                    $product->price - $product->price * ($discountValue / 100); // Apply discount
                                            }
                                        @endphp
                                        @if ($discountValue > 0)
                                            <div style="color: #008E06" class="price fs-3 fw-bold" id="product-price">
                                                ${{ number_format($discountedPrice, 2) }}
                                            </div>
                                            <div class="discount-price text-decoration-line-through text-muted fs-5">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                        @else
                                            <div style="color: #008E06" class="price fs-3 fw-bold" id="product-price">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                        @endif
                                    </div> --}}
                                    <div class="container-price d-flex gap-2 mt-3 align-items-center">
                                        @php
                                            $discountValue = $product->discount
                                                ? $product->discount->discount_value
                                                : 0;
                                            $discountedPrice = $product->price;

                                            if ($discountValue > 0) {
                                                $discountedPrice =
                                                    $product->price - $product->price * ($discountValue / 100); // Apply discount
                                            }
                                        @endphp
                                        @if ($discountValue > 0)
                                            <div style="color: #008E06" class="price fs-3 fw-bold" id="product-price">
                                                ${{ number_format($discountedPrice, 2) }}
                                            </div>
                                            <div class="discount-price text-decoration-line-through text-muted fs-5">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                        @else
                                            <div style="color: #008E06" class="price fs-3 fw-bold" id="product-price">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="add-cart mt-3 d-flex gap-3">
                                        {{-- <button style="background-color: #008E06;" class="btn btn-primary"
                                            type="button">{{ __('Contact now') }}</button> --}}
                                        {{-- <button style="background-color: #025492"
                                            class="btn btn-primary">{{ __('Whise list') }}
                                        </button> --}}
                                        @foreach (json_decode($data['social_media'], true) as $social_media)
                                            @if ($social_media['title'] == 'Telegram')
                                                @if ($social_media['status'] == 1)
                                                    <a href="{{ $social_media['link'] }}" target="_blank" class="m-2">
                                                        {{-- <img src="{{ asset('uploads/social_media/' . $social_media['icon']) }}"
                                                            alt="not found" width="45px"> --}}
                                                        <button style="background-color: #008E06;" class="btn btn-primary"
                                                            type="button">{{ __('Contact now') }}</button>
                                                    </a>
                                                @endif
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                                <div class="related-product mt-5">
                                    <div class="col-12">
                                        <div class="row d-flex justify-content-center">
                                            <h4 style="color: #025492; font-weight: 700;">{{ __('Related Products') }}</h4>
                                            <div class="list-products">
                                                @forelse ($relatedProducts as $item)
                                                    <div
                                                        class="card border-0 shadow-sm mb-3 p-2 w-100 d-flex flex-row align-items-center">
                                                        <div class="card-image mx-2">
                                                            <img width="100"
                                                                src="{{ asset('uploads/products/' . ($item->thumbnail[0] ?? 'default.png')) }}"
                                                                alt="{{ $item->name }}">
                                                            {{-- @if ($item->discount && now()->between($item->discount->start_date, $item->discount->end_date))
                                                                <span class="discount-amount text-white bg-danger">
                                                                    {{ $item->discount->discount_value }}% off
                                                                </span>
                                                            @endif --}}
                                                            @if ($item->discount)
                                                                @php
                                                                    $isDiscountActive =
                                                                        !$item->discount->start_date ||
                                                                        !$item->discount->end_date ||
                                                                        now()->between(
                                                                            $item->discount->start_date,
                                                                            $item->discount->end_date,
                                                                        );
                                                                @endphp
                                                                <span class="discount-amount text-white bg-danger">
                                                                    {{ $item->discount->discount_value }}% off
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="card-body product-body py-0">
                                                            <h5 class="card-title">
                                                                <a href="javascript:void(0);" class="product-link"
                                                                    data-id="{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </a>
                                                            </h5>
                                                            {{-- <div class="star">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                @endfor
                                                                <span>(5)</span>
                                                            </div> --}}
                                                            <div class="card-price d-flex gap-2 mt-1 align-items-center">
                                                                @php
                                                                    $discountValue = $item->discount
                                                                        ? $item->discount->discount_value
                                                                        : 0;
                                                                    $discountedPrice =
                                                                        $item->price -
                                                                        $item->price * ($discountValue / 100);
                                                                @endphp
                                                                <div style="color: #008E06; font-weight: 600"
                                                                    class="price fs-5">
                                                                    ${{ number_format($discountedPrice, 2) }}
                                                                </div>
                                                                @if ($discountValue > 0)
                                                                    <div
                                                                        class="discount-price text-decoration-line-through text-muted fs-6">
                                                                        ${{ number_format($item->price, 2) }}
                                                                    </div>
                                                                @endif
                                                                @if ($item->quantity <= 0)
                                                                    <span
                                                                        class="stock badge bg-danger">{{ __('Out of stock') }}</span>
                                                                @else
                                                                    <span
                                                                        class="stock badge bg-success">{{ __('In stock') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="card-shop">
                                                                {{-- <i class="fa-solid fa-cart-shopping fa-sm"></i> --}}
                                                                <a href="javascript:void(0);" class="product-link"
                                                                    data-id="{{ $item->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p>No related products available</p>
                                                @endforelse
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var basePath = '{{ asset('uploads/products') }}';

            $(document).on('click', '.product-link', function() {
                var productId = $(this).data('id');

                $.ajax({
                    url: '{{ route('product.getDetails', ['id' => ':productId']) }}'.replace(
                        ':productId', productId),
                    method: 'GET',
                    success: function(response) {
                        var product = response.product;
                        var relatedProducts = response.relatedProducts;

                        // Update product details
                        $('#product-name').text(product.name || 'No Name Available');
                        $('#product-description').text(product.description ||
                            'No Description Available');
                        $('#product-specification').html(product.specification ||
                            'No Specifications Available');

                        // Calculate and display product price
                        var originalPrice = parseFloat(product.price || 0);
                        var discountedPrice = originalPrice;

                        if (product.discount && product.discount.discount_value > 0) {
                            discountedPrice = originalPrice - (originalPrice * (product.discount
                                .discount_value / 100));
                        }

                        var priceHtml = '';
                        if (product.discount && product.discount.discount_value > 0) {
                            priceHtml = `
                            <div style="color: #008E06" class="price fs-3 fw-bold" id="product-price">
                                $${discountedPrice.toFixed(2)}
                            </div>
                            <div class="discount-price text-decoration-line-through text-muted fs-5">
                                $${originalPrice.toFixed(2)}
                            </div>
                        `;
                        } else {
                            priceHtml = `
                            <div style="color: #008E06" class="price fs-3 fw-bold" id="product-price">
                                $${originalPrice.toFixed(2)}
                            </div>
                        `;
                        }

                        // Ensure container exists before attempting to update
                        if ($('.container-price').length) {
                            $('.container-price').html(priceHtml);
                        } else {
                            console.error("Container '.container-price' not found.");
                        }

                        // Update big image
                        var mainImage = product.thumbnail && product.thumbnail.length ? product
                            .thumbnail[0] : 'default.png';
                        $('#bigImage').attr('src', basePath + '/' + mainImage);

                        // Update thumbnails
                        var thumbnailsContainer = $('.sticky-sub-image');
                        thumbnailsContainer.empty();

                        if (product.thumbnail && Array.isArray(product.thumbnail)) {
                            product.thumbnail.forEach(function(image) {
                                var thumbnailHtml = `
                                <div class="sub-img mb-2">
                                    <img class="subImage" src="${basePath}/${image}" alt="${product.name || 'Product Image'}" onclick="changeBigImage(this)">
                                </div>
                            `;
                                thumbnailsContainer.append(thumbnailHtml);
                            });
                        } else {
                            thumbnailsContainer.append(
                                `<img src="{{ asset('uploads/default.png') }}" alt="Default Image">`
                            );
                        }


                        // Update related products
                        var relatedProductsContainer = $('.list-products');
                        relatedProductsContainer.empty();

                        relatedProducts.forEach(function(item) {
                            var originalRelatedPrice = parseFloat(item.price || 0);
                            var discountedRelatedPrice = originalRelatedPrice;

                            if (item.discount && item.discount.discount_value > 0) {
                                discountedRelatedPrice = originalRelatedPrice - (
                                    originalRelatedPrice * (item.discount
                                        .discount_value / 100));
                            }

                            var relatedProductHtml = `
                            <div class="card border-0 shadow-sm mb-3 p-2 w-100 d-flex flex-row align-items-center">
                                <div class="card-image mx-2">
                                    <img width="100" src="${basePath}/${item.thumbnail?.[0] || 'default.png'}" alt="${item.name}">
                                    ${item.discount?.discount_value ? `<span class="discount-amount text-white bg-danger">${item.discount.discount_value}% off</span>` : ''}
                                </div>
                                <div class="card-body product-body py-0">
                                    <h5 class="card-title">
                                        <a href="javascript:void(0);" class="product-link" data-id="${item.id}">
                                            ${item.name}
                                        </a>
                                    </h5>
                                     @if ($product->quantity <= 0)
                                                    <span class="stock badge bg-danger">{{ __('Out of stock') }}</span>
                                                @else
                                                    <span class="stock badge bg-success">{{ __('In stock') }}</span>
                                                @endif
                                    <div class="card-price d-flex gap-2 mt-1 align-items-center">
                                        <div style="color: #008E06; font-weight: 600" class="price fs-5">
                                            $${discountedRelatedPrice.toFixed(2)}
                                        </div>
                                        ${item.discount?.discount_value ? `<div class="discount-price text-decoration-line-through text-muted fs-6">$${originalRelatedPrice.toFixed(2)}</div>` : ''}
                                    </div>
                                    <div class="card-shop">
                                    <a href="javascript:void(0);" class="product-link" data-id="${item.id}">
                                              <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                            relatedProductsContainer.append(relatedProductHtml);
                        });
                    },
                    error: function(error) {
                        $('.loading-spinner').hide();
                        console.error('Error fetching product details:', error);
                        $('.error-message').text(
                            'Unable to load product details. Please try again.').show();
                    },
                });
            });
        });

        function changeBigImage(img) {
            $('#bigImage').attr('src', img.src);
        }
    </script>
@endpush
