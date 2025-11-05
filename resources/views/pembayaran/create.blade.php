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
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="Nama" value="{{ old('Nama') }}" required>
            </div>

            <div class="form-group">
                <label for="no_telepon">Nomor Telepon:</label> <input type="text" class="form-control" id="no_telepon"
                    name="No_Telepon" value="{{ old('No_Telepon') }}" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="Alamat" rows="3"
                    required>{{ old('Alamat') }}</textarea>
            </div>

            <div class="form-group">
                <label>Rekening Pembayaran:</label>
                <div class="rekening-info">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia_logo.svg/2560px-Bank_Central_Asia_logo.svg.png"
                        alt="Logo BCA">
                    <h5>BCA: 1234567890</h5>
                    <p>a.n. GowesLur Malang</p>
                </div>
            </div>

            <div class="form-group">
                <label for="bukti_pembayaran">Upload Bukti:</label>
                <input type="file" class="form-control-file" id="bukti_pembayaran" name="Bukti_Pembayaran" required>
                <small class="form-text text-muted">Upload bukti transfer Anda (JPG, PNG, maks 2MB).</small>
            </div>

            <div class="form-group">
                <label>Ringkasan Pesanan Anda:</label>
                <div class="card">
                    <div class="card-body">
                        <p><strong>Nama Jenis Sepeda:</strong> (Akan diisi nanti)</p>
                        <p><strong>Durasi Sewa:</strong> (Akan diisi nanti)</p>
                        <p><strong>Total Biaya:</strong> (Akan diisi nanti)</p>
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