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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> -->


    <style>
       
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #0d6efd, #2563eb);
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar h4 {
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
            color: #fff;
        }

        .sidebar .nav-link {
            color: #e0e7ff;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .sidebar .active-menu {
            background: #fff;
            color: #0d6efd !important;
            box-shadow: 0 3px 10px rgba(255, 255, 255, 0.2);
        }

        /* CONTENT AREA */
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* HEADER */
        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
            padding: 1rem 2rem;
        }

        .topbar .bi-person-circle {
            color: #0d6efd;
        }

        .main-content {
            padding: 2rem 2.5rem;
            flex-grow: 1;
            background-color: #f5f7fa;
        }

        /* TABLE */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table th {
            background-color: #eef2ff !important;
            color: #1e3a8a;
        }

        .table td {
            vertical-align: middle;
        }

        .card {
            border-radius: 15px;
            background: #fff;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        .btn {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-danger {
            background-color: #ef4444;
            border: none;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        /* RESPONSIVE SIDEBAR */
        @media (max-width: 992px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                justify-content: space-around;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }

            .sidebar .nav-link {
                justify-content: center;
                font-size: 0.9rem;
            }
        }

         /* Efek halus dan interaktif */
        * {
            transition: all 0.3s ease;
        }

        /* Hover card & tombol */
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: scale(1.03);
        }

        /* Sidebar link animasi aktif */
        .sidebar .nav-link.active-menu {
            background: #fff;
            color: #2563eb !important;
            font-weight: 600;
            transform: scale(1.03);
        }

    </style>
</head>

<body>
    <div class="layout">
        @include('layouts.sidebar')

        <div class="content-area">
            @include('layouts.header')

            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Toast Notification --}}
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
        @if(session('success'))
        <div class="toast align-items-center text-white bg-success border-0 show shadow" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="toast align-items-center text-white bg-danger border-0 show shadow" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    ❌ {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
        @endif
    </div>

</body>

</html>