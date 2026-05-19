<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JESS Tech — Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:#f8fafc;
            --surface:#ffffff;
            --border:#e5e7eb;
            --primary:#2563eb;
            --primary-dark:#1e40af;
            --text:#0f172a;
            --muted:#64748b;
            --error:#ef4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 2rem;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .nav-brand {
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            color: var(--text);
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            border: 1px solid var(--border);
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .login-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text);
        }

        .login-header p {
            font-size: 0.85rem;
            color: var(--muted);
            margin-top: 0.25rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .form-input, .password-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-input:focus, .password-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        .form-input.error, .password-input.error {
            border-color: var(--error);
        }

        .error-message {
            color: var(--error);
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .remember-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--muted);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: var(--primary);
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: var(--primary-dark);
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        footer {
            background: #fff;
            border-top: 1px solid var(--border);
            margin-top: auto;
            padding: 1rem;
            text-align: center;
            font-size: 0.75rem;
            color: var(--muted);
        }
    </style>
</head>
<body>

<nav>
    <a href="/" class="nav-brand" style="display: flex; align-items: center; text-decoration: none;">
        <span style="font-weight: 900; color: #0f172a; font-size: 1.25rem;">JESS</span>
        <span style="font-weight: 400; color: #6b7280; margin-left: 4px; font-size: 1.25rem;">Tech</span>
    </a>
    <div class="nav-links">
        <a href="{{ route('register') }}" class="nav-link">Register</a>
    </div>
</nav>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1>Welcome back</h1>
            <p>Sign in to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email address</label>
                <input id="email" type="email" name="email" class="form-input @error('email') error @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input id="password" type="password" name="password" class="password-input @error('password') error @enderror" required>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="remember-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" style="width: 16px; height: 16px;">
                    <span>Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">Sign in</button>

            <div class="register-link">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>
        </form>
    </div>
</div>

<footer>
    © {{ date('Y') }} JESS Technologies. All rights reserved.
</footer>

</body>
</html>