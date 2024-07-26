<style>
    .btn-save-register {
        /* background: linear-gradient(90deg,
                rgba(243, 49, 247, 1) 8%,
                rgba(87, 158, 255, 1) 70%); */
        background-color: #1077B8;
        color: #f4f4f4 !important;
        border-radius: 10px;
    }
    .btn-save-register:hover{
         background-color: #1077B8;
        color: #f4f4f4 ;
    }

    div:where(.swal2-container) .swal2-html-container {
        padding: .3em 1.6em .3em !important;
    }

    .swal2-title {
        margin-bottom: 0 !important;
    }

</style>
<!-- website/layout/modal_register.blade.php -->
<div class="modal modal-register m-0 fade modal-login" id="modalRegister" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl px-2 px-md-4 modal-dialog-centered col-6">
        <div class="modal-content border-0">

            <div class="modal-header bg-style-1">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel">{{ __('Register') }}</h5>
                {{-- <button type="button" class="close cus-login-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="cus-login-close">&times;</span>
                </button> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body bg-style-1">
                <form action="{{ route('account.profile.store') }}" class="register_from" id="register_from"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-4 mb-3 text-center d-flex justify-content-center align-items-center">
                            <div class="input-group d-none">
                                <div class="custom-file">
                                    <input type="file" class="register-profile-input" id="exampleInputFileFront"
                                        name="image" accept="image/png, image/jpeg" onchange="previewImageFront(event)">
                                    <label class="custom-file-label"
                                        for="exampleInputFileFront">{{ $user->image ?? __('Choose file') }}</label>
                                </div>
                            </div>
                            <div class="preview preview-front preview-multiple text-center border rounded mt-2 w-100">
                                <div class="update_image h-100 update_image_front" onclick="triggerFileInputFront()">
                                    <img id="imagePreviewFront" src="{{ asset('uploads/default-profile.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                    <div class="form-group">
                                        <label for="first_name">{{ __('First name') }}</label>
                                        <input type="text" name="first_name" id="first_name" required
                                            class="form-control @error('first_name') is-invalid @enderror">
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                    <div class="form-group">
                                        <label for="last_name">{{ __('Last name') }}</label>
                                        <input type="text" name="last_name" id="last_name" required
                                            class="form-control @error('last_name') is-invalid @enderror">
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                    <div class="form-group">
                                        <label for="username">{{ __('Username') }}</label>
                                        <input type="text" name="name" id="username" required
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="email" required
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                    <div class="form-group">
                                        <label for="phone">{{ __('Phone') }}</label>
                                        <input type="text" name="phone" id="phone" required
                                            class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                    <div class="form-group">
                                        <label for="password">{{ __('New Password') }}</label>
                                        <input type="password" name="password" id="password" required
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input type="password" name="password_confirmation" id="password-confirm"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" id="submit" class="btn btn-save-register float-right"
                                style="width: 30%"> <i class="fas fa-save"></i> {{ __('Save') }}</button>
                        </div>
                        <p class="text-center pt-3 text-dark">{{ __('Already have an account?') }}
                            <a href="#" id="showLoginModal" style="text-decoration: none;" data-dismiss="modal"
                                aria-label="Close">{{ __('Sign in') }}</a>
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@if (session('register') === true)
<script>
    Swal.fire({
        title: "{{ __('Register successfully.') }}",
        text: "{{ __('Please wait for admin approval.') }}",
        imageUrl: "{{ asset('uploads/gifs/clock.gif') }}",
        imageWidth: 200,
        imageHeight: 150,
        imageAlt: "Custom image",
        confirmButtonText: "{{ __('OK') }}"
    });

</script>
@endif
