@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Izin</h1>
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
                <div class="card">
                    <a href="{{ url('/jadwal-hari-ini') }}" class="btn btn-primary w-100 rounded">
                        Lihat Jadwal Hari Ini
                    </a>
                </div>
                <div class="card-header">
                    <div class="pull-left">
                        <strong>Data Izin</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('izin/create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>Tambah
                        </a>
                    </div> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Guru</th>
                                <th>Keterangan</th>
                                <th>Surat</th>
                                <th>Kelas</th>
                                <th>Mapel</th>
                                <th>Kegiatan</th>
                                <th>Lampiran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($izin as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if ($item->guru)
                                            {{ $item->guru->nama }}
                                        @else
                                            <span class="text-danger">Guru tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->ket }}</td>
                                    <td>{{ $item->surat }}</td>
                                    <td>
                                        @if ($item->kelas)
                                            {{ $item->kelas->kelas }}
                                        @else
                                            <span class="text-danger">Kelas tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->mapel)
                                            {{ $item->mapel->mapel }}
                                        @else
                                            <span class="text-danger">Mata Pelajaran tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->kegiatan }}</td>
                                    <td>{{ $item->lampiran }}</td>
                                    <td>
                                        {{-- <a href="{{ url('izin/' . $item->id) }}" class="btn btn-warning">
                                            <i class="fa fa-eye"></i> Lihat
                                        </a> --}}
                                        <a href="{{ url('izin/' . $item->id . '/edit') }}" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <form action="{{ url('izin/' . $item->id) }}" method="post" class="d-inline"
                                            onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger -sm">
                                                <i class="fa fa-trash"> Hapus</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection
