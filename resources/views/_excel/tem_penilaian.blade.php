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
        <thead>
            <tr>
                <th rowspan="2" style="background-color: #e3e3e3; vertical-align: middle">ID</th>
                <th rowspan="2" width="12" style="background-color: #e3e3e3; vertical-align: middle">NIM</th>
                <th rowspan="2" width="30" style="background-color: #e3e3e3; vertical-align: middle">Nama</th>
                <th colspan="5" style="background-color: #e3e3e3; text-align: center"> Nilai (0 s/d 100)</th>
            </tr>
            <tr>
                <th width="12" style="background-color: #a8fff2">Kehadiran</th>
                <th width="12" style="background-color: #a8fff2">Tugas</th>
                <th width="12" style="background-color: #a8fff2">Kuis</th>
                <th width="12" style="background-color: #a8fff2">MID</th>
                <th width="12" style="background-color: #a8fff2">Final</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
                <tr>
                    <td>{{ $mhs->mhs_id }}</td>
                    <td>{{ $mhs->mhs_nim }}</td>
                    <td>{{ $mhs->mhs_nama }}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
