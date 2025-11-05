<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>

        {{-- 
        
          Cek "amplop" 'error' yang Anda kirim dari controller 
        --}}
        @if (session('error'))
            <p style="color:red;">{{ session('error') }}</p>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <input type="name" name="name" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>

        {{-- 
          Ini untuk error validasi. 
          Tidak terpakai sekarang, tapi tidak apa-apa disimpan di sini. 
        --}}
        @if ($errors->any())
            <p style="color:red;">{{ $errors->first() }}</p>
        @endif
    </div>
</body>
</html>