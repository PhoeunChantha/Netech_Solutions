@extends('backends.master')
@push('css')
    <style>
        .preview {
            margin-block: 12px;
            text-align: center;
        }

        .tab-pane {
            margin-top: 20px
        }
    </style>
@endpush
@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Business Setting') }}</h3>
                </div>
                <div class="col-sm-6" style="text-align: right">
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    @include('backends.setting.partials.tab')
                </div>
                <div class="">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Company Information') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="company_name">{{ __('Company Name') }}</label>
                                                            <input type="text" name="company_name" id="company_name"
                                                                class="form-control"
                                                                value="{{ old('company_name', $company_name) }} ">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="copy_right_text">{{ __('Copyright Text') }}</label>
                                                            <input type="text" name="copy_right_text"
                                                                id="copy_right_text" class="form-control"
                                                                value="{{ old('copy_right_text', $copy_right_text) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="">{{ __('Email') }}</label>
                                                            <input type="text" name="email" id="email"
                                                                class="form-control" value="{{ old('email', $email) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">{{ __('Phone') }}</label>
                                                            <input type="text" name="phone" id="phone"
                                                                class="form-control" value="{{ old('phone', $phone) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-6" hidden>
                                                        <div class="form-group">
                                                            <label for="telegram">{{ __('Telegram') }}</label>
                                                            <input type="text" name="telegram" id="telegram"
                                                                class="form-control"
                                                                value="{{ old('telegram', $telegram) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-6" hidden>
                                                        <div class="form-group">
                                                            <label for="about_club">{{ __('About Club') }}</label>
                                                            <input type="text" name="about_club" id="about_club"
                                                                class="form-control" value="{{ $about_club }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="company_address">{{ __('Company Address') }}</label>
                                                            <textarea name="company_address" id="company_address" class="form-control">{{ old('company_address', $company_address) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Social Media') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Title') }}</th>
                                                                <th>
                                                                    {{ __('Icon') }}
                                                                    <br>
                                                                    <span
                                                                        class="text-info text-xs">{{ __('Recommend svg icon') }}</span>
                                                                </th>
                                                                <th>{{ __('Link') }}</th>
                                                                <th>{{ __('Status') }}</th>
                                                                <th>
                                                                    <button type="button"
                                                                        class="btn btn-success btn-sm btn_add_social_media">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                    </button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        @include('backends.setting.partials._social_media_tbody')
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card" hidden>
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Contact') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Title') }}</th>
                                                                <th>
                                                                    {{ __('Icon') }}
                                                                    <br>
                                                                    <span
                                                                        class="text-info text-xs">{{ __('Recommend svg icon') }}</span>
                                                                </th>
                                                                <th>{{ __('Link') }}</th>
                                                                <th>{{ __('Status') }}</th>
                                                                <th>
                                                                    <button type="button"
                                                                        class="btn btn-success btn-sm btn_add_contact">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                    </button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        @include('backends.setting.partials._contact_tbody')
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('About Company') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="about_company">{{ __('Description') }}</label>
                                                            <textarea name="about_company" id="about_company" class="form-control summernote-our-comapany">{{ $about_company }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="web_header_logo">{{ __('Thumbnail') }}</label>
                                                            <div class="preview">
                                                                <img style="height: 224px"
                                                                    src="
                                                            @if ($about_company_image && file_exists('uploads/business_settings/' . $about_company_image)) {{ asset('uploads/business_settings/' . $about_company_image) }}
                                                            @else
                                                                {{ asset('uploads/defualt.png') }} @endif
                                                            "
                                                                    alt="" height="120px">
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="customFile" name="about_company_image">
                                                                <label class="custom-file-label"
                                                                    for="customFile">{{ __('Choose file') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Mission and Vision') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row"></div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <textarea name="mission_and_vision" id="mission" class="form-control summernote">{{ old('mission_and_vision', $mission_and_vision) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Website and system setup') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                {{-- <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="timezone">{{ __('Timezone') }}</label>
                                                            <select name="timezone" id="timezone"
                                                                class="form-control select2">
                                                                <option value="">{{ __('Please Select') }}</option>
                                                                @foreach (config('list.all_timezone') as $value => $name)
                                                                    <option value="{{ $value }}"
                                                                        {{ $timezone == $value ? 'selected' : '' }}>
                                                                        {{ $name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="currency">{{ __('Currency') }}</label>
                                                            <select name="currency" id="currency"
                                                                class="form-control select2">
                                                                <option value="">{{ __('Please Select') }}</option>
                                                                @foreach (config('list.currency_list') as $item)
                                                                    <option value="{{ $item['code'] }}"
                                                                        {{ $item['code'] == $currency ? 'selected' : '' }}>
                                                                        {{ $item['symbol'] . ' - ' . $item['name'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="web_header_logo">{{ __('Website logo') }}</label>
                                                            <div class="preview">
                                                                <img src="
                                                            @if ($web_header_logo && file_exists('uploads/business_settings/' . $web_header_logo)) {{ asset('uploads/business_settings/' . $web_header_logo) }}
                                                            @else
                                                                {{ asset('uploads/default.png') }} @endif
                                                            "
                                                                    alt="" height="120px">
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="customFile" name="web_header_logo">
                                                                <label class="custom-file-label"
                                                                    for="customFile">{{ __('Choose file') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="web_banner_logo">{{ __('Website banner logo') }}</label>
                                                            <div class="preview">
                                                                <img src="
                                                            @if ($web_banner_logo && file_exists('uploads/business_settings/' . $web_banner_logo)) {{ asset('uploads/business_settings/' . $web_banner_logo) }}
                                                            @else
                                                                {{ asset('uploads/image/default.png') }} @endif
                                                            "
                                                                    alt="" height="120px">
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="customFile" name="web_banner_logo">
                                                                <label class="custom-file-label"
                                                                    for="customFile">{{ __('Choose file') }}</label>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="fav_icon">{{ __('Fav icon') }}</label>
                                                            <div class="preview">
                                                                <img src="
                                                            @if ($fav_icon && file_exists('uploads/business_settings/' . $fav_icon)) {{ asset('uploads/business_settings/' . $fav_icon) }}
                                                            @else
                                                                {{ asset('uploads/image/default.png') }} @endif
                                                            "
                                                                    alt="" height="120px">
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="customFile" name="fav_icon">
                                                                <label class="custom-file-label"
                                                                    for="customFile">{{ __('Choose file') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <button type="submit" class="btn btn-primary float-right">
                                                    <i class="fas fa-save"></i>
                                                    {{ __('Save') }}
                                                </button>
                                               

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.summernote-our-comapany').summernote({
                height: 200,
            });
        });
        $('.btn_add').click(function(e) {
            var tbody = $('.tbody');
            var numRows = tbody.find("tr").length;
            $.ajax({
                type: "get",
                url: window.location.href,
                data: {
                    "key": numRows
                },
                dataType: "json",
                success: function(response) {
                    $(tbody).append(response.tr);
                }
            });
        });

        $('.custom-file-input').change(function(e) {
            var reader = new FileReader();
            var preview = $(this).closest('.form-group').find('.preview img');
            console.log(preview);
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('.btn_add_contact').click(function(e) {
            var tbody = $('.contact_tbody');
            var numRows = tbody.find("tr").length;
            $.ajax({
                type: "get",
                url: window.location.href,
                data: {
                    "type": "key_contact",
                    "key": numRows
                },
                dataType: "json",
                success: function(response) {
                    $(tbody).append(response.tr);
                }
            });
        });
        $('.btn_add_social_media').click(function(e) {
            var tbody = $('.tbody');
            var numRows = tbody.find("tr").length;
            $.ajax({
                type: "get",
                url: window.location.href,
                data: {
                    "type": "key_social",
                    "key": numRows
                },
                dataType: "json",
                success: function(response) {
                    $(tbody).append(response.tr);
                }
            });
        });

        // $('#custom-tabs-for-webcontent-tab').click(function (e) {
        //     e.preventDefault();
        //     $.ajax({
        //         type: "get",
        //         url: $(this).data('href'),
        //         // data: "data",
        //         dataType: "json",
        //         success: function (response) {
        //             // console.log(response);

        //         }
        //     });
        // });
    </script>
@endpush
