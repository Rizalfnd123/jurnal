@extends('hmbk')

@section('content')
<div class="container mx-auto p-4">
    
    <div class="bg-white rounded-lg shadow-md p-6"> <!-- Card putih -->
    <h1 class="text-2xl font-bold mb-4">Rekap Absensi</h1>
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-6 text-left">Hari</th>
                    <th class="py-3 px-6 text-left">Tanggal</th>
                    <th class="py-3 px-6 text-left">Kelas</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekapAbsensi as $absensi)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $absensi->hari }}</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                        <td class="py-3 px-6">{{ $absensi->kelas }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('absensiharian.detailrekap', ['hari' => $absensi->hari, 'tanggal' => $absensi->tanggal, 'kelas' => $absensi->kelas]) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- End of Card -->
</div>
@endsection
