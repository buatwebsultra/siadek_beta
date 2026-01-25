@extends('_layouts.app')
@section('css')
    <style>
        .komponen_aktif {
            display: none;
        }
    </style>
@endsection
@section('pageName', 'Kartu Rencana Studi')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Kartu Rencana Studi</h4>
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
                            <li class="breadcrumb-item"><a href="#!">KRS</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="page-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6>{{ $mhs->mhs_nama }}</h6>
                            <h2>{{ $mhs->mhs_nim }}</h2>
                            <p class="m-b-0"><i class="icofont icofont-briefcase-alt-2"></i> {{ $mhs->jurusan->jur_nama }}
                            </p>
                            <i class="card-icon feather icon-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card border-left-1">
                        <div class="card-body" style="min-height: 130px;">
                            <form action="#" id="form_ta">
                                <div class="form-group">
                                    <label for="">Tahun Ajaran</label>
                                    <div class="row">
                                        <div class="col-md-7 mb-2">
                                            <select class="form-control form-control-sm" name="pilih_ta" id="pilih_ta"
                                                required>
                                                <option value="">-- Pilih --</option>
                                                @foreach ($tas as $ta)
                                                    <option
                                                        value="{{ $ta->ta_id . '-' . $ta->ta_kode . '-' . $ta->ta_status }}">
                                                        {{ $ta->ta_kode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <span class="m-t-3"></span>
                                            <button type="submit" class="btn btn-sm btn-out btn-info btn-block"><i
                                                    class="ti-layout-grid2"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="col-btn-ukt" style="display: none;">
                    <a href="{{ route('student.ukt') }}" class="btn btn-warning btn-round">Periksa Pembayaran SPP</a>
                </div>

                <div class="col-sm-12" id="card_krs" style="display: none">
                    <div class="card ">
                        <div class="card-header">
                            <h5>
                                <i class="icofont icofont-hat-alt text-primary"></i> Kartu Rencana Studi
                                <span>Tahun Ajaran <b class="ta_show">20222</b></span>
                                <span class="text-primary">Semester <b id="sms_show">1</b></span>
                            </h5>
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
                            <div class="row mb-3" style="margin-top: -10px;">
                                <div class="col-md-6 mb-3">
                                    <button type="button" onclick="addKrs()"
                                        class="btn btn-sm btn-success btn-outline-success btn-round komponen_aktif"><i
                                            class="icofont icofont-ui-add"></i> Tambah Data</button>

                                    <a href="#" target="_blank" id="btn-cetak-krs"
                                        class="btn btn-sm btn-warning btn-round"><i class="icofont icofont-file-pdf"></i>
                                        Cetak KRS</a>
                                </div>
                                <div class="col-md-6 mb-3 text-right">
                                    <button class="btn btn-sm btn-success btn-outline-success"><i
                                            class="icofont icofont-check-circled"></i> <span id="show-sks">0</span>
                                        SKS</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" style="overflow: auto">
                                    <table id="tbl_krs" class="table table-hover" style="font-size: 10pt; width: 100%">
                                        <thead class="bg-grad-6">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Kode</th>
                                                <th>Mata Kuliah</th>
                                                <th>Dosen</th>
                                                <th>Ruangan</th>
                                                <th>Hari</th>
                                                <th>Jadwal</th>
                                                <th>SKS</th>
                                                <th></th>
                                            </tr>
                                        </thead>
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
        <div class="modal-dialog " role="document" style="max-width: 95%;">
            <div class="modal-content border-top-1">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icofont icofont-ui-add"></i> Tambah KRS (<span id="ta-nama"
                            style="text-transform: capitalize"></span>)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="">
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto">
                            <table id="tbl_matkul" class="table table-hover"
                                style="font-size: 9pt; width: 100% !important">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="20">#</th>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Dosen</th>
                                        <th>Ruangan</th>
                                        <th>Jadwal</th>
                                        <th>SKS</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect btn-round"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('_lib.datatable')
@section('script')
    <script type="text/javascript">
        $('#mn2').addClass('active');
        // $('#mn2').addClass('active pcoded-trigger');
        // $('#mn21').addClass('active');

        let localMhsJurusan = '{{ $mhs->mhs_jur_id }}';
        let localMhsId = '{{ $mhs->mhs_id }}';
        let localMhsSemester = '{{ $mhs->mhs_semester }}';
        let localMhsSemesterData = JSON.parse(@json($mhs->mhs_semester_data));
        let localSemesterPilih = '1';

        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            hideSidebar();
        });

        $('#form_ta').on('submit', async function(e) {
            e.preventDefault();
            let mix_val = $('#pilih_ta').val();
            setTahunAjaran(mix_val);
            setSemester();
            let cek = await refreshDataTa();

            if (cek == 0) {
                return false;
            }

            initTableKrs();
            $('#ta-nama').html(globalTaTipe);
            showKrs();
        });

        // async function cekBukti(globalTaKode) {
        //     let res =
        // }

        async function refreshDataTa() {
            let res = await sendAjax("{{ route('data.get.mahasiswa.krs-detail') }}", {
                krs_semester: localSemesterPilih,
                krs_mhs_id: localMhsId
            }, 'GET');
            if (res.status) {
                $('#col-btn-ukt').fadeOut(500);
                $('#show-sks').html(res.data.totSks);
                return 1;
            } else {
                $('#col-btn-ukt').fadeIn(500);
                alertError(res.msg);
                console.log(res);
                return 0;
            }
        }

        function showKrs() {
            $('#card_krs').fadeOut(500);
            if (globalTaKunci == '0') {
                $('.komponen_aktif').hide();
            } else {
                $('.komponen_aktif').show();
                initTableMatkul();
            }
            let printUrl = "{{ route('print.krs') }}/" + localSemesterPilih + '-' + localMhsId + '-' + globalTaPilih;
            $('#btn-cetak-krs').attr('href', printUrl);
            $('#card_krs').fadeIn(500);
        }

        function addKrs() {
            $('#modal_add').modal('show');
        }

        function setSemester() {
            localSemesterPilih = localMhsSemesterData[globalTaKode];
            $('#sms_show').html(localSemesterPilih);
        }

        async function initTableKrs() {
            await $('#tbl_krs').DataTable().destroy();
            $('#tbl_krs').DataTable({
                ordering: true,
                serverSide: false,
                responsive: false,
                processing: true,
                ajax: "{{ route('data.krs') }}/" + localSemesterPilih + '-' + localMhsId + '-' + globalTaPilih,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'matkul.matkul_kode',
                        name: 'matkul.matkul_kode'
                    },
                    {
                        data: 'matkul.matkul_nama',
                        name: 'matkul.matkul_nama'
                    },
                    {
                        data: 'dosens',
                        name: 'dosens',
                        render: function(data) {
                            let ds = JSON.parse(data);
                            let show = '';
                            let index = 1;
                            ds.forEach(el => {
                                show += `${index}. ${el.ds_nama}, ${el.ds_gelar} <br>`;
                                index++;
                            });
                            return show;
                        }
                    },
                    {
                        data: 'matkul.ruang.ruang_nama',
                        name: 'matkul.ruang.ruang_nama'
                    },
                    {
                        data: 'matkul.matkul_hari',
                        name: 'matkul.matkul_hari'
                    },
                    {
                        data: 'matkul.matkul_jadwal',
                        name: 'matkul.matkul_jadwal',
                        className: 'text-center'
                    },
                    {
                        data: 'matkul.matkul_sks',
                        name: 'matkul.matkul_sks',
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

        async function initTableMatkul() {
            await $('#tbl_matkul').DataTable().destroy();
            $('#tbl_matkul').DataTable({
                ordering: true,
                responsive: false,
                processing: true,
                serverSide: false,
                ajax: "{{ route('data.matkul') }}/" + globalTaTipe + "-" + localMhsJurusan,
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
                        data: 'matkul_semester',
                        name: 'matkul_semester',
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
                        data: 'ruang.ruang_nama',
                        name: 'ruang.ruang_nama'
                    },
                    {
                        data: 'jadwal',
                        name: 'jadwal',
                        className: 'text-center'
                    },
                    {
                        data: 'matkul_sks',
                        name: 'matkul_sks',
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

        async function ambilKuliah(matkul) {
            let res = await sendAjax("{{ route('student.krs.create') }}", {
                krs_matkul_id: matkul,
                krs_ta_id: globalTaPilih,
                krs_semester: localSemesterPilih
            });
            if (res.status) {
                refreshDataTa();
                $('#tbl_krs').DataTable().ajax.reload();
                $('#modal_add').modal('hide');
                alertSuccess(res.msg);
            } else {
                $('#modal_add').modal('hide');
                alertError(res.msg);
                console.log(res);
            }
        }

        async function deleteKrs(krs_id) {
            let res = await sendAjax("{{ route('student.krs.delete') }}", {
                id: krs_id
            });
            if (res.status) {
                refreshDataTa();
                $('#tbl_krs').DataTable().ajax.reload();
                alertSuccess(res.msg);
            } else {
                alertError(res.msg);
            }
        }
    </script>
@endsection
