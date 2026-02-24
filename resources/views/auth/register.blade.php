<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Nama Lengkap') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div>
                    <x-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>

            <hr class="my-6 border-gray-200">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-label for="tanggal_lahir" value="{{ __('Tanggal Lahir') }}" />
                    <x-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir"
                        :value="old('tanggal_lahir')" required />
                </div>

                <div>
                    <x-label for="jenis_kelamin" value="{{ __('Jenis Kelamin') }}" />
                    <select id="jenis_kelamin" name="jenis_kelamin"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                        required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="no_hp" value="{{ __('Nomor HP (WhatsApp)') }}" />
                <x-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')"
                    placeholder="0812xxxxxxxx" required />
            </div>

            <div class="mt-4">
                <x-label for="alamat" value="{{ __('Alamat Lengkap') }}" />
                <textarea id="alamat" name="alamat" rows="2"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                    required>{{ old('alamat') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-label for="id_provinsi" value="{{ __('Provinsi') }}" />
                    <select id="id_provinsi" name="id_provinsi"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                        required>
                        <option value="">Pilih Provinsi</option>
                        @foreach (\App\Models\Provinsi::orderBy('nama_provinsi', 'asc')->get() as $prov)
                            <option value="{{ $prov->id_provinsi }}">{{ $prov->nama_provinsi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-label for="id_kota" value="{{ __('Kota/Kabupaten') }}" />
                    <select id="id_kota" name="id_kota"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full disabled:bg-gray-100"
                        required disabled>
                        <option value="">Pilih Kota</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-label for="id_kecamatan" value="{{ __('Kecamatan') }}" />
                    <select id="id_kecamatan" name="id_kecamatan"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full disabled:bg-gray-100"
                        required disabled>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
                <div>
                    <x-label for="id_kelurahan" value="{{ __('Kelurahan/Desa') }}" />
                    <select id="id_kelurahan" name="id_kelurahan"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full disabled:bg-gray-100"
                        required disabled>
                        <option value="">Pilih Kelurahan</option>
                    </select>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Daftar Sekarang') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // 1. PROVINSI -> KOTA
        $('#id_provinsi').on('change', function() {
            var idProvinsi = $(this).val();
            $("#id_kota").html('<option value="">Pilih Kota</option>').prop('disabled', true);
            $("#id_kecamatan").html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
            $("#id_kelurahan").html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

            if (idProvinsi) {
                $.ajax({
                    url: '/api/get-kota/' + idProvinsi, // Gunakan /api/
                    type: "GET",
                    success: function(data) {
                        $("#id_kota").prop('disabled', false);
                        $.each(data, function(key, value) {
                            $("#id_kota").append('<option value="' + value.id_kota +
                                '">' + value.nama_kota + '</option>');
                        });
                    }
                });
            }
        });

        // 2. KOTA -> KECAMATAN
        $('#id_kota').on('change', function() {
            var idKota = $(this).val();
            $("#id_kecamatan").html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
            $("#id_kelurahan").html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

            if (idKota) {
                $.ajax({
                    url: '/api/get-kecamatan/' + idKota, // Gunakan /api/
                    type: "GET",
                    success: function(data) {
                        $("#id_kecamatan").prop('disabled', false);
                        $.each(data, function(key, value) {
                            $("#id_kecamatan").append('<option value="' + value
                                .id_kecamatan + '">' + value.nama_kecamatan +
                                '</option>');
                        });
                    }
                });
            }
        });

        // 3. KECAMATAN -> KELURAHAN
        $('#id_kecamatan').on('change', function() {
            var idKecamatan = $(this).val();
            $("#id_kelurahan").html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

            if (idKecamatan) {
                $.ajax({
                    url: '/api/get-kelurahan/' + idKecamatan, // Gunakan /api/
                    type: "GET",
                    success: function(data) {
                        if (data.length > 0) {
                            $("#id_kelurahan").prop('disabled', false);
                            $.each(data, function(key, value) {
                                $("#id_kelurahan").append('<option value="' + value
                                    .id_kelurahan + '">' + value
                                    .nama_kelurahan + '</option>');
                            });
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Cek error detail di console
                        alert('Gagal mengambil data kelurahan.');
                    }
                });
            }
        });
    });
</script>
