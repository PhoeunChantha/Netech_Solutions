@extends('backends.master')
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Product') }}</h1>
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
                    <form method="POST" action="{{ route('admin.discount.update', $discount->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                            {{-- @dump($languages) --}}
                                            @foreach (json_decode($language, true) as $lang)
                                                @if ($lang['status'] == 1)
                                                    <li class="nav-item">
                                                        <a class="nav-link text-capitalize {{ $lang['code'] == $default_lang ? 'active' : '' }}"
                                                            id="lang_{{ $lang['code'] }}-tab" data-toggle="pill"
                                                            href="#lang_{{ $lang['code'] }}" data-lang="{{ $lang['code'] }}"
                                                            role="tab" aria-controls="lang_{{ $lang['code'] }}"
                                                            aria-selected="false">{{ \App\helpers\AppHelper::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')' }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                        </ul>
                                        <div class="tab-content" id="custom-content-below-tabContent">
                                            @foreach (json_decode($language, true) as $lang)
                                                @if ($lang['status'] == 1)
                                                    <?php
                                                    if (count($discount['translations'])) {
                                                        $translate = [];
                                                        foreach ($discount['translations'] as $t) {
                                                            if ($t->locale == $lang['code'] && $t->key == 'name') {
                                                                $translate[$lang['code']]['name'] = $t->value;
                                                            }
                                                            if ($t->locale == $lang['code'] && $t->key == 'description') {
                                                                $translate[$lang['code']]['description'] = $t->value;
                                                            }
                                                        }
                                                    }
                                                    ?>
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
                                                                    name="name[]" placeholder="{{ __('Enter Name') }}"
                                                                    value="{{ $translate[$lang['code']]['name'] ?? $discount['name'] }}">

                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label
                                                                    for="description_{{ $lang['code'] }}">{{ __('Description') }}({{ strtoupper($lang['code']) }})</label>
                                                                <textarea type="text" id="description_{{ $lang['code'] }}"
                                                                    class="form-control @error('description') is-invalid @enderror" name="description[]"
                                                                    placeholder="{{ __('Enter Description') }}" value="">{{ $translate[$lang['code']]['description'] ?? $discount['description'] }}</textarea>
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
                                        <label class="required_lable" for="discount_type">{{ __('Discount Type') }}</label>
                                        <select name="discount_type" id="discount_type"
                                            class="form-control select2 @error('discount_type') is-invalid @enderror">
                                            <option value="">{{ __('Select type') }}</option>
                                            <option selected value="percentage"
                                                {{ old('discount_type', $discount->discount_type) == 'percentage' ? 'selected' : '' }}>
                                                {{ __('Percentage') }}
                                            </option>
                                            <option value="fixed"
                                                {{ old('discount_type', $discount->discount_type) == 'fixed' ? 'selected' : '' }}>
                                                {{ __('Fixed') }}
                                            </option>
                                        </select>
                                        @error('discount_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="amount">
                                        <label class="required_lable"
                                            for="discount_value_fixed">{{ __('Discount Amount') }}</label>
                                        <div class="input-group">
                                            <input type="number" name="discount_value" id="discount_value_fixed"
                                                class="form-control @error('discount_value') is-invalid @enderror"
                                                step="any"
                                                value="{{ old('discount_value', $discount->discount_value ?? 0) }}"
                                                oninput="validateQuantity(this)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            @error('discount_value')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 d-none" id="percent">
                                        <label class="required_lable"
                                            for="discount_value_percent">{{ __('Discount Percentage') }}</label>
                                        <div class="input-group">
                                            <input type="number" name="discount_value" id="discount_value_percent"
                                                class="form-control @error('discount_value') is-invalid @enderror"
                                                step="any"
                                                value="{{ old('discount_value', $discount->discount_value ?? 0) }}"
                                                oninput="validateQuantity(this)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-percent"></i>
                                                </span>
                                            </div>
                                            @error('discount_value')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable" for="quantity_limited">{{ __('Quantity') }}</label>
                                        <input type="number" name="quantity_limited" id="quantity_limited"
                                            class="form-control @error('quantity_limited') is-invalid @enderror"
                                            value="{{ old('quantity_limited', $discount->quantity_limited ?? 0) }}">
                                        @error('quantity_limited')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_lable" for="start_date">{{ __('Start Date') }}</label>
                                        <input type="text" name="start_date" id="start_date"
                                            class="form-control datepicker @error('start_date') is-invalid @enderror"
                                            value="{{ old('start_date', $discount->start_date ?? '') }}">
                                        @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_lable" for="end_date">{{ __('End Date') }}</label>
                                        <input type="text" name="end_date" id="end_date"
                                            class="form-control datepicker @error('end_date') is-invalid @enderror"
                                            value="{{ old('end_date', $discount->end_date ?? '') }}">
                                        @error('end_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6"></div>
                                    <div class="form-group col-md-6">
                                        <label class="required_lable"
                                            for="Only Apply Discount to">{{ __('Apply Discount to') }}</label>
                                        <div class="card mb-1">
                                            <div class="card-body" style="padding: 1rem;">
                                                <section class="Wrapper">
                                                    @foreach ($brands as $brand)
                                                        <div class="Checkbox-parent Accordion d-flex align-items-center"
                                                            style="margin-bottom: 3px; cursor: pointer;">
                                                            <i class="fas fa-caret-down mt-0"></i>
                                                            <span
                                                                style="margin-left: 2% !important; font-weight: 400; font-size: 15px;">
                                                                {{ $brand->name }}
                                                            </span>
                                                            <input id="apply_discount_to_{{ $brand->id }}"
                                                                name="apply_discount_to[]"
                                                                class="material-icons ml-auto @error('apply_discount_to') is-invalid @enderror"
                                                                type="checkbox" />
                                                        </div>
                                                        <div id="Accordion-panel" class="Accordion-panel">
                                                            <ul class="Checkbox-child pl-4">
                                                                @foreach ($brand->products as $product)
                                                                    @php
                                                                        $product_ids = is_string($discount->product_ids)
                                                                            ? json_decode($discount->product_ids, true)
                                                                            : $discount->product_ids;
                                                                        $product_ids = $product_ids ?? [];
                                                                    @endphp
                                                                    <li
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <span
                                                                            style="font-weight: 400; font-size: 15px; margin-bottom: 3px;">
                                                                            {{ $product->name }}
                                                                        </span>
                                                                        <input value="{{ $product->id }}"
                                                                            name="product_ids[]" class="material-icons"
                                                                            type="checkbox"
                                                                            data-brand-id="{{ $brand->id }}"
                                                                            {{ in_array($product->id, $product_ids) ? 'checked' : '' }} />
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </section>

                                            </div>
                                        </div>
                                        @error('product_id')
                                            <span class="text-danger" role="alert" style="font-size: 0.75rem">
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">{{ __('Image') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="image" accept="image/png, image/jpeg">
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile">{{ __('Choose file') }}</label>
                                                </div>
                                            </div>
                                            <div class="preview preview-multiple text-center border rounded mt-2"
                                                style="height: 150px">
                                                <img src="
                                                    @if ($discount->image && file_exists(public_path('uploads/discounts/' . $discount->image))) {{ asset('uploads/discounts/' . $discount->image) }}
                                                    @else
                                                        {{ asset('uploads/defualt.png') }} @endif
                                                    "
                                                    alt="" height="100%">
                                            </div>
                                        </div>
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
            function toggleDiscountFields() {
                var discountType = $('#discount_type').val();
                if (discountType === 'percentage') {
                    $('#amount').addClass('d-none');
                    $('#percent').removeClass('d-none');
                } else {
                    $('#percent').addClass('d-none');
                    $('#amount').removeClass('d-none');
                }
            }

            toggleDiscountFields();

            $(document).on('change', '#discount_type', function() {
                toggleDiscountFields();
            });
        });
    </script>
    <script>
        $('.custom-file-input').change(function(e) {
            var reader = new FileReader();
            var preview = $(this).closest('.form-group').find('.preview img');
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on('click', '.nav-tabs .nav-link', function(e) {
            if ($(this).data('lang') != 'en') {
                $('.no_translate_wrapper').addClass('d-none');
            } else {
                $('.no_translate_wrapper').removeClass('d-none');
            }
        });
    </script>
    <script>
        function handlePriceInput(input) {
            // Remove leading zeros
            input.value = input.value.replace(/^0+/, '');

            // Ensure an empty input is set to 0
            if (input.value === '') {
                input.value = '0';
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandCheckboxes = document.querySelectorAll('input[name="apply_discount_to[]"]');
            const productCheckboxes = document.querySelectorAll('input[name="product_ids[]"]');

            function updateBrandCheckboxes() {
                productCheckboxes.forEach(productCheckbox => {
                    if (productCheckbox.checked) {
                        const brandId = productCheckbox.getAttribute('data-brand-id');
                        const brandCheckbox = document.getElementById(`apply_discount_to_${brandId}`);
                        if (brandCheckbox) {
                            brandCheckbox.checked = true;
                        }
                    }
                });
            }

            updateBrandCheckboxes();

            productCheckboxes.forEach(productCheckbox => {
                productCheckbox.addEventListener('change', updateBrandCheckboxes);
            });
        });
    </script>
@endpush
