@extends('layouts.app')

@section('content')

<style>
    :root { --sky:#0ea5e9; --sky-light:#e0f2fe; --sky-mid:#38bdf8; --sky-dark:#0369a1; --sky-deep:#075985; --text-dark:#0c2340; }

    .auth-wrap { min-height:calc(100vh - 130px); background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 50%,#bae6fd 100%); display:flex; align-items:center; justify-content:center; padding:40px 20px; position:relative; overflow:hidden; }
    .auth-wrap::before { content:''; position:absolute; top:-120px; right:-120px; width:400px; height:400px; background:rgba(14,165,233,0.08); border-radius:50%; }
    .auth-wrap::after { content:''; position:absolute; bottom:-80px; left:-80px; width:300px; height:300px; background:rgba(3,105,161,0.06); border-radius:50%; }

    .auth-card { background:white; border-radius:28px; box-shadow:0 24px 80px rgba(14,165,233,0.15),0 4px 20px rgba(0,0,0,0.06); width:100%; max-width:460px; overflow:hidden; position:relative; z-index:1; }

    .auth-header { background:linear-gradient(135deg,var(--sky-deep) 0%,var(--sky) 100%); padding:32px; text-align:center; position:relative; overflow:hidden; }
    .auth-header::before { content:''; position:absolute; top:-40px; right:-40px; width:140px; height:140px; background:rgba(255,255,255,0.07); border-radius:50%; }
    .auth-logo-icon { width:56px; height:56px; background:rgba(255,255,255,0.15); border:2px solid rgba(255,255,255,0.25); border-radius:16px; display:flex; align-items:center; justify-content:center; margin:0 auto 14px; font-size:1.4rem; color:white; position:relative; z-index:1; }
    .auth-header h2 { font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:800; color:white; margin-bottom:5px; position:relative; z-index:1; }
    .auth-header p { color:rgba(255,255,255,0.75); font-size:0.83rem; position:relative; z-index:1; }

    .auth-body { padding:30px 32px; }

    .form-group { margin-bottom:16px; }
    .form-label { display:flex; align-items:center; gap:6px; font-size:0.82rem; font-weight:600; color:var(--text-dark); margin-bottom:6px; }
    .form-label i { color:var(--sky); font-size:0.78rem; }
    .form-input { width:100%; padding:11px 16px; border:2px solid var(--sky-light); border-radius:12px; font-family:'DM Sans',sans-serif; font-size:0.88rem; color:var(--text-dark); background:#f8fafc; outline:none; transition:all 0.25s; box-sizing:border-box; }
    .form-input:focus { border-color:var(--sky-mid); background:white; box-shadow:0 0 0 4px rgba(14,165,233,0.1); }
    .form-input::placeholder { color:#94a3b8; }

    .strength-bar { height:4px; background:#e2e8f0; border-radius:2px; margin-top:8px; overflow:hidden; }
    .strength-fill { height:100%; border-radius:2px; transition:all 0.4s; width:0%; }

    .terms-label { display:flex; align-items:flex-start; gap:10px; cursor:pointer; color:#64748b; font-size:0.83rem; font-weight:500; }
    .terms-label input[type="checkbox"] { width:16px; height:16px; accent-color:var(--sky-dark); cursor:pointer; margin-top:2px; flex-shrink:0; }
    .terms-label a { color:var(--sky-dark); font-weight:600; text-decoration:none; }

    .btn-submit { width:100%; padding:14px; background:linear-gradient(135deg,var(--sky-dark),var(--sky)); color:white; border:none; border-radius:14px; font-family:'DM Sans',sans-serif; font-size:0.95rem; font-weight:700; cursor:pointer; transition:all 0.25s; box-shadow:0 6px 20px rgba(14,165,233,0.3); display:flex; align-items:center; justify-content:center; gap:8px; margin-top:20px; }
    .btn-submit:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(14,165,233,0.4); }

    .auth-footer { text-align:center; margin-top:22px; padding-top:18px; border-top:2px solid var(--sky-light); font-size:0.83rem; color:#64748b; }
    .auth-footer a { color:var(--sky-dark); font-weight:700; text-decoration:none; }
    .auth-footer a:hover { color:var(--sky); }

    .perks-row { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:22px; }
    .perk-item { display:flex; align-items:center; gap:7px; padding:10px 12px; background:var(--sky-light); border-radius:10px; font-size:0.78rem; font-weight:500; color:var(--sky-dark); }

    .input-wrap { position:relative; }
    .input-icon { position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#cbd5e1; cursor:pointer; font-size:0.88rem; transition:color 0.2s; }
    .input-icon:hover { color:var(--sky-dark); }

    .alert-error { display:flex; align-items:center; gap:8px; background:#fef2f2; border:2px solid #fca5a5; color:#dc2626; padding:12px 16px; border-radius:12px; font-size:0.83rem; margin-bottom:18px; }
</style>

<div class="auth-wrap">
    <div class="auth-card">

        <!-- Header -->
        <div class="auth-header">
            <div class="auth-logo-icon"><i class="fa-solid fa-user-plus"></i></div>
            <h2>Create Account</h2>
            <p>Join Eurowide and start ordering wholesale</p>
        </div>

        <div class="auth-body">

            @if($errors->any())
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Perks -->
            <div class="perks-row">
                <div class="perk-item"><i class="fa-solid fa-tags"></i> Wholesale Prices</div>
                <div class="perk-item"><i class="fa-solid fa-truck-fast"></i> Fast Delivery</div>
                <div class="perk-item"><i class="fa-solid fa-boxes-stacked"></i> Bulk Orders</div>
                <div class="perk-item"><i class="fa-solid fa-headset"></i> 24/7 Support</div>
            </div>

            <form method="POST" action="/register">
                @csrf
                <input type="hidden" name="role" value="customer">

                <!-- Full Name -->
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-user"></i> Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Enter your full name" value="{{ old('name') }}" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-lock"></i> Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="passwordInput" class="form-input" placeholder="Create a strong password" oninput="checkStrength(this.value)" required style="padding-right:44px;">
                        <i class="fa-regular fa-eye input-icon" id="togglePwd" onclick="togglePassword()"></i>
                    </div>
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <p id="strengthText" style="font-size:0.72rem; margin-top:4px; color:#94a3b8;"></p>
                </div>

                <!-- Terms -->
                <div style="margin-bottom:4px;">
                    <label class="terms-label">
                        <input type="checkbox" required>
                        <span>I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></span>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-user-plus"></i> Create Account
                </button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="/login">Login here →</a>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const inp = document.getElementById('passwordInput');
        const icon = document.getElementById('togglePwd');
        inp.type = inp.type === 'password' ? 'text' : 'password';
        icon.className = inp.type === 'text' ? 'fa-regular fa-eye-slash input-icon' : 'fa-regular fa-eye input-icon';
    }

    function checkStrength(val) {
        const fill = document.getElementById('strengthFill');
        const text = document.getElementById('strengthText');
        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { pct: '0%', color: '', label: '' },
            { pct: '25%', color: '#ef4444', label: 'Weak' },
            { pct: '50%', color: '#f59e0b', label: 'Fair' },
            { pct: '75%', color: '#3b82f6', label: 'Good' },
            { pct: '100%', color: '#22c55e', label: 'Strong' },
        ];

        fill.style.width = levels[score].pct;
        fill.style.background = levels[score].color;
        text.textContent = val.length ? levels[score].label : '';
        text.style.color = levels[score].color;
    }
</script>

@endsection