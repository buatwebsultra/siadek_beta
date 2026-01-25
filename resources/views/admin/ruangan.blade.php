@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Ruangan')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Ruangan</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Ruangan</a>
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
                            <h5><i class="icofont icofont-building-alt text-primary"></i> Data Ruangan</h5>
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
                                <div class="col-md-12 mb-3">
                                    <button type="button" onclick="initAdd()"
                                        class="btn btn-sm btn-success btn-outline-success btn-round"><i
                                            class="icofont icofont-ui-add"></i> Tambah Data</button>
                                </div>
                                <div class="col-md-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover" style="font-size: 10pt">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Ruangan</th>
                                                <th>Lokasi</th>
                                                <th class="text-center">Kapasitas (Orang)</th>
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

    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content border-top-1">
                <form id="form-ruang" action="#" method="POST">
                    @csrf
                    <input type="hidden" name="ruang_id" id="ruang_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> <span
                                class="modal_title">Tambah</span> Ruangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Nama Ruangan</label>
                                    <input type="text" class="form-control form-control-sm" name="ruang_nama"
                                        id="ruang_nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Lokasi</label>
                                    <input type="text" class="form-control form-control-sm" name="ruang_lokasi"
                                        id="ruang_lokasi" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Kapasitas (Orang)</label>
                                    <input type="number" class="form-control form-control-sm" name="ruang_kapasitas"
                                        id="ruang_kapasitas" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="">Keterangan</label>
                                    <input type="text" class="form-control form-control-sm" name="ruang_ket"
                                        id="ruang_ket">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect btn-round"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info waves-effect btn-round"><i
                                class="icofont icofont-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@include('_lib.datatable')
@section('script')
    <script type="text/javascript">
        $('#mn3').addClass('active');
        $('#mn3').addClass('active pcoded-trigger');
        $('#mn33').addClass('active');

        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "{{ route('data.ruangan') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'ruang_nama',
                        name: 'ruang_nama'
                    },
                    {
                        data: 'ruang_lokasi',
                        name: 'ruang_lokasi'
                    },
                    {
                        data: 'ruang_kapasitas',
                        name: 'ruang_kapasitas',
                        className: 'text-center'
                    },
                    {
                        data: 'menu',
                        name: 'menu',
                        className: 'text-center',
                        searchable: false,
                        orderable: false
                    },
                ]
            });
        });

        function initAdd() {
            $('.modal_title').html('Tambah');
            $('#form-ruang').trigger('reset');
            $('#form-ruang').attr('action', "{{ route('admin.ruangan.create') }}");
            $('#modal_add').modal('show');
        }

        async function initEdit(id) {
            $('.modal_title').html('Edit');
            $('#form-ruang').trigger('reset');
            $('#form-ruang').attr('action', "{{ route('admin.ruangan.update') }}");
            let res = await sendAjax("{{ route('data.ruangan.get') }}/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
                $('#modal_add').modal('show');
            } else {
                alertError(res.msg);
            }
        }

        function isiData(data) {
            $('#ruang_id').val(data.ruang_id);
            $('#ruang_nama').val(data.ruang_nama);
            $('#ruang_lokasi').val(data.ruang_lokasi);
            $('#ruang_kapasitas').val(data.ruang_kapasitas);
            $('#ruang_ket').val(data.ruang_ket);
        }

        $('#form-ruang').on('submit', async function(e){
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
            }
        });

        async function deleteRuang(idx) {
            let res = await sendAjax("{{ route('admin.ruangan.delete') }}", { id: idx });
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                $('#modal_add').modal('hide');
                alertError(res.msg);
            }
        }
    </script>
@endsection
