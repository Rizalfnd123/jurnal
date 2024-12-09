@extends('hmbk')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="">
        <h3 class="text-3xl font-bold text-white mb-3">Dashboard {{ Auth::user()->name }}</h3>
    </div>
@endsection

@section('content')
    <div class="w-full px-2"> <!-- Tambahkan informasi lokasi di sini -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/siswa-bk') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-user"></i> <!-- Ikon Jurnal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Total Siswa</div>
                            <div class="text-3xl font-bold">{{ $jumlahsiswa }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                {{-- <a href="{{ url('/siswa-bk') }}"> --}}
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-school"></i> <!-- Ikon Jurnal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Total Kelas</div>
                            <div class="text-3xl font-bold">{{ $jumlahkelas }}</div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                {{-- <a href="{{ url('/siswa-bk') }}"> --}}
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-folder"></i> <!-- Ikon Jurnal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Total Rekap</div>
                            <div class="text-3xl font-bold">{{ $jumlahrekap }}</div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                {{-- <a href="{{ url('/siswa-bk') }}"> --}}
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-clock"></i> <!-- Ikon Jurnal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Absen Hari Ini</div>
                            <div class="text-3xl font-bold">{{ $absensitoday }} Siswa</div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
        </div>
        {{-- <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="text-xl font-semibold mb-4">Data Jurnal</div>
            <!-- Membuat tabel responsif dengan overflow-x-auto -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Nama Guru</th>
                            <th class="py-3 px-6 text-left">Kelas</th>
                            <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                            <th class="py-3 px-6 text-left">Waktu isi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($jurnalToday as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $item->guru->nama }}</td>
                                <td class="py-3 px-6 text-left">{{ $item->kelas->kelas }}</td>
                                <td class="py-3 px-6 text-left">{{ $item->mapel->mapel }}</td>
                                <td class="py-3 px-6 text-left">{{ $item->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
@endsection
