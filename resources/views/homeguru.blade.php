@extends('hmguru')

@section('title', 'Dashboard')

@section('breadcrumbs') 
    <div class="">
        <h3 class="text-3xl font-bold text-white mb-3">Dashboard {{ Auth::guard('guru')->user()->nama }}</h3>
    </div>
@endsection

@section('content')
    <div class="w-full px-2"> <!-- Tambahkan informasi lokasi di sini -->
        <div id="location" class="bg-white rounded-lg shadow-lg p-6 mt-4 mb-4">
            <h4 class="font-semibold">Lokasi Anda:</h4>
            <p>Desa: <span id="desa">Loading...</span></p>
            <p>Kecamatan: <span id="kecamatan">Loading...</span></p>
            <p>Kota: <span id="kota">Loading...</span></p>
            <p>Latitude: <span id="lat">Loading...</span></p>
            <p>Longitude: <span id="lon">Loading...</span></p>
            <p id="radiusMessage" class="text-red-500 font-semibold "></p>
            <form id="absenForm" action="{{ route('absen-guru') }}" method="POST">
                @csrf
                <input type="hidden" name="guru_id" value="{{ $guruId }}"> <!-- ID Guru -->
                <input type="hidden" name="lokasi" id="lokasiInput"> <!-- Lokasi -->
                <input type="hidden" name="created_at" value="{{ now() }}">
                <input type="hidden" name="updated_at" value="{{ now() }}">
            
                <button id="absensiBtn"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mt-2"
                    {{ $sudahAbsen ? 'disabled' : '' }}>
                    {{ $sudahAbsen ? 'Anda sudah absen' : 'Absensi Sekarang' }}
                </button>
                {{-- <p id="absensiStatus" class="mt-2 text-green-600 font-semibold">
                    {{ $sudahAbsen ? 'Anda sudah absen hari ini.' : '' }}
                </p> --}}
            </form>
            @if(session('success'))
                <p class="text-green-600 font-semibold">{{ session('success') }}</p>
            @endif
                          
        </div>
        <div id="map" class="bg-white rounded-lg shadow-lg p-6 mt-4 mb-4" style="height: 300px;">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-4 mb-4">
            <div
                class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/home') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-book"></i> <!-- Ikon Jurnal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Jurnal hari ini</div>
                            <div class="text-3xl font-bold">{{ $jurnalTodayCount }}</div>
                        </div>
                    </div>
                </a>
            </div>

            <div
                class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/homeizin') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-info-circle"></i> <!-- Ikon Izin -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Izin hari ini</div>
                            <div class="text-3xl font-bold">{{ $izinTodayCount }}</div>
                        </div>
                    </div>
                </a>
            </div>

            <div
                class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/homejad') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-calendar-alt"></i> <!-- Ikon Jadwal -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Jadwal hari ini</div>
                            <div class="text-3xl font-bold">{{ $jadwalTodayCount }}</div>
                        </div>
                    </div>
                </a>
            </div>

            <div
                class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/home') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-folder"></i> <!-- Ikon Rekap -->
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Rekap hari ini</div>
                            <div class="text-3xl font-bold">{{ $jurnalTodayCount }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
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
        </div>
    </div>
@endsection
