<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rkbm extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'jam_id',
        'kelas_id',
        'mapel_id',
        'guru_id',
    ];

    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
