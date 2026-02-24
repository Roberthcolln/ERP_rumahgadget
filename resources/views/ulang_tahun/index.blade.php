@extends('layouts.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4">
            <div class="col-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-cake fs-3"></i>
                                </span>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $title }}</h5>
                                <small class="text-muted">Bulan:
                                    <strong>{{ Carbon\Carbon::parse($month)->isoFormat('MMMM Y') }}</strong></small>
                            </div>
                        </div>

                        <form action="{{ url('ulang_tahun') }}" method="GET" class="d-flex gap-2">
                            <input type="month" name="month" class="form-control"
                                value="{{ request('month', date('Y-m')) }}">
                            <button type="submit" class="btn btn-primary px-3">
                                <i class="bx bx-search-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        @if ($message = Session::get('Sukses'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bx bx-check-circle me-1"></i> {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover align-middle" id="example1">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th>Karyawan</th>
                                        <th>ID Anggota</th>
                                        <th><i class="bx bx-calendar me-1"></i> Tanggal Lahir</th>
                                        <th>Kontak</th>
                                        <th class="text-center">Ucapan Spesial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($hbd as $row)
                                        @php
                                            // Logika cek apakah hari ini ulang tahunnya
                                            $isToday = Carbon\Carbon::parse($row->tanggal_lahir)->isBirthday();

                                            // Menyiapkan pesan teks
                                            $pesan = urlencode(
                                                'Halo *' .
                                                    $row->name .
                                                    "*, \n\nSaya mewakili tim " .
                                                    ($konf->instansi_setting ?? 'Manajemen') .
                                                    " ingin mengucapkan Selamat Ulang Tahun! 🎂✨ \nSemoga panjang umur, sehat selalu, dan semakin sukses dalam karir. Teruslah menginspirasi! \n\nSalam hangat, \n*Manajemen*",
                                            );
                                        @endphp

                                        <tr class="{{ $isToday ? 'table-warning animate__animated animate__fadeIn' : '' }}"
                                            style="{{ $isToday ? 'border-left: 5px solid #ffab00;' : '' }}">

                                            <td class="text-center text-muted">
                                                @if ($isToday)
                                                    <i class="bx bxs-star text-warning"></i>
                                                @else
                                                    {{ $loop->iteration }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="avatar avatar-sm me-3 {{ $isToday ? 'avatar-online' : '' }}">
                                                        <img src="{{ asset('file/foto/' . $row->foto) }}" alt="Foto User"
                                                            class="rounded-circle"
                                                            style="width: 40px; height: 40px; object-fit: cover;" />
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="fw-semibold d-block text-dark">{{ $row->name }}</span>
                                                        @if ($isToday)
                                                            <span
                                                                class="badge bg-label-warning btn-xs animate__animated animate__pulse animate__infinite">🎉
                                                                Hari Ini</span>
                                                        @else
                                                            <small class="text-muted">{{ $row->email }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge bg-label-secondary fw-bold">
                                                    {{ $row->id_kategori_anggota == 1 ? 'A' : ($row->id_kategori_anggota == 2 ? 'B' : 'K') }}
                                                    - {{ str_pad($row->id, 5, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="{{ $isToday ? 'fw-bold text-primary' : '' }}">
                                                        {{ Carbon\Carbon::parse($row->tanggal_lahir)->isoFormat('D MMMM') }}
                                                    </span>
                                                    <small class="text-muted text-xs">Tahun
                                                        {{ Carbon\Carbon::parse($row->tanggal_lahir)->format('Y') }}</small>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="https://wa.me/62{{ $row->no_hp }}" target="_blank"
                                                        class="btn btn-sm btn-icon btn-label-success shadow-none me-2">
                                                        <i class="bx bxl-whatsapp fs-4"></i>
                                                    </a>
                                                    <span class="text-muted small">+62{{ $row->no_hp }}</span>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="https://wa.me/62{{ $row->no_hp }}?text={{ $pesan }}"
                                                        target="_blank"
                                                        class="btn btn-sm {{ $isToday ? 'btn-primary' : 'btn-success' }} px-3 shadow-sm">
                                                        <i class="bx bx-paper-plane me-1"></i> Kirim Ucapan
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
