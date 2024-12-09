@extends('hminval')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-2xl font-semibold text-white mb-3">Jadwal Hari Ini - {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l') }}</h1>
</div>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="bg-white p-4 rounded-lg shadow-lg mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg text-xs">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-[10px] leading-normal">
                            <th class="py-2 px-4 text-left">Jam</th>
                            <th class="py-2 px-4 text-left">Mata Pelajaran</th>
                            <th class="py-2 px-4 text-left">Kelas</th>
                            <th class="py-2 px-4 text-left">Guru</th>
                            <th class="py-2 px-4 text-left">Status</th>
                            {{-- <th class="py-2 px-4 text-left">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-[11px] font-light">
                        @foreach ($jadwalToday as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-2 px-4">{{ $item->jam->jam }}</td>
                                <td class="py-2 px-4">{{ $item->mapel->mapel }}</td>
                                <td class="py-2 px-4">{{ $item->kelas->kelas }}</td>
                                <td class="py-2 px-4">{{ $item->guru->nama }}</td>
                                {{-- <td class="py-2">
                                    @if ($item->status === 'B')
                                        <span class=" font-semibold py-1 px-2 rounded-full text-xs">
                                            Belum mengisi
                                        </span>
                                    @elseif($item->status === 'S')
                                        <span class="font-semibold py-1 px-2 rounded-full text-xs">
                                            Sudah mengisi Jurnal
                                        </span>
                                    @elseif($item->status === 'I')
                                        <span class="font-semibold py-1 px-2 rounded-full text-xs">
                                            Sudah Mengisi Izin
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-500 font-semibold py-1 px-2 rounded-full text-xs">
                                            {{ $item->status }}
                                        </span>
                                    @endif
                                </td>                                 --}}
                                <td class="py-2 px-4 flex space-x-1">
                                    <!-- Tombol Isi Jurnal -->
                                    {{-- <a href="{{ route('jurnal.create', ['id' => $item->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                                        Isi Jurnal
                                    </a> --}}
                                    <!-- Tombol Isi Izin -->
                                    <a href="{{ url('invalizin/create', ['id' => $item->id]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded text-xs">
                                        Isi Izin
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                {{-- <div class="mt-3">
                    {{ $jadwalToday->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
