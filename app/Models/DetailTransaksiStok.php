<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiStok extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi_stok';

    // Tambahkan baris di bawah ini
    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'qty'
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiStok::class, 'id_transaksi');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
