<?php

namespace App\Imports;

use App\Models\Siswas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Siswas([
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'kelamin' => $row['kelamin'],
            'kelas_id' => $row['kelas_id'],
            'status' => $row['status'],
        ]);
    }
}
