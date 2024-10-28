@extends('website.app')
@push('css')
    <style>
        .preview {
            width: 150px !important;
            border: none !important;
            border-radius: 50% !important;
            outline: 2px solid blue;
            outline-offset: 3px;
        }

        .update_image {
            cursor: pointer;
            position: relative;
        }

        .btn-save {
            /* background: linear-gradient(90deg,
                            rgba(243, 49, 247, 1) 8%,
                            rgba(87, 158, 255, 1) 70%) !important; */
            background-color: #1077B8;
            color: #ffffffff !important;
        }

        .update_image::after {
            content: '';
            font-family: 'Font Awesome 5 Pro';
            font-weight: 900;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1;

            position: absolute;
            height: 100%;
            width: 100%;
            left: 0;
            border-radius: 50%;
            transition: all .18s ease-out;
        }

        .update_image:hover::after {
            content: '\f044';
            font-family: 'Font Awesome 5 Pro';
            font-weight: 900;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 150px;
            /* color: #f0f0f0; */
            font-size: 1.5rem;

            background-color: rgba(0, 0, 0, 0.263);
        }

        .update_image img {
            height: 100%;
            width: 100%;
            border-radius: 50%;
        }

        #imagePreview {
            object-fit: cover;
        }
    </style>
@endpush

@section('contents')
    <div class="col-12 d-flex justify-content-center mt-2">
        <div class="card" style="width: 80%">
            <div class="card-body px-5">
                <form id="" action="{{ route('account.profile.update', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-12 text-center my-4 d-flex justify-content-center">
                            <div class="input-group d-none">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image"
                                        accept="image/png, image/jpeg">
                                    <label class="custom-file-label"
                                        for="exampleInputFile">{{ $user->image ?? __('Choose file') }}</label>
                                </div>
                            </div>
                            <div class="preview preview-multiple text-center border rounded mt-2 w-100"
                                style="height: 150px">
                                <div class="update_image h-100" onclick="triggerFileInput()">
                                    <img id="imagePreview"
                                        src="@if ($user->image && file_exists(public_path('uploads/users/' . $user->image))) {{ asset('uploads/users/' . $user->image) }}
                                              @else
                                                  {{ asset('uploads/default-profile.png') }} @endif"
                                        alt="Preview Image">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="first_name">{{ __('First name') }}</label>
                                <input type="text" name="first_name" id="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name', $user->first_name) }}">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="last_name">{{ __('Last name') }}</label>
                                <input type="text" name="last_name" id="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name', $user->last_name) }}">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input type="text" name="name" id="username"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" name="phone" id="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="password">{{ __('New Password') }}</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input type="password" name="password_confirmation" id="password-confirm"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-12 mt-1">
                            <button type="submit" class="btn btn-save"><i class="fas fa-save"></i>
                                {{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function triggerFileInput() {
            $('.custom-file-input').trigger('click');
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        $('.custom-file-input').change(function(e) {
            e.preventDefault();
            previewImage(e);
        });
    </script>

@endpush
