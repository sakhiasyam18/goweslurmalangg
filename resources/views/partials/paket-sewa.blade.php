<section id="sewa" class="paket-section py-5 text-center">
    <div class="container">
        <div class="judul-wrapper">
            <div class="judul-box">Temukan Paket Sepeda Favoritmu!</div>
            <div class="dots">•••</div>
            <div class="line"></div>
        </div>

        <p>
            Tentukan Pilihanmu: Sepeda Reguler atau Premium.<br>
            Nikmati kebebasan bersepeda dengan paket terbaik!<br>
            Siap gowes? Pilih paketmu sekarang!
        </p>

        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif

        <div class="row justify-content-center g-4">

            {{-- Loop untuk setiap kategori (Premium, Reguler) dari PelangganController --}}
            @forelse($dataPaket as $kategori => $data)
            @php
            // Buat ID slug yang aman untuk HTML (misal: "sepeda-premium")
            $kategoriSlug = Str::slug($kategori);
            @endphp
            <div class="col-md-5">
                <div class="paket-card shadow-lg rounded-4 bg-white position-relative">
                    <div class="paket-header rounded-top-4 text-white py-3">
                        <i class="bi bi-bicycle display-6 text-dark"></i>
                        <h5 class="mt-2 fw-bold text-dark">{{ $kategori }}</h5>
                    </div>
                    <div class="p-4">

                        <div class="mb-3 text-start">
                            <label class="fw-semibold mb-2">Pilih Sepeda:</label>
                            <select class="form-select rounded-pill shadow-sm" id="sepeda-{{ $kategoriSlug }}">
                                @if(isset($data['sepeda']) && count($data['sepeda']) > 0)
                                @foreach ($data['sepeda'] as $s)
                                {{--
                                          LOGIKA BARU:
                                          - Tambahkan 'disabled' jika status BUKAN 'Tersedia'
                                          - Tampilkan status (Dipinjam) jika tidak tersedia
                                        --}}
                                <option value="{{ $s->ID_Sepeda }}"
                                    {{ $s->Status_Sepeda != 'Tersedia' ? 'disabled' : '' }}>

                                    {{ $s->Nama_Sepeda }}

                                    {{ $s->Status_Sepeda != 'Tersedia' ? '(Dipinjam)' : '' }}
                                </option>
                                @endforeach
                                @else
                                <option value="" disabled>Sepeda {{ $kategori }} Habis</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="fw-semibold mb-2">Pilih Durasi:</label>
                            {{-- Tambahkan class 'durasi-select' untuk listener JS --}}
                            <select class="form-select rounded-pill shadow-sm durasi-select"
                                id="durasi-{{ $kategoriSlug }}" data-kategori-slug="{{ $kategoriSlug }}">
                                @if(isset($data['durasi']) && count($data['durasi']) > 0)
                                @foreach ($data['durasi'] as $p)
                                {{--
                                          LOGIKA BARU:
                                          - Tambahkan 'data-harga' untuk dibaca JavaScript
                                          - Ganti teks paket sesuai permintaan
                                        --}}
                                <option value="{{ $p->ID_Paket }}" data-harga="{{ $p->Harga }}">

                                    {{-- --- PERUBAHAN TEXT DIMULAI DI SINI --- --}}
                                    {{ $p->Nama_Paket }}
                                    @if($p->Durasi_Jam == 24)
                                    (24 jam / 1 hari)
                                    @elseif($p->Durasi_Jam == 168)
                                    (168 jam / 7 hari (seminggu))
                                    @elseif($p->Durasi_Jam == 720)
                                    (720 jam / 30 hari (sebulan))
                                    @else
                                    ({{ $p->Durasi_Jam }} jam) {{-- Fallback --}}
                                    @endif
                                    {{-- --- AKHIR PERUBAHAN TEXT --- --}}

                                </option>
                                @endforeach
                                @else
                                <option value="" data-harga="0" disabled>Paket tidak tersedia</option>
                                @endif
                            </select>
                        </div>

                        <button class="btn btn-primary rounded-pill px-4 shadow-sm w-100 btn-pesan"
                            data-kategori="{{ $kategoriSlug }}">
                            Pesan Sekarang
                        </button>

                        <div class="mt-3">
                            <span class="text-muted">Harga:</span>
                            <span class="fw-bold fs-4 text-danger" id="harga-display-{{ $kategoriSlug }}">
                                Rp 0
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted">Gagal memuat paket sepeda saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<script>
/**
 * Helper function untuk format Rupiah.
 */
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

