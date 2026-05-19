<x-forgot-layout>
    <div class="reset-header">
        <h1>Reset Password</h1>
        <p>Create a new password for your account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input id="email" type="email" name="email" class="form-input" value="{{ old('email', $request->email) }}" required readonly>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">New Password</label>
            <div class="password-wrapper">
                <input id="password" type="password" name="password" class="password-input" required>
                <button type="button" class="toggle-password">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <div class="password-wrapper">
                <input id="password_confirmation" type="password" name="password_confirmation" class="password-input" required>
                <button type="button" class="toggle-password">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-submit">Reset Password</button>

        <div class="back-link">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </form>

    <style>
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
    </style>

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
</x-forgot-layout>