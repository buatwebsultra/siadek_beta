<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>

</head>

<body>
    <table>
        <tr>
            <td colspan="12" style="font-weight: bold; text-align: center">DAFTAR PEMBAYARAN SPP</td>
        </tr>
        <tr>
            <td colspan="12" style="font-weight: bold; text-align: center">MAHASISWA STIKES PELITA IBU ANGKATAN
                {{ $angkatan }}</td>
        </tr>
        <tr>
            <td colspan="12" style="font-weight: bold; text-transform: uppercase !important; text-align: center">
                {{ strtoupper($jurusan->jur_jenjang) }} {{ strtoupper($jurusan->jur_nama) }}
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <td rowspan="2" style="text-align: center; background-color: #e3e3e3;" width="5">NO</td>
                <td rowspan="2" style="text-align: center; background-color: #e3e3e3;" width="20">NIM</td>
                <td rowspan="2" style="text-align: center; background-color: #e3e3e3;" width="25">NAMA MAHASISWA
                </td>
                <td colspan="10" style="text-align: center; background-color: #e3e3e3;">SEMESTER/ TANGGAL PEMBAYARAN
                </td>
                <td rowspan="2" style="text-align: center; background-color: #e3e3e3;" width="20">KET</td>
            </tr>
            <tr>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">I</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">II</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">III</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">IV</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">V</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">VI</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">VII</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">VIII</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">IX</td>
                <td style="text-align: center; background-color: #c0c0c0;" width="12">X</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
                @php
                    $sts = $stsMahasiswa[$mhs->mhs_status];
                    $last = count($mhs->ukt) ?? 0;
                    // $ket = @$mhs->ukt[$last-1] ? '' : $sts;
                    $ket = $sts;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mhs->mhs_nim }}</td>
                    <td>{{ $mhs->mhs_nama }}</td>
                    <td>{{ @$mhs->ukt[0]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[1]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[2]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[3]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[4]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[5]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[6]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[7]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[8]->byr_tgl_bayar ?? '-' }}</td>
                    <td>{{ @$mhs->ukt[9]->byr_tgl_bayar ?? '-' }}</td>
                    <td style="text-align: center">{{ $ket }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <tr>
            <th colspan="4"><strong>Rekapitulasi Mahasiswa</strong></th>
        </tr>
        @foreach ($mhs_by_sts as $data5)
            <tr>
                <td></td>
                <td># {{ $data5['status'] }}</td>
                <td>{{ $data5['jml'] }}</td>
                <td>Mahasiswa</td>
            </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="2">Wakil Ketua Bidang Keuangan</td>
            <td colspan="3"></td>
            <td>Bendahara</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="2">Nama_Wakilketua</td>
            <td colspan="3"></td>
            <td>Nama_Bendahara</td>
        </tr>
        <tr>
            <td colspan="2">NIDN : </td>
            <td colspan="3"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3">Mengetahui,</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3">Ketua/Rektor/Direktur PT</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3">Nama_Ketua/Rektor/Direktur</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3">NIDN: </td>
        </tr>
    </table>
</body>
</html>
