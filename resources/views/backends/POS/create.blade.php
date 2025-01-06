@extends('backends.master')
@include('backends.POS.pos_style');
@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    {{-- <form action=""> --}}
                    <div class="mt-1">
                        <div class="row mt-3">
                            <div>
                                <select class="form-control select2" name="" style="width: 450px;">
                                    <option value="walk-in">{{ __('Walk In Customer') }}</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->first_name }} {{ $customer->last_name }} -
                                            {{ $customer->phone }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#create_customer"
                                    style="height: 37px">{{ __('Add Customer') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 table-order">
                        <div class="row table-container">
                            <table class="table table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>{{ __('Product') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Unit Price') }}</th>
                                        <th>{{ __('Subtotal') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="product-table">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pay">
                        <div class="card w-100">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="d-flex">
                                            <div class="p-2 col-md-6">{{ __('Subtotal') }}</div>
                                            <div class="p-2 col-md-6 subtotal-container">0.00$</div>
                                            <input id="subtotal" type="hidden" class="" name="subtotal"
                                                value="">
                                        </div>

                                        <div class="d-flex line w-100">
                                            <div class="p-2 col-md-6">{{ __('Discount') }}</div>
                                            <div class="p-2 col-md-6 discount-container">0.00$</div>
                                            <input id="discount" type="hidden" class="" name="discount"
                                                value="">
                                        </div>

                                        <div class="d-flex line w-100">
                                            <div class="p-2 col-md-6">{{ __('Total') }}</div>
                                            <div class="p-2 col-md-6 total-container">0.00$</div>
                                            <input id="finaltotal" type="hidden" class="" name="total"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <button
                                            class="btn btn-primary w-75 m-3 discount-price"><img class="mr-2" src="{{ asset('svgs/pos_discount.svg') }}" alt="">{{ __('Discount') }}</button>
                                        <button class="btn btn-primary w-75 btn-pay-price">{{ __('Pay') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}
                </div>
                <!-- Cart Section -->
                <div class="col-md-6 mt-3">
                    <div class="category-tabs">
                        <div class="category-card" onclick="filterProducts('all')">
                            <img src="{{ asset('uploads/all-product.png') }}" alt="all" class="">
                            <p>All</p>
                        </div>

                        @forelse ($categories_pos as $cate_pos)
                            <div class="category-card" onclick="filterProducts('{{ $cate_pos->id }}')"
                                data-category-id="{{ $cate_pos->id }}">
                                <img src="
                                @if ($cate_pos->thumbnails && file_exists(public_path('uploads/category/' . $cate_pos->thumbnails))) {{ asset('uploads/category/' . $cate_pos->thumbnails) }}
                                @else
                                    {{ asset('uploads/default.png') }} @endif
                                "
                                    alt="{{ $cate_pos->name }}" class="">
                                <p>{{ $cate_pos->name }}</p>
                            </div>
                        @empty
                            <p>{{ __('No categories available') }}</p>
                        @endforelse
                    </div>
                    <div class="product-search mt-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search for products">
                        </div>
                    </div>
                    <div class="product-grid">

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backends.POS.create_customer')
    @include('backends.POS.discount_item_modal')
    @include('backends.POS.calculator')
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const table = document.getElementById('product-table');
            const subtotalElement = document.querySelector('.subtotal-container');
            const subtotalInput = document.querySelector('input[name="subtotal"]');
            const discountElement = document.querySelector('.discount-container');
            const discountInput = document.querySelector('input[name="discount"]');
            const totalElement = document.querySelector('.total-container');
            const totalInput = document.querySelector('input[name="total"]');

            table.addEventListener('click', (e) => {
                const button = e.target;
                const row = button.closest('tr');
                if (!row) return;

                const quantityElement = row.querySelector('.quantity');
                const unitPriceElement = row.querySelector('.unit-price');
                const subtotalElementRow = row.querySelector('.subtotal');

                if (button.classList.contains('increase') || button.classList.contains('decrease')) {
                    let quantity = parseInt(quantityElement.textContent);
                    if (button.classList.contains('increase')) {
                        quantity++;
                    } else if (quantity > 1) {
                        quantity--;
                    }
                    quantityElement.textContent = quantity;

                    const unitPrice = parseFloat(unitPriceElement.textContent.replace('$', ''));
                    const subtotal = (quantity * unitPrice).toFixed(2);
                    subtotalElementRow.textContent = `${subtotal}$`;

                    updateTotals();
                }
            });

            function updateTotals() {
                let total = 0;
                const rows = table.querySelectorAll('tr');

                rows.forEach(row => {
                    const subtotalElementRow = row.querySelector('.subtotal');
                    if (subtotalElementRow) {
                        const subtotal = parseFloat(subtotalElementRow.textContent.replace('$', '')) || 0;
                        total += subtotal;
                    }
                });

                const discount = parseFloat(discountElement.textContent.replace('$', '')) || 0;
                const finalTotal = (total - discount).toFixed(2);

                subtotalElement.textContent = `${total.toFixed(2)}$`;
                totalElement.textContent = `${finalTotal}$`;

                subtotalInput.value = total.toFixed(2);
                discountInput.value = discount.toFixed(2);
                totalInput.value = finalTotal;
            }
        });
    </script>
    <script>
        function filterProducts(categoryId) {
            $('.category-card').removeClass('selected');
            $(`[data-category-id="${categoryId}"]`).addClass('selected');

            $.ajax({
                url: '{{ route('pos-filter-products') }}',
                method: 'GET',
                data: {
                    category_id: categoryId
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        let productGrid = $('.product-grid');
                        productGrid.empty();

                        if (response.products.length > 0) {
                            response.products.forEach(product => {
                                // Check if product has a discount and calculate discounted price
                                const hasDiscount = product.discount && product.discount.discount_value;
                                const discountValue = hasDiscount ?
                                    `<span class="discount-amount text-white bg-danger text-left">${product.discount.discount_value}% OFF</span>` :
                                    '';

                                // Calculate discounted price if a discount exists, otherwise use the original price
                                const discountedPrice = hasDiscount ?
                                    (product.price - (product.price * (product.discount.discount_value /
                                        100))).toFixed(2) :
                                    parseFloat(product.price).toFixed(2);

                                const stockStatus = product.quantity > 0 ?
                                    '<span class="instock">In stock</span>' :
                                    '<span class="out-stock">Out of stock</span>';

                                // Append product card
                                productGrid.append(`
                                    <div class="product-card" data-product-id="${product.id}">
                                        ${discountValue}
                                        <img src="${product.thumbnail}" alt="${product.name}">
                                        <p class="product-title">${product.name}</p>
                                        <div class="div-price">
                                            <p class="product-price mb-0 text-bold">$${discountedPrice}</p>
                                            ${hasDiscount ? `<p class="product-price text-decoration-line-through mb-0">$${parseFloat(product.price).toFixed(2)}</p>` : ''}
                                        </div>
                                         ${stockStatus}
                                    </div>
                                `);
                            });
                        } else {
                            productGrid.append('<p>No products found.</p>');
                        }
                    }
                },
                error: function() {
                    alert('Failed to fetch products. Please try again.');
                }
            });
        }
        $('#product-table').on('click', '.btn-delete', function() {
            $(this).closest('tr').remove();
            updateTotals();
        });


        $(document).ready(function() {
            filterProducts('all');
            $('.category-card').first().addClass('selected');
        });
        $(document).on('click', '.product-card', function() {
            const product = $(this);
            const productId = product.data('product-id');
            const productName = product.find('.product-title').text();
            const productPrice = parseFloat(product.find('.product-price').text().replace('$', '')).toFixed(2);
            const quantity = 1;
            const subtotal = (quantity * productPrice).toFixed(2);

            const row = `
                <tr data-product-id="${productId}">
                    <td>${productName}</td>
                    <td class="button-limit">
                        <div class="quantity-control">
                            <button class="decrease">-</button>
                            <span class="mx-2 quantity">${quantity}</span>
                            <button class="increase">+</button>
                        </div>
                        <input type="hidden" class="quantity-input" name="quantity" value="${quantity}">
                        <input type="hidden" class="total-input" data-subtotal="${productId}" name="total" value="${subtotal}">
                    </td>
                    <td class="unit-price">${productPrice}$</td>
                    <td class="subtotal">${subtotal}$</td>
                    <td class="action-buttons">
                        <button class="btn btn-delete"><i class="fas fa-trash fa-lg" style="color: #ed0c0c;"></i></button>
                    </td>
                </tr>
            `;
            $('#product-table').append(row);

            updateTotals();
        });

        function updateTotals() {
            let total = 0;
            $('#product-table tr').each(function() {
                const rowSubtotal = parseFloat($(this).find('.subtotal').text().replace('$', '')) || 0;
                total += rowSubtotal;
            });

            $('.subtotal-container').text(`${total.toFixed(2)}$`);
            $('input[name="subtotal"]').val(total.toFixed(2));
            $('.total-container').text(`${total.toFixed(2)}$`);
            $('input[name="total"]').val(total.toFixed(2));
        }
    </script>
    <script>
        $(document).on('click', '.discount-price', function() {
            const subtotal = parseFloat($('#subtotal').val() || 0);
            if (subtotal <= 0) {
                toastr.error('Please add products to cart before applying discount.');
                return;
            }
            $('#discount_modal').modal('show');
            $('#unit-price').val(`${subtotal.toFixed(2)}$`);
        });

        $('#apply-discount').on('click', function() {
            const discountPercent = parseFloat($('#discount-percent').val() || 0);

            if (!discountPercent || discountPercent < 0 || discountPercent > 100) {
                toastr.error('Please enter a valid discount percent (0-100).');
                return;
            }

            const subtotal = parseFloat($('#subtotal').val() || 0);
            const discountAmount = (subtotal * discountPercent) / 100;
            const total = subtotal - discountAmount;

            $('.discount-container').text(`${discountAmount.toFixed(2)}$`);
            $('.total-container').text(`${total.toFixed(2)}$`);
            $('#discount').val(discountAmount.toFixed(2));
            $('#finaltotal').val(total.toFixed(2));

            toastr.success(`Discount of ${discountPercent}% applied successfully!`);

            $('#discount_modal').modal('hide');
        });
    </script>
    <script>
        $(document).on('click', '.btn-pay-price', function() {
            const total = parseFloat($('#finaltotal').val() || 0);
            if (total <= 0) {
                toastr.error('Please add products to cart before proceeding to payment.');
                return;
            }

            $('#payment_modal').modal('show');
            const displayAmount = total.toFixed(2);
            $('#payment_display').text(displayAmount);
            $('#hidden_payment_display').val(total.toFixed(2));
        });
    </script>
    <script>
        $(document).on('submit', 'form', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: '{{ route('pos_customer_store') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#create_customer').modal('hide');
                        toastr.success(response.msg);
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function(xhr) {
                    toastr.error('Something went wrong!');
                }
            });
        });
    </script>
    <script>
        const compressor = new window.Compress();
        $('.custom-file-input').change(function(e) {
            compressor.compress([...e.target.files], {
                size: 4,
                quality: 0.75,
            }).then((output) => {
                var files = Compress.convertBase64ToFile(output[0].data, output[0].ext);
                var formData = new FormData();

                var thumbnails_hidden = $(this).closest('.custom-file').find('input[type=hidden]');
                var container = $(this).closest('.form-group').find('.preview');
                if (container.find('img').attr('src') === `{{ asset('uploads/defualt.png') }}`) {
                    container.empty();
                }
                formData.append('image', files);

                $.ajax({
                    url: "{{ route('save_temp_file') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 0) {
                            toastr.error(response.msg);
                        }
                        if (response.status == 1) {
                            container.empty();
                            var temp_file = response.temp_files;
                            var img_container = $('<div></div>').addClass('img_container');
                            var img = $('<img>').attr('src', "{{ asset('uploads/temp') }}" +
                                '/' + temp_file);
                            img_container.append(img);
                            container.append(img_container);

                            var new_file_name = temp_file;
                            console.log(new_file_name);

                            image_names_hidden.val(new_file_name);
                        }
                    }
                });
            });
        });
    </script>
@endpush
