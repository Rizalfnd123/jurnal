@extends('hmguru')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Rekap Jurnal</h1>
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
                <strong class="text-lg font-semibold">Data</strong>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <div class="col-md-12 mb-4">
                    <form action="{{ route('jurnal-guru.filter') }}" method="get" class="filter-form">
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
