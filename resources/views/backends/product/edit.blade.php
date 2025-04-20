@extends('backends.master')
@section('contents')
    <style>
        .image-wrapper {
            width: 221px;
            height: 147px;
        }
    </style>
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
                    <form method="POST" action="{{ route('admin.product.update', $product->id) }}"
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
                                                    if (count($product['translations'])) {
                                                        $translate = [];
                                                        foreach ($product['translations'] as $t) {
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
                                                                    value="{{ $translate[$lang['code']]['name'] ?? $product['name'] }}">

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
                                                                    class="form-control  @error('description') is-invalid @enderror" name="description[]"
                                                                    placeholder="{{ __('Enter Description') }}" value="">{{ $translate[$lang['code']]['description'] ?? $product['description'] }}</textarea>

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
                                                <option
                                                    value="{{ $category->id }}"{{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
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
                                                <option
                                                    value="{{ $brand->id }}"{{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group col-md-6">
                                        <label class="required_label" for="operating">{{ __('Operating System') }}</label>
                                        <select name="operating" id="operating"
                                            class="form-control select2 @error('operating') is-invalid @enderror">
                                            <option value="">{{ __('Select Operating System') }}</option>
                                            <option value="window"
                                                {{ $product->operating_system == 'window' ? 'selected' : '' }}>
                                                {{ __('Window') }}
                                            </option>
                                            <option value="apple"
                                                {{ $product->operating_system == 'apple' ? 'selected' : '' }}>
                                                {{ __('Apple') }}
                                            </option>
                                        </select>
                                        @error('operating')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    <div class="form-group col-md-6">
                                        <label class="required_label" for="price">{{ __('Price') }}</label>
                                        <input type="text" name="price" id="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', $product->price ?? 0) }}"
                                            oninput="handlePriceInput(this)">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable" for="default_purchase_price">{{ __('Default Purchase Price') }}</label>
                                        <input type="number" name="default_purchase_price" id="default_purchase_price"
                                            class="form-control @error('default_purchase_price') is-invalid @enderror" step="any"
                                            value="{{ old('default_purchase_price', $product->default_purchase_price ?? 0) }}" oninput="validateQuantity(this)">
                                        @error('default_purchase_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label class="" for="quantity">{{ __('Quantity') }}</label>
                                        <input type="number" name="quantity" id="quantity"
                                            class="form-control @error('quantity') is-invalid @enderror" step="any"
                                            value="{{ old('quantity', $product->quantity ?? 0) }}"
                                            oninput="handlePriceInput(this)">
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">{{ __('Thumbnail') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="thumbnail[]" accept="image/png, image/jpeg" multiple>
                                                    <label class="custom-file-label" for="exampleInputFile">
                                                        @if (is_array($product->thumbnail) && count($product->thumbnail) > 0)
                                                            {{ implode(', ', array_map('basename', $product->thumbnail)) }}
                                                        @else
                                                            {{ __('Choose file') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="preview text-center border rounded mt-2"
                                                style="height: 150px; display: flex; flex-wrap: wrap; gap: 5px; overflow: auto;">
                                                @if (is_array($product->thumbnail))
                                                    @foreach ($product->thumbnail as $index => $thumbnail)
                                                        <div class="image-wrapper" style="position: relative;">
                                                            <img src="{{ asset('uploads/products/' . $thumbnail) }}"
                                                                alt="Existing Image" style="height: 100%; width: auto;">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-image"
                                                                style="position: absolute; top: 5px; right: 5px;"
                                                                data-index="{{ $index }}">×</button>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <img src="{{ asset('uploads/defualt.png') }}" alt=""
                                                        height="100%">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="specification">{{ __('Specification') }}</label>
                                        <textarea class="form-control summernote" id="specification" name="specification" rows="3"
                                            placeholder="{{ __('Enter Specification') }}">{{ $product->specification }}</textarea>
                                        @error('specification')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
        document.addEventListener('DOMContentLoaded', function() {
            // Handle file input change
            const fileInput = document.getElementById('exampleInputFile');
            const preview = document.querySelector('.preview');

            fileInput.addEventListener('change', function(e) {
                const files = e.target.files;

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (file && file.type.match('image.*')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'image-wrapper';
                            wrapper.style.position = 'relative';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.height = '100%';
                            img.style.width = 'auto';

                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.className = 'btn btn-danger btn-sm remove-new-image';
                            removeBtn.style.position = 'absolute';
                            removeBtn.style.top = '5px';
                            removeBtn.style.right = '5px';
                            removeBtn.innerHTML = '×';

                            wrapper.appendChild(img);
                            wrapper.appendChild(removeBtn);
                            preview.appendChild(wrapper);
                        }

                        reader.readAsDataURL(file);
                    }
                }
            });

            // Remove existing image
            preview.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-image')) {
                    const wrapper = e.target.closest('.image-wrapper');
                    const index = e.target.getAttribute('data-index');
                    wrapper.remove();
                    // Optionally add hidden input to track removed images if needed
                    // const input = document.createElement('input');
                    // input.type = 'hidden';
                    // input.name = 'removed_thumbnails[]';
                    // input.value = index;
                    // preview.appendChild(input);
                }
            });

            // Remove newly uploaded image
            preview.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-new-image')) {
                    const wrapper = e.target.closest('.image-wrapper');
                    wrapper.remove();
                }
            });

            // Update file input label
            fileInput.addEventListener('change', function(e) {
                const fileNames = Array.from(e.target.files).map(file => file.name);
                const label = this.nextElementSibling;
                label.textContent = fileNames.length > 0 ? fileNames.join(', ') :
                    '{{ __('Choose file') }}';
            });
        });
    </script>
    <script>
        // $('.custom-file-input').change(function(e) {
        //     var reader = new FileReader();
        //     var preview = $(this).closest('.form-group').find('.preview img');
        //     reader.onload = function(e) {
        //         preview.attr('src', e.target.result).show();
        //     }
        //     reader.readAsDataURL(this.files[0]);
        // });

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
@endpush
