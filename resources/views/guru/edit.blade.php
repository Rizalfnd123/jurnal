@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Guru</h1>
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
                        <strong>Edit Data Guru</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('guru') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ url('guru/' . $guru->id) }}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" name="nip" class="form-control"
                                    value="{{ $guru->nip }}"autofocus required>
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control"
                                    value="{{ $guru->nama }}"autofocus required>
                                <label>Jenis Kelamin</label><br>
                                <select name="kelamin" class="form-select" aria-label="Default select example">
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                </select><br>
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ $guru->username }}"autofocus required>
                                <label>Password</label>
                                <input type="text" name="password" class="form-control"
                                    value="{{ $guru->password }}"autofocus required>
                                <label for="foto" class="form-label">Foto</label>
                                <input class="form-control" type="file" name="foto" id="foto"
                                    value="{{ $guru->foto }}">
                                @if ($guru->foto)
                                    <img id="preview" src="{{ asset('images/' . $guru->foto) }}" alt="Preview Foto"
                                        style="display:block; width: 150px; margin-top: 10px;" />
                                @else
                                    <img id="preview" src="#" alt="Preview Foto"
                                        style="display:none; width: 150px; margin-top: 10px;" />
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    
@endsection
