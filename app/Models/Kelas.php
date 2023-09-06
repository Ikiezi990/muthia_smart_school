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
}
