<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apply for {{ $position->title }} - JESS Tech</title>

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

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 2rem;
        }

        .apply-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid #e5e7eb;
        }

        .apply-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .apply-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
        }

        .apply-header p {
            color: #64748b;
            margin-top: 0.25rem;
        }

        .job-info {
            background: #f1f5f9;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .job-info h3 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .job-info p {
            font-size: 0.85rem;
            color: #2563eb;
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

        .form-input, .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        .form-input.error, .form-textarea.error {
            border-color: #ef4444;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .row-2cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: #1e40af;
        }

        .back-link {
            text-align: center;
            margin-top: 1rem;
        }

        .back-link a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .back-link a:hover {
            color: #2563eb;
        }

        footer {
            background: #fff;
            border-top: 1px solid #e5e7eb;
            margin-top: 2rem;
            padding: 1.5rem;
            text-align: center;
            font-size: 0.75rem;
            color: #64748b;
        }

        @media (max-width: 560px) {
            .row-2cols {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .container {
                padding: 1rem;
            }
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
        <a href="{{ route('jobs.openings') }}" style="text-decoration: none; color: #6b7280; font-size: 0.875rem;">← Back to Jobs</a>
    </div>
</div>

<div class="container">
    <div class="apply-card">
        <div class="apply-header">
            <h1>Apply for Position</h1>
            <p>Fill out the form below to submit your application</p>
        </div>

        <div class="job-info">
            <h3>{{ $position->title }}</h3>
            <p>{{ $position->department }} • ₱{{ number_format($position->base_pay, 2) }}/month</p>
        </div>

        <form method="POST" action="{{ route('jobs.submit', $position) }}" enctype="multipart/form-data">
            @csrf

            <div class="row-2cols">
                <div class="form-group">
                    <label class="form-label" for="applicant_name">Full Name *</label>
                    <input id="applicant_name" type="text" name="applicant_name" class="form-input @error('applicant_name') error @enderror" value="{{ old('applicant_name') }}" required>
                    @error('applicant_name') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address *</label>
                    <input id="email" type="email" name="email" class="form-input @error('email') error @enderror" value="{{ old('email') }}" required>
                    @error('email') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="row-2cols">
            <div class="form-group">
                <label class="form-label" for="age">Age *</label>
                <input id="age" type="number" name="age" class="form-input @error('age') error @enderror" value="{{ old('age') }}" required>
                @error('age') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="sex">Gender *</label>
                <select id="sex" name="sex" class="form-input @error('sex') error @enderror" required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('sex') <p class="error-message">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="row-2cols">
            <div class="form-group">
                <label class="form-label" for="resume">Resume/CV * (PDF, DOC, DOCX)</label>
                <input id="resume" type="file" name="resume" class="form-input" accept=".pdf,.doc,.docx">
                @error('resume') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="profile_picture">Profile Picture (Optional)</label>
                <input id="profile_picture" type="file" name="profile_picture" class="form-input" accept="image/*">
                @error('profile_picture') <p class="error-message">{{ $message }}</p> @enderror
            </div>
        </div>

            <div class="row-2cols">
                <div class="form-group">
                    <label class="form-label" for="contact_number">Contact Number *</label>
                    <input id="contact_number" type="text" name="contact_number" class="form-input @error('contact_number') error @enderror" value="{{ old('contact_number') }}" required>
                    @error('contact_number') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Address *</label>
                    <input id="address" type="text" name="address" class="form-input @error('address') error @enderror" value="{{ old('address') }}" required>
                    @error('address') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="skills">Skills *</label>
                <textarea id="skills" name="skills" rows="3" class="form-textarea @error('skills') error @enderror" placeholder="e.g., PHP, Laravel, JavaScript, Project Management, Team Leadership" required>{{ old('skills') }}</textarea>
                @error('skills') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="experience">Work Experience</label>
                <textarea id="experience" name="experience" rows="4" class="form-textarea" placeholder="Describe your previous work experience...">{{ old('experience') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Submit Application</button>

            <div class="back-link">
                <a href="{{ route('jobs.openings') }}">← Browse all jobs</a>
            </div>
        </form>
    </div>
</div>

<footer>
    <p>© {{ date('Y') }} JESS Technologies. All rights reserved.</p>
</footer>

</body>
</html>