

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

body {
    font-family: 'DM Sans', sans-serif;
    background: var(--canvas);
    color: var(--ink);
    -webkit-font-smoothing: antialiased;
}

/* ── SIDEBAR ── */
.sidebar {
    position: fixed;
    top: 0; left: 0; bottom: 0;
    width: var(--sidebar-w);
    background: var(--ink);
    display: flex;
    flex-direction: column;
    z-index: 200;
    border-right: 1px solid rgba(255,255,255,0.05);
}

.sidebar-brand {
    padding: 28px 22px 24px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
.brand-mark {
    display: flex;
    align-items: center;
    gap: 10px;
}
.brand-icon {
    width: 34px; height: 34px;
    background: var(--accent);
    border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.brand-icon svg { width: 18px; height: 18px; fill: none; stroke: #fff; stroke-width: 2; }
.brand-name {
    font-family: 'DM Serif Display', serif;
    font-size: 1.1rem;
    color: #fff;
    letter-spacing: 0.01em;
}
.brand-sub {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.35);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-top: 1px;
}

.nav-section {
    padding: 10px 14px 4px;
}
.nav-section-label {
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.25);
    padding: 8px 8px 4px;
}
.nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 10px;
    border-radius: var(--radius-sm);
    color: #fff;
    text-decoration: none;
    font-size: 0.84rem;
    font-weight: 400;
    transition: color 0.15s, background 0.15s;
}
.nav-link svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 1.8; flex-shrink: 0; }
.nav-link:hover { color: rgba(255,255,255,0.85); background: rgba(255,255,255,0.05); }
.nav-link.active {
    color: #fff;
    background: rgba(26,86,219,0.25);
    font-weight: 500;
}
.nav-link.active::before {
    content: '';
    position: absolute;
    left: 0; top: 12%; bottom: 12%;
    width: 2px;
    background: var(--accent);
    border-radius: 0 2px 2px 0;
}
.nav-link { position: relative; }

.sidebar-spacer { flex: 1; }

.sidebar-user {
    margin: 12px 14px;
    padding: 12px;
    border-radius: var(--radius-sm);
    background: rgba(255,255,255,0.05);
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid rgba(255,255,255,0.07);
}
.user-initials {
    width: 32px; height: 32px;
    background: var(--accent);
    border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem;
    font-weight: 600;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: 0.03em;
}
.user-info-name { font-size: 0.82rem; font-weight: 500; color: #fff; line-height: 1.2; }
.user-info-role { font-size: 0.68rem; color: rgba(255,255,255,0.35); }

/* ── LAYOUT ── */
.page-shell {
    margin-left: var(--sidebar-w);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ── TOP BAR ── */
.topbar {
    padding: 22px 36px 20px;
    border-bottom: 1px solid var(--line);
    background: var(--surface);
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
}
.topbar-heading {
    font-family: 'DM Serif Display', serif;
    font-size: 1.75rem;
    color: var(--ink);
    line-height: 1;
}
.topbar-sub {
    font-size: 0.82rem;
    color: var(--ink-muted);
    margin-top: 4px;
}
.topbar-badge {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--accent);
    background: var(--accent-bg);
    padding: 4px 12px;
    border-radius: 100px;
    border: 1px solid #c3d9ff;
}

/* ── CONTENT ── */
.content-area {
    flex: 1;
    padding: 28px 36px 48px;
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 24px;
    align-items: start;
}

/* ── CART ITEMS ── */
.items-col { display: flex; flex-direction: column; gap: 12px; }

.cart-item {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.cart-item:hover {
    border-color: #c3d9ff;
    box-shadow: 0 2px 12px rgba(26,86,219,0.06);
}

.item-img-wrap {
    width: 82px; height: 82px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 1px solid var(--line);
    flex-shrink: 0;
    background: var(--canvas);
}
.item-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
}

.item-body { flex: 1; min-width: 0; }
.item-name {
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--ink);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.item-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 6px;
}
.qty-tag {
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--ink-soft);
    background: var(--canvas);
    border: 1px solid var(--line);
    padding: 2px 10px;
    border-radius: 100px;
}
.item-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
    flex-shrink: 0;
}
.item-price {
    font-family: 'DM Serif Display', serif;
    font-size: 1.15rem;
    color: var(--ink);
}
.remove-btn {
    font-size: 0.73rem;
    font-weight: 500;
    color: var(--red);
    background: none;
    border: 1px solid #fecaca;
    padding: 4px 12px;
    border-radius: 100px;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
    display: inline-flex; align-items: center; gap: 5px;
}
.remove-btn svg { width: 11px; height: 11px; fill: none; stroke: currentColor; stroke-width: 2; }
.remove-btn:hover { background: var(--red); color: #fff; border-color: var(--red); }

.empty-state {
    background: var(--surface);
    border: 1.5px dashed var(--line);
    border-radius: var(--radius-lg);
    padding: 56px 24px;
    text-align: center;
}
.empty-icon {
    width: 52px; height: 52px;
    margin: 0 auto 14px;
    background: var(--canvas);
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
}
.empty-icon svg { width: 24px; height: 24px; fill: none; stroke: var(--ink-muted); stroke-width: 1.5; }
.empty-title { font-size: 0.95rem; font-weight: 500; color: var(--ink); }
.empty-sub { font-size: 0.82rem; color: var(--ink-muted); margin-top: 4px; }
.browse-link {
    display: inline-block;
    margin-top: 16px;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--accent);
    text-decoration: none;
    border-bottom: 1px solid currentColor;
}

