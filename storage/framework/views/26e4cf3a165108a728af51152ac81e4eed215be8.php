<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageName', 'Pengaturan'); ?>
<?php $__env->startSection('body'); ?>
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Pengaturan</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Pengaturan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-left-1">
                        <div class="card-block">
                            <div class="col-12">
                                <ul class="nav nav-tabs md-tabs " role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><i
                                                class="icofont icofont-ui-home"></i> Web</a>
                                        <div class="slide"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-logo" data-toggle="tab" href="#tab2"
                                            role="tab"><i class="icofont icofont-image"></i> Logo & Icon</a>
                                        <div class="slide"></div>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content card-block">
                                    <div class="tab-pane active" id="tab1" role="tabpanel">
                                        <form action="<?php echo e(route('admin.app.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="req">Nama</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="app_nama" id="app_nama" value="<?php echo e($appData->app_nama); ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="req">Deskripsi</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="app_desc" id="app_desc" value="<?php echo e($appData->app_desc); ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="req">Instansi/Lembaga</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="app_author" id="app_author"
                                                            value="<?php echo e($appData->app_author); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="req">Email</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="app_email" id="app_email"
                                                            value="<?php echo e($appData->app_email); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="req">No Telepon</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="app_tlp" id="app_tlp" value="<?php echo e($appData->app_tlp); ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="req">Alamat</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="app_alamat" id="app_alamat"
                                                            value="<?php echo e($appData->app_alamat); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-right">
                                                    <hr>
                                                    <button type="submit" class="btn btn-out btn-success btn-square"><i
                                                            class="icofont icofont-save"></i> Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tab2" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <form class="row" method="POST"
                                                    action="<?php echo e(route('admin.app.updateLogo')); ?>"
                                                    enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="tipe" value="logo">
                                                    <div class="col-md-12 mb-3 text-center" style="min-height: 100px;">
                                                        <img src="<?php echo e(asset($appData->app_logo)); ?>" style="width: 80%">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="" class="req">Logo (Hitam)</label>
                                                            <input type="file" class="form-control form-control-sm"
                                                                name="gbr" id="app_logo" required>
                                                            <span><code>Gunakan gambar dengan tipe .PNG</code></span>
                                                            <br><span><code>Rekomendasi ukuran 1290 x 320; Max : 300 Kb</code></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-sm btn-mat btn-success"><i
                                                                class="icofont icofont-save"></i> Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <form class="row" method="POST"
                                                    action="<?php echo e(route('admin.app.updateLogo')); ?>"
                                                    enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="tipe" value="logow">
                                                    <div class="col-md-12 mb-3 text-center"
                                                        style="background-color: #c7c7c7 !important;min-height: 100px;">
                                                        <img src="<?php echo e(asset($appData->app_logo_w)); ?>" style="width: 80%">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="" class="req">Logo (Putih)</label>
                                                            <input type="file" class="form-control form-control-sm"
                                                                name="gbr" id="app_logo_w" required>
                                                            <span><code>Gunakan gambar dengan tipe .PNG</code></span>
                                                            <br><span><code>Rekomendasi ukuran 1290 x 320; Max : 300 Kb</code></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-sm btn-mat btn-success"><i
                                                                class="icofont icofont-save"></i> Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <form class="row" method="POST"
                                                    action="<?php echo e(route('admin.app.updateLogo')); ?>"
                                                    enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="tipe" value="icon">
                                                    <div class="col-md-12 mb-3 text-center" style="min-height: 100px;">
                                                        <img src="<?php echo e(asset($appData->app_icon)); ?>" style="width: 25%">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="" class="req">Icon</label>
                                                            <input type="file" class="form-control form-control-sm"
                                                                name="gbr" id="app_icon" required>
                                                            <span><code>Gunakan gambar dengan tipe .PNG</code></span>
                                                            <br><span><code>Rekomendasi ukuran 320 x 320; Max : 300 Kb</code></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-sm btn-mat btn-success"><i
                                                                class="icofont icofont-save"></i> Simpan</button>
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
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $('#mn7').addClass('active');

        <?php if(session('isLogo')): ?>
            $('#tab-logo').trigger('click');
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\siadek_beta\resources\views/admin/pengaturan.blade.php ENDPATH**/ ?>