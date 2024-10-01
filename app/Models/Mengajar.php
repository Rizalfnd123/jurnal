<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mengajar extends Model
{
     protected $guarded = [];
     public function kelas()
     {
         return $this->belongsTo(Kelas::class, 'kelas_id');
     }
     
     public function jam()
     {
          return $this->belongsTo('App\Models\Jam');
     }
     public function mapel()
     {
          return $this->belongsTo('App\Models\Mapel');
     }
     public function guru()
     {
          return $this->belongsTo('App\Models\Guru');
     }
     public function semester()
     {
          return $this->belongsTo('App\Models\Semester');
     }
     public function tapel()
     {
          return $this->belongsTo('App\Models\Tapel');
     }
     public function jurnal()
     {
          return $this->hasMany(Jurnal::class, 'mengajar_id');
     }

     public function izin()
     {
          return $this->hasMany(Izin::class, 'mengajar_id');
     }
}
