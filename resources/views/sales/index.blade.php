<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>SalesView – Grocery Sales Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:#F0F2F8;color:#1a1a2e;}
.font-syne{font-family:'Syne',sans-serif;}
::-webkit-scrollbar{width:4px;height:4px;}
::-webkit-scrollbar-thumb{background:#dde0ea;border-radius:10px;}
.sidebar{width:220px;flex-shrink:0;background:#1A1A2E;display:flex;flex-direction:column;}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 16px;border-radius:0 10px 10px 0;cursor:pointer;font-size:13px;font-weight:500;color:rgba(255,255,255,0.55);transition:all .2s;margin:2px 0 2px 0;}
.nav-item:hover{background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.85);}
.nav-item.active{background:rgba(232,25,44,0.18);color:#fff;border-left:3px solid #E8192C;padding-left:19px;}
.card{background:#fff;border-radius:14px;box-shadow:0 2px 16px rgba(0,0,0,0.06);}
.stat-card{background:#fff;border-radius:14px;box-shadow:0 2px 16px rgba(0,0,0,0.06);padding:20px 22px;}
.data-table th{background:#F8F9FD;padding:10px 14px;text-align:left;font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:.06em;}
.data-table td{padding:11px 14px;font-size:13px;border-bottom:1px solid #F3F4F8;color:#374151;}
.data-table tr:hover td{background:#FAFBFF;}
.data-table tr:last-child td{border-bottom:none;}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:99px;font-size:11px;font-weight:600;}
.badge-green{background:#E8FFF5;color:#00C48C;}
.badge-yellow{background:#FFF9EC;color:#FF9500;}
.badge-red{background:#FFF0F0;color:#E8192C;}
.badge-blue{background:#EEF6FF;color:#0A84FF;}
.badge-purple{background:#EEF2FF;color:#6C63FF;}
.badge-gray{background:#F3F4F6;color:#6B7280;}
.page{animation:fadeUp .22s ease;}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
.tab-pill{padding:7px 16px;border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;color:#6B7280;transition:all .2s;background:#fff;border:1px solid #E5E7EB;}
.tab-pill.active{background:#E8192C;color:#fff;border-color:#E8192C;}
.tab-pill:not(.active):hover{background:#F9FAFB;color:#374151;}
.search-input{background:#F5F6FA;border:1.5px solid #E5E7EB;border-radius:9px;padding:8px 12px 8px 34px;font-size:13px;color:#374151;outline:none;width:220px;font-family:'DM Sans',sans-serif;transition:border .2s;}
.search-input:focus{border-color:#E8192C;background:#fff;}
.select-field{background:#F5F6FA;border:1.5px solid #E5E7EB;border-radius:9px;padding:7px 12px;font-size:12px;color:#6B7280;outline:none;cursor:pointer;font-family:'DM Sans',sans-serif;}
.select-field:focus{border-color:#E8192C;}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.45);backdrop-filter:blur(3px);z-index:100;display:flex;align-items:center;justify-content:center;}
.modal-box{background:#fff;border-radius:18px;box-shadow:0 20px 60px rgba(0,0,0,0.18);width:100%;max-width:720px;max-height:88vh;overflow-y:auto;padding:32px;}
.ring-chart{position:relative;width:90px;height:90px;}
.ring-chart svg{transform:rotate(-90deg);}
.ring-text{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-family:'Syne',sans-serif;font-weight:700;font-size:15px;color:#374151;}
.prog-track{height:5px;background:#F0F2F8;border-radius:3px;overflow:hidden;}
.prog-fill{height:100%;border-radius:3px;}
.mini-bar{display:flex;align-items:flex-end;gap:2px;height:28px;}
.mini-bar span{width:5px;border-radius:2px 2px 0 0;flex-shrink:0;}
.exp-ok{color:#00C48C;}
.exp-warn{color:#FF9500;}
.exp-bad{color:#E8192C;}
.avatar{border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;}
#toast{position:fixed;bottom:24px;right:24px;padding:12px 20px;border-radius:12px;font-size:13px;font-weight:600;z-index:999;background:#fff;color:#00C48C;border:1px solid #00C48C30;box-shadow:0 8px 32px rgba(0,0,0,0.12);}
.row-hover:hover td{background:#FAFBFF;cursor:pointer;}

/* PREDICTION CARD */
.pred-card{background:#fff;border-radius:14px;box-shadow:0 2px 16px rgba(0,0,0,0.06);padding:18px 20px;border-left:4px solid #E8192C;}
.pred-card.high{border-left-color:#E8192C;}
.pred-card.medium{border-left-color:#FF9500;}
.pred-card.low{border-left-color:#00C48C;}
.confidence-bar{height:6px;background:#F0F2F8;border-radius:3px;overflow:hidden;margin-top:6px;}
.confidence-fill{height:100%;border-radius:3px;transition:width .6s ease;}

/* TIMELINE */
.timeline-item{position:relative;padding-left:28px;padding-bottom:20px;}
.timeline-item::before{content:'';position:absolute;left:8px;top:22px;bottom:0;width:2px;background:#F0F2F8;}
.timeline-item:last-child::before{display:none;}
.timeline-dot{position:absolute;left:0;top:4px;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:8px;}

/* PAYMENT STATUS */
.pay-stat{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:99px;font-size:11px;font-weight:700;}
.pay-paid{background:#E8FFF5;color:#00C48C;}
.pay-due{background:#FFF9EC;color:#FF9500;}
.pay-overdue{background:#FFF0F0;color:#E8192C;}
.pay-partial{background:#EEF6FF;color:#0A84FF;}

/* AI PULSE ANIMATION */
@keyframes aiPulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.7;transform:scale(.96)}}
.ai-pulse{animation:aiPulse 2s infinite;}
@keyframes shimmer{0%{background-position:-200% 0}100%{background-position:200% 0}}
.shimmer{background:linear-gradient(90deg,#f0f2f8 25%,#e5e7ef 50%,#f0f2f8 75%);background-size:200% 100%;animation:shimmer 1.5s infinite;}

/* CHART BAR HOVER */
.chart-bar{transition:opacity .2s;cursor:pointer;}
.chart-bar:hover{opacity:.75;}

/* PREDICTION GRADIENT BADGE */
.ai-badge{background:linear-gradient(135deg,#E8192C,#6C63FF);color:#fff;padding:3px 10px;border-radius:99px;font-size:10px;font-weight:700;letter-spacing:.03em;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="flex h-screen overflow-hidden">

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="px-5 py-5 border-b border-white/10">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#E8192C;">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-10 2a2 2 0 100 4 2 2 0 000-4z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <span class="font-syne font-800 text-white text-base tracking-tight">SalesView</span>
    </div>
  </div>
  <nav class="flex-1 py-5 flex flex-col gap-1 overflow-y-auto">
    <p class="px-5 pb-2 text-xs font-600 text-white/30 uppercase tracking-widest">Main</p>
    <div class="nav-item active" onclick="showPage('dashboard',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5" fill="currentColor"/><rect x="14" y="3" width="7" height="7" rx="1.5" fill="currentColor" opacity=".5"/><rect x="3" y="14" width="7" height="7" rx="1.5" fill="currentColor" opacity=".5"/><rect x="14" y="14" width="7" height="7" rx="1.5" fill="currentColor"/></svg>
      Dashboard
    </div>
    <p class="px-5 pb-2 pt-4 text-xs font-600 text-white/30 uppercase tracking-widest">Operations</p>
    <div class="nav-item" onclick="showPage('history',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Order History
    </div>
    <div class="nav-item" onclick="showPage('payments',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M2 10h20" stroke="currentColor" stroke-width="1.8"/><path d="M6 15h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Pending Payments
      <span class="ml-auto text-xs font-800 px-1.5 py-0.5 rounded" style="background:#E8192C22;color:#E8192C;" id="pay-badge-count">0</span>
    </div>
    <p class="px-5 pb-2 pt-4 text-xs font-600 text-white/30 uppercase tracking-widest">Intelligence</p>
    <div class="nav-item" onclick="showPage('prediction',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Smart Predictions
      {{-- <span class="ml-auto ai-badge">AI</span> --}}
    </div>
  </nav>
  <div class="px-4 py-4 border-t border-white/10">
    <div class="flex items-center gap-3">
      <div class="avatar" style="width:32px;height:32px;background:#E8192C;color:#fff;font-size:12px;" id="sidebar-avatar">A</div>
      <div><div class="text-white text-xs font-600">Admin User</div><div class="text-white/40 text-xs">Store Manager</div></div>
    </div>
  </div>
</aside>

<!-- MAIN -->
<div class="flex-1 flex flex-col overflow-hidden">
  <header class="flex items-center justify-between px-7 py-4 bg-white border-b border-gray-100">
    <div id="page-title" class="font-syne font-700 text-xl text-gray-800">Dashboard</div>
    <div class="flex items-center gap-3">
      <div class="avatar" style="width:32px;height:32px;background:#E8192C;color:#fff;font-size:12px;">A</div>
      <button onclick="showToast('✓ Logged out successfully')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-2">
        <i class="fa-solid fa-right-from-bracket"></i>
      </button>
    </div>
  </header>

  <main class="flex-1 overflow-y-auto p-7">

    <!-- ═══════════════ DASHBOARD ═══════════════ -->
    <div id="page-dashboard" class="page">
      <div class="grid grid-cols-5 gap-4 mb-6">
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Today's Revenue</div><div class="font-syne text-2xl font-800 text-gray-800">£48,290</div><div class="text-xs mt-2 font-600" style="color:#00C48C;">↑ 12.4% vs yesterday</div><div class="mini-bar mt-3" id="spark1"></div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Orders Today</div><div class="font-syne text-2xl font-800 text-gray-800">184</div><div class="text-xs mt-2 font-600" style="color:#0A84FF;">↑ 8 new in last hr</div><div class="mini-bar mt-3" id="spark2"></div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Active Customers</div><div class="font-syne text-2xl font-800 text-gray-800">1,247</div><div class="text-xs mt-2 font-600" style="color:#6C63FF;">+34 this week</div><div class="mini-bar mt-3" id="spark3"></div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Pending Payments</div><div class="font-syne text-2xl font-800" style="color:#FF9500;" id="dash-pending-pay-count">0</div><div class="text-xs mt-2 font-600" style="color:#FF9500;">COD / Due</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Low Stock Alerts</div><div class="font-syne text-2xl font-800" style="color:#E8192C;">6</div><div class="text-xs mt-2 font-600" style="color:#E8192C;">Needs reorder</div></div>
      </div>

      <div class="grid grid-cols-3 gap-5 mb-5">
        <div class="col-span-2 card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">Recent Orders</div>
            <button onclick="showPage('history',null)" class="text-xs font-600 px-3 py-1.5 rounded-lg" style="background:#FFF0F0;color:#E8192C;">View All →</button>
          </div>
          <table class="w-full data-table"><thead><tr><th>Order</th><th>Customer</th><th>Items</th><th>Amount</th><th>Status</th></tr></thead><tbody id="dash-orders"></tbody></table>
        </div>
        <div class="card overflow-hidden">
          <div class="px-5 py-4 border-b border-gray-100"><div class="font-syne font-700 text-gray-800 text-sm">Top Selling Today</div></div>
          <div class="p-4 flex flex-col gap-3" id="top-selling"></div>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-5">
        <div class="card p-5">
          <h3 class="font-syne font-700 text-sm text-gray-800 mb-4">Product Details</h3>
          <div class="flex items-start justify-between">
            <div class="flex flex-col gap-3 flex-1">
              <div class="flex justify-between"><span class="text-sm font-600" style="color:#E8192C;">Low Stock Items</span><span class="font-syne font-800" style="color:#E8192C;">3</span></div>
              <div class="flex justify-between"><span class="text-sm text-gray-600">All Item Groups</span><span class="font-syne font-700 text-gray-800">39</span></div>
              <div class="flex justify-between"><span class="text-sm text-gray-600">All Items</span><span class="font-syne font-700 text-gray-800">190</span></div>
              <div class="flex justify-between"><span class="text-sm font-600" style="color:#E8192C;">Unconfirmed</span><span class="font-syne font-800" style="color:#E8192C;">121</span></div>
            </div>
            <div class="ml-6 flex flex-col items-center">
              <div class="ring-chart"><svg width="90" height="90" viewBox="0 0 90 90"><circle cx="45" cy="45" r="36" fill="none" stroke="#F0F2F8" stroke-width="10"/><circle cx="45" cy="45" r="36" fill="none" stroke="#00C48C" stroke-width="10" stroke-dasharray="226 226" stroke-dashoffset="64" stroke-linecap="round"/></svg><div class="ring-text">71%</div></div>
              <span class="text-xs text-gray-400 mt-1">Active Items</span>
            </div>
          </div>
        </div>
        <div class="card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">⚠️ Expiry Alerts</div>
            <span class="badge badge-red">6 items</span>
          </div>
          <div class="p-3 flex flex-col gap-2" id="expiry-alerts"></div>
        </div>
        <div class="card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">🔮 AI Predictions</div>
            <button onclick="showPage('prediction',null)" class="text-xs font-600 px-3 py-1.5 rounded-lg" style="background:#FFF0F0;color:#E8192C;">View All →</button>
          </div>
          <div class="p-3 flex flex-col gap-2" id="dash-predictions"></div>
        </div>
      </div>
    </div>

    <!-- ═══════════════ ORDER HISTORY ═══════════════ -->
    <div id="page-history" class="page hidden">
      <!-- Summary Stats -->
      <div class="grid grid-cols-4 gap-4 mb-5">
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Total Orders</div><div class="font-syne text-2xl font-800 text-gray-800" id="hist-total">0</div><div class="text-xs mt-1 text-gray-400">All time</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Delivered</div><div class="font-syne text-2xl font-800" style="color:#00C48C;" id="hist-delivered">0</div><div class="text-xs mt-1 text-gray-400">Successfully completed</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Cancelled</div><div class="font-syne text-2xl font-800" style="color:#E8192C;" id="hist-cancelled">0</div><div class="text-xs mt-1 text-gray-400">Refunded / Cancelled</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Total Revenue</div><div class="font-syne text-2xl font-800 text-gray-800" id="hist-revenue">£0</div><div class="text-xs mt-1" style="color:#00C48C;">From all orders</div></div>
      </div>

      <div class="flex items-center gap-2 mb-5 flex-wrap">
        <div class="tab-pill active" onclick="filterHistory('all',this)">All</div>
        <div class="tab-pill" onclick="filterHistory('delivered',this)">✅ Delivered</div>
        <div class="tab-pill" onclick="filterHistory('shipped',this)">🚚 Shipped</div>
        <div class="tab-pill" onclick="filterHistory('cancelled',this)">❌ Cancelled</div>
        <div class="tab-pill" onclick="filterHistory('returned',this)">↩ Returned</div>
        <div class="ml-auto flex gap-2 flex-wrap">
          <div class="relative"><input id="hist-search" oninput="renderHistoryTable()" class="search-input" placeholder="Search history…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
          <select id="hist-date" onchange="renderHistoryTable()" class="select-field">
            <option value="all">All Time</option>
            <option value="today">Today</option>
            <option value="week">This Week</option>
            <option value="month">This Month</option>
          </select>
          <select id="hist-sort" onchange="renderHistoryTable()" class="select-field">
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
            <option value="high">Highest Value</option>
            <option value="low">Lowest Value</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-5 mb-5">
        <!-- Timeline -->
        <div class="card p-5 overflow-y-auto" style="max-height:420px;">
          <div class="font-syne font-700 text-gray-800 text-sm mb-4">Activity Timeline</div>
          <div id="history-timeline"></div>
        </div>
        <!-- Revenue chart -->
        <div class="col-span-2 card p-5">
          <div class="font-syne font-700 text-gray-800 text-sm mb-1">Revenue by Day (Last 14 Days)</div>
          <div class="text-xs text-gray-400 mb-4">Hover bars for details</div>
          <div class="flex items-end gap-1.5 h-36" id="hist-chart"></div>
          <div class="flex gap-1.5 mt-2" id="hist-chart-labels"></div>
        </div>
      </div>

      <div class="card overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
          <div class="font-syne font-700 text-gray-800 text-sm">Complete Order History</div>
          <span class="text-xs text-gray-400" id="hist-count">0 records</span>
        </div>
        <table class="w-full data-table"><thead><tr><th>Order ID</th><th>Date</th><th>Customer</th><th>Items</th><th>Amount</th><th>Payment</th><th>Status</th><th>Timeline</th></tr></thead>
        <tbody id="history-table-body"></tbody></table>
        <div id="no-history" class="hidden py-12 text-center text-gray-400 text-sm">No records found.</div>
      </div>
    </div>

    <!-- ═══════════════ PENDING PAYMENTS ═══════════════ -->
    <div id="page-payments" class="page hidden">
      <div class="grid grid-cols-4 gap-4 mb-5">
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Total Pending</div><div class="font-syne text-2xl font-800" style="color:#FF9500;" id="pay-total-count">0</div><div class="text-xs mt-1 text-gray-400">Awaiting payment</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Amount Due</div><div class="font-syne text-2xl font-800" style="color:#E8192C;" id="pay-total-amt">£0</div><div class="text-xs mt-1 text-gray-400">Total outstanding</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">COD Orders</div><div class="font-syne text-2xl font-800 text-gray-800" id="pay-cod-count">0</div><div class="text-xs mt-1 text-gray-400">Cash on delivery</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Overdue (7d+)</div><div class="font-syne text-2xl font-800" style="color:#E8192C;" id="pay-overdue-count">0</div><div class="text-xs mt-1 font-600" style="color:#E8192C;">Needs follow-up</div></div>
      </div>

      <div class="flex items-center gap-2 mb-5 flex-wrap">
        <div class="tab-pill active" onclick="filterPayments('all',this)">All Pending</div>
        <div class="tab-pill" onclick="filterPayments('cod',this)">💵 COD</div>
        <div class="tab-pill" onclick="filterPayments('overdue',this)">🔴 Overdue</div>
        <div class="tab-pill" onclick="filterPayments('partial',this)">🟡 Partial Paid</div>
        <div class="ml-auto flex gap-2">
          <div class="relative"><input id="pay-search" oninput="renderPaymentsTable()" class="search-input" placeholder="Search payments…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
          <select id="pay-sort" onchange="renderPaymentsTable()" class="select-field">
            <option value="high">Highest Amount</option>
            <option value="low">Lowest Amount</option>
            <option value="oldest">Oldest First</option>
            <option value="newest">Newest First</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-5 mb-5">
        <div class="col-span-2 card p-5">
          <div class="font-syne font-700 text-gray-800 text-sm mb-4">Payment Methods Breakdown</div>
          <div id="pay-method-breakdown" class="flex flex-col gap-3"></div>
        </div>
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 text-sm mb-3">Quick Actions</div>
          <div class="flex flex-col gap-2">
            <button onclick="markAllCODPaid()" class="w-full text-sm font-600 px-4 py-2.5 rounded-xl text-white transition" style="background:#00C48C;">✓ Mark All COD Delivered</button>
            <button onclick="sendReminders()" class="w-full text-sm font-600 px-4 py-2.5 rounded-xl text-white transition" style="background:#0A84FF;">📱 Send Payment Reminders</button>
            <button onclick="exportPayments()" class="w-full text-sm font-600 px-4 py-2.5 rounded-xl transition" style="background:#FFF0F0;color:#E8192C;">⬇ Export Pending Report</button>
          </div>
          <div class="mt-4 p-3 rounded-xl" style="background:#FFF9EC;">
            <div class="text-xs font-700" style="color:#FF9500;">⚠ Overdue Alert</div>
            <div class="text-xs text-gray-500 mt-1" id="pay-overdue-msg">Loading...</div>
          </div>
        </div>
      </div>

      <div class="card overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
          <div class="font-syne font-700 text-gray-800 text-sm">Pending Payments List</div>
          <span class="text-xs text-gray-400" id="pay-list-count">0 records</span>
        </div>
        <table class="w-full data-table"><thead><tr><th>Order ID</th><th>Date</th><th>Customer</th><th>Amount</th><th>Method</th><th>Days Pending</th><th>Pay Status</th><th>Action</th></tr></thead>
        <tbody id="payments-table-body"></tbody></table>
        <div id="no-payments" class="hidden py-12 text-center text-gray-400 text-sm">No pending payments.</div>
      </div>
    </div>

    <!-- ═══════════════ SMART PREDICTIONS ═══════════════ -->
    <div id="page-prediction" class="page hidden">
      <!-- Hero Banner -->
      <div class="rounded-2xl p-6 mb-6 flex items-center justify-between" style="background:linear-gradient(135deg,#1A1A2E,#2d1b4e);">
        <div>
          {{-- <div class="flex items-center gap-2 mb-2"><span class="ai-badge ai-pulse">✨ AI Powered</span></div> --}}
          <div class="font-syne text-2xl text-white font-800 mb-1">Smart Order Predictions</div>
          <div class="text-white/60 text-sm">ML-driven insights based on sales patterns, seasonality & customer behavior</div>
        </div>
        <div class="text-right">
          <div class="text-white/40 text-xs mb-1">Model Accuracy</div>
          <div class="font-syne text-4xl font-800" style="color:#00C48C;">87.3%</div>
          <div class="text-white/40 text-xs">Last 30 days</div>
        </div>
      </div>

      <!-- Prediction Stats -->
      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="stat-card border-t-4" style="border-top-color:#E8192C;"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Restock Urgently</div><div class="font-syne text-2xl font-800" style="color:#E8192C;">4 items</div><div class="text-xs mt-1 text-gray-400">Within 3 days</div></div>
        <div class="stat-card border-t-4" style="border-top-color:#FF9500;"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Demand Spike</div><div class="font-syne text-2xl font-800" style="color:#FF9500;">+34%</div><div class="text-xs mt-1 text-gray-400">Expected this weekend</div></div>
        <div class="stat-card border-t-4" style="border-top-color:#0A84FF;"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Revenue Forecast</div><div class="font-syne text-2xl font-800" style="color:#0A84FF;">£62,400</div><div class="text-xs mt-1 text-gray-400">Next 7 days</div></div>
        <div class="stat-card border-t-4" style="border-top-color:#00C48C;"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Repeat Orders</div><div class="font-syne text-2xl font-800" style="color:#00C48C;">68%</div><div class="text-xs mt-1 text-gray-400">Customer return rate</div></div>
      </div>

      <div class="grid grid-cols-3 gap-5 mb-5">
        <!-- Demand Forecast Chart -->
        <div class="col-span-2 card p-5">
          <div class="flex items-center justify-between mb-4">
            <div>
              <div class="font-syne font-700 text-gray-800 text-sm">7-Day Demand Forecast</div>
              <div class="text-xs text-gray-400 mt-0.5">Predicted vs Actual orders</div>
            </div>
            <span class="ai-badge">AI Model</span>
          </div>
          <div class="flex items-end gap-2 h-40" id="pred-chart"></div>
          <div class="flex gap-2 mt-2 justify-between" id="pred-chart-labels"></div>
          <div class="flex items-center gap-4 mt-3">
            <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-sm" style="background:#E8192C;"></div><span class="text-xs text-gray-500">Actual</span></div>
            <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-sm" style="background:#E8192C44;border:1px dashed #E8192C;"></div><span class="text-xs text-gray-500">Predicted</span></div>
          </div>
        </div>

        <!-- Top Predicted Products -->
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 text-sm mb-4">📈 High Demand Items</div>
          <div id="high-demand-items" class="flex flex-col gap-3"></div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-5 mb-5">
        <!-- Restock Alerts -->
        <div class="card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">🚨 Restock Predictions</div>
            <span class="badge badge-red">Urgent</span>
          </div>
          <div class="p-4 flex flex-col gap-3" id="restock-predictions"></div>
        </div>
        <!-- Customer Behavior -->
        <div class="card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">👥 Customer Order Patterns</div>
            <span class="ai-badge">ML Insights</span>
          </div>
          <div class="p-4 flex flex-col gap-3" id="customer-patterns"></div>
        </div>
      </div>

      <!-- Smart Predictions Cards -->
      <div class="font-syne font-700 text-gray-800 text-sm mb-3">🔮 AI Recommendations</div>
      <div class="grid grid-cols-3 gap-4" id="pred-cards"></div>
    </div>

  </main>
</div>

<!-- ORDER MODAL -->
<div id="order-modal" class="modal-overlay hidden">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-5">
      <div class="font-syne font-800 text-gray-800 text-xl" id="modal-order-title">Order Details</div>
      <button onclick="closeModal('order-modal')" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 text-xl leading-none">&times;</button>
    </div>
    <div id="modal-order-body"></div>
  </div>
</div>

<div id="toast" class="hidden"></div>

<script>
/* ═══════════════ DATA ═══════════════ */
const EMOJIS={Vegetables:'🥦',Fruits:'🍎',Dairy:'🥛',Grains:'🌾',Beverages:'🧃',Spices:'🌶️',Snacks:'🍪',Frozen:'🧊'};
const products=[
  {id:1,name:'Fresh Tomatoes',cat:'Vegetables',price:40,qty:120,min:20,expiry:'2026-04-25',aisle:'A1',racks:['R1','R2'],baskets:['B-01']},
  {id:2,name:'Organic Milk',cat:'Dairy',price:65,qty:8,min:15,expiry:'2026-04-05',aisle:'B2',racks:['R3'],baskets:['B-05']},
  {id:3,name:'Basmati Rice',cat:'Grains',price:120,qty:200,min:30,expiry:'2027-01-01',aisle:'C1',racks:['R5'],baskets:['B-10']},
  {id:4,name:'Alphonso Mangoes',cat:'Fruits',price:250,qty:4,min:10,expiry:'2026-04-03',aisle:'A2',racks:['R2'],baskets:['B-03']},
  {id:5,name:'Green Tea',cat:'Beverages',price:180,qty:55,min:10,expiry:'2027-06-30',aisle:'D1',racks:['R9'],baskets:['B-15']},
  {id:6,name:'Turmeric Powder',cat:'Spices',price:45,qty:90,min:20,expiry:'2026-12-31',aisle:'C2',racks:['R8'],baskets:['B-12']},
  {id:7,name:'Whole Wheat Bread',cat:'Snacks',price:55,qty:3,min:12,expiry:'2026-04-02',aisle:'A1',racks:['R1'],baskets:['B-02']},
  {id:8,name:'Frozen Peas',cat:'Frozen',price:95,qty:40,min:15,expiry:'2026-11-15',aisle:'D2',racks:['R10'],baskets:['B-18']},
  {id:9,name:'Amul Butter',cat:'Dairy',price:58,qty:6,min:10,expiry:'2026-04-08',aisle:'B1',racks:['R4'],baskets:['B-06']},
  {id:10,name:'Onions',cat:'Vegetables',price:30,qty:150,min:40,expiry:'2026-05-20',aisle:'A2',racks:['R2'],baskets:['B-04']},
  {id:11,name:'Chickpeas',cat:'Grains',price:85,qty:70,min:20,expiry:'2027-03-01',aisle:'C1',racks:['R6'],baskets:['B-11']},
  {id:12,name:'Orange Juice',cat:'Beverages',price:140,qty:22,min:8,expiry:'2026-04-20',aisle:'D1',racks:['R9'],baskets:['B-16']},
];
const customers=[
  {id:1,name:'Oliver Smith',phone:'9876543210',city:'London',orders:42,spend:38500,last:'2026-03-30',tier:'vip',email:'oliver@email.com'},
  {id:2,name:'Harry Johnson',phone:'9823456701',city:'Manchester',orders:28,spend:21200,last:'2026-03-29',tier:'vip',email:'harry@email.com'},
  {id:3,name:'Amelia Brown',phone:'9701234567',city:'Birmingham',orders:15,spend:9800,last:'2026-03-28',tier:'regular',email:'amelia@email.com'},
  {id:4,name:'Jack Taylor',phone:'9612345678',city:'Leeds',orders:3,spend:2400,last:'2026-03-31',tier:'new',email:'jack@email.com'},
  {id:5,name:'Isla Wilson',phone:'9543217890',city:'Liverpool',orders:19,spend:14700,last:'2026-03-27',tier:'regular',email:'isla@email.com'},
  {id:6,name:'George Davies',phone:'9987654321',city:'London',orders:56,spend:52000,last:'2026-03-31',tier:'vip',email:'george@email.com'},
  {id:7,name:'Sophia Evans',phone:'9867453201',city:'Sheffield',orders:7,spend:5100,last:'2026-03-25',tier:'new',email:'sophia@email.com'},
  {id:8,name:'Noah Thomas',phone:'9754321098',city:'Bristol',orders:33,spend:27800,last:'2026-03-30',tier:'regular',email:'noah@email.com'},
];
const STATUSES=['pending','confirmed','packed','shipped','delivered','cancelled'];
const PAYMENTS=['COD','UPI','Card','Wallet'];
function rnd(a,b){return Math.floor(Math.random()*(b-a+1))+a;}
function daysAgo(n){const d=new Date('2026-03-31');d.setDate(d.getDate()-n);return d.toISOString().split('T')[0];}

const orders=Array.from({length:60},(_,i)=>{
  const cust=customers[rnd(0,customers.length-1)];
  const items=Array.from({length:rnd(1,5)},()=>{const p=products[rnd(0,products.length-1)];const qty=rnd(1,5);return{name:p.name,qty,price:p.price,total:p.price*qty};});
  const daysBack=rnd(0,30);
  return{id:`ORD-${1000+i}`,date:daysAgo(daysBack),daysBack,custId:cust.id,custName:cust.name,custPhone:cust.phone,custCity:cust.city,items,amount:items.reduce((s,x)=>s+x.total,0),payment:PAYMENTS[rnd(0,3)],status:STATUSES[rnd(0,5)]};
});
const orderMap={};orders.forEach(o=>orderMap[o.id]=o);

/* ═══════════════ HELPERS ═══════════════ */
function avt(name,size){
  const s=size==='xl'?52:size==='lg'?38:28;
  const fs=size==='xl'?16:size==='lg'?13:10;
  const initials=name.split(' ').map(x=>x[0]).join('').slice(0,2).toUpperCase();
  return `<div class="avatar" style="width:${s}px;height:${s}px;background:#FFF0F0;color:#E8192C;font-size:${fs}px;">${initials}</div>`;
}
function statusBadge(s){
  const m={pending:'badge-yellow',confirmed:'badge-blue',packed:'badge-purple',shipped:'badge-blue',delivered:'badge-green',cancelled:'badge-red'};
  return `<span class="badge ${m[s]||'badge-gray'}">${s.charAt(0).toUpperCase()+s.slice(1)}</span>`;
}
function tierBadge(t){return t==='vip'?'<span class="badge badge-yellow">⭐ VIP</span>':t==='new'?'<span class="badge badge-blue">New</span>':'<span class="badge badge-gray">Regular</span>';}
function closeModal(id){document.getElementById(id).classList.add('hidden');}
function showToast(msg,color){const t=document.getElementById('toast');t.textContent=msg;t.style.color=color||'#00C48C';t.classList.remove('hidden');clearTimeout(t._to);t._to=setTimeout(()=>t.classList.add('hidden'),2800);}

/* ═══════════════ PAGE ROUTER ═══════════════ */
function showPage(p,el){
  ['dashboard','history','payments','prediction'].forEach(x=>document.getElementById('page-'+x).classList.add('hidden'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  document.getElementById('page-'+p).classList.remove('hidden');
  if(el)el.classList.add('active');
  else document.querySelectorAll('.nav-item').forEach(n=>{if(n.textContent.toLowerCase().includes(p.substring(0,6)))n.classList.add('active');});
  document.getElementById('page-title').textContent={dashboard:'Dashboard',history:'Order History',payments:'Pending Payments',prediction:'Smart Order Predictions'}[p];
  if(p==='history')renderHistory();
  if(p==='payments')renderPayments();
  if(p==='prediction')renderPrediction();
}

/* ═══════════════ DASHBOARD ═══════════════ */
function initDashboard(){
  [{id:'spark1',c:'#E8192C'},{id:'spark2',c:'#0A84FF'},{id:'spark3',c:'#6C63FF'}].forEach(({id,c})=>{
    document.getElementById(id).innerHTML=Array.from({length:10},()=>rnd(20,100)).map(h=>`<span style="height:${h}%;background:${c}33;"></span>`).join('');
  });
  const recent=[...orders].sort((a,b)=>b.date.localeCompare(a.date)).slice(0,6);
  document.getElementById('dash-orders').innerHTML=recent.map(o=>`
    <tr class="row-hover" onclick="openOrderModal('${o.id}')">
      <td><span class="font-syne text-xs font-700" style="color:#E8192C;">${o.id}</span></td>
      <td><div class="flex items-center gap-2">${avt(o.custName)}<span class="text-gray-700 text-xs">${o.custName}</span></div></td>
      <td class="text-gray-400 text-xs">${o.items.length} item${o.items.length>1?'s':''}</td>
      <td class="font-700 text-gray-800 text-xs">£${o.amount.toLocaleString()}</td>
      <td>${statusBadge(o.status)}</td>
    </tr>`).join('');
  const sold={};orders.forEach(o=>o.items.forEach(it=>{sold[it.name]=(sold[it.name]||0)+it.qty;}));
  const top5=Object.entries(sold).sort((a,b)=>b[1]-a[1]).slice(0,5);
  const maxV=top5[0]?.[1]||1;
  document.getElementById('top-selling').innerHTML=top5.map(([name,qty])=>{
    const p=products.find(x=>x.name===name)||{cat:'Vegetables'};
    return `<div class="flex items-center gap-3"><span class="text-xl">${EMOJIS[p.cat]||'📦'}</span><div class="flex-1 min-w-0"><div class="text-xs text-gray-700 font-600 truncate">${name}</div><div class="prog-track mt-1"><div class="prog-fill" style="width:${Math.round(qty/maxV*100)}%;background:#E8192C;"></div></div></div><span class="text-xs font-700 text-gray-800">${qty}</span></div>`;
  }).join('');
  const today=new Date('2026-03-31');
  const expItems=products.map(p=>({...p,days:Math.ceil((new Date(p.expiry)-today)/86400000)})).filter(p=>p.days<=14).sort((a,b)=>a.days-b.days);
  document.getElementById('expiry-alerts').innerHTML=expItems.map(p=>`
    <div class="flex items-center justify-between p-2.5 rounded-lg" style="background:#F8F9FD;">
      <div class="flex items-center gap-2"><span>${EMOJIS[p.cat]||'📦'}</span><div><div class="text-xs text-gray-700 font-600">${p.name}</div><div class="text-xs text-gray-400">Stock: ${p.qty}</div></div></div>
      <span class="badge ${p.days<0?'badge-red':p.days<=7?'badge-red':'badge-yellow'}">${p.days<0?'Expired':`${p.days}d`}</span>
    </div>`).join('');
  // Mini prediction widget on dashboard
  const predItems=[
    {emoji:'📦',name:'Alphonso Mangoes',msg:'Restock in 2 days',color:'#E8192C'},
    {emoji:'🥛',name:'Organic Milk',msg:'Weekend surge +40%',color:'#FF9500'},
    {emoji:'🍎',name:'Fresh Tomatoes',msg:'High demand tomorrow',color:'#0A84FF'},
  ];
  document.getElementById('dash-predictions').innerHTML=predItems.map(p=>`
    <div class="flex items-center justify-between p-2.5 rounded-lg" style="background:#F8F9FD;">
      <div class="flex items-center gap-2"><span>${p.emoji}</span><div><div class="text-xs text-gray-700 font-600">${p.name}</div><div class="text-xs" style="color:${p.color};">${p.msg}</div></div></div>
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" style="color:${p.color};"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
    </div>`).join('');
  // Update pending payment count
  const pendingPay=orders.filter(o=>o.payment==='COD'&&o.status!=='delivered'&&o.status!=='cancelled');
  document.getElementById('dash-pending-pay-count').textContent=pendingPay.length;
  document.getElementById('pay-badge-count').textContent=pendingPay.length;
}

/* ═══════════════ ORDER MODAL ═══════════════ */
function openOrderModal(id){
  const o=orderMap[id];if(!o)return;
  document.getElementById('modal-order-title').textContent='Order '+o.id;
  document.getElementById('modal-order-body').innerHTML=`
    <div class="grid grid-cols-2 gap-4 mb-5">
      <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
        <div class="text-xs text-gray-400 mb-3 uppercase tracking-wider font-700">Customer Info</div>
        <div class="flex items-center gap-3 mb-3">${avt(o.custName,'lg')}<div><div class="text-gray-800 font-600">${o.custName}</div><div class="text-xs text-gray-400">${o.custPhone}</div></div></div>
        <div class="text-xs text-gray-500">📍 ${o.custCity}</div>
      </div>
      <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
        <div class="text-xs text-gray-400 mb-3 uppercase tracking-wider font-700">Order Info</div>
        <div class="flex justify-between text-xs mb-2"><span class="text-gray-400">Order ID</span><span class="font-700" style="color:#E8192C;">${o.id}</span></div>
        <div class="flex justify-between text-xs mb-2"><span class="text-gray-400">Date</span><span class="text-gray-600">${o.date}</span></div>
        <div class="flex justify-between text-xs mb-2"><span class="text-gray-400">Payment</span><span class="badge ${o.payment==='COD'?'badge-yellow':'badge-blue'}">${o.payment}</span></div>
        <div class="flex justify-between text-xs"><span class="text-gray-400">Status</span>${statusBadge(o.status)}</div>
      </div>
    </div>
    <div class="rounded-xl overflow-hidden border border-gray-100">
      <div class="px-4 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider bg-gray-50">Items Ordered</div>
      <table class="w-full data-table"><thead><tr><th>Item</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead>
      <tbody>${o.items.map(it=>`<tr><td class="text-gray-700">${it.name}</td><td class="text-gray-400">${it.qty}</td><td class="text-gray-400">£${it.price}</td><td class="font-700 text-gray-800">£${it.total.toLocaleString()}</td></tr>`).join('')}</tbody></table>
      <div class="flex justify-between items-center px-5 py-4 border-t border-gray-100"><span class="text-gray-500 font-600">Total Amount</span><span class="font-syne text-xl font-800 text-gray-800">£${o.amount.toLocaleString()}</span></div>
    </div>`;
  document.getElementById('order-modal').classList.remove('hidden');
}
document.getElementById('order-modal').addEventListener('click',e=>{if(e.target===document.getElementById('order-modal'))closeModal('order-modal');});

/* ═══════════════ HISTORY ═══════════════ */
let histFilter='all';
function filterHistory(f,el){histFilter=f;document.querySelectorAll('#page-history .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderHistoryTable();}

function renderHistory(){
  // Stats
  const delivered=orders.filter(o=>o.status==='delivered').length;
  const cancelled=orders.filter(o=>o.status==='cancelled').length;
  const revenue=orders.filter(o=>o.status==='delivered').reduce((s,o)=>s+o.amount,0);
  document.getElementById('hist-total').textContent=orders.length;
  document.getElementById('hist-delivered').textContent=delivered;
  document.getElementById('hist-cancelled').textContent=cancelled;
  document.getElementById('hist-revenue').textContent='£'+revenue.toLocaleString();
  renderHistoryTable();
  renderHistoryChart();
  renderTimeline();
}

function renderHistoryTable(){
  const q=(document.getElementById('hist-search')?.value||'').toLowerCase();
  const dateF=document.getElementById('hist-date')?.value||'all';
  const sort=document.getElementById('hist-sort')?.value||'newest';
  const today=new Date('2026-03-31');
  let list=[...orders];
  // Status filter (returned = cancelled for demo)
  if(histFilter==='returned')list=list.filter(o=>o.status==='cancelled');
  else if(histFilter!=='all')list=list.filter(o=>o.status===histFilter);
  // Date filter
  if(dateF==='today')list=list.filter(o=>o.daysBack===0);
  else if(dateF==='week')list=list.filter(o=>o.daysBack<=7);
  else if(dateF==='month')list=list.filter(o=>o.daysBack<=30);
  // Search
  if(q)list=list.filter(o=>o.id.toLowerCase().includes(q)||o.custName.toLowerCase().includes(q));
  // Sort
  if(sort==='newest')list.sort((a,b)=>b.date.localeCompare(a.date));
  else if(sort==='oldest')list.sort((a,b)=>a.date.localeCompare(b.date));
  else if(sort==='high')list.sort((a,b)=>b.amount-a.amount);
  else list.sort((a,b)=>a.amount-b.amount);
  const tbody=document.getElementById('history-table-body');
  const noH=document.getElementById('no-history');
  document.getElementById('hist-count').textContent=list.length+' records';
  if(!list.length){tbody.innerHTML='';noH.classList.remove('hidden');return;}
  noH.classList.add('hidden');
  // Status step map
  const steps={pending:1,confirmed:2,packed:3,shipped:4,delivered:5,cancelled:0};
  tbody.innerHTML=list.map(o=>{
    const step=steps[o.status]||0;
    const stepDots=['🔴','🔵','🟣','🚚','✅'];
    const timelineHtml=o.status==='cancelled'
      ?'<span class="badge badge-red">Cancelled</span>'
      :`<div class="flex items-center gap-1">${['confirmed','packed','shipped','delivered'].map((s,i)=>`<div class="w-2 h-2 rounded-full" style="background:${i<step-1?'#00C48C':'#E5E7EB'};"></div>`).join('')}</div>`;
    return `<tr class="row-hover" onclick="openOrderModal('${o.id}')">
      <td><span class="font-syne text-xs font-700" style="color:#E8192C;">${o.id}</span></td>
      <td class="text-gray-400 text-xs">${o.date}</td>
      <td><div class="flex items-center gap-2">${avt(o.custName)}<div><div class="text-gray-700 text-xs font-600">${o.custName}</div><div class="text-gray-400 text-xs">${o.custCity}</div></div></div></td>
      <td class="text-gray-400 text-xs">${o.items.length} items</td>
      <td class="font-700 text-gray-800 text-xs">£${o.amount.toLocaleString()}</td>
      <td><span class="badge ${o.payment==='COD'?'badge-yellow':'badge-blue'}">${o.payment}</span></td>
      <td>${statusBadge(o.status)}</td>
      <td>${timelineHtml}</td>
    </tr>`;}).join('');
}

function renderHistoryChart(){
  const days=Array.from({length:14},(_,i)=>i);
  const dayRevenue=days.map(d=>orders.filter(o=>o.daysBack===d&&o.status==='delivered').reduce((s,o)=>s+o.amount,0));
  const maxR=Math.max(...dayRevenue,1);
  const labels=days.map(d=>{const dt=new Date('2026-03-31');dt.setDate(dt.getDate()-d);return dt.toLocaleDateString('en',{month:'short',day:'numeric'});}).reverse();
  const vals=[...dayRevenue].reverse();
  document.getElementById('hist-chart').innerHTML=vals.map((v,i)=>`
    <div class="flex-1 flex flex-col items-center justify-end group relative cursor-pointer">
      <div class="absolute bottom-full mb-1 opacity-0 group-hover:opacity-100 transition text-xs bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap z-10">£${v.toLocaleString()}</div>
      <div class="w-full rounded-t-md chart-bar" style="height:${v?Math.max(8,Math.round(v/maxR*130)):4}px;background:${i===vals.length-1?'#E8192C':'#FFF0F0'};border:${v?'none':'1px dashed #E5E7EB'};"></div>
    </div>`).join('');
  document.getElementById('hist-chart-labels').innerHTML=labels.map((l,i)=>`<span class="text-xs text-gray-400 flex-1 text-center truncate" style="font-size:9px;">${i%2===0?l:''}</span>`).join('');
}

function renderTimeline(){
  const recent=[...orders].sort((a,b)=>b.date.localeCompare(a.date)).slice(0,12);
  const statusColors={pending:'#FF9500',confirmed:'#0A84FF',packed:'#6C63FF',shipped:'#0A84FF',delivered:'#00C48C',cancelled:'#E8192C'};
  const statusIcons={pending:'⏳',confirmed:'✓',packed:'📦',shipped:'🚚',delivered:'✅',cancelled:'✗'};
  document.getElementById('history-timeline').innerHTML=recent.map(o=>`
    <div class="timeline-item">
      <div class="timeline-dot" style="background:${statusColors[o.status]}22;color:${statusColors[o.status]};font-size:9px;">${statusIcons[o.status]}</div>
      <div class="flex justify-between items-start">
        <div><div class="text-xs font-700" style="color:#E8192C;">${o.id}</div><div class="text-xs text-gray-600">${o.custName}</div><div class="text-xs text-gray-400">${o.date}</div></div>
        <div class="text-right"><div class="text-xs font-700 text-gray-800">£${o.amount.toLocaleString()}</div>${statusBadge(o.status)}</div>
      </div>
    </div>`).join('');
}

/* ═══════════════ PAYMENTS ═══════════════ */
let payFilter='all';
// Generate payment data: COD orders that aren't delivered are "pending"
const pendingPayments=orders.filter(o=>o.payment==='COD'&&o.status!=='delivered'&&o.status!=='cancelled').map(o=>({
  ...o,
  payStatus: o.daysBack>7?'overdue':o.daysBack>3?'due':'partial',
  daysPending: o.daysBack,
  paidAmt: o.daysBack>3?0:Math.round(o.amount*0.4),
}));

function filterPayments(f,el){payFilter=f;document.querySelectorAll('#page-payments .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderPaymentsTable();}

function renderPayments(){
  const total=pendingPayments.reduce((s,o)=>s+o.amount,0);
  const overdue=pendingPayments.filter(o=>o.payStatus==='overdue');
  const cod=pendingPayments.filter(o=>o.payment==='COD');
  document.getElementById('pay-total-count').textContent=pendingPayments.length;
  document.getElementById('pay-total-amt').textContent='£'+total.toLocaleString();
  document.getElementById('pay-cod-count').textContent=cod.length;
  document.getElementById('pay-overdue-count').textContent=overdue.length;
  document.getElementById('pay-badge-count').textContent=pendingPayments.length;
  document.getElementById('pay-overdue-msg').textContent=`${overdue.length} orders overdue 7+ days — total £${overdue.reduce((s,o)=>s+o.amount,0).toLocaleString()} at risk.`;
  // Method breakdown
  const byMethod={COD:0,UPI:0,Card:0,Wallet:0};
  const byMethodAmt={COD:0,UPI:0,Card:0,Wallet:0};
  pendingPayments.forEach(o=>{byMethod[o.payment]=(byMethod[o.payment]||0)+1;byMethodAmt[o.payment]=(byMethodAmt[o.payment]||0)+o.amount;});
  const mColors={COD:'#FF9500',UPI:'#0A84FF',Card:'#6C63FF',Wallet:'#00C48C'};
  const maxAmt=Math.max(...Object.values(byMethodAmt),1);
  document.getElementById('pay-method-breakdown').innerHTML=Object.entries(byMethodAmt).map(([m,amt])=>`
    <div class="flex items-center gap-3">
      <span class="text-xs font-700 w-14" style="color:${mColors[m]};">${m}</span>
      <div class="flex-1"><div class="prog-track"><div class="prog-fill" style="width:${Math.round(amt/maxAmt*100)}%;background:${mColors[m]};"></div></div></div>
      <span class="text-xs font-700 text-gray-800 w-20 text-right">£${amt.toLocaleString()}</span>
      <span class="badge badge-gray w-10 justify-center">${byMethod[m]||0}</span>
    </div>`).join('');
  renderPaymentsTable();
}

function renderPaymentsTable(){
  const q=(document.getElementById('pay-search')?.value||'').toLowerCase();
  const sort=document.getElementById('pay-sort')?.value||'high';
  let list=[...pendingPayments];
  if(payFilter==='cod')list=list.filter(o=>o.payment==='COD');
  else if(payFilter==='overdue')list=list.filter(o=>o.payStatus==='overdue');
  else if(payFilter==='partial')list=list.filter(o=>o.paidAmt>0);
  if(q)list=list.filter(o=>o.id.toLowerCase().includes(q)||o.custName.toLowerCase().includes(q));
  if(sort==='high')list.sort((a,b)=>b.amount-a.amount);
  else if(sort==='low')list.sort((a,b)=>a.amount-b.amount);
  else if(sort==='oldest')list.sort((a,b)=>a.date.localeCompare(b.date));
  else list.sort((a,b)=>b.date.localeCompare(a.date));
  const tbody=document.getElementById('payments-table-body');
  const noP=document.getElementById('no-payments');
  document.getElementById('pay-list-count').textContent=list.length+' records';
  if(!list.length){tbody.innerHTML='';noP.classList.remove('hidden');return;}
  noP.classList.add('hidden');
  tbody.innerHTML=list.map(o=>{
    const payStatusClass=o.payStatus==='overdue'?'pay-overdue':o.payStatus==='partial'?'pay-partial':'pay-due';
    const payLabel=o.payStatus==='overdue'?'Overdue':o.payStatus==='partial'?'Partial Paid':'Due';
    return `<tr class="row-hover" onclick="openOrderModal('${o.id}')">
      <td><span class="font-syne text-xs font-700" style="color:#E8192C;">${o.id}</span></td>
      <td class="text-gray-400 text-xs">${o.date}</td>
      <td><div class="flex items-center gap-2">${avt(o.custName)}<div><div class="text-gray-700 text-xs font-600">${o.custName}</div><div class="text-gray-400 text-xs">${o.custCity}</div></div></div></td>
      <td><div class="font-700 text-gray-800 text-xs">£${o.amount.toLocaleString()}</div>${o.paidAmt>0?`<div class="text-xs" style="color:#00C48C;">Paid: £${o.paidAmt}</div>`:''}</td>
      <td><span class="badge ${o.payment==='COD'?'badge-yellow':'badge-blue'}">${o.payment}</span></td>
      <td><span class="font-700 text-xs ${o.daysPending>7?'text-red-500':o.daysPending>3?'text-yellow-600':'text-gray-600'}">${o.daysPending}d</span></td>
      <td><span class="pay-stat ${payStatusClass}">${payLabel}</span></td>
      <td onclick="event.stopPropagation()">
        <button onclick="markPaid('${o.id}')" class="text-xs px-3 py-1.5 rounded-lg font-600 mr-1" style="background:#E8FFF5;color:#00C48C;">Mark Paid</button>
        <button onclick="sendReminder('${o.custName}')" class="text-xs px-3 py-1.5 rounded-lg font-600" style="background:#EEF6FF;color:#0A84FF;">Remind</button>
      </td>
    </tr>`;}).join('');
}

function markPaid(id){showToast('✓ Payment marked as received for '+id,'#00C48C');}
function markAllCODPaid(){showToast('✓ All COD orders marked as delivered','#00C48C');}
function sendReminder(name){showToast('📱 Reminder sent to '+name,'#0A84FF');}
function sendReminders(){showToast('📱 Payment reminders sent to all overdue customers','#0A84FF');}
function exportPayments(){showToast('⬇ Pending payments report exported','#6C63FF');}

/* ═══════════════ PREDICTIONS ═══════════════ */
function renderPrediction(){
  // Forecast chart
  const days7=['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
  const actual=[142,165,138,0,0,0,0];
  const predicted=[155,170,145,190,220,265,180];
  const maxV=Math.max(...predicted,1);
  document.getElementById('pred-chart').innerHTML=days7.map((d,i)=>`
    <div class="flex-1 flex flex-col items-center justify-end gap-0.5">
      ${actual[i]?`<div class="w-full rounded-t-md chart-bar" style="height:${Math.round(actual[i]/maxV*140)}px;background:#E8192C;"></div>`:''}
      <div class="w-full rounded-t-md chart-bar" style="height:${Math.round(predicted[i]/maxV*140)}px;background:#E8192C33;border:1px dashed #E8192C;${actual[i]?'margin-top:-'+Math.round(actual[i]/maxV*140)+'px;':''}"></div>
    </div>`).join('');
  document.getElementById('pred-chart-labels').innerHTML=days7.map(d=>`<span class="text-xs text-gray-400 flex-1 text-center">${d}</span>`).join('');

  // High demand items
  const demandItems=[
    {name:'Organic Milk',emoji:'🥛',change:'+40%',reason:'Weekend surge',conf:92},
    {name:'Alphonso Mangoes',emoji:'🍎',change:'+65%',reason:'Seasonal peak',conf:88},
    {name:'Basmati Rice',emoji:'🌾',change:'+28%',reason:'Festival upcoming',conf:75},
    {name:'Green Tea',emoji:'🧃',change:'+19%',reason:'Morning trend',conf:71},
  ];
  document.getElementById('high-demand-items').innerHTML=demandItems.map(d=>`
    <div class="flex items-center gap-2 p-2 rounded-lg" style="background:#F8F9FD;">
      <span class="text-lg">${d.emoji}</span>
      <div class="flex-1">
        <div class="flex justify-between"><span class="text-xs font-600 text-gray-700">${d.name}</span><span class="text-xs font-800" style="color:#00C48C;">${d.change}</span></div>
        <div class="text-xs text-gray-400">${d.reason}</div>
        <div class="confidence-bar"><div class="confidence-fill" style="width:${d.conf}%;background:linear-gradient(90deg,#E8192C,#6C63FF);"></div></div>
      </div>
      <span class="text-xs text-gray-400">${d.conf}%</span>
    </div>`).join('');

  // Restock predictions
  const restockItems=[
    {name:'Alphonso Mangoes',emoji:'🍎',qty:4,min:10,days:2,urgency:'high'},
    {name:'Organic Milk',emoji:'🥛',qty:8,min:15,days:1,urgency:'high'},
    {name:'Whole Wheat Bread',emoji:'🍞',qty:3,min:12,days:1,urgency:'high'},
    {name:'Amul Butter',emoji:'🧈',qty:6,min:10,days:3,urgency:'medium'},
  ];
  document.getElementById('restock-predictions').innerHTML=restockItems.map(r=>`
    <div class="flex items-center justify-between p-3 rounded-xl" style="background:${r.urgency==='high'?'#FFF0F0':'#FFF9EC'};">
      <div class="flex items-center gap-3"><span class="text-xl">${r.emoji}</span><div>
        <div class="text-xs font-700 text-gray-800">${r.name}</div>
        <div class="text-xs text-gray-400">Stock: ${r.qty} / Min: ${r.min}</div>
      </div></div>
      <div class="text-right">
        <span class="badge ${r.urgency==='high'?'badge-red':'badge-yellow'}">Order in ${r.days}d</span>
        <div class="text-xs text-gray-400 mt-1">Need ${r.min*3-r.qty} units</div>
      </div>
    </div>`).join('');

  // Customer patterns
  const patterns=[
    {name:'Oliver Smith',emoji:'⭐',pattern:'Orders every 3 days',next:'Tomorrow',prob:94},
    {name:'George Davies',emoji:'🛒',pattern:'Weekend bulk buyer',next:'Sat-Sun',prob:87},
    {name:'Harry Johnson',emoji:'🔄',pattern:'Weekly dairy buyer',next:'Thu',prob:82},
    {name:'Amelia Brown',emoji:'📅',pattern:'Monthly restocking',next:'Apr 5',prob:76},
  ];
  document.getElementById('customer-patterns').innerHTML=patterns.map(p=>`
    <div class="flex items-center gap-3 p-3 rounded-xl" style="background:#F8F9FD;">
      <span class="text-lg">${p.emoji}</span>
      <div class="flex-1">
        <div class="flex justify-between"><span class="text-xs font-700 text-gray-800">${p.name}</span><span class="text-xs font-700" style="color:#00C48C;">${p.prob}%</span></div>
        <div class="text-xs text-gray-400">${p.pattern}</div>
        <div class="confidence-bar mt-1"><div class="confidence-fill" style="width:${p.prob}%;background:#00C48C;"></div></div>
      </div>
      <div class="text-xs font-600 px-2 py-1 rounded-lg" style="background:#E8FFF5;color:#00C48C;">${p.next}</div>
    </div>`).join('');

  // Recommendation cards
  const recs=[
    {priority:'high',icon:'🚨',title:'Urgent Restock',body:'4 products will run out within 72 hours. Place order now to avoid stockouts during weekend peak demand.',action:'Create Purchase Order',actionColor:'#E8192C'},
    {priority:'medium',icon:'📣',title:'Flash Sale Opportunity',body:'Alphonso Mangoes are expiring soon (3 days). Run a 20% discount to clear stock — estimated 60% sellthrough.',action:'Launch Promotion',actionColor:'#FF9500'},
    {priority:'low',icon:'👥',title:'VIP Customer Outreach',body:'3 VIP customers haven\'t ordered in 7+ days. Personalized offers could recover ~£8,400 in revenue.',action:'Send Offers',actionColor:'#6C63FF'},
    {priority:'high',icon:'📦',title:'Bundle Opportunity',body:'Milk + Bread + Butter frequently co-purchased. Bundle at 5% discount could increase basket size by £45.',action:'Create Bundle',actionColor:'#0A84FF'},
    {priority:'low',icon:'🕐',title:'Peak Hours Prep',body:'Sat 10am–1pm historically peaks at 3x normal orders. Ensure 2 extra staff and stock freshness checks.',action:'Schedule Staff',actionColor:'#00C48C'},
    {priority:'medium',icon:'🔮',title:'Next Week Forecast',body:'Revenue forecast: £62,400 (+18% vs this week). Top drivers: weekend fruit demand + monthly restocking cycle.',action:'View Full Report',actionColor:'#6C63FF'},
  ];
  document.getElementById('pred-cards').innerHTML=recs.map(r=>`
    <div class="pred-card ${r.priority}">
      <div class="flex items-start justify-between mb-2">
        <div class="flex items-center gap-2"><span class="text-2xl">${r.icon}</span><div><div class="text-sm font-700 text-gray-800">${r.title}</div><span class="badge ${r.priority==='high'?'badge-red':r.priority==='medium'?'badge-yellow':'badge-green'} mt-1">${r.priority.charAt(0).toUpperCase()+r.priority.slice(1)} Priority</span></div></div>
      </div>
      <p class="text-xs text-gray-500 mb-3 leading-relaxed">${r.body}</p>
      <button onclick="showToast('✓ Action: ${r.title}','${r.actionColor}')" class="text-xs font-700 px-3 py-1.5 rounded-lg text-white" style="background:${r.actionColor};">${r.action} →</button>
    </div>`).join('');
}

/* ═══════════════ INIT ═══════════════ */
initDashboard();
</script>
</body>
</html>