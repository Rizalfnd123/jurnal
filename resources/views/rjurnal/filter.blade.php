@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Rekap Jurnal</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active"><i class="fa fa-dashboard"></i></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <strong>Data</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('export.jurnal') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-download"></i> Export PDF
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="card-body mb-4">
                        <div class="col-md-12 mb-4">
                            <form action="{{ route('rjurnal.filter') }}" method="get" class="filter-form">

                                @csrf
                                <div class="form-group">
                                    <label for="bulan">Pilih Bulan:</label>
                                    <input type="month" name="bulan" id="bulan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-control" required>
                                        <option value="">-- pilih Kelas --</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success rounded mb-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                    @if (isset($bulanName) && isset($selectedKelas))
                        <div class="pull-left mb-4">
                            <h4>Pada bulan: {{ $bulanName }}</h4><br>
                            <h4>Kelas : {{ $selectedKelas }}</h4>
                        </div>
                    @endif
                    <table id="rjurnalTable" class="table table-bordered mt-4">
                        <thead class="mt-4">
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
                                    <td>{{ $item->mengajar->hari }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $item->materi }}</td>
                                    <td>{{ $item->hadir }}</td>
                                    <td>{{ $item->tidak_hadir }}</td>
                                    <td>{{ $item->dokumentasi }}</td>
                                    <td>{{ $item->created_at->format('H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#rjurnalTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true
            });
        });
    </script>
@endsection
