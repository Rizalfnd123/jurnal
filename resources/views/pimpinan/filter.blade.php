@extends('hmpimpinan')

@section('title', 'Rekap Absen')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Rekap Absen Guru</h1>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="bg-white p-4 rounded-lg shadow-lg mb-6">
            <!-- Header Kalender -->
            <div class="flex justify-between items-center mb-4">
                <strong class="text-lg font-semibold">Kalender Absen Bulanan</strong>
                <a href="{{ route('export.absen') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa fa-download"></i> Export PDF
                </a>
            </div>
            <!-- Form Filter -->
            <div class="mb-4">
                <form action="{{ route('pimpinan.filter') }}" method="get">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="bulan">Pilih Bulan dan Tahun:</label>
                        <input type="month" name="bulan" id="bulan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ request('bulan') }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="guru">Guru:</label>
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

            @if (isset($selectedGuru) && isset($bulanName))
                <h4 class="font-semibold mb-4">Pada bulan: {{ $bulanName }}, Guru: {{ $selectedGuru }}</h4>
            @endif

            <!-- Keterangan Warna -->
            <div class="flex space-x-4 mb-6">
                <span class="flex items-center space-x-2">
                    <span class="inline-block w-4 h-4 bg-green-500 rounded-full"></span>
                    <span>Hadir</span>
                </span>
                <span class="flex items-center space-x-2">
                    <span class="inline-block w-4 h-4 bg-red-500 rounded-full"></span>
                    <span>Tidak Hadir</span>
                </span>
            </div>

            <!-- Kalender -->
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <div class="grid grid-cols-5 gap-2"> <!-- 5 Kolom untuk Senin - Jumat -->
                    <!-- Header Hari dengan Warna -->
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                        <div class="text-center font-bold text-blue-700">{{ $day }}</div>
                    @endforeach

                    @php
                        $tanggal = \Carbon\Carbon::parse($selectedBulan . '-01');
                        $daysInMonth = $tanggal->daysInMonth;
                        $monthStartDay = ($tanggal->dayOfWeekIso - 1) % 7; // ISO 8601, Senin = 1
                        $firstWeekday = $monthStartDay > 4 ? 0 : $monthStartDay; // Hanya Senin-Jumat
                    @endphp

                    <!-- Slot Kosong Sebelum Tanggal -->
                    @for ($i = 0; $i < $firstWeekday; $i++)
                        <div></div>
                    @endfor

                    <!-- Tanggal Bulan -->
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $currentDate = \Carbon\Carbon::createFromDate($tanggal->year, $tanggal->month, $day);
                            if ($currentDate->dayOfWeekIso > 5) continue; // Skip Sabtu & Minggu
                            $hasData = array_key_exists($day, $daysWithData);
                            $bgColor = $hasData ? 'bg-green-500' : 'bg-red-500';
                            $time = $hasData ? $daysWithData[$day] : '';
                        @endphp

                        <div class="p-4 rounded-lg text-center {{ $bgColor }} text-white shadow-md">
                            <span class="font-semibold">{{ $day }}</span>
                            @if ($hasData)
                                <div class="text-sm mt-1">{{ $time }}</div>
                            @elseif (!$hasData)
                            <div class="text-sm mt-1">Tidak Hadir</div>
                            @endif
                        </div>
                    @endfor
                </div>
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
