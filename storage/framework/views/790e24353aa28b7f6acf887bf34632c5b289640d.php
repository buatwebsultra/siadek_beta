<?php
    $ds = Auth::user();
?>
<div class="pcoded-inner-navbar main-menu">

    <div class="pcoded-navigatio-lavel">Navigation</div>

    <ul class="pcoded-item pcoded-left-item">
        <li class="" id="mn1">
            <a href="<?php echo e(route('lecturer')); ?>">
                <span class="pcoded-micon"><i class="icofont icofont-ui-home text-primary"></i></span>
                <span class="pcoded-mtext">Dashboard</span>
            </a>
        </li>
        <?php if($ds->ds_level == 1): ?>
            <li class="pcoded-hasmenu" id="mn7">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-building-alt text-warning"></i></span>
                    <span class="pcoded-mtext">Program Studi</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="" id="mn71">
                        <a href="<?php echo e(route('lead.dosen')); ?>">
                            <span class="pcoded-mtext">Data Dosen</span>
                        </a>
                    </li>
                    <li class="" id="mn72">
                        <a href="<?php echo e(route('lead.mahasiswa')); ?>">
                            <span class="pcoded-mtext">Data Mahasiswa</span>
                        </a>
                    </li>
                    <li class="" id="mn-sts-mhs">
                        <a href="<?php echo e(route('lead.sts-mhs')); ?>">
                            <span class="pcoded-mtext">Statistik Mahasiswa</span>
                        </a>
                    </li>
                    <li class="" id="mn73">
                        <a href="<?php echo e(route('lead.matkul')); ?>">
                            <span class="pcoded-mtext">Mata Kuliah</span>
                        </a>
                    </li>
                    
                    <li class="" id="mn74">
                        <a href="<?php echo e(route('lead.set-penilaian')); ?>">
                            <span class="pcoded-mtext">Pengaturan Penilaian</span>
                        </a>
                    </li>
                    <li class="" id="mn-lap">
                        <a href="<?php echo e(route('lead.laporan')); ?>">
                            <span class="pcoded-mtext">Laporan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="" id="mn8">
                <a href="<?php echo e(route('lead.kemahasiswaan')); ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-hat-alt text-warning"></i></span>
                    <span class="pcoded-mtext">Kemahasiswaan</span>
                </a>
            </li>
        <?php endif; ?>
        <li class="" id="mn2">
            <a href="<?php echo e(route('lecturer.jadwal')); ?>">
                <span class="pcoded-micon"><i class="icofont icofont icofont-clock-time text-primary"></i></span>
                <span class="pcoded-mtext">Jadwal</span>
            </a>
        </li>
        <li class="" id="mn3">
            <a href="<?php echo e(route('lecturer.mahasiswa')); ?>">
                <span class="pcoded-micon"><i class="icofont icofont icofont-ui-user-group text-primary"></i></span>
                <span class="pcoded-mtext">Mahasiswa Bimbingan</span>
            </a>
        </li>
        <li class="" id="mn4">
            <a href="<?php echo e(route('lecturer.penilaian')); ?>">
                <span class="pcoded-micon"><i class="icofont icofont icofont-star text-primary"></i></span>
                <span class="pcoded-mtext">Penilaian</span>
            </a>
        </li>
        <li class="" id="mn5">
            <a href="<?php echo e(route('lecturer.dataDiri')); ?>">
                <span class="pcoded-micon"><i class="icofont icofont-user-alt-5 text-primary"></i></span>
                <span class="pcoded-mtext">Data Diri</span>
            </a>
        </li>
        <li class="" id="mn6">
            <a href="<?php echo e(route('lecturer.akun')); ?>">
                <span class="pcoded-micon"><i class="icofont icofont-settings-alt text-primary"></i></span>
                <span class="pcoded-mtext">Akun</span>
            </a>
        </li>

    </ul>

</div>
<?php /**PATH D:\PROJECT\siadek_beta\resources\views/_layouts/komponen/menu_dosen.blade.php ENDPATH**/ ?>