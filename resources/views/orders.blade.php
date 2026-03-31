
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
body { font-family: 'DM Sans', sans-serif; background: var(--canvas); color: var(--ink); -webkit-font-smoothing: antialiased; }

/* ── SIDEBAR (shared) ── */
.sidebar { position: fixed; top: 0; left: 0; bottom: 0; width: var(--sidebar-w); background: var(--ink); display: flex; flex-direction: column; z-index: 200; }
.sidebar-brand { padding: 28px 22px 24px; border-bottom: 1px solid rgba(255,255,255,0.08); }
.brand-mark { display: flex; align-items: center; gap: 10px; }
.brand-icon { width: 34px; height: 34px; background: var(--accent); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.brand-icon svg { width: 18px; height: 18px; fill: none; stroke: #fff; stroke-width: 2; }
.brand-name { font-family: 'DM Serif Display', serif; font-size: 1.1rem; color: #fff; }
.brand-sub { font-size: 0.65rem; color: #fff; letter-spacing: 0.1em; text-transform: uppercase; margin-top: 1px; }
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

/* ── PAGE SHELL ── */
.page-shell { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

.topbar {
    padding: 22px 36px 20px;
    border-bottom: 1px solid var(--line);
    background: var(--surface);
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
}
.topbar-heading { font-family: 'DM Serif Display', serif; font-size: 1.75rem; color: var(--ink); line-height: 1; }
.topbar-sub { font-size: 0.82rem; color: var(--ink-muted); margin-top: 4px; }
.topbar-actions { display: flex; align-items: center; gap: 10px; }
.order-count-pill {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--ink-soft);
    background: var(--canvas);
    border: 1px solid var(--line);
    padding: 5px 12px;
    border-radius: 100px;
}
.new-order-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 0.8rem;
    font-weight: 500;
    color: #fff;
    background: var(--ink);
    border: none;
    padding: 8px 16px;
    border-radius: var(--radius-sm);
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    transition: background 0.15s, transform 0.1s;
}
.new-order-btn svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; }
.new-order-btn:hover { background: #1e293b; transform: translateY(-1px); }

/* ── CONTENT ── */
.content-area { flex: 1; padding: 28px 36px 48px; }

.alert-success {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--green-bg);
    border: 1px solid #c6f6d5;
    color: var(--green);
    padding: 10px 14px;
    border-radius: var(--radius-sm);
    font-size: 0.83rem;
    font-weight: 500;
    margin-bottom: 18px;
}
.alert-success svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 2; flex-shrink: 0; }

/* ── TABLE CARD ── */
.table-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    overflow: hidden;
}
.table-card-head {
    padding: 16px 20px;
    border-bottom: 1px solid var(--line);
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.table-card-title {
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--ink-muted);
}
.orders-table { width: 100%; border-collapse: collapse; }
.orders-table thead th {
    padding: 10px 16px;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--ink-muted);
    text-align: left;
    background: var(--canvas);
    border-bottom: 1px solid var(--line);
}
.orders-table tbody tr {
    border-bottom: 1px solid var(--line);
    transition: background 0.12s;
    cursor: pointer;
}
.orders-table tbody tr:last-child { border-bottom: none; }
.orders-table tbody tr:hover { background: #fafafa; }
.orders-table td {
    padding: 14px 16px;
    font-size: 0.84rem;
    color: var(--ink-soft);
    vertical-align: middle;
}
.order-id-cell {
    font-family: 'DM Serif Display', serif;
    font-size: 0.95rem;
    color: var(--ink);
}
.items-chip {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--ink-soft);
    background: var(--canvas);
    border: 1px solid var(--line);
    padding: 3px 10px;
    border-radius: 100px;
}
.status-dot {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--amber);
    background: var(--amber-bg);
    border: 1px solid #fde68a;
    padding: 3px 10px;
    border-radius: 100px;
}
.status-dot::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
    flex-shrink: 0;
}
.price-cell {
    font-weight: 500;
    color: var(--ink);
    font-variant-numeric: tabular-nums;
}
.td-actions { display: flex; justify-content: flex-end; gap: 6px; }

