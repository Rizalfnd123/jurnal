@extends('main')

@section('title', 'Isi Absensi')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Isi Absensi</h1>
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
                        <strong>Absensi Siswa</strong>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tampilkan informasi jurnal -->
                    <table class="table table-striped">
                        <tr>
                            <th>Nama Guru</th>
                            <td>{{ $jurnal->guru->nama }}</td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td>{{ $jurnal->mapel->mapel }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $jurnal->kelas->kelas }}</td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td>{{ $jurnal->jam->jam }}</td>
                        </tr>
                    </table>

                    <!-- Form untuk Absensi -->
                    <form action="{{ url('absensi/store') }}" method="post">
                        @csrf
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Hadir <input type="checkbox" id="checkAllHadir"></th>
                                    <th>Izin <input type="checkbox" id="checkAllIzin"></th>
                                    <th>Sakit <input type="checkbox" id="checkAllSakit"></th>
                                    <th>Alpa <input type="checkbox" id="checkAllAlpa"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswaList as $siswa)
                                    <tr>
                                        <td>{{ $siswa->nama }}</td>
                                        <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                        <td><input type="checkbox" class="hadir-checkbox" name="hadir[{{ $siswa->id }}]"
                                                value="H"></td>
                                        <td><input type="checkbox" class="izin-checkbox" name="izin[{{ $siswa->id }}]"
                                                value="I"></td>
                                        <td><input type="checkbox" class="sakit-checkbox" name="sakit[{{ $siswa->id }}]"
                                                value="S"></td>
                                        <td><input type="checkbox" class="alpa-checkbox" name="alpa[{{ $siswa->id }}]"
                                                value="A"></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <input type="hidden" name="jurnals_id" value="{{ $jurnal->id }}">
                        <button type="submit" class="btn btn-success">Simpan Absensi</button>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('tbody tr').forEach(row => {
            let hadir = row.querySelector('.hadir-checkbox');
            let izin = row.querySelector('.izin-checkbox');
            let sakit = row.querySelector('.sakit-checkbox');
            let alpa = row.querySelector('.alpa-checkbox');

            [hadir, izin, sakit, alpa].forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    [hadir, izin, sakit, alpa].forEach(box => {
                        if (box !== this) box.checked = false;
                    });
                });
            });
        });
    </script>
@endsection
