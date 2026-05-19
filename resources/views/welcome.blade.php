<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JESS Tech — Employee Management System</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #ffffff;
            --bg-secondary: #f8fafc;
            --surface: #ffffff;
            --surface-alt: #f1f5f9;
            --border: #e2e8f0;
            --border-light: #f0f0f0;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --secondary: #7c3aed;
            --text: #0f172a;
            --text-secondary: #334155;
            --muted: #64748b;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
            overflow-x: hidden;
        }

        /* Typography */
        h1, .h1 {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text);
            line-height: 1.2;
        }

        h2, .h2 {
            font-size: 2.25rem;
            font-weight: 600;
            letter-spacing: -0.01em;
            color: var(--text);
            line-height: 1.3;
        }

        h3, .h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text);
        }

        /* Navigation */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-light);
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon span {
            color: white;
            font-weight: 700;
            font-size: 1rem;
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: var(--muted);
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .btn-outline-nav {
            padding: 0.5rem 1.25rem;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text);
            transition: all 0.2s ease;
        }

        .btn-outline-nav:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .btn-primary-nav {
            padding: 0.5rem 1.25rem;
            background: var(--primary);
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            color: white;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.1);
        }

        .btn-primary-nav:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-title {
            margin-bottom: 1.5rem;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1rem;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-visual {
            background: linear-gradient(135deg, var(--primary-light) 0%, rgba(124, 58, 237, 0.1) 100%);
            border-radius: 1.5rem;
            border: 1px solid rgba(37, 99, 235, 0.15);
            padding: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }

        .hero-visual i {
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .hero-visual p {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Buttons */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            background: var(--primary);
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            color: white;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            background: transparent;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--text);
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        /* Features Section */
        .features {
            padding: 6rem 2rem;
            background: var(--bg);
        }

        .features-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-label {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--primary);
            background: var(--primary-light);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            margin-bottom: 1rem;
        }

        .section-title {
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1rem;
            color: var(--muted);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            background: var(--surface);
            border: 1px solid var(--border-light);
            border-radius: 1rem;
            padding: 1.75rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: var(--border);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05);
            transform: translateY(-4px);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            color: var(--primary);
            font-size: 1.25rem;
        }

        .feature-title {
            margin-bottom: 0.5rem;
        }

        .feature-description {
            font-size: 0.875rem;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 5rem 2rem;
            text-align: center;
        }

        .cta-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-title {
            color: white;
            margin-bottom: 1rem;
        }

        .cta-text {
            color: #94a3b8;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            background: var(--primary);
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            color: white;
            transition: all 0.2s ease;
        }

        .cta-button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.3);
        }

        /* Footer */
        .footer {
            background: var(--bg);
            border-top: 1px solid var(--border-light);
            padding: 3rem 2rem 2rem;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-brand {
            font-weight: 700;
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
        }

        .footer-description {
            color: var(--muted);
            font-size: 0.75rem;
        }

        .footer-section h4 {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            color: var(--text-secondary);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            text-decoration: none;
            color: var(--muted);
            font-size: 0.875rem;
            transition: color 0.2s;
        }

        .footer-section a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            max-width: 1280px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-copyright {
            color: var(--muted);
            font-size: 0.75rem;
        }

        .footer-social {
            display: flex;
            gap: 1.5rem;
        }

        .footer-social a {
            color: var(--muted);
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-social a:hover {
            color: var(--primary);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            h1, .h1 {
                font-size: 2.75rem;
            }
            .hero-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                padding: 1rem;
            }
            .nav-links {
                gap: 1rem;
            }
            .hero {
                padding: 4rem 1rem;
            }
            h1, .h1 {
                font-size: 2rem;
            }
            .features {
                padding: 4rem 1rem;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
            .footer-container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- Navigation -->
<div style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1280px; margin: 0 auto;">
        <!-- Logo LEFT -->
        <a href="/" style="display: flex; align-items: center; text-decoration: none;">
            <span style="font-weight: 900; color: #0f172a; font-size: 1.25rem;">JESS</span>
            <span style="font-weight: 400; color: #6b7280; margin-left: 4px; font-size: 1.25rem;">Tech</span>
        </a>
        
        <!-- Links RIGHT -->
        <div style="display: flex; gap: 1.5rem; align-items: center;">
            <a href="{{ route('jobs.openings') }}" style="text-decoration: none; color: #6b7280; font-size: 0.875rem;">Careers</a>
            <a href="{{ route('login') }}" style="text-decoration: none; color: #6b7280; font-size: 0.875rem;">Sign In</a>
            <a href="{{ route('register') }}" style="background: #2563eb; color: white; padding: 0.5rem 1.25rem; border-radius: 8px; text-decoration: none; font-size: 0.875rem; font-weight: 500;">Get Started</a>
        </div>
    </div>
</div>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title">
                Manage your team with <span>precision</span>
            </h1>
            <p class="hero-subtitle">
                A complete solution for managing employee records, attendance tracking, leave requests, and performance reviews. Streamline your HR operations with our all-in-one platform.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn-primary">
                    <i class="fas fa-rocket"></i> Get Started
                </a>
                <a href="{{ route('login') }}" class="btn-outline">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </a>
            </div>
        </div>
        <div class="hero-visual">
            <i class="fas fa-chart-line"></i>
            <p>Dashboard Preview — Real-time Analytics</p>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="features-container">
        <div class="section-header">
            <div class="section-label">Core Features</div>
            <h2 class="section-title">Everything you need</h2>
            <p class="section-subtitle">Comprehensive tools designed to simplify HR management and boost team productivity</p>
        </div>
        <div class="features-grid">
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="feature-title">Employee Records</h3>
                <p class="feature-description">Centrally manage all employee information, including personal details, job roles, and employment history.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="feature-title">Attendance Tracking</h3>
                <p class="feature-description">Record time-in and time-out, monitor lateness, and generate attendance reports for payroll.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="feature-title">Leave Management</h3>
                <p class="feature-description">Employees can request leaves, track available credits, and managers can approve or reject requests.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="feature-title">Performance Reviews</h3>
                <p class="feature-description">Conduct regular performance evaluations, track ratings, and provide constructive feedback.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3 class="feature-title">Recruitment</h3>
                <p class="feature-description">Post job openings, receive applications, and manage the entire hiring process from one dashboard.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <h3 class="feature-title">Reports & Analytics</h3>
                <p class="feature-description">Generate comprehensive reports on attendance, leave usage, and employee performance metrics.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="cta-container">
        <h2 class="cta-title">Ready to transform your HR operations?</h2>
        <p class="cta-text">Join thousands of companies using JESS Tech to streamline workforce management and boost productivity.</p>
        <a href="{{ route('register') }}" class="cta-button">
            <i class="fas fa-arrow-right"></i> Start Your Free Trial
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div>
            <div class="footer-brand">JESS Tech</div>
            <p class="footer-description">The complete employee management system.</p>
        </div>
        <div class="footer-section">
            <h4>Product</h4>
            <ul>
                <li><a href="{{ route('login') }}">Sign In</a></li>
                <li><a href="{{ route('register') }}">Get Started</a></li>
                <li><a href="#features">Features</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Resources</h4>
            <ul>
                <li><a href="{{ route('jobs.openings') }}">Careers</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-copyright">
            &copy; {{ date('Y') }} JESS Technologies. All rights reserved.
        </div>
        <div class="footer-social">
            <a href="#">Twitter</a>
            <a href="#">LinkedIn</a>
            <a href="#">GitHub</a>
        </div>
    </div>
</footer>

</body>
</html>