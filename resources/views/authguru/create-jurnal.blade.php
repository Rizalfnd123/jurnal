@extends('hmguru')

@section('title', 'Tambah Jurnal')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-4">Tambah Jurnal</h1>
</div>
@endsection

@section('content')
    <div class="content mt-5">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden mb-3">
                <div class="p-2">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold pt-3 ps-3">Form Jurnal</h2>
                        <a href="{{ url('jadwal-hari-ini-guru') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                             Kembali
                        </a>
                    </div>
                </div>
                <div class="p-4">
                    <form action="{{ url('jurnal-guru') }}" method="post" enctype="multipart/form-data" class="shadow-lg p-6 bg-gray-50 rounded-lg">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="kelas" class="block text-gray-700 text-xs">Kelas</label>
                                <input type="text" value="{{ $jadwal->kelas->kelas }}" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" readonly>
                            </div>

                            <div>
                                <label for="mapel" class="block text-gray-700 text-xs">Mata Pelajaran</label>
                                <input type="text" value="{{ $jadwal->mapel->mapel }}" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" readonly>
                            </div>

                            <div>
                                <label for="materi" class="block text-gray-700 text-xs">Materi</label>
                                <input type="text" name="materi" id="materi" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required autofocus>
                            </div>

                            <div>
                                <label for="dokumentasi" class="block text-gray-700 text-xs">Dokumentasi</label>
                                <input type="file" name="dokumentasi" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1">
                            </div>

                            <input type="hidden" name="mengajar_id" value="{{ $jadwal->id }}">
                        </div>

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
