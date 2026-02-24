<?php
use Illuminate\Support\Facades\DB;
$konf = DB::table('setting')->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $konf->instansi_setting }} | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $konf->tentang_setting }}">
    <meta name="author" content="{{ $konf->instansi_setting }}">
    <link rel="icon" type="image/png" href="{{ asset('logo/' . $konf->logo_setting) }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('web/1/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/1/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/1/css/main.css') }}">
</head>

<body>
    <div class="container-login100"
        style="background: url('{{ asset('web/1/images/1.jpg') }}') no-repeat center center; background-size: cover; background-attachment: fixed;">
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="IMG">
                    </div>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <span class="login100-form-title">Login Page</span>

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="email" placeholder="Email" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="password" name="password" placeholder="Password" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-login">
        <p>
            <strong>&copy; {{ date('Y') }} {{ $konf->instansi_setting }}</strong>
            <br>
        </p>
    </footer>

    <script src="{{ asset('web/1/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('web/1/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/1/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        });
    </script>
</body>

</html>
