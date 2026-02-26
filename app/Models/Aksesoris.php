<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aksesoris extends Model
{
    use HasFactory;

    protected $table = 'aksesoris';
    protected $primaryKey = 'id_aksesoris';

    protected $fillable = [
        'nama_aksesoris',
        'id_kategori_aksesoris',
        'id_supplier',
        'deskripsi_aksesoris',
        'harga_aksesoris',
        'harga_jual_aksesoris',
        'harga_promo_aksesoris',
        'gambar_aksesoris',
    ];

    public function kategori_aksesoris()
    {
        return $this->belongsTo(KategoriAksesoris::class, 'id_kategori_aksesoris');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function gudang()
    {
        // Pastikan nama tabel pivotnya sesuai (misal: gudang_aksesoris)
        return $this->belongsToMany(Gudang::class, 'gudang_aksesoris', 'id_aksesoris', 'id_gudang')
            ->withPivot('qty')
            ->withTimestamps();
    }
}
