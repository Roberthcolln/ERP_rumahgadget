<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateCard extends Model
{
    use HasFactory;

    protected $table = 'rate_cards';
    protected $primaryKey = 'id_rate_card';
    protected $guarded = []; // Mengizinkan semua field diisi

    protected $casts = [
        'platform' => 'array',
    ];
}
