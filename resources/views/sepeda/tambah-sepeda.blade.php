@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 500px; margin:auto;">
        <div class="card-body">
            <h4 class="text-center mb-3">Tambah Data Sepeda</h4>

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
                    <select name="Kategori_Sepeda" class="form-select" required>
                        <option value="Sepeda_Reguler">Sepeda Reguler</option>
                        <option value="Sepeda_Premium">Sepeda Premium</option>
                    </select>
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
                    <input type="file" name="Gambar_Sepeda" class="form-control" accept="image/*" required>
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