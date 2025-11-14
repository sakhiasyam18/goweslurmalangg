<style>
    /* Style Khusus Sidebar */
    .sidebar-content {
        padding: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .sidebar-brand {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-logo {
        max-width: 120px;
        filter: brightness(0) invert(1);
        /* Membuat logo jadi putih */
        opacity: 0.9;
        transition: transform 0.3s;
    }

    .sidebar-logo:hover {
        transform: scale(1.05);
        opacity: 1;
    }

    /* Menu Items */
    .nav-item {
        margin-bottom: 8px;
    }

    .nav-link-custom {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        padding: 12px 15px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .nav-link-custom i {
        margin-right: 15px;
        font-size: 1.2rem;
        width: 25px;
        /* Agar teks rata lurus */
        text-align: center;
    }

    /* Hover Effect */
    .nav-link-custom:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        transform: translateX(5px);
        /* Geser sedikit ke kanan */
    }

    /* Active State (Halaman Aktif) */
    .nav-link-custom.active {
        background-color: #fff;
        color: var(--primary-color);
        /* Mengambil warna dari app.blade.php */
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .nav-link-custom.active i {
        color: var(--primary-color);
    }

    /* Footer Sidebar (Optional) */
    .sidebar-footer {
        margin-top: auto;
        text-align: center;
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.5);
        padding-top: 20px;
    }
</style>

<div class="sidebar-content">

    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="GowesLurr Logo" class="sidebar-logo">
        </a>
    </div>

    <nav class="nav flex-column">

        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link-custom {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.sepeda.index') }}"
                class="nav-link-custom {{ Request::is('admin/sepeda*') ? 'active' : '' }}">
                <i class="bi bi-bicycle"></i>
                <span>Data Sepeda</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.denda.index') }}"
                class="nav-link-custom {{ Request::is('admin/denda*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                <span>Data Denda</span>
            </a>
        </div>

    </nav>

    <div class="sidebar-footer">
        &copy; {{ date('Y') }} GowesLurr Admin<br>
        Ver 1.0
    </div>

</div>