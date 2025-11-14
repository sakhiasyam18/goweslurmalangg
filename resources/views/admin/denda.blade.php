@extends('layouts.app')

@section('content')

<style>
    /* --- CSS Khusus Data Denda --- */
    .denda-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        overflow: hidden;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.5rem;
        position: relative;
        padding-left: 15px;
    }

    .page-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 25px;
        width: 5px;
        background: #dc3545;
        /* Merah untuk Denda */
        border-radius: 5px;
    }

    /* Table Styling */
    .table-custom thead th {
        background-color: #fff5f5;
        /* Background header merah muda lembut */
        color: #dc3545;
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 15px;
        border-bottom: 2px solid #ffe3e3;
        white-space: nowrap;
    }

    .table-custom tbody td {
        padding: 15px;
        vertical-align: middle;
        font-size: 0.95rem;
        color: #333;
        border-bottom: 1px solid #f9f9f9;
    }

    .table-custom tbody tr:hover {
        background-color: #fffafb;
    }

    /* Badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .bg-soft-warning {
        background: #fff3cd;
        color: #856404;
    }

    .bg-soft-danger {
        background: #f8d7da;
        color: #842029;
    }

    /* Highlight Angka Denda */
    .amount-text {
        font-weight: 700;
        color: #dc3545;
        font-size: 1rem;
    }
</style>

<div class="container-fluid px-0">

    <div class="page-header animate__animated animate__fadeInDown">
        <h4 class="page-title">Riwayat Denda & Keterlambatan</h4>
    </div>

    <div class="denda-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">ID</th>
                        <th class="text-center" width="10%">Order Ref</th>
                        <th>Nama Pelanggan</th>
                        <th>Keterangan / Selisih Waktu</th>
                        <th class="text-end">Total Tagihan</th>
                        <th class="text-center">Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataDenda as $denda)
                    <tr>
                        <td class="text-center fw-bold text-muted">
                            #{{ $denda->ID_Denda }}
                        </td>

                        <td class="text-center">
                            <span class="badge bg-light text-dark border rounded-pill px-3">
                                Order #{{ $denda->ID_Pemesanan }}
                            </span>
                        </td>

                        <td>
                            <div class="fw-semibold text-dark">
                                {{ $denda->pemesanan->pelanggan->Nama ?? 'Data Hilang' }}
                            </div>
                        </td>

                        <td>
                            @if($denda->Keterangan_Selisih)
                            <span class="status-badge bg-soft-warning">
                                <i class="bi bi-exclamation-triangle me-1"></i> {{ $denda->Keterangan_Selisih }}
                            </span>
                            @elseif($denda->Jam_Selisih)
                            <span class="status-badge bg-soft-danger">
                                <i class="bi bi-clock-history me-1"></i> Telat {{ $denda->Jam_Selisih }} Jam
                            </span>
                            @else
                            <span class="text-muted small">-</span>
                            @endif
                        </td>

                        <td class="text-end">
                            <span class="amount-text">
                                Rp {{ number_format($denda->Jumlah_Denda, 0, ',', '.') }}
                            </span>
                        </td>

                        <td class="text-center text-muted small">
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                <i class="bi bi-calendar2-event"></i>
                                {{ \Carbon\Carbon::parse($denda->Tanggal_Denda_Dibuat)->format('d M Y, H:i') }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-emoji-smile display-4 text-success opacity-50 mb-2"></i>
                                <p class="mb-0 fw-medium">Tidak ada data denda saat ini.</p>
                                <small class="opacity-75">Semua pesanan berjalan lancar & tepat waktu!</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection