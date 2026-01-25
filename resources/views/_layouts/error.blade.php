@php
    $base_aset = asset('komponen/error');
@endphp
<!DOCTYPE html>
<html lang="id-ID" class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageName', 'Error') | {{ $appData->app_nama }}</title>
    <meta name="description" content="{{ $appData->app_desc }}">
    <meta name="author" content="{{ $appData->app_author }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset($appData->app_icon) }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/css/style.css">
</head>

<body>

    <div class="image"></div>

    <!-- Your logo on the top left -->
    <a href="{{ url('/') }}" class="logo-link" title="back home" style="margin-right: 246px">
        <img src="{{ asset($appData->app_logo_w) }}" class="logo" alt="logo" style="width: 200px;">
    </a>

    <div class="content">

        <div class="content-box">

            <div class="big-content">

                <!-- Main squares for the content logo in the background -->
                <div class="list-square">
                    <span class="square"></span>
                    <span class="square"></span>
                    <span class="square"></span>
                </div>

                <!-- Main lines for the content logo in the background -->
                <div class="list-line">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>

                <!-- The animated searching tool -->
                <i class="fa fa-search" aria-hidden="true"></i>

                <!-- div clearing the float -->
                <div class="clear"></div>

            </div>

            @yield('body', 'Error')

        </div>

    </div>

    <footer class="light" >
        <ul>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>

    </footer>
    <script src="{{ $base_aset }}/js/jquery.min.js"></script>
    <script src="{{ $base_aset }}/js/bootstrap.min.js"></script>

</body>

</html>
