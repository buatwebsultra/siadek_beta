@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Fakultas')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Fakultas</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Fakultas</a>
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
                            <h5> <i class="icofont icofont-tasks-alt text-primary"></i> Data Fakultas</h5>
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
                                                <th>Fakultas</th>
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
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content border-top-1">
                <form id="form-fk" action="#" method="POST">
                    @csrf
                    <input type="hidden" name="fk_id" id="fk_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> <span
                                class="modal_title">Tambah</span> Fakultas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Nama</label>
                                    <input type="text" class="form-control" name="fk_nama" id="fk_nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Pimpinan</label>
                                    <select class="col-sm-12 select2" name="fk_pimpinan_id" id="fk_pimpinan_id">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->ds_id }}">{{ $dosen->ds_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Alamat</label>
                                    <input type="text" class="form-control" name="fk_alamat" id="fk_alamat" required>
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

@endsection
@include('_lib.datatable')
@include('_lib.select2')
@section('script')
    <script type="text/javascript">
        $('#mn3').addClass('active');
        $('#mn3').addClass('active pcoded-trigger');
        $('#mn31').addClass('active');
        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            $('#fk_pimpinan_id').select2({
                dropdownParent: $("#modal_add")
            });
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "{{ route('data.fakultas') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'fk_nama',
                        name: 'fk_nama'
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
                        data: 'fk_alamat',
                        name: 'fk_alamat'
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
            $('#form-fk').trigger('reset');
            $('#fk_pimpinan_id').trigger('change');
            $('#form-fk').attr('action', "{{ route('admin.fakultas.create') }}");
            $('#modal_add').modal('show');
        }

        async function initEdit(id) {
            $('.modal_title').html('Edit');
            $('#form-fk').trigger('reset');
            $('#form-fk').attr('action', "{{ route('admin.fakultas.update') }}");
            let res = await sendAjax("{{ route('admin.fakultas.get') }}/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
                $('#modal_add').modal('show');
            } else {
                alertError(res.msg);
            }
        }

        function isiData(data) {
            $('#fk_id').val(data.fk_id);
            $('#fk_nama').val(data.fk_nama);
            $('#fk_alamat').val(data.fk_alamat);
            $('#fk_pimpinan_id').val(data.fk_pimpinan_id);
            $('#fk_pimpinan_id').trigger('change');
        }

        $('#form-fk').on('submit', async function(e) {
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

        async function deleteFakultas(idx) {
            let res = await sendAjax("{{ route('admin.fakultas.delete') }}", { id: idx });
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
        }
    </script>
@endsection
