<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promo extends Model
{
    use HasFactory;

    // Nama tabel sesuai dengan migrasi sebelumnya
    protected $table = 'promo_gadget';

    // Field yang boleh diisi secara massal
    protected $fillable = [
        'nama_promo',
        'kode_promo',
        'tipe_promo',
        'nilai_promo',
        'minimal_pembelian',
        'kuota_total',
        'tgl_mulai',
        'tgl_selesai',
        'status',
    ];

    // Konversi otomatis string tanggal ke objek Carbon
    protected $casts = [
        'tgl_mulai' => 'datetime',
        'tgl_selesai' => 'datetime',
        'status' => 'boolean',
    ];

    /**
     * Helper: Cek apakah promo masih berlaku secara waktu dan kuota
     */
    public function getIsAktifAttribute()
    {
        $sekarang = Carbon::now();

        return $this->status &&
            $sekarang->between($this->tgl_mulai, $this->tgl_selesai) &&
            $this->kuota_total > 0;
    }

    /**
     * Helper: Format tampilan diskon
     * Contoh: "10%" atau "Rp 50.000"
     */
    public function getLabelDiskonAttribute()
    {
        if ($this->tipe_promo === 'persentase') {
            return (int)$this->nilai_promo . '%';
        }

        return 'Rp ' . number_format($this->nilai_promo, 0, ',', '.');
    }
}
