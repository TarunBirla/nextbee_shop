<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>DeliverView – Delivery Management</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:#F0F2F8;color:#1a1a2e;}
.font-syne{font-family:'Syne',sans-serif;}
::-webkit-scrollbar{width:4px;height:4px;}
::-webkit-scrollbar-thumb{background:#dde0ea;border-radius:10px;}
.sidebar{width:220px;flex-shrink:0;background:#1A1A2E;display:flex;flex-direction:column;}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 16px;border-radius:0 10px 10px 0;cursor:pointer;font-size:13px;font-weight:500;color:rgba(255,255,255,0.55);transition:all .2s;margin:2px 0;}
.nav-item:hover{background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.85);}
.nav-item.active{background:rgba(232,25,44,0.18);color:#fff;border-left:3px solid #E8192C;padding-left:19px;}
.card{background:#fff;border-radius:14px;box-shadow:0 2px 16px rgba(0,0,0,0.06);}
.stat-card{background:#fff;border-radius:14px;box-shadow:0 2px 16px rgba(0,0,0,0.06);padding:20px 22px;}
.data-table th{background:#F8F9FD;padding:10px 14px;text-align:left;font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:.06em;}
.data-table td{padding:11px 14px;font-size:13px;border-bottom:1px solid #F3F4F8;color:#374151;vertical-align:middle;}
.data-table tr:last-child td{border-bottom:none;}
.row-hover:hover td{background:#FAFBFF;cursor:pointer;}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:99px;font-size:11px;font-weight:600;}
.badge-green{background:#E8FFF5;color:#00C48C;}
.badge-yellow{background:#FFF9EC;color:#FF9500;}
.badge-red{background:#FFF0F0;color:#E8192C;}
.badge-blue{background:#EEF6FF;color:#0A84FF;}
.badge-purple{background:#EEF2FF;color:#6C63FF;}
.badge-gray{background:#F3F4F6;color:#6B7280;}
.badge-orange{background:#FFF4E5;color:#FF6B00;}
.badge-teal{background:#E0F7F4;color:#00897B;}
.tab-pill{padding:7px 16px;border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;color:#6B7280;transition:all .2s;background:#fff;border:1px solid #E5E7EB;}
.tab-pill.active{background:#E8192C;color:#fff;border-color:#E8192C;}
.tab-pill:not(.active):hover{background:#F9FAFB;color:#374151;}
.search-input{background:#F5F6FA;border:1.5px solid #E5E7EB;border-radius:9px;padding:8px 12px 8px 34px;font-size:13px;color:#374151;outline:none;width:220px;font-family:'DM Sans',sans-serif;transition:border .2s;}
.search-input:focus{border-color:#E8192C;background:#fff;}
.select-field{background:#F5F6FA;border:1.5px solid #E5E7EB;border-radius:9px;padding:7px 12px;font-size:12px;color:#6B7280;outline:none;cursor:pointer;font-family:'DM Sans',sans-serif;}
.select-field:focus{border-color:#E8192C;}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.45);backdrop-filter:blur(3px);z-index:100;display:flex;align-items:center;justify-content:center;}
.modal-box{background:#fff;border-radius:18px;box-shadow:0 20px 60px rgba(0,0,0,0.18);width:100%;max-width:780px;max-height:90vh;overflow-y:auto;padding:32px;}
.input-field{width:100%;border:1.5px solid #e2e5ef;border-radius:9px;padding:9px 13px;font-size:13px;outline:none;transition:border .2s;font-family:'DM Sans',sans-serif;color:#374151;}
.input-field:focus{border-color:#E8192C;}
.page{animation:fadeUp .22s ease;}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
.avatar{border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;}
.timeline-dot{width:12px;height:12px;border-radius:50%;flex-shrink:0;margin-top:3px;}
.timeline-line{width:2px;background:#E5E7EB;flex-shrink:0;margin-left:5px;}
.prog-track{height:5px;background:#F0F2F8;border-radius:3px;overflow:hidden;}
.prog-fill{height:100%;border-radius:3px;}
.step-bar-item{flex:1;height:4px;border-radius:2px;}
.img-upload-box{border:2px dashed #E5E7EB;border-radius:12px;padding:24px;text-align:center;cursor:pointer;transition:all .2s;background:#FAFBFF;}
.img-upload-box:hover{border-color:#E8192C;background:#FFF5F5;}
#toast{position:fixed;bottom:24px;right:24px;padding:12px 20px;border-radius:12px;font-size:13px;font-weight:600;z-index:999;background:#fff;box-shadow:0 8px 32px rgba(0,0,0,0.12);}
.priority-high{color:#E8192C;font-weight:700;}
.priority-normal{color:#6B7280;}
.mini-spark{display:flex;align-items:flex-end;gap:2px;height:24px;}
.mini-spark span{width:4px;border-radius:1px 1px 0 0;}
</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
 @php
    $userRole = auth()->user()->role;
  @endphp
<body class="flex h-screen overflow-hidden">

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="px-5 py-5 border-b border-white/10">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#E8192C;">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M1 3h15v13H1zM16 8h4l3 3v5h-7V8z" stroke="white" stroke-width="2" stroke-linejoin="round"/><circle cx="5.5" cy="18.5" r="2.5" stroke="white" stroke-width="2"/><circle cx="18.5" cy="18.5" r="2.5" stroke="white" stroke-width="2"/></svg>
      </div>
      <span class="font-syne font-800 text-white text-base tracking-tight">DeliverView</span>
    </div>
  </div>
  <nav class="flex-1 py-5 flex flex-col gap-1 overflow-y-auto">
    <p class="px-5 pb-2 text-xs font-600 text-white/30 uppercase tracking-widest">Main</p>
    <div class="nav-item active" onclick="showPage('dashboard',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5" fill="currentColor"/><rect x="14" y="3" width="7" height="7" rx="1.5" fill="currentColor" opacity=".5"/><rect x="3" y="14" width="7" height="7" rx="1.5" fill="currentColor" opacity=".5"/><rect x="14" y="14" width="7" height="7" rx="1.5" fill="currentColor"/></svg>
      Dashboard
    </div>
    <div class="nav-item" onclick="showPage('assignments',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M9 12h6M9 16h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      My Assignments
    </div>
    <div class="nav-item" onclick="showPage('dispatch',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M1 3h15v13H1zM16 8h4l3 3v5h-7V8z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="5.5" cy="18.5" r="2.5" stroke="currentColor" stroke-width="1.8"/><circle cx="18.5" cy="18.5" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
      Dispatch Log
    </div>
    <div class="nav-item" onclick="showPage('failed',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.8"/><path d="M15 9l-6 6M9 9l6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Failed Deliveries
    </div>
    <p class="px-5 pb-2 pt-4 text-xs font-600 text-white/30 uppercase tracking-widest">Tracking</p>
    <div class="nav-item" onclick="showPage('tracking',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" fill="currentColor"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M5.64 5.64l2.12 2.12M16.24 16.24l2.12 2.12M5.64 18.36l2.12-2.12M16.24 7.76l2.12-2.12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Live Tracking
    </div>
  </nav>
  <div class="px-4 py-4 border-t border-white/10">
    <div class="flex items-center gap-3">
      <div class="avatar" style="width:32px;height:32px;background:#E8192C;color:#fff;font-size:12px;">{{ auth()->user()->name[0] }}</div>
      <div><div class="text-white text-xs font-600">{{ auth()->user()->name }}</div><div class="text-white/40 text-xs">{{ ucfirst(str_replace('_',' ', $userRole)) }}</div></div>
    </div>
  </div>
</aside>

<!-- MAIN -->
<div class="flex-1 flex flex-col overflow-hidden">
  <header class="flex items-center justify-between px-7 py-4 bg-white border-b border-gray-100">
    <div id="page-title" class="font-syne font-700 text-xl text-gray-800">Dashboard</div>
    <div class="flex items-center gap-3">
      {{-- <div class="relative">
        <input class="search-input" placeholder="Search orders, customers…"/>
        <svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </div>
      <button class="relative p-2 rounded-xl bg-gray-50 hover:bg-gray-100">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" stroke="#6B7280" stroke-width="1.8" stroke-linecap="round"/></svg>
        <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 rounded-full" style="background:#E8192C;"></span>
      </button> --}}
      <div class="avatar" style="width:32px;height:32px;background:#E8192C;color:#fff;font-size:12px;">{{ auth()->user()->name[0] }}</div>
      <form action="/logout" method="POST">
          @csrf
            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-2">
              <i class="fa-solid fa-right-from-bracket"></i>          
            </button>
        </form>
    </div>
  </header>

  <main class="flex-1 overflow-y-auto p-7">

    <!-- ===== DASHBOARD ===== -->
    <div id="page-dashboard" class="page">
      <!-- Stats -->
      <div class="grid grid-cols-5 gap-4 mb-6">
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Today's Total</div>
          <div class="font-syne text-2xl font-800 text-gray-800">24</div>
          <div class="text-xs mt-2 font-600" style="color:#0A84FF;">Assigned to you</div>
          <div class="mini-spark mt-3" id="spark1"></div>
        </div>
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Delivered</div>
          <div class="font-syne text-2xl font-800" style="color:#00C48C;">14</div>
          <div class="text-xs mt-2 font-600" style="color:#00C48C;">58% completion</div>
          <div class="mini-spark mt-3" id="spark2"></div>
        </div>
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">In Transit</div>
          <div class="font-syne text-2xl font-800" style="color:#FF9500;">7</div>
          <div class="text-xs mt-2 text-gray-400">Out for delivery</div>
        </div>
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Pending Pickup</div>
          <div class="font-syne text-2xl font-800" style="color:#6C63FF;">3</div>
          <div class="text-xs mt-2 text-gray-400">At warehouse</div>
        </div>
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Failed Today</div>
          <div class="font-syne text-2xl font-800" style="color:#E8192C;">2</div>
          <div class="text-xs mt-2 font-600" style="color:#E8192C;">Need reattempt</div>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-5 mb-5">
        <!-- Today's Route -->
        <div class="card p-5">
          <div class="font-syne font-700 text-sm text-gray-800 mb-4">Today's Route Progress</div>
          <div class="flex items-center gap-3 mb-3">
            <div class="font-syne text-3xl font-800 text-gray-800">58%</div>
            <div class="flex-1">
              <div class="prog-track"><div class="prog-fill" style="width:58%;background:#E8192C;"></div></div>
              <div class="text-xs text-gray-400 mt-1">14 of 24 delivered</div>
            </div>
          </div>
          <div class="flex flex-col gap-2 mt-4">
            <div class="flex justify-between text-xs"><span class="text-gray-400">Total Distance</span><span class="font-700 text-gray-700">48 km</span></div>
            <div class="flex justify-between text-xs"><span class="text-gray-400">Est. Remaining</span><span class="font-700 text-gray-700">22 km</span></div>
            <div class="flex justify-between text-xs"><span class="text-gray-400">Time Elapsed</span><span class="font-700 text-gray-700">4h 20m</span></div>
            <div class="flex justify-between text-xs"><span class="text-gray-400">Avg per delivery</span><span class="font-700 text-gray-700">18 min</span></div>
          </div>
        </div>

        <!-- Priority Queue -->
        <div class="col-span-2 card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">Priority Queue — Next Up</div>
            <button onclick="showPage('assignments',null)" class="text-xs font-600 px-3 py-1.5 rounded-lg" style="background:#FFF0F0;color:#E8192C;">View All →</button>
          </div>
          <table class="w-full data-table"><thead><tr><th>Order</th><th>Customer</th><th>Address</th><th>Items</th><th>Priority</th><th>Action</th></tr></thead>
          <tbody id="dash-queue"></tbody></table>
        </div>
      </div>

      <!-- Bottom Row -->
      <div class="grid grid-cols-3 gap-5">
        <!-- Dispatch Summary -->
        <div class="card p-5">
          <div class="font-syne font-700 text-sm text-gray-800 mb-4">Today's Dispatch Summary</div>
          <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between p-3 rounded-xl" style="background:#F8F9FD;">
              <div class="flex items-center gap-2"><span class="text-base">🏭</span><span class="text-xs font-600 text-gray-700">Warehouse A1</span></div>
              <div class="text-right"><div class="text-xs font-800 text-gray-800">12 orders</div><div class="text-xs text-gray-400">08:30 AM</div></div>
            </div>
            <div class="flex items-center justify-between p-3 rounded-xl" style="background:#F8F9FD;">
              <div class="flex items-center gap-2"><span class="text-base">📦</span><span class="text-xs font-600 text-gray-700">Hub B2</span></div>
              <div class="text-right"><div class="text-xs font-800 text-gray-800">8 orders</div><div class="text-xs text-gray-400">10:15 AM</div></div>
            </div>
            <div class="flex items-center justify-between p-3 rounded-xl" style="background:#F8F9FD;">
              <div class="flex items-center gap-2"><span class="text-base">🏪</span><span class="text-xs font-600 text-gray-700">Store C1</span></div>
              <div class="text-right"><div class="text-xs font-800 text-gray-800">4 orders</div><div class="text-xs text-gray-400">11:45 AM</div></div>
            </div>
          </div>
        </div>

        <!-- Storage Time Alerts -->
        <div class="card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">⏱ Storage Time Alerts</div>
            <span class="badge badge-yellow">4 items</span>
          </div>
          <div class="p-3 flex flex-col gap-2" id="storage-alerts"></div>
        </div>

        <!-- Recent Activity -->
        <div class="card overflow-hidden">
          <div class="px-5 py-4 border-b border-gray-100"><div class="font-syne font-700 text-gray-800 text-sm">Recent Activity</div></div>
          <div class="p-3 flex flex-col gap-2" id="recent-activity"></div>
        </div>
      </div>
    </div>

    <!-- ===== ASSIGNMENTS ===== -->
    <div id="page-assignments" class="page hidden">
      <div class="flex items-center gap-2 mb-5 flex-wrap">
        <div class="tab-pill active" onclick="filterAssign('all',this)">All Orders</div>
        <div class="tab-pill" onclick="filterAssign('pending_pickup',this)">Pending Pickup</div>
        <div class="tab-pill" onclick="filterAssign('in_transit',this)">In Transit</div>
        <div class="tab-pill" onclick="filterAssign('delivered',this)">Delivered</div>
        <div class="tab-pill" onclick="filterAssign('failed',this)">Failed</div>
        <div class="tab-pill" onclick="filterAssign('reattempt',this)">Reattempt</div>
        <div class="ml-auto flex gap-2">
          <div class="relative"><input id="assign-search" oninput="renderAssignTable()" class="search-input" placeholder="Search orders…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
          <select id="assign-sort" onchange="renderAssignTable()" class="select-field"><option value="priority">By Priority</option><option value="newest">Newest</option><option value="oldest">Oldest</option></select>
        </div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table">
          <thead>
            <tr>
                <th>Order</th>
                <th>Customer & Address</th>
                <th>Pickup From</th>
                <th>Items</th>
                <th>Stored Since</th>
                {{-- <th>Amount</th>
                <th>Payment</th> --}}
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
          <tbody id="assign-table-body"></tbody>
        </table>
        <div id="no-assign" class="hidden py-12 text-center text-gray-400 text-sm">No orders found.</div>
      </div>
    </div>

    <!-- ===== DISPATCH LOG ===== -->
    <div id="page-dispatch" class="page hidden">
      <div class="flex items-center gap-2 mb-5">
        <div class="tab-pill active" onclick="filterDispatch('all',this)">All</div>
        <div class="tab-pill" onclick="filterDispatch('today',this)">Today</div>
        <div class="tab-pill" onclick="filterDispatch('warehouse',this)">Warehouse A1</div>
        <div class="tab-pill" onclick="filterDispatch('hub',this)">Hub B2</div>
        <div class="ml-auto relative"><input id="dispatch-search" oninput="renderDispatch()" class="search-input" placeholder="Search…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table">
          <thead><tr><th>Order</th><th>Pickup Location</th><th>Aisle / Rack / Basket</th><th>Items Count</th><th>Dispatched At</th><th>Dispatched By</th><th>Days in Storage</th><th>Condition</th></tr></thead>
          <tbody id="dispatch-table-body"></tbody>
        </table>
      </div>
    </div>

    <!-- ===== FAILED DELIVERIES ===== -->
    <div id="page-failed" class="page hidden">
      <div class="flex items-center gap-2 mb-5">
        <div class="tab-pill active" onclick="filterFailed('all',this)">All Failed</div>
        <div class="tab-pill" onclick="filterFailed('not_home',this)">Not Home</div>
        <div class="tab-pill" onclick="filterFailed('wrong_address',this)">Wrong Address</div>
        <div class="tab-pill" onclick="filterFailed('refused',this)">Refused</div>
        <div class="tab-pill" onclick="filterFailed('damaged',this)">Damaged</div>
        <div class="ml-auto relative"><input id="failed-search" oninput="renderFailed()" class="search-input" placeholder="Search…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table">
          <thead><tr><th>Order</th><th>Customer</th><th>Attempt Date</th><th>Failure Reason</th><th>Photo</th><th>Next Action</th><th>Reattempt</th></tr></thead>
          <tbody id="failed-table-body"></tbody>
        </table>
      </div>
    </div>

    <!-- ===== LIVE TRACKING ===== -->
    <div id="page-tracking" class="page hidden">
      <div class="grid grid-cols-3 gap-5">
        <div class="col-span-1 flex flex-col gap-4">
          <div class="card p-5">
            <div class="font-syne font-700 text-sm text-gray-800 mb-4">Select Order to Track</div>
            <div class="flex flex-col gap-2" id="tracking-list"></div>
          </div>
        </div>
        <div class="col-span-2 card p-5">
          <div id="tracking-detail">
            <div class="flex flex-col items-center justify-center h-64 text-gray-400">
              <svg width="48" height="48" fill="none" viewBox="0 0 24 24" class="mb-3 opacity-30"><circle cx="12" cy="12" r="3" fill="currentColor"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              <div class="text-sm">Select an order to view tracking</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- ===== UPDATE STATUS MODAL ===== -->
<div id="status-modal" class="modal-overlay hidden">
  <div class="modal-box" style="max-width:600px;">
    <div class="flex items-center justify-between mb-5">
      <div class="font-syne font-800 text-gray-800 text-xl" id="status-modal-title">Update Delivery Status</div>
      <button onclick="closeModal('status-modal')" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 text-xl">&times;</button>
    </div>
    <div id="status-modal-body"></div>
  </div>
</div>

<!-- ===== ORDER DETAIL MODAL ===== -->
<div id="order-modal" class="modal-overlay hidden">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-5">
      <div class="font-syne font-800 text-gray-800 text-xl" id="order-modal-title">Order Details</div>
      <button onclick="closeModal('order-modal')" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 text-xl">&times;</button>
    </div>
    <div id="order-modal-body"></div>
  </div>
</div>

<div id="toast" class="hidden"></div>

<script>
// ===== DATA =====
const STATUSES = ['pending_pickup','in_transit','delivered','failed','reattempt'];
const FAIL_REASONS = ['not_home','wrong_address','refused','damaged','no_access','other'];
const FAIL_LABELS = {not_home:'Customer Not Home',wrong_address:'Wrong Address',refused:'Customer Refused',damaged:'Item Damaged',no_access:'No Access to Building',other:'Other Reason'};
const PAYMENTS = ['COD','UPI','Card','Prepaid'];
const LOCATIONS = [
  {name:'Warehouse A1',aisles:['A1','A2'],racks:['R1','R2','R3'],baskets:['B-01','B-02','B-03']},
  {name:'Hub B2',aisles:['B1','B2'],racks:['R4','R5'],baskets:['B-05','B-06']},
  {name:'Store C1',aisles:['C1','C2'],racks:['R7','R8'],baskets:['B-10','B-11']},
];
const PRODUCTS = ['Fresh Tomatoes','Organic Milk','Basmati Rice','Alphonso Mangoes','Green Tea','Turmeric Powder','Whole Wheat Bread','Frozen Peas','Amul Butter','Onions'];

function rnd(a,b){return Math.floor(Math.random()*(b-a+1))+a;}
function daysAgo(n){const d=new Date('2026-03-31');d.setDate(d.getDate()-n);return d.toISOString().split('T')[0];}
function hoursAgo(n){const d=new Date('2026-03-31T14:00:00');d.setHours(d.getHours()-n);return d.toISOString();}
// const NAMES=['Priya Sharma','Ravi Kumar','Sunita Patel','Amit Joshi','Deepa Nair','Vikram Singh','Meena Gupta','Arjun Verma','Kavya Reddy','Suresh Nair','Pooja Shah','Rahul Mehta'];
// const AREAS=['Sector 4, Bhopal','MP Nagar, Bhopal','Arera Colony, Bhopal','Kolar Road, Bhopal','Habibganj, Bhopal','Shahpura, Bhopal','Hoshangabad Rd, Bhopal','TT Nagar, Bhopal'];

const NAMES = [
  'Oliver Smith',
  'Harry Johnson',
  'Amelia Brown',
  'Jack Taylor',
  'Isla Wilson',
  'George Davies',
  'Sophia Evans',
  'Noah Thomas',
  'Ava Clarke',
  'Leo Walker',
  'Mia Wright',
  'Ethan Harris'
];

const AREAS = [
  'Camden, London',
  'Canary Wharf, London',
  'Greenwich, London',
  'Hackney, London',
  'Chelsea, London',
  'Kensington, London',
  'Stratford, London',
  'Croydon, London'
];

const deliveries = Array.from({length:24},(_,i)=>{
  const loc = LOCATIONS[rnd(0,2)];
  const items = Array.from({length:rnd(1,4)},()=>({name:PRODUCTS[rnd(0,9)],qty:rnd(1,5)}));
  const storedDays = rnd(0,4);
  const status = i<14?'delivered':i<17?'in_transit':i<20?'pending_pickup':i<22?'failed':'reattempt';
  const failReason = (status==='failed'||status==='reattempt')?FAIL_REASONS[rnd(0,3)]:null;
  return {
    id:`DLV-${2000+i}`,
    orderId:`ORD-${1000+i}`,
    date: daysAgo(rnd(0,2)),
    dispatchTime: hoursAgo(rnd(2,8)),
    custName: NAMES[rnd(0,11)],
    custPhone: `98${rnd(10000000,99999999)}`,
    custAddr: AREAS[rnd(0,7)],
    items,
    itemCount: items.reduce((s,x)=>s+x.qty,0),
    amount: items.reduce((s,x)=>s+rnd(30,300)*x.qty,0),
    payment: PAYMENTS[rnd(0,3)],
    status,
    priority: i<4?'high':'normal',
    location: loc.name,
    aisle: loc.aisles[rnd(0,loc.aisles.length-1)],
    rack: loc.racks[rnd(0,loc.racks.length-1)],
    basket: loc.baskets[rnd(0,loc.baskets.length-1)],
    storedDays,
    storedHours: rnd(0,23),
    failReason,
    failPhoto: null,
    failNote: failReason?'Customer was unavailable at the time of delivery attempt.':null,
    reattemptDate: status==='reattempt'?daysAgo(-1):null,
    timeline: buildTimeline(status, daysAgo(rnd(0,2))),
    condition: ['Good','Good','Good','Good','Moderate','Needs Check'][rnd(0,5)],
  };
});

const deliveryMap = {};
deliveries.forEach(d=>deliveryMap[d.id]=d);

function buildTimeline(status, date){
  const tl = [{time:'08:30 AM',event:'Order assigned to agent',done:true},{time:'09:15 AM',event:'Picked up from warehouse',done:false},{time:'10:00 AM',event:'Out for delivery',done:false},{time:'—',event:'Delivered to customer',done:false}];
  if(status==='pending_pickup'){tl[0].done=true;}
  else if(status==='in_transit'){tl[0].done=true;tl[1].done=true;tl[2].done=true;}
  else if(status==='delivered'){tl.forEach(t=>t.done=true);tl[3].time='02:45 PM';}
  else if(status==='failed'){tl[0].done=true;tl[1].done=true;tl[2].done=true;tl[3]={time:'01:30 PM',event:'Delivery attempted — failed',done:true,failed:true};}
  else if(status==='reattempt'){tl[0].done=true;tl[1].done=true;tl[2].done=true;tl[3]={time:'01:30 PM',event:'1st attempt failed — reattempt scheduled',done:true,failed:true};}
  return tl;
}

// ===== PAGES =====
function showPage(p, el){
  ['dashboard','assignments','dispatch','failed','tracking'].forEach(x=>document.getElementById('page-'+x).classList.add('hidden'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  document.getElementById('page-'+p).classList.remove('hidden');
  if(el) el.classList.add('active');
  else document.querySelectorAll('.nav-item').forEach(n=>{if(n.textContent.trim().toLowerCase().startsWith(p.replace('_',' ')))n.classList.add('active');});
  document.getElementById('page-title').textContent={dashboard:'Dashboard',assignments:'My Assignments',dispatch:'Dispatch Log',failed:'Failed Deliveries',tracking:'Live Tracking'}[p];
  if(p==='assignments')renderAssignTable();
  if(p==='dispatch')renderDispatch();
  if(p==='failed')renderFailed();
  if(p==='tracking')renderTracking();
}

function avt(name,size){
  const s=size==='lg'?38:28,fs=size==='lg'?13:10;
  const init=name.split(' ').map(x=>x[0]).join('').slice(0,2).toUpperCase();
  return `<div class="avatar" style="width:${s}px;height:${s}px;background:#FFF0F0;color:#E8192C;font-size:${fs}px;">${init}</div>`;
}

function statusBadge(s){
  const cfg={pending_pickup:{cls:'badge-purple',label:'Pending Pickup'},in_transit:{cls:'badge-yellow',label:'In Transit'},delivered:{cls:'badge-green',label:'Delivered'},failed:{cls:'badge-red',label:'Failed'},reattempt:{cls:'badge-orange',label:'Reattempt'}};
  const c=cfg[s]||{cls:'badge-gray',label:s};
  return `<span class="badge ${c.cls}">${c.label}</span>`;
}

// ===== DASHBOARD =====
function initDashboard(){
  [{id:'spark1',c:'#0A84FF'},{id:'spark2',c:'#00C48C'}].forEach(({id,c})=>{
    document.getElementById(id).innerHTML=Array.from({length:8},()=>rnd(20,100)).map(h=>`<span style="height:${h}%;background:${c}44;width:5px;border-radius:1px 1px 0 0;display:inline-block;"></span>`).join('');
  });
  const queue = deliveries.filter(d=>['pending_pickup','in_transit'].includes(d.status)).slice(0,5);
  document.getElementById('dash-queue').innerHTML=queue.map(d=>`
    <tr class="row-hover" onclick="openOrderModal('${d.id}')">
      <td><span class="font-syne text-xs font-700" style="color:#E8192C;">${d.orderId}</span></td>
      <td><div class="flex items-center gap-2">${avt(d.custName)}<div><div class="text-xs font-600 text-gray-700">${d.custName}</div><div class="text-xs text-gray-400">${d.custPhone}</div></div></div></td>
      <td class="text-xs text-gray-500 max-w-xs truncate">${d.custAddr}</td>
      <td class="text-xs text-gray-500">${d.itemCount} items</td>
      <td><span class="${d.priority==='high'?'priority-high text-xs':'text-xs text-gray-400'}">${d.priority==='high'?'🔴 HIGH':'Normal'}</span></td>
      <td onclick="event.stopPropagation()"><button onclick="openStatusModal('${d.id}')" class="text-xs px-3 py-1.5 rounded-lg font-600" style="background:#E8192C;color:#fff;">Update</button></td>
    </tr>`).join('');

  const storageWarnings = deliveries.filter(d=>d.storedDays>=2&&d.status!=='delivered').slice(0,4);
  document.getElementById('storage-alerts').innerHTML=storageWarnings.map(d=>`
    <div class="flex items-center justify-between p-2.5 rounded-lg" style="background:#F8F9FD;">
      <div><div class="text-xs font-600 text-gray-700">${d.orderId}</div><div class="text-xs text-gray-400">${d.location} · ${d.itemCount} items</div></div>
      <span class="badge ${d.storedDays>=3?'badge-red':'badge-yellow'}">${d.storedDays}d ${d.storedHours}h</span>
    </div>`).join('');

  const recentActivity = [
    {icon:'✅',text:'ORD-2012 delivered successfully',time:'2 min ago',color:'#00C48C'},
    {icon:'🚚',text:'ORD-2010 picked up from Hub B2',time:'18 min ago',color:'#0A84FF'},
    {icon:'❌',text:'ORD-2008 delivery failed — not home',time:'45 min ago',color:'#E8192C'},
    {icon:'📦',text:'ORD-2015 dispatched from Warehouse A1',time:'1 hr ago',color:'#6C63FF'},
    {icon:'🔄',text:'ORD-2004 reattempt scheduled for tomorrow',time:'2 hr ago',color:'#FF9500'},
  ];
  document.getElementById('recent-activity').innerHTML=recentActivity.map(a=>`
    <div class="flex items-start gap-3 p-2.5 rounded-lg" style="background:#F8F9FD;">
      <span class="text-sm mt-0.5">${a.icon}</span>
      <div class="flex-1"><div class="text-xs text-gray-700 font-600">${a.text}</div><div class="text-xs text-gray-400">${a.time}</div></div>
    </div>`).join('');
}

// ===== ASSIGNMENTS =====
let assignFilter='all';
function filterAssign(f,el){assignFilter=f;document.querySelectorAll('#page-assignments .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderAssignTable();}
function renderAssignTable(){
  const q=(document.getElementById('assign-search')?.value||'').toLowerCase();
  const sort=document.getElementById('assign-sort')?.value||'priority';
  let list=[...deliveries];
  if(assignFilter!=='all')list=list.filter(d=>d.status===assignFilter);
  if(q)list=list.filter(d=>d.id.toLowerCase().includes(q)||d.orderId.toLowerCase().includes(q)||d.custName.toLowerCase().includes(q));
  if(sort==='priority')list.sort((a,b)=>(a.priority==='high'?0:1)-(b.priority==='high'?0:1));
  else if(sort==='newest')list.sort((a,b)=>b.date.localeCompare(a.date));
  else list.sort((a,b)=>a.date.localeCompare(b.date));
  const tbody=document.getElementById('assign-table-body');
  const noEl=document.getElementById('no-assign');
  if(!list.length){tbody.innerHTML='';noEl.classList.remove('hidden');return;}
  noEl.classList.add('hidden');
  tbody.innerHTML=list.map(d=>`
    <tr class="row-hover" onclick="openOrderModal('${d.id}')">
      <td><div><span class="font-syne text-xs font-700" style="color:#E8192C;">${d.orderId}</span><div class="text-xs text-gray-400 mt-0.5">${d.id}</div></div></td>
      <td><div class="flex items-start gap-2">${avt(d.custName)}<div><div class="text-xs font-600 text-gray-700">${d.custName}</div><div class="text-xs text-gray-400">${d.custAddr}</div><div class="text-xs text-gray-400">${d.custPhone}</div></div></div></td>
      <td><div class="text-xs font-600 text-gray-700">${d.location}</div><div class="text-xs text-gray-400">${d.aisle} · ${d.rack} · ${d.basket}</div></td>
      <td class="text-xs text-gray-600">${d.itemCount} items</td>
      <td><div class="text-xs ${d.storedDays>=3?'text-red-500 font-700':d.storedDays>=2?'text-orange-500 font-600':'text-gray-500'}">${d.storedDays}d ${d.storedHours}h</div></td>
      
      <td>${statusBadge(d.status)}</td>
      <td onclick="event.stopPropagation()"><button onclick="openStatusModal('${d.id}')" class="text-xs px-3 py-1.5 rounded-lg font-600" style="background:#E8192C;color:#fff;">Update Status</button></td>
    </tr>`).join('');
}

// <td class="text-xs font-700 text-gray-800">£${d.amount.toLocaleString()}</td>
// <td><span class="badge ${d.payment==='COD'?'badge-yellow':'badge-blue'}">${d.payment}</span></td>

// ===== DISPATCH =====
let dispatchFilter='all';
function filterDispatch(f,el){dispatchFilter=f;document.querySelectorAll('#page-dispatch .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderDispatch();}
function renderDispatch(){
  const q=(document.getElementById('dispatch-search')?.value||'').toLowerCase();
  let list=[...deliveries];
  if(dispatchFilter==='today')list=list.filter(d=>d.date===daysAgo(0));
  else if(dispatchFilter==='warehouse')list=list.filter(d=>d.location==='Warehouse A1');
  else if(dispatchFilter==='hub')list=list.filter(d=>d.location==='Hub B2');
  if(q)list=list.filter(d=>d.orderId.toLowerCase().includes(q)||d.location.toLowerCase().includes(q));
  document.getElementById('dispatch-table-body').innerHTML=list.map(d=>`
    <tr class="row-hover" onclick="openOrderModal('${d.id}')">
      <td><span class="font-syne text-xs font-700" style="color:#E8192C;">${d.orderId}</span></td>
      <td><div class="text-xs font-600 text-gray-700">${d.location}</div></td>
      <td><div class="flex gap-1 flex-wrap"><span class="badge badge-purple text-xs">${d.aisle}</span><span class="badge badge-blue text-xs">${d.rack}</span><span class="badge badge-teal text-xs">${d.basket}</span></div></td>
      <td class="text-xs text-center text-gray-700 font-700">${d.itemCount}</td>
      <td class="text-xs text-gray-500">${new Date(d.dispatchTime).toLocaleString('en-GB',{hour:'2-digit',minute:'2-digit',day:'2-digit',month:'short'})}</td>
      <td class="text-xs text-gray-600">Sophia Evans</td>
      <td><span class="badge ${d.storedDays>=3?'badge-red':d.storedDays>=2?'badge-yellow':'badge-green'}">${d.storedDays}d ${d.storedHours}h</span></td>
      <td><span class="badge ${d.condition==='Good'?'badge-green':d.condition==='Moderate'?'badge-yellow':'badge-red'}">${d.condition}</span></td>
    </tr>`).join('');
}

// ===== FAILED =====
let failedFilter='all';
function filterFailed(f,el){failedFilter=f;document.querySelectorAll('#page-failed .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderFailed();}
function renderFailed(){
  const q=(document.getElementById('failed-search')?.value||'').toLowerCase();
  let list=deliveries.filter(d=>d.status==='failed'||d.status==='reattempt');
  if(failedFilter!=='all')list=list.filter(d=>d.failReason===failedFilter);
  if(q)list=list.filter(d=>d.orderId.toLowerCase().includes(q)||d.custName.toLowerCase().includes(q));
  document.getElementById('failed-table-body').innerHTML=list.map(d=>`
    <tr class="row-hover" onclick="openOrderModal('${d.id}')">
      <td><span class="font-syne text-xs font-700" style="color:#E8192C;">${d.orderId}</span></td>
      <td><div class="flex items-center gap-2">${avt(d.custName)}<div><div class="text-xs font-600 text-gray-700">${d.custName}</div><div class="text-xs text-gray-400">${d.custAddr}</div></div></div></td>
      <td class="text-xs text-gray-500">${d.date}</td>
      <td><span class="badge badge-red">${FAIL_LABELS[d.failReason]||'—'}</span></td>
      <td class="text-xs">${d.failPhoto?`<img src="${d.failPhoto}" class="w-10 h-10 rounded-lg object-cover"/>` : '<span class="text-gray-300 text-xs italic">No photo</span>'}</td>
      <td class="text-xs text-gray-600">${d.failNote||'—'}</td>
      <td onclick="event.stopPropagation()">
        <div class="flex gap-1">
          <button onclick="scheduleReattempt('${d.id}')" class="text-xs px-2 py-1.5 rounded-lg font-600 border" style="border-color:#FF9500;color:#FF9500;">Reattempt</button>
          <button onclick="openStatusModal('${d.id}')" class="text-xs px-2 py-1.5 rounded-lg font-600" style="background:#E8192C;color:#fff;">Update</button>
        </div>
      </td>
    </tr>`).join('');
}

// ===== TRACKING =====
function renderTracking(){
  const trackable=deliveries.filter(d=>['in_transit','delivered','failed'].includes(d.status)).slice(0,8);
  document.getElementById('tracking-list').innerHTML=trackable.map(d=>`
    <div onclick="showTracking('${d.id}')" class="p-3 rounded-xl cursor-pointer hover:bg-gray-50 border border-transparent hover:border-gray-200 transition" id="track-item-${d.id}">
      <div class="flex items-center justify-between mb-1">
        <span class="font-syne text-xs font-700" style="color:#E8192C;">${d.orderId}</span>
        ${statusBadge(d.status)}
      </div>
      <div class="text-xs text-gray-500 truncate">${d.custName} · ${d.custAddr}</div>
    </div>`).join('');
}

function showTracking(id){
  const d=deliveryMap[id];if(!d)return;
  document.querySelectorAll('[id^=track-item-]').forEach(el=>el.classList.remove('bg-red-50','border-red-200'));
  document.getElementById('track-item-'+id)?.classList.add('bg-red-50','border-red-200');
  const steps=['Order Placed','Assigned to Agent','Picked from Warehouse','Out for Delivery','Delivered'];
  const stepMap={pending_pickup:1,in_transit:3,delivered:4,failed:3,reattempt:3};
  const currentStep=stepMap[d.status]||0;
  document.getElementById('tracking-detail').innerHTML=`
    <div class="mb-5 flex items-start gap-4">
      <div>${avt(d.custName,'lg')}</div>
      <div>
        <div class="font-syne font-800 text-gray-800">${d.custName}</div>
        <div class="text-sm text-gray-500">${d.custAddr}</div>
        <div class="text-sm text-gray-400">${d.custPhone}</div>
      </div>
      <div class="ml-auto text-right">
        <div class="font-syne text-xl font-800 text-gray-800">£${d.amount.toLocaleString()}</div>
        <span class="badge ${d.payment==='COD'?'badge-yellow':'badge-blue'}">${d.payment}</span>
      </div>
    </div>
    <div class="flex gap-1 mb-6">${steps.map((_,i)=>`<div class="step-bar-item" style="background:${i<=currentStep?'#E8192C':'#E5E7EB'};"></div>`).join('')}</div>
    <div class="flex flex-col gap-4 mb-5">
      ${d.timeline.map((t,i)=>`
        <div class="flex gap-3">
          <div class="flex flex-col items-center">
            <div class="timeline-dot" style="background:${t.done?(t.failed?'#E8192C':'#00C48C'):'#E5E7EB'};${t.done&&!t.failed?'box-shadow:0 0 0 3px #E8FFF5':t.failed?'box-shadow:0 0 0 3px #FFF0F0':''}"></div>
            ${i<d.timeline.length-1?`<div class="timeline-line" style="height:32px;background:${t.done?'#E5E7EB':'#F0F0F0'};"></div>`:''}
          </div>
          <div class="pb-2">
            <div class="text-xs font-600 ${t.done?(t.failed?'text-red-500':'text-gray-800'):'text-gray-400'}">${t.event}</div>
            <div class="text-xs text-gray-400">${t.time}</div>
          </div>
        </div>`).join('')}
    </div>
    <div class="p-4 rounded-xl border border-gray-100" style="background:#F8F9FD;">
      <div class="text-xs font-700 text-gray-500 uppercase tracking-wider mb-3">Pickup Details</div>
      <div class="grid grid-cols-3 gap-3 text-xs">
        <div><span class="text-gray-400">Location:</span> <span class="font-700 text-gray-700">${d.location}</span></div>
        <div><span class="text-gray-400">Aisle:</span> <span class="font-700 text-gray-700">${d.aisle}</span></div>
        <div><span class="text-gray-400">Rack:</span> <span class="font-700 text-gray-700">${d.rack}</span></div>
        <div><span class="text-gray-400">Basket:</span> <span class="font-700 text-gray-700">${d.basket}</span></div>
        <div><span class="text-gray-400">In storage:</span> <span class="font-700 ${d.storedDays>=3?'text-red-500':d.storedDays>=2?'text-orange-500':'text-gray-700'}">${d.storedDays}d ${d.storedHours}h</span></div>
        <div><span class="text-gray-400">Condition:</span> <span class="font-700 text-gray-700">${d.condition}</span></div>
      </div>
    </div>
    ${d.failReason?`<div class="mt-3 p-4 rounded-xl border border-red-100" style="background:#FFF5F5;">
      <div class="text-xs font-700 text-red-500 uppercase tracking-wider mb-2">⚠️ Failure Record</div>
      <div class="text-xs text-gray-700 mb-1"><strong>Reason:</strong> ${FAIL_LABELS[d.failReason]}</div>
      <div class="text-xs text-gray-600">${d.failNote||''}</div>
    </div>`:''}
  `;
}

// ===== ORDER DETAIL MODAL =====
function openOrderModal(id){
  const d=deliveryMap[id];if(!d)return;
  document.getElementById('order-modal-title').textContent='Order '+d.orderId;
  document.getElementById('order-modal-body').innerHTML=`
    <div class="grid grid-cols-2 gap-4 mb-5">
      <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
        <div class="text-xs text-gray-400 mb-3 uppercase tracking-wider font-700">Customer Info</div>
        <div class="flex items-center gap-3 mb-3">${avt(d.custName,'lg')}<div><div class="text-gray-800 font-600">${d.custName}</div><div class="text-xs text-gray-400">${d.custPhone}</div></div></div>
        <div class="text-xs text-gray-500 mb-1">📍 ${d.custAddr}</div>
      </div>
      <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
        <div class="text-xs text-gray-400 mb-3 uppercase tracking-wider font-700">Delivery Info</div>
        <div class="flex justify-between text-xs mb-2"><span class="text-gray-400">Delivery ID</span><span class="font-700" style="color:#E8192C;">${d.id}</span></div>
        <div class="flex justify-between text-xs mb-2"><span class="text-gray-400">Order ID</span><span class="font-700 text-gray-600">${d.orderId}</span></div>
        <div class="flex justify-between text-xs mb-2"><span class="text-gray-400">Payment</span><span class="badge ${d.payment==='COD'?'badge-yellow':'badge-blue'}">${d.payment}</span></div>
        <div class="flex justify-between text-xs mb-2"><span class="text-gray-400">Amount</span><span class="font-syne font-800 text-gray-800">£${d.amount.toLocaleString()}</span></div>
        <div class="flex justify-between text-xs"><span class="text-gray-400">Status</span>${statusBadge(d.status)}</div>
      </div>
    </div>
    <div class="p-4 rounded-xl border border-gray-100 mb-4" style="background:#F8F9FD;">
      <div class="text-xs font-700 text-gray-500 uppercase tracking-wider mb-3">📦 Pickup Location</div>
      <div class="grid grid-cols-4 gap-3 text-xs">
        <div class="p-2 bg-white rounded-lg border border-gray-100"><div class="text-gray-400">Location</div><div class="font-700 text-gray-700 mt-0.5">${d.location}</div></div>
        <div class="p-2 bg-white rounded-lg border border-gray-100"><div class="text-gray-400">Aisle</div><div class="font-700 text-gray-700 mt-0.5">${d.aisle}</div></div>
        <div class="p-2 bg-white rounded-lg border border-gray-100"><div class="text-gray-400">Rack</div><div class="font-700 text-gray-700 mt-0.5">${d.rack}</div></div>
        <div class="p-2 bg-white rounded-lg border border-gray-100"><div class="text-gray-400">Basket</div><div class="font-700 text-gray-700 mt-0.5">${d.basket}</div></div>
      </div>
      <div class="grid grid-cols-2 gap-3 mt-3 text-xs">
        <div class="p-2 bg-white rounded-lg border border-gray-100"><div class="text-gray-400">Stored For</div><div class="font-700 mt-0.5 ${d.storedDays>=3?'text-red-500':d.storedDays>=2?'text-orange-500':'text-gray-700'}">${d.storedDays} days ${d.storedHours} hrs</div></div>
        <div class="p-2 bg-white rounded-lg border border-gray-100"><div class="text-gray-400">Item Condition</div><div class="font-700 mt-0.5 ${d.condition==='Good'?'text-green-600':d.condition==='Moderate'?'text-orange-500':'text-red-500'}">${d.condition}</div></div>
      </div>
    </div>
    <div class="rounded-xl overflow-hidden border border-gray-100 mb-4">
      <div class="px-4 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider bg-gray-50">Items</div>
      <table class="w-full data-table"><thead><tr><th>Item Name</th><th>Qty</th></tr></thead>
      <tbody>${d.items.map(it=>`<tr><td class="text-gray-700">${it.name}</td><td class="text-gray-500">${it.qty}</td></tr>`).join('')}</tbody></table>
    </div>
    ${d.failReason?`<div class="p-4 rounded-xl border border-red-100 mb-4" style="background:#FFF5F5;"><div class="text-xs font-700 text-red-500 mb-2">⚠️ Failure Record</div><div class="text-xs text-gray-700 mb-1"><strong>Reason:</strong> ${FAIL_LABELS[d.failReason]}</div><div class="text-xs text-gray-600 mb-2">${d.failNote||''}</div>${d.failPhoto?`<img src="${d.failPhoto}" class="w-24 h-24 rounded-xl object-cover"/>`:''}</div>`:''}
    <div class="flex gap-3 mt-2">
      <button onclick="closeModal('order-modal');openStatusModal('${d.id}')" class="flex-1 py-2.5 rounded-xl text-white font-700 text-sm" style="background:#E8192C;">Update Status</button>
      <button onclick="closeModal('order-modal')" class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-600 text-sm hover:bg-gray-50">Close</button>
    </div>`;
  document.getElementById('order-modal').classList.remove('hidden');
}

// ===== STATUS UPDATE MODAL =====
let currentUpdateId = null;
let uploadedPhotoData = null;

function openStatusModal(id){
  currentUpdateId=id;
  uploadedPhotoData=null;
  const d=deliveryMap[id];if(!d)return;
  document.getElementById('status-modal-title').textContent='Update — '+d.orderId;
  document.getElementById('status-modal-body').innerHTML=`
    <div class="mb-4 p-3 rounded-xl border border-gray-100 bg-gray-50 flex items-center gap-3">
      ${avt(d.custName,'lg')}
      <div><div class="font-600 text-gray-800">${d.custName}</div><div class="text-xs text-gray-400">${d.custAddr}</div></div>
      <div class="ml-auto">${statusBadge(d.status)}</div>
    </div>
    <div class="mb-4">
      <label class="block text-xs font-700 text-gray-500 mb-2 uppercase tracking-wider">New Status</label>
      <div class="grid grid-cols-3 gap-2" id="status-options">
        ${STATUSES.map(s=>`
          <div onclick="selectStatus('${s}')" id="sopt-${s}" class="p-3 rounded-xl border cursor-pointer text-center transition ${d.status===s?'border-red-400 bg-red-50':'border-gray-200 hover:border-gray-300'}">
            <div class="text-lg mb-1">${{pending_pickup:'⏳',in_transit:'🚚',delivered:'✅',failed:'❌',reattempt:'🔄'}[s]}</div>
            <div class="text-xs font-600 ${d.status===s?'text-red-600':'text-gray-600'}">${{pending_pickup:'Pending Pickup',in_transit:'In Transit',delivered:'Delivered',failed:'Failed',reattempt:'Reattempt'}[s]}</div>
          </div>`).join('')}
      </div>
    </div>
    <div id="fail-section" class="${['failed','reattempt'].includes(d.status)?'':'hidden'}">
      <div class="mb-3">
        <label class="block text-xs font-700 text-gray-500 mb-2 uppercase tracking-wider">Failure Reason</label>
        <select id="fail-reason-select" class="input-field">
          ${FAIL_REASONS.map(r=>`<option value="${r}" ${d.failReason===r?'selected':''}>${FAIL_LABELS[r]}</option>`).join('')}
        </select>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-700 text-gray-500 mb-2 uppercase tracking-wider">Notes</label>
        <textarea id="fail-note-input" class="input-field" rows="2" placeholder="Describe what happened…">${d.failNote||''}</textarea>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-700 text-gray-500 mb-2 uppercase tracking-wider">📷 Proof Photo</label>
        <div class="img-upload-box" onclick="document.getElementById('photo-input').click();" id="upload-preview">
          <input type="file" id="photo-input" accept="image/*" class="hidden" onchange="handlePhotoUpload(event)"/>
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="mx-auto mb-2 text-gray-400"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="13" r="4" stroke="currentColor" stroke-width="1.8"/></svg>
          <div class="text-xs text-gray-400">Click to upload delivery attempt photo</div>
          <div class="text-xs text-gray-300 mt-1">JPG, PNG up to 5MB</div>
        </div>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-700 text-gray-500 mb-2 uppercase tracking-wider">Reattempt Date</label>
        <input type="date" id="reattempt-date" class="input-field" value="${d.reattemptDate||''}"/>
      </div>
    </div>
    <div id="delivered-section" class="${d.status==='delivered'?'':'hidden'}">
      <div class="mb-3">
        <label class="block text-xs font-700 text-gray-500 mb-2 uppercase tracking-wider">📷 Delivery Confirmation Photo</label>
        <div class="img-upload-box" onclick="document.getElementById('photo-input2').click();" id="upload-preview2">
          <input type="file" id="photo-input2" accept="image/*" class="hidden" onchange="handlePhotoUpload2(event)"/>
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="mx-auto mb-2 text-gray-400"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="13" r="4" stroke="currentColor" stroke-width="1.8"/></svg>
          <div class="text-xs text-gray-400">Upload proof of delivery photo</div>
        </div>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-700 text-gray-500 mb-2 uppercase tracking-wider">Delivery Notes (optional)</label>
        <textarea id="delivery-note" class="input-field" rows="2" placeholder="e.g. Left with neighbour, left at door…"></textarea>
      </div>
    </div>
    <input type="hidden" id="selected-status" value="${d.status}"/>
    <div class="flex gap-3 mt-5">
      <button onclick="closeModal('status-modal')" class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-600 text-sm">Cancel</button>
      <button onclick="saveStatus()" class="flex-1 py-2.5 rounded-xl text-white font-700 text-sm" style="background:#E8192C;">Save Status</button>
    </div>`;
  document.getElementById('status-modal').classList.remove('hidden');
}

function selectStatus(s){
  document.querySelectorAll('[id^=sopt-]').forEach(el=>{el.classList.remove('border-red-400','bg-red-50');el.classList.add('border-gray-200');el.querySelector('div:last-child').classList.replace('text-red-600','text-gray-600');});
  const el=document.getElementById('sopt-'+s);
  el.classList.add('border-red-400','bg-red-50');el.classList.remove('border-gray-200');
  el.querySelector('div:last-child').classList.replace('text-gray-600','text-red-600');
  document.getElementById('selected-status').value=s;
  document.getElementById('fail-section').classList.toggle('hidden',!['failed','reattempt'].includes(s));
  document.getElementById('delivered-section').classList.toggle('hidden',s!=='delivered');
}

function handlePhotoUpload(e){
  const file=e.target.files[0];if(!file)return;
  const reader=new FileReader();
  reader.onload=ev=>{
    uploadedPhotoData=ev.target.result;
    document.getElementById('upload-preview').innerHTML=`<img src="${uploadedPhotoData}" class="w-full h-32 object-cover rounded-xl"/><div class="text-xs text-green-500 mt-2 font-600">✓ Photo uploaded</div>`;
  };reader.readAsDataURL(file);
}
function handlePhotoUpload2(e){
  const file=e.target.files[0];if(!file)return;
  const reader=new FileReader();
  reader.onload=ev=>{
    uploadedPhotoData=ev.target.result;
    document.getElementById('upload-preview2').innerHTML=`<img src="${uploadedPhotoData}" class="w-full h-32 object-cover rounded-xl"/><div class="text-xs text-green-500 mt-2 font-600">✓ Photo uploaded</div>`;
  };reader.readAsDataURL(file);
}

function saveStatus(){
  const d=deliveryMap[currentUpdateId];if(!d)return;
  const ns=document.getElementById('selected-status').value;
  d.status=ns;
  if(['failed','reattempt'].includes(ns)){
    d.failReason=document.getElementById('fail-reason-select')?.value;
    d.failNote=document.getElementById('fail-note-input')?.value;
    d.reattemptDate=document.getElementById('reattempt-date')?.value||null;
    if(uploadedPhotoData) d.failPhoto=uploadedPhotoData;
  }
  d.timeline=buildTimeline(ns,d.date);
  closeModal('status-modal');
  showToast(`✓ ${d.orderId} → ${ns.replace('_',' ')}`,'#00C48C');
  renderAssignTable();renderFailed();
}

function scheduleReattempt(id){
  const d=deliveryMap[id];if(!d)return;
  d.status='reattempt';
  showToast(`🔄 ${d.orderId} scheduled for reattempt`,'#FF9500');
  renderFailed();
}

function closeModal(id){document.getElementById(id).classList.add('hidden');}
function showToast(msg,color='#00C48C'){
  const t=document.getElementById('toast');
  t.textContent=msg;t.style.color=color;t.style.borderColor=color+'33';
  t.classList.remove('hidden');clearTimeout(t._to);t._to=setTimeout(()=>t.classList.add('hidden'),2800);
}

['status-modal','order-modal'].forEach(id=>{
  document.getElementById(id).addEventListener('click',e=>{if(e.target===document.getElementById(id))closeModal(id);});
});

initDashboard();
</script>
</body>
</html>