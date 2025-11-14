<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin GowesLurr</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    /* === VARIABLES === */
    :root {
        --primary-color: #0d6efd;
        --sidebar-bg: linear-gradient(180deg, #0d6efd 0%, #0a58ca 100%);
        --sidebar-width: 260px;
        --bg-body: #f5f7fa;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-body);
        color: #333;
        margin: 0;
        overflow-x: hidden;
        /* Cegah scroll samping */
    }

    /* === LAYOUT WRAPPER === */
    .wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    /* === SIDEBAR STYLE === */
    .sidebar-wrapper {
        min-width: var(--sidebar-width);
        max-width: var(--sidebar-width);
        background: var(--sidebar-bg);
        color: #fff;
        min-height: 100vh;
        position: fixed;
        /* Sidebar nempel di kiri */
        top: 0;
        left: 0;
        z-index: 1050;
        /* Di atas konten */
        transition: all 0.3s ease;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
    }

    /* === CONTENT AREA === */
    .content-wrapper {
        width: 100%;
        margin-left: var(--sidebar-width);
        /* Memberi ruang buat sidebar */
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }

    .main-content {
        padding: 30px;
        flex: 1;
    }

    /* === OVERLAY (Background Gelap saat Menu Buka di HP) === */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        /* Di bawah sidebar, di atas konten */
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar-overlay.active {
        display: block;
        opacity: 1;
    }

    /* === RESPONSIVE (MOBILE) === */
    @media (max-width: 991.98px) {

        /* Sidebar sembunyi ke kiri */
        .sidebar-wrapper {
            margin-left: calc(var(--sidebar-width) * -1);
        }

        /* Jika kelas 'active' ditambahkan (tombol diklik), sidebar muncul */
        .sidebar-wrapper.active {
            margin-left: 0;
        }

        /* Konten jadi full width */
        .content-wrapper {
            margin-left: 0;
        }
    }

    /* Animasi Masuk */
    .fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="wrapper">

        <nav class="sidebar-wrapper" id="sidebar">
            @include('admin.sidebar')
        </nav>

        <div class="content-wrapper">

            <div class="px-4 pt-4">
                @include('admin.header')
            </div>

            <div class="main-content fade-in">
                @yield('content')
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.getElementById('mobileToggle'); // Tombol di Header
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        // Fungsi Buka/Tutup
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Event Listener Tombol Header
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function(e) {
                e.stopPropagation(); // Cegah klik tembus
                toggleSidebar();
            });
        }

        // Event Listener Klik Overlay (Tutup Sidebar)
        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }
    });
    </script>

</body>

</html>