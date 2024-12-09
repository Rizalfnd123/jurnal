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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <strong class="text-lg font-semibold">Data Rekap KBM</strong>
            </div>

            <div class="p-4 bg-white rounded-lg shadow">
                <div class="grid grid-cols-1 gap-4">
                    <form action="{{ url('/kbm-guru-rekap-filter') }}" method="get" class="filter-form space-y-4">
                        @csrf
                        <div>
                            <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan:</label>
                            <input type="month" name="bulan" id="bulan" class="block w-full p-2 mt-1 border rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                        </div>

                        <div>
                            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas:</label>
                            <select name="kelas" id="kelas" class="block w-full p-2 mt-1 border rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                                <option value="">-- pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="w-full py-2 px-4 text-white bg-green-500 rounded-md hover:bg-green-700 transition">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Responsive Table Container -->
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <table id="rkbmTable" class="min-w-full table-auto">
                <thead class="bg-amber-900 text-white uppercase text-xs font-semibold">
                    <tr>
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                        <th class="py-3 px-6 text-left">Guru</th>
                        <th class="py-3 px-6 text-left">Wajib Hadir</th>
                        <th class="py-3 px-6 text-left">Hadir</th>
                        <th class="py-3 px-6 text-left">Izin</th>
                        <th class="py-3 px-6 text-left">Presentase</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach ($rkbm as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition">
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
