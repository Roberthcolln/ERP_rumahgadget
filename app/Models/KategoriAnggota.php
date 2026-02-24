<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAnggota extends Model
{
    use HasFactory;
    protected $table = 'kategori_anggota';
    protected $primaryKey = 'id_kategori_anggota';
    public $timestamps = true;
    protected $fillable = [
        'nama_kategori_anggota'
    ];
}
