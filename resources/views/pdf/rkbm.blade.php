<!DOCTYPE html>
<html>

<head>
    <title>Data Rekap KBM</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Data Rekap KBM</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rkbm as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->hari }}</td>
                    <td>{{ $item->jam->jam }}</td>
                    <td>{{ $item->kelas->kelas }}</td>
                    <td>{{ $item->mapel->mapel }}</td>
                    <td>{{ $item->guru->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
