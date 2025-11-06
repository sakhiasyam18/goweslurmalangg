<div class="container mt-5">
    <h3>Daftar Pemesanan Masuk</h3>

    {{-- Pesan Sukses/Error Denda --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Pelanggan</th> {{-- Nanti bisa relasi ke tabel pelanggan --}}
                    <th>Sepeda</th>
                    <th>Tgl Sewa</th>
                    <th>Durasi</th>
                    <th>Aksi (Denda)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataPemesanan as $order)
                <tr>
                    <td>{{ $order->ID_Pemesanan }}</td>
                    <td>{{ $order->ID_Pelanggan }}</td>
                    <td>{{ $order->Nama_Sepeda ?? $order->ID_Sepeda }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->Tanggal_Sewa)->format('d M Y H:i') }}</td>
                    <td>{{ $order->Durasi_Sewa }}</td>
                    <td>
                        {{-- TOMBOL DENDA --}}
                        {{-- Hanya muncul jika belum ada denda --}}
                        @if(!$order->denda)
                        <form action="{{ route('denda.store', $order->ID_Pemesanan) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghitung denda untuk pesanan ini?');">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                Hitung Denda
                            </button>
                        </form>
                        @else
                        <span class="badge bg-success">Sudah Dicek</span>
                        <br>
                        <small>Denda: Rp {{ number_format($order->denda->Jumlah_Denda) }}</small>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pemesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>