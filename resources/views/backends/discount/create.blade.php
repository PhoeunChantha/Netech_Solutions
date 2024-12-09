@extends('backends.master')
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Add New Discount') }}</h1>
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
                    <form method="POST" action="{{ route('admin.discount.store') }}" enctype="multipart/form-data">
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
                                                                    class="form-control   @error('description') is-invalid @enderror" name="description[]"
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
                                        <label class="required_lable" for="brand">{{ __('Discount Type') }}</label>
                                        <select name="discount_type" id="brand"
                                            class="form-control select2 @error('discount_type') is-invalid @enderror">
                                            <option value="">{{ __('Select type') }}</option>
                                            <option value="percentage">{{ __('Percentage') }}</option>
                                            <option value="fixed">{{ __('Fixed') }}</option>
                                        </select>
                                        @error('discount_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable"
                                            for="discount_value">{{ __('Discount Amount') }}</label>
                                        <input type="number" name="discount_value" id="discount_value"
                                            class="form-control @error('discount_value') is-invalid @enderror"
                                            step="any" value="{{ old('discount_value', 0) }}"
                                            oninput="validateQuantity(this)">
                                        @error('discount_value')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable" for="quantity_limited">{{ __('Quantity') }}</label>
                                        <input type="number" name="quantity_limited" id="quantity_limited"
                                            class="form-control @error('quantity_limited') is-invalid @enderror"
                                            value="">
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
                                            value="{{ old('start_date') }}">
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
                                            value="{{ old('end_date') }}">
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
                                                {{-- <section class="Wrapper">
                                                    @foreach ($brands as $brand)
                                                        <div class="Checkbox-parent Accordion d-flex align-items-center"
                                                            style="margin-bottom: 3px; cursor: pointer;">
                                                            <i class="fas fa-caret-down mt-0"></i>
                                                            <span
                                                                style="margin-left: 2% !important; font-weight: 400; font-size: 15px;">
                                                                {{ $brand->name }}
                                                            </span>
                                                            <input id="apply_discount_to_{{ $brand->id }}"
                                                                name="apply_discount_to"
                                                                class="material-icons ml-auto @error('apply_discount_to') is-invalid @enderror"
                                                                type="checkbox" />
                                                        </div>
                                                        <div id="Accordion-panel" class="Accordion-panel">
                                                            <ul class="Checkbox-child pl-4">
                                                                @foreach ($brand->products as $product)
                                                                    <li
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <span
                                                                            style="font-weight: 400; font-size: 15px; margin-bottom: 3px;">
                                                                            {{ $product->name }}
                                                                        </span>
                                                                        <input value="{{ $product->id }}"
                                                                            name="product_ids[]" class="material-icons"
                                                                            type="checkbox" />
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </section> --}}
                                                <section class="Wrapper">
                                                    @foreach ($brands as $brand)
                                                        @if ($brand->products->isNotEmpty())
                                                            <!-- Only display brands with non-discounted products -->
                                                            <div class="Checkbox-parent Accordion d-flex align-items-center"
                                                                style="margin-bottom: 3px; cursor: pointer;">
                                                                <i class="fas fa-caret-down mt-0"></i>
                                                                <span
                                                                    style="margin-left: 2% !important; font-weight: 400; font-size: 15px;">
                                                                    {{ $brand->name }}
                                                                </span>
                                                                <input id="apply_discount_to_{{ $brand->id }}"
                                                                    name="apply_discount_to"
                                                                    class="material-icons ml-auto @error('apply_discount_to') is-invalid @enderror"
                                                                    type="checkbox" />
                                                            </div>
                                                            <div id="Accordion-panel-{{ $brand->id }}"
                                                                class="Accordion-panel">
                                                                <ul class="Checkbox-child pl-4">
                                                                    @foreach ($brand->products as $product)
                                                                        <li
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            <span
                                                                                style="font-weight: 400; font-size: 15px; margin-bottom: 3px;">
                                                                                {{ $product->name }}
                                                                            </span>
                                                                            <input value="{{ $product->id }}"
                                                                                name="product_ids[]"
                                                                                class="material-icons" type="checkbox" />
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
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
                                                    <input type="hidden" name="images" class="images_hidden">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="image" accept="image/png, image/jpeg">
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile">{{ __('Choose file') }}</label>
                                                </div>
                                            </div>
                                            <div class="preview preview-multiple text-center border rounded mt-2"
                                                style="height: 150px">
                                                <img src="{{ asset('uploads/defualt.png') }}" alt=""
                                                    height="100%">
                                            </div>
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
        $('.custom-file-input').change(function(e) {
            compressor.compress([...e.target.files], {
                size: 4,
                quality: 0.75,
            }).then((output) => {
                var files = Compress.convertBase64ToFile(output[0].data, output[0].ext);
                var formData = new FormData();

                var images_hidden = $(this).closest('.custom-file').find('input[type=hidden]');
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
