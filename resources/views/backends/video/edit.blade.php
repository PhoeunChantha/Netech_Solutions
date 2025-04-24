@extends('backends.master')
@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Add New Banner') }}</h1>
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
                    <form method="POST" action="{{ route('admin.video.update', $video->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                            @foreach (json_decode($language, true) as $lang)
                                                @if ($lang['status'] == 1)
                                                    <?php
                                                    if (count($video['translations'])) {
                                                        $translate = [];
                                                        foreach ($video['translations'] as $t) {
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
                                                                <label class="required_label"
                                                                    for="name_{{ $lang['code'] }}">{{ __('Name') }}({{ strtoupper($lang['code']) }})</label>
                                                                <input type="name" id="name_{{ $lang['code'] }}"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name[]" placeholder="{{ __('Enter Name') }}"
                                                                    value="{{ $translate[$lang['code']]['name'] ?? $video['name'] }}">
                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="required_label"
                                                                    for="description_{{ $lang['code'] }}">{{ __('Description') }}({{ strtoupper($lang['code']) }})</label>
                                                                <textarea type="text" id="description_{{ $lang['code'] }}"
                                                                    class="form-control @error('description') is-invalid @enderror" name="description[]"
                                                                    placeholder="{{ __('Enter Description') }}" value="">{{ $translate[$lang['code']]['description'] ?? $video['description'] }}</textarea>

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
                                        <label for="video_type">{{ __('Video Type') }}</label>
                                        <select class="form-control select2 @error('video_type') is-invalid @enderror"
                                            name="video_type" id="video_type">
                                            <option value="">{{ __('Select Type') }}</option>
                                            <option value="video_url"
                                                {{ $video->video_type == 'video_url' ? 'selected' : '' }}>
                                                {{ __('URL') }}
                                            </option>
                                            <option value="video_id"
                                                {{ $video->video_type == 'video_id' ? 'selected' : '' }}>
                                                {{ __('ID') }}
                                            </option>
                                        </select>

                                        @error('video_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6" id="video_url">
                                        <label class="required_label" for="video_url">{{ __('Video URL') }}</label>
                                        <input type="text" class="form-control" name="video_url"
                                            value="{{ $video->video_url }}">
                                    </div>
                                    <div class="form-group col-md-6" id="video_id">
                                        <label class="required_label" for="video_id">{{ __('Video ID') }}</label>
                                        <input type="text" class="form-control" name="video_id"
                                            value="{{ $video->video_id }}">
                                    </div>
                                    <div class="form-group col-md-6" hidden id="video_file">
                                        <div class="form-group">
                                            <label class="required_label" for="exampleInputFile">{{ __('Video') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="videos">
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile">{{ $video->video ?? __('Choose file') }}</label>
                                                </div>
                                            </div>
                                            <div class="preview preview-multiple text-center border rounded mt-2"
                                                style="height: 150px">
                                                <img src="{{ asset('uploads/image/default.png') }}" alt=""
                                                    height="100%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" >
                                        <div class="form-group">
                                            <label class="required_label" for="exampleInputFile">{{ __('Thumbnail') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="thumbnail">
                                                    <label class="custom-file-label"
                                                        for="exampleInputFile">{{ $video->thumbnail ?? __('Choose file') }}</label>
                                                </div>
                                            </div>
                                            <div class="preview text-center border rounded mt-2" style="height: 150px">
                                                <img src="
                                                    @if ($video->thumbnail && file_exists(public_path('uploads/videos/' . $video->thumbnail))) {{ asset('uploads/videos/' . $video->thumbnail) }}
                                                    @else
                                                        {{ asset('uploads/image/default.png') }} @endif
                                                    "
                                                    alt="" height="100%">
                                            </div>
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
            function handleVideoTypeChange() {
                const selectedType = $('#video_type').val();
                $('.form-group[id^="video_"]').hide();
                if (selectedType === 'video_url') {
                    $('#video_url').show();
                } else if (selectedType === 'video_id') {
                    $('#video_id').show();
                } else if (selectedType === 'file') {
                    $('#video_file').show();
                }
            }
            handleVideoTypeChange();
            $('#video_type').change(function() {
                handleVideoTypeChange();
            });
        });
    </script>
    <script>
        $('.custom-file-input').change(function(e) {
            var reader = new FileReader();
            var preview = $(this).closest('.form-group').find('.preview img');
            var label = $(this).closest('.form-group').find('.custom-file-label');
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
            // Update file name label
            var fileName = e.target.files[0].name;
            label.text(fileName);
        });

        $(document).on('click', '.nav-tabs .nav-link', function(e) {
            if ($(this).data('lang') != 'en') {
                $('.no_translate_wrapper').addClass('d-none');
            } else {
                $('.no_translate_wrapper').removeClass('d-none');
            }
        });
    </script>
@endpush
