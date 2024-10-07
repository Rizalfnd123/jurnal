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
                <div class="card-header" style="background-color: #F5DEB3; border-radius: 14px;">
                    <div class="pull-left mt-1">
                        <strong>Edit Data</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('mengajar') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body" style="background-color: #ffffff;"> <!-- Warna coklat muda -->
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ url('mengajar/'.$mengajar->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Hari</label> <!-- Warna coklat tua -->
                                        <select name="hari" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="Senin" {{ $mengajar->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                            <option value="Selasa" {{ $mengajar->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                            <option value="Rabu" {{ $mengajar->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                            <option value="Kamis" {{ $mengajar->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                            <option value="Jumat" {{ $mengajar->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                        </select>
                                    </div>
            
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Jam Mulai</label>
                                        <select name="jam_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            @foreach ($jam as $item)
                                                <option value="{{ $item->id }}" {{ $mengajar->jam_id == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Jam Selesai</label>
                                        <select name="jamselesai_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            @foreach ($jam as $item)
                                                <option value="{{ $item->id }}" {{ $mengajar->jamselesai_id == $item->id ? 'selected' : '' }}>{{ $item->jam }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Kelas</label>
                                        <select name="kelas_id" class="form-control select2-kelas" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}" {{ $mengajar->kelas_id == $item->id ? 'selected' : '' }}>{{ $item->kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Mata Pelajaran</label>
                                        <select name="mapel_id" class="form-control select2-mapel" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            @foreach ($mapel as $item)
                                                <option value="{{ $item->id }}" {{ $mengajar->mapel_id == $item->id ? 'selected' : '' }}>{{ $item->mapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
            
                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Semester</label>
                                        <select name="semester_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            @foreach ($semester as $item)
                                                <option value="{{ $item->id }}" {{ $mengajar->semester_id == $item->id ? 'selected' : '' }}>{{ $item->semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Tahun Pelajaran</label>
                                        <select name="tapel_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            @foreach ($tapel as $item)
                                                <option value="{{ $item->id }}" {{ $mengajar->tapel_id == $item->id ? 'selected' : '' }}>{{ $item->tapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Guru</label>
                                        <select name="guru_id" class="form-control select2-guru" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            @foreach ($guru as $item)
                                                <option value="{{ $item->id }}" {{ $mengajar->guru_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
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
