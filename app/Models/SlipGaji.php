<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
    use HasFactory;

    protected $table = 'slip_gaji';

    protected $fillable = [
        'user_id',
        'periode',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'biaya_layanan',
        'total_gaji',
        'tanggal_cetak'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
