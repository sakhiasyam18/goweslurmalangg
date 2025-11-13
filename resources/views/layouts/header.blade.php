<div class="topbar d-flex justify-content-between align-items-center shadow-sm px-4 py-2 bg-white rounded-3 mb-4">
    <h5 class="fw-semibold mb-0 text-primary">Dashboard Admin</h5>

    <div class="d-flex align-items-center gap-3">
        <!-- Nama dan role -->
        <div class="text-end">
            <div class="fw-semibold">{{ Auth::user()->name }}</div>
            <small class="text-muted">Administrator</small>
        </div>

        <!-- Avatar otomatis -->
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
             class="rounded-circle border border-2 border-primary"
             width="40" height="40" alt="Avatar">

        <!-- Tombol logout -->
        <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Yakin logout?');">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
</div>
