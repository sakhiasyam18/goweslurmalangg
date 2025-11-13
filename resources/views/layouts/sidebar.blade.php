<div class="sidebar">
    <div class="text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="goweslurr logo" style="max-width: 140px;">
    </div>


    <nav class="nav flex-column">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ Request::is('admin/dashboard*') ? 'active-menu' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('admin.denda.index') }}"
            class="nav-link {{ Request::is('admin/denda*') ? 'active-menu' : '' }}">
            <i class="bi bi-cash-stack"></i> Data Denda
        </a>

        <a href="{{ route('admin.sepeda.index') }}"
            class="nav-link {{ Request::is('sepeda*') ? 'active-menu' : '' }}">
            <i class="bi bi-bicycle"></i> Data Sepeda
        </a>
    </nav>
</div>