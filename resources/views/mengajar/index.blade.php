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
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Mengajar</strong>
                    <div class="pull-right">
                        <a href="{{ url('mengajar/create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered rounded">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 100px;">Hari</th>
                                <th >Waktu</th>
                                <th style="width: 200px;">Kelas</th>
                                <th style="width: 200px;">Mata Pelajaran</th>
                                <th style="width: 200px;">Guru</th>
                                <th style="width: 80px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mengajars as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->jam->jam }} - {{ $item->jamselesai->jam }}</td> <!-- Jam yang digabungkan -->
                                    <td>{{ $item->kelas->kelas }}</td>
                                    <td>{{ $item->mapel->mapel }}</td>
                                    <td>{{ $item->guru->nama }}</td>
                                    <!-- Tombol Edit -->
                                    <td>
                                        <a href="{{ url('mengajar/' . $item->id . '/edit') }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('mengajar/' . $item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                            @method('DELETE')
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
    <!-- Modal untuk Edit Data -->
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #F5DEB3; border-radius: 14px;">
                    <h5 class="modal-title" id="editModalLabel" style="color: #8B4513;">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: #ffffff;">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ url('mengajar/update') }}" method="post" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Hari</label>
                                        <select name="hari" id="hari" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- Pilih Hari --</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Jam Mulai</label>
                                        <select name="jam_id" id="jam_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($jam as $item)
                                                <option value="{{ $item->id }}">{{ $item->jam }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Jam Selesai</label>
                                        <select name="jamselesai_id" id="jamselesai_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($jam as $item)
                                                <option value="{{ $item->id }}">{{ $item->jam }}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Kelas</label>
                                        <select name="kelas_id" id="kelas_id" class="form-control select2-kelas" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                        </select>
                                    </div>
    
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Mata Pelajaran</label>
                                        <select name="mapel_id" id="mapel_id" class="form-control select2-mapel" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                        </select>
                                    </div>
                                </div>
    
                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Semester</label>
                                        <select name="semester_id" id="semester_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($semester as $item)
                                                <option value="{{ $item->id }}">{{ $item->semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Tahun Pelajaran</label>
                                        <select name="tapel_id" id="tapel_id" class="form-control" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
                                            @foreach ($tapel as $item)
                                                <option value="{{ $item->id }}">{{ $item->tapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="form-group">
                                        <label style="color: #8B4513;">Guru</label>
                                        <select name="guru_id" id="guru_id" class="form-control select2-guru" style="background-color: #F5DEB3; color: #8B4513;" required>
                                            <option value="">-- pilih --</option>
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
