@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-uppercase m-0" style="color: #2c3e50;">Edit Sepeda</h4>
                <a href="{{ route('admin.sepeda.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> Batal
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-pencil-square fs-2"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Update Data #{{ $sepeda->ID_Sepeda }}</h5>
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

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="Nama_Sepeda" name="Nama_Sepeda"
                                placeholder="Nama Sepeda" value="{{ old('Nama_Sepeda', $sepeda->Nama_Sepeda) }}"
                                required>
                            <label for="Nama_Sepeda"><i class=""></i> Nama Sepeda</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select rounded-3" id="Kategori_Sepeda" name="Kategori_Sepeda" required>
                                <option value="Sepeda Reguler"
                                    {{ $sepeda->Kategori_Sepeda == 'Sepeda Reguler' ? 'selected' : '' }}>Sepeda Reguler
                                </option>
                                <option value="Sepeda Premium"
                                    {{ $sepeda->Kategori_Sepeda == 'Sepeda Premium' ? 'selected' : '' }}>Sepeda Premium
                                </option>
                            </select>
                            <label for="Kategori_Sepeda"><i class=""></i> Kategori</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select rounded-3" id="Status_Sepeda" name="Status_Sepeda" required>
                                <option value="Tersedia" {{ $sepeda->Status_Sepeda == 'Tersedia' ? 'selected' : '' }}>
                                    Tersedia</option>
                                <option value="Dipinjam" {{ $sepeda->Status_Sepeda == 'Dipinjam' ? 'selected' : '' }}>
                                    Dipinjam</option>
                            </select>
                            <label for="Status_Sepeda"><i class=""></i> Status Saat Ini</label>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded-3 border border-dashed">
                            <label class="form-label fw-semibold small text-muted mb-2 d-block">
                                <i class=""></i> Foto Saat Ini
                            </label>

                            @if($sepeda->Gambar_Sepeda && file_exists(public_path('storage/' . $sepeda->Gambar_Sepeda)))
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage/' . $sepeda->Gambar_Sepeda) }}" alt="Foto Lama"
                                    class="img-thumbnail rounded-3 shadow-sm" style="max-height: 150px;">
                            </div>
                            @else
                            <div class="text-center text-muted fst-italic small mb-3">Belum ada foto.</div>
                            @endif

                            <label for="Gambar_Sepeda" class="form-label fw-semibold small text-primary mb-1">
                                Ganti Foto Baru (Opsional)
                            </label>
                            <input type="file" class="form-control form-control-sm rounded-3" id="Gambar_Sepeda"
                                name="Gambar_Sepeda" accept="image/*">
                        </div>

                        <div class="d-grid">
                            <button type="submit"
                                class="btn btn-warning btn-lg rounded-pill shadow-sm fw-bold text-white">
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