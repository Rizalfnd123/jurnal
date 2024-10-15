@extends('hm')

@section('title', 'Tambah Data Semester')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Tambah Data Semester</h1>
</div>
@endsection

@section('content')
    <div class="content mt-5">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden mb-3">
                <div class="p-2">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold pt-3 ps-3">Tambah Data Semester</h2>
                        <a href="{{ url('semester') }}"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="p-4">
                    <form action="{{ url('semester') }}" method="post" class="shadow-lg p-6 bg-gray-50 rounded-lg">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="semester" class="block text-gray-700 text-xs">Semester</label>
                                <input type="text" name="semester" id="semester"
                                       class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1"
                                       required autofocus>
                            </div>
                            <div>
                                <label for="enum" class="block text-gray-700 text-xs">Status</label>
                                <select name="enum" id="enum" 
                                        class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1"
                                        aria-label="Default select example">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak aktif">Tidak Aktif</option>
                                </select>
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
@endsection
