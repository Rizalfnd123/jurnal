@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Mapel</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active"><i class="fa fa-folder"></i></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content mt-3">

        <div class="animated fadeIn">
            <div class="card rounded-lg shadow-md">
                <div class="card-header bg-brown-600 text-black rounded-t-lg py-3 px-4 flex justify-between items-center">
                    <div class="pull-left">
                        <strong>Edit Data Mapel</strong>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('mapel') }}" class="btn btn-danger btn-sm rounded shadow">
                            <i class="fa fa-undo"></i> Kembali
                        </a>
                    </div>
                </div>
            
                <div class="card-body bg-white p-6 rounded-b-lg">
                    <div class="col-md-4 offset-md-4">
                        <form action="{{ url('mapel/'.$mapel->id) }}" method="post" class="space-y-4">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="mapel" class="font-semibold">Mata Pelajaran</label>
                                <input type="text" id="mapel" name="mapel" class="form-control shadow-md p-2 rounded-md border focus:ring focus:ring-brown-300 focus:border-brown-600" value="{{ $mapel->mapel }}" autofocus required>
                            </div>
                            <button type="submit" class="btn btn-success shadow-md w-full py-2 rounded bg-brown-600 hover:bg-brown-700 text-white">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            

        </div>

    </div>
@endsection
