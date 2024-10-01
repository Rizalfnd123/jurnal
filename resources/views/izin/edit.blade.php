@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Edit izin</h1>
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
                        <strong>Edit Data</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('izin') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ url('izin/'.$izin->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control"value="{{ $izin->tanggal }} "autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Guru</label>
                                <select type="text" name="guru_id" class="form-control"value="{{ $izin->guru }} "required>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <select type="text" name="kelas_id" class="form-control"value="{{ $izin->kelas }} "required>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <select type="text" name="mapel_id" class="form-control"value="{{ $izin->mapel }} "required>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}">{{ $item->mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="ket" class="form-control" value="{{ $izin->ket }} "autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Kegiatan</label>
                                <input type="text" name="kegiatan" class="form-control" value="{{ $izin->kegiatan }} "autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Surat</label>
                                <input type="file" name="surat" class="form-control"value="{{ $izin->surat }} "autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="file" name="lampiran" class="form-control"value="{{ $izin->lampiran}} "autofocus required>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
