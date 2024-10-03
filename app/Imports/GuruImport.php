<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Hanya mengisi kolom NIP dan Nama
        return new Guru([
            'nip' => $row['nip'],
            'nama' => $row['nama'],
            'kelamin' => $row['kelamin'],
            'username' => '',  // Kosongkan username
            'password' => '',  // Kosongkan password
            'foto'     => '',  // Kosongkan foto
        ]);
    }
}
