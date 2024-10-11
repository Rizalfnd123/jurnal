<?php

namespace App\Imports;

use App\Models\Mengajar;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jam;  
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use \PhpOffice\PhpSpreadsheet\Shared\Date;

class MengajarImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari ID guru berdasarkan nama guru
        $guru = Guru::where('nama', $row['guru_id'])->first();
        
        // Cari ID kelas berdasarkan nama kelas
        $kelas = Kelas::where('kelas', $row['kelas_id'])->first();
        
        // Cari ID mapel berdasarkan nama mapel
        $mapel = Mapel::where('mapel', $row['mapel_id'])->first();

        // Mengubah format waktu dari Excel
        $jam_mulai = Date::excelToDateTimeObject($row['jam_id'])->format('H:i');
        $jam_selesai = Date::excelToDateTimeObject($row['jamselesai_id'])->format('H:i');

        // Cari ID jam berdasarkan waktu mulai dan selesai
        $jam_mulai_id = Jam::where('jam', $jam_mulai)->first();
        $jam_selesai_id = Jam::where('jam', $jam_selesai)->first();

        // Insert data ke tabel mengajars dengan ID yang sesuai
        return new Mengajar([
            'hari'           => $row['hari'],                     // Nilai hari langsung diambil dari Excel
            'jam_id'         => $jam_mulai_id ? $jam_mulai_id->id : null, // Assign jam mulai ID
            'jamselesai_id'  => $jam_selesai_id ? $jam_selesai_id->id : null, // Assign jam selesai ID
            'kelas_id'       => $kelas ? $kelas->id : null,       // Assign kelas ID
            'mapel_id'       => $mapel ? $mapel->id : null,       // Assign mapel ID
            'guru_id'        => $guru ? $guru->id : null,         // Assign guru ID
        ]);
    }
}
