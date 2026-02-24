<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';

    protected $primaryKey = 'id_gudang';

    protected $fillable = [
        'nama_gudang',
        'kode_gudang',
        'alamat_gudang',
        'penanggung_jawab',
        'status',
    ];

    public $timestamps = true;

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Relasi ke stok (inventory ready)
     */
    // public function stok()
    // {
    //     return $this->hasMany(Stok::class, 'id_gudang', 'id_gudang');
    // }

    /**
     * Relasi produk melalui stok (optional advanced)
     */
    public function produk()
    {
        return $this->belongsToMany(
            Produk::class,
            'stok',
            'id_gudang',
            'id_produk'
        )->withPivot('qty');
    }
}
