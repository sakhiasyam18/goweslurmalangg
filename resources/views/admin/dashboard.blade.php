{{-- Menggunakan layout admin yang sudah kita buat --}}
@extends('layouts.app')

@section('content')
<h4 class="fw-bold mb-4">DATA PEMESANAN</h4>

{{-- Pesan Sukses/Error (setelah klik tombol Hitung Denda) --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID Order</th>
                        <th>Pelanggan</th>
                        <th>No. Telepon</th>
                        <th>Sepeda</th>
                        <th>Paket</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Status Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Looping data dari AdminController --}}
                    @forelse($dataPemesanan as $order)
                    <tr>
                        <td>{{ $order->ID_Pemesanan }}</td>

                        <!-- Mengambil data dari relasi (yang di-load di Controller) -->
                        <td>{{ $order->pelanggan->Nama ?? 'Data Pelanggan Hilang' }}</td>
                        <td>{{ $order->pelanggan->No_Telepon ?? '-' }}</td>
                        <td>{{ $order->sepeda->Nama_Sepeda ?? 'Data Sepeda Hilang' }}</td>
                        <td>{{ $order->paket->Nama_Paket ?? 'Data Paket Hilang' }}</td>

                        <!-- Format Tanggal menggunakan Carbon -->
                        <td>{{ \Carbon\Carbon::parse($order->Tanggal_Mulai)->format('d M Y, H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->Tanggal_Selesai)->format('d M Y, H:i') }}</td>

                        <!-- Cek Denda -->
                        <td class="text-center">
                            @if($order->denda)
                            <span class="badge bg-danger">
                                Denda: Rp {{ number_format($order->denda->Jumlah_Denda) }}
                            </span>
                            @else
                            <span class="badge bg-success">Aman</span>
                            @endif
                        </td>

                        <!-- Tombol Aksi (Hitung Denda) -->
                        <td class="text-center">
                            {{-- Hanya muncul jika belum ada denda --}}
                            @if(!$order->denda)
                            <form action="{{ route('admin.denda.store', $order->ID_Pemesanan) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghitung denda untuk pesanan ini?');">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    Hitung Denda
                                </button>
                            </form>
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada pemesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection