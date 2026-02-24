<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'alamat',
        'status',
        'jenis_kelamin',
        'id_kategori_anggota',
        'id_departement',
        'id_divisi',
        'nik',
        'jabatan',
        'id_pusat',
        'id_region',
        'id_provinsi', // Foreign Key ke tabel provinsi
        'id_kota',     // Foreign Key ke tabel kota
        'id_kecamatan', // Foreign Key ke tabel kecamatan
        'id_kelurahan', // Foreign Key ke tabel kelurahan
        'foto',
        'tanggal_gabung',
        'tanggal_lahir' // Tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal_lahir' => 'date',
        'tanggal_gabung' => 'date',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    // Relasi Wilayah (Asumsi nama model sesuai tabel)
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

    public function slipGaji()
    {
        return $this->hasMany(SlipGaji::class, 'user_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id_region');
    }

    public function gudangAkses()
    {
        if ($this->id == 1) return null;

        return match ($this->id_region) {
            1 => 2,
            2 => 3,
            default => null
        };
    }
}
