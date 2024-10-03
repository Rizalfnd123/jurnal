@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Siswa</h1>
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
                        <strong>Data Siswa</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('siswas/create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>Tambah
                        </a>
                        <a href="{{ route('siswas.import') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-upload"></i> Import
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>L/P</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($siswas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelamin }}</td>
                                    <td>{{ $item->kelas->kelas }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ url('siswas/' . $item->id . '/edit') }}" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('siswas/' . $item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
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
                    <!-- Pagination links -->
                <div class="">
                    <div>{{ $siswas->links() }}</div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
