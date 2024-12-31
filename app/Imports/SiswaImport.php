<?php

namespace App\Imports;

use App\Models\Siswas;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
{
    if (!isset($row['nis'], $row['nama'], $row['jenis_kelamin'], $row['kelas_id'], $row['status'])) {
        return null; // Abaikan baris yang datanya tidak lengkap
    }

    return new Siswas([
        'nis'       => $row['nis'],
        'nama'      => $row['nama'],
        'kelamin'   => $row['jenis_kelamin'],
        'kelas_id'  => $row['kelas_id'],
        'status'    => $row['status'],
    ]);
}


    public function rules(): array
    {
        return [
            'nis' => 'required|string',
            'nama' => 'required|string',
            'kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'status' => 'required|in:aktif,tidak aktif',
        ];
    }
}
