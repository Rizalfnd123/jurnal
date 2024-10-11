@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Semester</h1>
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
                    <strong class="card-title">Data Semester</strong>
                    <div class="pull-right">
                        <a href="{{ url('semester/add') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered rounded">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th> <!-- Lebar kolom No -->
                                <th>Semester</th>
                                <th>Status</th>
                                <th style="width: 80px;">Aksi</th> <!-- Lebar kolom Aksi -->
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($semester as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>
                                        <span class="badge {{ $item->status == 'aktif' ? 'bg-success' : 'bg-secondary' }} rounded">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ url('semester/edit/' . $item->id) }}" class="btn btn-primary btn-sm rounded">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('semester/' . $item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm rounded">
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
