@php
    $base_aset = asset('komponen/login');
    $levelPath = Request::get('levelPath');
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | {{ $appData->app_nama ?? 'SIADEK' }}</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset($appData->app_icon ?? 'favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $base_aset }}/css/login.css">
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card login-card">
                        <div class="row no-gutters">
                            {{-- <div class="col-md-6">
                        <img src="{{ $base_aset }}/images/1178.jpg" alt="login" class="login-card-img">
                    </div> --}}
                            <div class="col-md-12 text-center">
                                <div class="card-body">
                                    <div class="brand-wrapper">
                                        <img src="{{ asset($appData->app_logo ?? 'komponen/login/images/logo_stikes_pi.png') }}" alt="logo" class=""
                                            style="width: 270px">
                                    </div>
                                    <p class="login-card-description">Masuk</p>
                                    @error('errorLogin')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong><i class="fas fa-ban"></i> Error !</strong> {{ $message }}
                                        </div>
                                    @enderror
                                    <form action="{{ route('login.gas') }}" method="POST"
                                        style="width: 100% !important; max-width: none !important">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username" class="sr-only">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="Username" minlength="3"
                                                value="{{ old('username') }}" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="password" class="sr-only">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password" minlength="4" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"></div>
                                        </div>
                                        <button class="btn btn-block login-btn mb-4" type="submit">Login</button>
                                    </form>
                                    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                                    <a href="#!" class="forgot-password-link">Lupa password?</a>
                                    {{-- <p class="login-card-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p> --}}
                                    <nav class="login-card-footer-nav">
                                        <a href="#!">2022 &copy; {{ $appData->app_nama ?? 'SIADEK' }} </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
