<x-forgot-layout>
    <div class="reset-header">
        <h1>Forgot Password?</h1>
        <p>Enter your email address and we'll send you a reset link.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="success-message">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input id="email" type="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Send Reset Link</button>

        <div class="back-link">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </form>
</x-forgot-layout>