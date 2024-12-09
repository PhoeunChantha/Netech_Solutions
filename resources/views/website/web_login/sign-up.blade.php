@extends('website.app')
@push('css')
    @include('website.web_login.login-style')
@endpush
<style>
    .checkbox-container {
        display: flex;
        align-items: center;
        margin-top: 1rem;
    }

    input[type="checkbox"] {
        appearance: none;
        width: 18px;
        height: 18px;
        border: 2px solid #1077B8;
        border-radius: 50%;
        position: relative;
        cursor: pointer;
    }

    input[type="checkbox"]:checked::before {
        content: "✔";
        position: absolute;
        color: white;
        background-color: #1077B8;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        padding-top: 1px;
        font-size: 13px;
    }

    .checkbox-label {
        margin-left: 10px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #1077B8;
    }
</style>
@section('contents')
    <div class="container  d-flex justify-content-center align-items-center">
        <div class="login-card mb-5 mt-5">
            <h2 class="text-center">Sign Up</h2>
            <form action="{{ route('customer.register') }}" method="post">
                @csrf
                <div class="form-group mb-2">
                    <label for="signup_first_name">First Name</label>
                    <input id="signup_first_name" class="form-control @error('signup_first_name') is-invalid @enderror"
                        type="text" name="signup_first_name">
                    @error('signup_first_name')
                        <span class="invalid-feedback" role="alert">
                           {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="signup_last_name">Last Name</label>
                    <input id="signup_last_name" class="form-control @error('signup_last_name') is-invalid @enderror"
                        type="text" name="signup_last_name">
                    @error('signup_last_name')
                        <span class="invalid-feedback" role="alert">
                           {{ $message }}
                        </span>
                    @enderror
                </div>
                {{-- <div class="form-group mb-2">
                    <label for="signup_phone">Phone Number</label>
                    <div class="input-group">
                        <input id="signup_phone" class="form-control @error('signup_phone') is-invalid  @enderror"
                            type="tel" name="signup_phone" placeholder="Enter mobile number">
                        @error('signup_phone')
                            <span class="invalid-feedback" role="alert">
                              {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div> --}}
                <div class="form-group mb-2">
                    <label for="signup_email">Email</label>
                    <div class="input-group">
                        <input id="signup_email" class="form-control @error('signup_email') is-invalid  @enderror"
                            type="email" name="signup_email" placeholder="Enter Email">
                        @error('signup_email')
                            <span class="invalid-feedback" role="alert">
                              {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-2">
                    <label for="Password">{{ __('Password') }}</label>
                    <div class="password-wrapper">
                        <input type="password" id="signup_password" name="signup_password"
                            class="form-control @error('signup_password') is-invalid @enderror"
                            placeholder="Enter Your Password">
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('signup_password')
                        <span class="invalid-feedback" role="alert">
                          {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" id="terms-checkbox" name="terms" value="1">
                    <label class="checkbox-label" for="terms-checkbox">I Accept The Terms And Privacy Policy</label>
                </div>

                {{-- <div class="recaptcha-container">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                </div> --}}
                <button type="submit" class="btn btn-primary mt-3 w-100">Sign Up</button>
                <div class="social-login text-center">
                    <p>Or Continue With</p>
                    <a href="{{ route('auth.google') }}"><img src="{{ asset('website/login/google.png') }}"
                            alt="Google"></a>
                    <a href="#"><img src="{{ asset('website/login/iphone.png') }}" alt="Apple"></a>
                </div>

                <div class="footer">
                    <p>Enjoy New Experience <a href="{{ route('customer.web.login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("signin_password");
            var eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var input = document.querySelector("#signup_phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "kh",
                separateDialCode: true,
                hiddenInput: "full_mobile",
                dropdownContainer: document.body,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                nationalMode: false,
                autoPlaceholder: "aggressive"
            });

            // Optional: Handle form submission if needed
            $("form").on("submit", function() {
                var fullNumber = iti.getNumber();
                console.log(fullNumber);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.upload-icon').on('click', function() {
                $('#profile-image').click();
            });

            $('#profile-image').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result); // Display the selected image
                    };
                    reader.readAsDataURL(file); // Read the image file
                }
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {


            // Form submission with AJAX
            $('#profileForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('account.profile.update', auth()->user()->id) }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.msg);
                            success.play();
                            setTimeout(function() {
                                location.reload();
                            }, 2000); // Reload after 2 seconds to show the toastr message
                        } else {
                            toastr.error(response.msg);
                            error.play();
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                            error.play();
                        });
                    }
                });
            });
        });
    </script> --}}
@endpush
