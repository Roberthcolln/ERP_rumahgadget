<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriService extends Model
{
    use HasFactory;
    protected $table = 'kategori_service';
    protected $primaryKey = 'id_kategori_service';
    protected $fillable = [
        'nama_kategori_service'
    ];
}
