@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="w-full px-2">
        <h1 class="text-3xl font-bold text-white mb-3">Jadwal Mengajar</h1>
    </div>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-lg font-semibold">Edit Data Mengajar</h2>
                    <a href="{{ url('mengajar') }}"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                </div>
                <form action="{{ url('mengajar/' . $mengajar->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Kolom Kiri -->
                            <div>
                                <label class="block text-sm text-gray-700">Hari</label>
                                <select name="hari" class="mt-1 block w-full border-gray-300 rounded-md  shadow-lg  "
                                    required>
                                    <option value="Senin" {{ $mengajar->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ $mengajar->hari == 'Selasa' ? 'selected' : '' }}>Selasa
                                    </option>
                                    <option value="Rabu" {{ $mengajar->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ $mengajar->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ $mengajar->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-700">Jam Mulai</label>
                                <select name="jam_id" class="mt-1 block w-full border-gray-300 rounded-md  shadow-lg  "
                                    required>
                                    @foreach ($jam as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $mengajar->jam_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->jam }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-700">Jam Selesai</label>
                                <select name="jamselesai_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md  shadow-lg  " required>
                                    @foreach ($jam as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $mengajar->jamselesai_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->jam }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-700">Kelas</label>
                                <select name="kelas_id" class="mt-1 block w-full border-gray-300 rounded-md  shadow-lg  "
                                    required>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $mengajar->kelas_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-700">Mata Pelajaran</label>
                                <select name="mapel_id" class="mt-1 block w-full border-gray-300 rounded-md  shadow-lg  "
                                    required>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $mengajar->mapel_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->mapel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700">Semester</label>
                                <select name="semester_id" class="mt-1 block w-full border-gray-300 rounded-md  shadow-lg  "
                                    required>
                                    @foreach ($semester as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $mengajar->semester_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->semester }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-700">Tahun Pelajaran</label>
                                <select name="tapel_id" class="mt-1 block w-full border-gray-300 rounded-md  shadow-lg  "
                                    required>
                                    @foreach ($tapel as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $mengajar->tapel_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->tapel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700">Guru</label>
                                <select name="guru_id" class="mt-1 block w-full border-gray-300 rounded-md  shadow-lg  "
                                    required>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $mengajar->guru_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-6 text-right">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded transition duration-300">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
