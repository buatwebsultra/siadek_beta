<div class="pcoded-inner-navbar main-menu">

    <?php if(Auth::user()->user_level == 1): ?>
        <div class="pcoded-navigatio-lavel">Admin</div>

        <ul class="pcoded-item pcoded-left-item">
            <li class="" id="mn1">
                <a href="<?php echo e(route('admin')); ?>">
                    <span class="pcoded-micon"><i class="feather icon-home text-primary"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>

            <li class="" id="mn2">
                <a href="<?php echo e(route('admin.tahun-ajaran')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-tasks-alt text-primary"></i></span>
                    <span class="pcoded-mtext">Tahun Ajaran</span>
                </a>
            </li>

            <li class="" id="mn-jad">
                <a href="<?php echo e(route('admin.jadwal-pen')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-clock-time text-primary"></i></span>
                    <span class="pcoded-mtext">Jadwal Penilaian</span>
                </a>
            </li>

            <li class="pcoded-hasmenu" id="mn3">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-building-alt text-primary"></i></span>
                    <span class="pcoded-mtext">Unit</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="" id="mn32">
                        <a href="<?php echo e(route('admin.jurusan')); ?>">
                            <span class="pcoded-mtext">Jurusan/Prodi</span>
                        </a>
                    </li>
                    <li class="" id="mn33">
                        <a href="<?php echo e(route('admin.ruangan')); ?>">
                            <span class="pcoded-mtext">Ruangan Kuliah</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="" id="mn4">
                <a href="<?php echo e(route('admin.pengajar')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-id-card text-primary"></i></span>
                    <span class="pcoded-mtext">Dosen/Pengajar</span>
                </a>
            </li>

            <li class="" id="mn5">
                <a href="<?php echo e(route('admin.mahasiswa')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-people text-primary"></i></span>
                    <span class="pcoded-mtext">Mahasiswa</span>
                </a>
            </li>

            <li class="" id="mn-sts-mhs">
                <a href="<?php echo e(route('admin.sts-mhs')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-pie-chart text-primary"></i></span>
                    <span class="pcoded-mtext">Statistik Mahasiswa</span>
                </a>
            </li>

            <li class="" id="mn6">
                <a href="<?php echo e(route('admin.matakuliah')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-briefcase-alt-1 text-primary"></i></span>
                    <span class="pcoded-mtext">Mata Kuliah</span>
                </a>
            </li>

            <li class="" id="mn9">
                <a href="<?php echo e(route('admin.ukt')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-clip-board text-primary"></i></span>
                    <span class="pcoded-mtext">Pembayaran SPP</span>
                </a>
            </li>

            <li class="" id="mn-lap">
                <a href="<?php echo e(route('admin.laporan')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-files text-primary"></i></span>
                    <span class="pcoded-mtext">Laporan</span>
                </a>
            </li>

            <li class="" id="mn7">
                <a href="<?php echo e(route('admin.pengaturan')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-wheel text-primary"></i></span>
                    <span class="pcoded-mtext">Pengaturan</span>
                </a>
            </li>

            <li class="" id="mn8">
                <a href="<?php echo e(route('admin.akun')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-cube text-primary"></i></span>
                    <span class="pcoded-mtext">Akun</span>
                </a>
            </li>

        </ul>
    <?php else: ?>
        <div class="pcoded-navigatio-lavel">Admin Keuangan</div>

        <ul class="pcoded-item pcoded-left-item">
            <li class="" id="mn1">
                <a href="<?php echo e(route('admin')); ?>">
                    <span class="pcoded-micon"><i class="feather icon-home text-primary"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>

            <li class="" id="mn9">
                <a href="<?php echo e(route('admin.ukt')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-clip-board text-primary"></i></span>
                    <span class="pcoded-mtext">Pembayaran SPP</span>
                </a>
            </li>

            <li class="" id="mn8">
                <a href="<?php echo e(route('admin.akun')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-cube text-primary"></i></span>
                    <span class="pcoded-mtext">Akun</span>
                </a>
            </li>

        </ul>
    <?php endif; ?>

</div>
<?php /**PATH D:\PROJECT\siadek_beta\resources\views/_layouts/komponen/menu_admin.blade.php ENDPATH**/ ?>