@extends('hmguru')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Rekap KBM</h1>
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
            <div class="flex justify-between items-center mb-4">
                <strong class="text-lg font-semibold text-amber-900">Data</strong>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="col-md-12 mb-4">
                    <form action="{{ url('/kbm-guru-rekap-filter') }}" method="get" class="filter-form">
                        @csrf
                        <div class="form-group">
                            <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan:</label>
                            <input type="month" name="bulan" id="bulan" class="form-control rounded-md border-gray-300 shadow-sm mt-1 w-full" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control rounded-md border-gray-300 shadow-sm mt-1 w-full" required>
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
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="overflow-x-auto"> <!-- Tambahkan wrapper untuk membuat tabel bisa di-scroll -->
                <table id="rkbmTable" class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                            <th class="py-3 px-6 text-left">Guru</th>
                            <th class="py-3 px-6 text-left">Wajib Hadir</th>
                            <th class="py-3 px-6 text-left">Hadir</th>
                            <th class="py-3 px-6 text-left">Izin</th>
                            <th class="py-3 px-6 text-left">Presentase</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($rkbm as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $item->mapel->mapel }}</td>
                                <td class="py-3 px-6">{{ $item->guru->nama }}</td>
                                <td class="py-3 px-6">4</td>
                                <td class="py-3 px-6">{{ $item->hadir_count }}</td>
                                <td class="py-3 px-6">{{ $item->izin_count }}</td>
                                <td class="py-3 px-6">
                                    @if ($item->total > 0)
                                        {{ number_format(($item->hadir_count + $item->izin_count) / 4 * 100) }}%
                                    @else
                                        0%
                                    @endif
                                </td>
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
        $('#rkbmTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });
</script>
@endsection