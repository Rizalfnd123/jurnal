@extends('hminval')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="w-full px-2">
        <h1 class="text-3xl font-bold text-white mb-3">Data Izin</h1>
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white p-4 rounded-lg shadow-lg mb-6">
                <a href="{{ url('/invaljadwalhariini') }}"
                    class="block bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-full text-center">
                    Lihat Jadwal Hari Ini
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <strong class="text-lg font-semibold">Data Izin</strong>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg">
                        <thead>
                            <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                                <th class="py-3 px-6 text-left">No</th>
                                <th class="py-3 px-6 text-left">Tanggal</th>
                                <th class="py-3 px-6 text-left">Nama Guru</th>
                                <th class="py-3 px-6 text-left">Keterangan</th>
                                <th class="py-3 px-6 text-left">Surat</th>
                                <th class="py-3 px-6 text-left">Kelas</th>
                                <th class="py-3 px-6 text-left">Mapel</th>
                                <th class="py-3 px-6 text-left">Kegiatan</th>
                                <th class="py-3 px-6 text-left">Lampiran</th>
                                <th class="py-3 px-6 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($izin as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-6">{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td class="py-3 px-6">
                                        @if ($item->guru)
                                            {{ $item->guru->nama }}
                                        @else
                                            <span class="text-red-500">Guru tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        @if ($item->status === 'B')
                                            <span class="bg-red-100 text-red-500 py-1 px-2 rounded-full text-xs">Belum
                                                Mengisi</span>
                                        @elseif($item->status === 'S')
                                            <span class="bg-green-100 text-green-500 py-1 px-2 rounded-full text-xs">Sudah
                                                Mengisi Jurnal</span>
                                        @elseif($item->status === 'I')
                                            <span class="bg-blue-100 text-blue-500 py-1 px-2 rounded-full text-xs">Sudah
                                                Mengisi Izin</span>
                                        @else
                                            <span
                                                class="bg-gray-100 text-gray-500 py-1 px-2 rounded-full text-xs">{{ $item->ket }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('image.preview', ['type' => 'surat', 'id' => $item->id]) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->surat) }}" alt="Surat" style="max-width: 200px;">
                                        </a>
                                    </td>
                                    <td class="py-3 px-6">
                                        @if ($item->kelas)
                                            {{ $item->kelas->kelas }}
                                        @else
                                            <span class="text-red-500">Kelas tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        @if ($item->mapel)
                                            {{ $item->mapel->mapel }}
                                        @else
                                            <span class="text-red-500">Mata Pelajaran tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">{{ $item->kegiatan }}</td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('image.preview', ['type' => 'lampiran', 'id' => $item->id]) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->lampiran) }}" alt="Lampiran" style="max-width: 200px;">
                                        </a>
                                    </td>   
                                    <td class="py-3 px-6 space-x-2">
                                        <a href="{{ url('invalizin/' . $item->id . '/edit') }}"
                                            class="text-blue-500 hover:text-blue-700">
                                            <i class="fa fa-pencil"> Edit</i>
                                        </a>
                                        <form action="{{ url('invalizin/' . $item->id) }}" method="post"
                                            class="inline-block" onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fa fa-trash"> Hapus</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    {{-- <div class="mt-3">
                        {{ $izin->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
