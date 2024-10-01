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
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <strong>Edit Data Siswa</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('siswas') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ url('siswas') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" name="nis" class="form-control" autofocus required>
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" autofocus required>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label><br>
                                <select name="kelamin" class="form-select" aria-label="Default select example">
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                </select><br>
                                </div>
                                <div class="form-group">
                                <label>Kelas</label>
                                <select type="text" name="kelas_id" class="form-control"required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($kelas as $item )
                                    <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                               </div>
                               <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak atif">Tidak aktif</option>
                                </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
