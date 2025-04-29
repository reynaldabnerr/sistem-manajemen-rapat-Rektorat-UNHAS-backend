<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'id_rapat',
        'nama_peserta',
        'nip_peserta',
        'status_kehadiran',
    ];

    public function rapat()
    {
        return $this->belongsTo(Rapat::class, 'id_rapat');
    }
}
