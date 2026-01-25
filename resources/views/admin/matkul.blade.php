@php
    $guard = Auth::getDefaultDriver();
@endphp
@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Mata Kuliah')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Mata Kuliah</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Mata Kuliah</a>
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
                            <h5> <i class="icofont icofont-tasks-alt text-primary"></i> Mata Kuliah</h5>
                            @if (@$isKaprodi)
                                <span>{{ $jurusan[0]->jur_nama }} ({{ $jurusan[0]->jur_jenjang }})</span>
                            @endif
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
                                <div class="col-md-12 mb-3">
                                    <button type="button" onclick="initAdd()"
                                        class="btn btn-sm btn-success btn-outline-success"><i
                                            class="icofont icofont-ui-add"></i> Tambah Data</button>
                                </div>
                                <div class="col-md-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover table-striped"
                                        style="font-size: 10pt; width: 100%">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Kode</th>
                                                <th>Mata Kuliah</th>
                                                <th>Jurusan</th>
                                                <th>Jenjang</th>
                                                <th>Dosen/Pengajar</th>
                                                <th class="text-center">Semester</th>
                                                <th class="text-center">SKS</th>
                                                <th class="text-center">Jadwal</th>
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
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content border-top-1">
                <form id="form-matkul" action="#" method="POST">
                    @csrf
                    <input type="hidden" name="matkul_id" id="matkul_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> <span
                                class="modal_title">Tambah</span> Mata Kuliah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Kode</label>
                                    <input type="text" class="form-control form-control-sm" name="matkul_kode"
                                        id="matkul_kode" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Nama</label>
                                    <input type="text" class="form-control form-control-sm" name="matkul_nama"
                                        id="matkul_nama" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Jurusan</label>
                                    <select class="col-sm-12 select2" name="matkul_jur_id" id="matkul_jur_id" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($jurusan as $jur)
                                            <option value="{{ $jur->jur_id }}">{{ $jur->jur_nama }}
                                                ({{ $jur->jur_jenjang }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Ruangan</label>
                                    <select class="col-sm-12 select2" name="matkul_ruang_id" id="matkul_ruang_id"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($ruangs as $ruang)
                                            <option value="{{ $ruang->ruang_id }}">{{ $ruang->ruang_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Dosen Pengajar (1)</label>
                                    <select class="col-sm-12 select2" name="matkul_dosen1" id="matkul_dosen_id1"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($dosens as $ds)
                                            <option value="{{ $ds->ds_id }}">
                                                {{ $ds->ds_nama . ', ' . $ds->ds_gelar }} ({{ $ds->ds_nip }}) ➡️
                                                {{ $ds->jurusan->jur_nama }} ({{ $ds->jurusan->jur_jenjang }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="">Dosen Pengajar (2)</label>
                                    <select class="col-sm-12 select2" name="matkul_dosen2" id="matkul_dosen_id2">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($dosens as $ds)
                                            <option value="{{ $ds->ds_id }}">
                                                {{ $ds->ds_nama . ', ' . $ds->ds_gelar }} ({{ $ds->ds_nip }}) ➡️
                                                {{ $ds->jurusan->jur_nama }} ({{ $ds->jurusan->jur_jenjang }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">SKS</label>
                                    <input type="number" class="form-control form-control-sm" name="matkul_sks"
                                        id="matkul_sks" max="10" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Hari</label>
                                    <select class="form-control form-control-sm" name="matkul_hari_order"
                                        id="matkul_hari_order" required>
                                        <option value="1">Senin</option>
                                        <option value="2">Selasa</option>
                                        <option value="3">Rabu</option>
                                        <option value="4">Kamis</option>
                                        <option value="5">Jumat</option>
                                        <option value="6">Sabtu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Waktu Mulai</label>
                                    <input type="time" class="form-control form-control-sm"
                                        value="{{ date('H:i') }}" name="matkul_jadwal" id="matkul_jadwal" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Waktu Selesai</label>
                                    <input type="time" class="form-control form-control-sm"
                                        value="{{ date('H:i') }}" name="matkul_end" id="matkul_end" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Semester</label>
                                    <input type="number" class="form-control form-control-sm" name="matkul_semester"
                                        id="matkul_semester" min="1" max="10" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Periode Semester</label>
                                    <select class="form-control form-control-sm" name="matkul_tipe" id="matkul_tipe"
                                        required>
                                        <option value="ganjil">Ganjil</option>
                                        <option value="genap">Genap</option>
                                    </select>
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
            $('#mn6').addClass('active');
        @else
            $('#mn7').addClass('active');
            $('#mn7').addClass('active pcoded-trigger');
            $('#mn73').addClass('active');
            localJurusanID = '{{ $jurusan[0]->jur_id }}';
        @endif

        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            hideSidebar();
            $('#matkul_dosen_id1').select2({
                dropdownParent: $("#modal_add"),
                maximumSelectionLength: 2
            });
            $('#matkul_dosen_id2').select2({
                dropdownParent: $("#modal_add"),
                maximumSelectionLength: 2
            });
            $('#matkul_jur_id').select2({
                dropdownParent: $("#modal_add")
            });
            $('#matkul_ruang_id').select2({
                dropdownParent: $("#modal_add")
            });
            initTable();
        });

        function initTable() {
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "{{ route('data.matkul') }}/" + localJurusanID,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'matkul_kode',
                        name: 'matkul_kode'
                    },
                    {
                        data: 'matkul_nama',
                        name: 'matkul_nama'
                    },
                    {
                        data: 'jurusan.jur_nama',
                        name: 'jurusan.jur_nama',
                        render: function(data) {
                            if (data) {
                                return '🏦 ' + data;
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'jurusan.jur_jenjang',
                        name: 'jurusan.jur_jenjang',
                        className: 'text-center'
                    },
                    {
                        data: 'dosens',
                        name: 'dosens',
                        render: function(data) {
                            let show = '';
                            let index = 1;
                            if (data.length > 0) {
                                data.forEach(el => {
                                    if (el) {
                                        show += `${index}. ${el.ds_nama}, ${el.ds_gelar} <br>`;
                                        index++;
                                    }
                                });
                            }
                            return show;
                        }
                    },
                    {
                        data: 'periode',
                        name: 'periode',
                        className: 'text-center'
                    },
                    {
                        data: 'matkul_sks',
                        name: 'matkul_sks',
                        className: 'text-center'
                    },
                    {
                        data: 'jadwal',
                        name: 'jadwal',
                        className: 'text-center'
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
            $('#form-matkul').trigger('reset');
            $('#matkul_jur_id').trigger('change');
            $('#matkul_dosen_id1').val('').trigger('change');
            $('#matkul_dosen_id2').val('').trigger('change');
            // $('#matkul_ruang_id').trigger('change');
            $('#form-matkul').attr('action', "{{ route('admin.matkul.create') }}");
            $('#modal_add').modal('show');
        }

        async function initEdit(id) {
            $('.modal_title').html('Edit');
            $('#form-matkul').trigger('reset');
            $('#form-matkul').attr('action', "{{ route('admin.matkul.update') }}");
            let res = await sendAjax("{{ route('admin.matkul.get') }}/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
                $('#modal_add').modal('show');
            } else {
                alertError(res.msg);
            }
        }

        function isiData(data) {
            $('#matkul_id').val(data.matkul_id);
            $('#matkul_kode').val(data.matkul_kode);
            $('#matkul_nama').val(data.matkul_nama);
            $('#matkul_semester').val(data.matkul_semester);
            $('#matkul_sks').val(data.matkul_sks);
            $('#matkul_hari_order').val(data.matkul_hari_order);
            $('#matkul_jadwal').val(data.matkul_jadwal);
            $('#matkul_end').val(data.matkul_end);
            $('#matkul_tipe').val(data.matkul_tipe);

            $('#matkul_jur_id').val(data.matkul_jur_id);
            $('#matkul_jur_id').trigger('change');
            // $('#matkul_dosen_id').val(data.matkul_dosen_id);
            // $('#matkul_dosen_id').trigger('change');
            $('#matkul_ruang_id').val(data.matkul_ruang_id);
            $('#matkul_ruang_id').trigger('change');

            // console.log(data.matkul_dosen);
            let dsn = JSON.parse(data.matkul_dosen);
            $('#matkul_dosen_id1').val(dsn[0]).trigger('change');
            $('#matkul_dosen_id2').val(dsn[1]).trigger('change');
            // $('#matkul_dosen_id').trigger('change');
        }

        $('#form-matkul').on('submit', async function(e) {
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
                alertError(res.msg);
                console.log(res);
            }
        });

        async function deleteMatkul(idx) {
            let res = await sendAjax("{{ route('admin.matkul.delete') }}", {
                id: idx
            });
            if (res.status) {
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
        }

        async function initPilihJurusan(ob) {
            localJurusanID = $(ob).val();
            await $('#tbl1').DataTable().destroy();
            initTable();
        }
    </script>
@endsection
