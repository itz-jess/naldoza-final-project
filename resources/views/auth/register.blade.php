<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JESS Tech — Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

        .register-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 2rem;
            width: 100%;
            max-width: 480px;
            border: 1px solid var(--border);
        }

        .register-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .register-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text);
        }

        .register-header p {
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

        .password-input, .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .password-input:focus, .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        .password-input.error, .form-input.error {
            border-color: var(--error);
        }

        .error-message {
            color: var(--error);
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .row-2cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-register {
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

        .btn-register:hover {
            background: var(--primary-dark);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
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

        @media (max-width: 560px) {
            .row-2cols {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .register-card {
                padding: 1.5rem;
            }
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
        <a href="{{ route('login') }}" class="nav-link">Login</a>
    </div>
</nav>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h1>Create an account</h1>
            <p>Join JESS Tech to get started</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Full name</label>
                <input id="name" type="text" name="name" class="form-input @error('name') error @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email address</label>
                <input id="email" type="email" name="email" class="form-input @error('email') error @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="row-2cols">
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input id="password" type="password" name="password" class="password-input @error('password') error @enderror" required>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="password-input" required>
                </div>
            </div>

            <button type="submit" class="btn-register">Register</button>

            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </form>
    </div>
</div>

<footer>
    © {{ date('Y') }} JESS Technologies. All rights reserved.
</footer>

</body>
</html>