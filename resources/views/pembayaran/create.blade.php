<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        .container {
            max-width: 500px;
        }

        /* Style untuk info rekening (dari gambar.png) */
        .rekening-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
        }

        .rekening-info img {
            max-width: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Form Pembayaran</h3> {{-- Pesan Sukses --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Pesan Error Validasi --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Ringkasan Pesanan Anda:</label>
                <div class="card">
                    <div class="card-body">
                        <!-- Tampilkan data dari controller -->
                        <p><strong>Nama Jenis Sepeda:</strong> {{ $sepeda->Nama_Sepeda }}
                            ({{ $sepeda->Kategori_Sepeda }})</p>
                        <p><strong>Durasi Sewa:</strong> {{ $paket->Nama_Paket }} ({{ $paket->Durasi_Jam }} Jam)</p>
                        <p><strong>Total Biaya:</strong> Rp {{ number_format($paket->Harga) }}</p>

                        <!-- INI PENTING: Hidden fields untuk dikirim ke Controller@store -->
                        <input type="hidden" name="ID_Sepeda" value="{{ $sepeda->ID_Sepeda }}">
                        <input type="hidden" name="ID_Paket" value="{{ $paket->ID_Paket }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>