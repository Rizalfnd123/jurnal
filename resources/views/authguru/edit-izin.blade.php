@extends('hmguru')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="w-full px-2">
        <h1 class="text-3xl font-bold text-white mb-3">Edit Izin</h1>
    </div>
@endsection

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-lg font-semibold">Edit Data Izin</h2>
                    <a href="{{ url('izin-guru') }}"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                </div>

                <form action="{{ url('izin-guru/' . $izin->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="tanggal" class="block text-sm text-gray-700">Tanggal</label>
                            <input type="text" name="tanggal"
                                class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $izin->created_at->format('d/m/Y') }}" placeholder="dd/mm/yyyy" autofocus
                                required>
                        </div>
                        <div>
                            <label for="guru_id" class="block text-sm text-gray-700">Guru</label>
                            <input name="guru_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $izin->guru->nama }}" disabled>
                        </div>

                        <div>
                            <label for="kelas_id" class="block text-sm text-gray-700">Kelas</label>
                            <input name="kelas_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $izin->kelas->kelas }}" disabled>
                        </div>

                        <div>
                            <label for="mapel_id" class="block text-sm text-gray-700">Mata Pelajaran</label>
                            <input name="mapel_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $izin->mapel->mapel }}" disabled>
                        </div>

                        <div>
                            <label for="ket" class="block text-sm text-gray-700">Keterangan</label>
                            <input type="text" name="ket"
                                class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $izin->ket }}" required>
                        </div>

                        <div>
                            <label for="kegiatan" class="block text-sm text-gray-700">Kegiatan</label>
                            <input type="text" name="kegiatan"
                                class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $izin->kegiatan }}" required>
                        </div>

                        <div>
                            <label for="surat" class="block text-sm text-gray-700">Surat</label>
                            <input type="file" name="surat"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            @if ($izin->surat)
                                <p class="text-sm text-gray-500 mt-1">File sebelumnya: {{ $izin->surat }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="lampiran" class="block text-sm text-gray-700">Lampiran</label>
                            <input type="file" name="lampiran"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            @if ($izin->lampiran)
                                <p class="text-sm text-gray-500 mt-1">File sebelumnya: {{ $izin->lampiran }}</p>
                            @endif
                        </div>

                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded transition duration-300">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
