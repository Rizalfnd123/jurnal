<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'mengajar_id',
        'jam',
        'ket',
        'surat',
        'kegiatan',
        'lampiran',
        // kolom lain jika ada
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
}
