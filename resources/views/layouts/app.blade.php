<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goweslurr Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            overflow-x: hidden;
        }
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .content-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            padding: 25px 40px;
        }
        .active-menu {
            background-color: #d9d9d9;
            font-weight: 600;
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
