@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-lg mx-auto" style="max-width: 550px; border-radius: 20px; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px);">
        <div class="card-body p-4">
            <h4 class="text-center fw-semibold mb-4 text-primary">
                <i class="bi bi-bicycle me-2"></i>Tambah Data Sepeda
            </h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.sepeda.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" name="ID_Sepeda" id="ID_Sepeda" class="form-control rounded-3" placeholder="ID Sepeda" required>
                    <label for="ID_Sepeda"><i class="bi bi-upc-scan me-1"></i>ID Sepeda</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="Nama_Sepeda" id="Nama_Sepeda" class="form-control rounded-3" placeholder="Nama Sepeda" required>
                    <label for="Nama_Sepeda"><i class="bi bi-tag me-1"></i>Nama Sepeda</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="Kategori_Sepeda" id="Kategori_Sepeda" class="form-select rounded-3" required>
                        <option value="" disabled selected>Pilih kategori...</option>
                        <option value="Sepeda Reguler">Sepeda Reguler</option>
                        <option value="Sepeda Premium">Sepeda Premium</option>
                    </select>
                    <label for="Kategori_Sepeda"><i class="bi bi-list-ul me-1"></i>Kategori Sepeda</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="Status_Sepeda" id="Status_Sepeda" class="form-select rounded-3" required>
                        <option value="" disabled selected>Pilih status...</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipinjam">Dipinjam</option>
                    </select>
                    <label for="Status_Sepeda"><i class="bi bi-info-circle me-1"></i>Status Sepeda</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="file" name="Gambar_Sepeda" id="Gambar_Sepeda" class="form-control rounded-3" accept="image/*" required>
                    <label for="Gambar_Sepeda"><i class="bi bi-image me-1"></i>Gambar Sepeda</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gradient btn-lg fw-semibold text-white shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Sepeda
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-gradient {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        border: none;
        transition: 0.3s ease;
    }
    .btn-gradient:hover {
        background: linear-gradient(90deg, #1d4ed8, #4338ca);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
    .form-control, .form-select {
        border: 1px solid #dee2e6;
    }
    label i {
        color: #2563eb;
    }
</style>
@endsection
