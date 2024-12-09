@extends('hminval')

@section('title', 'Rekap Izin')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Rekap Izin</h1>
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
                <a href="{{ route('export.pdf') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-download"></i> Export PDF
                </a>
            </div>
            <div class="mb-4">
                <div class="col-md-12 mb-4">
                    <form action="{{ route('inval.filter') }}" method="get" class="filter-form">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="mapel" class="block text-sm font-medium text-gray-700">Mata Pelajaran:</label>
                                <select name="mapel" id="mapel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- pilih Mata Pelajaran --</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}" {{ old('mapel', request()->mapel) == $item->id ? 'selected' : '' }}>
                                            {{ $item->mapel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="guru" class="block text-sm font-medium text-gray-700">Guru:</label>
                                <select name="guru" id="guru" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- pilih Guru --</option>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}" {{ old('guru', request()->guru) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Simpan</button>
                    </form>                    
                </div>
            </div>
            @if (isset($results))
                <div class="pull-left mb-4">
                    <h4 class="font-semibold">Mata Pelajaran : {{ $selectedmapel->mapel }}</h4>
                    <h4 class="font-semibold">Guru           : {{ $selectedguru->nama }}</h4>
                </div>
            @endif
            <div class="overflow-x-auto">
                <table id="rizinTable" class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Hari</th>
                            <th class="py-3 px-6 text-left">Tanggal</th>
                            <th class="py-3 px-6 text-left">Waktu</th>
                            <th class="py-3 px-6 text-left">Keterangan</th>
                            <th class="py-3 px-6 text-left">Surat</th>
                            <th class="py-3 px-6 text-left">Kegiatan</th>
                            <th class="py-3 px-6 text-left">Lampiran</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($results as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $item->mengajar->hari }}</td>
                                <td class="py-3 px-6">{{ $item->created_at->format('Y-m-d') }}</td>
                                <td class="py-3 px-6">{{ $item->mengajar->jam->jam }}</td>
                                <td class="py-3 px-6">{{ $item->ket }}</td>
                                <td class="py-3 px-6">
                                    <a href="{{ route('image.preview', ['type' => 'surat', 'id' => $item->id]) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->surat) }}" alt="Surat" style="max-width: 200px;">
                                    </a>
                                </td>
                            
                                <td class="py-3 px-6">{{ $item->kegiatan }}</td>
                                
                                <td class="py-3 px-6">
                                    <a href="{{ route('image.preview', ['type' => 'lampiran', 'id' => $item->id]) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->lampiran) }}" alt="Lampiran" style="max-width: 200px;">
                                    </a>
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
        $('#rizinTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });
</script>
@endsection
