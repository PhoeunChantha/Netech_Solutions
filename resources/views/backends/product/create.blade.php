@extends('backends.master')
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Add New Product') }}</h1>
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
                    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                            @foreach (json_decode($language, true) as $lang)
                                                @if ($lang['status'] == 1)
                                                    <li class="nav-item">
                                                        <a class="nav-link text-capitalize {{ $lang['code'] == $default_lang ? 'active' : '' }}"
                                                            id="lang_{{ $lang['code'] }}-tab" data-toggle="pill"
                                                            href="#lang_{{ $lang['code'] }}" data-lang="{{ $lang['code'] }}"
                                                            role="tab" aria-controls="lang_{{ $lang['code'] }}"
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
                                                                    name="name[]" placeholder="{{ __('Enter Name') }}"
                                                                     value="{{ old('name[]') }}">
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
                                                                    class="form-control @error('description') is-invalid @enderror" name="description[]"
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

                                    <!-- Blade View -->
                                    {{-- <div class="form-group col-md-6">
                                        <label class="required_lable" for="category">{{ __('Category') }}</label>
                                        <select name="category_id" id="category_id"
                                            class="form-control select2 @error('category_id') is-invalid @enderror">
                                            <option value="">{{ __('Select category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

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
                                    {{-- <div class="form-group col-md-6 ">
                                        <label class="required_lable"
                                            for="Operating_System">{{ __('Operating System') }}</label>
                                        <select name="operating" id="operating"
                                            class="form-control select2 @error('brand') is-invalid @enderror">
                                            <option value="">{{ __('Select Operating System') }}</option>
                                            <option value="window">{{ __('Window') }}</option>
                                            <option value="apple">{{ __('Apple') }}</option>
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

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
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable"
                                            for="default_purchase_price">{{ __('Default Purchase Price') }}</label>
                                        <input type="number" name="default_purchase_price" id="default_purchase_price"
                                            class="form-control @error('default_purchase_price') is-invalid @enderror"
                                            step="any" value="{{ old('default_purchase_price', 0) }}"
                                            oninput="validateQuantity(this)">
                                        @error('default_purchase_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="" for="quantity">{{ __('Quantity') }}</label>
                                        <input readonly type="number" name="quantity" id="quantity"
                                            class="form-control @error('quantity') is-invalid @enderror" step="any"
                                            min="0" value="{{ old('quantity', 0) }}"
                                            oninput="validateQuantity(this)">
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label class="required_lable" for="exampleInputFile">{{ __('Thumbnail') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="hidden" name="thumbnails" class="thumbnails_hidden">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="thumbnail[]" accept="image/png, image/jpeg" multiple>
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile">{{ __('Choose files') }}</label>
                                                </div>
                                            </div>
                                            <div class=" preview preview-multiple text-center border rounded mt-2"
                                                style="height: 170px; display: flex; flex-wrap: wrap;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="specification">{{ __('Specification') }}</label>
                                        <textarea class="form-control summernote" id="specification" name="specification" rows="3"
                                            placeholder="{{ __('Enter Specification') }}" value=""></textarea>
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
@endsection

@push('js')
    <script>
        const compressor = new window.Compress();
        $('.custom-file-input').on('change', function(e) {
            const $formGroup = $(this).closest('.form-group');
            const $preview = $formGroup.find('.preview-multiple');
            const $hidden = $formGroup.find('input.thumbnails_hidden');
            const $fileInput = this;
            const files = Array.from(e.target.files);

            files.forEach(file => {
                const originalName = file.name;

                compressor.compress([file], {
                        size: 2,
                        quality: 0.75
                    })
                    .then(output => {
                        const compressedFile = Compress.convertBase64ToFile(
                            output[0].data, output[0].ext
                        );
                        const formData = new FormData();
                        formData.append('image', compressedFile);

                        $.ajax({
                            url: "{{ route('save_temp_file') }}",
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status !== 1) {
                                    return toastr.error(response.msg);
                                }

                                const tempFilename = response.temp_files;

                                let tempList = $hidden.val() ?
                                    $hidden.val().split(',').map(s => s.trim()).filter(
                                        Boolean) : [];
                                tempList.push(tempFilename);
                                $hidden.val(tempList.join(','));

                                const $wrapper = $(`
                                    <div class="image-wrapper position-relative"
                                        data-temp-filename="${tempFilename}"
                                        data-orig-name="${originalName}"
                                        style="width:165px; height:165px; margin:5px;">
                                        <img src="{{ asset('uploads/temp') }}/${tempFilename}"
                                            style="width:100%; height:100%; object-fit:cover;">
                                        <button type="button"
                                                class="btn btn-danger btn-sm remove-temp-image"
                                                style="position:absolute; top:2px; right:2px; padding:0 6px;">
                                        &times;
                                        </button>
                                    </div>
                                    `);

                                $preview.append($wrapper);
                            }
                        });
                    });
                    
            });
        });


        $(document).on('click', '.remove-temp-image', function() {
            const $wrapper = $(this).closest('.image-wrapper');
            const tempName = $wrapper.attr('data-temp-filename');
            const origName = $wrapper.attr('data-orig-name');
            const $formGroup = $wrapper.closest('.form-group');
            const $hidden = $formGroup.find('input.thumbnails_hidden');
            const fileInput = $formGroup.find('input.custom-file-input')[0];

            let tempList = $hidden.val() ?
                $hidden.val().split(',').map(s => s.trim()).filter(Boolean) : [];
            tempList = tempList.filter(n => n !== tempName);
            $hidden.val(tempList.join(','));

            const dt = new DataTransfer();
            Array.from(fileInput.files)
                .forEach(f => {
                    if (f.name !== origName) {
                        dt.items.add(f);
                    }
                });
            fileInput.files = dt.files;

            $wrapper.remove();
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
