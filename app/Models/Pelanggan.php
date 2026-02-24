<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pelanggan extends Authenticatable // Ubah dari Model ke Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama_pelanggan',
        'email',
        'password',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'id_provinsi',
        'id_kota',
        'id_kecamatan',
        'id_kelurahan',
        'status',
        'point', // Tambahkan ini
        'level'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function penjualan_details()
    {
        // Relasi HasManyThrough: Pelanggan -> Penjualan -> PenjualanDetail
        return $this->hasManyThrough(
            PenjualanDetail::class,
            Penjualan::class,
            'id_pelanggan', // Foreign key di tabel penjualan
            'id_penjualan', // Foreign key di tabel penjualan_detail
            'id_pelanggan', // Local key di tabel pelanggan
            'id_penjualan'  // Local key di tabel penjualan

        );
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'id_kota');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }

    public function getLevelColorAttribute()
    {
        return [
            'Bronze' => 'bg-label-warning',
            'Silver' => 'bg-label-secondary',
            'Platinum' => 'bg-label-info',
        ][$this->level] ?? 'bg-label-primary';
    }

    // Fungsi untuk menambah poin setiap transaksi (Panggil ini di Controller Penjualan)
    public function addPoints($amount)
    {
        // Contoh: Tiap belanja 10.000 dapat 1 poin
        $newPoints = floor($amount / 10000);
        $this->increment('point', $newPoints);

        // Update Level berdasarkan total poin
        if ($this->point >= 1000) {
            $this->update(['level' => 'Platinum']);
        } elseif ($this->point >= 500) {
            $this->update(['level' => 'Silver']);
        }
    }
}
