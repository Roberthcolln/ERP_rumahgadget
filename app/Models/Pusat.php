<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pusat extends Model
{
    use HasFactory;
    protected $table = 'pusat';
    protected $primaryKey = 'id_pusat';
    protected $fillable = [
        'nama_pusat'
    ];
}
