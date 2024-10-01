@extends('main')

@section('title', 'Dashboard')
@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Jadwal Hari ini</h1>
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
    <div class="container">
        <h2 class="mt-4 mb-4">Jadwal Hari Ini - {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l') }}</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jam</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Guru</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwalToday as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->jam->jam }}</td>
                        <td>{{ $item->mapel->mapel }}</td>
                        <td>{{ $item->kelas->kelas }}</td>
                        <td>{{ $item->guru->nama }}</td>
                        <td>
                            @if ($item->status === 'B')
                                Belum mengisi
                            @elseif($item->status === 'S')
                                Sudah mengisi Jurnal
                            @elseif($item->status === 'I')
                                Sudah Mengisi Izin
                            @else
                                {{ $item->status }}
                            @endif
                        </td>
                        <td>
                            <!-- Tombol Isi Jurnal -->
                            <a href="{{ route('jurnal.create', ['id' => $item->id]) }}" class="btn btn-primary btn-sm">Isi Jurnal</a>
        
                            <!-- Tombol Isi Izin -->
                            <a href="{{ url('izin/create', ['id' => $item->id]) }}" class="btn btn-secondary btn-sm">Isi Izin</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
