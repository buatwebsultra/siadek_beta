<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>..</title>

</head>

<body>
    <table>
        <tr>
            <td colspan="6">{{ $dosen->ds_nama }}, {{ $dosen->ds_gelar }}</td>
        </tr>
        <tr>
            <td colspan="6">'{{ $dosen->ds_nip }}</td>
        </tr>
        <tr>
            <td colspan="6">{{ $dosen->ds_jabatan }}</td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th width="12" style="background-color: #a8fff2">#</th>
                <th width="12" style="background-color: #a8fff2">NIM</th>
                <th width="25" style="background-color: #a8fff2">Nama</th>
                <th width="12" style="background-color: #a8fff2">Angkatan</th>
                <th width="12" style="background-color: #a8fff2">Jurusan</th>
                <th width="12" style="background-color: #a8fff2">Jenjang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mhs->mhs_nim }}</td>
                    <td>{{ $mhs->mhs_nama }}</td>
                    <td>{{ $mhs->mhs_angkatan }}</td>
                    <td>{{ $mhs->jurusan->jur_nama }}</td>
                    <td>{{ $mhs->jurusan->jur_jenjang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
