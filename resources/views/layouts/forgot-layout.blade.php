<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JESS Tech - Reset Password</title>

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

        .reset-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            border: 1px solid #e5e7eb;
        }

        .reset-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .reset-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0f172a;
        }

        .reset-header p {
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

        .form-input, .password-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .password-input {
            padding-right: 2.5rem;
        }

        .form-input:focus, .password-input:focus {
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

        .btn-submit {
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

        .btn-submit:hover {
            background: #1e40af;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: #2563eb;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .success-message {
            background: #dcfce7;
            border-left: 4px solid #22c55e;
            color: #166534;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<div class="reset-card">
    {{ $slot }}
</div>

</body>
</html>