.btn-view, .btn-open {
    font-size: 0.73rem;
    font-weight: 500;
    padding: 5px 12px;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: background 0.15s, color 0.15s;
    font-family: 'DM Sans', sans-serif;
    border: 1px solid var(--line);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}
.btn-view { background: var(--accent-bg); color: var(--accent); border-color: #c3d9ff; }
.btn-view:hover { background: var(--accent); color: #fff; border-color: var(--accent); }
.btn-open { background: var(--canvas); color: var(--ink-soft); }
.btn-open:hover { background: var(--ink); color: #fff; border-color: var(--ink); }

.empty-row td {
    padding: 52px 24px;
    text-align: center;
}
.empty-icon { width: 44px; height: 44px; background: var(--canvas); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; }
.empty-icon svg { width: 20px; height: 20px; fill: none; stroke: var(--ink-muted); stroke-width: 1.5; }
.empty-text { font-size: 0.85rem; color: var(--ink-muted); }

/* ── MODAL (Order Detail) ── */
.modal-overlay {
    position: fixed; inset: 0;
    background: rgba(15,25,35,0.55);
    display: none; align-items: center; justify-content: center;
    z-index: 500; padding: 20px;
    backdrop-filter: blur(3px);
}
.modal-overlay.show { display: flex; }
.modal-box {
    background: var(--surface);
    border-radius: var(--radius-lg);
    width: 100%; max-width: 580px;
    max-height: 88vh;
    overflow: hidden;
    display: flex; flex-direction: column;
    border: 1px solid var(--line);
    box-shadow: 0 24px 64px rgba(0,0,0,0.18);
}
.modal-head {
    padding: 20px 24px;
    border-bottom: 1px solid var(--line);
    display: flex; justify-content: space-between; align-items: flex-start;
}
.modal-head-left h3 {
    font-family: 'DM Serif Display', serif;
    font-size: 1.25rem;
    color: var(--ink);
}
.modal-head-left p { font-size: 0.78rem; color: var(--ink-muted); margin-top: 2px; }
.modal-close {
    width: 30px; height: 30px;
    background: var(--canvas);
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: background 0.15s;
}
.modal-close:hover { background: var(--line); }
.modal-close svg { width: 14px; height: 14px; fill: none; stroke: var(--ink-soft); stroke-width: 2; }

.modal-info-strip {
    padding: 10px 24px;
    background: var(--canvas);
    border-bottom: 1px solid var(--line);
    display: flex; gap: 20px; align-items: center; flex-wrap: wrap;
}
.info-chip { font-size: 0.78rem; color: var(--ink-soft); display: flex; align-items: center; gap: 5px; }
.info-chip svg { width: 13px; height: 13px; fill: none; stroke: currentColor; stroke-width: 1.8; color: var(--accent); }
.info-chip.total { font-weight: 600; color: var(--ink); font-size: 0.88rem; margin-left: auto; }

.modal-body { flex: 1; overflow-y: auto; padding: 20px 24px; }
.modal-items-label {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--ink-muted);
    margin-bottom: 12px;
}
.modal-item {
    display: flex; align-items: center; gap: 14px;
    padding: 12px;
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    margin-bottom: 8px;
    transition: border-color 0.15s;
}
.modal-item:hover { border-color: #c3d9ff; }
.modal-item-img { width: 56px; height: 56px; border-radius: var(--radius-sm); overflow: hidden; border: 1px solid var(--line); flex-shrink: 0; background: var(--canvas); }
.modal-item-img img { width: 100%; height: 100%; object-fit: cover; }
.modal-item-body { flex: 1; min-width: 0; }
.modal-item-name { font-size: 0.88rem; font-weight: 500; color: var(--ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.modal-item-qty { font-size: 0.73rem; color: var(--ink-muted); margin-top: 2px; }
.modal-item-price { font-weight: 500; color: var(--ink); font-size: 0.88rem; flex-shrink: 0; }

.modal-foot {
    padding: 14px 24px;
    border-top: 1px solid var(--line);
    display: flex; gap: 8px;
    background: var(--surface);
}
.btn-modal-close { flex: 0; padding: 10px 18px; background: var(--canvas); border: 1px solid var(--line); border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 500; cursor: pointer; color: var(--ink-soft); transition: background 0.15s; display: flex; align-items: center; gap: 5px; }
.btn-modal-close:hover { background: var(--line); }
.btn-reorder { flex: 1; padding: 10px; background: var(--ink); border: none; border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 0.85rem; font-weight: 500; color: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 7px; transition: background 0.15s; }
.btn-reorder svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; }
.btn-reorder:hover { background: #1e293b; }

/* ── NEW ORDER MODAL ── */
.product-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
.product-card {
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 12px;
    cursor: pointer;
    transition: border-color 0.15s, box-shadow 0.15s;
    position: relative;
    background: var(--surface);
}
.product-card:hover { border-color: #c3d9ff; }
.product-card.selected { border-color: var(--accent); border-width: 2px; background: var(--accent-bg); }
.product-card-check {
    position: absolute; top: 8px; right: 8px;
    width: 20px; height: 20px;
    background: var(--accent);
    border-radius: 50%;
    display: none; align-items: center; justify-content: center;
}
.product-card.selected .product-card-check { display: flex; }
.product-card-check svg { width: 10px; height: 10px; fill: none; stroke: #fff; stroke-width: 2.5; }
.product-card img { width: 100%; height: 72px; object-fit: cover; border-radius: var(--radius-sm); margin-bottom: 8px; border: 1px solid var(--line); }
.product-card-name { font-size: 0.82rem; font-weight: 500; color: var(--ink); margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.product-card-price { font-size: 0.85rem; font-weight: 600; color: var(--accent); }
.qty-row { display: flex; align-items: center; gap: 0; margin-top: 8px; border: 1px solid var(--line); border-radius: var(--radius-sm); overflow: hidden; width: fit-content; }
.qty-btn { width: 30px; height: 28px; background: var(--canvas); border: none; font-size: 1rem; color: var(--ink-soft); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.12s; font-weight: 500; }
.qty-btn:hover { background: var(--line); }
.qty-input { width: 38px; height: 28px; text-align: center; border: none; outline: none; font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 500; color: var(--ink); background: #fff; }
.order-mini-total {
    background: var(--canvas);
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}
.omt-label { font-size: 0.78rem; color: var(--ink-muted); }
.omt-val { font-family: 'DM Serif Display', serif; font-size: 1.2rem; color: var(--ink); }

.btn-place { flex: 1; padding: 10px; background: var(--ink); border: none; border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 0.85rem; font-weight: 500; color: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 7px; transition: background 0.15s; }
.btn-place:hover:not(:disabled) { background: #1e293b; }
.btn-place:disabled { opacity: 0.4; cursor: not-allowed; }
.btn-place svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; }
.product-card img {
    width: 100%;
    height: 80px;              /* small size */
    object-fit: contain;      /* FULL image show */
    background: #f8fafc;      /* light bg for empty space */
    border-radius: 8px;
    padding: 4px;             /* thoda spacing for better look */
    border: 1px solid var(--line);
}
@media (max-width: 700px) {
    .sidebar { display: none; }
    .page-shell { margin-left: 0; }
    .topbar, .content-area { padding-left: 18px; padding-right: 18px; }
    .product-grid { grid-template-columns: 1fr; }
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
        <div>
            <div class="user-info-name">{{ auth()->user()->name ?? 'User' }}</div>
            <div class="user-info-role">Customer</div>
        </div>
    </div>
</div>

<div class="page-shell">

    <div class="topbar">
        <div>
            <div class="topbar-heading">My Orders</div>
            <div class="topbar-sub">Track and manage your purchases</div>
        </div>
        <div class="topbar-actions">
            @if(isset($orders) && count($orders) > 0)
                <span class="order-count-pill">{{ count($orders) }} order{{ count($orders) > 1 ? 's' : '' }}</span>
            @endif
            <button class="new-order-btn" onclick="openNewOrderModal()">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                New Order
            </button>
        </div>
    </div>

    <div class="content-area">

        @if(session('success'))
            <div class="alert-success">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card">
            <div class="table-card-head">
                <span class="table-card-title">Order History</span>
            </div>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="order-id-cell">#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td><span class="items-chip">{{ count($order->items) }} item{{ count($order->items) > 1 ? 's' : '' }}</span></td>
                            <td><span class="status-dot">{{ $order->status }}</span></td>
                            <td class="price-cell">£{{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <div class="td-actions">
                                    <button class="btn-view" onclick="openOrderDetail({{ $order->id }}, '{{ $order->created_at->format('d M Y, g:i A') }}', '{{ number_format($order->total_price, 2) }}')">View</button>
                                    <a href="{{ url('order/' . $order->id) }}" class="btn-open">Open</a>
                                </div>
                            </td>
                        </tr>

                        {{-- Hidden order items JSON --}}
                       <script type="application/json" id="order-items-{{ $order->id }}">
{!! json_encode($order->items->map(function($item){
    return [
        'title' => $item->product->title ?? '',
        'image' => $item->product->image ?? '',
        'price' => $item->product->price ?? 0,
        'quantity' => $item->quantity
    ];
})) !!}
</script>
                    @empty
                        <tr class="empty-row">
                            <td colspan="6">
                                <div class="empty-icon"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg></div>
                                <div class="empty-text">No orders yet. Start shopping!</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- ── ORDER DETAIL MODAL ── --}}
<div id="orderDetailModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-head-left">
                <h3>Order <span id="md-order-id"></span></h3>
                <p id="md-order-date"></p>
            </div>
            <button class="modal-close" onclick="closeOrderDetail()"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <div class="modal-info-strip">
            <div class="info-chip">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Processing
            </div>
            <div class="info-chip total">£<span id="md-order-total"></span></div>
        </div>
        <div class="modal-body">
            <div class="modal-items-label">Items</div>
            <div id="md-items-container"></div>
        </div>
        <div class="modal-foot">
            <button class="btn-modal-close" onclick="closeOrderDetail()">
                <svg viewBox="0 0 24 24" style="width:13px;height:13px;fill:none;stroke:currentColor;stroke-width:2;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Close
            </button>
            <form id="reorder-form" action="" method="POST" style="flex:1;">
                @csrf
                <button type="submit" class="btn-reorder" style="width:100%;">
                    <svg viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
                    Reorder
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ── NEW ORDER MODAL ── --}}
<div id="newOrderModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-head-left">
                <h3>New Order</h3>
                <p>Select products and quantities</p>
            </div>
            <button class="modal-close" onclick="closeNewOrderModal()"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <div class="modal-body">
            <div class="modal-items-label" style="margin-bottom:10px;">Choose products</div>
            <div class="product-grid">
                @foreach($products as $product)
                    <label class="product-card">
                        <input type="checkbox" class="product-checkbox" style="display:none;" value="{{ $product->id }}" data-price="{{ $product->price }}" onchange="toggleProduct(this)">
                        <div class="product-card-check"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <img src="/uploads/{{ $product->image }}" alt="{{ $product->title }}">
                        <div class="product-card-name">{{ $product->title }}</div>
                        <div class="product-card-price">£{{ $product->price }}</div>
                        <div class="qty-row" style="display:none;">
                            <button type="button" class="qty-btn" onclick="changeQty(this,-1)">−</button>
                            <input type="number" class="qty-input" value="1" min="1" readonly>
                            <button type="button" class="qty-btn" onclick="changeQty(this,1)">+</button>
                        </div>
                    </label>
                @endforeach
            </div>
            <div class="order-mini-total">
                <span class="omt-label">Order total</span>
                <span class="omt-val" id="newOrderTotal">£0.00</span>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn-modal-close" onclick="closeNewOrderModal()">Cancel</button>
            <form action="{{ route('cart.add.multiple') }}" method="POST" style="flex:1;" id="newOrderForm">
                @csrf
                <div id="selectedProductsContainer"></div>
                <button type="submit" class="btn-place" id="placeNewOrderBtn" disabled style="width:100%;">
                    <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>

<script>

// ================= ORDER DETAIL MODAL =================

function openOrderDetail(orderId, date, total) {
    document.getElementById('md-order-id').textContent = '#' + orderId;
    document.getElementById('md-order-date').textContent = date;
    document.getElementById('md-order-total').textContent = total;

    // Reorder form action
    document.getElementById('reorder-form').action = '/reorder/' + orderId;

    // Get items JSON safely
    const el = document.getElementById('order-items-' + orderId);
    let items = [];

    try {
        items = el ? JSON.parse(el.textContent) : [];
    } catch (e) {
        console.error("JSON parse error:", e);
        items = [];
    }

    const container = document.getElementById('md-items-container');

    if (items.length === 0) {
        container.innerHTML = `
            <div style="text-align:center;color:#8a96a3;font-size:0.83rem;padding:20px;">
                No items found.
            </div>`;
    } else {
        container.innerHTML = items.map(i => `
            <div class="modal-item">
                <div class="modal-item-img">
                    <img src="/uploads/${i.image}" alt="${i.title}">
                </div>
                <div class="modal-item-body">
                    <div class="modal-item-name">${i.title}</div>
                    <div class="modal-item-qty">Qty: ${i.quantity}</div>
                </div>
                <div class="modal-item-price">£${(i.price * i.quantity).toFixed(2)}</div>
            </div>
        `).join('');
    }

    document.getElementById('orderDetailModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeOrderDetail() {
    document.getElementById('orderDetailModal').classList.remove('show');
    document.body.style.overflow = '';
}

// Click outside close
document.getElementById('orderDetailModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeOrderDetail();
});


// ================= NEW ORDER MODAL =================

let selectedProducts = {};

function openNewOrderModal() {
    document.getElementById('newOrderModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeNewOrderModal() {
    document.getElementById('newOrderModal').classList.remove('show');
    document.body.style.overflow = '';

    selectedProducts = {};

    document.querySelectorAll('.product-card').forEach(card => {
        card.classList.remove('selected');
        card.querySelector('.product-checkbox').checked = false;
        card.querySelector('.qty-row').style.display = 'none';
    });

    updateForm();
}


// ================= PRODUCT SELECT =================

function toggleProduct(el) {
    const card = el.closest('.product-card');
    const qtyRow = card.querySelector('.qty-row');
    const price = parseFloat(el.dataset.price);
    const id = el.value;

    if (el.checked) {
        card.classList.add('selected');
        qtyRow.style.display = 'flex';

        selectedProducts[id] = {
            price: price,
            qty: 1
        };
    } else {
        card.classList.remove('selected');
        qtyRow.style.display = 'none';

        delete selectedProducts[id];
    }

    updateForm();
}


// ================= QUANTITY =================

function changeQty(btn, delta) {
    const input = btn.parentElement.querySelector('.qty-input');
    let value = parseInt(input.value);

    value = Math.max(1, value + delta);
    input.value = value;

    const id = btn.closest('.product-card')
                  .querySelector('.product-checkbox').value;

    if (selectedProducts[id]) {
        selectedProducts[id].qty = value;
    }

    updateForm();
}


// ================= FORM UPDATE =================

function updateForm() {
    const container = document.getElementById('selectedProductsContainer');
    container.innerHTML = '';

    let total = 0;
    let index = 0;

    for (let id in selectedProducts) {
        const item = selectedProducts[id];

        total += item.price * item.qty;

        container.innerHTML += `
            <input type="hidden" name="products[${index}][id]" value="${id}">
            <input type="hidden" name="products[${index}][qty]" value="${item.qty}">
        `;

        index++;
    }

    document.getElementById('newOrderTotal').textContent = '£' + total.toFixed(2);

    document.getElementById('placeNewOrderBtn').disabled = index === 0;
}


// Click outside close (new order)
document.getElementById('newOrderModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeNewOrderModal();
});

</script>
