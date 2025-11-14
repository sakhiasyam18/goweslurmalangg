<style>
    /* Style Khusus Header */
    .topbar {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .user-role {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .avatar-profile {
        width: 42px;
        height: 42px;
        object-fit: cover;
        border: 2px solid #eef2f6;
        padding: 2px;
    }

    .btn-logout-custom {
        border: 1px solid #fee2e2;
        background-color: #fff5f5;
        color: #dc3545;
        transition: all 0.2s;
    }

    .btn-logout-custom:hover {
        background-color: #dc3545;
        color: white;
        border-color: #dc3545;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
    }

    /* Tombol Toggle Sidebar (Hanya muncul di Mobile) */
    .btn-toggle-sidebar {
        background: transparent;
        border: none;
        color: #2c3e50;
        font-size: 1.5rem;
        /* Ukuran ikon pas */
        cursor: pointer;
        padding: 5px;
        margin-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: background 0.2s;
    }

    .btn-toggle-sidebar:active {
        background-color: #f0f0f0;
    }
</style>

<div class="topbar d-flex justify-content-between align-items-center px-4 py-3 mb-4">

    <div class="d-flex align-items-center">

        {{-- Tombol Hamburger Mobile (Trigger ada di app.blade.php) --}}
        <button class="btn-toggle-sidebar d-lg-none" type="button" id="mobileToggle">
            <i class="bi bi-list"></i>
        </button>

        <div>
            {{-- LOGIKA JUDUL DINAMIS --}}
            @php
            $judul = 'Dashboard'; // Default

            if (Request::is('admin/dashboard*')) {
            $judul = 'Dashboard';
            } elseif (Request::is('admin/sepeda/create')) {
            $judul = 'Tambah Unit Sepeda';
            } elseif (Request::is('admin/sepeda/*/edit')) {
            $judul = 'Edit Unit Sepeda';
            } elseif (Request::is('admin/sepeda*')) {
            $judul = 'Data Sepeda';
            } elseif (Request::is('admin/denda*')) {
            $judul = 'Data Denda';
            }
            @endphp

            {{-- TAMPILKAN JUDUL --}}
            <h5 class="fw-bold mb-0 text-dark">{{ $judul }}</h5>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3">

        <div class="text-end d-none d-md-block">
            <div class="fw-bold text-dark" style="font-size: 0.9rem;">
                {{ Auth::user()->name ?? 'Administrator' }}
            </div>
        </div>

        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0d6efd&color=fff&bold=true"
            class="rounded-circle avatar-profile shadow-sm" alt="Avatar">

        <div class="vr mx-1 text-muted opacity-25 d-none d-md-block" style="height: 30px;"></div>

        <form action="{{ route('admin.logout') }}" method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin keluar?');">
            @csrf
            <button type="submit"
                class="btn btn-sm btn-logout-custom rounded-pill px-3 py-2 d-flex align-items-center gap-2 fw-semibold">
                <i class="bi bi-box-arrow-right"></i>
                <span class="d-none d-md-inline">Keluar</span>
            </button>
        </form>
    </div>

</div>