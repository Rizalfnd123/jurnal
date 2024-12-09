@extends('hmguru')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Rekap Jurnal</h1>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('status') }}
            </div>
        @endif
        <div class="bg-white p-4 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <strong class="text-lg font-semibold">Data</strong>
                <a href="{{ route('export.jurnal') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-download"></i> Export PDF
                </a>
            </div>
            <div class="card-body mb-4">
                <div class="col-md-12 mb-4">
                    <form action="{{ route('rjurnal.filter') }}" method="get" class="filter-form">
                        @csrf
                        <div class="form-group">
                            <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan:</label>
                            <input type="month" name="bulan" id="bulan" class="form-control rounded-md border-gray-300 shadow-sm mt-1" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control rounded-md border-gray-300 shadow-sm mt-1" required>
                                <option value="">-- pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Simpan</button>
                    </form>
                </div>
            </div>
            @if (isset($bulanName) && isset($selectedKelas))
                <div class="pull-left mb-4">
                    <h4 class="font-semibold">Pada bulan: {{ $bulanName }}</h4>
                    <h4 class="font-semibold">Kelas: {{ $selectedKelas }}</h4>
                </div>
            @endif
            <div class="overflow-x-auto">
                <table id="rjurnalTable" class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Hari</th>
                            <th class="py-3 px-6 text-left">Tanggal</th>
                            <th class="py-3 px-6 text-left">Materi</th>
                            <th class="py-3 px-6 text-left">Hadir</th>
                            <th class="py-3 px-6 text-left">Tidak Hadir</th>
                            <th class="py-3 px-6 text-left">Dokumentasi</th>
                            <th class="py-3 px-6 text-left">Waktu Isi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($rjurnal as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $item->mengajar->hari }}</td>
                                <td class="py-3 px-6">{{ $item->created_at->format('Y-m-d') }}</td>
                                <td class="py-3 px-6">{{ $item->materi }}</td>
                                <td class="py-3 px-6">{{ $item->hadir }}</td>
                                <td class="py-3 px-6">{{ $item->tidak_hadir }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('image-guru.preview', ['type' => 'dokumentasi', 'id' => $item->id]) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->dokumentasi) . '?' . time() }}" alt="Dokumentasi"
                                             style="max-width: 200px;">
                                    </a>
                                </td>   
                                <td class="py-3 px-6">{{ $item->created_at->format('H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#rjurnalTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });
</script>
@endsection
