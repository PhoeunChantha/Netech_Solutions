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
                                        <label class="required_lable"
                                            for="default_purchase_price">{{ __('Default Purchase Price') }}</label>
                                        <input type="number" name="default_purchase_price" id="default_purchase_price"
                                            class="form-control @error('default_purchase_price') is-invalid @enderror"
                                            step="any"
                                            value="{{ old('default_purchase_price', $product->default_purchase_price ?? 0) }}"
                                            oninput="validateQuantity(this)">
                                        @error('default_purchase_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <label class="" for="quantity">{{ __('Quantity') }}</label>
                                        <input readonly type="number" name="quantity" id="quantity"
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
                                            <label class="required_lable" for="exampleInputFile">{{ __('Thumbnail') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="custom-file-input" name="thumbnail[]"
                                                        accept="image/png, image/jpeg" multiple>
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
                                                @if (is_array($product->thumbnail) && count($product->thumbnail))
                                                    @foreach ($product->thumbnail as $index => $thumbnail)
                                                        <div class="image-wrapper position-relative">
                                                            <img src="{{ asset('uploads/products/' . $thumbnail) }}"
                                                                alt="Existing Image" style="height:100%; width:auto;">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-image"
                                                                style="position:absolute; top:5px; right:5px;"
                                                                data-index="{{ $index }}">×</button>

                                                            <input type="hidden" name="old_thumbnail[]"
                                                                value="{{ $thumbnail }}">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <img src="{{ asset('uploads/default.png') }}" height="100%"
                                                        alt="">
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
  
    {{-- <script>
        /**
         * Compress and convert any image file to PNG under the given maxSize (bytes).
         * @param {File} file - Original image file
         * @param {number} maxSize - Maximum allowed size in bytes (default 2MB)
         * @returns {Promise<Blob>} - Promise that resolves with compressed PNG blob
         */
        function compressAndConvertToPNG(file, maxSize = 2 * 1024 * 1024) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onerror = () => reject(new Error('File reading failed'));
                reader.onload = () => {
                    const img = new Image();
                    img.src = reader.result;
                    img.onerror = () => reject(new Error('Image load failed'));
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        let width = img.width;
                        let height = img.height;

                        if (file.size > maxSize) {
                            const ratio = Math.sqrt(maxSize / file.size);
                            width *= ratio;
                            height *= ratio;
                        }

                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);

                        canvas.toBlob(blob => {
                            if (!blob) return reject(new Error('Compression failed'));
                            if (blob.size > maxSize) {
                                const downRatio = Math.sqrt((maxSize / blob.size));
                                canvas.width = width * downRatio;
                                canvas.height = height * downRatio;
                                ctx.clearRect(0, 0, canvas.width, canvas.height);
                                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                                canvas.toBlob(smallerBlob => smallerBlob ? resolve(smallerBlob) :
                                    reject(new Error('Second compression failed')),
                                    'image/png');
                            } else {
                                resolve(blob);
                            }
                        }, 'image/png');
                    };
                };
                reader.readAsDataURL(file);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('custom-file-input');
            const previewContainer = document.querySelector('.preview');

            fileInput.addEventListener('change', async (e) => {
                const files = Array.from(e.target.files);
                const compressedFiles = [];

                for (const file of files) {
                    if (!file.type.startsWith('image/')) continue;
                    try {
                        const pngBlob = await compressAndConvertToPNG(file);
                        const pngFile = new File([
                            pngBlob
                        ], file.name.replace(/\.[^.]+$/, '') + '.png', {
                            type: 'image/png'
                        });
                        compressedFiles.push(pngFile);

                        const url = URL.createObjectURL(pngBlob);
                        const wrapper = document.createElement('div');
                        wrapper.className = 'image-wrapper position-relative';
                        const imgEl = document.createElement('img');
                        imgEl.src = url;
                        imgEl.style.height = '100%';
                        imgEl.style.width = 'auto';

                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'btn btn-danger btn-sm remove-new-image';
                        removeBtn.style.position = 'absolute';
                        removeBtn.style.top = '5px';
                        removeBtn.style.right = '5px';
                        removeBtn.textContent = '×';
                        removeBtn.addEventListener('click', () => wrapper.remove());

                        wrapper.append(imgEl, removeBtn);
                        previewContainer.appendChild(wrapper);
                    } catch (err) {
                        console.error('Image compression error:', err);
                    }
                }

                const dataTransfer = new DataTransfer();
                compressedFiles.forEach(f => dataTransfer.items.add(f));
                fileInput.files = dataTransfer.files;

                const label = fileInput.nextElementSibling;
                const existingText = label.textContent.trim();
                const newNames = Array.from(fileInput.files).map(f => f.name).join(', ');
                label.textContent = existingText && existingText !== '{{ __('Choose file') }}' ?
                    `${existingText}, ${newNames}` :
                    newNames;
            });
        });
    </script> --}}
    <script>
        /**
         * Remove background using color distance to white, but only affect areas near the edges.
         * Prevents removing interior white content by limiting the margin.
         * @param {HTMLCanvasElement} canvas
         * @param {number} threshold - distance threshold (0–441)
         * @param {number} edgeMargin - pixel margin from edges to consider as background
         */
        function removeBackground(canvas, threshold = 60, edgeMargin = 15) {
            const ctx = canvas.getContext('2d');
            const {
                width: w,
                height: h
            } = canvas;
            const imgData = ctx.getImageData(0, 0, w, h);
            const data = imgData.data;
            const visited = new Uint8Array(w * h);
            const stack = [];

            const idx = (x, y) => y * w + x;
            const isWhiteLike = (x, y) => {
                const i = idx(x, y) * 4;
                const r = data[i];
                const g = data[i + 1];
                const b = data[i + 2];
                const distanceToWhite = Math.sqrt(
                    Math.pow(255 - r, 2) +
                    Math.pow(255 - g, 2) +
                    Math.pow(255 - b, 2)
                );
                return distanceToWhite < threshold;
            };

            for (let y = 0; y < h; y++) {
                for (let x = 0; x < w; x++) {
                    const nearEdge = x < edgeMargin || x >= w - edgeMargin || y < edgeMargin || y >= h - edgeMargin;
                    if (nearEdge && isWhiteLike(x, y)) {
                        visited[idx(x, y)] = 1;
                        stack.push([x, y]);
                    }
                }
            }

            while (stack.length) {
                const [x, y] = stack.pop();
                [
                    [1, 0],
                    [-1, 0],
                    [0, 1],
                    [0, -1]
                ].forEach(([dx, dy]) => {
                    const nx = x + dx;
                    const ny = y + dy;
                    if (nx >= 0 && nx < w && ny >= 0 && ny < h) {
                        const i = idx(nx, ny);
                        if (!visited[i] && isWhiteLike(nx, ny)) {
                            visited[i] = 1;
                            stack.push([nx, ny]);
                        }
                    }
                });
            }

            for (let y = 0; y < h; y++) {
                for (let x = 0; x < w; x++) {
                    const i = idx(x, y);
                    if (visited[i]) {
                        data[i * 4 + 3] = 0;
                    }
                }
            }

            ctx.putImageData(imgData, 0, 0);
        }

        function processImage(file, maxSize = 2 * 1024 * 1024) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onerror = () => reject(new Error('File reading failed'));
                reader.onload = () => {
                    const img = new Image();
                    img.src = reader.result;
                    img.onerror = () => reject(new Error('Image load failed'));
                    img.onload = () => {
                        let width = img.width;
                        let height = img.height;
                        if (file.size > maxSize) {
                            const ratio = Math.sqrt(maxSize / file.size);
                            width *= ratio;
                            height *= ratio;
                        }

                        const canvas = document.createElement('canvas');
                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);

                        removeBackground(canvas, 60, 15);

                        canvas.toBlob(blob => {
                            if (!blob) return reject(new Error('Compression failed'));
                            if (blob.size > maxSize) {
                                const downRatio = Math.sqrt(maxSize / blob.size);
                                const tmpW = canvas.width * downRatio;
                                const tmpH = canvas.height * downRatio;
                                const tmp = document.createElement('canvas');
                                tmp.width = tmpW;
                                tmp.height = tmpH;
                                const tmpCtx = tmp.getContext('2d');
                                tmpCtx.drawImage(canvas, 0, 0, tmpW, tmpH);
                                removeBackground(tmp, 60, 15);
                                tmp.toBlob(smallerBlob => {
                                    smallerBlob ? resolve(smallerBlob) : reject(new Error(
                                        'Second compression failed'));
                                }, 'image/png');
                            } else {
                                resolve(blob);
                            }
                        }, 'image/png');
                    };
                };
                reader.readAsDataURL(file);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('custom-file-input');
            const previewContainer = document.querySelector('.preview');
            const form = fileInput.closest('form');

            previewContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-image')) {
                    const wrapper = e.target.closest('.image-wrapper');
                    const oldInput = wrapper.querySelector('input[name="old_thumbnail[]"]');
                    if (oldInput) {
                        const removed = document.createElement('input');
                        removed.type = 'hidden';
                        removed.name = 'removed_thumbnails[]';
                        removed.value = oldInput.value;
                        form.appendChild(removed);
                    }
                    wrapper.remove();
                }
            });

            fileInput.addEventListener('change', async (e) => {
                const files = Array.from(e.target.files);
                const processedFiles = [];

                for (const file of files) {
                    if (!file.type.startsWith('image/')) continue;
                    try {
                        const blob = await processImage(file);
                        const pngFile = new File([blob], file.name.replace(/\.[^.]+$/, '') + '.png', {
                            type: 'image/png'
                        });
                        processedFiles.push(pngFile);

                        const url = URL.createObjectURL(blob);
                        const wrapper = document.createElement('div');
                        wrapper.className = 'image-wrapper position-relative';
                        const imgEl = document.createElement('img');
                        imgEl.src = url;
                        imgEl.style.height = '100%';
                        imgEl.style.width = 'auto';

                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'btn btn-danger btn-sm remove-new-image';
                        removeBtn.style.position = 'absolute';
                        removeBtn.style.top = '5px';
                        removeBtn.style.right = '5px';
                        removeBtn.textContent = '×';
                        removeBtn.addEventListener('click', () => wrapper.remove());

                        wrapper.append(imgEl, removeBtn);
                        previewContainer.appendChild(wrapper);
                    } catch (err) {
                        console.error('Image processing error:', err);
                    }
                }

                const dt = new DataTransfer();
                processedFiles.forEach(f => dt.items.add(f));
                fileInput.files = dt.files;

                const label = fileInput.nextElementSibling;
                const existingText = label.textContent.trim();
                const newNames = Array.from(fileInput.files).map(f => f.name).join(', ');
                const fallbackText = "Choose file";
                label.textContent = existingText && existingText !== fallbackText ?
                    `${existingText}, ${newNames}` :
                    newNames;
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
