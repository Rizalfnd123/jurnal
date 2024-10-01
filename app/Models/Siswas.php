<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswas extends Model
{
    protected $guarded =[];
    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id');
}

}
