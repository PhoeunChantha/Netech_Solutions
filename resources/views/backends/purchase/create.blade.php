@extends('backends.master')
@section('contents')
    <style>

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
                                        <label class="required_lable" for="product_id">{{ __('Product') }}</label>
                                        <select name="product_id" id="product_id"
                                            class="form-control select2 @error('product_id') is-invalid @enderror">
                                            <option value="">{{ __('Select Product') }}</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}
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
                                            value="{{ old('quantity') }}" oninput="validateQuantity(this)">
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
                                            value="{{ old('unit_cost') }}">
                                        @error('unit_cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="total_cost">{{ __('Total Cost') }}</label>
                                        <input readonly type="number" step="0.01" name="total_cost" id="total_cost"
                                            class="form-control @error('total_cost') is-invalid @enderror"
                                            value="{{ old('total_cost') }}">
                                        @error('total_cost')
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
                                        <label class="required_label" for="status">{{ __('Status') }}</label>
                                        <select name="status" id="status"
                                            class="form-control select2 @error('status') is-invalid @enderror">
                                            <option value="">{{ __('Select Status') }}</option>
                                            <option value="Pending">{{ __('Pending') }}</option>
                                            <option value="Completed">{{ __('Completed') }}</option>
                                            <option value="Cancel">{{ __('Cancel') }}</option>
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
@endsection

@push('js')
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
