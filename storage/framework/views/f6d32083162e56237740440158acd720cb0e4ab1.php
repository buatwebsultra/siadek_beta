<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Rencana Studi</title>
    <style>
        .w-100 {
            width: 100%;
        }

        .w-95 {
            width: 100%;
        }

        .text-center {
            text-align: center !important;
            vertical-align: middle !important;
        }

        .text-left {
            text-align: left !important;
            vertical-align: middle !important;
        }

        .table {
            border-collapse: collapse;
        }

        .table tr>td,
        th {
            padding: 5px;
            vertical-align: middle
        }

        .logo {
            position: absolute;
            z-index: 99999;
            top: 10px;
            left: 2px;
        }

        .tbl_head {
            border-bottom: 2px solid #000000
        }
    </style>
    <style type="text/css" media="print">
        @page  {
            size: portrait;
        }
    </style>
</head>

<body style="font-size: 10pt; max-width: 1200px">
    <img class="logo" src="<?php echo e(asset($appData->app_icon)); ?>" alt="LOGO" width="70">
    <table class="tbl_head w-95" border="0">
        <thead>
            <tr>
                <th class="text-center" style="font-size: 18pt"><?php echo e($appData->app_author); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"><?php echo e($appData->app_alamat); ?></td>
            </tr>
            <tr>
                <td class="text-center">Email : <?php echo e($appData->app_email); ?>; Telepon : <?php echo e($appData->app_tlp); ?></td>
            </tr>
            <tr>
                <td style="line-height: 3px">.</td>
            </tr>
        </tbody>
    </table>

    <table class="table w-95" border="0">
        <thead>
            <tr>
                <th colspan="6" class="text-center" style="text-transform: uppercase; line-height: 70px"><u>Kartu
                        Rencana Studi (KRS)</u></th>
            </tr>
            <tr>
                <th class="text-left" width="100">Nama</th>
                <th class="text-left" width="10">:</th>
                <th class="text-left"><?php echo e($mhs->mhs_nama); ?></th>
                <th class="text-left" width="90">Jurusan/Prodi</th>
                <th class="text-left" width="10">:</th>
                <th class="text-left"><?php echo e($mhs->jurusan->jur_nama); ?></th>
            </tr>
            <tr>
                <th class="text-left">NIM</th>
                <th class="text-left">:</th>
                <th class="text-left"><?php echo e($mhs->mhs_nim); ?></th>
                <th class="text-left">Jenjang</th>
                <th class="text-left">:</th>
                <th class="text-left"><?php echo e($mhs->jurusan->jur_jenjang); ?></th>
            </tr>
            <tr>
                <th class="text-left">Tahun Ajaran</th>
                <th class="text-left">:</th>
                <th class="text-left"><?php echo e($ta->ta_kode); ?></th>
                <th class="text-left" colspan="3"></th>
            </tr>
        </thead>
    </table>
    <div style="width: 100%; height: 20px;"></div>
    <table class="table w-95" border="1" style="font-size: 9pt">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode</th>
                <th class="text-center">Mata Kuliah</th>
                <th class="text-center">Dosen</th>
                <th class="text-center">Ruang</th>
                <th class="text-center">Jadwal</th>
                <th class="text-center">Semester</th>
                <th class="text-center">SKS</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sks = 0;
            ?>
            <?php $__currentLoopData = $krss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $krs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center"><?php echo e($loop->iteration); ?>.</td>
                    <td><?php echo e($krs->matkul->matkul_kode); ?></td>
                    <td><?php echo e($krs->matkul->matkul_nama); ?></td>
                    <td>
                        <?php $__currentLoopData = $krs->dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($ds): ?>
                            - <?php echo e($ds->ds_nama); ?>, <?php echo e($ds->ds_gelar); ?> <br>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td class="text-center"><?php echo e($krs->matkul->ruang->ruang_nama); ?></td>
                    <td class="text-center">
                        <?php echo e(date('H:i', strtotime($krs->matkul->matkul_jadwal)) . ' s/d ' . date('H:i', strtotime($krs->matkul->matkul_end))); ?>

                    </td>
                    <td class="text-center"><?php echo e($krs->matkul->matkul_semester); ?></td>
                    <td class="text-center"><?php echo e($krs->matkul->matkul_sks); ?></td>
                </tr>
                <?php
                    $sks = $sks + $krs->matkul->matkul_sks;
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" class="text-center">Total SKS Terdaftar</th>
                <th class="text-center"><?php echo e($sks); ?></th>
            </tr>
        </tfoot>
    </table>
    <br><br>
    <table class="w-95">
        <thead>
            <tr>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <td class="text-center"></td>
            </tr>
            <tr>
                <th class="text-center" style="width: 30%"></th>
                <th class="text-center" style="width: 35%">Menyetujui</th>
                <th class="text-center" style="width: 35%">Mengetahui</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">Mahasiswa</td>
                <td class="text-center">Pembimbing Akademik</td>
                <td class="text-center">Ketua Jurusan/Program Studi <br> <?php echo e($jurusan->jur_nama); ?></td>
            </tr>
            <tr>
                <td class="text-center" style="line-height: 60px; color: #fff">.</td>
                <td class="text-center"></td>
                <td class="text-center"></td>
            </tr>
            <tr>
                <td class="text-center"><?php echo e($mhs->mhs_nama); ?></td>
                <td class="text-center"><?php echo e($mhs->pembimbing->ds_nama . ', ' . $mhs->pembimbing->ds_gelar); ?></td>
                <td class="text-center"><?php echo e($jurusan->pimpinan->ds_nama . ', ' . $jurusan->pimpinan->ds_gelar); ?></td>
            </tr>
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
<?php /**PATH D:\PROJECT\siadek_beta\resources\views/pages/print_krs.blade.php ENDPATH**/ ?>