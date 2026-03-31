<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Products – ShopZone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:        #0ea5e9;
            --ink2:       #58abe3;
            --muted:      #64748b;
            --line:       #e2e8f0;
            --canvas:     #f8fafc;
            --surface:    #ffffff;
            --accent:     #080846;
            --accent-lt:  #eff6ff;
            --accent-bd:  #bfdbfe;
            --green:      #16a34a;
            --green-bg:   #f0fdf4;
            --red:        #dc2626;
            --red-bg:     #fef2f2;
            --amber:      #d97706;
            --amber-bg:   #fffbeb;
            --sb-w:       230px;
            --r:          8px;
            --r2:         14px;
        }

        html, body { height: 100%; }
        body { font-family: 'DM Sans', sans-serif; background: var(--canvas); color: var(--ink); -webkit-font-smoothing: antialiased; display: flex; }

        /* ── SIDEBAR ── */
        .sidebar { width: var(--sb-w); background: var(--ink); display: flex; flex-direction: column; min-height: 100vh; position: fixed; top: 0; left: 0; bottom: 0; z-index: 200; }
        .sb-brand { padding: 24px 18px 20px; border-bottom: 1px solid rgba(255,255,255,0.07); display: flex; align-items: center; gap: 10px; }
        .sb-icon { width: 34px; height: 34px; background: var(--accent); border-radius: var(--r); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sb-icon svg { width: 17px; height: 17px; fill: none; stroke: #fff; stroke-width: 2; }
        .sb-title { font-family: 'DM Serif Display', serif; font-size: 1.05rem; color: #fff; line-height: 1.1; }
        .sb-sub { font-size: 0.6rem; color: rgba(255,255,255,0.3); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 1px; }
        .sb-section { padding: 18px 12px 6px; }
        .sb-sec-lbl { font-size: 0.58rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.22); padding: 0 6px 6px; }
        .sb-link { display: flex; align-items: center; gap: 9px; padding: 8px 10px; border-radius: var(--r); color: rgba(255,255,255,0.52); font-size: 0.81rem; text-decoration: none; transition: all .15s; position: relative; }
        .sb-link svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 1.8; flex-shrink: 0; }
        .sb-link:hover { color: rgba(255,255,255,0.85); background: rgba(255,255,255,0.05); }
        .sb-link.active { color: #fff; background: rgba(29,78,216,0.28); }
        .sb-link.active::before { content: ''; position: absolute; left: 0; top: 20%; bottom: 20%; width: 2.5px; background: #60a5fa; border-radius: 0 2px 2px 0; }
        .sb-space { flex: 1; }
        .sb-user { margin: 12px; padding: 11px 12px; border-radius: var(--r); background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.07); display: flex; align-items: center; gap: 10px; }
        .sb-avatar { width: 32px; height: 32px; border-radius: var(--r); background: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 0.68rem; font-weight: 600; color: #fff; flex-shrink: 0; }
        .sb-uname { font-size: 0.8rem; font-weight: 500; color: #fff; line-height: 1.2; }
        .sb-urole { font-size: 0.62rem; color: rgba(255,255,255,0.3); }

        /* ── PAGE SHELL ── */
        .page-shell { margin-left: var(--sb-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { padding: 20px 32px 18px; background: var(--surface); border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; }
        .topbar-title { font-family: 'DM Serif Display', serif; font-size: 1.55rem; color: var(--ink); line-height: 1; }
        .topbar-sub { font-size: 0.78rem; color: var(--muted); margin-top: 3px; }
        .btn-new { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; background: var(--accent); color: #fff; border: none; border-radius: var(--r); font-size: 0.8rem; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all .15s; }
        .btn-new svg { width: 13px; height: 13px; fill: none; stroke: currentColor; stroke-width: 2.5; }
        .btn-new:hover { background: #1e3a8a; transform: translateY(-1px); }

        /* ── CONTENT GRID ── */
        .content-area { flex: 1; padding: 24px 32px 48px; display: grid; grid-template-columns: 1fr 300px; gap: 22px; align-items: start; }

        /* ── CARD ── */
        .card { background: var(--surface); border: 1px solid var(--line); border-radius: var(--r2); overflow: hidden; }
        .card-head { padding: 14px 18px; border-bottom: 1px solid var(--line); background: var(--canvas); display: flex; align-items: center; justify-content: space-between; }
        .card-lbl { font-size: 0.68rem; font-weight: 600; letter-spacing: 0.09em; text-transform: uppercase; color: var(--muted); }
        .count-pill { font-size: 0.68rem; font-weight: 500; padding: 3px 10px; border-radius: 100px; background: var(--accent-lt); color: var(--accent); border: 1px solid var(--accent-bd); }

        /* ── TABLE ── */
        .orders-table { width: 100%; border-collapse: collapse; }
        .orders-table thead th { padding: 9px 14px; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: var(--muted); text-align: left; background: var(--canvas); border-bottom: 1px solid var(--line); }
        .orders-table tbody tr { border-bottom: 1px solid var(--line); transition: background .12s; }
        .orders-table tbody tr:last-child { border-bottom: none; }
        .orders-table tbody tr:hover { background: #f8fafc; }
        .orders-table td { padding: 12px 14px; font-size: 0.82rem; color: var(--muted); vertical-align: middle; }
        .td-name { font-weight: 500; color: var(--ink) !important; }
        .td-price { font-weight: 500; color: var(--ink) !important; font-variant-numeric: tabular-nums; }
        .td-total { font-weight: 600; color: var(--accent) !important; font-variant-numeric: tabular-nums; }
        .empty-cell { text-align: center; padding: 48px 20px !important; color: var(--muted); font-size: 0.83rem; }
        .empty-icon { width: 40px; height: 40px; background: var(--canvas); border-radius: var(--r2); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; border: 1px solid var(--line); }
        .empty-icon svg { width: 18px; height: 18px; fill: none; stroke: var(--muted); stroke-width: 1.5; }

        /* ── QTY CONTROL ── */
        .qty-wrap { display: inline-flex; align-items: center; border: 1px solid var(--line); border-radius: var(--r); overflow: hidden; }
        .qty-btn { width: 28px; height: 28px; border: none; background: var(--canvas); color: var(--muted); cursor: pointer; font-size: 1rem; display: flex; align-items: center; justify-content: center; transition: background .12s; line-height: 1; }
        .qty-btn:hover { background: var(--line); color: var(--ink); }
        .qty-num { width: 36px; height: 28px; text-align: center; border: none; outline: none; font-size: 0.8rem; font-weight: 500; color: var(--ink); background: #fff; font-family: 'DM Sans', sans-serif; }
        .del-btn { width: 28px; height: 28px; border: 1px solid var(--line); background: var(--canvas); border-radius: var(--r); cursor: pointer; color: var(--red); font-size: 0.78rem; display: flex; align-items: center; justify-content: center; transition: all .12s; }
        .del-btn:hover { background: var(--red-bg); border-color: #fca5a5; }

        /* ── SUMMARY CARD ── */
        .summary-card { background: var(--surface); border: 1px solid var(--line); border-radius: var(--r2); padding: 20px; }
        .summary-title { font-size: 0.68rem; font-weight: 600; letter-spacing: 0.09em; text-transform: uppercase; color: var(--accent); margin-bottom: 16px; }
        .sum-row { display: flex; justify-content: space-between; align-items: center; padding: 6px 0; font-size: 0.82rem; }
        .sum-lbl { color: var(--muted); }
        .sum-val { font-weight: 500; color: var(--ink); font-variant-numeric: tabular-nums; }
        .sum-divider { border: none; border-top: 1px solid var(--line); margin: 10px 0; }
        .sum-total-lbl { font-size: 0.92rem; font-weight: 600; color: var(--ink); }
        .sum-total-val { font-family: 'DM Serif Display', serif; font-size: 1.15rem; color: var(--ink); }

        /* ── COUPON ── */
        .coupon-wrap { margin: 14px 0; }
        .coupon-row { display: flex; gap: 8px; margin-bottom: 6px; }
        .coupon-input { flex: 1; padding: 8px 10px; border: 1px solid var(--line); border-radius: var(--r); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; outline: none; color: var(--ink); transition: border-color .15s; }
        .coupon-input:focus { border-color: var(--accent-bd); }
        .btn-apply { padding: 8px 12px; background: var(--green-bg); color: var(--green); border: 1px solid #bbf7d0; border-radius: var(--r); font-size: 0.75rem; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; white-space: nowrap; transition: all .15s; }
        .btn-apply:hover { background: #dcfce7; }
        .coupon-msg { font-size: 0.72rem; font-weight: 500; min-height: 16px; }
        .msg-ok { color: var(--green); }
        .msg-err { color: var(--red); }

        /* ── PLACE ORDER BUTTON ── */
        .btn-place { width: 100%; margin-top: 14px; padding: 11px; background: var(--accent); color: #fff; border: none; border-radius: var(--r); font-family: 'DM Sans', sans-serif; font-size: 0.85rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 7px; transition: all .15s; }
        .btn-place svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; }
        .btn-place:hover:not(:disabled) { background: #1e3a8a; }
        .btn-place:disabled { opacity: 0.42; cursor: not-allowed; }

        /* ── MODAL ── */
        .modal-overlay { position: fixed; inset: 0; background: rgba(15,23,42,0.6); display: none; align-items: center; justify-content: center; z-index: 500; padding: 20px; backdrop-filter: blur(3px); }
        .modal-overlay.open { display: flex; }
        .modal-box { background: var(--surface); border-radius: var(--r2); width: 100%; max-width: 640px; max-height: 88vh; display: flex; flex-direction: column; border: 1px solid var(--line); box-shadow: 0 24px 64px rgba(0,0,0,0.15); }
        .modal-head { padding: 18px 22px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; }
        .modal-head h3 { font-family: 'DM Serif Display', serif; font-size: 1.15rem; color: var(--ink); }
        .modal-close { width: 30px; height: 30px; background: var(--canvas); border: 1px solid var(--line); border-radius: var(--r); cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--muted); font-size: 1rem; transition: background .15s; }
        .modal-close:hover { background: var(--line); }
        .modal-filters { padding: 12px 22px; border-bottom: 1px solid var(--line); background: var(--canvas); display: flex; gap: 10px; }
        .modal-search { flex: 1; padding: 8px 10px; border: 1px solid var(--line); border-radius: var(--r); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; outline: none; color: var(--ink); transition: border-color .15s; }
        .modal-search:focus { border-color: var(--accent-bd); }
        .modal-cat { padding: 8px 10px; border: 1px solid var(--line); border-radius: var(--r); font-size: 0.78rem; font-family: 'DM Sans', sans-serif; color: var(--ink); background: var(--surface); cursor: pointer; outline: none; }
        .prod-grid { padding: 16px 22px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; overflow-y: auto; flex: 1; }
        .prod-card { border: 1px solid var(--line); border-radius: var(--r); padding: 10px; cursor: pointer; transition: all .15s; position: relative; background: var(--surface); }
        .prod-card:hover { border-color: var(--accent-bd); background: var(--accent-lt); }
        .prod-card.selected { border: 2px solid var(--accent); background: var(--accent-lt); }
        .prod-check { position: absolute; top: 7px; right: 7px; width: 18px; height: 18px; background: var(--accent); border-radius: 50%; display: none; align-items: center; justify-content: center; }
        .prod-card.selected .prod-check { display: flex; }
        .prod-check svg { width: 9px; height: 9px; fill: none; stroke: #fff; stroke-width: 2.5; }
        .prod-img { width: 100%; height: 68px; object-fit: contain; background: var(--canvas); border-radius: var(--r); margin-bottom: 8px; padding: 4px; border: 1px solid var(--line); }
        .prod-name { font-size: 0.76rem; font-weight: 500; color: var(--ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 3px; }
        .prod-price { font-size: 0.78rem; font-weight: 600; color: var(--accent); }
        .modal-foot { padding: 12px 22px; border-top: 1px solid var(--line); background: var(--canvas); display: flex; justify-content: flex-end; gap: 8px; }
        .btn-cancel { padding: 8px 18px; background: var(--surface); border: 1px solid var(--line); border-radius: var(--r); font-size: 0.78rem; font-weight: 500; color: var(--muted); cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background .15s; }
        .btn-cancel:hover { background: var(--canvas); }
        .btn-add-selected { padding: 8px 20px; background: var(--accent); color: #fff; border: none; border-radius: var(--r); font-size: 0.78rem; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background .15s; }
        .btn-add-selected:hover { background: #1e3a8a; }

        /* ── STATUS BADGE ── */
        .badge { display: inline-flex; align-items: center; gap: 5px; font-size: 0.7rem; font-weight: 500; padding: 3px 9px; border-radius: 100px; }
        .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
        .badge-pending { color: var(--amber); background: var(--amber-bg); border: 1px solid #fde68a; }
        .badge-success { color: var(--green); background: var(--green-bg); border: 1px solid #bbf7d0; }

        /* ── SUCCESS ALERT ── */
        .alert-success { display: flex; align-items: center; gap: 8px; background: var(--green-bg); border: 1px solid #bbf7d0; color: var(--green); padding: 10px 14px; border-radius: var(--r); font-size: 0.82rem; font-weight: 500; margin-bottom: 18px; }
        .alert-success svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-width: 2; flex-shrink: 0; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .content-area { grid-template-columns: 1fr; }
        }
        @media (max-width: 700px) {
            .sidebar { display: none; }
            .page-shell { margin-left: 0; }
            .topbar, .content-area { padding-left: 16px; padding-right: 16px; }
            .prod-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

<!-- ══════════════════════════════════════
     SIDEBAR
══════════════════════════════════════ -->
<nav class="sidebar">
    <div class="sb-brand">
        <div class="sb-icon">
            <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
        </div>
        <div>
            <div class="sb-title">ShopZone</div>
            <div class="sb-sub">Customer Portal</div>
        </div>
    </div>

    <div class="sb-section">
        <div class="sb-sec-lbl">Account</div>
        <a href="/profile" class="sb-link">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            My Profile
        </a>
        <a href="/products" class="sb-link">
            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="9" height="9" rx="1"/><rect x="13" y="3" width="9" height="9" rx="1"/><rect x="2" y="13" width="9" height="9" rx="1"/><rect x="13" y="13" width="9" height="9" rx="1"/></svg>
            Browse Products
        </a>
    </div>

    <div class="sb-section">
        <div class="sb-sec-lbl">Orders</div>
        <a href="/cart" class="sb-link">
            <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            My Cart
        </a>
        <a href="/my-orders" class="sb-link">
            <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
            My Orders
        </a>
        <a href="/order-products" class="sb-link active">
            <svg viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="13" y2="16"/></svg>
            Order Products
        </a>
    </div>

    <div class="sb-section">
        <div class="sb-sec-lbl">Support</div>
        <a href="/contacts" class="sb-link">
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .82h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            Contact Us
        </a>
    </div>

    <div class="sb-space"></div>
    <div class="sb-user">
        <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}</div>
        <div>
            <div class="sb-uname">{{ auth()->user()->name ?? 'User' }}</div>
            <div class="sb-urole">Customer</div>
        </div>
    </div>
</nav>

<!-- ══════════════════════════════════════
     MAIN PAGE
══════════════════════════════════════ -->
<div class="page-shell">

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <div class="topbar-title">Order Products</div>
            <div class="topbar-sub">Select products, adjust quantities and place your order</div>
        </div>
        <button class="btn-new" onclick="openModal()">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Create Order
        </button>
    </div>

    <!-- CONTENT -->
    <div class="content-area">

        <!-- LEFT — ORDER TABLE -->
        <div>
            @if(session('success'))
            <div class="alert-success">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
            @endif

            <div class="card">
                <div class="card-head">
                    <span class="card-lbl">Order Products</span>
                    <span class="count-pill" id="item-count-pill">0 items</span>
                </div>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th style="text-align:center">Qty</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="sales-line-body">
                        <tr id="empty-row">
                            <td colspan="6" class="empty-cell">
                                <div class="empty-icon">
                                    <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
                                </div>
                                No products added yet. Click <strong>Create Order</strong> to begin.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT — SUMMARY + FORM -->
        <form method="POST" action="{{ route('order.reorder.submit') }}" onsubmit="prepareForm()">
            @csrf
            <div class="summary-card">
                <div class="summary-title">Order Summary</div>

                <div class="sum-row">
                    <span class="sum-lbl">Subtotal</span>
                    <span class="sum-val" id="s-sub">£0.00</span>
                </div>
                <div class="sum-row" id="discount-row" style="display:none">
                    <span class="sum-lbl" style="color:var(--green)">Discount</span>
                    <span class="sum-val" style="color:var(--green)" id="s-disc">-£0.00</span>
                </div>
                <div class="sum-row">
                    <span class="sum-lbl">Tax (20%)</span>
                    <span class="sum-val" id="s-tax">£0.00</span>
                </div>
                <hr class="sum-divider">
                <div class="sum-row">
                    <span class="sum-total-lbl">Total</span>
                    <span class="sum-total-val" id="s-total">£0.00</span>
                </div>

                <!-- COUPON -->
                <div class="coupon-wrap">
                    <div class="coupon-row">
                        <input type="text" class="coupon-input" id="couponInput" placeholder="Coupon (SAVE10 / FLAT50)">
                        <button type="button" class="btn-apply" onclick="applyCoupon()">Apply</button>
                    </div>
                    <div class="coupon-msg" id="couponMsg"></div>
                    <input type="hidden" name="coupon" id="couponField">
                </div>

                <!-- Hidden product inputs (filled by prepareForm()) -->
                <div id="formProducts"></div>

                <button type="submit" class="btn-place" id="place-btn" disabled>
                    <svg viewBox="0 0 24 24"><polyline points="20 12 20 22 4 22 4 12"/><polyline points="22 7 12 2 2 7"/><line x1="12" y1="22" x2="12" y2="2"/></svg>
                    Place Order
                </button>
            </div>
        </form>

    </div><!-- /content-area -->
</div><!-- /page-shell -->


<!-- ══════════════════════════════════════
     PRODUCT MODAL
══════════════════════════════════════ -->
<div class="modal-overlay" id="productModal">
    <div class="modal-box">

        <div class="modal-head">
            <h3>Select Products</h3>
            <button class="modal-close" onclick="closeModal()">✕</button>
        </div>

        <div class="modal-filters">
            <input type="text" class="modal-search" id="searchInput" placeholder="Search products..." oninput="filterProducts()">
            <select class="modal-cat" id="categoryFilter" onchange="filterProducts()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="prod-grid" id="productList">
            @foreach($products as $product)
            <div class="prod-card product-item"
                 data-id="{{ $product->id }}"
                 data-name="{{ $product->title }}"
                 data-price="{{ $product->price }}"
                 data-namelow="{{ strtolower($product->title) }}"
                 data-category="{{ $product->category_id }}"
                 onclick="toggleProduct(this)">
                <div class="prod-check">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <img class="prod-img" src="/uploads/{{ $product->image }}" alt="{{ $product->title }}">
                <div class="prod-name">{{ $product->title }}</div>
                <div class="prod-price">£{{ number_format($product->price, 2) }}</div>
            </div>
            @endforeach
        </div>

        <div class="modal-foot">
            <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button type="button" class="btn-add-selected" onclick="addSelectedProducts()">Add Selected</button>
        </div>

    </div>
</div>


<!-- ══════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════ -->
<script>
    /* ── STATE ── */
    let tableProducts = {};
    let appliedCoupon = '';

    /* ── INIT: load items from Laravel ── */
    window.addEventListener('DOMContentLoaded', function () {
        @foreach($items as $item)
            @if($item->product)
                addToTable(
                    "{{ $item->product->id }}",
                    "{{ addslashes($item->product->title) }}",
                    {{ $item->product->price }},
                    {{ $item->quantity }}
                );
            @endif
        @endforeach
    });

    /* ── MODAL ── */
    function openModal() {
        document.getElementById('productModal').classList.add('open');
    }
    function closeModal() {
        document.getElementById('productModal').classList.remove('open');
    }

    /* ── PRODUCT CARD TOGGLE ── */
    function toggleProduct(card) {
        const id    = card.dataset.id;
        const inCart = !!tableProducts[id];
        if (inCart) {
            delete tableProducts[id];
            card.classList.remove('selected');
        } else {
            card.classList.add('selected');
        }
    }

    /* ── ADD SELECTED TO TABLE ── */
    function addSelectedProducts() {
        const selected = document.querySelectorAll('.prod-card.selected');
        if (selected.length === 0) {
            alert('Please select at least one product.');
            return;
        }
        selected.forEach(card => {
            addToTable(card.dataset.id, card.dataset.name, parseFloat(card.dataset.price), 1);
            card.classList.remove('selected');
        });
        closeModal();
    }

    /* ── FILTER PRODUCTS ── */
    function filterProducts() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const cat    = document.getElementById('categoryFilter').value;
        document.querySelectorAll('.product-item').forEach(item => {
            const matchName = item.dataset.namelow.includes(search);
            const matchCat  = cat === '' || item.dataset.category === cat;
            item.style.display = (matchName && matchCat) ? '' : 'none';
        });
    }

    /* ── ADD / UPDATE PRODUCT IN CART ── */
    function addToTable(id, name, price, qty) {
        id = String(id);
        if (!tableProducts[id]) {
            tableProducts[id] = { name, price: parseFloat(price), qty: parseInt(qty) };
        } else {
            tableProducts[id].qty += parseInt(qty);
        }
        renderTable();
    }

    /* ── RENDER ORDER TABLE ── */
    function renderTable() {
        const tbody = document.getElementById('sales-line-body');
        tbody.innerHTML = '';

        const ids = Object.keys(tableProducts);
        document.getElementById('item-count-pill').textContent = ids.length + ' item' + (ids.length !== 1 ? 's' : '');
        document.getElementById('place-btn').disabled = ids.length === 0;

        if (ids.length === 0) {
            tbody.innerHTML = `
                <tr id="empty-row">
                    <td colspan="6" class="empty-cell">
                        <div class="empty-icon">
                            <svg viewBox="0 0 24 24" style="width:18px;height:18px;fill:none;stroke:var(--muted);stroke-width:1.5">
                                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                                <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                            </svg>
                        </div>
                        No products added yet. Click <strong>Create Order</strong> to begin.
                    </td>
                </tr>`;
            updateSummary(0);
            return;
        }

        let subtotal = 0;
        let i = 1;

        ids.forEach(id => {
            const item = tableProducts[id];
            const lineTotal = item.qty * item.price;
            subtotal += lineTotal;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="color:var(--muted);font-size:0.78rem">${i++}</td>
                <td class="td-name">${item.name}</td>
                <td style="text-align:center">
                    <div class="qty-wrap">
                        <button type="button" class="qty-btn" onclick="adjQty('${id}', -1)">−</button>
                        <input class="qty-num" type="number" value="${item.qty}" min="1"
                               onchange="setQty('${id}', this.value)">
                        <button type="button" class="qty-btn" onclick="adjQty('${id}', 1)">+</button>
                    </div>
                </td>
                <td class="td-price">£${item.price.toFixed(2)}</td>
                <td class="td-total">£${lineTotal.toFixed(2)}</td>
                <td>
                    <button type="button" class="del-btn" onclick="removeItem('${id}')" title="Remove">✕</button>
                </td>`;
            tbody.appendChild(tr);
        });

        updateSummary(subtotal);
    }

    /* ── QTY CONTROLS ── */
    function adjQty(id, delta) {
        tableProducts[id].qty = Math.max(1, tableProducts[id].qty + delta);
        renderTable();
    }
    function setQty(id, val) {
        tableProducts[id].qty = Math.max(1, parseInt(val) || 1);
        renderTable();
    }
    function removeItem(id) {
        delete tableProducts[id];
        renderTable();
    }

    /* ── COUPON ── */
    function applyCoupon() {
        const input = document.getElementById('couponInput').value.trim().toUpperCase();
        const msg   = document.getElementById('couponMsg');

        if (input === 'SAVE10') {
            appliedCoupon = 'SAVE10';
            msg.className = 'coupon-msg msg-ok';
            msg.textContent = '✓ 10% discount applied';
        } else if (input === 'FLAT50') {
            appliedCoupon = 'FLAT50';
            msg.className = 'coupon-msg msg-ok';
            msg.textContent = '✓ £50 flat discount applied';
        } else {
            appliedCoupon = '';
            msg.className = 'coupon-msg msg-err';
            msg.textContent = '✕ Invalid coupon code';
        }

        document.getElementById('couponField').value = appliedCoupon;
        renderTable();
    }

    /* ── SUMMARY CALCULATION ── */
    function updateSummary(subtotal) {
        let discount = 0;
        if (appliedCoupon === 'SAVE10') discount = subtotal * 0.10;
        if (appliedCoupon === 'FLAT50') discount = Math.min(50, subtotal);

        const taxable = subtotal - discount;
        const tax     = taxable * 0.20;
        const total   = taxable + tax;

        document.getElementById('s-sub').textContent   = '£' + subtotal.toFixed(2);
        document.getElementById('s-tax').textContent   = '£' + tax.toFixed(2);
        document.getElementById('s-total').textContent = '£' + total.toFixed(2);

        const discRow = document.getElementById('discount-row');
        if (discount > 0) {
            discRow.style.display = 'flex';
            document.getElementById('s-disc').textContent = '-£' + discount.toFixed(2);
        } else {
            discRow.style.display = 'none';
        }
    }

    /* ── PREPARE HIDDEN INPUTS BEFORE SUBMIT ── */
    function prepareForm() {
        const container = document.getElementById('formProducts');
        container.innerHTML = '';
        let index = 0;
        for (let id in tableProducts) {
            const item = tableProducts[id];
            container.innerHTML += `
                <input type="hidden" name="products[${index}][id]"  value="${id}">
                <input type="hidden" name="products[${index}][qty]" value="${item.qty}">`;
            index++;
        }
    }
</script>

</body>
</html>