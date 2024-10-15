@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="w-full px-6">
        <h3 class="text-3xl font-bold text-white mb-3">Dashboard</h3>
    </div>
@endsection

@section('content')
    <div class="w-full px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/home') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Jurnal hari ini</div>
                            <div class="text-3xl font-bold">{{ $jurnalTodayCount }}</div>
                        </div>
                    </div>
                </a>
            </div>
        
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/homeizin') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Izin hari ini</div>
                            <div class="text-3xl font-bold">{{ $jurnalTodayCount }}</div>
                        </div>
                    </div>
                </a>
            </div>
        
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/homejad') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-700 font-semibold">Jadwal hari ini</div>
                            <div class="text-3xl font-bold">{{ $jadwalTodayCount }}</div>
                        </div>
                    </div>
                </a>
            </div>
        
            <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition duration-300">
                <a href="{{ url('/home') }}">
                    <div class="flex items-center">
                        <div class="text-amber-900 text-5xl">
                            <i class="fas fa-folder"></i>
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
            <div class="text-xl font-semibold mb-4">Data izin</div>
            <!-- Membuat tabel responsif dengan overflow-x-auto -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Waktu</th>
                            <th class="py-3 px-6 text-left">Nama Guru</th>
                            <th class="py-3 px-6 text-left">Kelas</th>
                            <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                            <th class="py-3 px-6 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($izinToday as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6 text-left">{{ $item->created_at }}</
                                                <td>{{ $item->guru->nama }}</td>
                                                <td>{{ $item->kelas->kelas }}</td>
                                                <td>{{ $item->mapel->mapel }}</td>
                                                <td>
                                                    <a href="{{ url('izin') }}" class="btn btn-warning">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div>
    </div>
@endsection
