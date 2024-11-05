{{-- <link rel="stylesheet" href="{{ asset('backend/login-form/css/style.css') }}"> --}}
{{-- <style>
    .modal-header .close {
        padding: 1rem 1rem !important;
        margin: -1rem -1rem -1rem auto !important;
        background: none !important;
        border: none !important;
        font-size: 25px !important;
    }

    .modal-body {
        padding: 2rem !important;
    }

    .btn-modal-login {
        background: linear-gradient(90deg,
                rgba(243, 49, 247, 1) 8%,
                rgba(87, 158, 255, 1) 70%) !important;
        background-color: #1077B8;
        color: #ffffffff !important;
    }

    .btn-modal-login:hover {
        color: #ffffffff;
        background-color: #1077B8;
    }

    .modal {
        margin-top: 5rem;
    }

    .preview {
        width: 150px !important;
        height: 150px !important;
        border: none !important;
        border-radius: 50% !important;
        outline: 2px solid blue;
        outline-offset: 3px;
    }

    #imagePreviewFront {
        object-fit: cover !important;
    }

    .update_image_front {
        cursor: pointer;
        position: relative;
    }

    .update_image_front::after {
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

    .update_image_front:hover::after {
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
        color: #f0f0f0;
        font-size: 1.5rem;

        background-color: rgba(0, 0, 0, 0.263);
    }

    .update_image_front img {
        height: 100%;
        width: 100%;
        border-radius: 50%;
    }
</style> --}}
<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">

            <div class="modal-header bg-style-1 justify-content-center">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel">{{ __('Login') }}</h5>
                <button type="button" class="close cus-login-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="cus-login-close">&times;</span>
                </button>
            </div>

            <div class="modal-body bg-style-1">
                <form action="{{ route('customer.login') }}" method="POST" class="form-login">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="label" for="email">{{ __('Email') }}</label>
                        <input id="emails" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="Email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="password">{{ __('Password') }}</label>
                        <input id="passwords" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <span style="color: gray;"> {{ __('Please enter your email & passwod for login') }}</span>
                    <div class="form-group d-md-flex mb-4">
                        <div class="w-50 text-left">
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            <label class="checkbox-wrap checkbox-primary mb-0"
                                style="color: #4d7eb2">{{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block w-100 btn-modal-login">{{ __('Log In') }}</button>
                    </div>
                    <p class="text-center pt-3 text-dark">{{ __("Don't have an account?") }}
                        <a href="#" id="showRegisterModal" style="text-decoration: none;" data-dismiss="modal"
                            aria-label="Close">{{ __('Sign up') }}</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div> --}}
{{-- <div class="modal fade modal-login" id="staticBackdrop" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog login-dialog px-2 px-md-4">
        <div class="modal-content border-0">

            <div class="modal-header bg-style-1 justify-content-center">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel">{{ __('Login') }}</h5>
                <button type="button" class="close cus-login-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="cus-login-close">&times;</span>
                </button>
            </div>

            <div class="modal-body bg-style-1">
                <form action="{{ route('web.login') }}" method="POST" class="form-login">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="label" for="name">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="Email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="password">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <span style="color: gray;"> {{ __('Please enter your email & passwod for login') }}</span>

                    <div class="form-group d-md-flex mb-4">
                        <div class="w-50 text-left">
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            <label class="checkbox-wrap checkbox-primary mb-0"
                                style="color: #4d7eb2">{{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit"
                            class="btn btn-block w-100 btn-modal-login">{{ __('Log In') }}</button>
                    </div>
                    <p class="text-center pt-3 text-dark">{{ __("Don't have an account?") }}
                        <a href="#" id="showRegisterModal" style="text-decoration: none;" data-dismiss="modal"
                            aria-label="Close">{{ __('Sign up') }}</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div> --}}
@include('website.layout.modal_register')
@push('js')
    <script>
        document.getElementById('showRegisterModal').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            $('#staticBackdrop').modal('hide'); // Hide the current modal
            $('#modalRegister').modal('show'); // Show the new modal
        });
        document.getElementById('showLoginModal').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            $('#modalRegister').modal('hide'); // Hide the current modal
            $('#staticBackdrop').modal('show'); // Show the new modal
        });
    </script>
    <script>
        function triggerFileInputFront() {
            document.getElementById('exampleInputFileFront').click();
        }

        function previewImageFront(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreviewFront');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- Script to close the modal -->
    <script>
        $(document).ready(function() {
            $('.cus-login-close-btn').click(function() {
                $('#modalRegister').modal('hide');
            });
        });

        $(document).ready(function() {
            $('.cus-login-close-btn').click(function() {
                $('#staticBackdrop').modal('hide');
            });
        });
    </script>
@endpush
