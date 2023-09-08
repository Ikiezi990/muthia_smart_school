<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi'; // Nama tabel sesuai dengan yang Anda tentukan dalam migrasi

    protected $fillable = [
        'jadwal_id', 'siswa_id', 'tanggal_absensi', 'status'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
