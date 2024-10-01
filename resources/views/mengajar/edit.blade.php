@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Jadwal Mengajar</h1>
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
                        <a href="{{ url('mengajar') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ url('mengajar/'.$mengajar->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Hari</label> 
                                <input type="text" name="hari" class="form-control" value="{{ $mengajar->hari }}" autofocus required>
                                <div class="form-group"><br>
                                    <label>Waktu</label>
                                    <select type="text" name="jam_id" class="form-control" value="{{ $mengajar->jam }}" required>
                                        @foreach ($jam as $item)
                                            <option value="{{ $item->id }}">{{ $item->jam }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select type="text" name="kelas_id" class="form-control"value="{{ $mengajar->kelas }}"required>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mata Pelajaran</label>
                                    <select type="text" name="mapel_id" class="form-control"value="{{ $mengajar->mapel }}"required>
                                        @foreach ($mapel as $item)
                                            <option value="{{ $item->id }}">{{ $item->mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select type="text" name="semester_id" class="form-control"value="{{ $mengajar->semester }}"required>
                                        @foreach ($semester as $item)
                                            <option value="{{ $item->id }}">{{ $item->semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tahun Pelajaran</label>
                                    <select type="text" name="tapel_id" class="form-control"value="{{ $mengajar->tapel }}"required>
                                        @foreach ($tapel as $item)
                                            <option value="{{ $item->id }}">{{ $item->tapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Guru</label>
                                    <select type="text" name="guru_id" class="form-control"value="{{ $mengajar->guru }}"required>
                                        @foreach ($guru as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
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
