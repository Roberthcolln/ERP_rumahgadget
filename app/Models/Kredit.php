<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
    use HasFactory;

    protected $table = 'kredit_produk';
    protected $primaryKey = 'id_kredit';

    protected $fillable = [
        'id_kategori',
        'id_jenis',
        'id_tipe',
        'id_varian',
        'id_warna',
        'harga_kredit',
        'dp',
        'cicilan',
        'harga_cicilan'
    ];

    // Relasi agar bisa menampilkan nama kategori, jenis, dll di index
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
    public function varian()
    {
        return $this->belongsTo(Varian::class, 'id_varian');
    }
    public function warna()
    {
        return $this->belongsTo(Warna::class, 'id_warna');
    }
}
