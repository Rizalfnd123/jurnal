<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Pastikan menggunakan User sebagai Authenticatable
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'guru'; // Nama tabelnya "guru"

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'nip', 'nama', 'kelamin', 'username', 'password', // dan kolom lain di tabel guru
    ];

    // Pastikan password di-hash otomatis
    protected $hidden = [
        'password', 'remember_token',
    ];
}
