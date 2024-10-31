@extends('hm')

@section('title', 'Rekap Absen')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Rekap Absen Guru</h1>
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
                <a href="{{ route('export.absen') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-download"></i> Export PDF
                </a>
            </div>
            <div class="mb-4">
                <div class="col-md-12 mb-4">
                    <form action="{{ route('rabsenguru.filter') }}" method="get" class="filter-form">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan dan Tahun:</label>
                            <input type="month" name="bulan" id="bulan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ request('bulan') }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="guru" class="block text-sm font-medium text-gray-700">Guru:</label>
                            <select name="guru" id="guru" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == request('guru') ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                    </form>
                </div>
            </div>
            
            @if (isset($selectedGuru) && isset($bulanName))
                <div class="pull-left mb-4">
                    <h4 class="font-semibold">Pada bulan: {{ $bulanName }}</h4>
                    <h4 class="font-semibold">Guru: {{ $selectedGuru }}</h4>
                </div>
            @endif
            
            <div class="overflow-x-auto">
                <table id="rabsenTable" class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Guru</th>
                            <th class="py-3 px-6 text-left">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($filteredData as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6 text-left">{{ $item->guru_nama }}</td>
                                <td class="py-3 px-6 text-left">{{ $item->created_at }}</td>
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
        $('#rabsenTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });
</script>
@endsection
