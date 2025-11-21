@extends('layouts.app')

@section('content')

<style>
    /* --- CSS Khusus Data Sepeda --- */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-title {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.5rem;
        position: relative;
        padding-left: 15px;
    }

    .page-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 25px;
        width: 5px;
        background: #0d6efd;
        border-radius: 5px;
    }

    /* Card Table */
    .table-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        overflow: hidden;
    }

    /* Header Tabel */
    .table-custom thead th {
        background-color: #f8f9fa;
        color: #6c757d;
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 15px;
        border-bottom: 2px solid #eef2f6;
        white-space: nowrap;
    }

    /* Body Tabel */
    .table-custom tbody td {
        padding: 15px;
        vertical-align: middle;
        font-size: 0.95rem;
        color: #333;
        border-bottom: 1px solid #f9f9f9;
    }

    .table-custom tbody tr:hover {
        background-color: #fdfdfd;
    }

    /* Thumbnail Sepeda */
    .bike-thumb {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .bike-thumb:hover {
        transform: scale(1.5);
        z-index: 10;
    }

    /* Badges Status */
    .status-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .bg-soft-success {
        background: #d1e7dd;
        color: #0f5132;
    }

    .bg-soft-danger {
        background: #f8d7da;
        color: #842029;
    }

    /* Tombol Aksi */
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: none;
    }

    .btn-edit {
        background: #fff3cd;
        color: #ffc107;
    }

    .btn-edit:hover {
        background: #ffc107;
        color: #fff;
    }

    .btn-delete {
        background: #f8d7da;
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: #fff;
    }

    /* Tombol Tambah Modern */
    .btn-add-custom {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        transition: all 0.3s;
    }

    .btn-add-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4);
        color: white;
    }

    /* CSS Modal Khusus Halaman Ini */
    .modal-overlay {
        display: none;
        /* Hidden default */
        position: fixed;
        z-index: 9999;
        /* Paling depan */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        /* Gelap Pekat */
        backdrop-filter: blur(5px);
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s;
    }

    .modal-content-img {
        max-width: 90%;
        max-height: 90vh;
        border-radius: 10px;
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.1);
        animation: zoomIn 0.3s;
        object-fit: contain;
    }

    .close-btn {
        position: absolute;
        top: 20px;
        right: 40px;
        color: #fff;
        font-size: 40px;
        font-weight: 300;
        cursor: pointer;
        transition: 0.2s;
    }

    .close-btn:hover {
        color: #dc3545;
        transform: rotate(90deg);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.8);
        }

        to {
            transform: scale(1);
        }
    }
</style>

<div class="container-fluid px-0">

    <div class="page-header animate__animated animate__fadeInDown">
        <h4 class="page-title">Data Unit Sepeda</h4>

        <a href="{{ route('admin.sepeda.create') }}" class="btn btn-add-custom">
            <i class="bi bi-plus-lg me-2"></i> Tambah Unit
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 animate__animated animate__fadeIn">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="table-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">ID</th>
                        <th width="10%">Gambar</th>
                        <th>Nama Sepeda</th>
                        <th>Kategori</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sepeda as $item)
                    <tr>
                        <td class="text-center fw-bold text-primary">
                            {{ $item->ID_Sepeda }}
                        </td>

                        <td class="text-center">
                            {{-- UBAH pengecekan path dan asset helper --}}
                            @if($item->Gambar_Sepeda && file_exists(public_path('uploads/' . $item->Gambar_Sepeda)))
                            <img src="{{ asset('uploads/' . $item->Gambar_Sepeda) }}" alt="Foto" class="bike-thumb"
                                onclick="showFullImage(this.src)" style="cursor: zoom-in;" title="Klik untuk perbesar">
                            @else
                            <div
                                class="bike-thumb bg-light d-flex align-items-center justify-content-center text-muted small">
                                <i class="bi bi-image"></i>
                            </div>
                            @endif
                        </td>

                        <td class="fw-semibold">
                            {{ $item->Nama_Sepeda }}
                        </td>

                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ $item->Kategori_Sepeda }}
                            </span>
                        </td>

                        <td class="text-center">
                            @if(strtolower($item->Status_Sepeda) == 'tersedia')
                            <span class="status-badge bg-soft-success">
                                <i class="bi bi-check-circle me-1"></i> Tersedia
                            </span>
                            @else
                            <span class="status-badge bg-soft-danger">
                                <i class="bi bi-dash-circle me-1"></i> Dipinjam
                            </span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.sepeda.edit', $item->ID_Sepeda) }}"
                                    class="btn-action btn-edit text-decoration-none" title="Edit Data">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>

                                {{-- Jika ingin menambahkan tombol hapus di masa depan, tinggal uncomment ini --}}

                                <form action="{{ route('admin.sepeda.destroy', $item->ID_Sepeda) }}" method="POST"
                                    onsubmit="return confirm('Hapus sepeda ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-bicycle display-4 opacity-25 mb-2"></i>
                                <p class="mb-0">Belum ada data sepeda. Yuk tambah unit baru!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div id="imageModal" class="modal-overlay" onclick="closeFullImage()">
        <span class="close-btn">&times;</span>
        <img class="modal-content-img" id="fullImage">
    </div>
</div>



<style>

</style>

<script>
    // Fungsi Buka Gambar
    function showFullImage(src) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('fullImage');
        modal.style.display = "flex";
        img.src = src;
    }

    // Fungsi Tutup Gambar
    function closeFullImage() {
        document.getElementById('imageModal').style.display = "none";
    }
</script>
@endsection