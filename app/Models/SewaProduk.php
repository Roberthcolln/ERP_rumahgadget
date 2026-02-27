<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaProduk extends Model
{
    use HasFactory;

    protected $table = 'sewa_produk';
    protected $primaryKey = 'id_sewa';

    protected $fillable = [
        'id_produk',
        'harga_24_jam',
        'harga_2_hari',
        'harga_3_hari',
        'harga_7_hari',
        'harga_14_hari',
        'harga_1_bulan',
        'harga_per_jam'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
