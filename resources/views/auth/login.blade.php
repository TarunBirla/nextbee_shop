{{-- LOGIN PAGE --}}
@extends('layouts.app')

@section('content')

<style>
    :root { --sky:#0ea5e9; --sky-light:#e0f2fe; --sky-mid:#38bdf8; --sky-dark:#0369a1; --sky-deep:#075985; --text-dark:#0c2340; }

    .auth-wrap {
        min-height: calc(100vh - 130px);
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }

    .auth-wrap::before {
        content: '';
        position: absolute;
        top: -120px; right: -120px;
        width: 400px; height: 400px;
        background: rgba(14,165,233,0.08);
        border-radius: 50%;
    }

    .auth-wrap::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -80px;
        width: 300px; height: 300px;
        background: rgba(3,105,161,0.06);
        border-radius: 50%;
    }

    .auth-card {
        background: white;
        border-radius: 28px;
        box-shadow: 0 24px 80px rgba(14,165,233,0.15), 0 4px 20px rgba(0,0,0,0.06);
        width: 100%;
        max-width: 440px;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .auth-header {
        background: linear-gradient(135deg, var(--sky-deep) 0%, var(--sky) 100%);
        padding: 36px 32px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .auth-header::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 140px; height: 140px;
        background: rgba(255,255,255,0.07);
        border-radius: 50%;
    }

    .auth-logo-icon {
        width: 60px; height: 60px;
        background: rgba(255,255,255,0.15);
        border: 2px solid rgba(255,255,255,0.25);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 1.5rem;
        color: white;
        position: relative;
        z-index: 1;
    }

    .auth-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: white;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }

    .auth-header p {
        color: rgba(255,255,255,0.75);
        font-size: 0.85rem;
        position: relative;
        z-index: 1;
    }

    .auth-body { padding: 32px; }

    .alert-success {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f0fdf4;
        border: 2px solid #86efac;
        color: #166534;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        margin-bottom: 20px;
    }

    .alert-error {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fef2f2;
        border: 2px solid #fca5a5;
        color: #dc2626;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        margin-bottom: 20px;
    }

    .form-group { margin-bottom: 18px; }

    .form-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.83rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 7px;
    }

    .form-label i { color: var(--sky); font-size: 0.8rem; }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--sky-light);
        border-radius: 12px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        color: var(--text-dark);
        background: #f8fafc;
        outline: none;
        transition: all 0.25s;
        box-sizing: border-box;
    }

    .form-input:focus {
        border-color: var(--sky-mid);
        background: white;
        box-shadow: 0 0 0 4px rgba(14,165,233,0.1);
    }

    .form-input::placeholder { color: #94a3b8; }

    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        font-size: 0.82rem;
    }

    .remember-label {
        display: flex;
        align-items: center;
        gap: 7px;
        cursor: pointer;
        color: #64748b;
        font-weight: 500;
    }

    .remember-label input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--sky-dark);
        cursor: pointer;
    }

    .forgot-link {
        color: var(--sky-dark);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .forgot-link:hover { color: var(--sky); }

    .btn-submit {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--sky-dark), var(--sky));
        color: white;
        border: none;
        border-radius: 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        box-shadow: 0 6px 20px rgba(14,165,233,0.3);
        letter-spacing: 0.02em;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(14,165,233,0.4);
    }

    .auth-footer {
        text-align: center;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 2px solid var(--sky-light);
        font-size: 0.85rem;
        color: #64748b;
    }

    .auth-footer a {
        color: var(--sky-dark);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s;
    }

    .auth-footer a:hover { color: var(--sky); }

    .input-wrap { position: relative; }
    .input-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #cbd5e1;
        cursor: pointer;
        font-size: 0.9rem;
        transition: color 0.2s;
    }
    .input-icon:hover { color: var(--sky-dark); }
</style>

<div class="auth-wrap">
    <div class="auth-card">

        <!-- Header -->
        <div class="auth-header">
            <div class="auth-logo-icon"><i class="fa-solid fa-globe"></i></div>
            <h2>Welcome Back</h2>
            <p>Login to access your wholesale account</p>
        </div>

        <!-- Body -->
        <div class="auth-body">

            @if(session('success'))
                <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="Enter your email" value="{{ old('email') }}" required>
                    @error('email')<p style="color:#dc2626; font-size:0.78rem; margin-top:5px;">{{ $message }}</p>@enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-lock"></i> Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="passwordInput" class="form-input" placeholder="Enter your password" required style="padding-right:44px;">
                        <i class="fa-regular fa-eye input-icon" id="togglePwd" onclick="togglePassword()"></i>
                    </div>
                    @error('password')<p style="color:#dc2626; font-size:0.78rem; margin-top:5px;">{{ $message }}</p>@enderror
                </div>

                <!-- Remember / Forgot -->
                <div class="form-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-right-to-bracket"></i> Login to Account
                </button>
            </form>

            <!-- Footer -->
            <div class="auth-footer">
                Don't have an account?
                <a href="/register">Create one here →</a>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const inp = document.getElementById('passwordInput');
        const icon = document.getElementById('togglePwd');
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.className = 'fa-regular fa-eye-slash input-icon';
        } else {
            inp.type = 'password';
            icon.className = 'fa-regular fa-eye input-icon';
        }
    }
</script>

@endsection