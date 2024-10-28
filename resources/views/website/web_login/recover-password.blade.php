@extends('website.app')
@push('css')
    @include('website.web_login.login-style')
@endpush
@section('contents')
<div class="container vh-100">
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <p>Please enter your registered Mobile Number so that we can help you to recover your password</p>
        <div class="row d-flex justify-content-center">
            <form class="recover-form" action="#" method="post">
                <div class="form-group mb-3 text-start">
                    <label for="signin_phone">Phone Number</label>
                    <div class="input-group">
                        <input id="signin_phone" class="form-control" type="tel" name="signin_phone"
                            placeholder="Enter mobile number">
                    </div>
                </div>
                <a href="{{ route('customer.change-password') }}" type="submit" class="btn text-white btn-next mt-3">Next</a>
            </form>
        </div>
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
