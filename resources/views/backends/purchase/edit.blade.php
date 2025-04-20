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
                    <h1>{{ __('Edit Purchase') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.purchases.update', $purchase->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card no_translate_wrapper">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('General Info') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Supplier Field -->
                                    <div class="form-group col-md-6">
                                        <label class="required_lable" for="supplier_id">{{ __('Supplier') }}</label>
                                        <select name="supplier_id" id="supplier_id"
                                            class="form-control select2 @error('supplier_id') is-invalid @enderror">
                                            <option value="">{{ __('Select Supplier') }}</option>
                                            @foreach ($suppliers as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ $id == $purchase->supplier_id ? 'selected' : '' }}>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Purchase Date Field -->
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="purchase_date">{{ __('Purchase Date') }}</label>
                                        <input type="text" name="purchase_date" id="purchase_date"
                                            class="form-control @error('purchase_date') is-invalid @enderror"
                                            value="{{ old('purchase_date', $purchase->purchase_date) }}">
                                        @error('purchase_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Product Selection Field -->
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="product_id">{{ __('Product') }}</label>
                                        <div class="input-group">
                                            <select name="product_id" id="product_id"
                                                class="form-control select2 @error('product_id') is-invalid @enderror"
                                                multiple>
                                                <option value="">{{ __('Select Product') }}</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-name="{{ $product->name }}"
                                                        data-sell="{{ $product->price }}"
                                                        data-default-purchase-price="{{ $product->default_purchase_price  }}"
                                                        data-quantity="{{ $product->quantity }}"
                                                        {{ $product->id == $purchase->purchaseDetails->first()->product_id ? 'disabled' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <!-- Purchase Status Field -->
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="status">{{ __('Purchase Status') }}</label>
                                        <i class="fa fa-info-circle text-dark" data-toggle="tooltip" data-placement="top"
                                            data-html="true"
                                            title="Products in this purchase will be available for sale only if the <b>Order Status</b> is <b>Items Received</b>."></i>
                                        <select name="status" id="status"
                                            class="form-control select2 @error('status') is-invalid @enderror">
                                            <option value="">{{ __('Select Status') }}</option>
                                            <option value="Pending"
                                                {{ $purchase->purchase_status == 'Pending' ? 'selected' : '' }}>
                                                {{ __('Pending') }}</option>
                                            <option value="Received"
                                                {{ $purchase->purchase_status == 'Received' ? 'selected' : '' }}>
                                                {{ __('Received') }}</option>
                                            <option value="Ordered"
                                                {{ $purchase->purchase_status == 'Ordered' ? 'selected' : '' }}>
                                                {{ __('Ordered') }}</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Product Table -->
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
                                            <tbody>
                                                @foreach ($purchase->purchaseDetails as $purchaseDetail)
                                                    <tr id="row-{{ $purchaseDetail->product_id }}">
                                                        <td>
                                                            <input type="hidden"
                                                                name="products[{{ $purchaseDetail->product_id }}][id]"
                                                                value="{{ $purchaseDetail->product_id }}">
                                                            {{ $purchaseDetail->product->name ?? '' }}<br />
                                                            <span class="product-quantity">{{ __('Current Quantity') }}:
                                                                {{ $purchaseDetail->product->quantity ?? '0' }}</span>
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="products[{{ $purchaseDetail->id }}][quantity]"
                                                                class="form-control" value="{{ $purchaseDetail->quantity }}"
                                                                min="1" required>
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="products[{{ $purchaseDetail->id }}][price]"
                                                                class="form-control" value="{{ $purchaseDetail->price }}"
                                                                step="0.01" required>
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="products[{{ $purchaseDetail->id }}][sell_price]"
                                                                class="form-control" value="{{ $purchaseDetail->sell_price }}"
                                                                step="0.01" required>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm remove-row"
                                                                data-id="{{ $purchaseDetail->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
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

                                    <!-- Description -->
                                    <div class="form-group col-md-12">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea type="text" name="description" id="description"
                                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $purchase->description) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Info Section -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Payment Info') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="required_label"
                                                for="riel_amount">{{ __('Amount-Riels(៛):*') }}</label>
                                            <input type="number" name="riel_amount" id="riel_amount"
                                                class="form-control @error('riel_amount') is-invalid @enderror"
                                                value="{{ old('riel_amount', $purchase->riel_amount) }}" step="any">
                                            @error('riel_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="required_label"
                                                for="dollar_amount">{{ __('Amount-USD($):*') }}</label>
                                            <input type="number" name="dollar_amount" id="dollar_amount"
                                                class="form-control @error('dollar_amount') is-invalid @enderror"
                                                value="{{ old('dollar_amount', $purchase->dollar_amount) }}"
                                                step="any">
                                            @error('dollar_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="required_label"
                                                for="payment_method">{{ __('Payment Method') }}</label>
                                            <select name="payment_method" id="payment_method"
                                                class="form-control select2 @error('payment_method') is-invalid @enderror">
                                                <option value="">{{ __('Select Payment Method') }}</option>
                                                <option value="cash"
                                                    {{ $purchase->payment_method == 'cash' ? 'selected' : '' }}>
                                                    {{ __('Cash') }}</option>
                                                <option value="bank"
                                                    {{ $purchase->payment_method == 'bank' ? 'selected' : '' }}>
                                                    {{ __('Bank Transfer') }}</option>
                                            </select>
                                            @error('payment_method')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6" id="bank_account_div"
                                        style="{{ $purchase->payment_method == 'bank' ? '' : 'display: none;' }}">
                                        <div class="form-group">
                                            <label for="bank_account">{{ __('Bank Account No') }}</label>
                                            <input type="text" name="bank_account" id="bank_account"
                                                class="form-control @error('bank_account') is-invalid @enderror"
                                                value="{{ old('bank_account', $purchase->bank_account) }}">
                                            @error('bank_account')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="payment_note">{{ __('Payment Note') }}</label>
                                            <textarea name="payment_note" id="payment_note" class="form-control @error('payment_note') is-invalid @enderror">{{ old('payment_note', $purchase->payment_note) }}</textarea>
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
    <!-- /.content -->
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
            $('#product_id').select2({
                placeholder: "{{ __('Select product') }}"
            });

            $('#product_id').change(function() {
                const selectedOptions = $(this).find('option:selected');

                selectedOptions.each(function() {
                    const productId = $(this).val();
                    const productName = $(this).data('name');
                    const productSellPrice = $(this).data('sell');
                    const productQuantity = $(this).data('quantity');
                    const defaultPurchasePrice = $(this).data('default-purchase-price');

                    if (!productId || $(`#row-${productId}`).length > 0) return;

                    const row = `
                        <tr id="row-${productId}">
                            <td>
                                <input type="hidden" name="products[${productId}][id]" value="${productId}">
                                ${productName}<br />
                                <span class="product-quantity">{{ __('Quantity') }}: ${productQuantity}</span>
                            </td>
                            <td>
                                <input type="number" name="products[${productId}][quantity]" class="form-control" min="1" required>
                            </td>
                            <td>
                                <input type="number" name="products[${productId}][price]" class="form-control" value="${defaultPurchasePrice}" step="0.01" required>
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

            $(document).on('click', '.remove-row', function() {
                const productId = $(this).data('id');
                $('#row-' + productId).remove();

                $('#product_id option[value="' + productId + '"]').prop('disabled', false);
                updateTotals();
            });

            $(document).on('input', 'input[name*="[quantity]"], input[name*="[price]"]', function() {
                updateTotals();
            });

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

                updatePaymentDue();
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

            updateTotals();
        });
    </script>
    <script>
        function handlePriceInput(input) {
            input.value = input.value.replace(/^0+/, '');
            if (input.value === '') {
                input.value = '0';
            }
        }

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
@endpush
