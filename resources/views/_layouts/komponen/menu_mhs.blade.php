<div class="pcoded-inner-navbar main-menu">

    <div class="pcoded-navigatio-lavel">Mahasiswa</div>

    <ul class="pcoded-item pcoded-left-item">
        <li class="" id="mn1">
            <a href="{{ route('student') }}">
                <span class="pcoded-micon"><i class="icofont icofont-ui-home text-primary"></i></span>
                <span class="pcoded-mtext">Dashboard</span>
            </a>
        </li>

        <li class="" id="mn2">
            <a href="{{ route('student.krs') }}">
                <span class="pcoded-micon"><i class="icofont icofont-hat-alt text-primary"></i></span>
                <span class="pcoded-mtext">KRS</span>
            </a>
        </li>

        <li class="" id="mn3">
            <a href="{{ route('student.khs') }}">
                <span class="pcoded-micon"><i class="icofont icofont-medal text-primary"></i></span>
                <span class="pcoded-mtext">KHS</span>
            </a>
        </li>

        <li class="" id="mn6">
            <a href="{{ route('student.ukt') }}">
                <span class="pcoded-micon"><i class="icofont icofont-clip-board text-primary"></i></span>
                <span class="pcoded-mtext">Pembayaran UKT</span>
            </a>
        </li>

        <li class="" id="mn4">
            <a href="{{ route('student.data-diri') }}">
                <span class="pcoded-micon"><i class="icofont icofont-user-alt-5 text-primary"></i></span>
                <span class="pcoded-mtext">Data Diri</span>
            </a>
        </li>



        <li class="" id="mn5">
            <a href="{{ route('student.akun') }}">
                <span class="pcoded-micon"><i class="icofont icofont-settings-alt text-primary"></i></span>
                <span class="pcoded-mtext">Akun</span>
            </a>
        </li>

        {{-- <li class="pcoded-hasmenu" id="mn">
            <a href="javascript:void(0)">
                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                <span class="pcoded-mtext">Dashboard</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="" id="mn">
                    <a href="#">
                        <span class="pcoded-mtext">Default</span>
                    </a>
                </li>
            </ul>
        </li> --}}

    </ul>

</div>
