@extends('backends.master')
@section('contents')
    <style>
        .text-sm .select2-container--default .select2-selection--multiple .select2-selection__rendered,
        select.form-control-sm~.select2-container--default .select2-selection--multiple .select2-selection__rendered {
            padding: 6px 0.25rem 6px 7px !important;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Add New Purchase') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.purchases.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card no_translate_wrapper">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('General Info') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required_lable" for="supplier_id">{{ __('Supplier') }}</label>
                                        <select name="supplier_id" id="supplier_id"
                                            class="form-control select2 @error('supplier_id') is-invalid @enderror">
                                            <option value="">{{ __('Select Supplier') }}</option>
                                            @foreach ($suppliers as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="purchase_date">{{ __('Purchase Date') }}</label>
                                        <input type="text" name="purchase_date" id="purchase_date"
                                            class="form-control  @error('purchase_date') is-invalid @enderror"
                                            value="{{ old('purchase_date') }}">
                                        @error('purchase_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="product_id">{{ __('Product') }}</label>
                                        <div class="input-group">
                                            <select name="product_id" id="product_id"
                                                class="form-control select2  @error('product_id') is-invalid @enderror"
                                                multiple>
                                                <option value="">{{ __('Select Product') }}</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-name="{{ $product->name }}"
                                                        data-sell="{{ $product->price }}"
                                                        data-default-purchase-price="{{ $product->default_purchase_price  }}"
                                                        data-quantity="{{ $product->quantity }}">
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <a data-toggle="modal" data-target="#add-product"
                                                    data-href="{{ route('admin.purchases.product-create') }}"
                                                    href="javascript:void(0)"
                                                    class="btn btn-primary d-flex align-items-center add-product">
                                                    <i class="fa fa-plus-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="status">{{ __('Purchase Status') }}
                                        </label>
                                        <i class="fa fa-info-circle text-dark" data-toggle="tooltip" data-placement="top"
                                            data-html="true"
                                            title="Products in this purchase will be available for sale only if the &lt;b&gt;Order Status&lt;/b&gt; is &lt;b&gt;Items Received&lt;/b&gt;."></i>
                                        <select name="status" id="status"
                                            class="form-control select2 @error('status') is-invalid @enderror">
                                            <option value="">{{ __('Select Status') }}</option>
                                            <option value="Pending">{{ __('Pending') }}</option>
                                            <option value="Recieved">{{ __('Recieved') }}</option>
                                            <option value="Ordered">{{ __('Ordered') }}</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <table class="table" id="product-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>{{ __('Product Name') }}</th>
                                                    <th>{{ __('Purchase Quantity') }}</th>
                                                    <th>{{ __('Purchase Price') }}</th>
                                                    <th>{{ __('Sell Price') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" class="text-right">
                                                        <strong>{{ __('Total Item: ') }}
                                                            <span id="totalitemt">0</span></strong><br>
                                                        <strong>{{ __('Total Amount: ') }}
                                                            <span id="totalamount">$0.00</span></strong>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="" for="description">{{ __('Description') }}</label>
                                        <textarea type="text" name="description" id="description"
                                            class="form-control  @error('description') is-invalid @enderror" value="{{ old('description') }}"></textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Payment Info') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="required_label" for="riel_amount">{{ __('Amount-Riels(៛):*') }}
                                            </label>
                                            <input type="number" name="riel_amount" id="riel_amount"
                                                class="form-control @error('riel_amount') is-invalid @enderror"
                                                value="{{ old('riel_amount') }}" step="any">
                                            @error('riel_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="required_label" for="dollar_amount">{{ __('Amount-USD($):*') }}
                                            </label>
                                            <input type="number" name="dollar_amount" id="dollar_amount"
                                                class="form-control @error('dollar_amount') is-invalid @enderror"
                                                value="{{ old('dollar_amount') }}" step="any">
                                            @error('dollar_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="required_label" for="payment_method">{{ __('Payment Method') }}
                                            </label>
                                            <select name="payment_method" id="payment_method"
                                                class="form-control select2 @error('payment_method') is-invalid @enderror">
                                                <option value="">{{ __('Select Payment Method') }}</option>
                                                <option value="cash">{{ __('Cash') }}</option>
                                                <option value="bank">{{ __('Bank Transfer') }}</option>
                                            </select>
                                            @error('payment_method')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6" id="bank_account_div" style="display: none;">
                                        <div class="form-group">
                                            <label class="" for="bank_account">{{ __('Bank Account No') }}
                                            </label>
                                            <input type="text" name="bank_account" id="bank_account"
                                                class="form-control @error('bank_account') is-invalid @enderror"
                                                value="{{ old('bank_account') }}">
                                            @error('bank_account')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="" for="payment_note">{{ __('Payment Note') }}
                                            </label>
                                            <textarea type="text" name="payment_note" id="payment_note"
                                                class="form-control @error('payment_note') is-invalid @enderror" value="{{ old('payment_note') }}"></textarea>
                                            @error('payment_note')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <hr>
                                        <input type="hidden" name="payment_due" id="payment_due">
                                        <label for="payment_due" id="payment_due_label">{{ __('Payment Due:') }}<span
                                                class="ml-2" id="payment_due_value">$ 0.00</span></label>
                                    </div>
                                    <div class="col-12 form-group">
                                        <button type="submit" class="btn btn-primary float-right">
                                            <i class="fa fa-save"></i>
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade modal_form" id="add-product" tabindex="-1" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Product') }}</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="add-product-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            @csrf
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="nav nav-t" id="custom-content-below-tab" role="tablist">
                                                @foreach (json_decode($language, true) as $lang)
                                                    @if ($lang['status'] == 1)
                                                        <li class="nav-item">
                                                            <a class="nav-link text-capitalize {{ $lang['code'] == $default_lang ? 'active' : '' }}"
                                                                id="lang_{{ $lang['code'] }}-tab" data-toggle="pill"
                                                                href="#lang_{{ $lang['code'] }}"
                                                                data-lang="{{ $lang['code'] }}" role="tab"
                                                                aria-controls="lang_{{ $lang['code'] }}"
                                                                aria-selected="false">{{ \App\helpers\AppHelper::get_language_name($lang['name']) . '(' . strtoupper($lang['code']) . ')' }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <div class="tab-content" id="custom-content-below-tabContent">
                                                @foreach (json_decode($language, true) as $key => $lang)
                                                    @if ($lang['status'] == 1)
                                                        <div class="tab-pane fade {{ $lang['code'] == $default_lang ? 'show active' : '' }} mt-3"
                                                            id="lang_{{ $lang['code'] }}" role="tabpanel"
                                                            aria-labelledby="lang_{{ $lang['code'] }}-tab">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <input type="hidden" name="lang[]"
                                                                        value="{{ $lang['code'] }}">
                                                                    <label for="name_{{ $lang['code'] }}"
                                                                        class="required_lable">{{ __('Name') }}({{ strtoupper($lang['code']) }})</label>
                                                                    <input type="name" id="name_{{ $lang['code'] }}"
                                                                        class="form-control @error('name') is-invalid @enderror"
                                                                        name="name[]"
                                                                        placeholder="{{ __('Enter Name') }}"
                                                                        value="{{ old('name') }}">
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label
                                                                        for="description_{{ $lang['code'] }}">{{ __('Description') }}
                                                                        ({{ strtoupper($lang['code']) }})
                                                                    </label>
                                                                    <textarea type="text" id="description_{{ $lang['code'] }}"
                                                                        class="form-control    @error('description') is-invalid @enderror" name="description[]"
                                                                        placeholder="{{ __('Enter Description') }}" value="{{ old('description') }}"></textarea>
                                                                    @error('description')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card no_translate_wrapper">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('General Info') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="required_lable" for="category">{{ __('Category') }}</label>
                                            <select name="category_id" id="category_id"
                                                class="form-control select2 @error('category_id') is-invalid @enderror">
                                                <option value="">{{ __('Select category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="required_lable" for="brand">{{ __('Brand') }}</label>
                                            <select name="brand_id" id="brand"
                                                class="form-control select2 @error('brand_id') is-invalid @enderror">
                                                <option value="">{{ __('Select brand') }}</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 ">
                                            <label class="required_lable" for="price">{{ __('Price') }}</label>
                                            <input type="number" name="price" id="price"
                                                class="form-control @error('price') is-invalid @enderror" step="any"
                                                value="{{ old('price', 0) }}" oninput="validateQuantity(this)">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="required_label" for="quantity">{{ __('Quantity') }}</label>
                                            <input type="number" name="quantity" id="quantity"
                                                class="form-control @error('quantity') is-invalid @enderror"
                                                step="any" min="0" value="{{ old('quantity', 0) }}"
                                                oninput="validateQuantity(this)">
                                            @error('quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="specification">{{ __('Specification') }}</label>
                                            <textarea class="form-control summernote" id="specification" name="specification" rows="3"
                                                placeholder="{{ __('Enter Specification') }}" value=""></textarea>
                                            @error('specification')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">{{ __('Thumbnail') }}</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="hidden" name="thumbnails"
                                                            class="thumbnails_hidden">
                                                        <input type="file" class="custom-file-input"
                                                            id="exampleInputFile" name="thumbnail[]"
                                                            accept="image/png, image/jpeg" multiple>
                                                        <label class="custom-file-label"
                                                            for="exampleInputFile">{{ __('Choose files') }}</label>
                                                    </div>
                                                </div>
                                                <div class=" preview preview-multiple text-center border rounded mt-2"
                                                    style="height: 170px; display: flex; flex-wrap: wrap;">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fa fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#payment_method').change(function() {
                if ($(this).val() === 'bank') {
                    $('#bank_account_div').show();
                } else {
                    $('#bank_account_div').hide();
                }
            }).trigger('change');
        })

        $(document).ready(function() {
            $('#add-product-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.purchases.product-store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#add-product').modal('hide');
                            toastr.success(response.msg);
                            if (response.product) {
                                let newProduct = response.product;
                                let productSelect = $('#product_id');

                                productSelect.append(
                                    `<option value="${newProduct.id}" selected>${newProduct.name}</option>`
                                );

                                productSelect.trigger('change');
                            }
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = xhr.statusText;
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        toastr.error(errorMsg);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#product_id').select2({
                placeholder: "{{ __('Select product') }}"
            });

            // When a product is selected
            $('#product_id').change(function() {
                const selectedOptions = $(this).find('option:selected');

                selectedOptions.each(function() {
                    const productId = $(this).val();
                    const productName = $(this).data('name');
                    const productSellPrice = $(this).data('sell');
                    const productQuantity = $(this).data('quantity');
                    const productDefaultPurchasePrice = $(this).data('default-purchase-price');

                    if (!productId || $(`#row-${productId}`).length > 0) return;

                    const row = `
                        <tr id="row-${productId}">
                            <td>
                                <input type="hidden" name="products[${productId}][id]" value="${productId}">
                                ${productName}<br />
                                <span class="product-quantity">{{ __('Current Quantity') }}: ${productQuantity}</span>
                            </td>
                            <td>
                                <input type="number" name="products[${productId}][quantity]" class="form-control" min="1" required>
                            </td>
                            <td>
                                <input type="number" name="products[${productId}][price]" class="form-control" value="${productDefaultPurchasePrice}" step="0.01" required>
                            </td>
                            <td>
                                <input type="number" name="products[${productId}][sell_price]" class="form-control" value="${productSellPrice}" step="0.01" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row" data-id="${productId}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;

                    $('#product-table tbody').append(row);

                    $('#product_id').find('option[value="' + productId + '"]').prop('disabled',
                        true);
                });

                $('#product_id').val([]).trigger('change.select2');
                updateTotals();
            });

            // When a row is removed
            $(document).on('click', '.remove-row', function() {
                const productId = $(this).data('id');
                $('#row-' + productId).remove();

                $('#product_id option[value="' + productId + '"]').prop('disabled', false);
                updateTotals();
            });

            $(document).on('input', 'input[name*="[quantity]"], input[name*="[price]"]', function() {
                updateTotals();
            });

            // Update the total item and amount
            function updateTotals() {
                let totalItems = 0;
                let totalAmount = 0;

                $('#product-table tbody tr').each(function() {
                    const quantity = parseFloat($(this).find('input[name*="[quantity]"]').val()) || 0;
                    const purchasePrice = parseFloat($(this).find('input[name*="[price]"]')
                        .val()) || 0;

                    totalItems += quantity;
                    totalAmount += quantity * purchasePrice;
                });

                $('#totalitemt').text(totalItems);
                $('#totalamount').text('$' + totalAmount.toFixed(2));
            }

            function updatePaymentDue() {
                const totalAmount = parseFloat($('#totalamount').text().replace('$', '')) || 0;
                const rielAmount = parseFloat($('#riel_amount').val()) || 0;
                const dollarAmount = parseFloat($('#dollar_amount').val()) || 0;
                

                const exchangeRate = 4000;
                if ($('#riel_amount').is(':focus')) {
                    const convertedDollar = rielAmount / exchangeRate;
                    $('#dollar_amount').val(convertedDollar.toFixed(2));
                }

                if ($('#dollar_amount').is(':focus')) {
                    const convertedRiel = dollarAmount * exchangeRate;
                    $('#riel_amount').val(convertedRiel.toFixed(2));
                }
                const paymentDue = totalAmount - dollarAmount;

                $('#payment_due').val(paymentDue.toFixed(2));
                $('#payment_due_value').text('$ ' + paymentDue.toFixed(2));
            }

            $('#riel_amount, #dollar_amount').on('input', function() {
                updatePaymentDue();
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#purchase_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                startDate: new Date(),
            });
            $('#quantity, #unit_cost').on('input', function() {
                let purchaseQTY = parseFloat($('#quantity').val()) || 0;
                let unitCost = parseFloat($('#unit_cost').val()) || 0;
                let totalCost = purchaseQTY * unitCost;
                $('#total_cost').val(totalCost.toFixed(2));
            });
        });
    </script>
    <script>
        function validateQuantity(input) {
            // Remove leading zeros
            input.value = input.value.replace(/^0+/, '');
            // Ensure value is not less than 0
            if (input.value < 0) {
                input.value = 0;
            }
            // Ensure an empty input is set to 0
            if (input.value === '') {
                input.value = 0;
            }
        }
    </script>
@endpush
