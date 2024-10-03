@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Guru</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active"><i class="fa fa-user"></i></li>
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
                    <div class="row">
                        <div class="col-md-4">
                            <strong class="mr-3">Data Guru</strong>
                            
                        </div>
                        <div class="col-md-8 text-right">
                            <form action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data"
                                style="">
                                @csrf
                                <div class="custom-file " style="width: auto; margin-right: 2px">
                                    <input type="file" name="file" class="custom-file-input" id="customFile" placeholder="import dari excel">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm mt-1" style="">
                                    <i class="fa fa-upload"></i> Import
                                </button>
                                <a href="{{ url('guru/add') }}" class="btn btn-success btn-sm text-right mt-1">
                                    <i class="fa fa-plus"></i> Tambah
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>L/P</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($guru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelamin }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->password }}</td>
                                    <td><img src="{{ asset('images/' . $item->foto) }}" alt="" width="100">
                                    </td>
                                    <td>
                                        <a href="{{ url('guru/edit/' . $item->id) }}" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('guru/' . $item->id) }}" method="post" class="d-inline"
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
                    <div class="">
                        <div>{{ $guru->links() }}</div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
