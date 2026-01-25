@php
    $guard = Auth::getDefaultDriver();
@endphp
@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Dosen/Pengajar')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Dosen/Pengajar</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Dosen.Pengajar</a>
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
                            <h5> <i class="icofont icofont-tasks-alt text-primary"></i> Data Dosen/Pengajar</h5>
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
                                @if ($guard == 'admin')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @include('_komponen.form_pilih_jurusan', $jurusan)
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-2 mb-3">
                                    <button type="button" onclick="initAdd()"
                                        class="btn btn-block btn-sm btn-success btn-outline-success"><i
                                            class="icofont icofont-ui-add"></i> Tambah Data</button>
                                </div>

                                <div class="col-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover table-striped"
                                        style="font-size: 10pt; width: 100%">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Nama</th>
                                                <th>Jurusan/Prodi</th>
                                                <th>Jabatan</th>
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
                <form id="form-ds" action="#" method="POST">
                    @csrf
                    <input type="hidden" name="ds_id" id="ds_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> <span
                                class="modal_title">Tambah</span> Dosen/Pengajar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Fakultas</label>
                                    <select class="col-sm-12 select2" name="ds_fk_id" id="ds_fk_id" required>
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Jurusan</label>
                                    <select class="col-sm-12 select2" name="ds_jur_id" id="ds_jur_id" required>
                                        <option value="">-- Pilih --</option>
                                        @if ($guard == 'admin')
                                            @foreach ($jurusan as $jur)
                                                <option value="{{ $jur->jur_id }}">{{ $jur->jur_nama }} -
                                                    ({{ $jur->jur_jenjang }})
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="{{ $dosen->jurusan->jur_id }}">{{ $dosen->jurusan->jur_nama }} -
                                                ({{ $dosen->jurusan->jur_jenjang }})
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">NIDN</label>
                                    <input type="text" class="form-control form-control-sm"
                                        onchange="clearWhiteSpace(this)" name="ds_nip" id="ds_nip" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Nama (Tanpa Gelar)</label>
                                    <input type="text" class="form-control form-control-sm" name="ds_nama" id="ds_nama"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Gelar</label>
                                    <input type="text" class="form-control form-control-sm" name="ds_gelar"
                                        id="ds_gelar" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Pendidikan</label>
                                    <select class="form-control form-control-sm" name="ds_pendidikan" id="ds_pendidikan"
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Jabatan</label>
                                    <input type="text" class="form-control form-control-sm" name="ds_jabatan"
                                        id="ds_jabatan" required>
                                    <span class="text-help">Lektor, Asisten Ahli, dll.</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">No. Telepon</label>
                                    <input type="text" class="form-control form-control-sm" name="ds_tlp"
                                        id="ds_tlp" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Alamat</label>
                                    <input type="text" class="form-control form-control-sm" name="ds_alamat"
                                        id="ds_alamat" required>
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
        let localJurusanID = 'all';
        @if ($guard == 'admin')
            $('#mn4').addClass('active');
        @else
            $('#mn7').addClass('active');
            $('#mn7').addClass('active pcoded-trigger');
            $('#mn71').addClass('active');
            localJurusanID = '{{ $dosen->ds_jur_id }}';
        @endif

        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            $('#ds_jur_id').select2({
                dropdownParent: $("#modal_add")
            });
            $('#ds_fk_id').select2({
                dropdownParent: $("#modal_add")
            });
            initDataTable();
        });

        function initDataTable() {
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "{{ route('data.dosen') }}/" + localJurusanID,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'namanip',
                        name: 'namanip'
                    },
                    {
                        data: 'jurprodi',
                        name: 'jurprodi'
                    },
                    {
                        data: 'ds_jabatan',
                        name: 'ds_jabatan'
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
        }

        function initAdd() {
            $('.modal_title').html('Tambah');
            $('#form-ds').trigger('reset');
            $('#ds_fk_id').trigger('change');
            $('#ds_jur_id').trigger('change');
            $('#form-ds').attr('action', "{{ route('admin.dosen.create') }}");
            $('#modal_add').modal('show');
        }

        async function initEdit(id) {
            $('.modal_title').html('Edit');
            $('#form-ds').trigger('reset');
            $('#form-ds').attr('action', "{{ route('admin.dosen.update') }}");
            let res = await sendAjax("{{ route('admin.dosen.get') }}/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
                $('#modal_add').modal('show');
            } else {
                alertError(res.msg);
            }
        }

        function isiData(data) {
            $('#ds_id').val(data.ds_id);
            $('#ds_nip').val(data.ds_nip);
            $('#ds_nama').val(data.ds_nama);
            $('#ds_alamat').val(data.ds_alamat);
            $('#ds_tlp').val(data.ds_tlp);
            $('#ds_jabatan').val(data.ds_jabatan);
            $('#ds_gelar').val(data.ds_gelar);
            $('#ds_pendidikan').val(data.ds_pendidikan);
            $('#ds_jur_id').val(data.ds_jur_id);
            $('#ds_jur_id').trigger('change');
        }

        $('#form-ds').on('submit', async function(e) {
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

        async function deleteDosen(idx) {
            let res = await sendAjax("{{ route('admin.dosen.delete') }}", {
                id: idx
            });
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
        }

        async function initReset(idx) {
            let res = await sendAjax("{{ route('admin.dosen.reset') }}", {
                id: idx
            });
            if (res.status) {
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
        }

        async function initPilihJurusan(ob) {
            localJurusanID = $(ob).val();
            await $('#tbl1').DataTable().destroy();
            initDataTable();
        }

        function initBimbingan(idds) {
            document.location = "{{ route('admin.dosen.unduh.mhs-akademik') }}?idds="+idds;
        }
    </script>
@endsection
