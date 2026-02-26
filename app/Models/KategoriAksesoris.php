<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAksesoris extends Model
{
    use HasFactory;
    protected $table = 'kategori_aksesoris';
    protected $primaryKey = 'id_kategori_aksesoris';
    protected $fillable = [
        'nama_kategori_aksesoris'
    ];
}
