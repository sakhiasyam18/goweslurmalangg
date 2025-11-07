<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan</title>

    {{-- CSS sederhana untuk tampilan rapi --}}
    <style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }

    th,
    td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #0d6efd;
        color: #fff;
        text-align: left;
    }

    td {
        color: #333;
    }

    .btn-wa {
        display: inline-block;
        background-color: #25D366;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        margin-top: 30px;
    }

    .btn-wa:hover {
        background-color: #1ebe5d;
    }

    .footer {
        margin-top: 25px;
        text-align: center;
        color: #777;
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>📸 Silakan screenshot halaman ini sebagai bukti saat pengambilan sepeda</h2>

        {{-- Pastikan data pemesanan tersedia --}}
        @if(isset($pemesanan))
        <p style="text-align:center; color:#555;">
            Terima kasih, <strong>{{ $pemesanan->pelanggan->Nama ?? '-' }}</strong>!<br>
            Berikut ringkasan pesanan Anda:
        </p>

        {{-- Tabel ringkasan --}}
        <table>
            <tr>
                <th>ID Pemesanan</th>
                <td>{{ $pemesanan->ID_Pemesanan }}</td>
            </tr>
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $pemesanan->pelanggan->Nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Sepeda</th>
                <td>{{ $pemesanan->sepeda->Nama_Sepeda ?? '-' }}</td>
            </tr>
            <tr>
                <th>Paket</th>
                <td>{{ $pemesanan->paket->Nama_Paket ?? '-' }}</td>
            </tr>
            <tr>
                <th>Durasi</th>
                <td>{{ $pemesanan->paket->Durasi_Jam ?? '-' }} Jam</td>
            </tr>
            <tr>
                <th>Tanggal Mulai</th>
                <td>{{ \Carbon\Carbon::parse($pemesanan->Tanggal_Mulai)->translatedFormat('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <th>Tanggal Selesai</th>
                <td>{{ \Carbon\Carbon::parse($pemesanan->Tanggal_Selesai)->translatedFormat('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <th>Status Sepeda</th>
                <td><strong>{{ $pemesanan->sepeda->Status_Sepeda ?? 'Tidak diketahui' }}</strong></td>
            </tr>
        </table>

        {{-- Buat link WhatsApp otomatis --}}
        @php
        $nama = $pemesanan->pelanggan->Nama ?? 'Pelanggan';
        $sepeda = $pemesanan->sepeda->Nama_Sepeda ?? 'Sepeda';
        $paket = $pemesanan->paket->Nama_Paket ?? '-';
        $durasi = $pemesanan->paket->Durasi_Jam ?? '-';
        $mulai = \Carbon\Carbon::parse($pemesanan->Tanggal_Mulai)->translatedFormat('d F Y, H:i');
        $selesai = \Carbon\Carbon::parse($pemesanan->Tanggal_Selesai)->translatedFormat('d F Y, H:i');
        $idPemesanan = $pemesanan->ID_Pemesanan;

        // Susun pesan per baris (lebih aman daripada heredoc di Blade)
        $lines = [
        "Halo *Admin*!",
        "",
        "Saya *{$nama}* telah melakukan pemesanan sepeda dengan detail berikut:",
        "",
        "*ID Pemesanan:* {$idPemesanan}",
        "*Sepeda:* {$sepeda}",
        "*Paket:* {$paket} ({$durasi} Jam)",
        "*Waktu Sewa:* {$mulai} - {$selesai}",
        "",
        "Mohon konfirmasi ya. Terima kasih!"
        ];

        // Gabungkan dengan newline dan encode untuk URL
        $pesan = implode("\n", $lines);
        $pesanEncoded = urlencode($pesan);

        // Nomor WhatsApp tujuan (ganti sesuai admin)
        $nomorAdmin = "6289504986360";
        $urlWA = "https://wa.me/{$nomorAdmin}?text={$pesanEncoded}";
        @endphp


        {{-- Tombol WhatsApp --}}
        <div style="text-align:center;">
            <a href="{{ $urlWA }}" target="_blank" class="btn-wa">
                📩 Konfirmasi via WhatsApp
            </a>
        </div>
        @else
        <p style="text-align:center; color:red;">Data pemesanan tidak ditemukan.</p>
        @endif

        <div class="footer">
            &copy; {{ date('Y') }} Sistem Penyewaan Sepeda — Semua Hak Dilindungi.
        </div>
    </div>
</body>

</html>