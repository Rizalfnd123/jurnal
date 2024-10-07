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
                        <strong class="card-title">Data Siswa</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('siswas/create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                        <a href="{{ route('siswas.import') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-upload"></i> Import
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered rounded">
                        <thead>
                            <tr style="background-color: #a0522d; padding: 10px; border-radius: 5px;">
                                <th style="width: 50px;">No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>L/P</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th style="width: 80px;">Aksi</th>
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
                                    <td>
                                        <span class="badge {{ $item->status == 'aktif' ? 'bg-success' : 'bg-secondary' }} rounded">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ url('siswas/' . $item->id . '/edit') }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('siswas/' . $item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            
                    <!-- Pagination links -->
                    <div class="d-flex justify-content-center mt-3">
                        <div class="pagination-container" >
                            {{ $siswas->links() }}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
