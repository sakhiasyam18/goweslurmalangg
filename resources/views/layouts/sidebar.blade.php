<div class="sidebar p-3">
    <h4 class="fw-bold mb-4 text-center text-primary">goweslurr.</h4>

    <nav class="nav flex-column">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-link d-flex align-items-center mb-2 {{ Request::is('admin/dashboard*') ? 'active-menu' : '' }}">
            <i class="bi bi-clipboard-data me-2"></i> Dashboard
        </a>

        <a href="{{ route('admin.denda.index') }}"
            class="nav-link d-flex align-items-center mb-2 {{ Request::is('admin/denda*') ? 'active-menu' : '' }}">
            <i class="bi bi-cash-stack me-2"></i> Data Denda
        </a>

         <a href="{{ route('admin.sepeda.index') }}"
            class="nav-link d-flex align-items-center mb-2 {{ Request::is('sepeda*') ? 'active-menu' : '' }}">
            <i class="bi bi-bicycle me-2"></i> Data Sepeda
        </a>
    </nav>
</div>