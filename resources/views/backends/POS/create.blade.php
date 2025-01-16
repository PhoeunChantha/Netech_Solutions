@extends('backends.master')
@include('backends.POS.pos_style');
@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    {{-- <form id="pos_form" method="POST">
                        @csrf --}}
                    <div class="mt-1">
                        <div class="row mt-3">
                            <div>
                                <select class="form-control select2" id="customer_id" name="customer_id" style="width: 450px;">
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
                                <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                                    data-target="#create_customer" style="height: 37px">{{ __('Add Customer') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 table-order">
                        <div class="row table-container">
                            <table class="table table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>{{ __('Product') }}</th>
                                        <th>{{ __('QTY') }}</th>
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
                                        <button type="button" class="btn btn-primary w-75 m-3 discount-price"><img
                                                class="mr-2" src="{{ asset('svgs/pos_discount.svg') }}"
                                                alt="">{{ __('Discount') }}</button>
                                        <button type="button"
                                            class="btn btn-primary w-75 btn-pay-price">{{ __('Pay') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('backends.POS.discount_item_modal')
                    @include('backends.POS.calculator')
                    {{-- </form> --}}
                    @include('backends.POS.create_customer')
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
                            <input type="text" id="product-search" class="form-control"
                                placeholder="Search for products">
                        </div>
                    </div>
                    <div class="product-grid">

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        let currentCategory = 'all';

        $('#product-search').on('input', function() {
            searchProducts();
        });

        function filterProducts(categoryId) {
            $('.category-card').removeClass('selected');
            $(`[data-category-id="${categoryId}"]`).addClass('selected');
            currentCategory = categoryId;
            $('#product-search').val('');
            searchProducts();
        }
        // searchProducts
        function searchProducts() {
            const searchTerm = $('#product-search').val();

            $('.category-card').removeClass('selected');
            $(`[data-category-id="${currentCategory}"]`).addClass('selected');

            $.ajax({
                url: '{{ route('admin.pos_search_products') }}',
                method: 'POST',
                data: {
                    category_id: currentCategory,
                    search_term: searchTerm
                },
                success: function(response) {
                    let productGrid = $('.product-grid');
                    productGrid.empty();

                    if (response.success) {
                        if (response.products.length > 0) {
                            response.products.forEach(product => {
                                const hasDiscount = product.discount && product.discount.discount_value;
                                const discountedPrice = hasDiscount ?
                                    (product.price - (product.price * (product.discount.discount_value /
                                        100))).toFixed(2) :
                                    parseFloat(product.price).toFixed(2);

                                const originalPrice = parseFloat(product.price).toFixed(2);
                                const stockStatus = product.quantity > 0 ?
                                    '<span class="instock">In stock</span>' :
                                    '<span class="out-stock">Out of stock</span>';

                                const discount = product.discount ? product.discount.discount_value : 0;
                                const quantityLimited = product.discount ? product.discount
                                    .quantity_limited : 0;

                                productGrid.append(`
                            <div class="product-card" data-product-id="${product.id}">
                                ${hasDiscount ? `<span class="discount-amount text-white bg-danger text-left">${discount}% OFF</span>` : ''}
                                <input type="hidden" data-discount="${discount}" name="discount" value="${discount}">
                                <input type="hidden" data-quantity_limited="${quantityLimited}" name="quantity_limited" value="${quantityLimited}">
                                <input type="hidden" name="stock" data-stock="${product.quantity}" value="${product.quantity}">
                                <img src="${product.thumbnail}" alt="${product.name}">
                                <p class="product-title">${product.name}</p>
                                <div class="div-price">
                                    <p class="product-price discount-price mb-0 text-bold ">$${discountedPrice}</p>
                                    ${hasDiscount ? `<p class="product-price original-price text-decoration-line-through mb-0 ">$${originalPrice}</p>` : ''}
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
            const stock = product.find('input[name="stock"]').data('stock');

            const originalPriceElement = product.find('.product-price.text-decoration-line-through');
            let originalPrice = 0;
            let discountedPrice = null;

            if (originalPriceElement.length > 0) {
                originalPrice = parseFloat(originalPriceElement.text().replace('$', ''));
                discountedPrice = parseFloat(product.find('.product-price:not(.text-decoration-line-through)')
                    .text().replace('$', ''));
            } else {
                originalPrice = parseFloat(product.find('.product-price').text().replace('$', ''));
                discountedPrice = null;
            }
            let quantity = 1;

            const quantityLimited = parseInt(product.find('input[name="quantity_limited"]').val());
            const existingRow = $(`#product-table tr[data-product-id="${productId}"]`);


            console.log('productId', productId);
            console.log('originalPrice', originalPrice);
            console.log('discountedPrice', discountedPrice);
            console.log('quantityLimited', quantityLimited);

            if (existingRow.length > 0) {
                if (parseInt(existingRow.find('.quantity').text()) >= stock) {
                    toastr.error('Product out of stock!');
                    return;
                }
                quantity = updateExistingRow(existingRow, quantityLimited, originalPrice, discountedPrice);
            } else {
                addNewRow(productId, productName, quantity, quantityLimited, originalPrice, discountedPrice, stock);
            }
            updateTotals();

        });

        $(document).on('click', '.increase', function() {
            const row = $(this).closest('tr');
            const quantityElement = row.find('.quantity');
            let quantity = parseInt(quantityElement.text()) + 1;
            // console.log('quantity', quantity);

            const quantityLimited = parseInt(row.data('quantity-limited'));
            const originalPrice = parseFloat(row.data('original-price'));
            const discountedPrice = parseFloat(row.data('discounted-price'));
            const stock = parseInt(row.data('stock'));
            console.log('Stock', stock);

            console.log('originalPrice', originalPrice);
            console.log('discountedPrice', discountedPrice);
            console.log('quantityLimited', quantityLimited);

            if (quantity > stock) {
                toastr.error('Product out of stock!');
                return;
            } else {
                quantityElement.text(quantity);
                const newSubtotal = calculateSubtotal(quantity, quantityLimited, originalPrice, discountedPrice);
                row.find('.subtotal').text(`${newSubtotal}$`);
                row.find('.quantity-input').val(quantity);
                row.find('.total-input').val(newSubtotal);
                updateTotals();
            }
        });

        $(document).on('click', '.decrease', function() {
            const row = $(this).closest('tr');
            const quantityElement = row.find('.quantity');
            let quantity = parseInt(quantityElement.text()) - 1;
            if (quantity < 1) return;

            const quantityLimited = parseInt(row.data('quantity-limited'));
            const originalPrice = parseFloat(row.data('original-price'));
            const discountedPrice = parseFloat(row.data('discounted-price'));

            // Update quantity and subtotal
            quantityElement.text(quantity);
            const newSubtotal = calculateSubtotal(quantity, quantityLimited, originalPrice, discountedPrice);
            row.find('.subtotal').text(`${newSubtotal}$`);
            row.find('.quantity-input').val(quantity);
            row.find('.total-input').val(newSubtotal);

            // Update totals after modification
            updateTotals();
        });

        function updateExistingRow(row, quantityLimited, originalPrice, discountedPrice) {
            const quantityElement = row.find('.quantity');
            let quantity = parseInt(quantityElement.text()) + 1;
            quantityElement.text(quantity);

            const newSubtotal = calculateSubtotal(quantity, quantityLimited, originalPrice, discountedPrice);

            // Update row values
            row.find('.subtotal').text(`${newSubtotal}$`);
            row.find('.quantity-input').val(quantity);
            row.find('.total-input').val(newSubtotal);

            return quantity;
        }

        function addNewRow(productId, productName, quantity, quantityLimited, originalPrice, discountedPrice, stock) {
            const subtotal = calculateSubtotal(quantity, quantityLimited, originalPrice, discountedPrice);
            const priceToUse = quantity > quantityLimited ? originalPrice : discountedPrice;

            const row = `
            <tr data-product-id="${productId}" data-original-price="${originalPrice}" data-discounted-price="${discountedPrice}" data-quantity-limited="${quantityLimited}" data-stock="${stock}">
                <td>${productName}</td>
                <td class="button-limit">
                    <input type="hidden" name="product_id" value="${productId}">
                    <div class="quantity-control">
                        <button class="decrease">-</button>
                        <span class="mx-2 quantity">${quantity}</span>
                        <button class="increase">+</button>
                    </div>
                    <input type="hidden" class="quantity-input" name="quantity_order" value="${quantity}">
                    <input type="hidden" class="total-input" data-subtotal="${productId}" name="total" value="${subtotal}">
                </td>
                <td class="unit-price">${priceToUse}$</td>
                <td class="subtotal">${subtotal}$</td>
                <td class="action-buttons">
                    <button class="btn btn-delete"><i class="fas fa-trash fa-lg" style="color: #ed0c0c;"></i></button>
                </td>
            </tr>`;

            $('#product-table').append(row);
        }

        function calculateSubtotal(quantity, quantityLimited, originalPrice, discountedPrice) {
            const priceToUse = discountedPrice ? discountedPrice : originalPrice;

            if (quantity > quantityLimited) {
                const discountedTotal = quantityLimited * priceToUse;
                const nonDiscountedTotal = (quantity - quantityLimited) *
                    originalPrice;
                return (discountedTotal + nonDiscountedTotal).toFixed(2);
            } else {
                return (quantity * priceToUse).toFixed(2);
            }
        }

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
    <!-- Apply discount modal -->
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
    {{-- pust data need to store to modal --}}
    <script>
        $(document).on('click', '.btn-pay-price', function() {
            const total = parseFloat($('#finaltotal').val() || 0);
            const customer_id = $('#customer_id').val();

            const productOrders = [];
            if (total <= 0) {
                toastr.error('Please add products to cart before proceeding to payment.');
                return;
            }

            $('#product-table tr').each(function() {
                const row = $(this);
                const productId = parseInt(row.data('product-id'));
                const productName = row.find('td:first').text().trim();
                const quantity = parseInt(row.find('.quantity').text());
                const subtotal = parseFloat(row.find('.subtotal').text().replace('$', ''));

                productOrders.push({
                    productId,
                    productName,
                    quantity,
                    subtotal
                });
            });

            let orderDetailsHtml = '';
            productOrders.forEach((order) => {
                orderDetailsHtml += `
                    <tr>
                        <td>${order.productName}</td>
                        <td>${order.quantity}</td>
                        <td>${order.subtotal.toFixed(2)}$</td>
                    </tr>
                `;
            });

            $('#order-details-body').html(orderDetailsHtml);
            $('#payment_display').text(total.toFixed(2));
            $('#hidden_payment_display').val(total.toFixed(2));
            $('#payment_modal #customer_id').val(customer_id);

            $('#payment_modal').modal('show');
        });
    </script>
    {{-- create new customer --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.create_customer', function(e) {
                e.preventDefault();
                const form = document.getElementById('create_customer_form');
                const formData = new FormData(form);

                // AJAX request
                $.ajax({
                    url: '{{ route('admin.pos_customer_store') }}',
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
