@extends('website.app')
@push('css')
    @include('website.web_login.login-style')
@endpush
@section('contents')
    <!-- New Password Form -->
    <section class="py-5 vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <h3 class="text-center mb-4">{{ __('Create New Password') }}</h3>

                            <!-- New Password Form -->
                            <form action="{{ route('otp-new-password') }}" method="post">
                                @csrf
                                <!-- Hidden Email Field -->
                                <input type="hidden" name="email" value="{{ session()->get('verify_email') }}" id="email">

                                <!-- Password Field -->
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}*</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password-field" name="password" placeholder="{{ __('Password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Confirm Password Field -->
                                <div class="form-group mb-3">
                                    <label for="password_confirmation"
                                        class="form-label">{{ __('Confirm Password') }}*</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary w-100">{{ __('Submit') }}</button>
                                </div>
                            </form>
                            <!-- End New Password Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End New Password -->
@endsection

@push('js')
@endpush
