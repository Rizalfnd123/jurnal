@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Edit Jurnal</h1>
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
                        <a href="{{ url('jurnal') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ url('jurnal/'.$jurnal->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ $jurnal->tanggal }}" autofocus required>
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Guru</label>
                                <select name="guru_id" class="form-control" required>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $jurnal->guru_id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <select name="kelas_id" class="form-control" required>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $jurnal->kelas_id ? 'selected' : '' }}>
                                            {{ $item->kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <select name="mapel_id" class="form-control" required>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $jurnal->mapel_id ? 'selected' : '' }}>
                                            {{ $item->mapel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                                                     
                            <div class="form-group">
                                <label>Materi</label>
                                <input type="text" name="materi" class="form-control" value="{{ $jurnal->materi }} "autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Hadir</label>
                                <input type="text" name="hadir" class="form-control" value="{{ $jurnal->hadir }} "autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Tidak Hadir</label>
                                <input type="text" name="tidak_hadir" class="form-control"value="{{ $jurnal->tidak_hadir }} "autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Dockumentasi</label>
                                <input type="file" name="dokumentasi" class="form-control"value="{{ $jurnal->dokumentasi }} "autofocus required>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
