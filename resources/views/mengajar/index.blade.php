@extends('hm')

@section('title', 'Jadwal Mengajar')

@section('breadcrumbs')
    <div class="w-full px-2">
        <h3 class="text-3xl font-bold text-white mb-3">Jadwal Mengajar</h3>
    </div>
@endsection

@section('content')
    <div class="w-full px-2">
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="text-lg font-semibold mb-4">Data Jadwal Mengajar</div>
            <!-- Flexbox untuk tombol tambah dan form import -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-4 space-y-2 sm:space-y-0 sm:space-x-4">
                <!-- Tombol Tambah -->
                <a href="{{ url('mengajar/create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </div>

            <!-- Tabel Jadwal Mengajar -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg mx-auto">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                            <th class="px-2 py-3 text-center">Hari</th>
                            <th class="px-2 py-3 text-center">Waktu</th>
                            <th class="px-2 py-3 text-center">Kelas</th>
                            <th class="px-2 py-3 text-center">Mata Pelajaran</th>
                            <th class="px-2 py-3 text-center">Guru</th>
                            <th class="px-2 py-3 text-center">Aksi</th>
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
                                <td class="px-2 py-3 text-center">
                                    <a href="{{ url('mengajar/' . $item->id . '/edit') }}"
                                        class="btn btn-primary btn-sm rounded">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ url('mengajar/' . $item->id) }}" method="post" class="inline-block"
                                        onsubmit="return confirm('Yakin hapus data?')">
                                        @method('DELETE')
                                        @csrf
                                        <button class="text-red-500">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
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
