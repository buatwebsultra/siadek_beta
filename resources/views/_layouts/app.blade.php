@php
    $base_aset = asset('komponen');
    $levelPath = Request::segment(1);
    $guard = Auth::getDefaultDriver();
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <title>@yield('pageName', 'Dashboard') | {{ $appData->app_nama }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $appData->app_desc }}">
    <meta name="author" content="{{ $appData->app_author }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset($appData->app_icon) }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/assets/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/assets/icon/feather/css/feather.css">
    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/bower_components/sweetalert/css/sweetalert.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/assets/css/adr-custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Pacifico&display=swap" rel="stylesheet">
    <style>
        .loading1 {
            display: none;
            position: fixed;
            z-index: 99999999;
            background-color: rgba(77, 77, 77, 0.7);
            width: 100%;
            min-height: 100vh !important;
            padding-top: 15%;
        }

        .pcoded-left-item .active a {
            background-color: #4f5c73 !important;
        }

        .btn-wide {
            width: auto !important;
            padding-left: 40px !important;
            padding-right: 40px !important;
        }

        .modal-title {
            font-size: 12pt;
        }

        table>tbody>tr>td {
            vertical-align: middle !important;
        }

        .cfont1 {
            font-family: 'Pacifico', cursive;
        }

        .pointer {
            cursor: pointer;
        }

        .b-w-100 {
            border: 2px solid #fff !important;
        }

        .label-default {
            color: #000000 !important;
        }

        .text-help {
            color: #888888;
            font-size: 10pt;
        }

        .icons-alert:before {
            /* top: 11px !important; */
        }

        .modal-full {
            max-width: 90%;
        }

        .showSweetAlert {
            z-index: 999999999999;
        }
    </style>
    @yield('css', '')
    @stack('additional_css')
</head>

