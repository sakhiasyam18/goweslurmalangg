<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goweslurr</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff;
        }
        .sidebar {
            width: 230px;
            min-height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
        }
        .sidebar h4 {
            font-weight: bold;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: #000;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.2s;
        }
        .sidebar a:hover {
            background-color: #e9ecef;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .sidebar .active {
            background-color: #e0e0e0;
        }
        .topbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }
        .topbar i {
            font-size: 1.5rem;
            margin-left: 15px;
            cursor: pointer;
        }
        .content {
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4>goweslurr.</h4>
            <a href="#">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="#">
                <i class="bi bi-bag"></i> Data Pemesanan
            </a>
            <a href="{{ route('sepeda.index') }}" class="{{ Request::is('sepeda*') ? 'active' : '' }}">
                <i class="bi bi-bicycle"></i> Data Sepeda
            </a>
            <a href="#">
                <i class="bi bi-currency-dollar"></i> Data Denda
            </a>
        </div>

        <!-- Main Area -->
        <div class="flex-grow-1">
            <!-- Topbar -->
            <div class="topbar">
                <i class="bi bi-person-circle"></i>
                <i class="bi bi-box-arrow-right"></i>
            </div>

            <!-- Konten Halaman -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
