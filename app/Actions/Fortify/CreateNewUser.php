<?php

namespace App\Actions\Fortify;

use App\Models\Pelanggan; // Ubah ini
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    // Return type diganti menjadi model Pelanggan (atau hapus type hint jika ragu)
    public function create(array $input): Pelanggan
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pelanggan,email'], // Unik di tabel pelanggan
            'password' => $this->passwordRules(),
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'tanggal_lahir' => ['required', 'date'],
            'id_provinsi' => ['required', 'integer'],
            'id_kota' => ['required', 'integer'],
            'id_kecamatan' => ['required', 'integer'],
            'id_kelurahan' => ['required', 'integer'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return Pelanggan::create([
            'nama_pelanggan' => $input['name'], // Sesuaikan dengan kolom di tabel pelanggan
            'email'          => $input['email'],
            'password'       => Hash::make($input['password']),
            'no_hp'          => $input['no_hp'],
            'alamat'         => $input['alamat'],
            'jenis_kelamin'  => $input['jenis_kelamin'],
            'tanggal_lahir'  => $input['tanggal_lahir'],
            'id_provinsi'    => $input['id_provinsi'],
            'id_kota'        => $input['id_kota'],
            'id_kecamatan'   => $input['id_kecamatan'],
            'id_kelurahan'   => $input['id_kelurahan'],
            'status'         => 'Pending',

            'point'          => 100, // Bonus Pendaftaran Pertama
            'level'          => 'Bronze',
            'status'         => 'Active', // Ubah ke Active agar langsung bisa digunakan
        ]);
    }
}
