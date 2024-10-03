@extends('main')

@section('title', 'Import Data Siswa')

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <!-- Tampilkan pesan sukses -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Tampilkan pesan error -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tampilkan error validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <strong>Import Data Siswa</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('siswas.import.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Pilih File Excel (xlsx/csv)</label>
                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                        
                        <!-- Tampilkan error khusus untuk input file -->
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
