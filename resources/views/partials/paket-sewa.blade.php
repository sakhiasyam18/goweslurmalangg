<style>
/* --- CSS SECTION PAKET --- */
.paket-section {
    background-color: #f8f9fa;
    /* Abu-abu lembut agar kontras dengan kartu putih */
    padding: 80px 0;
    font-family: 'Poppins', sans-serif;
    position: relative;
}

/* Judul Estetik */
.judul-wrapper {
    margin-bottom: 50px;
}

.judul-title {
    font-weight: 800;
    color: #2c3e50;
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.judul-title span {
    color: #0d6efd;
}

.judul-desc {
    color: #6c757d;
    max-width: 600px;
    margin: 0 auto;
    font-size: 1.05rem;
    line-height: 1.6;
}

/* --- PRICING CARD STYLE --- */
.paket-card {
    background: #ffffff;
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s ease;
    height: 100%;
    /* Agar tinggi kartu sama rata */
    overflow: hidden;
    border: 1px solid #f0f0f0;
    display: flex;
    flex-direction: column;
}

.paket-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(13, 110, 253, 0.15);
    border-color: #aecdf7;
}

/* Header Kartu */
.paket-header {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    padding: 30px 20px;
    text-align: center;
    color: white;
    position: relative;
}

.paket-icon-circle {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    backdrop-filter: blur(5px);
}

.paket-header i {
    font-size: 2rem;
    color: #fff;
}

.paket-name {
    font-weight: 700;
    font-size: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0;
}

/* Body Kartu */
.paket-body {
    padding: 30px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Form Styling */
.form-label-custom {
    font-size: 0.85rem;
    font-weight: 600;
    color: #adb5bd;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: block;
}

.form-select-custom {
    border: 2px solid #eef2f6;
    border-radius: 12px;
    padding: 12px 15px;
    font-size: 0.95rem;
    color: #495057;
    background-color: #fdfdfd;
    cursor: pointer;
    transition: border-color 0.3s;
    width: 100%;
}

.form-select-custom:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    outline: none;
}

/* Price Tag Display */
.price-display-box {
    background-color: #f8f9fa;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    margin-top: 25px;
    border: 1px dashed #dee2e6;
}

.price-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 5px;
    display: block;
}

.price-value {
    font-size: 1.8rem;
    font-weight: 800;
    color: #0d6efd;
    letter-spacing: -1px;
}

/* Tombol */
.btn-pesan-custom {
    background-color: #0d6efd;
    color: white;
    border: none;
    border-radius: 50px;
    padding: 14px;
    width: 100%;
    font-weight: 600;
    font-size: 1rem;
    margin-top: 20px;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
}

.btn-pesan-custom:hover {
    background-color: #0b5ed7;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4);
    color: white;
}
</style>

<section id="sewa" class="paket-section">
    <div class="container">

        <div class="text-center judul-wrapper animate__animated animate__fadeInDown">
            <h2 class="judul-title">Pilih <span>Paket Sewa</span></h2>
            <div class="d-flex justify-content-center mb-3">
                <div style="width: 60px; height: 4px; background: #0d6efd; border-radius: 2px;"></div>
            </div>
            {{-- LOGIC MENGHITUNG STOK REAL-TIME --}}
            @php
            $totalTersedia = 0;
            $totalDipinjam = 0;

            // Loop data untuk menghitung total dari semua kategori
            if(isset($dataPaket)) {
            foreach($dataPaket as $kategori => $data) {
            if(isset($data['sepeda'])) {
            foreach($data['sepeda'] as $s) {
            if(strtolower($s->Status_Sepeda) == 'tersedia') {
            $totalTersedia++;
            } else {
            $totalDipinjam++;
            }
            }
            }
            }
            }
            @endphp

            <p class="judul-desc">
                Tentukan pilihanmu: <strong>Sepeda Reguler</strong> atau <strong>Premium</strong>. <br>

                {{-- TAMPILAN STATUS REAL-TIME --}}
                <span class="d-inline-block mt-2 py-2 px-4 rounded-pill bg-white border shadow-sm text-muted"
                    style="font-size: 0.95rem;">
                    Update Stok Saat Ini:
                    <span class="text-success fw-bold mx-2">
                        <i class="fas fa-check-circle me-1"></i> {{ $totalTersedia }} Unit Tersedia
                    </span>
                    <span class="text-secondary opacity-50 mx-1">|</span>
                    <span class="text-danger fw-bold mx-2">
                        <i class="fas fa-times-circle me-1"></i> {{ $totalDipinjam }} Sedang Dipinjam
                    </span>
                </span>
            </p>
        </div>

        @if(session('error'))
        <div class="alert alert-danger text-center shadow-sm border-0 rounded-3 mb-5 w-75 mx-auto" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        </div>
        @endif

        <div class="row justify-content-center g-4">

            {{--
                LOOP PHP (LOGIC UTAMA)
                - Struktur loop tidak diubah agar kompatibel dengan backend.
            --}}
            @forelse($dataPaket as $kategori => $data)
            @php
            $kategoriSlug = Str::slug($kategori);
            @endphp

            <div class="col-md-6 col-lg-5 animate__animated animate__fadeInUp">
                <div class="paket-card">

                    <div class="paket-header">
                        <div class="paket-icon-circle">
                            <i class="bi bi-bicycle"></i>
                        </div>
                        <h3 class="paket-name">{{ $kategori }}</h3>
                    </div>

                    <div class="paket-body">

                        <div class="mb-4">
                            <label class="form-label-custom" for="sepeda-{{ $kategoriSlug }}">
                                <i class="bi bi-geo-alt-fill me-1"></i> Pilih Unit Sepeda
                            </label>
                            <select class="form-select-custom" id="sepeda-{{ $kategoriSlug }}">
                                @if(isset($data['sepeda']) && count($data['sepeda']) > 0)
                                <option value="" selected disabled>-- Pilih Sepeda Tersedia --</option>
                                @foreach ($data['sepeda'] as $s)
                                <option value="{{ $s->ID_Sepeda }}"
                                    {{ $s->Status_Sepeda != 'Tersedia' ? 'disabled' : '' }}>

                                    {{-- FORMAT LAMA: Nama Sepeda (Dipinjam) --}}
                                    {{ $s->Nama_Sepeda }}
                                    {{ $s->Status_Sepeda != 'Tersedia' ? '(Dipinjam)' : '' }}

                                </option>
                                @endforeach
                                @else
                                <option value="" disabled>Sepeda Habis</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label-custom" for="durasi-{{ $kategoriSlug }}">
                                <i class="bi bi-clock-fill me-1"></i> Pilih Durasi Sewa
                            </label>
                            {{-- Class 'durasi-select' WAJIB ADA untuk JS --}}
                            <select class="form-select-custom durasi-select" id="durasi-{{ $kategoriSlug }}"
                                data-kategori-slug="{{ $kategoriSlug }}">

                                <option value="" selected disabled data-harga="0">-- Pilih Durasi --</option>

                                @if(isset($data['durasi']) && count($data['durasi']) > 0)
                                @foreach ($data['durasi'] as $p)
                                <option value="{{ $p->ID_Paket }}" data-harga="{{ $p->Harga }}">
                                    {{ $p->Nama_Paket }}
                                    ({{ $p->Durasi_Jam }} Jam)
                                </option>
                                @endforeach
                                @else
                                <option value="" data-harga="0" disabled>Paket tidak tersedia</option>
                                @endif
                            </select>
                        </div>

                        <div class="price-display-box">
                            <span class="price-label">Jumlah Pembayaran</span>
                            {{-- ID 'harga-display' WAJIB ADA untuk JS --}}
                            <div class="price-value" id="harga-display-{{ $kategoriSlug }}">
                                Rp 0
                            </div>
                        </div>

                        {{-- Class 'btn-pesan' dan 'data-kategori' WAJIB ADA untuk JS --}}
                        <button class="btn-pesan-custom btn-pesan" data-kategori="{{ $kategoriSlug }}">
                            Pesan Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </button>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded shadow-sm d-inline-block">
                    <p class="text-muted mb-0">Mohon maaf, paket sepeda belum tersedia saat ini.</p>
                </div>
            </div>
            @endforelse

        </div>
    </div>
