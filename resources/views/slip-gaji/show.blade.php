@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> Detail {{ $title }}
            </h4>
            <a href="{{ route('slip-gaji.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    {{-- Header Slip --}}
                    <div class="card-header border-bottom bg-white py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-3">
                                    <span class="avatar-initial rounded-circle bg-label-primary fs-2">
                                        {{ substr($slip->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold text-dark">{{ $slip->user->name }}</h5>
                                    <span class="badge bg-label-info mt-1">
                                        <i class="bx bx-calendar-event me-1"></i> Periode: {{ $slip->periode }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-end d-none d-sm-block">
                                <h6 class="text-muted mb-0 small text-uppercase">Slip Gaji Digital</h6>
                                <p class="fw-bold mb-0">ID: #SG-{{ str_pad($slip->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-4">
                        {{-- Rincian Pendapatan --}}
                        <h6 class="text-uppercase fw-bold small text-muted mb-3 mt-2">Rincian Pendapatan</h6>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="ps-0 py-2 text-dark">Gaji Pokok</td>
                                        <td class="pe-0 py-2 text-end fw-semibold">Rp
                                            {{ number_format($slip->gaji_pokok, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0 py-2 text-dark">Tunjangan</td>
                                        <td class="pe-0 py-2 text-end fw-semibold">Rp
                                            {{ number_format($slip->tunjangan ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0 py-2 text-dark">Biaya Layanan (Service)</td>
                                        <td class="pe-0 py-2 text-end fw-semibold">Rp
                                            {{ number_format($slip->biaya_layanan ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-4 border-dashed">

                        {{-- Rincian Potongan --}}
                        <h6 class="text-uppercase fw-bold small text-danger mb-3">Potongan</h6>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="ps-0 py-2 text-dark">Potongan Kedisiplinan / Lainnya</td>
                                        <td class="pe-0 py-2 text-end fw-semibold text-danger">- Rp
                                            {{ number_format($slip->potongan ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Total Box --}}
                        <div class="bg-label-success rounded-3 p-4 mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0 text-success fw-bold">Total Gaji Diterima (Take Home Pay)</h5>
                                    <small class="text-muted">Sudah termasuk tunjangan dan dipotong biaya
                                        layanan/lainnya.</small>
                                </div>
                                <div class="text-end">
                                    <h3 class="mb-0 text-success fw-bold">Rp
                                        {{ number_format($slip->total_gaji, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Action --}}
                    <div class="card-footer bg-light border-top py-3">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                            <small class="text-muted">Dicetak secara sistem pada {{ date('d/m/Y H:i') }}</small>
                            <div class="btn-group">
                                <a href="{{ route('slip-gaji.print', $slip->id) }}" class="btn btn-danger" target="_blank">
                                    <i class="bx bxs-file-pdf me-1"></i> Download PDF
                                </a>
                                <button onclick="window.print()" class="btn btn-outline-secondary">
                                    <i class="bx bx-printer me-1"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-dashed {
            border-top: 2px dashed #ebedf0 !important;
            background-color: transparent;
        }

        .avatar-xl {
            width: 50px;
            height: 50px;
        }

        @media print {

            .btn,
            .navbar,
            .menu-inner,
            .footer,
            .layout-navbar {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: none !important;
            }

            .mx-auto {
                width: 100% !important;
                max-width: 100% !important;
            }
        }
    </style>
@endsection
