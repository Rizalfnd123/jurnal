@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>izin</h1>
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
                        <strong>Edit Data izin</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('izin') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ url('izin') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="ket" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Kegiatan</label>
                                <input type="text" name="kegiatan" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Surat</label>
                                <input type="file" name="surat" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="file" name="lampiran" class="form-control" autofocus required>
                            </div>
                            <input type="hidden" name="mengajar_id" value="{{ $jadwal->id }}">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
