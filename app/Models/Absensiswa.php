<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensiswa extends Model
{
    use HasFactory;

    protected $table = 'absensiswas'; // Nama tabel yang benar

    protected $fillable = [
        'hari',
        'siswas_id',
        'ket',
    ];

    // Jika diperlukan, tambahkan relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswas::class, 'siswas_id');
    }
}
