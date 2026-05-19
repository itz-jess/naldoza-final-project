<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JESS Tech — Confirm Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .confirm-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            border: 1px solid #e5e7eb;
        }

        .confirm-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .confirm-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0f172a;
        }

        .confirm-header p {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }

        .password-wrapper {
            position: relative;
        }

        .password-input {
            width: 100%;
            padding: 0.75rem 2.5rem 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.9rem;
        }

        .password-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            color: #64748b;
            font-size: 1rem;
        }

        .toggle-password:hover {
            color: #2563eb;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .btn-confirm {
            width: 100%;
            background: #2563eb;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-confirm:hover {
            background: #1e40af;
        }
    </style>
</head>
<body>

<div class="confirm-card">
    <div class="confirm-header">
        <h1>Confirm Password</h1>
        <p>Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div class="password-wrapper">
                <input id="password" type="password" name="password" class="password-input" required autocomplete="current-password">
                <button type="button" class="toggle-password">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-confirm">Confirm Password</button>
    </form>
</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fa-regular fa-eye"></i>' : '<i class="fa-regular fa-eye-slash"></i>';
        });
    });
</script>

</body>
</html>