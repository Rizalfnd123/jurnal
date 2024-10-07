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
                    <strong class="card-title">Data Guru</strong>
                    <div class="pull-right">
                        <form action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                            @csrf
                            <div class="custom-file" style="width: auto; margin-right: 2px">
                                <input type="file" name="file" class="custom-file-input" id="customFile" placeholder="import dari excel">
                                <label class="custom-file-label" for="customFile">Pilih file</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-1">
                                <i class="fa fa-upload"></i> Import
                            </button>
                        </form>
                        <a href="{{ url('guru/add') }}" class="btn btn-success btn-sm mt-1">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
            
                <div class="card-body table-responsive">
                    {{-- <div class="mb-3">
                        <form method="GET" action="{{ route('guru.data') }}" class="form-inline">
                            <label for="per_page" class="mr-2">Tampilkan:</label>
                            <select name="per_page" id="per_page" class="form-control mr-2" onchange="this.form.submit()">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            </select>
                            <span class="mr-2">data </span>
                        </form>
                    </div> --}}
                    
                    <table id="bootstrap-data-table" class="table table-striped table-bordered rounded">
                        <thead>
                            <tr style="background-color: #a0522d; padding: 10px; border-radius: 5px;">
                                <th style="width: 50px;">No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>L/P</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Foto</th>
                                <th style="width: 80px;">Aksi</th>
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
                                    <td><img src="{{ asset('images/' . $item->foto) }}" alt="" width="100"></td>
                                    <td>
                                        <a href="{{ url('guru/edit/' . $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('guru/' . $item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
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
            
                    <div class="d-flex justify-content-center mt-3">
                        <div class="pagination-container" >
                            {{ $guru->links() }}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
@endsection
