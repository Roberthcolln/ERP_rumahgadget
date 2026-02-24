<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';

    protected $fillable = [
        'id_produk',
        'id_gudang',
        'qty'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
