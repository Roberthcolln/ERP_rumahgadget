<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $primaryKey = 'id_service';
    protected $guarded = []; // Menggunakan guarded kosong agar semua field bisa diisi (mass assignment)

    public function kategori()
    {
        return $this->belongsTo(KategoriService::class, 'id_kategori_service');
    }
}
