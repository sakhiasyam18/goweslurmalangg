@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 500px; margin:auto;">
        <div class="card-body">
            <h4 class="text-center mb-3">Tambah Data Sepeda</h4>

            <form action="{{ route('sepeda.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="ID_Sepeda" class="form-label">ID Sepeda</label>
                    <input type="text" name="ID_Sepeda" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Nama_Sepeda" class="form-label">Nama Sepeda</label>
                    <input type="text" name="Nama_Sepeda" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Kategori_Sepeda" class="form-label">Kategori Sepeda</label>
                    <input type="text" name="Kategori_Sepeda" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Status_Sepeda" class="form-label">Status Sepeda</label>
                    <select name="Status_Sepeda" class="form-select" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipinjam">Dipinjam</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Gambar_Sepeda" class="form-label">Gambar Sepeda</label>
                    <input type="text" name="Gambar_Sepeda" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" 
                        style="background: linear-gradient(90deg,#667eea,#764ba2); border:none;">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
