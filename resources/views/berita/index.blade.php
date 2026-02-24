@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header Halaman --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Manajemen /</span> {{ $title }}
            </h4>
            <div class="text-muted small">
                <i class="bx bx-calendar me-1"></i> {{ date('d M Y') }}
            </div>
        </div>

        {{-- Statistik Ringkas (Optional) --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-primary p-2 rounded-3 me-3">
                                    <i class="bx bx-news fs-3"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Total Publikasi</p>
                                    <h5 class="mb-0 fw-bold">{{ $berita->count() }} Berita</h5>
                                </div>
                            </div>
                            @if (auth()->user()->jabatan == 'Admin' || auth()->user()->id == 1)
                                <a href="{{ route('berita.create') }}" class="btn btn-primary shadow-sm">
                                    <i class="bx bx-plus me-1"></i> Tambah Berita
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pesan Sukses --}}
        {{-- Pesan Sukses --}}
        @if ($message = Session::get('Sukses'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex">
                    <i class="bx bx-check-circle me-2 fs-4"></i>
                    <div>{{ $message }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Pesan Error / Akses Ditolak --}}
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <div class="d-flex">
                    <i class="bx bx-error-circle me-2 fs-4"></i>
                    <div>{{ $message }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tabel Data --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark"><i class="bx bx-list-ul me-2"></i>Daftar Konten Berita</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0" id="example2">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center py-3" width="70">No</th>
                            <th>Tanggal Publikasi</th>
                            <th>Informasi Berita</th>
                            <th class="text-center">Thumbnail</th>
                            @if (auth()->user()->jabatan == 'Admin' || auth()->user()->id == 1)
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($berita as $row)
                            <tr>
                                <td class="text-center text-muted fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="d-block fw-bold text-dark">
                                        {{ Carbon\Carbon::parse($row->tanggal_berita)->isoFormat('D MMMM Y') }}
                                    </span>
                                    <small
                                        class="text-muted">{{ Carbon\Carbon::parse($row->tanggal_berita)->isoFormat('dddd') }}</small>
                                </td>
                                <td style="max-width: 300px; white-space: normal;">
                                    <h6 class="mb-1 fw-bold text-primary">{{ $row->judul_berita }}</h6>
                                    <p class="mb-0 small text-muted">
                                        {!! Str::limit(strip_tags($row->isi_berita), 80, '...') !!}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <div class="avatar avatar-xl d-inline-block">
                                        <img src="{{ asset('file/berita/' . $row->gambar_berita) }}" alt="Thumbnail"
                                            class="rounded-3 object-fit-cover"
                                            style="width: 80px; height: 50px; border: 1px solid #eee;">
                                    </div>
                                </td>


                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('berita.show', $row->id_berita) }}"
                                            class="btn btn-sm btn-label-info">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        @if (auth()->user()->jabatan == 'Admin' || auth()->user()->id == 1)
                                            <a href="{{ route('berita.edit', $row->id_berita) }}"
                                                class="btn btn-icon btn-label-primary btn-sm" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>

                                            <form action="{{ route('berita.destroy', $row->id_berita) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-label-danger btn-sm show_confirm"
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/gray/no-data-found.svg" alt="no-data"
                                        width="120" class="mb-3">
                                    <p class="text-muted mb-0">Belum ada data berita yang diterbitkan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
