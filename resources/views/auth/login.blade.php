<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Marketplace Katering</title>
    <link href="{{ asset('custom/style.css') }}" rel="stylesheet">
</head>
<body class="login-page">
    <div class="container">
        <div class="login-wrapper">
            <h1 class="login-title">Login</h1>
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif
            <form action="{{ route('ceklogin') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p class="register-link">Don't have an account? <a href="/register">Register here</a></p>
            <a href="/" class="btn btn-back">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
