<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $fillable = [
        'jurnals_id', // Tambahkan ini
        'siswas_id',
        'ket',
    ];
    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class, 'jurnals_id');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswas::class, 'siswas_id');
    }
}
