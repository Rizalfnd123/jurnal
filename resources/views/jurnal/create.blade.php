@extends('main')

@section('title', 'Tambah Jurnal')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Tambah Jurnal</h1>
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
                        <strong>Tambah Data</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('jurnal') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ url('jurnal') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" value="{{ $jadwal->kelas->kelas }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <input type="text" value="{{ $jadwal->mapel->mapel }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Materi</label>
                                <input type="text" name="materi" class="form-control" autofocus required>
                            </div>
{{--                             
                            <div class="form-group">
                                <label>Hadir</label>
                                <input type="number" name="hadir" class="form-control" value="{{ $absensi->hadir ?? 0 }}" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Tidak Hadir</label>
                                <input type="number" name="tidak_hadir" class="form-control" value="{{ $absensi->tidak_hadir ?? 0 }}" autofocus required>
                            </div> --}}
                            <div class="form-group">
                                <label>Dokumentasi</label>
                                <input type="file" name="dokumentasi" class="form-control" autofocus>
                            </div>
                            <input type="hidden" name="mengajar_id" value="{{ $jadwal->id }}">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                        {{-- <div class="mt-3 mb-3 rounded">
                            <form action="{{ url('absensi') }}" method="get">
                                <label>Absensi siswa</label><br>
                                <input type="hidden" name="mengajar_id" value="{{ $jadwal->id }}">
                                <button type="submit" class="btn btn-primary">Isi Absensi</button>
                            </form>
                        </div> --}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
