<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'produk_id',
        'nama_produk',
        'harga',
        'qty'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {

        return $this->belongsTo(Produk::class, 'product_id');
    }
}
