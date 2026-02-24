@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Stok /</span> Barang Masuk</h4>

        <form action="{{ route('stok.masuk.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Gudang Penerima</label>
                                <select name="id_gudang" class="form-select" required>
                                    @foreach ($gudang as $g)
                                        <option value="{{ $g->id_gudang }}">{{ $g->nama_gudang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pihak Pemberi (Supplier)</label>
                                <select name="pihak_eksternal" class="form-select" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $s)
                                        <option value="{{ $s->nama_supplier }}">{{ $s->nama_supplier }}
                                            ({{ $s->perusahaan }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="catatan" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Produk</h5>
                            <button type="button" class="btn btn-sm btn-primary" id="add-item">
                                <i class="bx bx-plus"></i> Tambah Baris
                            </button>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="table-items">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th width="150">Qty</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="items[0][id_produk]" class="form-select" required>
                                                <option value="">-- Pilih Produk --</option>
                                                @foreach ($produk as $p)
                                                    <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="items[0][qty]" class="form-control" min="1"
                                                required>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success w-100">Simpan Barang Masuk</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        let rowIdx = 1;
        document.getElementById('add-item').addEventListener('click', function() {
            let table = document.getElementById('table-items').getElementsByTagName('tbody')[0];
            let newRow = table.insertRow();
            newRow.innerHTML = `
            <td>
                <select name="items[${rowIdx}][id_produk]" class="form-select" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($produk as $p)
                        <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="items[${rowIdx}][qty]" class="form-control" min="1" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="bx bx-trash"></i></button>
            </td>
        `;
            rowIdx++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
@endsection
