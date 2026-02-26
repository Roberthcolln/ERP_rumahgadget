@extends('layouts.web')

@section('isi')
    <section class="jual_hp_section layout_padding">
        <div class="container text-center">
            <div class="heading_container heading_center">
                <h2 style="font-weight: 800; color: #000;">Jual HP Lama Kamu di Rumah Gadget!</h2>
                <p style="color: #666; margin-top: -10px;">Dapatkan Handphone impian kamu dengan Rumah Gadget</p>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                        <div class="form-group">
                            <select class="form-control form-control-lg custom-select" id="pilihHp"
                                style="border-radius: 15px; border: 1px solid #eee;">
                                <option selected disabled>HP Kamu Saat ini</option>
                                @foreach ($produk as $pro)
                                    <option value="{{ $pro->id_produk }}">{{ $pro->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <button id="btnCekHarga" class="btn btn-dark px-5 py-2"
                                style="border-radius: 12px; font-weight: 600;">
                                Cek Harga
                            </button>
                        </div>

                        <div id="resultHarga" class="mt-4" style="display: none;">
                            <hr>
                            <h3 class="text-success" style="font-weight: 700;" id="displayHarga">Rp 0</h3>
                            <p class="text-muted" style="font-size: 12px;">Terakhir diperbarui: <span
                                    id="displayWaktu">-</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-md-10">
                    <div class="bg-dark text-white p-4 p-md-5 text-left position-relative"
                        style="border-radius: 30px; overflow: hidden;">
                        <h4 class="text-center mb-4" style="font-weight: 700;">Harga di Atas Hanya Berlaku Untuk</h4>
                        <ul style="list-style: none; padding-left: 0; line-height: 2;">
                            <li>— Lolos pengecekan fungsi secara langsung oleh tim general check up Rumah Gadget</li>
                            <li>— Fisik mulus tidak ada lecet, retak dan sebagainya</li>
                            <li>— Fungsi Hp secara keseluruhan normal</li>
                            <li>— IMEI tidak terblokir dan terdaftar di database Beacukai</li>
                            <li>— Baterai tidak drop dengan kesehatan minimal 85%</li>
                            <li>— Spare parts hp original, tidak pernah dibongkar/service sebelumnya</li>
                            <li>— Terbebas dari iCloud/Google/Samsung Activation Lock</li>
                            <li>— Tidak tersangkut kasus hukum</li>
                            <li>— Tidak dalam masa cicilan</li>
                            <li>— <strong>Wajib membawa identitas diri seperti KTP/SIM/Kartu Pelajar</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btnCekHarga').on('click', function() {
                let idProduk = $('#pilihHp').val();

                if (!idProduk) {
                    alert('Silakan pilih HP terlebih dahulu!');
                    return;
                }

                // Ubah text tombol saat loading
                let btn = $(this);
                btn.prop('disabled', true).text('Checking...');

                $.ajax({
                    url: "{{ url('/cek-harga') }}/" + idProduk,
                    type: "GET",
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            $('#displayHarga').text(response.harga);
                            $('#displayWaktu').text(response.waktu);
                            $('#resultHarga').fadeIn(); // Munculkan dengan animasi
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data. Pastikan produk tersedia.');
                    },
                    complete: function() {
                        btn.prop('disabled', false).text('Cek Harga');
                    }
                });
            });
        });
    </script>
@endsection
