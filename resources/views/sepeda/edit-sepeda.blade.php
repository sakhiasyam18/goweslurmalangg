@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-lg mx-auto" style="max-width: 550px; border-radius: 20px; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px);">
        <div class="card-body p-4">
            <h4 class="text-center fw-semibold mb-4 text-primary">
                <i class="bi bi-pencil-square me-2"></i>Edit Data Sepeda
            </h4>

            <form action="{{ route('admin.sepeda.update', $sepeda->ID_Sepeda) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-floating mb-3">
                    <input type="text" name="Nama_Sepeda" id="Nama_Sepeda" class="form-control rounded-3" placeholder="Nama Sepeda" value="{{ $sepeda->Nama_Sepeda }}" required>
                    <label for="Nama_Sepeda"><i class="bi bi-tag me-1"></i>Nama Sepeda</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="Kategori_Sepeda" id="Kategori_Sepeda" class="form-select rounded-3" required>
                        <option value="Sepeda Reguler" {{ $sepeda->Kategori_Sepeda == 'Sepeda Reguler' ? 'selected' : '' }}>Sepeda Reguler</option>
                        <option value="Sepeda Premium" {{ $sepeda->Kategori_Sepeda == 'Sepeda Premium' ? 'selected' : '' }}>Sepeda Premium</option>
                    </select>
                    <label for="Kategori_Sepeda"><i class="bi bi-list-ul me-1"></i>Kategori Sepeda</label>
                </div>

                <div class="form-floating mb-4">
                    <select name="Status_Sepeda" id="Status_Sepeda" class="form-select rounded-3" required>
                        <option value="Tersedia" {{ $sepeda->Status_Sepeda == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Dipinjam" {{ $sepeda->Status_Sepeda == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    </select>
                    <label for="Status_Sepeda"><i class="bi bi-info-circle me-1"></i>Status Sepeda</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gradient btn-lg fw-semibold text-white shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-gradient {
        background: linear-gradient(90deg, #16a34a, #22c55e);
        border: none;
        transition: 0.3s ease;
    }
    .btn-gradient:hover {
        background: linear-gradient(90deg, #15803d, #16a34a);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
    }
    .form-control, .form-select {
        border: 1px solid #dee2e6;
    }
    label i {
        color: #22c55e;
    }
</style>
@endsection
