@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Jadwal Mengajar</h1>
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
                        <a href="{{ url('mengajar/create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($mengajar as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->jam->jam }}</td>
                                    <td>{{ $item->kelas->kelas }}</td>
                                    <td>{{ $item->mapel->mapel }}</td>
                                    <td>{{ $item->guru->nama }}</td>
                                    <td>
                                        {{-- <a href="{{ url('mengajar/' . $item->id) }}" class="btn btn-warning">
                                            <i class="fa fa-eye"></i> Lihat
                                        </a> --}}
                                        <a href="{{ url('mengajar/' . $item->id . '/edit') }}" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('mengajar/' . $item->id) }}" method="post" class="d-inline"
                                            onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger -sm">
                                                <i class="fa fa-trash"></i>
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
