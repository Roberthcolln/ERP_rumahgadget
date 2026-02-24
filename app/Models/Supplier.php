<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';

    protected $fillable = [
        'nama_supplier',
        'kode_supplier',
        'email',
        'telepon',
        'alamat',
        'perusahaan',
        'status'
    ];

    // relasi ke produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_supplier');
    }
}
