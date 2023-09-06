<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = ['kelas_id', 'nama_tagihan', 'nominal'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
