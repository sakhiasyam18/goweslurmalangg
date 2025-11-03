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
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>

        @if ($errors->any())
            <p style="color:red;">{{ $errors->first() }}</p>
        @endif
    </div>
</body>
</html>
