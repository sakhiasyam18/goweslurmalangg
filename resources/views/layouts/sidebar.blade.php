<div class="sidebar bg-white border-end p-3" style="width:250px;">
    <h4 class="fw-bold mb-4">goweslurr.</h4>

    <a href="#" class="d-flex align-items-center mb-3 text-dark text-decoration-none">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <a href="#" class="d-flex align-items-center mb-3 text-dark text-decoration-none">
        <i class="bi bi-clipboard-data me-2"></i> Data Pemesanan
    </a>

    <a href="{{ route('sepeda.index') }}" 
       class="d-flex align-items-center mb-3 text-dark text-decoration-none {{ Request::is('sepeda*') ? 'active-menu' : '' }}">
        <i class="bi bi-bicycle me-2"></i> Data Sepeda
    </a>

    <a href="#" class="d-flex align-items-center text-dark text-decoration-none">
        <i class="bi bi-cash-stack me-2"></i> Data Denda
    </a>
</div>
