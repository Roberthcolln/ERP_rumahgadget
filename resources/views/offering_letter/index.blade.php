@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">SDM /</span> {{ $title }}
        </h4>

        {{-- Flash Message --}}
        @if (session('Sukses'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('Sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Offering Letter</h5>
                <a href="{{ route('offering-letter.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Buat OL Baru
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Surat</th>
                            <th>Kandidat</th>
                            <th>Posisi</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($letters as $letter)
                            <tr>
                                <td><strong>{{ $letter->nomor_surat }}</strong></td>
                                <td>{{ $letter->nama_kandidat }}</td>
                                <td>{{ $letter->posisi }}</td>
                                <td>{{ \Carbon\Carbon::parse($letter->tanggal_mulai)->translatedFormat('d F Y') }}</td>
                                <td><span class="badge bg-label-info">{{ $letter->status_kerja }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item text-primary"
                                                href="{{ route('offering-letter.print', $letter->id) }}" target="_blank">
                                                <i class="bx bx-printer me-1"></i> Print PDF
                                            </a>
                                            <form action="{{ route('offering-letter.destroy', $letter->id) }}"
                                                method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data offering letter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
