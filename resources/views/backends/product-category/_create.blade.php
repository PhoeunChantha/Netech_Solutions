@push('css')
@endpush
<div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('New Category') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('admin.product-category.store') }}" enctype="multipart/form-data" class="submit-form"
            method="post">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            {{-- @dump($languages) --}}
                            @foreach (json_decode($language, true) as $lang)
                                @if ($lang['status'] == 1)
                                    <li class="nav-item">
                                        <a class="nav-link text-capitalize {{ $lang['code'] == $default_lang ? 'active' : '' }}"
                                            id="lang_{{ $lang['code'] }}-tab" data-toggle="pill"
                                            href="#lang_{{ $lang['code'] }}" role="tab"
                                            aria-controls="lang_{{ $lang['code'] }}"
                                            aria-selected="false">{{ \App\helpers\AppHelper::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')' }}</a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            @foreach (json_decode($language, true) as $lang)
                                @if ($lang['status'] == 1)
                                    <div class="tab-pane fade {{ $lang['code'] == $default_lang ? 'show active' : '' }}"
                                        id="lang_{{ $lang['code'] }}" role="tabpanel"
                                        aria-labelledby="lang_{{ $lang['code'] }}-tab">
                                        <div class="form-group">
                                            <input type="hidden" name="lang[]" value="{{ $lang['code'] }}">
                                            <label
                                                for="name_{{ $lang['code'] }}">{{ __('Name') }}({{ strtoupper($lang['code']) }})</label>
                                            <input type="text" name="name[]" id="name_{{ $lang['code'] }}"
                                                class="form-control" {{ $lang['code'] == 'en' ? 'required' : '' }}>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group">
                        <label for="exampleInputFile">{{ __('Image') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="icon_images" class="image_hidden">
                                <input type="file" class="custom-file-input image-file-input" id="exampleInputFile"
                                    name="icon_image">
                                <label class="custom-file-label"
                                    for="exampleInputFile">{{ __('Choose Image') }}</label>
                            </div>
                        </div>
                        <div class="preview preview-multiple text-center border rounded mt-2" style="height: 150px">
                            <img src="{{ asset('uploads\defualt.png') }}" alt="" height="100%">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit" class="btn btn-primary submit">{{ __('Save') }}</button>
            </div>
        </form>
    </div>
</div>

<script>
    const compressor = new window.Compress();
    $('.image-file-input').change(function(e) {
        // Update the custom file label with the selected file name
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose Image';
        $(this).siblings('.custom-file-label').text(fileName);

        compressor.compress([...e.target.files], {
            size: 4,
            quality: 0.75,
        }).then((output) => {
            var files = Compress.convertBase64ToFile(output[0].data, output[0].ext);
            var formData = new FormData();

            var image_names_hidden = $(this).closest('.custom-file').find('input[type=hidden]');
            var container = $(this).closest('.form-group').find('.preview');
            const defaultImageUrl = "{{ asset('uploads/image/default.png') }}";
            if (container.find('img').attr('src') === defaultImageUrl) {
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
{{-- @push('js')
@endpush --}}
