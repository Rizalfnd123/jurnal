@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="w-full px-2">
        <h1 class="text-3xl font-bold text-white mb-3">Tambah Guru</h1>
    </div>
@endsection

@section('content')
    <div class="content mt-5">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden mb-3">
                <div class="p-2">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold pt-3 ps-3">Import Data Excel</h2>
                        <a href="{{ url('guru') }}"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="p-2">
                    <form action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                        @csrf
                        <input type="file" name="file" required
                            class="w-full sm:w-auto py-2 pl-2 text-sm text-gray-700 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600"
                            placeholder="Pilih file">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa fa-upload"></i> Import
                        </button>
                        <a href="{{ asset('template_guru.xlsx') }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <i class="fa fa-download"></i> Template Guru
                        </a>
                    </form>
                </div>

                <div class="p-2">
                    <div class="flex justify-start">
                        <h2 class="text-lg font-semibold pt-3 ps-3">Tambah Data Manual</h2>
                    </div>
                </div>
                <div class="p-4">
                    <form action="{{ url('guru') }}" method="post" enctype="multipart/form-data"
                        class="shadow-lg p-6 bg-gray-50 rounded-lg">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="nip" class="block text-gray-700 text-xs">NIP</label>
                                <input type="text" name="nip" id="nip"
                                    class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1"
                                    required autofocus>
                            </div>

                            <div>
                                <label for="nama" class="block text-gray-700 text-xs">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1"
                                    required>
                            </div>

                            <div>
                                <label for="kelamin" class="block text-gray-700 text-xs">Jenis Kelamin</label>
                                <select name="kelamin" id="kelamin"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1"
                                    required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label for="username" class="block text-gray-700 text-xs">Username</label>
                                <input type="text" name="username" id="username"
                                    class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1"
                                    required>
                            </div>

                            <div>
                                <label for="password" class="block text-gray-700 text-xs">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1"
                                    required>
                            </div>

                            <div>
                                <label for="foto" class="block text-gray-700 text-xs">Foto</label>
                                <input class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm text-xs p-1"
                                    type="file" name="foto" id="foto" onchange="previewImage(event)">
                                @if (isset($guru->foto))
                                    <img id="preview" src="{{ asset('images/' . $guru->foto) }}" alt="Preview Foto"
                                        class="mt-4 w-36 h-36 rounded-md">
                                @else
                                    <img id="preview" src="#" alt="Preview Foto"
                                        class="mt-4 w-36 h-36 rounded-md hidden">
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 text-right">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded transition duration-300 text-xs">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
