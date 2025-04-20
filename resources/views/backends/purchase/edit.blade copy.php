@extends('backends.master')
@section('contents')
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
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="supplier_id">{{ __('Supplier') }}</label>
                                        <select name="supplier_id" id="supplier_id"
                                            class="form-control select2 @error('supplier_id') is-invalid @enderror">
                                            <option value="">{{ __('Select Supplier') }}</option>
                                            @foreach ($suppliers as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ $purchase->supplier_id == $id ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="product_id">{{ __('Product') }}</label>
                                        <select name="product_id" id="product_id"
                                            class="form-control select2 @error('product_id') is-invalid @enderror">
                                            <option value="">{{ __('Select Product') }}</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ $purchase->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="quantity">{{ __('Quantity') }}</label>
                                        <input type="number" name="quantity" id="quantity"
                                            class="form-control @error('quantity') is-invalid @enderror"
                                            value="{{ old('quantity', $purchase->quantity) }}"
                                            oninput="validateQuantity(this)">
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="unit_cost">{{ __('Unit Cost') }}</label>
                                        <input type="number" step="0.01" name="unit_cost" id="unit_cost"
                                            class="form-control @error('unit_cost') is-invalid @enderror"
                                            value="{{ old('unit_cost', $purchase->unit_cost) }}">
                                        @error('unit_cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="total_cost">{{ __('Total Cost') }}</label>
                                        <input type="number" step="0.01" name="total_cost" id="total_cost"
                                            class="form-control @error('total_cost') is-invalid @enderror"
                                            value="{{ old('total_cost', $purchase->total_cost) }}">
                                        @error('total_cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="purchase_date">{{ __('Purchase Date') }}</label>
                                        <input type="date" name="purchase_date" id="purchase_date"
                                            class="form-control @error('purchase_date') is-invalid @enderror"
                                            value="{{ old('purchase_date', $purchase->purchase_date) }}">
                                        @error('purchase_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="" for="description">{{ __('Description') }}</label>
                                        <textarea type="text" name="description" id="description"
                                            class="form-control  @error('description') is-invalid @enderror" value="{{ old('description') }}">{{ $purchase->description }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="status">{{ __('Status') }}</label>
                                        <select name="status" id="status"
                                            class="form-control select2 @error('status') is-invalid @enderror">
                                            <option value="">{{ __('Select Status') }}</option>
                                            <option value="Pending"
                                                {{ $purchase->purchase_status == 'Pending' ? 'selected' : '' }}>
                                                {{ __('Pending') }}</option>
                                            <option value="Completed"
                                                {{ $purchase->purchase_status == 'Completed' ? 'selected' : '' }}>
                                                {{ __('Completed') }}</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
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
                    <input type="number" name="products[${productId}][price]" class="form-control" step="0.01" required>
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
