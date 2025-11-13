<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran - GowesLur</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }

        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #dee2e6;
            background-color: #fdfdfd;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
            border-color: #0d6efd;
        }

        /* Summary Box Styling */
        .summary-box {
            background-color: #f8f9fa;
            border: 1px dashed #ced4da;
            border-radius: 10px;
            padding: 20px;
        }

        .price-tag {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0d6efd;
        }

        /* Bank Info Styling */
        .bank-card {
            background: linear-gradient(to right, #ffffff, #f8f9fa);
            border-left: 5px solid #00539f;
            /* BCA Blue */
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .bank-logo {
            max-height: 40px;
        }

        .copy-btn {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }

        /* File Upload Styling */
        .upload-area {
            position: relative;
            border: 2px dashed #ced4da;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: #0d6efd;
            background-color: #f1f7ff;
        }

        .btn-primary-custom {
            background-color: #0d6efd;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            width: 100%;
            transition: transform 0.2s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                {{-- Pesan Sukses --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Pesan Error --}}
                @if ($errors->any())
                <div class="alert alert-danger shadow-sm mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card main-card">
                        <div class="card-header-custom">
                            <h4 class="mb-0 fw-bold"><i class="fas fa-wallet me-2"></i> Konfirmasi Pembayaran</h4>
                            <p class="mb-0 opacity-75 small">Lengkapi data di bawah untuk menyelesaikan pesanan</p>
                        </div>

                        <div class="card-body p-4">

                            <div class="summary-box mb-4">
                                <h6 class="text-uppercase text-muted small fw-bold mb-3">Ringkasan Pesanan</h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $sepeda->Nama_Sepeda }}</h5>
                                        <span
                                            class="badge bg-secondary rounded-pill">{{ $sepeda->Kategori_Sepeda }}</span>
                                    </div>
                                    <div class="text-end">
                                        <small class="d-block text-muted">Durasi</small>
                                        <strong>{{ $paket->Nama_Paket }} ({{ $paket->Durasi_Jam }} Jam)</strong>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-end">
                                    <span class="fw-bold text-muted">Total Tagihan</span>
                                    <span class="price-tag">Rp {{ number_format($paket->Harga, 0, ',', '.') }}</span>
                                </div>

                                <input type="hidden" name="ID_Sepeda" value="{{ $sepeda->ID_Sepeda }}">
                                <input type="hidden" name="ID_Paket" value="{{ $paket->ID_Paket }}">
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i
                                            class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control" id="nama" name="Nama"
                                        value="{{ old('Nama') }}" placeholder="Masukkan nama anda" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">Nomor WhatsApp / Telepon</label>
                                <div class="input-group">
                                    {{-- Label statis +62 --}}
                                    <span class="input-group-text bg-light fw-bold text-primary">+62</span>

                                    {{-- Input User (Angka saja) --}}
                                    <input type="number" class="form-control" id="no_telepon" name="No_Telepon"
                                        value="{{ old('No_Telepon') }}" placeholder="81234567890" required>
                                </div>
                                <div class="form-text text-muted small">
                                    <i class="fas fa-info-circle"></i> Jika Anda mengetik "08...", angka 0 otomatis
                                    dihapus.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="Alamat" rows="3"
                                    placeholder="Alamat lengkap..." required>{{ old('Alamat') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Silakan Transfer ke:</label>
                                <div class="bank-card">
                                    <div class="d-flex align-items-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia_logo.svg/2560px-Bank_Central_Asia_logo.svg.png"
                                            alt="BCA" class="bank-logo me-3">
                                        <div>
                                            <small class="text-muted d-block">Bank BCA</small>
                                            <h5 class="mb-0 fw-bold" id="rekNumber">1234567890</h5>
                                            <small class="text-muted">a.n. GowesLur Malang</small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm copy-btn mt-2 mt-sm-0"
                                        onclick="copyToClipboard()">
                                        <i class="far fa-copy"></i> Salin
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Upload Bukti Transfer</label>
                                <div class="upload-area" onclick="document.getElementById('bukti_pembayaran').click()">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                    <p class="mb-1 fw-bold">Klik untuk upload bukti</p>
                                    <p class="text-muted small mb-0" id="fileName">Format: JPG, PNG, PDF (Max 2MB)</p>
                                    <input type="file" name="Bukti_Pembayaran" id="bukti_pembayaran" class="d-none"
                                        required onchange="updateFileName(this)">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary-custom btn-lg shadow">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Pembayaran
                            </button>

                            <div class="text-center mt-3">
                                <a href="{{ url('/') }}" class="text-decoration-none text-muted small">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                                </a>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // 1. Logic Update Nama File Upload
        function updateFileName(input) {
            var fileName = input.files[0].name;
            document.getElementById('fileName').innerHTML = '<span class="text-success"><i class="fas fa-check"></i> ' +
                fileName + '</span>';
            var area = document.querySelector('.upload-area');
            area.style.borderColor = '#198754';
            area.style.backgroundColor = '#f8fff9';
        }

        // 2. Logic Copy Rekening
        function copyToClipboard() {
            var range = document.createRange();
            range.selectNode(document.getElementById("rekNumber"));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();

            var btn = document.querySelector('.copy-btn');
            var originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Disalin';
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-success');

            setTimeout(function() {
                btn.innerHTML = originalText;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-primary');
            }, 2000);
        }

        // 3. Logic Hapus Angka '0' Otomatis di Telepon
        const phoneInput = document.getElementById('no_telepon');

        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value;

            // Jika karakter pertama adalah '0', hapus
            if (value.startsWith('0')) {
                e.target.value = value.substring(1);
            }
        });

        // (Optional) Pastikan saat form dikirim tetap bersih
        document.querySelector('form').addEventListener('submit', function(e) {
            // Data yang dikirim ke server adalah murni angka (contoh: 8123456789)
            // Di Controller, jangan lupa tambahkan prefix '62' manual:
            // $no_hp = '62' . $request->No_Telepon;
        });
    </script>
</body>

</html>