@extends('hmbk')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <a href="{{ route('absensiharian.rekap') }}" class="inline-block mb-4 text-blue-600 hover:text-blue-800">
        &larr; Kembali
    </a>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($absensi)
        <p class="text-lg font-semibold">Hari: {{ $absensi->hari }}</p>
        <p class="text-lg font-semibold">Tanggal: {{ \Carbon\Carbon::parse($absensi->created_at)->format('d-m-Y') }}</p>
        <p class="text-lg font-semibold">Kelas: {{ $absensi->kelas }}</p>

        <table class="min-w-full bg-white rounded-lg mt-4">
            <thead>
                <tr class="bg-amber-900 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nama Siswa</th>
                    <th class="py-3 px-6 text-left">NIS</th>
                    <th class="py-3 px-6 text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($siswaList as $siswa)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $siswa->nama }}</td>
                        <td class="py-3 px-6">{{ $siswa->nis }}</td>
                        <td class="py-3 px-6 text-center">
                            @if($siswa->ket == 'H') Hadir 
                            @elseif($siswa->ket == 'S') Sakit 
                            @elseif($siswa->ket == 'I') Izin 
                            @else Alpa 
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">Tidak ada data siswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @else
        <p class="text-center text-gray-500 mt-4">Data absensi tidak ditemukan.</p>
    @endif
</div>
@endsection
