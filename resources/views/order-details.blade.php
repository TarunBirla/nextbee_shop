{{-- ══════════════════════════════════════════════
    ShopZone · order-detail.blade.php
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
    --accent-dk: #030738; 

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
.brand-sub { font-size: 0.65rem; color: rgba(255,255,255,0.35); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 1px; }
.nav-section { padding: 10px 14px 4px; }
.nav-section-label { font-size: 0.6rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.25); padding: 8px 8px 4px; }
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

/* TOPBAR */
.topbar {
    padding: 18px 36px;
    border-bottom: 1px solid var(--line);
    background: var(--surface);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}
.topbar-left { display: flex; align-items: center; gap: 12px; }
.back-link {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.8rem; font-weight: 500; color: var(--ink-muted);
    text-decoration: none;
    transition: color 0.15s;
}
.back-link svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; }
.back-link:hover { color: var(--ink); }
.topbar-divider { width: 1px; height: 18px; background: var(--line); }
.topbar-heading { font-family: 'DM Serif Display', serif; font-size: 1.2rem; color: var(--ink); line-height: 1; }
.topbar-actions { display: flex; align-items: center; gap: 10px; }
.status-pill {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.73rem; font-weight: 500;
    color: var(--amber);
    background: var(--amber-bg);
    border: 1px solid #fde68a;
    padding: 4px 11px;
    border-radius: 100px;
}
.status-pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; }
.reorder-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 8px 16px;
    background: var(--ink); color: #fff;
    border: none; border-radius: var(--radius-sm);
    font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 500;
    cursor: pointer; transition: background 0.15s, transform 0.1s;
}
.reorder-btn svg { width: 13px; height: 13px; fill: none; stroke: currentColor; stroke-width: 2; }
.reorder-btn:hover { background: #1e293b; transform: translateY(-1px); }

/* CONTENT */
.content-area {
    flex: 1;
    padding: 24px 36px 48px;
    max-width: 780px;
}

/* ORDER SUMMARY BAR */
.order-summary-bar {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 14px 18px;
    display: flex;
    gap: 28px;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
}
.osb-item { display: flex; flex-direction: column; gap: 2px; }
.osb-label { font-size: 0.68rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--ink-muted); }
.osb-val { font-size: 0.88rem; font-weight: 500; color: var(--ink); }
.osb-divider { width: 1px; height: 28px; background: var(--line); }
.osb-total { margin-left: auto; text-align: right; }
.osb-total .osb-label { text-align: right; }
.osb-total .osb-val { font-family: 'DM Serif Display', serif; font-size: 1.3rem; color: var(--ink); }

/* ITEMS */
.items-section-label {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--ink-muted);
    margin-bottom: 12px;
}

.product-row {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 14px;
    margin-bottom: 10px;
    transition: border-color 0.15s, box-shadow 0.15s;
    position: relative;
    overflow: hidden;
}
.product-row::before {
    content: '';
    position: absolute; left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--accent);
    opacity: 0;
    transition: opacity 0.15s;
}
.product-row:hover { border-color: #c3d9ff; }
.product-row:hover::before { opacity: 1; }

.product-row-img {
    width: 72px; height: 72px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 1px solid var(--line);
    flex-shrink: 0;
    background: var(--canvas);
}
.product-row-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.25s; }
.product-row:hover .product-row-img img { transform: scale(1.05); }

.product-row-body { flex: 1; min-width: 0; }
.product-row-name { font-size: 0.95rem; font-weight: 500; color: var(--ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 5px; }
.qty-tag {
    display: inline-block;
    font-size: 0.72rem; font-weight: 500;
    color: var(--ink-soft);
    background: var(--canvas);
    border: 1px solid var(--line);
    padding: 2px 10px; border-radius: 100px;
}
.product-row-price {
    font-family: 'DM Serif Display', serif;
    font-size: 1.1rem;
    color: var(--ink);
    flex-shrink: 0;
}

.empty-state {
    background: var(--surface);
    border: 1.5px dashed var(--line);
    border-radius: var(--radius-lg);
    padding: 48px 24px;
    text-align: center;
}
.empty-icon { width: 46px; height: 46px; background: var(--canvas); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; }
.empty-icon svg { width: 20px; height: 20px; fill: none; stroke: var(--ink-muted); stroke-width: 1.5; }
.empty-text { font-size: 0.88rem; color: var(--ink-muted); }

@media (max-width: 700px) {
    .sidebar { display: none; }
    .page-shell { margin-left: 0; }
    .topbar, .content-area { padding-left: 18px; padding-right: 18px; }
    .order-summary-bar { gap: 16px; }
    .osb-total { margin-left: 0; }
    .topbar-heading { font-size: 1rem; }
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
        <a href="/profile" class="nav-link"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>My Profile</a>
        <a href="/products" class="nav-link"><svg viewBox="0 0 24 24"><rect x="2" y="3" width="9" height="9" rx="1"/><rect x="13" y="3" width="9" height="9" rx="1"/><rect x="2" y="13" width="9" height="9" rx="1"/><rect x="13" y="13" width="9" height="9" rx="1"/></svg>Browse Products</a>
    </div>
    <div class="nav-section">
        <div class="nav-section-label">Orders</div>
        <a href="/cart" class="nav-link"><svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>My Cart</a>
        <a href="/my-orders" class="nav-link active"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>My Orders</a>
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

    <div class="topbar">
        <div class="topbar-left">
            <a href="/my-orders" class="back-link">
                <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                Orders
            </a>
            <div class="topbar-divider"></div>
            <div class="topbar-heading">Order #{{ $order->id }}</div>
        </div>
        <div class="topbar-actions">
            <span class="status-pill">{{ $order->status }}</span>
            <form action="/reorder/{{ $order->id }}" method="POST">
                @csrf
                <button type="submit" class="reorder-btn">
                    <svg viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
                    Reorder
                </button>
            </form>
        </div>
    </div>

    <div class="content-area">

        <div class="order-summary-bar">
            <div class="osb-item">
                <span class="osb-label">Order ID</span>
                <span class="osb-val">#{{ $order->id }}</span>
            </div>
            <div class="osb-divider"></div>
            <div class="osb-item">
                <span class="osb-label">Placed</span>
                <span class="osb-val">{{ $order->created_at->format('d M Y') }}</span>
            </div>
            <div class="osb-divider"></div>
            <div class="osb-item">
                <span class="osb-label">Items</span>
                <span class="osb-val">{{ count($order->items) }}</span>
            </div>
            <div class="osb-item osb-total">
                <span class="osb-label">Total</span>
                <span class="osb-val">£{{ number_format($order->total_price, 2) }}</span>
            </div>
        </div>

        <div class="items-section-label">Items in this order</div>

        @forelse($order->items as $item)
            @if($item->product)
                <div class="product-row">
                    <div class="product-row-img">
                        <img src="/uploads/{{ $item->product->image }}" alt="{{ $item->product->title }}">
                    </div>
                    <div class="product-row-body">
                        <div class="product-row-name">{{ $item->product->title }}</div>
                        <span class="qty-tag">Qty {{ $item->quantity }}</span>
                    </div>
                    <div class="product-row-price">£{{ number_format($item->product->price * $item->quantity, 2) }}</div>
                </div>
            @endif
        @empty
            <div class="empty-state">
                <div class="empty-icon"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/></svg></div>
                <div class="empty-text">No products found in this order.</div>
            </div>
        @endforelse

    </div>
</div>
