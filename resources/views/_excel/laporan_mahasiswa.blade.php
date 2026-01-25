<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengajar</title>
    <style>
        th {
            background-color: #8ddfff !important;
        }
    </style>
</head>

<body>
    <table style="width: 100%">
        <thead>
            <tr style="">
                <th width="15" style="background-color: #8ddfff;">NIM</th>
                <th width="30" style="background-color: #8ddfff;">Nama Mahasiswa</th>
                <th width="30" style="background-color: #8ddfff;">Program Studi</th>
                <th width="20" style="background-color: #8ddfff;">Kode Mata Kuliah</th>
                <th width="30" style="background-color: #8ddfff;">Mata Kuliah</th>
                <th width="20" style="background-color: #8ddfff;">Ruang Kelas</th>
                <th width="20" style="background-color: #8ddfff;">Tahun Ajaran</th>
                <th width="15" style="background-color: #8ddfff;">Nilai Huruf</th>
                <th width="15" style="background-color: #8ddfff;">Nilai Index</th>
                <th width="15" style="background-color: #8ddfff;">Nilai Angka</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->mahasiswa->mhs_nim }}</td>
                    <td>{{ $item->mahasiswa->mhs_nama }}</td>
                    <td>{{ $item->mahasiswa->jurusan->jur_nama }} ({{ $item->mahasiswa->jurusan->jur_jenjang }})</td>
                    <td>{{ $item->matkul->matkul_kode }}</td>
                    <td>{{ $item->matkul->matkul_nama }}</td>
                    <td>{{ $item->matkul->ruang->ruang_nama }}</td>
                    <td>{{ $ta->ta_kode }}</td>
                    <td>{{ $item->krs_grade }}</td>
                    <td>{{ $item->krs_bobot }}</td>
                    <td>{{ $item->krs_nilai_avg }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
