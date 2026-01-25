@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Kartu Hasil Studi')
@section('body')
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Kartu Hasil Studi</h4>
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
                            <li class="breadcrumb-item"><a href="#!">KHS</a>
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
                                                    <option value="{{ $ta->ta_id . '-' . $ta->ta_kode }}">
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

                <div class="col-sm-12" id="card_khs" style="display: none">
                    <div class="card ">
                        <div class="card-header">
                            <h5>
                                <i class="icofont icofont-hat-alt text-primary"></i> Kartu Hasil Studi
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
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <a href="#" id="btn-cetak" target="_blank"
                                        class="btn btn-sm btn-warning btn-round"><i class="icofont icofont-file-pdf"></i>
                                        Cetak KHS</a>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-c-blue text-white widget-visitor-card">
                                        <div class="card-block-small text-center">
                                            <h2 id="show-sks">0</h2>
                                            <h6>Jumlah SKS</h6>
                                            <i class="feather icon-file-text"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-c-yellow text-white widget-visitor-card">
                                        <div class="card-block-small text-center">
                                            <h2 id="show-ip">0</h2>
                                            <h6>IP Semester</h6>
                                            <i class="feather icon-award"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" style="overflow: auto">
                                    <table id="tbl1" class="table table-hover table-striped" style="font-size: 10pt">
                                        <thead class="bg-grad-6">
                                            <tr>
                                                <th width="20">#</th>
                                                <th>Kode</th>
                                                <th>Mata Kuliah</th>
                                                <th>SKS</th>
                                                <th>Nilai</th>
                                                <th>Bobot</th>
                                                <th>Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="20">1</td>
                                                <td>21321</td>
                                                <td>matematika</td>
                                                <td>2</td>
                                                <td>70</td>
                                                <td>3,40</td>
                                                <td>A</td>
                                            </tr>
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

@endsection
@include('_lib.datatable')
@section('script')
    <script type="text/javascript">
        $('#mn3').addClass('active');
        // $('#mn2').addClass('active pcoded-trigger');
        // $('#mn21').addClass('active');

        let localMhsJurusan = '{{ $mhs->mhs_jur_id }}';
        let localMhsId = '{{ $mhs->mhs_id }}';
        let localMhsSemester = '{{ $mhs->mhs_semester }}';
        let localMhsSemesterData = JSON.parse(@json($mhs->mhs_semester_data));
        let localSemesterPilih = '1';

        $.extend(true, $.fn.dataTable.defaults, configDataTable);

        $(document).ready(function() {});

        $('#form_ta').on('submit', async function(e) {
            e.preventDefault();
            let mix_val = $('#pilih_ta').val();
            setTahunAjaran(mix_val);
            setSemester();
            let res = await sendAjax("{{ route('data.get.mahasiswa.khs-detail') }}", {
                mhs_id: localMhsId,
                ta_id: globalTaPilih
            }, 'GET');
            if (res.status) {
                isiData(res.data);
                initTableKhs();
                showKhs();
            } else {
                $('#card_khs').fadeOut(500);
                alertError("Data belum tersedia");
            }
        });

        function isiData(data) {
            $('#show-sks').html(data.nilai.nilai_sks);
            let nilai = parseFloat(data.nilai.nilai_ip);
            $('#show-ip').html(nilai.toFixed(2));
            let printUrl = "{{ route('print.khs') }}/" + localSemesterPilih + '-' + localMhsId + '-' + globalTaPilih;
            $('#btn-cetak').attr('href', printUrl);
        }

        function setSemester() {
            localSemesterPilih = localMhsSemesterData[globalTaKode];
            $('#sms_show').html(localSemesterPilih);
        }

        function showKhs() {
            $('#card_khs').fadeOut(500);
            $('#card_khs').fadeIn(500);
        }

        async function initTableKhs() {
            await $('#tbl1').DataTable().destroy();
            $('#tbl1').DataTable({
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
                        data: 'matkul.matkul_sks',
                        name: 'matkul.matkul_sks'
                    },
                    {
                        data: 'krs_nilai_avg',
                        name: 'krs_nilai_avg',
                        className: 'text-center'
                    },
                    {
                        data: 'krs_bobot',
                        name: 'krs_bobot',
                        className: 'text-center'
                    },
                    {
                        data: 'krs_grade',
                        name: 'krs_grade',
                        className: 'text-center'
                    }
                ]
            });
        }
    </script>
@endsection
