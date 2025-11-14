@extends('layouts.app')

@section('content')

<style>
    /* --- CSS Dashboard Khusus --- */

    /* 1. Welcome Banner */
    .welcome-card {
        background: linear-gradient(135deg, #0d6efd 0%, #0043a7 100%);
        border-radius: 20px;
        padding: 30px 40px;
        color: white;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    /* Dekorasi Lingkaran Abstrak di Banner */
    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -30px;
        right: 80px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    /* 2. Statistik Card Kecil */
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 15px;
    }

    .icon-blue {
        background: #e7f1ff;
        color: #0d6efd;
    }

    .icon-green {
        background: #e6fffa;
        color: #00b050;
    }

    /* 3. Tabel Card */
    .table-wrapper {
        background: #ffffff;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    }

    .table-title {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    /* Tabel Styling */
    .table-custom thead th {
        background-color: #f8f9fa;
        color: #6c757d;
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: 600;
        padding: 15px;
        border-bottom: none;
    }

    .table-custom tbody td {
        padding: 15px;
        vertical-align: middle;
        font-size: 0.9rem;
        color: #444;
        border-bottom: 1px solid #f5f5f5;
    }

    .table-custom tbody tr:hover {
        background-color: #fafafa;
    }

    /* Badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .bg-soft-success {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .bg-soft-danger {
        background-color: #f8d7da;
        color: #842029;
    }
</style>

<div class="container-fluid px-0">

    <div class="welcome-card animate__animated animate__fadeInDown">
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-md-8">
                <h2 class="fw-bold mb-1">Halo, {{ Auth::user()->name ?? 'Admin' }}!</h2>
                <p class="mb-0 opacity-75">Selamat datang di Dashboard GowesLurr.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="d-inline-block bg-white bg-opacity-25 px-4 py-2 rounded-3 backdrop-blur">
                    <i class="bi bi-calendar-event me-2"></i> {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>
    </div>

    @php
    // FIX VARIABLE NAME: Menggunakan $dataPemesanan agar sesuai Controller
    $totalPesanan = isset($dataPemesanan) ? count($dataPemesanan) : 0;

    $perluDenda = 0;
    if(isset($dataPemesanan)){
    foreach($dataPemesanan as $p){
    if(!$p->denda) $perluDenda++;
    }
    }
    @endphp

    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="stat-icon icon-blue">
                    <i class="bi bi-bag-check"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $totalPesanan }}</h3>
                    <span class="text-muted small">Total Pesanan Masuk</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="stat-icon icon-green">
                    <i class="bi bi-calculator"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $perluDenda }}</h3>
                    <span class="text-muted small">Perlu Hitung Denda</span>
                </div>
            </div>
        </div>
    </div>

    <div class="table-wrapper animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="table-title mb-0">Data Pesanan Terbaru</h5>
            <button onclick="location.reload()" class="btn btn-sm btn-light border rounded-pill px-3">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </button>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-3">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-custom text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Sepeda</th>
                        <th>Waktu Sewa</th>
                        <th>Bukti</th>
                        <th>Status Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- FIX VARIABLE NAME DI SINI JUGA --}}
                    @forelse($dataPemesanan as $order)
                    <tr>
                        <td class="fw-bold text-primary">#{{ $order->ID_Pemesanan }}</td>

                        <td>
                            <div class="fw-semibold text-dark">{{ $order->pelanggan->Nama ?? '-' }}</div>
                            <div class="small text-muted">
                                <i class="bi bi-whatsapp me-1 text-success"></i>
                                {{ $order->pelanggan->No_Telepon ?? '-' }}
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-2">
                                    <div class="fw-semibold">{{ $order->sepeda->Nama_Sepeda ?? 'Unknown' }}</div>
                                    <div class="small text-muted">{{ $order->paket->Nama_Paket ?? '-' }}</div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="small">
                                <span class="d-block text-muted">Mulai:
                                    {{ \Carbon\Carbon::parse($order->Tanggal_Mulai)->format('d M, H:i') }}</span>
                                <span class="d-block text-danger">Selesai:
                                    {{ \Carbon\Carbon::parse($order->Tanggal_Selesai)->format('d M, H:i') }}</span>
                            </div>
                        </td>

                        <td>
                            @if($order->pelanggan && $order->pelanggan->Bukti_Pembayaran)
                            <a href="{{ asset('storage/' . $order->pelanggan->Bukti_Pembayaran) }}" target="_blank"
                                class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                <i class="bi bi-image"></i> Cek
                            </a>
                            @else
                            <span class="text-muted small fst-italic">-</span>
                            @endif
                        </td>

                        <td>
                            @if($order->denda)
                            <span class="status-badge bg-soft-danger">
                                Denda: Rp {{ number_format($order->denda->Jumlah_Denda) }}
                            </span>
                            @else
                            <span class="status-badge bg-soft-success">
                                <i class="bi bi-shield-check me-1"></i> Aman
                            </span>
                            @endif
                        </td>

                        <td>
                            @if(!$order->denda)
                            <form action="{{ route('admin.denda.store', $order->ID_Pemesanan) }}" method="POST"
                                onsubmit="return confirm('Hitung denda untuk pesanan ini?');">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-warning text-white fw-bold rounded-pill px-3 shadow-sm">
                                    <i class="bi bi-calculator"></i> Hitung
                                </button>
                            </form>
                            @else
                            <button class="btn btn-sm btn-light text-muted border rounded-pill px-3" disabled>
                                <i class="bi bi-check2-all"></i> Selesai
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-inbox display-4 opacity-25 mb-2"></i>
                                <p class="mb-0">Belum ada pesanan baru.</p>
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