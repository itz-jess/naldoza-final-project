<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JESS Tech — Job Openings</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 2rem;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .nav-brand {
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            color: #0f172a;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #64748b;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            color: #2563eb;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
        }

        .page-header p {
            color: #64748b;
            margin-top: 0.5rem;
        }

        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .job-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
        }

        .job-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .job-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .job-department {
            font-size: 0.85rem;
            color: #2563eb;
            margin-bottom: 0.5rem;
        }

        .job-salary {
            font-size: 1rem;
            font-weight: 600;
            color: #10b981;
            margin-bottom: 1rem;
        }

        .job-description {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .btn-apply {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-apply:hover {
            background: #1e40af;
        }

        .flash-success {
            background: #dcfce7;
            border-left: 4px solid #22c55e;
            color: #166534;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        footer {
            background: #fff;
            border-top: 1px solid #e5e7eb;
            margin-top: 3rem;
            padding: 1.5rem;
            text-align: center;
            font-size: 0.75rem;
            color: #64748b;
        }
    </style>
</head>
<body>

<!-- Navigation -->
<div style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1280px; margin: 0 auto;">
        <a href="/" style="display: flex; align-items: center; text-decoration: none;">
            <span style="font-weight: 900; color: #0f172a; font-size: 1.25rem;">JESS</span>
            <span style="font-weight: 400; color: #6b7280; margin-left: 4px; font-size: 1.25rem;">Tech</span>
        </a>
        <div style="display: flex; gap: 1.5rem; align-items: center;">
            <a href="{{ route('jobs.openings') }}" style="text-decoration: none; color: #6b7280; font-size: 0.875rem;">Careers</a>
            <a href="{{ route('login') }}" style="text-decoration: none; color: #6b7280; font-size: 0.875rem;">Sign In</a>
            <a href="{{ route('register') }}" style="background: #2563eb; color: white; padding: 0.5rem 1.25rem; border-radius: 8px; text-decoration: none; font-size: 0.875rem; font-weight: 500;">Get Started</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="page-header">
        <h1>Join Our Team</h1>
        <p>Explore exciting career opportunities at JESS Tech</p>
    </div>

    @if(session('success'))
        <div class="flash-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="jobs-grid">
        @forelse($positions as $position)
        <div class="job-card">
            <h3 class="job-title">{{ $position->title }}</h3>
            <div class="job-department">{{ $position->department }}</div>
            <div class="job-salary">₱{{ number_format($position->base_pay, 2) }}/month</div>
            <div class="job-description">
                {{ $position->description ?? 'No description available.' }}
            </div>
            <a href="{{ route('jobs.apply', $position) }}" class="btn-apply">Apply Now →</a>
        </div>
        @empty
        <div style="text-align: center; grid-column: 1/-1; padding: 3rem;">
            <p>No job openings at the moment. Please check back later!</p>
        </div>
        @endforelse
    </div>
</div>

<footer>
    <p>© {{ date('Y') }} JESS Technologies. All rights reserved.</p>
</footer>

</body>
</html>