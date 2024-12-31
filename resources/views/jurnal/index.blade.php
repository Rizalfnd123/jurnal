@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-2xl font-bold text-white mb-3">Data Jurnal</h1> <!-- Kecilkan ukuran font -->
</div>
@endsection

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 text-sm rounded relative">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white p-3 rounded-lg shadow-lg mb-4"> <!-- Kecilkan padding -->
                <a href="{{ url('/jadwal-hari-ini') }}" class="block bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-full text-center text-sm">
                    Lihat Jadwal Hari Ini
                </a>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-3"> <!-- Kurangi margin bawah -->
                    <strong class="text-base font-semibold">Data</strong> <!-- Kecilkan font -->
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg text-xs"> <!-- Kecilkan ukuran font tabel -->
                        <thead>
                            <tr class="bg-amber-900 text-white uppercase leading-normal">
                                <th class="py-2 px-4 text-left">No</th> <!-- Kecilkan padding -->
                                <th class="py-2 px-4 text-left">Tanggal</th>
                                <th class="py-2 px-4 text-left">Nama Guru</th>
                                <th class="py-2 px-4 text-left">Mata Pelajaran</th>
                                <th class="py-2 px-4 text-left">Kelas</th>
                                <th class="py-2 px-4 text-left">Materi</th>
                                <th class="py-2 px-4 text-left">Hadir</th>
                                <th class="py-2 px-4 text-left">Tidak hadir</th>
                                <th class="py-2 px-4 text-left">Dokumentasi</th>
                                <th class="py-2 px-4 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-xs font-light"> <!-- Kecilkan ukuran font konten tabel -->
                            @foreach ($jurnal as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-2 px-4">{{ $loop->iteration }}</td> <!-- Kecilkan padding -->
                                    <td class="py-2 px-4">{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td class="py-2 px-4">
                                        @if ($item->guru)
                                            {{ $item->guru->nama }}
                                        @else
                                            <span class="text-red-500">Guru tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4">
                                        @if ($item->mapel)
                                            {{ $item->mapel->mapel }}
                                        @else
                                            <span class="text-red-500">Mata Pelajaran tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4">
                                        @if ($item->kelas)
                                            {{ $item->kelas->kelas }}
                                        @else
                                            <span class="text-red-500">Kelas tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4">{{ $item->materi }}</td>
                                    <td class="py-2 px-4">{{ $item->hadir }}</td>
                                    <td class="py-2 px-4">{{ $item->tidak_hadir }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('image-guru.preview', ['type' => 'dokumentasi', 'id' => $item->id]) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->dokumentasi) . '?' . time() }}" alt="Dokumentasi"
                                                 style="max-width: 200px;">
                                        </a>
                                    </td> 
                                    <td class="py-2 px-4 space-y-2">
                                        <!-- Tombol Absen -->
                                        <a href="{{ route('absensi.create', ['jurnal_id' => $item->id]) }}" 
                                           class="block bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded-full shadow-md transition duration-300 text-xs text-center">
                                            Absen
                                        </a>
                                        
                                        <!-- Tombol Edit -->
                                        <a href="{{ url('jurnal/' . $item->id . '/edit') }}" 
                                           class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-full shadow-md transition duration-300 text-xs text-center">
                                            Edit
                                        </a>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ url('jurnal/' . $item->id) }}" method="post" class="inline-block"
                                              onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" 
                                                    class="block bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-full shadow-md transition duration-300 text-xs text-center">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