</section>

{{--
    SCRIPT JAVASCRIPT (ORIGINAL SESUAI REQUEST)
    Tidak ada logika yang diubah, hanya ditaruh di sini agar tetap berfungsi.
--}}
<script>
function formatRupiah(angka) {
    if (!angka || isNaN(angka)) {
        angka = 0;
    }
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(angka);
}

function updatePrice(kategoriSlug) {
    const paketDropdown = document.getElementById(`durasi-${kategoriSlug}`);
    const hargaDisplay = document.getElementById(`harga-display-${kategoriSlug}`);
    if (!paketDropdown || !hargaDisplay) return;

    const selectedOption = paketDropdown.options[paketDropdown.selectedIndex];
    if (selectedOption) {
        const harga = selectedOption.getAttribute('data-harga');
        hargaDisplay.textContent = formatRupiah(harga);
    } else {
        hargaDisplay.textContent = formatRupiah(0);
    }
}

function initializePaketListeners() {
    document.querySelectorAll('.durasi-select').forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            const kategoriSlug = this.getAttribute('data-kategori-slug');
            updatePrice(kategoriSlug);
        });
    });

    document.querySelectorAll('.durasi-select').forEach(dropdown => {
        const kategoriSlug = dropdown.getAttribute('data-kategori-slug');
        updatePrice(kategoriSlug);
    });

    document.querySelectorAll('.btn-pesan').forEach(button => {
        button.addEventListener('click', function() {
            const kategoriSlug = this.getAttribute('data-kategori');
            const sepedaDropdown = document.getElementById(`sepeda-${kategoriSlug}`);
            const durasiDropdown = document.getElementById(`durasi-${kategoriSlug}`);

            if (!sepedaDropdown || !durasiDropdown) {
                alert('Terjadi kesalahan, gagal menemukan dropdown.');
                return;
            }

            const selectedSepedaOption = sepedaDropdown.options[sepedaDropdown.selectedIndex];
            if (!selectedSepedaOption) {
                alert('Gagal membaca pilihan sepeda.');
                return;
            }

            if (selectedSepedaOption.disabled) {
                alert('Sepeda yang Anda pilih sedang dipinjam. Silakan pilih yang lain.');
                return;
            }

            const idSepeda = sepedaDropdown.value;
            const idPaket = durasiDropdown.value;

            if (!idSepeda || !idPaket || durasiDropdown.options[durasiDropdown.selectedIndex]
                .disabled) {
                alert('Pilihan sepeda atau paket tidak valid.');
                return;
            }

            const url = "{{ route('pembayaran.create') }}" +
                "?id_sepeda=" + encodeURIComponent(idSepeda) +
                "&id_paket=" + encodeURIComponent(idPaket);

            window.location.href = url;
        });
    });
}

document.addEventListener('DOMContentLoaded', initializePaketListeners);
</script>