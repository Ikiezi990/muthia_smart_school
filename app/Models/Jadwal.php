<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'guru_id',
        'kelas_id',
        'semester',
        'tahun_ajaran',
        'hari',
        'jam',
        'mapel_id'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    public function siswas()
    {
        return $this->belongsToMany(siswa::class, 'jadwal_siswa', 'jadwal_id', 'siswa_id');
    }
}