/**
 * Helper function untuk meng-update harga dinamis.
 */
function updatePrice(kategoriSlug) {
    const paketDropdown = document.getElementById(`durasi-${kategoriSlug}`);
    const hargaDisplay = document.getElementById(`harga-display-${kategoriSlug}`);

    if (!paketDropdown || !hargaDisplay) return;

    // Ambil <option> yang sedang dipilih
    const selectedOption = paketDropdown.options[paketDropdown.selectedIndex];

    if (selectedOption) {
        // Ambil harga dari atribut 'data-harga'
        const harga = selectedOption.getAttribute('data-harga');
        // Tampilkan harga yang sudah diformat
        hargaDisplay.textContent = formatRupiah(harga);
    } else {
        // Jika tidak ada paket (error)
        hargaDisplay.textContent = formatRupiah(0);
    }
}

// --- EVENT LISTENERS ---

// Fungsi ini akan dijalankan saat dokumen (welcome.blade.php) selesai dimuat
function initializePaketListeners() {

    // 1. Tambahkan listener 'change' ke SEMUA dropdown durasi
    document.querySelectorAll('.durasi-select').forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            const kategoriSlug = this.getAttribute('data-kategori-slug');
            updatePrice(kategoriSlug);
        });
    });

    // 2. Saat halaman baru dimuat, langsung update harga sekali untuk semua kartu
    document.querySelectorAll('.durasi-select').forEach(dropdown => {
        const kategoriSlug = dropdown.getAttribute('data-kategori-slug');
        updatePrice(kategoriSlug);
    });

    // 3. Modifikasi listener 'click' pada tombol "Pesan Sekarang"
    document.querySelectorAll('.btn-pesan').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil kategori dari data-attribute tombol
            const kategoriSlug = this.getAttribute('data-kategori');

            // Ambil dropdown berdasarkan kategori
            const sepedaDropdown = document.getElementById(`sepeda-${kategoriSlug}`);
            const durasiDropdown = document.getElementById(`durasi-${kategoriSlug}`);

            if (!sepedaDropdown || !durasiDropdown) {
                alert('Terjadi kesalahan, gagal menemukan dropdown.');
                return;
            }

            // --- Cek Status Sepeda (Shopee style) ---
            const selectedSepedaOption = sepedaDropdown.options[sepedaDropdown.selectedIndex];
            if (!selectedSepedaOption) {
                alert('Gagal membaca pilihan sepeda.');
                return;
            }

            // Jika option yang dipilih 'disabled' (karena dipinjam)
            if (selectedSepedaOption.disabled) {
                alert('Sepeda yang Anda pilih sedang dipinjam. Silakan pilih yang lain.');
                return; // Hentikan eksekusi
            }

            // (Sisa logic-nya sama, tapi kirim ID)
            const idSepeda = sepedaDropdown.value;
            const idPaket = durasiDropdown.value; // 'durasi' dropdown sekarang berisi ID_Paket

            if (!idSepeda || !idPaket || durasiDropdown.options[durasiDropdown.selectedIndex]
                .disabled) {
                alert('Pilihan sepeda atau paket tidak valid.');
                return;
            }

            // Buat URL dengan ID_Sepeda dan ID_Paket
            const url = "{{ route('pembayaran.create') }}" +
                "?id_sepeda=" + encodeURIComponent(idSepeda) +
                "&id_paket=" + encodeURIComponent(idPaket);

            window.location.href = url;
        });
    });
}

// Kita gunakan DOMContentLoaded yang akan di-trigger oleh 'welcome.blade.php'
document.addEventListener('DOMContentLoaded', initializePaketListeners);
</script>