<?php
    $guard = Auth::getDefaultDriver();
?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageName', 'Kemahasiswaan'); ?>
<?php $__env->startSection('body'); ?>
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Kemahasiswaan</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Kemahasiswaan</a>
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
                        <div class="card-header">
                            <h5><i class="icofont icofont-hat-alt"></i> Menu Kemahasiswaan</h5>
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
                            <form id="form-mhs" action="<?php echo e(route('pro.mahasiswa.cek-menu')); ?>" method="POST"
                                target="_blank">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="tipe" id="tipe">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Jurusan / Prodi</label>
                                                    <?php echo $__env->make('_komponen.form_pilih_jurusan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Mahasiswa</label>
                                                    <select class="form-control form-control-sm" name="mhs_id"
                                                        id="mhs_id" required>
                                                        <option value="">-- Pilih --</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Tahun Ajaran</label>
                                                    <select class="form-control form-control-sm" name="ta_id"
                                                        id="ta_id" required>
                                                        <option value="">-- Pilih --</option>
                                                        <?php $__currentLoopData = $tas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($ta->ta_id); ?>">
                                                                <?php echo e($ta->ta_kode); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 28px;">
                                        <button type="button" onclick="initForm1('krs')"
                                            class="btn btn-block btn-grd-primary"><i class="ti-file"></i> Cetak
                                            KRS</button><br>
                                        <button type="button" onclick="initForm1('khs')"
                                            class="btn btn-block btn-grd-info"><i class="ti-file"></i> Cetak
                                            KHS</button><br>
                                        <button type="button" onclick="initForm1('trans')"
                                            class="btn btn-block btn-grd-success"><i class="ti-file"></i> Cetak
                                            Transkrip</button>
                                    </div>
                                </div>
                                <input type="submit" style="display: none" id="btn-submit1">
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
        let localJurusanID = 'all';
        <?php if($guard == 'admin'): ?>
            $('#mn6').addClass('active');
        <?php else: ?>
            $('#mn8').addClass('active');
            localJurusanID = '<?php echo e($jurusan[0]->jur_id); ?>';

            let vall =
                `<option value="<?php echo e($jurusan[0]->jur_id); ?>" selected="selected"><?php echo e($jurusan[0]->jur_nama); ?> - (<?php echo e($jurusan[0]->jur_jenjang); ?>)</option>`;
            $('#jur_pilih').html(vall);
        <?php endif; ?>

        $(document).ready(function() {
            initMhs();
        });

        function initPilihJurusan(ob) {
            localJurusanID = $(ob).val();
            // initTable();
        }

        function initMhs() {
            $('#mhs_id').select2({
                placeholder: 'Cari berdasarkan NIM atau Nama ..',
                minimumInputLength: 3,
                ajax: {
                    url: "<?php echo e(route('pro.mahasiswa.cari')); ?>/" + localJurusanID,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.mhs_nama + ' - (' + item.mhs_nim + ') - ' + item
                                        .mhs_angkatan,
                                    id: item.mhs_id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }

        function initForm1(tipe) {
            $('#tipe').val(tipe);
            $('#btn-submit1').trigger('click');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\siadek_beta\resources\views/pages/kemahasiswaan.blade.php ENDPATH**/ ?>