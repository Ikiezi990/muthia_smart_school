<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['angkatan_id', 'nama_kelas'];

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }
    public function jadwals()
    {
        return $this->belongsToMany(Jadwal::class, 'jadwal_kelas', 'kelas_id', 'jadwal_id');
    }
}
