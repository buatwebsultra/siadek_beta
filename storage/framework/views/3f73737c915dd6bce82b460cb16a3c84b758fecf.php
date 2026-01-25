<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Mahasiswa</title>

</head>

<body>
    <table>
        <thead>
            <tr>
                <th style="background-color: #2dd78d">#</th>
                <th style="background-color: #2dd78d">NIM</th>
                <th style="background-color: #2dd78d">Nama</th>
                <th style="background-color: #2dd78d">Tempat Lahir</th>
                <th style="background-color: #2dd78d">Tanggal Lahir</th>
                <th style="background-color: #2dd78d">Jenis Kelamin</th>
                <th style="background-color: #2dd78d">NIK</th>
                <th style="background-color: #2dd78d">Agama</th>
                <th style="background-color: #2dd78d">NISN</th>
                <th style="background-color: #2dd78d">Jalur Pendaftaran</th>
                <th style="background-color: #2dd78d">NPWP</th>
                <th style="background-color: #2dd78d">Kewarganegaraan</th>
                <th style="background-color: #2dd78d">Jenis Pendaftaran</th>
                <th style="background-color: #2dd78d">Tgl Masuk Kuliah</th>
                <th style="background-color: #2dd78d">Mulai Semester</th>
                <th style="background-color: #2dd78d">Jalan</th>
                <th style="background-color: #2dd78d">RT</th>
                <th style="background-color: #2dd78d">RW</th>
                <th style="background-color: #2dd78d">Nama Dusun</th>
                <th style="background-color: #2dd78d">Kelurahan</th>
                <th style="background-color: #2dd78d">Kecamatan</th>
                <th style="background-color: #2dd78d">Kode Pos</th>
                <th style="background-color: #2dd78d">Jenis Tinggal</th>
                <th style="background-color: #2dd78d">Alat Transportasi</th>
                <th style="background-color: #2dd78d">Telp Rumah</th>
                <th style="background-color: #2dd78d">No HP</th>
                <th style="background-color: #2dd78d">Email</th>
                <th style="background-color: #2dd78d">Terima KPS</th>
                <th style="background-color: #2dd78d">No KPS</th>
                <th style="background-color: #2dd78d">NIK Ayah</th>
                <th style="background-color: #2dd78d">Nama Ayah</th>
                <th style="background-color: #2dd78d">Tgl Lahir Ayah</th>
                <th style="background-color: #2dd78d">Pendidikan Ayah</th>
                <th style="background-color: #2dd78d">Pekerjaan Ayah</th>
                <th style="background-color: #2dd78d">Penghasilan Ayah</th>
                <th style="background-color: #2dd78d">NIK Ibu</th>
                <th style="background-color: #2dd78d">Nama Ibu</th>
                <th style="background-color: #2dd78d">Tgl Lahir Ibu</th>
                <th style="background-color: #2dd78d">Pendidikan Ibu</th>
                <th style="background-color: #2dd78d">Pekerjaan Ibu</th>
                <th style="background-color: #2dd78d">Penghasilan Ibu</th>
                <th style="background-color: #2dd78d">Nama Wali</th>
                <th style="background-color: #2dd78d">Tanggal Lahir wali</th>
                <th style="background-color: #2dd78d">Pendidikan Wali</th>
                <th style="background-color: #2dd78d">Pekerjaan Wali</th>
                <th style="background-color: #2dd78d">Penghasilan Wali</th>
                <th style="background-color: #2dd78d">Kode Prodi</th>
                <th style="background-color: #2dd78d">Jenis Pembiayaan</th>
                <th style="background-color: #2dd78d">Biaya Masuk Kuliah</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($mhs->mhs_nim); ?></td>
                    <td><?php echo e($mhs->mhs_nama); ?></td>
                    <td><?php echo e($mhs->mhs_tmpt_lahir); ?></td>
                    <td><?php echo e($mhs->mhs_tgl_lahir); ?></td>
                    <td><?php echo e($mhs->mhs_jk); ?></td>
                    <td>'<?php echo e($mhs->mhs_nik); ?></td>
                    <td><?php echo e($mhs->mhs_agama); ?></td>
                    <td><?php echo e($mhs->mhs_nisn); ?></td>
                    <td><?php echo e($mhs->mhs_jalur_daftar); ?></td>
                    <td><?php echo e($mhs->mhs_npwp); ?></td>
                    <td>ID</td>
                    <td><?php echo e($mhs->mhs_jenis_daftar); ?></td>
                    <td><?php echo e($mhs->mhs_tgl_masuk); ?></td>
                    <td><?php echo e($mhs->mhs_angkatan); ?>1</td>
                    <td>-</td>
                    <td><?php echo e($mhs->mhs_rt); ?></td>
                    <td><?php echo e($mhs->mhs_rw); ?></td>
                    <td><?php echo e($mhs->mhs_dusun); ?></td>
                    <td><?php echo e($mhs->mhs_kelurahan); ?></td>
                    <td><?php echo e(@$mhs->kecamatan->kec_kode); ?></td>
                    <td><?php echo e($mhs->mhs_kode_pos); ?></td>
                    <td><?php echo e($mhs->mhs_jenis_tinggal); ?></td>
                    <td><?php echo e($mhs->mhs_transportasi); ?></td>
                    <td>-</td>
                    <td><?php echo e($mhs->mhs_tlp); ?></td>
                    <td><?php echo e($mhs->mhs_email); ?></td>
                    <td><?php echo e($mhs->mhs_kps); ?></td>
                    <td><?php echo e($mhs->mhs_kps_no); ?></td>
                    <td>'<?php echo e($mhs->mhs_ayah_nik); ?></td>
                    <td><?php echo e($mhs->mhs_ayah_nama); ?></td>
                    <td><?php echo e($mhs->mhs_ayah_tgl_lahir); ?></td>
                    <td><?php echo e($mhs->mhs_ayah_pendidikan); ?></td>
                    <td><?php echo e($mhs->mhs_ayah_pekerjaan); ?></td>
                    <td><?php echo e($mhs->mhs_ayah_penghasilan); ?></td>
                    <td>'<?php echo e($mhs->mhs_ibu_nik); ?></td>
                    <td><?php echo e($mhs->mhs_ibu_nama); ?></td>
                    <td><?php echo e($mhs->mhs_ibu_tgl_lahir); ?></td>
                    <td><?php echo e($mhs->mhs_ibu_pendidikan); ?></td>
                    <td><?php echo e($mhs->mhs_ibu_pekerjaan); ?></td>
                    <td><?php echo e($mhs->mhs_ibu_penghasilan); ?></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?php echo e($jurusan->jur_kode); ?></td>
                    <td><?php echo e($mhs->mhs_jenis_biaya); ?></td>
                    <td><?php echo e(@$mhs->ukt[0]->byr_jml_bayar); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</body>

</html>
<?php /**PATH D:\PROJECT\siadek_beta\resources\views/_excel/data_mhs.blade.php ENDPATH**/ ?>