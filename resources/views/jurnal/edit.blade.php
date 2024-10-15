@extends('hm')

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
                    <a href="{{ url('jurnal') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                </div>
                <form action="{{ url('jurnal/' . $jurnal->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="tanggal" class="block text-sm text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $jurnal->tanggal }}" autofocus required>
                        </div>

                        <div>
                            <label for="guru_id" class="block text-sm text-gray-700">Guru</label>
                            <select name="guru_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $jurnal->guru_id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="kelas_id" class="block text-sm text-gray-700">Kelas</label>
                            <select name="kelas_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $jurnal->kelas_id ? 'selected' : '' }}>
                                        {{ $item->kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="mapel_id" class="block text-sm text-gray-700">Mata Pelajaran</label>
                            <select name="mapel_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $jurnal->mapel_id ? 'selected' : '' }}>
                                        {{ $item->mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="materi" class="block text-sm text-gray-700">Materi</label>
                            <input type="text" name="materi" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $jurnal->materi }}" required>
                        </div>

                        <div>
                            <label for="hadir" class="block text-sm text-gray-700">Hadir</label>
                            <input type="text" name="hadir" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $jurnal->hadir }}" required>
                        </div>

                        <div>
                            <label for="tidak_hadir" class="block text-sm text-gray-700">Tidak Hadir</label>
                            <input type="text" name="tidak_hadir" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $jurnal->tidak_hadir }}" required>
                        </div>

                        <div>
                            <label for="dokumentasi" class="block text-sm text-gray-700">Dokumentasi</label>
                            <input type="file" name="dokumentasi" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" onchange="previewImage(event)">
                            @if ($jurnal->dokumentasi)
                                <img id="preview" src="{{ asset('images/' . $jurnal->dokumentasi) }}" alt="Preview Dokumentasi" class="mt-4 w-36 h-36 rounded-md">
                            @else
                                <img id="preview" src="#" alt="Preview Dokumentasi" class="mt-4 w-36 h-36 rounded-md hidden">
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded transition duration-300">
                            Simpan
                        </button>
                    </div>
                </form>
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
