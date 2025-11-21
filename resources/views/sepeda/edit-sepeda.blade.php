@extends('layouts.app')

@section('content')

{{-- Style Internal untuk Form --}}
<style>
.form-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid #f0f0f0;
}

.form-header-icon {
    width: 60px;
    height: 60px;
    background-color: #fff3cd;
    /* Warna kuning */
    color: #ffc107;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.form-header-icon .fs-2 {
    line-height: 0;
    /* Fix alignment icon */
}

.form-control:focus,
.form-select:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.2);
}
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="d-flex justify-content-start mb-3">
                <a href="{{ route('admin.sepeda.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
            </div>

            <div class="card form-card border-0">
                <div class="card-body p-4 p-md-5">

                    <!-- Header Form -->
                    <div class="text-center mb-4">
                        <div class="form-header-icon">
                            <i class="bi bi-pencil-square fs-2"></i>
                        </div>
                        <h4 class="fw-bold mt-3 mb-1">Update Data Sepeda</h4>
                        <p class="text-muted small">ID Unit: #{{ $sepeda->ID_Sepeda }}</p>
                    </div>

                    {{-- Alert Error --}}
                    @if ($errors->any())
                    <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
                        <ul class="mb-0 ps-3 small">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.sepeda.update', $sepeda->ID_Sepeda) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- 1. Nama Sepeda -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="Nama_Sepeda" name="Nama_Sepeda"
                                placeholder="Nama Sepeda" value="{{ old('Nama_Sepeda', $sepeda->Nama_Sepeda) }}"
                                required>
                            {{-- PERBAIKAN: Menambahkan ikon --}}
                            <label for="Nama_Sepeda"><i class=""></i> Nama Sepeda</label>
                        </div>

                        <!-- 2. Kategori -->
                        <div class="form-floating mb-3">
                            <select class="form-select rounded-3" id="Kategori_Sepeda" name="Kategori_Sepeda" required>
                                <option value="Sepeda Reguler"
                                    {{ $sepeda->Kategori_Sepeda == 'Sepeda Reguler' ? 'selected' : '' }}>Sepeda Reguler
                                </option>
                                <option value="Sepeda Premium"
                                    {{ $sepeda->Kategori_Sepeda == 'Sepeda Premium' ? 'selected' : '' }}>Sepeda Premium
                                </option>
                            </select>
                            {{-- PERBAIKAN: Menambahkan ikon --}}
                            <label for="Kategori_Sepeda"><i class=""></i> Kategori</label>
                        </div>

                        <!-- 3. Status -->
                        <div class="form-floating mb-3">
                            <select class="form-select rounded-3" id="Status_Sepeda" name="Status_Sepeda" required>
                                <option value="Tersedia" {{ $sepeda->Status_Sepeda == 'Tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>
                                <option value="Dipinjam" {{ $sepeda->Status_Sepeda == 'Dipinjam' ? 'selected' : '' }}>
                                    Dipinjam
                                </option>
                            </select>
                            {{-- PERBAIKAN: Menambahkan ikon --}}
                            <label for="Status_Sepeda"><i class=""></i> Status Saat Ini</label>
                        </div>

                        <!-- 4. Preview & Upload Gambar -->
                        <div class="mb-4 p-3 bg-light rounded-3 border">
                            <label class="form-label fw-semibold small text-muted mb-2 d-block">
                                <i class=""></i> Foto Saat Ini
                            </label>

                            {{-- PERBAIKAN: Logic 'if/else' disederhanakan agar tidak error --}}
                            {{-- UBAH pengecekan path dan asset helper --}}
                            @if($sepeda->Gambar_Sepeda && file_exists(public_path('uploads/' . $sepeda->Gambar_Sepeda)))
                            <div class="mb-3 text-center">
                                <img src="{{ asset('uploads/' . $sepeda->Gambar_Sepeda) }}" alt="Foto Lama"
                                    class="img-thumbnail rounded-3 shadow-sm"
                                    style="max-height: 150px; object-fit: cover;">
                            </div>
                            @else
                            <div class="text-center text-muted fst-italic small mb-3">
                                <i class="bi bi-camera-video-off fs-4 d-block mb-1"></i>
                                Belum ada foto.
                            </div>
                            @endif
                            {{-- AKHIR PERBAIKAN LOGIC --}}

                            <label for="Gambar_Sepeda" class="form-label fw-semibold small text-primary mb-1">
                                Ganti Foto Baru (Opsional)
                            </label>
                            <input type="file" class="form-control form-control-sm rounded-3" id="Gambar_Sepeda"
                                name="Gambar_Sepeda" accept="image/*">
                            {{-- UBAH DESKRIPSI PATH --}}
                            <div class="form-text small text-muted">Otomatis masuk ke folder
                                <b>public/uploads/sepeda</b></div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid">
                            <button type="submit"
                                class="btn btn-warning btn-lg rounded-pill shadow-sm fw-bold text-dark">
                                <i class="bi bi-check-circle me-2"></i> PERBARUI DATA
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection