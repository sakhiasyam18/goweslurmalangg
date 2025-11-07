{{-- Menggunakan layout admin ('layouts.app') --}}
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

                        <th>Bukti Bayar</th>

                        <th>Status Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Looping data dari DashboardController@index --}}
                    @forelse($dataPemesanan as $order)
                    <tr>
                        <td>{{ $order->ID_Pemesanan }}</td>

                        {{-- Pastikan relasi 'Pelanggan' (P besar) sudah benar di Model Pemesanan --}}
                        <td>{{ $order->Pelanggan->Nama ?? 'Data Pelanggan Hilang' }}</td>
                        <td>{{ $order->Pelanggan->No_Telepon ?? '-' }}</td>
                        <td>{{ $order->sepeda->Nama_Sepeda ?? 'Data Sepeda Hilang' }}</td>
                        <td>{{ $order->paket->Nama_Paket ?? 'Data Paket Hilang' }}</td>

                        <td>{{ \Carbon\Carbon::parse($order->Tanggal_Mulai)->format('d M Y, H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->Tanggal_Selesai)->format('d M Y, H:i') }}</td>

                        <td class="text-center">
                            @if($order->Pelanggan && $order->Pelanggan->Bukti_Pembayaran)
                            {{--
                                      Ini membuat link ke file yang tersimpan di 'storage/app/public/bukti_pembayaran/...'
                                      Pastikan Anda sudah menjalankan 'php artisan storage:link'
                                    --}}
                            <a href="{{ asset('storage/' . $order->Pelanggan->Bukti_Pembayaran) }}" target="_blank"
                                class="btn btn-info btn-sm">
                                Lihat Bukti
                            </a>
                            @else
                            <span class="text-muted">Tidak Ada</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($order->denda)
                            <span class="badge bg-danger">
                                Denda: Rp {{ number_format($order->denda->Jumlah_Denda) }}
                            </span>
                            @else
                            <span class="badge bg-success">Aman</span>
                            @endif
                        </td>

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
                        {{-- Update colspan menjadi 10 (karena tambah 1 kolom) --}}
                        <td colspan="10" class="text-center">Belum ada pemesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection