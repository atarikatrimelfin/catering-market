<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Marketplace Katering</title>
    <link href="{{ asset('custom/style.css') }}" rel="stylesheet">
</head>
<body class="register-page">
    <div class="container">
        <div class="register-wrapper">
            <h1 class="register-title">Register</h1>
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif
            <form action="{{ route('registered') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="input-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="merchant">Merchant</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            <p class="login-link">Already have an account? <a href="/login">Login here</a></p>
            <a href="/" class="btn btn-back">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
