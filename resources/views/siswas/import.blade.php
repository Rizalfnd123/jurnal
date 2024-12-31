@extends('hm')

@section('title', 'Import Data Siswa')

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <!-- Tampilkan pesan sukses -->
        @if (session('status'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Tampilkan pesan error -->
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tampilkan error validation -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <h2 class="text-lg font-semibold mb-4">Import Data Siswa</h2>
            <form action="{{ route('siswas.import.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="block text-sm text-gray-700">Pilih File Excel (xlsx/csv)</label>
                    <input type="file" name="file" id="file" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('file') is-invalid @enderror" required>
        
                    <!-- Tampilkan error khusus untuk input file -->
                    @error('file')
                        <span class="text-red-600 text-sm mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ url('siswas') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                    <div class="flex space-x-2">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Import
                        </button>
                        <a href="{{ asset('template_siswa.xlsx') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Template Siswa
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection
