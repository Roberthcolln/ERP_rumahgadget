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
        'id_varian',
        'id_warna',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'harga_jual_produk',
        'harga_promo_produk',
        'id_supplier',
        'gambar_produk',
        'id_promo',
    ];

    /**
     * Relasi ke Varian
     */
    public function varian()
    {
        return $this->belongsTo(Varian::class, 'id_varian');
    }

    /**
     * Relasi ke Warna
     */
    public function warna()
    {
        return $this->belongsTo(Warna::class, 'id_warna');
    }

    /**
     * Relasi ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    /**
     * Relasi ke Jenis
     */
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }

    /**
     * Relasi ke Tipe
     */
    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'id_tipe');
    }

    /**
     * Relasi Many-to-Many ke Gudang (Sebagai Stok)
     * Menggunakan tabel 'stok' sebagai pivot table
     */
    public function gudang()
    {
        return $this->belongsToMany(
            Gudang::class,
            'stok',      // Tabel Pivot
            'id_produk', // FK di tabel stok untuk produk
            'id_gudang'  // FK di tabel stok untuk gudang
        )->withPivot('qty')->withTimestamps();
        // withTimestamps() disarankan jika tabel stok memiliki created_at/updated_at
    }

    /**
     * Relasi ke Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }

    /**
     * Helper untuk mengambil total stok dari semua gudang
     */
    public function getTotalStokAttribute()
    {
        return $this->gudang->sum('pivot.qty');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo');
    }

    // Tambahkan di dalam class Produk
    public function getHargaFinalAttribute()
    {
        // 1. Cek apakah ada promo dari tabel promo_gadget (melalui relasi id_promo)
        if ($this->id_promo && $this->promo) {
            return $this->promo->nilai_promo;
        }

        // 2. Jika tidak ada id_promo, cek harga_promo_produk di tabel produk
        if ($this->harga_promo_produk > 0) {
            return $this->harga_promo_produk;
        }

        // 3. Jika semua di atas kosong/0, gunakan harga_jual_produk
        return $this->harga_jual_produk;
    }
}
