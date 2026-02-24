<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori',
        'id_jenis',
        'id_tipe',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'harga_jual_produk',
        'harga_promo_produk',
        'id_supplier',
        'gambar_produk'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }

    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'id_tipe');
    }

    public function gudang()
    {
        return $this->belongsToMany(
            Gudang::class,
            'stok',
            'id_produk',
            'id_gudang'
        )->withPivot('qty');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_produk')->with('gudang');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }
}
