<div class="topbar d-flex justify-content-end align-items-center px-4 py-3">
    <div class="d-flex align-items-center">
        <i class="bi bi-person-circle fs-4 me-2"></i>
        <span class="fw-semibold me-3">{{ Auth::user()->name }}</span>

        <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Anda yakin ingin logout?');">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
</div>