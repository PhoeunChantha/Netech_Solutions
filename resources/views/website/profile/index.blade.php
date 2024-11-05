@extends('website.app')
@section('contents')
    @include('website.profile.profile_style')
    <div class="container">
        <div class="container-fluid " style="min-height: 100vh;">
            <div class="row">
                <div class="col-3 mt-4">
                    <div class="profile-card">
                        <ul class="profile-menu">
                            <!-- Profile Link -->
                            <li class="profile-item mt-3">
                                <a href="{{ route('account.profile') }}"
                                    class="{{ request()->routeIs('account.profile') ? 'active' : 'unactive' }}">
                                    <i class="fas fa-user-circle"></i>
                                    <span>{{ __('Profile') }}</span>
                                </a>
                            </li>

                            <!-- My Orders Link -->
                            <li class="profile-item">
                                <a href="{{ route('account.orderHistory') }}"
                                    class="{{ request()->routeIs('account.orderHistory') ? 'active' : 'unactive' }}">
                                    <i class="fas fa-file-alt"></i>
                                    <span>{{ __('My Orders') }}</span>
                                </a>
                            </li>

                            <!-- My Address Link -->
                            <li class="profile-item">
                                <a href="{{ route('account.address') }}" class="{{ request()->routeIs('account.address') ? 'active' : 'unactive' }}">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ __('My Address') }}</span>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-9 mt-4" style="min-height: 100vh;">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var input = document.querySelector("#phone_input");
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
        // $(document).ready(function() {
        //     var input = document.querySelector("#phone");
        //     var iti = window.intlTelInput(input, {
        //         initialCountry: "kh",
        //         separateDialCode: true,
        //         hiddenInput: "full_mobile",
        //         dropdownContainer: document.body,
        //         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        //         nationalMode: false,
        //         autoPlaceholder: "aggressive"
        //     });

        //     // Optional: Handle form submission if needed
        //     $("form").on("submit", function() {
        //         var fullNumber = iti.getNumber(); // Get full international phone number
        //         $('#full_mobile').val(fullNumber); // Set the hidden input's value to the full number
        //         console.log(fullNumber);
        //     });
        // });
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
    <script>
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
    </script>
@endpush
