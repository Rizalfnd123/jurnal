@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Jam</h1>
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
                    <strong class="card-title">Data Jam</strong>
                    <div class="pull-right">
                        <a href="{{ url('jam/add') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered rounded">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th> <!-- Lebar kolom No -->
                                <th style="width: 200px;">Jam</th> <!-- Lebar kolom Jam -->
                                <th style="width: 80px;">Aksi</th> <!-- Lebar kolom Aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jam as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->jam }}</td>
                                    <td>
                                        <a href="{{ url('jam/edit/' . $item->id) }}" class="btn btn-primary rounded btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('jam/' . $item->id) }}" method="post" class="d-inline"
                                            onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger rounded btn-sm">
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
