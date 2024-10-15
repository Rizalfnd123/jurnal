@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Edit Siswa</h1>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <div class="flex justify-between mb-4">
                <h2 class="text-lg font-semibold">Edit Data Siswa</h2>
                <a href="{{ url('siswas') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Kembali
                </a>
            </div>
            <form action="{{ url('siswas/' . $siswas->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="nis" class="block text-sm text-gray-700">NIS</label>
                        <input type="text" name="nis" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" value="{{ $siswas->nis }}" autofocus required>
                    </div>

                    <div>
                        <label for="nama" class="block text-sm text-gray-700">Nama</label>
                        <input type="text" name="nama" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" value="{{ $siswas->nama }}" required>
                    </div>

                    <div>
                        <label for="kelamin" class="block text-sm text-gray-700">Jenis Kelamin</label>
                        <select name="kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" required>
                            <option value="L" {{ $siswas->kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $siswas->kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label for="kelas_id" class="block text-sm text-gray-700">Kelas</label>
                        <select name="kelas_id" class="form-control ps-3" required>
                            <option value="">-- pilih --</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}" {{ $siswas->kelas_id == $item->id ? 'selected' : '' }}>{{ $item->kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm ps-3" required>
                            <option value="aktif" {{ $siswas->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ $siswas->status == 'tidak aktif' ? 'selected' : '' }}>Tidak aktif</option>
                        </select>
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
@endsection
