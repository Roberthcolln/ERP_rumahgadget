@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Manajemen /</span> {{ $title }}
            </h4>
            @if (auth()->user()->jabatan == 'Admin' || auth()->user()->id == 1)
                <a href="{{ route('ratecard.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bx bx-plus me-1"></i> Tambah Layanan
                </a>
            @endif
        </div>

        @if ($message = Session::get('Sukses'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="bx bx-check-circle me-2 fs-4"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" width="70">No</th>
                            <th>Platform</th>
                            <th>Layanan</th>
                            <th>Harga (Rp)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ratecards as $row)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                {{-- Contoh di index.blade.php --}}
                                <td>
                                    @foreach ($row->platform as $p)
                                        <span class="badge bg-label-primary">{{ $p }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('file/ratecard/' . $row->gambar_layanan) }}" class="rounded me-3"
                                            width="50" height="50" style="object-fit: cover">
                                        <span class="fw-bold">{{ $row->nama_layanan }}</span>
                                    </div>
                                </td>
                                <td class="fw-bold text-success">
                                    Rp. {{ number_format($row->harga, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        @if (auth()->user()->jabatan == 'Admin' || auth()->user()->id == 1)
                                            <a href="{{ route('ratecard.edit', $row->id_rate_card) }}"
                                                class="btn btn-sm btn-label-primary">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            <form action="{{ route('ratecard.destroy', $row->id_rate_card) }}"
                                                method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-label-danger show_confirm">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
