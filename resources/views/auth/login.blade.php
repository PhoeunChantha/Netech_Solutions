<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nettic login</title>
    <link
    href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
    rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('backend/login-form/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            font-family: 'Kantumruy Pro', sans-serif;
        }
        .ftco-section{
            background-image: url("{{ asset('uploads/bg-login.png') }}");
            background-size: cover;
            background-position:center;
            background-repeat: no-repeat;
            height: 100vh;
        }
        .login-title{
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 57px;
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }
        .btn-login{
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-login:hover{
            background-color: #555;
            transition: background-color 0.3s ease;
            cursor: pointer;
            
        }

    </style>
</head>\

<body>
    <section class="ftco-section " >
        {{-- <div class="container h-100">
            <div class="w-100 d-flex align-items-center justify-content-center h-100">
                <div class="card">
                    <div class="col-12">
                        <div class="row align-items-center justify-content-center mt-1">
                            <div class="col-md-6 col-lg-6">
                                <img src="{{ asset('uploads/bg-login.png') }}" alt="" width="430px">
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="wrap p-4">
                                    <div class="login-wrap">
                                        <div class="d-flex">
                                            <div class="">
                                                <h3 class="" style="margin: 0;color:black;">LOGIN</h3>
                                            </div>
                                        </div>
                                        <br>
                                        <form method="POST" action="{{ route('admin.store-login') }}"
                                            class="signin-form">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label class="label" for="name">{{ __('Email') }}</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="Email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="label" for="password">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <span>{{ __('Please enter your email & passwod for login') }}</span>

                                            <div class="form-group d-md-flex">
                                                <div class="w-50 text-left">
                                                    <label
                                                        class="checkbox-wrap checkbox-primary mb-0">{{ __('Remember Me') }}
                                                        <input type="checkbox" name="remember" id="remember"
                                                            {{ old('remember') ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-block btn-primary rounded float-right"
                                                    style="margin-bottom: 20px;">{{ __('Login') }}</button>
                                            </div>
                                            <br>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="container d-flex align-items-center justify-content-center h-100">
            <div class="card p-4">
                <div class="row align-items-center justify-content-center mt-1">
                    <div class="col-md-6">
                        <img src="{{ asset('uploads/bg-login.png') }}" alt="Login Background" class="img-fluid" style="width: 571px;">
                    </div>
                    <div class="col-md-6">
                        <div class="wrap p-4">
                            <div class="login-wrap">
                                <h3 class="login-title">LOGIN</h3>
                                <br>
                                <form method="POST" action="{{ route('admin.store-login') }}" class="signin-form">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <span>{{ __('Please enter your email & password for login') }}</span>
                                    <div class="form-group d-flex align-items-center mt-2">
                                        <label class="checkbox-wrap mb-0">
                                            {{ __('Remember Me') }}
                                            <input type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary btn-block rounded btn-login">{{ __('Login') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            var success_audio = "{{ URL::asset('sound/success.wav') }}";
            var error_audio = "{{ URL::asset('sound/error.wav') }}";
            var success = new Audio(success_audio);
            var error = new Audio(error_audio);
            const Confirmation = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            @if (Session::has('msg'))
                @if (Session::get('success') == true)
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("{{ Session::get('msg') }}");
                    success.play();
                @else
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("{{ Session::get('msg') }}");
                    error.play();
                @endif
            @endif

        });
    </script>
    <script src="{{ asset('backend/login-form/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/popper.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
