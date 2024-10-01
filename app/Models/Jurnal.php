<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
     use HasFactory;

    // Tentukan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'tanggal',
        'materi',
        'hadir',
        'tidak_hadir',
        'dokumentasi',
        'mengajar_id', // Pastikan mengajar_id ada di sini
    ];
     public function mengajar()
     {
         return $this->belongsTo(Mengajar::class, 'mengajar_id');
     }

    public function guru()
    {
        return $this->hasOneThrough(Guru::class, Mengajar::class, 'id', 'id', 'mengajar_id', 'guru_id');
    }

    public function mapel()
    {
        return $this->hasOneThrough(Mapel::class, Mengajar::class, 'id', 'id', 'mengajar_id', 'mapel_id');
    }

    public function kelas()
    {
        return $this->hasOneThrough(Kelas::class, Mengajar::class, 'id', 'id', 'mengajar_id', 'kelas_id');
    }
    public function jam()
    {
        return $this->hasOneThrough(Jam::class, Mengajar::class, 'id', 'id', 'mengajar_id', 'jam_id');
    }
}
