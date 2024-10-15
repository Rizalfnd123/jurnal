@extends('hm')

@section('title', 'Edit Tahun Pelajaran')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Edit Tahun Pelajaran</h1>
</div>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-lg font-semibold">Edit Data Tahun Pelajaran</h2>
                    <a href="{{ url('tapel') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                </div>
                <form action="{{ url('tapel/' . $tapel->id) }}" method="post" class="space-y-4">
                    @method('patch')
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="tapel" class="block text-sm text-gray-700">Tahun Pelajaran</label>
                            <input type="text" name="tapel" id="tapel" 
                                   class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                   value="{{ $tapel->tapel }}" autofocus required>
                        </div>
                        <div>
                            <label for="enum" class="block text-sm text-gray-700">Status</label>
                            <select name="enum" id="enum" 
                                    class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                    aria-label="Default select example">
                                <option value="Aktif" {{ $tapel->enum == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak aktif" {{ $tapel->enum == 'Tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
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
