@php
    $guard = Auth::getDefaultDriver();
@endphp
@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Mahasiswa')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Mahasiswa</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Mahasiswa</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6>Total Mahasiswa</h6>
                            <h2 id="show-tot-mhs">0</h2>
                            <i class="card-icon feather icon-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card b-l-info">
                        <div class="card-header">
                            <h5> <i class="icofont icofont-tasks-alt text-primary"></i> Data Mahasiswa</h5>
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
                                <div class="col-md-6 mb-3">
                                    <button type="button" onclick="initAdd()"
                                        class="btn btn-sm btn-success btn-outline-success"><i
                                            class="icofont icofont-ui-add"></i> Tambah Data</button>
                                    <button type="button" onclick="initExport()" class="btn btn-sm btn-success btn-square ml-1">
                                        Export Data Mahasiswa
                                    </button>
                                </div>
                                <div class="col-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover" style="font-size: 10pt; width: 100%">
                                        <thead class="bg-grad-5">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan/Prodi</th>
                                                <th>Jenjang</th>
                                                <th class="text-center" width="110">Tahun Masuk</th>
                                                <th class="text-center" width="110">Status</th>
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
                <form id="form-mhs" action="#" method="POST">
                    @csrf
                    <input type="hidden" name="mhs_id" id="mhs_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> <span
                                class="modal_title">Tambah</span> Mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Jurusan</label>
                                    <select class="col-sm-12 select2" name="mhs_jur_id" id="mhs_jur_id"
                                        onchange="gantiJurusan(this)" required>
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
                                    <label for="" class="req">Status Mahasiswa</label>
                                    <select class="form-control form-control-sm" name="mhs_status" id="mhs_status" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($stsMahasiswa as $key5 => $val5)
                                            <option value="{{ $key5 }}">{{ $val5 }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Tahun Masuk</label>
                                    <input type="number" class="form-control form-control-sm" name="mhs_angkatan"
                                        id="mhs_angkatan" min="2000" max="2222" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Dosen Pembimbing</label>
                                    <select class="col-sm-12" name="mhs_dosen_id" id="mhs_dosen_id" required>
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">NIM</label>
                                    <input type="text" class="form-control form-control-sm"
                                        onchange="clearWhiteSpace(this)" name="mhs_nim" id="mhs_nim" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Nama</label>
                                    <input type="text" class="form-control form-control-sm" name="mhs_nama"
                                        id="mhs_nama" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Jenis Kelamin</label>
                                    <select class="form-control form-control-sm" name="mhs_jk" id="mhs_jk" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Agama</label>
                                    <select class="form-control form-control-sm" name="mhs_agama" id="mhs_agama"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($agama as $agm)
                                            <option value="{{ $agm->agm_nama }}">{{ $agm->agm_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Tanggal Lahir</label>
                                    <input type="date" value="1998-01-01" class="form-control form-control-sm"
                                        name="mhs_tgl_lahir" id="mhs_tgl_lahir" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Tempat Lahir</label>
                                    <input type="text" class="form-control form-control-sm" name="mhs_tmpt_lahir"
                                        id="mhs_tmpt_lahir" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">No Telepon</label>
                                    <input type="text" class="form-control form-control-sm" name="mhs_tlp"
                                        id="mhs_tlp" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="req">Email</label>
                                    <input type="text" class="form-control form-control-sm" name="mhs_email"
                                        id="mhs_email" required>
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

    <div class="modal fade" id="modal_reset_nilai" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content border-top-1">
                <form id="form-reset-nilai" action="{{ route('pro.penilaian.reset') }}" method="POST">
                    @csrf
                    <input type="hidden" name="reset_mhs_id" id="reset_mhs_id">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icofont icofont-refresh text-warning"></i> Reset Nilai Mahasiswa
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Mahasiswa</label>
                                    <input type="text" class="form-control form-control-sm" name="reset_mhs_nama"
                                        id="reset_mhs_nama" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Tahun Ajaran</label>
                                    <select class="form-control form-control-sm" name="reset_ta_id" id="reset_ta_id"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($tas as $ta)
                                            <option value="{{ $ta->ta_id }}">
                                                {{ $ta->ta_kode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect btn-round"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info waves-effect btn-round"><i
                                class="icofont icofont-refresh"></i> Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_export" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form id="form-export" action="{{ route('pro.mahasiswa.export-data') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="icofont icofont-file-excel text-success"></i> Export Data Mahasiswa
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="req">Jurusan</label>
                                    <select class="form-control" name="export_jur_id" id="export_jur_id" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($jurusan as $jur)
                                            <option value="{{ $jur->jur_id }}">{{ $jur->jur_nama }}
                                                ({{ $jur->jur_jenjang }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="req">Angkatan</label>
                                    <select class="form-control" name="export_angkatan" id="export_angkatan"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        @for ($i = date('Y'); $i >= 2019; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-round"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-round">
                            <i class="icofont icofont-paper-plane"></i>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="form-buka-data-mhs" method="POST" action="{{ route('admin.mahasiswa.buka.data-diri') }}">
        @csrf
        <input type="hidden" name="mhs_id" id="buka_mhs_id">
    </form>

@endsection
@include('_lib.datatable')
@include('_lib.select2')
@section('script')
    <script type="text/javascript">
        let localJurusanID = 'all';
        @if ($guard == 'admin')
            $('#mn5').addClass('active');
        @else
            $('#mn7').addClass('active');
            $('#mn7').addClass('active pcoded-trigger');
            $('#mn72').addClass('active');
            localJurusanID = '{{ $kaprodi->ds_jur_id }}';
        @endif
        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            // hideSidebar();
            $('#mhs_jur_id').select2({
                dropdownParent: $("#modal_add")
            });

            initTable();
            initCariDosen();
        });

        function initTable() {
            $('#tbl1').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "{{ route('data.mahasiswa') }}/" + localJurusanID,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'mhs_nim',
                        name: 'mhs_nim'
                    },
                    {
                        data: 'namakunci',
                        name: 'namakunci'
                    },
                    {
                        data: 'jurusan.jur_nama',
                        name: 'jurusan.jur_nama'
                    },
                    {
                        data: 'jurusan.jur_jenjang',
                        name: 'jurusan.jur_jenjang',
                        className: 'text-center'
                    },
                    {
                        data: 'mhs_angkatan',
                        name: 'mhs_angkatan',
                        className: 'text-center'
                    },
                    {
                        data: 'status1',
                        name: 'status1',
                        className: 'text-center'
                    },
                    {
                        data: 'menu',
                        name: 'menu',
                        searchable: false,
                        className: 'text-center',
                        orderable: false
                    },
                ],
                initComplete: function(e) {
                    $('#show-tot-mhs').html(e.aoData.length);
                }
            });
        }

        function gantiJurusan(ob) {
            localJurusanID = $(ob).val();
            initCariDosen();
        }

        function initCariDosen() {
            $('#mhs_dosen_id').select2({
                placeholder: 'Cari berdasarkan NIDN atau Nama ..',
                minimumInputLength: 3,
                dropdownParent: $("#modal_add"),
                ajax: {
                    url: "{{ route('pro.dosen.cari') }}/" + localJurusanID,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.ds_nama + ', ' + item.ds_gelar + ' (' + item
                                        .ds_nip + ')',
                                    id: item.ds_id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }

        function initAdd() {
            $('.modal_title').html('Tambah');
            $('#form-mhs').trigger('reset');
            $('#mhs_fk_id').trigger('change');
            $('#mhs_jur_id').trigger('change');
            $('#mhs_dosen_id').trigger('change');
            $('#form-mhs').attr('action', "{{ route('admin.mahasiswa.create') }}");
            $('#modal_add').modal('show');
        }

        async function initEdit(id) {
            $('.modal_title').html('Edit');
            $('#form-mhs').trigger('reset');
            $('#form-mhs').attr('action', "{{ route('admin.mahasiswa.update') }}");
            let res = await sendAjax("{{ route('admin.mahasiswa.get') }}/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
                $('#modal_add').modal('show');
            } else {
                alertError(res.msg);
            }
        }

        function isiData(data) {
            $('#mhs_id').val(data.mhs_id);
            $('#mhs_nim').val(data.mhs_nim);
            $('#mhs_nama').val(data.mhs_nama);
            $('#mhs_angkatan').val(data.mhs_angkatan);
            $('#mhs_tlp').val(data.mhs_tlp);
            $('#mhs_email').val(data.mhs_email);
            $('#mhs_jk').val(data.mhs_jk);
            $('#mhs_agama').val(data.mhs_agama);
            $('#mhs_tgl_lahir').val(data.mhs_tgl_lahir);
            $('#mhs_tmpt_lahir').val(data.mhs_tmpt_lahir);
            $('#mhs_status').val(data.mhs_status);

            $('#mhs_fk_id').val(data.mhs_fk_id);
            $('#mhs_fk_id').trigger('change');
            $('#mhs_jur_id').val(data.mhs_jur_id);
            $('#mhs_jur_id').trigger('change');

            // $('#mhs_dosen_id').val(data.mhs_dosen_id);
            // $('#mhs_dosen_id').trigger('change');

            let vall =
                `<option value="${data.mhs_dosen_id}" selected="selected">${data.pembimbing.ds_nama}, ${data.pembimbing.ds_gelar} (${data.pembimbing.ds_nip})</option>`;
            $('#mhs_dosen_id').html(vall);
        }

        $('#form-mhs').on('submit', async function(e) {
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

        async function deleteMhs(idx) {
            let res = await sendAjax("{{ route('admin.mahasiswa.delete') }}", {
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
            let res = await sendAjax("{{ route('admin.mahasiswa.reset') }}", {
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
            initTable();
        }

        function initBuka(id) {
            $('#buka_mhs_id').val(id);
            swal({
                    title: "Buka Kunci ?",
                    text: "Buka kunci data mahasiswa",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Batal"
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('#form-buka-data-mhs').trigger('submit');
                    }
                });
        }

        $('#form-buka-data-mhs').on('submit', async function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let url = $(this).attr('action');
            let res = await sendAjax(url, data);
            if (res.status) {
                $(this).trigger('reset');
                $('#tbl1').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
                console.log(res);
            }
        });

        function resetNilai(mhs_id, nama) {
            $('#reset_mhs_id').val(mhs_id);
            $('#reset_mhs_nama').val(nama);
            $('#modal_reset_nilai').modal('show');
        }

        $('#form-reset-nilai').on('submit', async function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            let url = $(this).attr('action');
            let res = await sendAjax(url, data);
            if (res.status) {
                $(this).trigger('reset');
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
                console.log(res);
            }
            $('#modal_reset_nilai').modal('hide');
        });

        function initExport() {
            $('#form-export').trigger('reset');
            $('#modal_export').modal('show');
        }
    </script>
@endsection
