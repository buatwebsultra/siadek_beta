<?php
    $guard = Auth::getDefaultDriver();
?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageName', 'Laporan'); ?>
<?php $__env->startSection('body'); ?>
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Laporan</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Laporan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5>Laporan Pengajar</h5>
                            <hr>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="feather icon-maximize full-card"></i>
                                    </li>
                                    <li><i class="feather icon-minus minimize-card"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <form action="<?php echo e(route('pro.laporan.pengajar')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tahun Ajaran</label>
                                            <select class="form-control" name="ta_pilih" id="" required>
                                                <option value="">-- Pilih --</option>
                                                <?php $__currentLoopData = $tas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($ta->ta_id); ?>"><?php echo e($ta->ta_kode); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Program Studi</label>
                                            <select class="col-sm-12 select2" name="jur_pilih" id="jur_pilih" required>
                                                <?php if($guard == 'admin'): ?>
                                                    <option value="all">-- Semua Prodi --</option>
                                                <?php endif; ?>
                                                <?php $__currentLoopData = $jurusans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($jur->jur_id); ?>"><?php echo e($jur->jur_nama); ?> -
                                                        (<?php echo e($jur->jur_jenjang); ?>)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Generate</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-left-1">
                        <div class="card-header">
                            <h5>Laporan Mahasiswa</h5>
                            <hr>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="feather icon-maximize full-card"></i>
                                    </li>
                                    <li><i class="feather icon-minus minimize-card"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <form action="<?php echo e(route('pro.laporan.mahasiswa')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tahun Ajaran</label>
                                            <select class="form-control" name="ta_pilih" id="" required>
                                                <option value="">-- Pilih --</option>
                                                <?php $__currentLoopData = $tas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($ta->ta_id); ?>"><?php echo e($ta->ta_kode); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Program Studi</label>
                                            <select class="col-sm-12 select2" name="jur_pilih" id="jur_pilih" required>
                                                <?php if($guard == 'admin'): ?>
                                                    <option value="all">-- Semua Prodi --</option>
                                                <?php endif; ?>
                                                <?php $__currentLoopData = $jurusans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($jur->jur_id); ?>"><?php echo e($jur->jur_nama); ?> -
                                                        (<?php echo e($jur->jur_jenjang); ?>)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Generate</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('_lib.select2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $('#mn-lap').addClass('active');
        <?php if($guard == 'lecturer'): ?>
            $('#mn7').addClass('active');
            $('#mn7').addClass('active pcoded-trigger');
        <?php endif; ?>

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\siadek_beta\resources\views/pages/laporan.blade.php ENDPATH**/ ?>