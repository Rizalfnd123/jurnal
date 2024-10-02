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
                <div class="card-header" style="background-color: #F5DEB3; border-radius: 14px">
                    <div class="pull-left mt-1">
                        <strong>Buat Data</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('mengajar') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body" style="background-color: #ffffff;"> <!-- Warna coklat muda -->
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ url('mengajar') }}" method="post">
                            @csrf
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Hari</label> <!-- Warna coklat tua -->
                                        <select name="hari" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required> <!-- Background coklat muda, teks coklat tua -->
                                            <option value="">-- Pilih Hari --</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Waktu</label>
                                        <select name="jam_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($jam as $item)
                                                <option value="{{ $item->id }}">{{ $item->jam }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Kelas</label>
                                        <select name="kelas_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Mata Pelajaran</label>
                                        <select name="mapel_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($mapel as $item)
                                                <option value="{{ $item->id }}">{{ $item->mapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                
                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Semester</label>
                                        <select name="semester_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($semester as $item)
                                                <option value="{{ $item->id }}">{{ $item->semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Tahun Pelajaran</label>
                                        <select name="tapel_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($tapel as $item)
                                                <option value="{{ $item->id }}">{{ $item->tapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Guru</label>
                                        <select name="guru_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($guru as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mt-12 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-success" style="background-color: #8B4513; border-color: #8B4513;">Simpan</button>
                                    </div>
                                </div>
                            </div>
                
                        </form>
                    </div>
                </div>
                
            </div>

        </div>

    </div>
@endsection
