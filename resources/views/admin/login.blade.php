<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | Goweslurr</title>
    <link rel="icon" href="{{ asset('images/logo-goweslurr.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* ====== Background Style ====== */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* ====== Login Box ====== */
        .login-container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 380px;
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ====== Logo ====== */
        .login-container img {
            width: 160px;
            margin-bottom: 20px;
        }

        h2 {
            color: #2b3d6b;
            margin-bottom: 25px;
            font-weight: 600;
        }

        /* ====== Input ====== */
        input[type="name"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            background-color: #f3f6ff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #2b3d6b;
            box-shadow: 0 0 4px rgba(43, 61, 107, 0.3);
            outline: none;
        }

        /* ====== Button ====== */
        button {
            width: 100%;
            padding: 12px;
            background-color: #2b3d6b;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        button:hover {
            background-color: #1f2e56;
            transform: translateY(-2px);
        }

        /* ====== Error Message ====== */
        .error-message {
            color: #d9534f;
            font-size: 14px;
            margin-bottom: 15px;
        }

        /* ====== Footer kecil ====== */
        .footer-text {
            margin-top: 20px;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <img src="{{ asset('images/logo-footer.png') }}" alt="Goweslurr Logo">
        <h2>Login Admin</h2>

        {{-- Pesan Error dari Controller --}}
        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <input type="name" name="name" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        {{-- Pesan Error Validasi --}}
        @if ($errors->any())
            <p class="error-message">{{ $errors->first() }}</p>
        @endif

        <p class="footer-text">© {{ date('Y') }} Goweslurr. All rights reserved.</p>
    </div>

</body>
</html>
