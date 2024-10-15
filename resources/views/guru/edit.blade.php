@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Edit Guru</h1>
</div>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-lg font-semibold">Edit Data Guru</h2>
                    <a href="{{ url('guru') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                </div>
                <form action="{{ url('guru/' . $guru->id) }}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="nip" class="block text-sm text-gray-700">NIP</label>
                            <input type="text" name="nip" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" value="{{ $guru->nip }}" autofocus required>
                        </div>

                        <div>
                            <label for="nama" class="block text-sm text-gray-700">Nama</label>
                            <input type="text" name="nama" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" value="{{ $guru->nama }}" required>
                        </div>

                        <div>
                            <label for="kelamin" class="block text-sm text-gray-700">Jenis Kelamin</label>
                            <select name="kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" required>
                                <option value="L" {{ $guru->kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $guru->kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label for="username" class="block text-sm text-gray-700 ">Username</label>
                            <input type="text" name="username" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" value="{{ $guru->username }}" required>
                        </div>

                        <div>
                            <label for="password" class="block text-sm text-gray-700">Password</label>
                            <input type="password" name="password" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" required>
                        </div>

                        <div>
                            <label for="foto" class="block text-sm text-gray-700">Foto</label>
                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm ps-3" type="file" name="foto" id="foto" onchange="previewImage(event)">
                            @if ($guru->foto)
                                <img id="preview" src="{{ asset('images/' . $guru->foto) }}" alt="Preview Foto" class="mt-4 w-36 h-36 rounded-md">
                            @else
                                <img id="preview" src="#" alt="Preview Foto" class="mt-4 w-36 h-36 rounded-md hidden">
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
