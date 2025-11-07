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

            @forelse($dataPaket as $kategori => $data)
            <div class="col-md-5">
                <div class="paket-card shadow-lg rounded-4 bg-white position-relative">
                    <div class="paket-header rounded-top-4 text-white py-3">
                        <i class="bi bi-bicycle display-6 text-dark"></i>
                        <h5 class="mt-2 fw-bold text-dark">{{ $kategori }}</h5>
                    </div>
                    <div class="p-4">

                        <div class="mb-3">
                            <label class="fw-semibold mb-2">Pilih Sepeda:</label>
                            <select class="form-select rounded-pill shadow-sm" id="sepeda-{{ Str::slug($kategori) }}">

                                @forelse($data['sepeda'] as $sepeda)
                                <option value="{{ $sepeda->ID_Sepeda }}">{{ $sepeda->Nama_Sepeda }}</option>
                                @empty
                                <option value="" disabled>Sepeda tidak tersedia</option>
                                @endforelse

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold mb-2">Pilih Durasi:</label>
                            <select class="form-select rounded-pill shadow-sm" id="durasi-{{ Str::slug($kategori) }}">

                                @forelse($data['durasi'] as $paket)
                                <option value="{{ $paket->ID_Paket }}">
                                    {{ $paket->Nama_Paket }} (Rp {{ number_format($paket->Harga) }})
                                </option>
                                @empty
                                <option value="" disabled>Paket tidak tersedia</option>
                                @endforelse

                            </select>
                        </div>

                        <button class="btn btn-primary rounded-pill px-4 shadow-sm btn-pesan"
                            data-kategori="{{ Str::slug($kategori) }}">
                            Pesan Sekarang
                        </button>

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