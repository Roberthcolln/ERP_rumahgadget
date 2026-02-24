@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4">

            {{-- ================= DAFTAR PRODUK (KIRI) ================= --}}
            <div class="col-lg-8 col-md-12">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold text-primary">Katalog Produk</h5>
                            <small class="text-muted">Pilih produk untuk ditambahkan ke keranjang</small>
                        </div>
                        @if (auth()->user()->jabatan == 'Admin')
                            <div style="min-width: 200px;">
                                <form method="GET">
                                    <select name="id_gudang" class="form-select form-select-sm border-primary"
                                        onchange="this.form.submit()">
                                        <option value="">Semua Lokasi</option>
                                        @foreach ($gudang as $g)
                                            <option value="{{ $g->id_gudang }}"
                                                {{ $idGudang == $g->id_gudang ? 'selected' : '' }}>
                                                📍 {{ $g->nama_gudang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="card-body bg-light-alt" style="max-height: 80vh; overflow-y: auto;">
                        {{-- SEARCH BAR --}}
                        <div class="input-group input-group-merge mb-4 shadow-sm">
                            <span class="input-group-text border-0 bg-white"><i class="bx bx-search fs-4"></i></span>
                            <input type="text" id="searchProduk" class="form-control border-0 py-3 ps-0"
                                placeholder="Cari nama produk atau scan barcode...">
                        </div>

                        <div class="row g-3" id="produk-list">
                            @foreach ($produk as $kategori => $items)
                                <div class="col-12 mt-4 mb-2">
                                    <span class="badge bg-label-primary text-uppercase px-3">{{ $kategori }}</span>
                                </div>

                                @foreach ($items as $p)
                                    @php
                                        $hargaProduk =
                                            $p->harga_promo_produk > 0 ? $p->harga_promo_produk : $p->harga_jual_produk;
                                        $diskon =
                                            $p->harga_promo_produk > 0
                                                ? round(
                                                    (($p->harga_jual_produk - $p->harga_promo_produk) /
                                                        $p->harga_jual_produk) *
                                                        100,
                                                )
                                                : 0;
                                        $stokQty = optional($p->gudang->first())->pivot->qty ?? 0;
                                    @endphp

                                    <div class="col-6 col-sm-4 col-xl-3 product-item"
                                        data-nama="{{ strtolower($p->nama_produk) }}">
                                        <div class="card h-100 border-0 shadow-sm pos-product-card {{ $stokQty > 0 ? '' : 'out-of-stock' }}"
                                            onclick="{{ $stokQty > 0 ? "addCart($p->id_produk, '$p->nama_produk', $hargaProduk)" : '' }}">

                                            <div class="position-relative">
                                                <img src="{{ asset('file/produk/' . $p->gambar_produk) }}"
                                                    class="card-img-top" style="height:120px; object-fit:cover;">
                                                @if ($diskon > 0)
                                                    <div class="pos-badge-promo">-{{ $diskon }}%</div>
                                                @endif
                                                @if ($stokQty <= 0)
                                                    <div class="pos-overlay-stock">Habis</div>
                                                @endif
                                            </div>

                                            <div class="card-body p-2 mt-1">
                                                <p class="product-name mb-1 text-truncate fw-bold text-dark">
                                                    {{ $p->nama_produk }}</p>
                                                <div class="d-flex flex-column">
                                                    @if ($p->harga_promo_produk > 0)
                                                        <small class="text-muted text-decoration-line-through">Rp
                                                            {{ number_format($p->harga_jual_produk) }}</small>
                                                        <span class="fw-bold text-primary">Rp
                                                            {{ number_format($p->harga_promo_produk) }}</span>
                                                    @else
                                                        <span class="fw-bold text-primary">Rp
                                                            {{ number_format($p->harga_jual_produk) }}</span>
                                                    @endif
                                                </div>
                                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                                    <small class="text-muted"><i class="bx bx-package"></i>
                                                        {{ $stokQty }}</small>
                                                    <i class="bx bx-plus-circle text-primary fs-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= PANEL KASIR (KANAN) ================= --}}
            <div class="col-lg-4 col-md-12">
                <div class="card border-0 shadow-lg sticky-cart">
                    <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white fw-bold"><i class="bx bx-cart-alt"></i> Pesanan</h5>
                        <button class="btn btn-sm btn-outline-light border-0" onclick="resetCart()"><i
                                class="bx bx-trash"></i></button>
                    </div>

                    <div class="card-body p-0">
                        {{-- List Item --}}
                        <div class="cart-items-container px-3 py-2" style="height: 300px; overflow-y: auto;" id="cart-body">
                            <div class="text-center mt-5 text-muted">
                                <i class="bx bx-shopping-bag fs-1 opacity-25"></i>
                                <p>Keranjang Kosong</p>
                            </div>
                        </div>

                        {{-- Summary --}}
                        <div class="bg-light p-3 border-top mt-auto">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-bold text-dark" id="subtotal-display">Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <h4 class="mb-0 fw-extrabold text-dark">Total</h4>
                                <h4 class="mb-0 fw-extrabold text-success" id="total-display text-primary">Rp <span
                                        id="total">0</span></h4>
                            </div>

                            <div class="accordion accordion-flush mb-3" id="customerInfo">
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header">
                                        {{-- Hapus tulisan (Opsional) dan tambahkan tanda bintang --}}
                                        <button class="accordion-button px-0 bg-transparent fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#infoP">
                                            👤 Data Pelanggan <span class="text-danger ms-1">*</span>
                                        </button>
                                    </h2>
                                    {{-- Hapus class 'collapse' agar form otomatis terbuka/terlihat --}}
                                    <div id="infoP" class="accordion-collapse show" data-bs-parent="#customerInfo">
                                        <div class="py-2">
                                            <input type="text" id="nama_pelanggan"
                                                class="form-control form-control-sm mb-2 shadow-none border-primary"
                                                placeholder="Nama Pelanggan (Wajib)" required>
                                            <input type="text" id="no_hp"
                                                class="form-control form-control-sm mb-2 shadow-none border-primary"
                                                placeholder="No. Handphone (Wajib)" required>
                                            <input type="email" id="email"
                                                class="form-control form-control-sm mb-2 shadow-none border-primary"
                                                placeholder="Email (Wajib)" required>
                                            <input type="datetime-local" id="tanggal_penjualan"
                                                class="form-control form-control-sm shadow-none"
                                                value="{{ date('Y-m-d\TH:i') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small fw-bold text-uppercase text-muted">Nominal Bayar</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-white">Rp</span>
                                    <input type="number" id="bayar"
                                        class="form-control fw-bold text-primary shadow-none" onkeyup="hitungKembalian()"
                                        placeholder="0">
                                </div>
                            </div>

                            <div class="p-2 rounded bg-label-secondary mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="fw-bold">Kembalian</small>
                                    <span class="fw-bold text-dark fs-5">Rp <span id="kembalian_text">0</span></span>
                                    <input type="hidden" id="kembalian" value="0">
                                </div>
                            </div>

                            <button class="btn btn-primary btn-lg w-100 shadow fw-bold py-3" onclick="checkout()">
                                PROSES TRANSAKSI
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-light-alt {
            background-color: #f8f9fa;
        }

        .fw-extrabold {
            font-weight: 800;
        }

        /* Product Card Hover */
        .pos-product-card {
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            border-radius: 12px;
            overflow: hidden;
        }

        .pos-product-card:hover:not(.out-of-stock) {
            transform: translateY(-4px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1) !important;
            background: #fff !important;
        }

        .pos-product-card.out-of-stock {
            opacity: 0.6;
            filter: grayscale(1);
            cursor: not-allowed;
        }

        /* Badges */
        .pos-badge-promo {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #ff3e1d;
            color: #fff;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: bold;
        }

        .pos-overlay-stock {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
        }

        /* Cart Styles */
        .cart-item-row {
            border-bottom: 1px dashed #dee2e6;
            padding: 10px 0;
        }

        .qty-input {
            width: 45px;
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-weight: bold;
        }

        .sticky-cart {
            position: sticky;
            top: 80px;
            border-radius: 15px;
        }

        @media (max-width: 992px) {
            .sticky-cart {
                position: relative;
                top: 0;
            }
        }
    </style>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let cart = [];

            window.addCart = function(id, nama, harga) {
                let existing = cart.find(x => x.id_produk === id);
                if (existing) {
                    existing.qty++;
                } else {
                    cart.push({
                        id_produk: id,
                        nama: nama,
                        harga: harga,
                        qty: 1
                    });
                }
                renderCart();
            }

            window.updateQty = function(index, val) {
                let qty = parseInt(val);
                if (qty < 1 || isNaN(qty)) qty = 1;
                cart[index].qty = qty;
                renderCart();
            }

            window.removeItem = function(index) {
                cart.splice(index, 1);
                renderCart();
            }

            window.resetCart = function() {
                cart = [];
                renderCart();
            }

            function renderCart() {
                let html = '',
                    total = 0;
                if (cart.length === 0) {
                    html = `<div class="text-center mt-5 text-muted">
                            <i class="bx bx-shopping-bag fs-1 opacity-25"></i>
                            <p>Keranjang Kosong</p>
                        </div>`;
                } else {
                    cart.forEach((item, index) => {
                        let subtotal = item.qty * item.harga;
                        total += subtotal;
                        html += `
                    <div class="cart-item-row">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="me-2" style="flex:1">
                                <h6 class="mb-0 small fw-bold text-dark">${item.nama}</h6>
                                <small class="text-muted">@ ${item.harga.toLocaleString()}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-xs btn-outline-secondary p-1" onclick="updateQty(${index}, ${item.qty - 1})">-</button>
                                <input type="text" class="qty-input mx-1 shadow-none border-0" value="${item.qty}" onchange="updateQty(${index}, this.value)">
                                <button class="btn btn-xs btn-outline-secondary p-1" onclick="updateQty(${index}, ${item.qty + 1})">+</button>
                                <div class="ms-3 text-end" style="min-width: 80px;">
                                    <span class="fw-bold small">Rp ${subtotal.toLocaleString()}</span>
                                </div>
                                <button class="btn btn-link text-danger p-0 ms-2" onclick="removeItem(${index})"><i class="bx bx-x fs-4"></i></button>
                            </div>
                        </div>
                    </div>`;
                    });
                }
                document.getElementById('cart-body').innerHTML = html;
                document.getElementById('total').innerText = total.toLocaleString();
                document.getElementById('subtotal-display').innerText = 'Rp ' + total.toLocaleString();
                hitungKembalian();
            }

            window.hitungKembalian = function() {
                let total = parseInt(document.getElementById('total').innerText.replace(/,/g, '')) || 0;
                let bayar = parseInt(document.getElementById('bayar').value) || 0;
                let kembali = bayar - total;
                document.getElementById('kembalian').value = kembali;
                document.getElementById('kembalian_text').innerText = kembali > 0 ? kembali.toLocaleString() :
                    0;
            }

            window.checkout = function() {
                const total = parseInt(document.getElementById('total').innerText.replace(/,/g, ''));
                const bayar = parseInt(document.getElementById('bayar').value);
                const namaPelanggan = document.getElementById('nama_pelanggan').value.trim();
                const noHp = document.getElementById('no_hp').value.trim();
                const email = document.getElementById('email').value.trim();
                const tanggal = document.getElementById('tanggal_penjualan').value;

                // VALIDASI
                if (cart.length == 0) return Swal.fire('Oops!', 'Pilih produk dulu', 'warning');
                if (!namaPelanggan) return Swal.fire('Data Belum Lengkap', 'Nama Pelanggan wajib diisi!',
                    'warning');
                if (!noHp) return Swal.fire('Data Belum Lengkap', 'Nomor HP wajib diisi!', 'warning');
                if (!bayar || bayar < total) return Swal.fire('Pembayaran?',
                    'Uang bayar kurang atau belum diisi', 'warning');

                Swal.fire({
                    title: 'Konfirmasi Transaksi',
                    text: `Total Belanja: Rp ${total.toLocaleString()}. Proses sekarang?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Selesaikan!',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        // Mengirim data ke Controller menggunakan Fetch API
                        return fetch("{{ route('pos.checkout') }}", { // Pastikan name route sesuai
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // Wajib untuk keamanan Laravel
                                },
                                body: JSON.stringify({
                                    nama_pelanggan: namaPelanggan,
                                    no_hp: noHp,
                                    email: email,
                                    tanggal_penjualan: tanggal,
                                    total: total,
                                    bayar: bayar,
                                    items: cart // Variabel array cart yang sudah Anda buat
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    return response.json().then(err => {
                                        throw new Error(err.message)
                                    });
                                }
                                return response.json();
                            })
                            .catch(error => {
                                Swal.showValidationMessage(`Request failed: ${error}`);
                            });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed && result.value.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Transaksi telah disimpan.',
                            icon: 'success'
                        }).then(() => {
                            // Opsional: Buka struk di tab baru
                            window.open(`/pos/print/${result.value.id}`, '_blank');
                            // Refresh halaman atau reset cart
                            location.reload();
                        });
                    }
                });
            }

            // Search Logic
            document.getElementById('searchProduk').addEventListener('keyup', function() {
                let keyword = this.value.toLowerCase();
                document.querySelectorAll('.product-item').forEach(el => {
                    el.style.display = el.dataset.nama.includes(keyword) ? '' : 'none';
                });
            });
        });
    </script>
@endpush
