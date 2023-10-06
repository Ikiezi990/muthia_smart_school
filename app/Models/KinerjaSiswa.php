<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KinerjaSiswa extends Model
{
    use HasFactory;

    protected $table = 'tabel_kinerja_siswa'; // Sesuaikan dengan nama tabel pivot Anda

    protected $fillable = [
        'siswa_id',
        'kinerja_id',
        'poin',
    ];

    // Definisikan relasi dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Definisikan relasi dengan model Kinerja
    public function kinerja()
    {
        return $this->belongsTo(Kinerja::class, 'kinerja_id');
    }
}
