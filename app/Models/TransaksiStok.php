<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiStok extends Model
{
    protected $table = 'transaksi_stok';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['no_bukti', 'jenis', 'id_gudang', 'id_user_petugas', 'pihak_eksternal', 'catatan'];

    public function details()
    {
        return $this->hasMany(DetailTransaksiStok::class, 'id_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_petugas');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
