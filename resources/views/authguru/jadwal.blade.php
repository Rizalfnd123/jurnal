@extends('hmguru')

@section('title', 'Jadwal Mengajar')

@section('breadcrumbs')
    <div class="w-full px-2">
        <h3 class="text-3xl font-bold text-white mb-3">Jadwal</h3>
    </div>
@endsection

@section('content')
    <div class="w-full px-2">
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="text-lg font-semibold mb-4">Data Jadwal Mengajar</div>
        
            <!-- Filter Hari -->
            <div class="mb-4">
                <form action="{{ url('pimpinan-jadwal') }}" method="GET" class="flex items-center">
                    <label for="filter-hari" class="mr-2">Filter Hari:</label>
                    <select name="hari" id="filter-hari" class="border rounded-md p-2">
                        <option value="">Semua</option>
                        <option value="Senin" {{ request('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ request('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ request('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ request('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ request('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded ml-2">
                        Filter
                    </button>
                </form>
            </div>
        
            <!-- Tombol Tambah -->
            {{-- <div class="flex flex-col sm:flex-row items-center justify-between mb-4 space-y-2 sm:space-y-0 sm:space-x-4">
                <a href="{{ url('mengajar/create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </div> --}}
        
            <!-- Tabel Jadwal Mengajar -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg mx-auto">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                            <th class="px-2 py-3 text-center">
                                <a href="?sort_by=hari&order={{ request('order') == 'asc' ? 'desc' : 'asc' }}">Hari</a>
                            </th>
                            <th class="px-2 py-3 text-center">
                                <a href="?sort_by=jam&order={{ request('order') == 'asc' ? 'desc' : 'asc' }}">Jam</a>
                            </th>
                            <th class="px-2 py-3 text-center">
                                <a href="?sort_by=kelas&order={{ request('order') == 'asc' ? 'desc' : 'asc' }}">Kelas</a>
                            </th>
                            <th class="px-2 py-3 text-center">Mata Pelajaran</th>
                            <th class="px-2 py-3 text-center">Guru</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-xs font-light">
                        @foreach ($mengajars as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-2 py-3 text-center">{{ $item->hari }}</td>
                                <td class="px-2 py-3 text-center">{{ $item->jam->jam }} - {{ $item->jamselesai->jam }}</td>
                                <td class="px-2 py-3 text-center">{{ $item->kelas->kelas }}</td>
                                <td class="px-2 py-3 text-center break-words">{{ $item->mapel->mapel }}</td>
                                <td class="px-2 py-3 text-center">{{ $item->guru->nama }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="mt-3">
                    {{ $mengajars->links() }}
                </div>
            </div>
        </div>        
    </div>
@endsection
