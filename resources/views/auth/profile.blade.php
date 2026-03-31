{{-- ══════════════════════════════════════════════
    ShopZone · profile.blade.php
    Redesigned with a refined, editorial aesthetic
══════════════════════════════════════════════ --}}

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    /* PRIMARY SKY COLORS */
    --ink:       #0ea5e9;   /* sky */
    --ink-soft:  #58abe3;   /* sky light */
    --ink-muted: #38bdf8;   /* sky mid */

    /* BACKGROUND */
    --canvas:    #f0f9ff;   /* light bg */
    --surface:   #ffffff;   /* cards */
    --line:      #bae6fd;   /* borders */

    /* BUTTON / ACCENT */
    --accent:    #080846;   /* amber */
    --accent-bg: #fef3c7;   /* light amber */
    --accent-dk: #030738;   /* darker amber hover */

    /* TEXT */
    --text-dark: #0c2340;
    --text-mid:  #374151;

    /* STATUS */
    --green:     #16a34a;
    --green-bg:  #dcfce7;

    --red:       #dc2626;
    --red-bg:    #fee2e2;

    /* SIDEBAR */
    --sidebar-w: 230px;

    /* RADIUS */
    --radius-sm: 6px;
    --radius:    12px;
    --radius-lg: 18px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'DM Sans', sans-serif; background: var(--canvas); color: var(--ink); -webkit-font-smoothing: antialiased; }

