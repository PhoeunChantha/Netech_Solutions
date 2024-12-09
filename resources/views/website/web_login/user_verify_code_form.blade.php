@extends('website.app')
@push('css')
    @include('website.web_login.login-style')
@endpush
@section('contents')
    <div class="container vh-100 d-flex justify-content-center mt-5">
        <div class="row justify-content-center">
            <div class="card card-verify-code">
                <div class="card-body d-flex flex-column justify-content-center  text-center">
                    <h4>{{ __('Code Verify') }}
                        <span>{{ __('We’ve sent a code with an activation code to your email') }}</span>
                    </h4>
                    <!-- Sign in Form -->
                    <form action="{{ route('verifyOtp') }}" method="post">
                        @csrf
                        <input type="hidden" name="email" value="{{ session()->get('verify_email') }}" id="email">
                        <div class="d-flex justify-content-center gap-3">
                            <div class="col-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="otp_1" maxlength="1" required>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="otp_2" maxlength="1" required>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="otp_3" maxlength="1" required>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="otp_4" maxlength="1" required>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="otp_5" maxlength="1" required>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="otp_6" maxlength="1" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary" type="submit">{{ __('Verify') }}</button>
                        </div>
                    </form>

                    <!-- Resend OTP Form -->
                    <form class="p-0" action="{{ route('resend-Otp') }}" method="post">
                        @csrf
                        <input type="hidden" name="email" value="{{ session()->get('email') }}" id="email">

                        <div class="form-group mt-3">
                            <div class="">
                                {{ __('I didn’t receive the code') }}
                                <a href="javascript:void(0)" id="resend-otp-link" class="disabled-link"
                                    style="margin-left: 3px;">
                                    {{ __('Resent') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    <!-- End Sign in Form -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.querySelectorAll('input[name^="otp_"]').forEach((input, index, inputs) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#resend-otp-link').on('click', function(e) {
                e.preventDefault();
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
