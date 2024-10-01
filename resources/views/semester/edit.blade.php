@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Semester</h1>
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
                        <strong>Edit Data Semester</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('semester') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-undo"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ url('semester/' . $semester->id) }}" method="post">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label>semester</label>
                                <input type="text" name="semester" class="form-control"
                                    value="{{ $semester->semester }}"autofocus required>
                            </div>
                            <select name="enum" class="form-select" aria-label="Default select example">
                                {{-- <option selected>Open this select menu</option> --}}
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak aktif">Tidak Aktif</option>
                              </select>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
