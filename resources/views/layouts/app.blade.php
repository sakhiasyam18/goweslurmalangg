<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin GowesLurr</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS Kustom untuk Layout Admin -->
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .layout {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 260px;
        flex-shrink: 0;
        background-color: #ffffff;
        border-right: 1px solid #dee2e6;
    }

    .content-area {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
    }

    .main-content {
        padding: 25px 40px;
        flex-grow: 1;
    }

    .topbar {
        background-color: #ffffff;
        border-bottom: 1px solid #dee2e6;
    }

    /* Style untuk link sidebar aktif */
    .sidebar .nav-link {
        color: #333;
        font-weight: 500;
    }

    .sidebar .nav-link.active-menu {
        background-color: #e9ecef;
        color: #0d6efd;
        border-radius: 8px;
    }

    .sidebar .nav-link:hover {
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    </style>
</head>

<body>
    <div class="layout">
        <!-- 1. Memasukkan Sidebar -->
        @include('layouts.sidebar')

        <div class="content-area">
            <!-- 2. Memasukkan Header -->
            @include('layouts.header')

            <!-- 3. Tempat Konten Berubah (Dashboard, Data Sepeda, dll) -->
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>