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
                <th width="15" style="background-color: #8ddfff;">Tahun Ajaran</th>
                <th width="15" style="background-color: #8ddfff;">NIDN</th>
                <th width="30" style="background-color: #8ddfff;">Nama Dosen</th>
                <th width="20" style="background-color: #8ddfff;">Kode Mata Kuliah</th>
                <th width="20" style="background-color: #8ddfff;">Mata Kuliah</th>
                <th width="20" style="background-color: #8ddfff;">Ruang Kelas</th>
                <th width="25" style="background-color: #8ddfff;">Program Studi</th>
                <th width="10" style="background-color: #8ddfff;">Jenjang</th>
                <th width="10" style="background-color: #8ddfff;">SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $ta->ta_kode }}</td>
                    <td>{{ $item['dosen']['ds_nip'] }}</td>
                    <td>{{ $item['dosen']['ds_nama'] . ', ' . $item['dosen']['ds_gelar'] }}</td>
                    <td>{{ $item['matkul']['matkul_kode'] }}</td>
                    <td>{{ $item['matkul']['matkul_nama'] }}</td>
                    <td>{{ $item['ruang']->ruang_nama }}</td>
                    <td>{{ $item['dosen']->jurusan->jur_nama }}</td>
                    <td>{{ $item['dosen']->jurusan->jur_jenjang }}</td>
                    <td>{{ $item['matkul']['matkul_sks'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
