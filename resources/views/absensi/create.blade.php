@extends('hm')

@section('title', 'Isi Absensi')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Isi Absensi</h1>
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
                <strong class="text-lg font-semibold">Data Absensi</strong>
            </div>
            <div class="mb-4">
                <!-- Tampilkan informasi jurnal -->
                <table class="table-auto w-full border border-gray-300">
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border">Nama Guru</th>
                        <td class="py-2 px-4 border">{{ $jurnal->guru->nama }}</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border">Mata Pelajaran</th>
                        <td class="py-2 px-4 border">{{ $jurnal->mapel->mapel }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border">Kelas</th>
                        <td class="py-2 px-4 border">{{ $jurnal->kelas->kelas }}</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border">Jam</th>
                        <td class="py-2 px-4 border">{{ $jurnal->jam->jam }}</td>
                    </tr>
                </table>
            </div>
            <!-- Form untuk Absensi -->
            <form action="{{ url('absensi/store') }}" method="post">
                @csrf
                <table class="min-w-full mt-4 bg-white border border-gray-300">
                    <thead class="bg-amber-900 text-white">
                        <tr>
                            <th class="py-2 px-4 border">Nama Siswa</th>
                            <th class="py-2 px-4 border">Hadir <input type="checkbox" id="checkAllHadir"></th>
                            <th class="py-2 px-4 border">Izin <input type="checkbox" id="checkAllIzin"></th>
                            <th class="py-2 px-4 border">Sakit <input type="checkbox" id="checkAllSakit"></th>
                            <th class="py-2 px-4 border">Alpa <input type="checkbox" id="checkAllAlpa"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswaList as $siswa)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }} border-b">
                                <td class="py-2 px-4 border">{{ $siswa->nama }}</td>
                                <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                <td class="py-2 px-4 border"><input type="checkbox" class="hadir-checkbox" name="hadir[{{ $siswa->id }}]" value="H"></td>
                                <td class="py-2 px-4 border"><input type="checkbox" class="izin-checkbox" name="izin[{{ $siswa->id }}]" value="I"></td>
                                <td class="py-2 px-4 border"><input type="checkbox" class="sakit-checkbox" name="sakit[{{ $siswa->id }}]" value="S"></td>
                                <td class="py-2 px-4 border"><input type="checkbox" class="alpa-checkbox" name="alpa[{{ $siswa->id }}]" value="A"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <input type="hidden" name="jurnals_id" value="{{ $jurnal->id }}">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Simpan Absensi</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check all hadir checkboxes
        document.getElementById('checkAllHadir').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.hadir-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Check all izin checkboxes
        document.getElementById('checkAllIzin').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.izin-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Check all sakit checkboxes
        document.getElementById('checkAllSakit').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.sakit-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Check all alpa checkboxes
        document.getElementById('checkAllAlpa').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.alpa-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Prevent multiple checkboxes in a row from being checked
        document.querySelectorAll('tbody tr').forEach(row => {
            let hadir = row.querySelector('.hadir-checkbox');
            let izin = row.querySelector('.izin-checkbox');
            let sakit = row.querySelector('.sakit-checkbox');
            let alpa = row.querySelector('.alpa-checkbox');

            [hadir, izin, sakit, alpa].forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    [hadir, izin, sakit, alpa].forEach(box => {
                        if (box !== this) box.checked = false;
                    });
                });
            });
        });
    });
</script>
@endsection
