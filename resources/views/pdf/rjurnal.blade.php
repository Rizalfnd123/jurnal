<!DOCTYPE html>
<html>

<head>
    <title>Data Rekap Jurnal</title>
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
    <div class="pull-left mb-4">
        @foreach ($rjurnal as $isi)
            <h4>Antara tanggal : {{ $awal }}</h4><br>
            <h4>Sampai tanggal : {{ $akhir }}</h4><br>
            <h4>Kelas : {{ $isi->kelas->kelas }}</h4>
        @endforeach
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Tanggal</th>
                <th>Materi</th>
                <th>Hadir</th>
                <th>Tidak Hadir</th>
                <th>Dokumentasi</th>
                <th>Waktu Isi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rjurnal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->hari }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->materi }}</td>
                    <td>{{ $item->hadir }}</td>
                    <td>{{ $item->tidak_hadir }}</td>
                    <td>{{ $item->dokumentasi }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
