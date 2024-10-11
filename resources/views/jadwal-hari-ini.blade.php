@extends('main')

@section('title', 'Dashboard')
@section('breadcrumbs')

@endsection

@section('content')
    <div class="container">
        <h3 class="mt-4 mb-4">Jadwal Hari Ini - {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l') }}</h3>
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <table id="bootstrap-data-table" class="table table-striped table-bordered rounded">
                    <thead>
                        <tr>
                            {{-- <th>No</th> --}}
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
                                {{-- <td>{{ $loop->iteration }}</td> --}}
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
                                    <a href="{{ route('jurnal.create', ['id' => $item->id]) }}"
                                        class="btn btn-primary rounded btn-sm mb-1">Isi
                                        Jurnal</a>

                                    <!-- Tombol Isi Izin -->
                                    <a href="{{ url('izin/create', ['id' => $item->id]) }}"
                                        class="btn btn-secondary rounded btn-sm">Isi
                                        Izin</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
