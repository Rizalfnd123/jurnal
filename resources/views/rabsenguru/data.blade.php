@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Rekap Absen Guru</h1>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('status') }}
            </div>
        @endif
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <div class="p-4 border-b">
                <strong class="text-lg font-semibold">Data</strong>
            </div>
            <div class="card-body p-4">
                <div class="col-md-12 mb-4">
                    <form action="{{ route('rabsenguru.filter') }}" method="get" class="filter-form">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan dan Tahun:</label>
                            <input type="month" name="bulan" id="bulan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="guru" class="block text-sm font-medium text-gray-700">Guru:</label>
                            <select name="guru" id="guru" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                    </form>
                </div>
                {{-- Uncomment below to display table --}}
                {{-- <table id="rabsenTable" class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal">
                            <th class="py-3 px-6">No</th>
                            <th class="py-3 px-6">Hari</th>
                            <th class="py-3 px-6">Tanggal</th>
                            <th class="py-3 px-6">Materi</th>
                            <th class="py-3 px-6">Hadir</th>
                            <th class="py-3 px-6">Tidak Hadir</th>
                            <th class="py-3 px-6">Dokumentasi</th>
                            <th class="py-3 px-6">Waktu Isi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($mengajars as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $item->mengajar->hari }}</td>
                                <td class="py-3 px-6">{{ $item->mengajar->tanggal }}</td>
                                <td class="py-3 px-6">{{ $item->materi }}</td>
                                <td class="py-3 px-6">{{ $item->hadir }}</td>
                                <td class="py-3 px-6">{{ $item->tidak_hadir }}</td>
                                <td class="py-3 px-6">{{ $item->dokumentasi }}</td>
                                <td class="py-3 px-6">{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#rabsenTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });
</script>
@endsection
