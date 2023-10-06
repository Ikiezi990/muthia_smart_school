<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTagihan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function siswa()
    {
        return $this->belongsTo(siswa::class);
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
}