/* SIDEBAR */
.sidebar { position: fixed; top: 0; left: 0; bottom: 0; width: var(--sidebar-w); background: var(--ink); display: flex; flex-direction: column; z-index: 200; }
.sidebar-brand { padding: 28px 22px 24px; border-bottom: 1px solid rgba(255,255,255,0.08); }
.brand-mark { display: flex; align-items: center; gap: 10px; }
.brand-icon { width: 34px; height: 34px; background: var(--accent); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.brand-icon svg { width: 18px; height: 18px; fill: none; stroke: #fff; stroke-width: 2; }
.brand-name { font-family: 'DM Serif Display', serif; font-size: 1.1rem; color: #fff; }
.brand-sub { font-size: 0.65rem; color: #fff; letter-spacing: 0.1em; text-transform: uppercase; margin-top: 1px; }
.nav-section { padding: 10px 14px 4px; }
.nav-section-label { font-size: 0.6rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: #fff; padding: 8px 8px 4px; }
.nav-link { display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: var(--radius-sm); color: #fff; text-decoration: none; font-size: 0.84rem; font-weight: 400; transition: color 0.15s, background 0.15s; position: relative; }
.nav-link svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 1.8; flex-shrink: 0; }
.nav-link:hover { color: rgba(255,255,255,0.85); background: rgba(255,255,255,0.05); }
.nav-link.active { color: #fff; background: rgba(26,86,219,0.25); font-weight: 500; }
.nav-link.active::before { content: ''; position: absolute; left: 0; top: 12%; bottom: 12%; width: 2px; background: var(--accent); border-radius: 0 2px 2px 0; }
.sidebar-spacer { flex: 1; }
.sidebar-user { margin: 12px 14px; padding: 12px; border-radius: var(--radius-sm); background: rgba(255,255,255,0.05); display: flex; align-items: center; gap: 10px; border: 1px solid rgba(255,255,255,0.07); }
.user-initials { width: 32px; height: 32px; background: var(--accent); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 600; color: #fff; flex-shrink: 0; }
.user-info-name { font-size: 0.82rem; font-weight: 500; color: #fff; line-height: 1.2; }
.user-info-role { font-size: 0.68rem; color: rgba(255,255,255,0.35); }

/* PAGE */
.page-shell { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

/* PROFILE HERO */
.profile-hero {
    background: var(--ink);
    padding: 32px 36px 48px;
    position: relative;
    overflow: hidden;
}
.profile-hero::after {
    content: '';
    position: absolute;
    right: -40px; bottom: -60px;
    width: 240px; height: 240px;
    border: 60px solid rgba(255,255,255,0.03);
    border-radius: 50%;
    pointer-events: none;
}
.hero-flex {
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative; z-index: 1;
}
.hero-avatar {
    width: 68px; height: 68px;
    background: var(--accent);
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    font-family: 'DM Serif Display', serif;
    font-size: 1.5rem;
    color: #fff;
    flex-shrink: 0;
    border: 2px solid rgba(255,255,255,0.15);
}
.hero-info h2 {
    font-family: 'DM Serif Display', serif;
    font-size: 1.5rem;
    color: #fff;
    line-height: 1.1;
}
.hero-info p { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin-top: 4px; }
.hero-badges {
    margin-left: auto;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 6px;
}
.hero-pill {
    font-size: 0.7rem;
    font-weight: 500;
    color: rgba(255,255,255,0.55);
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    padding: 4px 12px;
    border-radius: 100px;
    display: flex; align-items: center; gap: 5px;
}
.hero-pill svg { width: 11px; height: 11px; fill: none; stroke: currentColor; stroke-width: 1.8; }

/* MAIN CONTENT */
.content-area {
    flex: 1;
    padding: 28px 36px 48px;
    max-width: 860px;
    margin-top: -20px;
}

.alert-success {
    display: flex; align-items: center; gap: 8px;
    background: var(--green-bg); border: 1px solid #c6f6d5;
    color: var(--green); padding: 10px 14px; border-radius: var(--radius-sm);
    font-size: 0.83rem; font-weight: 500; margin-bottom: 18px;
}
.alert-success svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 2; }

/* STATS ROW */
.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}
.stat-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 16px 18px;
}
.stat-num {
    font-family: 'DM Serif Display', serif;
    font-size: 1.6rem;
    color: var(--ink);
    line-height: 1;
}
.stat-label {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--ink-muted);
    margin-top: 5px;
}

/* GRID */
.profile-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.info-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    overflow: hidden;
}
.card-header {
    padding: 14px 18px;
    border-bottom: 1px solid var(--line);
    display: flex; align-items: center; gap: 10px;
}
.card-header-icon {
    width: 28px; height: 28px;
    background: var(--canvas);
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.card-header-icon svg { width: 13px; height: 13px; fill: none; stroke: var(--ink-soft); stroke-width: 1.8; }
.card-header-title {
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--ink-muted);
}
.card-body { padding: 14px 18px; }

.info-row {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--line);
}
.info-row:last-child { border-bottom: none; }
.info-label {
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    flex: 0 0 68px;
    padding-top: 1px;
}
.info-value { font-size: 0.88rem; color: var(--ink); font-weight: 400; flex: 1; }
.verified-badge {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--green);
    background: var(--green-bg);
    border: 1px solid #c6f6d5;
    padding: 2px 9px;
    border-radius: 100px;
}
.verified-badge svg { width: 10px; height: 10px; fill: none; stroke: currentColor; stroke-width: 2.5; }

.btn-edit {
    display: inline-flex; align-items: center; gap: 7px;
    margin-top: 14px;
    padding: 9px 18px;
    background: var(--ink);
    color: #fff;
    border: none;
    border-radius: var(--radius-sm);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.82rem; font-weight: 500;
    cursor: pointer;
    transition: background 0.15s;
}
.btn-edit svg { width: 13px; height: 13px; fill: none; stroke: currentColor; stroke-width: 2; }
.btn-edit:hover { background: #1e293b; }

/* QUICK LINKS */
.links-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.quick-link {
    display: flex; align-items: center; gap: 9px;
    padding: 10px 12px;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    text-decoration: none;
    color: var(--ink-soft);
    font-size: 0.82rem;
    font-weight: 400;
    transition: border-color 0.15s, background 0.15s, color 0.15s;
    background: var(--canvas);
}
.quick-link svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 1.8; flex-shrink: 0; }
.quick-link:hover { border-color: #c3d9ff; background: var(--accent-bg); color: var(--accent); }

.logout-strip {
    margin-top: 10px;
    padding: 10px 12px;
    border: 1px solid #fecaca;
    border-radius: var(--radius-sm);
    background: var(--red-bg);
    display: flex; align-items: center; justify-content: space-between;
}
.logout-strip span { font-size: 0.8rem; color: var(--red); font-weight: 500; }
.btn-logout {
    padding: 6px 14px;
    background: var(--red);
    color: #fff;
    border: none;
    border-radius: var(--radius-sm);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.15s;
}
.btn-logout:hover { background: #9b2c2c; }

/* MODAL */
.modal-overlay { position: fixed; inset: 0; background: rgba(15,25,35,0.55); display: none; align-items: center; justify-content: center; z-index: 500; padding: 20px; backdrop-filter: blur(3px); }
.modal-overlay.show { display: flex; }
.modal-box { background: var(--surface); border-radius: var(--radius-lg); width: 100%; max-width: 420px; overflow: hidden; border: 1px solid var(--line); box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
.modal-head { padding: 18px 22px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; }
.modal-head h3 { font-family: 'DM Serif Display', serif; font-size: 1.15rem; color: var(--ink); }
.modal-close { width: 28px; height: 28px; background: var(--canvas); border: 1px solid var(--line); border-radius: var(--radius-sm); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.15s; }
.modal-close:hover { background: var(--line); }
.modal-close svg { width: 13px; height: 13px; fill: none; stroke: var(--ink-soft); stroke-width: 2; }
.modal-body { padding: 20px 22px; display: flex; flex-direction: column; gap: 14px; }
.form-group { display: flex; flex-direction: column; gap: 5px; }
.form-label { font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.07em; color: var(--ink-muted); }
.form-input { width: 100%; padding: 9px 12px; border: 1px solid var(--line); border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 0.88rem; color: var(--ink); background: var(--canvas); outline: none; transition: border-color 0.15s, background 0.15s, box-shadow 0.15s; }
.form-input:focus { border-color: var(--accent); background: var(--surface); box-shadow: 0 0 0 3px rgba(26,86,219,0.1); }
.form-input::placeholder { color: var(--ink-muted); }
.modal-foot { padding: 14px 22px; border-top: 1px solid var(--line); display: flex; gap: 8px; }
.btn-cancel { padding: 9px 16px; background: var(--canvas); border: 1px solid var(--line); border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 500; cursor: pointer; color: var(--ink-soft); transition: background 0.15s; }
.btn-cancel:hover { background: var(--line); }
.btn-save { flex: 1; padding: 9px; background: var(--ink); border: none; border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 0.85rem; font-weight: 500; color: #fff; cursor: pointer; transition: background 0.15s; }
.btn-save:hover { background: #1e293b; }

@media (max-width: 800px) {
    .sidebar { display: none; }
    .page-shell { margin-left: 0; }
    .profile-grid { grid-template-columns: 1fr; }
    .stats-row { grid-template-columns: repeat(3,1fr); }
    .content-area { padding: 20px 18px 40px; }
    .profile-hero { padding: 24px 18px 40px; }
    .hero-flex { flex-wrap: wrap; }
    .hero-badges { margin-left: 0; flex-direction: row; }
}
</style>

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-mark">
            <div class="brand-icon"><svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg></div>
            <div><div class="brand-name">ShopZone</div><div class="brand-sub">Customer Portal</div></div>
        </div>
    </div>
    <div class="nav-section">
        <div class="nav-section-label">Account</div>
        <a href="/profile" class="nav-link active"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>My Profile</a>
        <a href="/products" class="nav-link"><svg viewBox="0 0 24 24"><rect x="2" y="3" width="9" height="9" rx="1"/><rect x="13" y="3" width="9" height="9" rx="1"/><rect x="2" y="13" width="9" height="9" rx="1"/><rect x="13" y="13" width="9" height="9" rx="1"/></svg>Browse Products</a>
    </div>
    <div class="nav-section">
        <div class="nav-section-label">Orders</div>
        <a href="/cart" class="nav-link"><svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>My Cart</a>
        <a href="/my-orders" class="nav-link"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>My Orders</a>
    </div>
    <div class="nav-section">
        <div class="nav-section-label">Support</div>
        <a href="/contacts" class="nav-link"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .82h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>Contact Us</a>
    </div>
    <div class="sidebar-spacer"></div>
    <div class="sidebar-user">
        <div class="user-initials">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}</div>
        <div><div class="user-info-name">{{ auth()->user()->name ?? 'User' }}</div><div class="user-info-role">Customer</div></div>
    </div>
</div>

<div class="page-shell">

    <div class="profile-hero">
        <div class="hero-flex">
            <div class="hero-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
            <div class="hero-info">
                <h2>{{ auth()->user()->name }}</h2>
                <p>{{ auth()->user()->email }}</p>
            </div>
            <div class="hero-badges">
                <span class="hero-pill"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Verified</span>
                <span class="hero-pill"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>Member since 2024</span>
            </div>
        </div>
    </div>

    <div class="content-area">

        @if(session('success'))
            <div class="alert-success"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>{{ session('success') }}</div>
        @endif

        <div class="stats-row">
            <div class="stat-card"><div class="stat-num">0</div><div class="stat-label">Orders</div></div>
            <div class="stat-card"><div class="stat-num">0</div><div class="stat-label">Cart Items</div></div>
            <div class="stat-card"><div class="stat-num">£0</div><div class="stat-label">Total Spent</div></div>
        </div>

        <div class="profile-grid">

            {{-- Account Info --}}
            <div class="info-card">
                <div class="card-header">
                    <div class="card-header-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></div>
                    <span class="card-header-title">Account Information</span>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <span class="info-label">Name</span>
                        <span class="info-value">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            <span class="verified-badge">
                                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                Verified
                            </span>
                        </span>
                    </div>
                    <button class="btn-edit" onclick="openModal()">
                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Profile
                    </button>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="info-card">
                <div class="card-header">
                    <div class="card-header-icon"><svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                    <span class="card-header-title">Quick Links</span>
                </div>
                <div class="card-body">
                    <div class="links-grid">
                        <a href="/cart" class="quick-link"><svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>My Cart</a>
                        <a href="/my-orders" class="quick-link"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>My Orders</a>
                        <a href="/products" class="quick-link"><svg viewBox="0 0 24 24"><rect x="2" y="3" width="9" height="9" rx="1"/><rect x="13" y="3" width="9" height="9" rx="1"/><rect x="2" y="13" width="9" height="9" rx="1"/><rect x="13" y="13" width="9" height="9" rx="1"/></svg>Browse</a>
                        <a href="/contacts" class="quick-link"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .82h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>Support</a>
                    </div>
                    <div class="logout-strip">
                        <span>Sign out of your account</span>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn-logout">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <h3>Edit Profile</h3>
            <button class="modal-close" onclick="closeModal()"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <form action="/profile/update" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" value="{{ auth()->user()->name }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" value="{{ auth()->user()->email }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">New Password <span style="text-transform:none;letter-spacing:0;font-weight:400;color:var(--ink-muted);">(optional)</span></label>
                    <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current">
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() { document.getElementById('editModal').classList.add('show'); document.body.style.overflow='hidden'; }
function closeModal() { document.getElementById('editModal').classList.remove('show'); document.body.style.overflow=''; }
document.getElementById('editModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });
</script>
