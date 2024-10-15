@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Tambah Data Siswa</h1>
</div>
@endsection

@section('content')
    <div class="content mt-5">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden mb-3">
                <div class="p-4">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold pt-3 ps-3">Tambah Data</h2>
                        <a href="{{ url('siswas') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <form action="{{ url('siswas') }}" method="post" class="shadow-lg p-6 bg-gray-50 rounded-lg">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="nis" class="block text-gray-700 text-xs">NIS</label>
                                <input type="text" name="nis" id="nis" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required autofocus>
                            </div>

                            <div>
                                <label for="nama" class="block text-gray-700 text-xs">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                            </div>

                            <div>
                                <label for="kelamin" class="block text-gray-700 text-xs">Jenis Kelamin</label>
                                <select name="kelamin" id="kelamin" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label for="kelas_id" class="block text-gray-700 text-xs">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($kelas as $item )
                                        <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="status" class="block text-gray-700 text-xs">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak aktif</option>
                                </select>
                            </div>
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
