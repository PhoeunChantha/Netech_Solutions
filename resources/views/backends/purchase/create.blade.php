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
                                        <label class="required_label" for="product_id">{{ __('Product') }}</label>
                                        <div class="input-group">
                                            <select name="product_id" id="product_id"
                                                class="form-control select2 @error('product_id') is-invalid @enderror">
                                                <option value="">{{ __('Select Product') }}</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
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
                                        @error('product_id')
                                            <span class="invalid-feedback d-block" role="alert">
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
                                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
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
                                                                        value="">
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
                                                                        placeholder="{{ __('Enter Description') }}" value=""></textarea>
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
