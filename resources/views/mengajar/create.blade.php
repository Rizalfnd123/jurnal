@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Jadwal Mengajar</h1>
</div>
@endsection

@section('content')
    <div class="content mt-5">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden mb-3">
                <div class="p-2">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-semibold pt-3 ps-3">Import Excel</h2>
                        <a href="{{ url('mengajar') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300 mb-3">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="p-2">
                    
                <!-- Form Import -->
                <form action="{{ url('mengajar/import') }}" method="post" enctype="multipart/form-data"
                class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                @csrf
                <!-- Input file -->
                <input type="file" name="file" required
                    class="py-2 pl-2 text-sm text-gray-700 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 w-full sm:w-auto">

                <!-- Tombol Submit -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center">
                    <i class="fa fa-upload"></i> Import
                </button>
            </form>
                </div>
                <div class="p-4 bg-gray-50">
                    <h2 class="text-lg font-semibold pt-3 ps-3 mb-3">Tambah Manual</h2>
                    <form action="{{ url('mengajar') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="hari" class="block text-gray-700 text-xs">Hari</label>
                                <select name="hari" id="hari" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                                    <option value="">-- Pilih Hari --</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="jam_id" class="block text-gray-700 text-xs">Jam Mulai</label>
                                <select name="jam_id" id="jam_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($jam as $item)
                                        <option value="{{ $item->id }}">{{ $item->jam }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="jamselesai_id" class="block text-gray-700 text-xs">Jam Selesai</label>
                                <select name="jamselesai_id" id="jamselesai_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($jam as $item)
                                        <option value="{{ $item->id }}">{{ $item->jam }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="kelas_id" class="block text-gray-700 text-xs">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1 select2-kelas" required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="mapel_id" class="block text-gray-700 text-xs">Mata Pelajaran</label>
                                <select name="mapel_id" id="mapel_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1 select2-mapel" required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}">{{ $item->mapel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="semester_id" class="block text-gray-700 text-xs">Semester</label>
                                <select name="semester_id" id="semester_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($semester as $item)
                                        <option value="{{ $item->id }}">{{ $item->semester }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="tapel_id" class="block text-gray-700 text-xs">Tahun Pelajaran</label>
                                <select name="tapel_id" id="tapel_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1" required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($tapel as $item)
                                        <option value="{{ $item->id }}">{{ $item->tapel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="guru_id" class="block text-gray-700 text-xs">Guru</label>
                                <select name="guru_id" id="guru_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm text-xs p-1 select2-guru" required>
                                    <option value="">-- pilih --</option>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
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
