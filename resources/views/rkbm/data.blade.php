@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Rekap KBM</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content">
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
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 mb-4">
                            <form action="{{ url('filter') }}" method="get" class="filter-form">
                                @csrf
                                <div class="form-group">
                                    <label for="bulan">Pilih Bulan:</label>
                                    <input type="month" name="bulan" id='bulan'class="form-control" required>
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
                        {{-- @if (isset($pesan))
                            <div class="alert alert-info mt-4">
                                {{ $pesan }}
                            </div>
                        @endif --}}
                    </div>
                    {{-- <table id="rkbmTable" class="table table-bordered mt-4">
                        <thead class="mt-4">
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Wajib Hadir</th>
                                <th>Hadir</th>
                                <th>Izin</th>
                                <th>Presentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rkbm as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mapel->mapel }}</td>
                                    <td>{{ $item->guru->nama }}</td>
                                    <td>{{  4 }}</td>
                                    <td>{{ $item->hadir_count }}</td> <!-- Total jumlah jurnal dengan status 'S' -->
                                    <td>{{ $item->izin_count }}</td> <!-- Total jumlah izin -->
                                    <td>
                                        @if ($item->total > 0)
                                        {{ number_format(($item->hadir_count + $item->izin_count)/4 * 100) }}%
                                        @else
                                            0%
                                        @endif
                                    </td>
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
            $('#rkbmTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true
            });
        });
    </script>
@endsection
