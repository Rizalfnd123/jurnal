@extends('hmpimpinan')

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
                {{-- <a href="{{ url('/homejad') }}"> --}}
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-calendar-alt"></i> <!-- Ikon Jadwal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Absen guru hari ini</div>
                            <div class="text-3xl font-bold">{{ $absenToday }}</div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/pimpinan-guru') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-user"></i> <!-- Ikon Jurnal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Total Guru</div>
                            <div class="text-3xl font-bold">{{ $gurutotal }}</div>
                        </div>
                    </div>
                </a>
            </div>
        
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/pimpinan-siswa') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-user"></i> <!-- Ikon Izin -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Total Siswa</div>
                            <div class="text-3xl font-bold">{{ $siswatotal }}</div>
                        </div>
                    </div>
                </a>
            </div>
        
        
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/pimpinan-jadwal') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-calendar-alt"></i> <!-- Ikon Jadwal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Jadwal hari ini</div>
                            <div class="text-3xl font-bold">{{ $jadwalToday }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="text-xl font-semibold mb-4">Absen Hari Ini</div>
            <!-- Membuat tabel responsif dengan overflow-x-auto -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Guru</th>
                            <th class="py-3 px-6 text-left">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($absenguru as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6 text-left">{{ $item->guru->nama }}</td>
                                <!-- Ambil langsung dari kolom jam -->
                                <td class="py-3 px-6 text-left">{{ $item->created_at }}</td> <!-- Relasi mapel -->
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
