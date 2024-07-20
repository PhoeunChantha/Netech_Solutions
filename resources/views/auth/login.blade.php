<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nettic login</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('backend/login-form/css/style.css') }}">
</head>

<body>
    <section class="ftco-section h-100vh">
        <div class="container h-100">
            <div class="w-100 d-flex align-items-center h-100">
                <div class="w-100">
                    <div class="row justify-content-center">
                        <div class="col-md-7 col-lg-5 text-center ">
                            <img src="\website\upload\Frame 2.png" alt="" width="300px">
                            {{-- <h2 class="heading-section">
                            </h2> --}}
                        </div>
                    </div>

                    <div class="row align-items-center justify-content-center mt-1">
                        <div class="col-md-7 col-lg-5">
                            <div class="wrap p-5">

                                <div class="login-wrap">
                                    <div class="d-flex">
                                        <div class="">
                                            <h3 class="" style="margin: 0;color:black;">LOGIN</h3>
                                        </div>
                                    </div>
                                    <br>
                                    <form method="POST" action="{{ route('login') }}" class="signin-form">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="label" for="name">Email</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="Email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="label" for="password">Password</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <span>Please enter your email & passwod for login </span>

                                        <div class="form-group d-md-flex">
                                            <div class="w-50 text-left">
                                                <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                                    <input type="checkbox" name="remember" id="remember"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary rounded float-right"
                                                style="margin-bottom: 20px;">Log In</button>
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
    </section>

    <script src="{{ asset('backend/login-form/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/popper.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/login-form/js/main.js') }}"></script>

</body>

</html>