<body>
    <div class="loading1 text-center">
        <img src="{{ asset('komponen/assets/images/loading2.gif') }}" alt="" width="100px"><br>
        <span class="text-white">Memproses..</span>
    </div>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="#">
                            <img class="img-fluid" src="{{ asset($appData->app_logo_w) }}" alt="Theme-Logo"
                                style="width: 40px">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">

                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ $base_aset }}/assets/images/user/user.png" class="img-radius"
                                            alt="User-Profile-Image">
                                        <span>{{ session('nama', 'User') }}</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="{{ route($levelPath . '.akun') }}">
                                                <i class="feather icon-user"></i> Akun
                                            </a>
                                        </li>
                                        @if ($guard == 'admin' && @Auth::user()->user_level == 1)
                                            <li>
                                                <a href="{{ route($levelPath . '.pengaturan') }}">
                                                    <i class="feather icon-settings"></i> Pengaturan
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a class="text-danger" onclick="document.forms['form_logout'].submit();">
                                                <i class="feather icon-log-out"></i> Keluar
                                            </a>
                                            <form name="form_logout" action="{{ route('logout.gas') }}"
                                                method="POST">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        @include('_layouts.komponen.' . session('menu', '-'))
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                @yield('body', 'NO DATA')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (@$jadPen->wk_status == 1)
        <div class="card text-white d-none d-md-block"
            style="background-color: #fa2c2c; width: 340px; height: 92px; position: fixed; z-index: 9999; top: 1px; left: 40%; right: 0; bottom: 0;">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <p class="m-b-5">Batas Waktu Penilaian ({{ $jadPen->ta->ta_kode }})</p>
                        <h4 class="m-b-0" id="timer" style="font-size: 12pt">---</h4>
                    </div>
                    <div class="col-md-2 text-right">
                        <i class="ti-timer f-30 text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ $base_aset }}/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ $base_aset }}/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ $base_aset }}/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="{{ $base_aset }}/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ $base_aset }}/bower_components/jquery-slimscroll/js/jquery.slimscroll.js">
    </script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ $base_aset }}/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="{{ $base_aset }}/bower_components/modernizr/js/css-scrollbars.js"></script>

    <script src="{{ $base_aset }}/assets/js/pcoded.min.js"></script>
    <script src="{{ $base_aset }}/assets/js/vartical-layout.min.js"></script>
    <script src="{{ $base_aset }}/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ $base_aset }}/assets/js/script.js"></script>

    <!-- sweet alert js -->
    <script type="text/javascript" src="{{ $base_aset }}/bower_components/sweetalert/js/sweetalert.min.js"></script>

    <script>
        let globalAppUrl = "{{ url('/') }}/";
        let freeParam = "";
        let globalTaPilih = '';
        let globalTaTipe = '';
        let globalTaKode = '';
        let globalTaKunci = '0';

        $(document).ready(function() {
            @if (session('success'))
                alertSuccess(@json(session('success')));
            @endif

            @if (session('error'))
                alertError(@json(session('error')));
            @endif

            $('.req').append(` <span class="text-danger">*</span>`);
            $('.modal').attr('data-backdrop', "static")
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let configDataTable = {
            language: {
                search: '<span>Cari:</span> _INPUT_',
                searchPlaceholder: 'Ketik untuk mencari...',
                lengthMenu: '<span>Tampilkan:</span> _MENU_',
            },
        };

        async function sendAjax(link, dataKirim = {}, metode = "POST") {
            $('.loading1').fadeIn(300);
            return $.ajax({
                url: link,
                type: metode,
                data: dataKirim,
                success: function(res) {
                    $('.loading1').fadeOut(300);
                },
                error: function(e) {
                    $('.loading1').fadeOut(300);
                    alertError("Terjadi kesalahan pada koneksi. Silahkan coba lagi");
                    setTimeout(() => {
                        document.location = window.location.href;
                    }, 1200);
                    console.log(e);
                }
            });
        }

        async function sendAjaxFile(link, dataKirim = {}, metode = "POST") {
            $('.loading1').fadeIn(300);
            return $.ajax({
                url: link,
                type: metode,
                data: dataKirim,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('.loading1').fadeOut(300);
                },
                error: function(e) {
                    $('.loading1').fadeOut(300);
                    alertError("Terjadi kesalahan pada koneksi. <br> Silahkan coba lagi");
                    console.log(e);
                }
            });
        }

        function alertSuccess(msg) {
            swal("Sukses!", msg, "success");
        }

        function alertError(msg) {
            swal("Gagal!", msg, "error");
        }

        function initDelete(fungsi, id) {
            swal({
                    title: "Hapus Data ?",
                    text: "Data yang telah terhapus tidak dapat dikembalikan.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Batal",
                    // closeOnConfirm: false,
                    // closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window[fungsi](id);
                    }
                });
        }

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    currencyDisplay: "code"
                }).format(number)
                .replace("IDR", "")
                .trim();
        }

        function hideSidebar() {
            $('#mobile-collapse').trigger('click');
        }

        function clearWhiteSpace(ob) {
            let text = $(ob).val().replace(/\s/g, "");
            $(ob).val(text);
        }

        function setTahunAjaran(mix_value) {
            let newVal = mix_value.split('-');
            globalTaPilih = newVal[0];
            globalTaKode = newVal[1];
            globalTaKunci = newVal[2];
            if (newVal[1] % 2 == 0) {
                globalTaTipe = 'genap';
            } else {
                globalTaTipe = 'ganjil';
            }
            $('.ta_show').html(newVal[1]);
            console.log(globalTaKode);
            console.log(globalTaPilih);
            console.log(globalTaTipe);
        }

        @if (@$jadPen->wk_status == 1)
            // Tentukan tanggal dan waktu target
            const targetDate = new Date("{{ $jadPen->wk_tgl_end . ' ' . $jadPen->wk_jam_end }}");

            function getTimeRemaining() {
                let now = new Date();

                let timeRemaining = targetDate - now;
                // Hitung hari, jam, menit, dan detik
                let days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                let hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24);
                let minutes = Math.floor((timeRemaining / 1000 / 60) % 60);
                let seconds = Math.floor((timeRemaining / 1000) % 60);

                // console.log('targetDate :'+targetDate);
                // console.log('now :'+now);
                // console.log('timeRemaining :'+timeRemaining);

                return {
                    days,
                    hours,
                    minutes,
                    seconds,
                    timeRemaining
                };
            }

            // Fungsi untuk menampilkan timer
            function displayTimer() {
                let {
                    days,
                    hours,
                    minutes,
                    seconds,
                    timeRemaining
                } = getTimeRemaining();

                // Tampilkan timer di dalam elemen dengan id "timer"
                const timerElement = document.getElementById("timer");
                timerElement.innerHTML = `${days} hari, ${hours} jam, ${minutes} menit, ${seconds} detik`;

                // Jika waktu sudah habis, tampilkan pesan "Waktu sudah habis"
                if (timeRemaining <= 0) {
                    timerElement.innerHTML = "Waktu sudah habis";
                    clearInterval(timerInterval);
                }
            }

            // Panggil fungsi displayTimer() setiap 1 detik
            let timerInterval = setInterval(displayTimer, 1000);
        @endif
    </script>
    @stack('libs')
    @yield('script', '')
    @stack('additional_script')
</body>

</html>
