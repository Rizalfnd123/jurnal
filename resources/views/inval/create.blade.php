@extends('hminval')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Isi Data Izin</h1>
</div>
@endsection

@section('content')
    <div class="content mt-5">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden mb-3">
                <div class="p-2">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold pt-3 ps-3">Data Izin</h2>
                        <a href="{{ url('invalizin') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            <i class="fa fa-undo"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="p-4">
                    <form action="{{ url('invalizin') }}" method="post" enctype="multipart/form-data" class="shadow-lg p-6 bg-gray-50 rounded-lg">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="ket" class="block text-gray-700 text-xs">Keterangan</label>
                                <input type="text" name="ket" id="ket" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required autofocus>
                            </div>

                            <div>
                                <label for="kegiatan" class="block text-gray-700 text-xs">Kegiatan</label>
                                <input type="text" name="kegiatan" id="kegiatan" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                            </div>

                            <div>
                                <label for="surat" class="block text-gray-700 text-xs">Surat</label>
                                <input type="file" name="surat" id="surat" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                            </div>

                            <div>
                                <label for="lampiran" class="block text-gray-700 text-xs">Lampiran</label>
                                <input type="file" name="lampiran" id="lampiran" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                            </div>
                        </div>

                        <input type="hidden" name="mengajar_id" value="{{ $jadwal->id }}">

                        <div class="mt-6 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded transition duration-300 text-xs">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
