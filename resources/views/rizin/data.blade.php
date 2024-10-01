@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Rekap Izin</h1>
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
                    {{-- <div class="pull-right">
                        <a href="{{ route('export.pdf') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-download"></i> Export PDF
                        </a>
                    </div> --}}
                </div> 
                <div class="card-body table-responsive">
                    <div class="card-body mb-4">
                        <div class="col-md-12 mb-4">
                            <form action="{{ route('rizin.filter') }}" method="get" class="filter-form">
    
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
                    {{-- <table id="rizinTable" class="table table-bordered mt-4">
                        <thead class="mt-4">
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Keterangan</th>
                                <th>Surat</th>
                                <th>Kegiatan</th>
                                <th>Lampiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rizin as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mengajar->hari }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $item->mengajar->jam->jam }}</td> 
                                    <td>{{ $item->ket }}</td>
                                    <td>{{ $item->surat }}</td>
                                    <td>{{ $item->kegiatan }}</td>
                                    <td>{{ $item->lampiran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#rizinTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true
            });
        });
    </script>
@endsection