/* ── SUMMARY ── */
.summary-panel {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    overflow: hidden;
    position: sticky;
    top: 24px;
}
.summary-head {
    padding: 18px 20px;
    border-bottom: 1px solid var(--line);
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--ink-muted);
}
.summary-body { padding: 16px 20px; }
.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 9px 0;
    font-size: 0.88rem;
    color: var(--ink-soft);
    border-bottom: 1px solid var(--line);
}
.summary-row:last-of-type { border-bottom: none; }
.summary-row .label { color: var(--ink-soft); }
.summary-row .val { font-weight: 500; color: var(--ink); }
.free-pill {
    font-size: 0.68rem;
    font-weight: 600;
    color: var(--green);
    background: var(--green-bg);
    padding: 2px 9px;
    border-radius: 100px;
    border: 1px solid #c6f6d5;
}
.summary-total {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 16px 20px;
    border-top: 2px solid var(--ink);
}
.total-label {
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--ink-soft);
}
.total-amount {
    font-family: 'DM Serif Display', serif;
    font-size: 1.5rem;
    color: var(--ink);
}
.order-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: calc(100% - 40px);
    margin: 0 20px 20px;
    padding: 13px;
    background: var(--ink);
    color: #fff;
    border: none;
    border-radius: var(--radius-sm);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.15s, transform 0.1s;
    letter-spacing: 0.01em;
}
.order-btn svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 2; }
.order-btn:hover { background: #1e293b; transform: translateY(-1px); }
.order-btn:active { transform: translateY(0); }

.security-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 0 20px 16px;
    font-size: 0.72rem;
    color: var(--ink-muted);
}
.security-note svg { width: 12px; height: 12px; fill: none; stroke: currentColor; stroke-width: 2; }

@media (max-width: 900px) {
    .content-area { grid-template-columns: 1fr; }
    .summary-panel { position: static; }
}
@media (max-width: 700px) {
    .sidebar { display: none; }
    .page-shell { margin-left: 0; }
    .topbar, .content-area { padding-left: 18px; padding-right: 18px; }
}
</style>

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-mark">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            </div>
            <div>
                <div class="brand-name">ShopZone</div>
                <div class="brand-sub">Customer Portal</div>
            </div>
        </div>
    </div>

    <div class="nav-section">
        <div class="nav-section-label">Account</div>
        <a href="/profile" class="nav-link">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            My Profile
        </a>
        <a href="/products" class="nav-link">
            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="9" height="9" rx="1"/><rect x="13" y="3" width="9" height="9" rx="1"/><rect x="2" y="13" width="9" height="9" rx="1"/><rect x="13" y="13" width="9" height="9" rx="1"/></svg>
            Browse Products
        </a>
    </div>

    <div class="nav-section">
        <div class="nav-section-label">Orders</div>
        <a href="/cart" class="nav-link active">
            <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            My Cart
        </a>
        <a href="/my-orders" class="nav-link">
            <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
            My Orders
        </a>
    </div>

    <div class="nav-section">
        <div class="nav-section-label">Support</div>
        <a href="/contacts" class="nav-link">
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .82h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            Contact Us
        </a>
    </div>

    <div class="sidebar-spacer"></div>

    <div class="sidebar-user">
        <div class="user-initials">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}</div>
        <div>
            <div class="user-info-name">{{ auth()->user()->name ?? 'User' }}</div>
            <div class="user-info-role">Customer</div>
        </div>
    </div>
</div>

<div class="page-shell">

    <div class="topbar">
        <div>
            <div class="topbar-heading">My Cart</div>
            <div class="topbar-sub">Review your selections before checkout</div>
        </div>
        @php $itemCount = count($items); @endphp
        @if($itemCount > 0)
            <span class="topbar-badge">{{ $itemCount }} item{{ $itemCount > 1 ? 's' : '' }}</span>
        @endif
    </div>

    <div class="content-area">

        <div class="items-col">
            @php $total = 0; @endphp

            @forelse($items as $item)
                <div class="cart-item">
                    <div class="item-img-wrap">
                        <img src="/uploads/{{ $item->product->image }}" alt="{{ $item->product->title }}">
                    </div>
                    <div class="item-body">
                        <div class="item-name">{{ $item->product->title }}</div>
                        <div class="item-meta">
                            <span class="qty-tag">Qty {{ $item->quantity }}</span>
                            <span style="font-size:0.75rem; color:var(--ink-muted);">£{{ number_format($item->product->price, 2) }} each</span>
                        </div>
                    </div>
                    <div class="item-actions">
                        <span class="item-price">£{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        <a href="/remove-cart/{{ $item->id }}" class="remove-btn">
                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                            Remove
                        </a>
                    </div>
                </div>
                @php $total += $item->product->price * $item->quantity; @endphp
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
                    </div>
                    <div class="empty-title">Your cart is empty</div>
                    <div class="empty-sub">Browse our products and add something you love.</div>
                    <a href="/products" class="browse-link">Browse products →</a>
                </div>
            @endforelse
        </div>

        <aside>
            <div class="summary-panel">
                <div class="summary-head">Order Summary</div>
                <div class="summary-body">
                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span class="val">£{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Delivery</span>
                        <span class="free-pill">Free</span>
                    </div>
                    <div class="summary-row">
                        <span class="label">Taxes</span>
                        <span class="val">Included</span>
                    </div>
                </div>
                <div class="summary-total">
                    <span class="total-label">Total</span>
                    <span class="total-amount">£{{ number_format($total, 2) }}</span>
                </div>
                @if(count($items) > 0)
                    <form action="/place-order" method="POST">
                        @csrf
                        <button type="submit" class="order-btn">
                            <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            Place Order
                        </button>
                    </form>
                    <div class="security-note">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        Secure checkout · SSL encrypted
                    </div>
                @endif
            </div>
        </aside>

    </div>
</div>
