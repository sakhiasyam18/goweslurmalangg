<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pemesanan - GowesLur</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eef2f6;
            /* Warna background lembut */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Styling Kartu Struk */
        .receipt-card {
            background: #fff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            max-width: 500px;
            /* Lebar ideal seperti struk */
            width: 100%;
        }

        /* Hiasan atas kartu */
        .card-top-border {
            height: 8px;
            background: linear-gradient(to right, #0d6efd, #0dcaf0);
            width: 100%;
        }

        .success-icon {
            color: #198754;
            background-color: #d1e7dd;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 40px;
        }

        /* Garis putus-putus pemisah */
        .dashed-line {
            border-top: 2px dashed #dee2e6;
            margin: 20px 0;
            position: relative;
        }

        /* Efek sobekan kertas (opsional, visual only) */
        .dashed-line::before,
        .dashed-line::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: #eef2f6;
            /* Sama dengan bg body */
            border-radius: 50%;
            top: -12px;
        }

        .dashed-line::before {
            left: -25px;
        }

        .dashed-line::after {
            right: -25px;
        }

        /* Typography Data */
        .data-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .data-value {
            color: #212529;
            font-weight: 600;
            font-size: 0.95rem;
            text-align: right;
        }

        /* Tombol WA */
        .btn-wa {
            background-color: #25D366;
            color: white;
            font-weight: 600;
            border: none;
            padding: 12px;
            border-radius: 12px;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-wa:hover {
            background-color: #1ebc57;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        }

        .screenshot-hint {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            border: 1px solid #ffeeba;
        }
    </style>
</head>

<body>

    <div class="receipt-card">
        <div class="card-top-border"></div>

        <div class="p-4">
            @if(isset($pemesanan))
            <div class="text-center mb-4">
                <div class="success-icon animate__animated animate__bounceIn">
                    <i class="fas fa-check"></i>
                </div>
                <h4 class="fw-bold mb-1">Pemesanan Berhasil!</h4>
                <p class="text-muted small">ID Order: #{{ $pemesanan->ID_Pemesanan }}</p>
            </div>

            <div class="screenshot-hint text-center">
                <i class="fas fa-camera me-1"></i>
                <strong>Silakan Screenshot</strong> halaman ini sebagai bukti saat pengambilan sepeda.
            </div>

            <div class="vstack gap-3 mt-3">

                <div class="d-flex justify-content-between align-items-start">
                    <span class="data-label">Nama Penyewa</span>
                    <span class="data-value">{{ $pemesanan->pelanggan->Nama ?? '-' }}</span>
                </div>

                <div class="d-flex justify-content-between align-items-start">
                    <span class="data-label">Unit Sepeda</span>
                    <span class="data-value text-primary">{{ $pemesanan->sepeda->Nama_Sepeda ?? '-' }}</span>
                </div>

                <div class="d-flex justify-content-between align-items-start">
                    <span class="data-label">Paket Sewa</span>
                    <span class="data-value">{{ $pemesanan->paket->Nama_Paket ?? '-' }}
                        ({{ $pemesanan->paket->Durasi_Jam ?? 0 }} Jam)</span>
                </div>

                <div class="dashed-line"></div>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="data-label">Mulai Sewa</span>
                    <div class="text-end">
                        <span
                            class="d-block fw-bold text-dark">{{ \Carbon\Carbon::parse($pemesanan->Tanggal_Mulai)->translatedFormat('d M Y') }}</span>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($pemesanan->Tanggal_Mulai)->format('H:i') }}
                            WIB</small>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="data-label">Selesai Sewa</span>
                    <div class="text-end">
                        <span
                            class="d-block fw-bold text-dark">{{ \Carbon\Carbon::parse($pemesanan->Tanggal_Selesai)->translatedFormat('d M Y') }}</span>
                        <small
                            class="text-muted">{{ \Carbon\Carbon::parse($pemesanan->Tanggal_Selesai)->format('H:i') }}
                            WIB</small>
                    </div>
                </div>

            </div>

            <div class="dashed-line"></div>

            @php
            $nama = $pemesanan->pelanggan->Nama ?? 'Pelanggan';
            $sepeda = $pemesanan->sepeda->Nama_Sepeda ?? 'Sepeda';
            $paket = $pemesanan->paket->Nama_Paket ?? '-';
            $durasi = $pemesanan->paket->Durasi_Jam ?? '-';
            $mulai = \Carbon\Carbon::parse($pemesanan->Tanggal_Mulai)->translatedFormat('d F Y, H:i');
            $selesai = \Carbon\Carbon::parse($pemesanan->Tanggal_Selesai)->translatedFormat('d F Y, H:i');
            $idPemesanan = $pemesanan->ID_Pemesanan;

            $lines = [
            "Halo *Admin GowesLur*! 👋",
            "",
            "Saya *{$nama}* ingin konfirmasi pemesanan sepeda:",
            "",
            "🧾 *ID Order:* #{$idPemesanan}",
            "🚲 *Sepeda:* {$sepeda}",
            "⏳ *Paket:* {$paket} ({$durasi} Jam)",
            "📅 *Waktu:* {$mulai} s.d {$selesai}",
            "",
            "Mohon diproses ya. Terima kasih!"
            ];

            $pesan = implode("\n", $lines);
            $pesanEncoded = urlencode($pesan);
            $nomorAdmin = "6289504986360"; // Pastikan format 62...
            $urlWA = "https://wa.me/{$nomorAdmin}?text={$pesanEncoded}";
            @endphp

            <div class="mt-4">
                <a href="{{ $urlWA }}" target="_blank" class="btn btn-wa shadow-sm">
                    <i class="fab fa-whatsapp fa-lg me-2"></i> Konfirmasi ke Admin
                </a>

                <div class="text-center mt-3">
                    <a href="{{ url('/') }}" class="text-decoration-none text-muted small">
                        <i class="fas fa-home me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>

            @else
            <div class="text-center py-5">
                <i class="fas fa-exclamation-circle text-danger fa-4x mb-3"></i>
                <h5>Data pemesanan tidak ditemukan.</h5>
                <a href="{{ url('/') }}" class="btn btn-secondary btn-sm mt-3">Kembali</a>
            </div>
            @endif
        </div>

        <div class="bg-light p-3 text-center border-top">
            <small class="text-muted" style="font-size: 0.75rem;">
                &copy; {{ date('Y') }} GowesLur Malang. <br>
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>