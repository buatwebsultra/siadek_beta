@php
    $base_aset = asset('komponen');
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transkrip_Nilai_{{ $mhs->mhs_nim }}</title>
    <link rel="stylesheet" type="text/css" href="{{ $base_aset }}/bower_components/bootstrap/css/bootstrap.min.css">
    <style>
        .w-100 {
            width: 100%;
        }

        .w-95 {
            width: 100%;
        }

        .text-center {
            text-align: center !important;
            vertical-align: middle !important;
        }

        .text-left {
            text-align: left !important;
            vertical-align: middle !important;
        }

        .text-right {
            text-align: right !important;
            vertical-align: middle !important;
        }

        /* .table {
            border-collapse: collapse;
        }

        .table tr>td,
        th {
            padding: 5px;
        } */

        .table td,
        .table th {
            padding: .3rem !important;
        }

        .logo {
            position: absolute;
            z-index: 99999;
            top: 10px;
            left: 2px;
        }

        .tbl_head {
            border-bottom: 2px solid #000000
        }
    </style>
    <style type="text/css" media="print">
        @page {
            size: portrait;
        }
    </style>
</head>

<body style="font-size: 10pt; max-width: 1200px">
    <img class="logo" src="{{ asset($appData->app_icon) }}" alt="LOGO" width="75">
    <table class="tbl_head w-95" border="0">
        <thead>
            <tr>
                <th class="text-center" style="font-size: 14pt">{{ $appData->app_author }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">{{ $appData->app_alamat }}</td>
            </tr>
            <tr>
                <td class="text-center">Email : {{ $appData->app_email }}; Telepon : {{ $appData->app_tlp }}</td>
            </tr>
            <tr>
                <td style="line-height: 15px">.</td>
            </tr>
        </tbody>
    </table>

    <table class="table w-95" border="0">
        <thead>
            <tr>
                <th colspan="6" class="text-center"
                    style="text-transform: uppercase; line-height: 70px; font-size: 15pt">
                    TRANSKRIP NILAI {{ $appData->app_author }}
                </th>
            </tr>
            <tr>
                <th class="text-left" width="100">Nama</th>
                <th class="text-left" width="10">:</th>
                <th class="text-left">{{ $mhs->mhs_nama }}</th>
                <th class="text-left" width="90">Jurusan/Prodi</th>
                <th class="text-left" width="10">:</th>
                <th class="text-left">{{ $mhs->jurusan->jur_nama }}</th>
            </tr>
            <tr>
                <th class="text-left">NIM</th>
                <th class="text-left">:</th>
                <th class="text-left">{{ $mhs->mhs_nim }}</th>
                <th class="text-left">Jenjang</th>
                <th class="text-left">:</th>
                <th class="text-left">{{ $mhs->jurusan->jur_jenjang }}</th>
            </tr>
        </thead>
    </table>
    <div style="width: 100%; height: 20px;"></div>
    <table class="table w-95" style="font-size: 9pt">
        <thead>
            <tr style="background-color: #f1f1f1">
                <th class="text-center">No</th>
                <th class="text-center">Kode</th>
                <th class="text-center">Mata Kuliah</th>
                <th class="text-center">SKS</th>
                <th class="text-center">Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_bobot = 0;
                $total_sks = 0;
            @endphp
            @foreach ($krss as $krs)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $krs->matkul->matkul_kode }}</td>
                    <td>{{ $krs->matkul->matkul_nama }}</td>
                    <td class="text-center">{{ $krs->matkul->matkul_sks }}</td>
                    <td class="text-center">{{ $krs->krs_grade }}</td>
                </tr>
                @php
                    $total_bobot += $krs->krs_bobot * $krs->matkul->matkul_sks;
                    $total_sks += $krs->matkul->matkul_sks;
                @endphp
            @endforeach
        </tbody>
        @php
            $ipk = $total_bobot / $total_sks;
        @endphp
        <tfoot style="background-color: #f1f1f1">
            <tr>
                <th colspan="4" class="text-right">Total SKS :</th>
                <th class="text-center">{{ $total_sks }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">IP Kumulatif :</th>
                <th class="text-center">{{ number_format($ipk, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <table class="w-95">
        <thead>
            <tr>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <td class="text-center">{{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <th class="text-center"></th>
                <th class="text-center">Menyetujui</th>
                <th class="text-center">Mengetahui</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">Mahasiswa</td>
                <td class="text-center">Penasihat Akademik</td>
                <td class="text-center">Ketua Jurusan/Program Studi <br> {{ $jurusan->jur_nama }}</td>
            </tr>
            <tr>
                <td class="text-center" style="line-height: 60px; color: #fff">.</td>
                <td class="text-center"></td>
                <td class="text-center"></td>
            </tr>
            <tr>
                <td class="text-center">{{ $mhs->mhs_nama }}</td>
                <td class="text-center">{{ $mhs->pembimbing->ds_nama.', '.$mhs->pembimbing->ds_gelar }}</td>
                <td class="text-center">{{ $jurusan->pimpinan->ds_nama.', '.$jurusan->pimpinan->ds_gelar }}</td>
            </tr>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
