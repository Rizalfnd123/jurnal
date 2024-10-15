@extends('hm')

@section('title', 'Edit Semester')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Edit Semester</h1>
</div>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-lg font-semibold">Edit Data Semester</h2>
                    <a href="{{ url('semester') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                </div>
                <form action="{{ url('semester/' . $semester->id) }}" method="post" class="space-y-4">
                    @method('patch')
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="semester" class="block text-sm text-gray-700">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                   value="{{ $semester->semester }}" autofocus required>
                        </div>
                        <div>
                            <label for="enum" class="block text-sm text-gray-700">Status</label>
                            <select name="enum" id="enum" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Aktif" {{ $semester->enum == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak aktif" {{ $semester->enum == 'Tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
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
