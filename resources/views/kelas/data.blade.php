@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Kelas</h1>
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
                        <strong>Data Kelas</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('kelas/add') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($kelas as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($kelas->currentPage()-1) * $kelas->perPage() }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>
                                        <a href="{{ url('kelas/edit/' . $item->id) }}" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <form action="{{ url('kelas/' . $item->id) }}" method="post" class="d-inline"
                                            onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"> Hapus</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            
                    <!-- Show pagination information and buttons -->
                    <div>
                        
                        <div>
                            <!-- Pagination on the right -->
                            {{ $kelas->links() }}
                        </div>
                    </div>
                </div>
            </div>
            

        </div>

    </div>
@endsection
