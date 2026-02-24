<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';

    protected $fillable = [
        'kode_invoice',
        'id_user',
        'id_pelanggan',      // Tambahkan ini
        'tanggal_penjualan', // Tambahkan ini
        'total',
        'status',
        'bayar',
        'kembali'
    ];

    public function detail()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan', 'id_penjualan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
