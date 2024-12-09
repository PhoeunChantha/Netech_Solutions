@extends('website.app')
@push('css')
    @include('website.web_login.login-style')
@endpush
@section('contents')
    <div class="container vh-100">
        <div class="row d-flex justify-content-center">
            <div class="forgot-password-container mt-5 align-items-center">
                <h2>{{ __('Forgot Password') }}</h2>
                <p>{{ __('Please enter your email so that we can help you to recover your password') }}</p>
                <div class="row d-flex justify-content-center align-items-center">
                    <form class="recover-form" action="{{ route('send-forget-password') }}" method="post">
                        @csrf
                        <div class="form-group mb-3 text-start">
                            <label for="recover_email">{{ __('Email') }}</label>
                            <div class="input-group">
                                <input id="recover_email" class="form-control" type="email" name="email"
                                    value="" placeholder="{{ __('Enter Email') }}">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn text-white btn-next mt-3">{{ __('Next') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{-- <script>
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
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            var input = document.querySelector("#signin_phone");
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
    </script> --}}
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
                        $('.profile-pic').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
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
