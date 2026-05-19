<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JESS Tech - Employee Management System')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        h1, .h1 {
            font-size: 1.875rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            color: #0f172a;
        }

        h2, .h2 {
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: -0.01em;
            color: #0f172a;
        }

        h3, .h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0f172a;
        }

        .card {
            background-color: #ffffff;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            background-color: #ffffff;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #0f172a;
            border: 1px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .table-container {
            overflow-x: auto;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .table th {
            text-align: left;
            padding: 0.875rem 1rem;
            background-color: #f8fafc;
            font-weight: 600;
            color: #0f172a;
            border-bottom: 1px solid #e2e8f0;
        }

        .table td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }

        .table tr:hover td {
            background-color: #f8fafc;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            font-size: 0.7rem;
            font-weight: 500;
            border-radius: 9999px;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background-color: #fef9c3;
            color: #854d0e;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .alert {
            padding: 1rem 1.25rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-left: 4px solid #22c55e;
            color: #166534;
        }

        .alert-error {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }

        .stat-card {
            background-color: #ffffff;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            padding: 1.25rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 0.25rem;
        }

        .container-custom {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .text-muted {
            color: #64748b;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        /* Sidebar transition */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    @auth
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-y-auto">
                @include('layouts.navigation')

                <main class="flex-1 p-6">
                    @if(session('success'))
                        <div class="alert alert-success animate-fade-in">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error animate-fade-in">
                            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    @else
        <div>
            @include('layouts.navigation')
            <main>
                @if(session('success'))
                    <div class="container-custom mt-6">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        </div>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    @endauth
</body>
</html>