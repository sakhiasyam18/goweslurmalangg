<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | GowesLurr</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f0f2f5;
        /* Background abu muda yang nyaman di mata */
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    /* Kartu Login */
    .login-card {
        background: #ffffff;
        width: 100%;
        max-width: 420px;
        /* Lebar ideal agar tidak terlalu lebar */
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        /* Shadow lembut premium */
        padding: 40px;
        text-align: center;
        border: 1px solid #fff;
        position: relative;
        overflow: hidden;
    }

    /* Hiasan Garis Atas */
    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
    }

    /* Logo */
    .logo-img {
        width: 80px;
        margin-bottom: 20px;
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
    }

    h2 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    p.subtitle {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 30px;
    }

    /* Input Style */
    .form-control {
        padding: 12px 15px;
        border-radius: 10px;
        border: 2px solid #f1f3f5;
        background-color: #f8f9fa;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    /* Ikon di dalam Input Group */
    .input-group-text {
        background-color: #f8f9fa;
        border: 2px solid #f1f3f5;
        border-right: none;
        border-radius: 10px 0 0 10px;
        color: #adb5bd;
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0 10px 10px 0;
    }

    .input-group:focus-within .input-group-text {
        border-color: #0d6efd;
        background-color: #fff;
        color: #0d6efd;
    }

    /* Tombol */
    .btn-login {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        background: linear-gradient(135deg, #0d6efd, #0056b3);
        border: none;
        color: white;
        margin-top: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4);
    }

    /* Alert Error */
    .alert-custom {
        font-size: 0.85rem;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 20px;
        text-align: left;
        border: none;
        background-color: #fff5f5;
        color: #dc3545;
        border-left: 4px solid #dc3545;
    }

    .copyright {
        margin-top: 30px;
        font-size: 0.75rem;
        color: #adb5bd;
    }
    </style>
</head>

<body>

    <div class="login-card animate__animated animate__fadeInUp">

        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">

        <h2>Admin Portal</h2>
        <p class="subtitle">Silakan masuk untuk mengelola dashboard</p>

        @if(session('error'))
        <div class="alert-custom">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert-custom">
            <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="name" name="name" class="form-control" placeholder="Username" value="{{ old('name') }}"
                    required>
            </div>

            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-login">
                Masuk <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="copyright">
            &copy; {{ date('Y') }} GowesLurr Malang.
        </div>
    </div>

</body>

</html>