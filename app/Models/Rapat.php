<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rapat extends Model
{
    use HasFactory;

    protected $table = 'rapat'; // Pastikan nama tabelnya rapat, bukan rapats

    protected $fillable = [
        'judul_rapat',
        'tanggal_rapat',
        'lokasi_rapat',
        'deskripsi_rapat',
        'link_absensi',
    ];
    public function absensi()
{
    return $this->hasMany(Absensi::class, 'id_rapat');
}

}
