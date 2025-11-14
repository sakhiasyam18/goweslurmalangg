@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-uppercase m-0" style="color: #2c3e50;">Tambah Unit Baru</h4>
                <a href="{{ route('admin.sepeda.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    {{-- Header Icon --}}
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-bicycle fs-2"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Form Data Sepeda</h5>
                    </div>

                    {{-- Alert Error Validasi --}}
                    @if ($errors->any())
                    <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
                        <ul class="mb-0 ps-3 small">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.sepeda.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="ID_Sepeda" name="ID_Sepeda"
                                placeholder="Contoh: SP-001" value="{{ old('ID_Sepeda') }}" required>
                            <label for="ID_Sepeda"><i class=""></i> ID Sepeda</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="Nama_Sepeda" name="Nama_Sepeda"
                                placeholder="Nama Sepeda" value="{{ old('Nama_Sepeda') }}" required>
                            <label for="Nama_Sepeda"><i class=""></i> Nama Sepeda</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select rounded-3" id="Kategori_Sepeda" name="Kategori_Sepeda" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="Sepeda Reguler"
                                    {{ old('Kategori_Sepeda') == 'Sepeda Reguler' ? 'selected' : '' }}>Sepeda Reguler
                                </option>
                                <option value="Sepeda Premium"
                                    {{ old('Kategori_Sepeda') == 'Sepeda Premium' ? 'selected' : '' }}>Sepeda Premium
                                </option>
                            </select>
                            <label for="Kategori_Sepeda"><i class=""></i> Kategori</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select rounded-3" id="Status_Sepeda" name="Status_Sepeda" required>
                                <option value="Tersedia" {{ old('Status_Sepeda') == 'Tersedia' ? 'selected' : '' }}>
                                    Tersedia</option>
                                <option value="Dipinjam" {{ old('Status_Sepeda') == 'Dipinjam' ? 'selected' : '' }}>
                                    Dipinjam</option>
                            </select>
                            <label for="Status_Sepeda"><i class=""></i> Status Awal</label>
                        </div>

                        <div class="mb-4">
                            <label for="Gambar_Sepeda" class="form-label fw-semibold small text-muted mb-2">
                                <i class=""></i> Foto Sepeda
                            </label>
                            <input type="file" class="form-control form-control-lg rounded-3" id="Gambar_Sepeda"
                                name="Gambar_Sepeda" accept="image/*" required>
                            <div class="form-text small text-muted">Format: JPG, PNG (Max 2MB).</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm fw-bold">
                                <i class="bi bi-save me-2"></i> SIMPAN DATA
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection