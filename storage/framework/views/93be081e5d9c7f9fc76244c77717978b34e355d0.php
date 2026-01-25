<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageName', 'Jurusan'); ?>
<?php $__env->startSection('body'); ?>
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Jurusan</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Unit</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Jurusan</a>
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
                    <div class="card b-l-info">
                        <div class="card-header">
                            <h5> <i class="icofont icofont-tasks-alt text-primary"></i> Data Jurusan</h5>
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
                            <div class="row">

                                <div class="col-12 mb-3">
                                    <button type="button" onclick="initAdd()"
                                        class="btn btn-sm btn-success btn-outline-success btn-round"><i
                                            class="icofont icofont-ui-add"></i> Tambah Data</button>
                                </div>
                                <div class="col-12">
                                    <table id="tbl1" class="table table-hover" style="font-size: 10pt">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Kode</th>
                                                <th>Nama Jurusan/Prodi</th>
                                                <th>Jenjang</th>
                                                <th>Pimpinan</th>
                                                <th width="100" class="text-center">Alamat</th>
                                                <th width="100" class="text-center">Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_add" role="dialog" aria-labelledby="modal_add" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-top-1">
                <form id="form-jur" action="#" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="jur_id" id="jur_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> <span
                                class="modal_title">Tambah</span> Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <label for="" class="req">Kode</label>
                                    <input type="text" class="form-control form-control-sm" name="jur_kode"
                                        id="jur_kode" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Nama</label>
                                    <input type="text" class="form-control form-control-sm" name="jur_nama"
                                        id="jur_nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Jenjang</label>
                                    <select class="form-control form-control-sm" name="jur_jenjang" id="jur_jenjang"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                        <option value="Profesi">Profesi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Pimpinan / Kaprodi</label>
                                    <select class="col-sm-12 select2" name="jur_pimpinan_id" id="jur_pimpinan_id">
                                        <option value="">-- Pilih --</option>
                                        <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($dosen->ds_id); ?>"><?php echo e($dosen->ds_nama); ?> (<?php echo e($dosen->ds_nip); ?>)
                                                - <?php echo e($dosen->jurusan->jur_nama); ?> (<?php echo e($dosen->jurusan->jur_jenjang); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group d-none">
                                    <label for="" class="req">Alamat</label>
                                    <input type="text" class="form-control form-control-sm" name="jur_alamat"
                                        id="jur_alamat" value="-">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default waves-effect btn-round"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-info waves-effect btn-round"><i
                                class="icofont icofont-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('_lib.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('_lib.select2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $('#mn3').addClass('active');
        $('#mn3').addClass('active pcoded-trigger');
        $('#mn32').addClass('active');
        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            $('#jur_pimpinan_id').select2({
                dropdownParent: $("#modal_add")
            });

            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "<?php echo e(route('data.jurusan')); ?>",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    // {
                    //     data: 'fakultas.fk_nama',
                    //     name: 'fakultas.fk_nama'
                    // },
                    {
                        data: 'jur_kode',
                        name: 'jur_kode'
                    },
                    {
                        data: 'jur_nama',
                        name: 'jur_nama'
                    },
                    {
                        data: 'jur_jenjang',
                        name: 'jur_jenjang',
                        className: 'text-center'
                    },
                    {
                        data: 'pimpinan.ds_nama',
                        name: 'pimpinan.ds_nama',
                        render: function(data, type, row) {
                            if (data) {
                                return `<i class="icofont icofont-user-suited text-info"></i> ` +
                                    data;
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'jur_alamat',
                        name: 'jur_alamat'
                    },
                    {
                        data: 'menu',
                        name: 'menu',
                        searchable: false,
                        className: 'text-center',
                        orderable: false
                    },
                ]
            });

        });

        function initAdd() {
            $('.modal_title').html('Tambah');
            $('#form-jur').trigger('reset');
            $('#jur_pimpinan_id').trigger('change');
            $('#form-jur').attr('action', "<?php echo e(route('admin.jurusan.create')); ?>");
            $('#modal_add').modal('show');
        }

        async function initEdit(id) {
            $('.modal_title').html('Edit');
            $('#form-jur').trigger('reset');
            $('#form-jur').attr('action', "<?php echo e(route('admin.jurusan.update')); ?>");
            let res = await sendAjax("<?php echo e(route('admin.jurusan.get')); ?>/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
                $('#modal_add').modal('show');
            } else {
                alertError(res.msg);
            }
        }

        function isiData(data) {
            $('#jur_id').val(data.jur_id);
            $('#jur_nama').val(data.jur_nama);
            $('#jur_alamat').val(data.jur_alamat);
            $('#jur_pimpinan_id').val(data.jur_pimpinan_id);
            $('#jur_kode').val(data.jur_kode);
            $('#jur_pimpinan_id').trigger('change');
            $('#jur_jenjang').val(data.jur_jenjang);
        }

        $('#form-jur').on('submit', async function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let url = $(this).attr('action');
            let res = await sendAjax(url, data);
            if (res.status) {
                $(this).trigger('reset');
                $('#tbl1').DataTable().ajax.reload();
                $('#modal_add').modal('hide');
                alertSuccess(res.msg);
            } else {
                $('#modal_add').modal('hide');
                alertError(res.msg);
                console.log(res);
            }
        });

        async function deleteJurusan(idx) {
            let res = await sendAjax("<?php echo e(route('admin.jurusan.delete')); ?>", {
                id: idx
            });
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\siadek_beta\resources\views/admin/jurusan.blade.php ENDPATH**/ ?>