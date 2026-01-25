<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageName', 'Dashboard'); ?>
<?php $__env->startSection('body'); ?>
    <?php
        $ds = Auth::user();
    ?>
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Dashboard</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="<?php echo e(asset($appData->app_logo)); ?>" alt="" style="width: 230px">
                </div>
                <div class="col-md-12 text-center mb-5 mt-3">
                    <h5 class="cfont1"><?php echo e($appData->app_author); ?></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="row simple-cards users-card">
                        <div class="col-md-12">
                            <div class="card user-card">
                                <div class="card-header-img">
                                    <img class="img-fluid img-radius" src="<?php echo e(asset($dosen->ds_foto)); ?>" alt="Foto"
                                        style="width: 120px">
                                    <h4><?php echo e($dosen->ds_nama); ?>, <?php echo e($dosen->ds_gelar); ?></h4>
                                    <h5><a href="" class="">[<?php echo e($dosen->ds_nip); ?>]</a>
                                    </h5>
                                    <h6>
                                        <?php if($dosen->ds_level == 1): ?>
                                            Ketua Jurusan/Prodi
                                        <?php else: ?>
                                            <?php echo e($dosen->ds_jabatan); ?>

                                        <?php endif; ?>
                                    </h6>
                                    <h6 class="text-warning">
                                        <?php echo e($dosen->jurusan->jur_nama); ?> (<?php echo e($dosen->jurusan->jur_jenjang); ?>)
                                    </h6>
                                </div>

                                <div>
                                    <a href="<?php echo e(route('lecturer.jadwal')); ?>"
                                        class="btn btn-primary waves-effect waves-light m-r-15"><i
                                            class="icofont icofont-clock-time m-r-5"></i>Jadwal</a>
                                    <a href="<?php echo e(route('lecturer.dataDiri')); ?>"
                                        class="btn btn-success waves-effect waves-light"><i
                                            class="icofont icofont-user m-r-5"></i>Biodata</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="card bg-c-blue text-white widget-visitor-card">
                                <div class="card-block-small text-center">
                                    <h2><?php echo e($matkul); ?></h2>
                                    <h6>Mata Kuliah</h6>
                                    <i class="feather icon-file-text"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo e(route('lecturer.mahasiswa')); ?>">
                                <div class="card bg-c-yellow text-white widget-visitor-card">
                                    <div class="card-block-small text-center">
                                        <h2><?php echo e(@count($dosen->mahasiswas)); ?></h2>
                                        <h6>Mahasiswa Bimbingan</h6>
                                        <i class="feather icon-award"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php if($ds->ds_level == 1): ?>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-auto">
                                                <i class="feather icon-users f-30 text-c-blue"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h6 class="text-muted m-b-10">Jumlah Dosen</h6>
                                                <h2 class="m-b-0"><?php echo e($jml_dosen); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a onclick="initMhs()" style="cursor: pointer;">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="row align-items-center m-l-0">
                                                <div class="col-auto">
                                                    <i class="feather icon-users f-30 text-c-pink"></i>
                                                </div>
                                                <div class="col-auto">
                                                    <h6 class="text-muted m-b-10">Jumlah Mahasiswa</h6>
                                                    <h2 class="m-b-0"><?php echo e($jml_mhs); ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3"><strong>Rekapitulasi Mahasiswa</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $mhs_by_sts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data5): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $iconMapping = [
                                                                'Aktif' => ['icon' => 'icofont-verification-check', 'color' => 'text-success'],
                                                                'Non Aktif' => ['icon' => 'icofont-ban', 'color' => 'text-warning'],
                                                                'Lulus' => ['icon' => 'icofont-hat-alt', 'color' => 'text-primary'],
                                                                'Cuti' => ['icon' => 'icofont-ui-calendar', 'color' => 'text-info'],
                                                                'Keluar/Mengundurkan diri' => ['icon' => 'icofont-external-link', 'color' => 'text-danger'],
                                                                'Tanpa Keterangan' => ['icon' => 'icofont-info-circle', 'color' => 'text-muted'],
                                                            ];
                                                            $stsIcon = $iconMapping[$data5['status']] ?? ['icon' => 'icofont-info-circle', 'color' => 'text-muted'];
                                                        ?>
                                                        <tr>
                                                            <td><i class="icofont <?php echo e($stsIcon['icon']); ?> <?php echo e($stsIcon['color']); ?> m-r-10 f-18"></i> <?php echo e($data5['status']); ?></td>
                                                            <td><?php echo e($data5['jml']); ?></td>
                                                            <td>Mahasiswa</td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="modal fade" id="modal1" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content border-top-2">
                <div class="modal-header">
                    <h5 class="modal-title">Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="">
                    <div class="row">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center">Angkatan</th>
                                    <th class="text-center">Jumlah Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $countMhs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($cmhs['mhs_angg']); ?></td>
                                        <td class="text-center"><?php echo e($cmhs['mhs_jml']); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect btn-round"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $('#mn1').addClass('active');
        //   $('#mn2').addClass('active pcoded-trigger');
        //   $('#mn2-1').addClass('active');

        function initMhs() {
            $('#modal1').modal('show');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\siadek_beta\resources\views/dosen/index.blade.php ENDPATH**/ ?>