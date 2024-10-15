@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Rekap Izin</h1>
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
                <div class="mb-4">
                    <form action="{{ route('rizin.filter') }}" method="get" class="filter-form">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan:</label>
                                <input type="month" name="bulan" id="bulan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select name="kelas" id="kelas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- pilih Kelas --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Simpan</button>
                    </form>
                </div>
                {{-- Uncomment below to display table --}}
                {{-- <table id="rizinTable" class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal">
                            <th class="py-3 px-6">No</th>
                            <th class="py-3 px-6">Hari</th>
                            <th class="py-3 px-6">Tanggal</th>
                            <th class="py-3 px-6">Waktu</th>
                            <th class="py-3 px-6">Keterangan</th>
                            <th class="py-3 px-6">Surat</th>
                            <th class="py-3 px-6">Kegiatan</th>
                            <th class="py-3 px-6">Lampiran</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($rizin as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $item->mengajar->hari }}</td>
                                <td class="py-3 px-6">{{ $item->created_at->format('Y-m-d') }}</td>
                                <td class="py-3 px-6">{{ $item->mengajar->jam->jam }}</td>
                                <td class="py-3 px-6">{{ $item->ket }}</td>
                                <td class="py-3 px-6">{{ $item->surat }}</td>
                                <td class="py-3 px-6">{{ $item->kegiatan }}</td>
                                <td class="py-3 px-6">{{ $item->lampiran }}</td>
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
        $('#rizinTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });
</script>
@endsection
