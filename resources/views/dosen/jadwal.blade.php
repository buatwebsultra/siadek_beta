@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Jadwal')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Jadwal</h4>
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
                            <li class="breadcrumb-item"><a href="#!">Jadwal</a>
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
                            <h5><i class="icofont icofont icofont-clock-time text-primary"></i> Jadwal Kuliah <span
                                    id="show-semester" style="text-transform: capitalize"></span> </h5>
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
                                <div class="col-md-12">
                                    <form id="form-jadwal" action="#">
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <select class="form-control" name="pilih_ta" id="pilih_ta" required>
                                                    <option value="">-- Pilih Tahun Ajaran --</option>
                                                    @foreach ($tas as $ta)
                                                        <option
                                                            value="{{ $ta->ta_id . '-' . $ta->ta_kode . '-' . $ta->ta_status }}">
                                                            {{ $ta->ta_kode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button type="submit" class="btn btn-grd-info "><i
                                                        class="icofont icofont-ui-rotation"></i> Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="card_jadwal" class="col-12" style="overflow: auto; display: none">
                                    <table id="tbl1" class="table table-hover" style="font-size: 10pt">
                                        <thead class="bg-light">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Mata Kuliah</th>
                                                <th>Jurusan</th>
                                                <th class="text-center">Jenjang</th>
                                                <th class="text-center">Semester</th>
                                                <th>Ruangan</th>
                                                <th>Hari</th>
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

    <div class="modal fade" id="modal_info" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-top-1">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icofont icofont-info-square"></i> Info Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="">
                    <div class="row">
                        <div class="col-md-12" style="overflow: auto">
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td width="130">Mata Kuliah</td>
                                        <td width="10">:</td>
                                        <td id="show-matkul_nama">--</td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td>:</td>
                                        <td id="show-jur_nama">--</td>
                                    </tr>
                                    <tr>
                                        <td>Semester</td>
                                        <td>:</td>
                                        <td id="show-matkul_semester">--</td>
                                    </tr>
                                    <tr>
                                        <td>Ruangan</td>
                                        <td>:</td>
                                        <td id="show-ruang_nama">--</td>
                                    </tr>
                                    <tr>
                                        <td>Jadwal</td>
                                        <td>:</td>
                                        <td id="show-matkul_jadwal">--</td>
                                    </tr>
                                    <tr>
                                        <td>SKS</td>
                                        <td>:</td>
                                        <td id="show-matkul_sks">--</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Mahasiswa</td>
                                        <td>:</td>
                                        <td id="show-matkul_mhs">--</td>
                                    </tr>
                                </tbody>
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
        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {
            hideSidebar();
        });

        $('#form-jadwal').on('submit', async function(e) {
            e.preventDefault();
            let mix_val = $('#pilih_ta').val();
            setTahunAjaran(mix_val);
            showJadwal();
            // let res = await
        });

        function showJadwal() {
            $('#show-semester').html('Semester (' + globalTaTipe + ')');
            initTableJadwal();
            $('#card_jadwal').fadeOut(500);
            $('#card_jadwal').fadeIn(500);
        }

        async function initTableJadwal() {
            await $('#tbl1').DataTable().destroy();
            $('#tbl1').DataTable({
                ordering: true,
                serverSide: false,
                responsive: false,
                processing: true,
                ajax: "{{ route('lecturer.data.jadwal') }}/" + globalTaKode,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'matkul_nama',
                        name: 'matkul_nama'
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
                        data: 'matkul_semester',
                        name: 'matkul_semester',
                        className: 'text-center'
                    },
                    {
                        data: 'ruang.ruang_nama',
                        name: 'ruang.ruang_nama'
                    },
                    {
                        data: 'matkul_hari',
                        name: 'matkul_hari'
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

        async function infoJadwal(id_matkul) {
            let res = await sendAjax("{{ route('lecturer.data.detail.jadwal') }}", {
                matkul_id: id_matkul,
                krs_ta_id: globalTaPilih
            });
            $('#modal_info').modal('show');
            isiData(res.data);
        }

        function isiData(data) {
            $('#show-matkul_nama').html(data.matkul.matkul_nama);
            $('#show-matkul_semester').html(data.matkul.matkul_semester);
            $('#show-jur_nama').html(data.matkul.jurusan.jur_nama);
            $('#show-ruang_nama').html(data.matkul.ruang.ruang_nama + ' : ' + data.matkul.ruang.ruang_lokasi);
            let jadwalx = '(' + data.matkul.matkul_hari + ') ' + data.matkul.matkul_jadwal + ' s/d ' + data.matkul
                .matkul_end;
            $('#show-matkul_jadwal').html(jadwalx);
            $('#show-matkul_sks').html(data.matkul.matkul_sks);
            $('#show-matkul_mhs').html(data.msiswa.length + ' Orang');
        }
    </script>
@endsection
