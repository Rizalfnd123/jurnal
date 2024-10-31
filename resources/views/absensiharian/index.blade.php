@extends('hmbk')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">Absensi Hari Ini</h1>
            <p>Hari: {{ $hariIni }}</p>
            <p>Tanggal: {{ $tanggalSekarang }}</p>
        </div>
        
        <!-- Form untuk memilih kelas -->
        <form action="{{ route('absensiharian.index') }}" method="get" class="mb-4">
            <label for="kelas_id" class="block text-sm font-medium text-gray-700">Pilih Kelas:</label>
            <select name="kelas_id" id="kelas_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas->id }}" {{ $kelasId == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->kelas }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-2">Tampilkan Siswa</button>
        </form>

        <!-- Form absensi jika siswa tersedia -->
        @if (!empty($siswaList))
            <form action="{{ route('absensiharian.store') }}" method="post">
                @csrf
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg">
                        <thead>
                            <tr class="bg-amber-900 text-white uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">No</th>
                                <th class="py-3 px-6 text-left">Nama Siswa</th>
                                <th class="py-3 px-6 text-left">NIS</th>
                                <th class="py-3 px-6 text-center">
                                    <input type="checkbox" onclick="toggleColumn('hadir')" /> Hadir
                                </th>
                                <th class="py-3 px-6 text-center">
                                    <input type="checkbox" onclick="toggleColumn('sakit')" /> Sakit
                                </th>
                                <th class="py-3 px-6 text-center">
                                    <input type="checkbox" onclick="toggleColumn('izin')" /> Izin
                                </th>
                                <th class="py-3 px-6 text-center">
                                    <input type="checkbox" onclick="toggleColumn('alfa')" /> Alfa
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($siswaList as $index => $siswa)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                                    <td class="py-3 px-6 text-left">{{ $siswa->nama }}</td>
                                    <td class="py-3 px-6 text-left">{{ $siswa->nis }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <input type="checkbox" name="absensi[{{ $siswa->id }}][ket]" value="H" class="checkbox hadir">
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <input type="checkbox" name="absensi[{{ $siswa->id }}][ket]" value="S" class="checkbox sakit">
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <input type="checkbox" name="absensi[{{ $siswa->id }}][ket]" value="I" class="checkbox izin">
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <input type="checkbox" name="absensi[{{ $siswa->id }}][ket]" value="A" class="checkbox alfa">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-2">Simpan Absensi</button>
            </form>
        @else
            <p class="text-red-500 mt-4">Pilih kelas untuk menampilkan data siswa.</p>
        @endif
    </div>
</div>

<script>
    function toggleColumn(className) {
        const checkboxes = document.querySelectorAll('.' + className);
        checkboxes.forEach(checkbox => checkbox.checked = !checkbox.checked);
    }

    // Optional: Add functionality to ensure only one checkbox per row is checked
    document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
        checkbox.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            row.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                if (cb !== event.target) cb.checked = false;
            });
        });
    });
</script>
@endsection
