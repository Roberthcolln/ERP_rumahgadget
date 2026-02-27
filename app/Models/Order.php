<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'number',
        'nama_pelanggan',
        'whatsapp',
        'alamat',
        'total_harga',
        'status_pembayaran',
        'snap_token',
        'hp_lama'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
