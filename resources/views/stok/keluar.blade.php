@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Stok /</span> Barang Keluar
        </h4>

        @if (session('Gagal'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('Gagal') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('stok.keluar.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-danger py-3">
                            <h6 class="mb-0 text-white"><i class="bx bx-info-circle me-2"></i>Informasi Pengeluaran</h6>
                        </div>
                        <div class="card-body pt-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold small">GUDANG ASAL</label>
                                <select name="id_gudang" id="id_gudang_select" class="form-select" required>
                                    <option value="">-- Pilih Gudang --</option>
                                    @foreach ($gudang as $g)
                                        <option value="{{ $g->id_gudang }}">{{ $g->nama_gudang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">PIHAK PENERIMA (CUSTOMER/UNIT)</label>
                                <select name="pihak_eksternal" id="pihak_penerima_select" class="form-select" required
                                    disabled>
                                    <option value="">-- Pilih Gudang Terlebih Dahulu --</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">CATATAN</label>
                                <textarea name="catatan" class="form-control" rows="3" placeholder="Alasan pengeluran barang..."></textarea>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('stok.index') }}" class="btn btn-outline-secondary w-100">Kembali</a>
                </div>

                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                            <h6 class="mb-0 fw-bold">DAFTAR ITEM KELUAR</h6>
                            <button type="button" class="btn btn-sm btn-primary" id="add-item">
                                <i class="bx bx-plus me-1"></i> Tambah Baris
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush align-middle" id="table-items">
                                <thead class="table-light">
                                    <tr>
                                        <th>Pilih Produk</th>
                                        <th width="180">Jumlah (Qty)</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="items[0][id_produk]" class="form-select select2" required>
                                                <option value="">-- Cari Produk --</option>
                                                @foreach ($produk as $p)
                                                    <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" name="items[0][qty]" class="form-control"
                                                    min="1" placeholder="0" required>
                                                <span class="input-group-text">Unit</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <button type="submit" class="btn btn-danger w-100 py-2">
                                <i class="bx bx-export me-1"></i> Konfirmasi Barang Keluar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('id_gudang_select').addEventListener('change', function() {
            let idGudang = this.value;
            let userSelect = document.getElementById('pihak_penerima_select');

            if (idGudang) {
                // Aktifkan select user dan beri loading
                userSelect.disabled = false;
                userSelect.innerHTML = '<option value="">Memuat data...</option>';

                // Panggil AJAX
                fetch(`/get-users-by-gudang/${idGudang}`)
                    .then(response => response.json())
                    .then(data => {
                        userSelect.innerHTML = '<option value="">-- Pilih Penerima --</option>';
                        data.forEach(user => {
                            let option = document.createElement('option');
                            option.value = user.name; // Simpan nama sesuai kebutuhan storeKeluar
                            option.text = `${user.name} - ${user.jabatan}`;
                            userSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        userSelect.innerHTML = '<option value="">Gagal mengambil data</option>';
                    });
            } else {
                userSelect.disabled = true;
                userSelect.innerHTML = '<option value="">-- Pilih Gudang Terlebih Dahulu --</option>';
            }
        });
    </script>

    <script>
        let rowIdx = 1;

        // Fungsi Tambah Baris
        document.getElementById('add-item').addEventListener('click', function() {
            let table = document.querySelector('#table-items tbody');
            let newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td>
                <select name="items[${rowIdx}][id_produk]" class="form-select" required>
                    <option value="">-- Cari Produk --</option>
                    @foreach ($produk as $p)
                        <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" name="items[${rowIdx}][qty]" class="form-control" min="1" placeholder="0" required>
                    <span class="input-group-text">Unit</span>
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-icon btn-outline-danger btn-sm remove-row">
                    <i class="bx bx-trash"></i>
                </button>
            </td>
        `;
            table.appendChild(newRow);
            rowIdx++;
        });

        // Fungsi Hapus Baris
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script>

    <style>
        .card-header {
            padding: 1rem 1.25rem;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 1.25rem;
        }
    </style>
@endsection
