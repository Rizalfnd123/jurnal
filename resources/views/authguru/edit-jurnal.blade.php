@extends('hmguru')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="w-full px-2">
        <h1 class="text-3xl font-bold text-white mb-3">Edit Jurnal</h1>
    </div>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-lg font-semibold">Edit Data Jurnal</h2>
                    <a href="{{ url('jurnal-guru') }}"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                </div>
                <form action="{{ url('jurnal-guru/' . $jurnal->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Input Tanggal -->
                        <div>
                            <label for="tanggal" class="block text-sm text-gray-700">Tanggal</label>
                            <input type="text" name="tanggal"
                                class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $jurnal->created_at->format('d/m/Y') }}" placeholder="dd/mm/yyyy" autofocus
                                required disabled>
                        </div>

                        <!-- Guru -->
                        <div>
                            <label for="guru_id" class="block text-sm text-gray-700">Guru</label>
                            <input name="guru_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $jurnal->guru->nama }}" disabled>
                        </div>

                        <!-- Kelas -->
                        <div>
                            <label for="kelas_id" class="block text-sm text-gray-700">Kelas</label>
                            <input name="kelas_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $jurnal->kelas->kelas }}" disabled>
                        </div>

                        <!-- Mata Pelajaran -->
                        <div>
                            <label for="mapel_id" class="block text-sm text-gray-700">Mata Pelajaran</label>
                            <input name="mapel_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $jurnal->mapel->mapel }}" disabled>
                        </div>

                        <!-- Materi -->
                        <div>
                            <label for="materi" class="block text-sm text-gray-700">Materi</label>
                            <input type="text" name="materi"
                                class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old('materi', $jurnal->materi) }}" required>
                        </div>

                        <!-- Dokumentasi -->
                        <div>
                            <label for="dokumentasi" class="block text-sm text-gray-700">Dokumentasi</label>
                            <input type="file" name="dokumentasi"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
                                onchange="previewImage(event)">
                            @if ($jurnal->dokumentasi)
                                <p class="text-sm text-gray-500 mt-1">File sebelumnya: {{ $jurnal->dokumentasi }}</p>
                            @else
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
