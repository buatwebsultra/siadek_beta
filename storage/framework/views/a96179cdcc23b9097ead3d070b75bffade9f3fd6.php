<?php
    $guard = Auth::getDefaultDriver();
    $action = route('lecturer.data-diri.update');
    $actionFoto = route('lecturer.data-diri.set-foto');
    $pageName = 'Data Diri';
    $mn = '#mn5';
    if ($guard == 'admin') {
        $action = route('admin.dosen.update');
        $actionFoto = route('admin.dosen.set-foto');
        $pageName = 'Detail Dosen/Pengajar';
        $mn = '#mn4';
    }

    if (@$isKaprodi) {
        $mn = '';
        $pageName = 'Detail Dosen/Pengajar';
        $action = route('admin.dosen.update');
        $actionFoto = route('admin.dosen.set-foto');
    }
?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageName', $pageName); ?>
<?php $__env->startSection('body'); ?>

    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4><?php echo e($pageName); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="#"> <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!"><?php echo e($pageName); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <?php if($guard == 'admin'): ?>
                    <div class="col-md-12 mb-3">
                        <a href="<?php echo e(route('admin.pengajar')); ?>" class="btn btn-sm btn-warning"> <i
                                class="icofont icofont-hand-drawn-left"></i> Kembali</a>
                    </div>
                <?php endif; ?>
                <?php if(@$isKaprodi): ?>
                    <div class="col-md-12 mb-3">
                        <a href="<?php echo e(route('lead.dosen')); ?>" class="btn btn-sm btn-warning"> <i
                                class="icofont icofont-hand-drawn-left"></i> Kembali</a>
                    </div>
                <?php endif; ?>
                <div class="col-sm-12">
                    <div class="card border-left-1">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs  tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#data1" role="tab"><i
                                                    class="icofont icofont-user-alt-5 text-primary"></i> Data Dosen</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#biodata1" role="tab">
                                                Biodata</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#keluarga1" role="tab">
                                                Keluarga</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabs card-block">
                                        <div class="tab-pane active" id="data1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="card user-card-full">
                                                        <div class="row m-l-0 m-r-0">
                                                            <div class="col-md-12 bg-c-lite-green user-profile">
                                                                <div class="card-block text-center text-white">
                                                                    <div class="m-b-25">
                                                                        <img src="<?php echo e(asset($dosen->ds_foto)); ?>"
                                                                            class="" alt="Foto"
                                                                            style="width: 85%">
                                                                    </div>
                                                                    <h6 class="f-w-600"><?php echo e($dosen->ds_nama); ?></h6>
                                                                    <p>NIDN : <?php echo e($dosen->ds_nip); ?></p>
                                                                    <p>
                                                                        <button type="button" onclick="initFoto()"
                                                                            class="btn btn-sm btn-mat btn-primary b-w-100">
                                                                            <i class="icofont icofont-ui-user"></i>
                                                                            Ganti Foto
                                                                        </button>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <form action="<?php echo e($action); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="update_tipe" value="1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Jurusan /
                                                                        Prodi</label>
                                                                    <select class="form-control form-control-sm col-md-9"
                                                                        name="ds_jur_id" id="ds_jur_id" readonly>
                                                                        <option value="<?php echo e($dosen->jurusan->jur_id); ?>">
                                                                            <?php echo e($dosen->jurusan->jur_nama); ?> -
                                                                            (<?php echo e($dosen->jurusan->jur_jenjang); ?>)</option>
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">NIDN</label>
                                                                    <input type="text" onchange="clearWhiteSpace(this)"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="ds_nip" id="ds_nip"
                                                                        value="<?php echo e($dosen->ds_nip); ?>" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Nama</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="ds_nama" id="ds_nama"
                                                                        value="<?php echo e($dosen->ds_nama); ?>" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for=""
                                                                        class="req col-md-3">Gelar</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="ds_gelar" id="ds_gelar"
                                                                        value="<?php echo e($dosen->ds_gelar); ?>" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for=""
                                                                        class="req col-md-3">Pendidikan</label>
                                                                    <select type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="ds_pendidikan" id="ds_pendidikan" required>
                                                                        <option value="">-- Pilih --</option>
                                                                        <option value="D3">D3</option>
                                                                        <option value="D4">D4</option>
                                                                        <option value="S1">S1</option>
                                                                        <option value="S2">S2</option>
                                                                        <option value="S3">S3</option>
                                                                        <option value="Profesi">Profesi</option>
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Jenis
                                                                        Kelamin</label>
                                                                    <select class="form-control form-control-sm col-md-9"
                                                                        name="ds_jk" id="ds_jk" required>
                                                                        <option value="Laki-laki">Laki-laki</option>
                                                                        <option value="Perempuan">Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for=""
                                                                        class="req col-md-3">Agama</label>
                                                                    <select class="col-md-9 form-control form-control-sm"
                                                                        name="ds_agama" id="ds_agama" required>
                                                                        <option value="">-- Pilih --</option>
                                                                        <?php $__currentLoopData = $agama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($agm->agm_nama); ?>">
                                                                                <?php echo e($agm->agm_nama); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Tempat
                                                                        Lahir</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="ds_tempat_lahir" id="ds_tempat_lahir"
                                                                        value="<?php echo e($dosen->ds_tempat_lahir); ?>" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for="" class="req col-md-3">Tanggal
                                                                        Lahir</label>
                                                                    <input type="date"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="ds_tgl_lahir" id="ds_tgl_lahir"
                                                                        value="<?php echo e($dosen->ds_tgl_lahir); ?>" required>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <label for=""
                                                                        class="req col-md-3">Jabatan</label>
                                                                    <input type="text"
                                                                        class="col-md-9 form-control form-control-sm"
                                                                        name="ds_jabatan" id="ds_jabatan"
                                                                        value="<?php echo e($dosen->ds_jabatan); ?>" required>
                                                                    <div class="col-md-3"></div>
                                                                    <div class="text-help col-md-9">Lektor,
                                                                        Asisten
                                                                        Ahli,
                                                                        dll.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-right">
                                                                <hr>
                                                                <button type="submit"
                                                                    class="btn btn-out-dashed btn-success btn-square"> <i
                                                                        class="ti-save"></i> Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="biodata1" role="tabpanel">
                                            <form action="<?php echo e($action); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="update_tipe" value="2">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">NIK</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_nik" id="ds_nik"
                                                                value="<?php echo e($dosen->ds_nik); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">NPWP</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_npwp" id="ds_npwp"
                                                                value="<?php echo e($dosen->ds_npwp); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Nomor
                                                                Registrasi</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_no_regis" id="ds_no_regis"
                                                                value="<?php echo e($dosen->ds_no_regis); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Ikatan Kerja</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_ikatan_kerja" id="ds_ikatan_kerja"
                                                                value="<?php echo e($dosen->ds_ikatan_kerja); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Status Pegawai</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_status_pegawai" id="ds_status_pegawai"
                                                                value="<?php echo e($dosen->ds_status_pegawai); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Jenis Pegawai</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_jenis_pegawai" id="ds_jenis_pegawai"
                                                                value="<?php echo e($dosen->ds_jenis_pegawai); ?>">
                                                        </div>
                                                        <div class="row form-group" style="display: none">
                                                            <label for="" class="col-md-3">No. SK CPNS</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_no_sk_cpns" id="ds_no_sk_cpns"
                                                                value="<?php echo e($dosen->ds_no_sk_cpns); ?>">
                                                        </div>
                                                        <div class="row form-group" style="display: none">
                                                            <label for="" class="col-md-3">Tanggal SK CPNS</label>
                                                            <input type="date"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_tgl_sk_cpns" id="ds_tgl_sk_cpns"
                                                                value="<?php echo e($dosen->ds_tgl_sk_cpns); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">No. SK
                                                                Pengangkatan</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_no_sk_peng" id="ds_no_sk_peng"
                                                                value="<?php echo e($dosen->ds_no_sk_peng); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Tanggal SK
                                                                Pengangkatan</label>
                                                            <input type="date"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_tgl_sk_peng" id="ds_tgl_sk_peng"
                                                                value="<?php echo e($dosen->ds_tgl_sk_peng); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Lembaga
                                                                Pengangkat</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_lembaga_peng" id="ds_lembaga_peng"
                                                                value="<?php echo e($dosen->ds_lembaga_peng); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Fungsional</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_pangkat" id="ds_pangkat"
                                                                value="<?php echo e($dosen->ds_pangkat); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Golongan /
                                                                Inpassing</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_gol" id="ds_gol"
                                                                value="<?php echo e($dosen->ds_gol); ?>">
                                                        </div>
                                                        <div class="row form-group" style="display: none">
                                                            <label for="" class="col-md-3">Sumber Gaji</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_sumber_gaji" id="ds_sumber_gaji"
                                                                value="<?php echo e($dosen->ds_sumber_gaji); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Alamat</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_alamat" id="ds_alamat"
                                                                value="<?php echo e($dosen->ds_alamat); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">RT</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_rt" id="ds_rt"
                                                                value="<?php echo e($dosen->ds_rt); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">RW</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_rw" id="ds_rw"
                                                                value="<?php echo e($dosen->ds_rw); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Dusun</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_dusun" id="ds_dusun"
                                                                value="<?php echo e($dosen->ds_dusun); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Kode POS</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_kode_pos" id="ds_kode_pos"
                                                                value="<?php echo e($dosen->ds_kode_pos); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Kelurahan /
                                                                Desa</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_kelurahan" id="ds_kelurahan"
                                                                value="<?php echo e($dosen->ds_kelurahan); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Kecamatan</label>
                                                            <div class="col-md-9" style="padding: 0 !important">
                                                                <table style="width: 100%">
                                                                    <tr>
                                                                        <td>
                                                                            <select class="form-control"
                                                                                name="ds_kecamatan" id="ds_kecamatan">
                                                                                <option
                                                                                    value="<?php echo e(@$dosen->ds_kecamatan); ?>"
                                                                                    selected="selected">
                                                                                    <?php echo e(@$dosen->kecamatan->kec_nama . ' - ' . @$dosen->kecamatan->kec_kabkota); ?>

                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>

                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">No. Telepon
                                                                (Kontak)</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_tlp" id="ds_tlp"
                                                                value="<?php echo e($dosen->ds_tlp); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-3">Email</label>
                                                            <input type="text"
                                                                class="col-md-9 form-control form-control-sm"
                                                                name="ds_email" id="ds_email"
                                                                value="<?php echo e($dosen->ds_email); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-right">
                                                        <hr>
                                                        <button type="submit"
                                                            class="btn btn-out-dashed btn-success btn-square"> <i
                                                                class="ti-save"></i> Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="keluarga1" role="tabpanel">
                                            <form action="<?php echo e($action); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="update_tipe" value="3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-2 req">Status
                                                                Pernikahan</label>
                                                            <select class="form-control form-control-sm col-md-10"
                                                                name="ds_status_nikah" id="ds_status_nikah"
                                                                onchange="cekNikah(this)" required>
                                                                <option value="">-- Pilih --</option>
                                                                <option value="0">Belum Menikah</option>
                                                                <option value="1">Sudah Menikah</option>
                                                            </select>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-2">Nama Pasangan</label>
                                                            <input type="text"
                                                                class="col-md-10 form-control form-control-sm form-nikah"
                                                                name="ds_pasangan_nama" id="ds_pasangan_nama"
                                                                value="<?php echo e($dosen->ds_pasangan_nama); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-2">NIP Pasangan</label>
                                                            <input type="text"
                                                                class="col-md-10 form-control form-control-sm form-nikah"
                                                                name="ds_pasangan_nip" id="ds_pasangan_nip"
                                                                value="<?php echo e($dosen->ds_pasangan_nip); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-2">TMT PNS</label>
                                                            <input type="text"
                                                                class="col-md-10 form-control form-control-sm form-nikah"
                                                                name="ds_pasangan_tmt" id="ds_pasangan_tmt"
                                                                value="<?php echo e($dosen->ds_pasangan_tmt); ?>">
                                                        </div>
                                                        <div class="row form-group">
                                                            <label for="" class="col-md-2">Pekerjaan</label>
                                                            <input type="text"
                                                                class="col-md-10 form-control form-control-sm form-nikah"
                                                                name="ds_pasangan_pekerjaan" id="ds_pasangan_pekerjaan"
                                                                value="<?php echo e($dosen->ds_pasangan_pekerjaan); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-right">
                                                        <hr>
                                                        <button type="submit"
                                                            class="btn btn-out-dashed btn-success btn-square"> <i
                                                                class="ti-save"></i> Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_foto" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icofont icofont-ui-user"></i>
                        Ganti Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e($actionFoto); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12" style="overflow: auto">
                                <div class="form-group">
                                    <label for="">File Foto</label>
                                    <input type="file" class="form-control mb-2" name="foto" required>
                                    <span><code>Gunakan gambar dengan tipe .jpg atau .png</code></span>
                                    <br><span><code>Rekomendasi rasio 3 x 4; Max : 2 Mb</code></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect btn-round"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary waves-effect btn-round">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_lib.select2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        <?php if(@$isKaprodi): ?>
            $('#mn7').addClass('active');
            $('#mn7').addClass('active pcoded-trigger');
            $('#mn71').addClass('active');
        <?php else: ?>
            $('<?php echo e($mn); ?>').addClass('active');
        <?php endif; ?>


        $(document).ready(function() {
            $('#ds_jk').val("<?php echo e($dosen->ds_jk); ?>");
            $('#ds_agama').val("<?php echo e($dosen->ds_agama); ?>");
            $('#ds_status_nikah').val("<?php echo e($dosen->ds_status_nikah); ?>");
            $('#ds_pendidikan').val("<?php echo e($dosen->ds_pendidikan); ?>");
            $('.select2').select2();
            $('#ds_kelurahan').val("<?php echo e($dosen->ds_kelurahan); ?>");
            $('#ds_kelurahan').trigger('change');
            initKecamatan();
        });

        function cekNikah(ob) {
            let kons = $(ob).val();
            // kunciForm(kons);
        }

        // function kunciForm(kons = 0) {
        //     if (kons != 1) {
        //         $('.form-nikah').val('-');
        //         $('.form-nikah').attr('readonly', 'readonly');
        //     } else {
        //         $('.form-nikah').removeAttr('readonly');
        //     }
        // }

        function initKecamatan() {
            $('#ds_kecamatan').select2({
                placeholder: 'Cari...',
                minimumInputLength: 3,
                ajax: {
                    url: "<?php echo e(route('data.kecamatan.cari')); ?>",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kec_nama + ' - ' + item.kec_kabkota,
                                    id: item.kec_id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }

        function initFoto() {
            $('#modal_foto').modal('show');
        }

        <?php if($guard == 'admin' || @$isKaprodi): ?>
            let input1 = '<input type="hidden" name="ds_id" id="" value="<?php echo e($dosen->ds_id); ?>">';
            $('form').append(input1);
        <?php endif; ?>

        <?php if(@$isBiodata): ?>
            let input2 = '<input type="hidden" name="isBiodata" id="" value="true">';
            $('form').append(input2);
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\siadek_beta\resources\views/pages/data_dosen.blade.php ENDPATH**/ ?>