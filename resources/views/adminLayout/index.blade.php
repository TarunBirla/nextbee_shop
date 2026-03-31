<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>AdminView – Control Panel</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:#F0F2F8;color:#1a1a2e;}
.font-syne{font-family:'Syne',sans-serif;}
::-webkit-scrollbar{width:4px;height:4px;}
::-webkit-scrollbar-thumb{background:#dde0ea;border-radius:10px;}
.sidebar{width:230px;flex-shrink:0;background:#1A1A2E;display:flex;flex-direction:column;}
.nav-section{padding:6px 16px 4px;font-size:10px;font-weight:700;color:rgba(255,255,255,0.28);text-transform:uppercase;letter-spacing:.1em;margin-top:8px;}
.nav-item{display:flex;align-items:center;gap:10px;padding:9px 16px;border-radius:0 10px 10px 0;cursor:pointer;font-size:13px;font-weight:500;color:rgba(255,255,255,0.55);transition:all .2s;margin:1px 0;}
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
.search-input{background:#F5F6FA;border:1.5px solid #E5E7EB;border-radius:9px;padding:8px 12px 8px 34px;font-size:13px;color:#374151;outline:none;font-family:'DM Sans',sans-serif;transition:border .2s;}
.search-input:focus{border-color:#E8192C;background:#fff;}
.select-field{background:#F5F6FA;border:1.5px solid #E5E7EB;border-radius:9px;padding:7px 12px;font-size:12px;color:#6B7280;outline:none;cursor:pointer;font-family:'DM Sans',sans-serif;}
.select-field:focus{border-color:#E8192C;}
.input-field{width:100%;border:1.5px solid #e2e5ef;border-radius:9px;padding:9px 13px;font-size:13px;outline:none;transition:border .2s;font-family:'DM Sans',sans-serif;color:#374151;}
.input-field:focus{border-color:#E8192C;}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.45);backdrop-filter:blur(3px);z-index:100;display:flex;align-items:center;justify-content:center;}
.modal-box{background:#fff;border-radius:18px;box-shadow:0 20px 60px rgba(0,0,0,0.18);width:100%;max-width:680px;max-height:90vh;overflow-y:auto;padding:32px;}
.page{animation:fadeUp .22s ease;}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
.avatar{border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;}
.prog-track{height:5px;background:#F0F2F8;border-radius:3px;overflow:hidden;}
.prog-fill{height:100%;border-radius:3px;}
.mini-spark{display:flex;align-items:flex-end;gap:2px;height:26px;}
.mini-spark span{width:4px;border-radius:1px 1px 0 0;display:inline-block;}
.toggle{width:36px;height:20px;border-radius:10px;position:relative;cursor:pointer;transition:background .2s;flex-shrink:0;}
.toggle-thumb{width:16px;height:16px;border-radius:50%;background:#fff;position:absolute;top:2px;left:2px;transition:left .2s;box-shadow:0 1px 3px rgba(0,0,0,0.2);}
.toggle.on{background:#E8192C;}
.toggle.on .toggle-thumb{left:18px;}
.toggle.off{background:#D1D5DB;}
#toast{position:fixed;bottom:24px;right:24px;padding:12px 20px;border-radius:12px;font-size:13px;font-weight:600;z-index:999;background:#fff;box-shadow:0 8px 32px rgba(0,0,0,0.12);}
.metric-up{color:#00C48C;}
.metric-down{color:#E8192C;}
.perm-check{width:16px;height:16px;border-radius:4px;border:1.5px solid #E5E7EB;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0;}
.perm-check.checked{background:#E8192C;border-color:#E8192C;}
</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="flex h-screen overflow-hidden">

    @php
    $userRole = auth()->user()->role;
  @endphp

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="px-5 py-5 border-b border-white/10">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#E8192C;">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div>
        <div class="font-syne font-800 text-white text-sm tracking-tight">AdminView</div>
        <div class="text-white/30 text-xs">Control Panel</div>
      </div>
    </div>
  </div>
  <nav class="flex-1 py-3 flex flex-col overflow-y-auto">
    <div class="nav-section">Overview</div>
    <div class="nav-item active" onclick="showPage('dashboard',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5" fill="currentColor"/><rect x="14" y="3" width="7" height="7" rx="1.5" fill="currentColor" opacity=".5"/><rect x="3" y="14" width="7" height="7" rx="1.5" fill="currentColor" opacity=".5"/><rect x="14" y="14" width="7" height="7" rx="1.5" fill="currentColor"/></svg>
      Dashboard
    </div>
    <div class="nav-item" onclick="showPage('analytics',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Analytics
    </div>
    <div class="nav-section">Management</div>
    <div class="nav-item" onclick="showPage('users',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Users & Roles
    </div>
    <div class="nav-item" onclick="showPage('orders',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      All Orders
    </div>
    <div class="nav-item" onclick="showPage('products',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="7" cy="7" r="1" fill="currentColor"/></svg>
      Products
    </div>
    <div class="nav-item" onclick="showPage('customers',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Customers
    </div>
    <div class="nav-section">System</div>
    <div class="nav-item" onclick="showPage('roles',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Roles & Permissions
    </div>
    <div class="nav-item" onclick="showPage('activity',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Activity Log
    </div>
    <div class="nav-item" onclick="showPage('settings',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/><path d="M12 1v3M12 20v3M4.22 4.22l2.12 2.12M17.66 17.66l2.12 2.12M1 12h3M20 12h3M4.22 19.78l2.12-2.12M17.66 6.34l2.12-2.12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Settings
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
      <div class="relative">
        <input class="search-input" style="width:220px;" placeholder="Search anything…"/>
        <svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </div>
      <button class="relative p-2 rounded-xl bg-gray-50 hover:bg-gray-100">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" stroke="#6B7280" stroke-width="1.8" stroke-linecap="round"/></svg>
        <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 rounded-full" style="background:#E8192C;"></span>
      </button>
      <span class="badge badge-red text-xs">Super Admin</span>
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
      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Total Revenue</div>
          <div class="font-syne text-2xl font-800 text-gray-800">£18,42,300</div>
          <div class="text-xs mt-2 font-600 metric-up">↑ 18.4% this month</div>
          <div class="mini-spark mt-3" id="spark1"></div>
        </div>
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Total Orders</div>
          <div class="font-syne text-2xl font-800 text-gray-800">4,821</div>
          <div class="text-xs mt-2 font-600" style="color:#0A84FF;">↑ 184 today</div>
          <div class="mini-spark mt-3" id="spark2"></div>
        </div>
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Registered Users</div>
          <div class="font-syne text-2xl font-800 text-gray-800">1,923</div>
          <div class="text-xs mt-2 font-600" style="color:#6C63FF;">+47 this week</div>
          <div class="mini-spark mt-3" id="spark3"></div>
        </div>
        <div class="stat-card">
          <div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Delivery Agents</div>
          <div class="font-syne text-2xl font-800 text-gray-800">32</div>
          <div class="text-xs mt-2 font-600 metric-up">28 active today</div>
          <div class="mini-spark mt-3" id="spark4"></div>
        </div>
      </div>

      <!-- Second row stats -->
      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Pending Orders</div><div class="font-syne text-xl font-800" style="color:#FF9500;">23</div><div class="text-xs mt-1 text-gray-400">Awaiting processing</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Failed Deliveries</div><div class="font-syne text-xl font-800" style="color:#E8192C;">8</div><div class="text-xs mt-1 font-600" style="color:#E8192C;">Needs attention</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Low Stock Items</div><div class="font-syne text-xl font-800" style="color:#E8192C;">6</div><div class="text-xs mt-1 font-600" style="color:#E8192C;">Needs reorder</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-600">Avg Order Value</div><div class="font-syne text-xl font-800 text-gray-800">£876</div><div class="text-xs mt-1 text-gray-400">Per transaction</div></div>
      </div>

      <div class="grid grid-cols-3 gap-5 mb-5">
        <!-- Revenue chart -->
        <div class="col-span-2 card p-5">
          <div class="flex items-center justify-between mb-5">
            <div class="font-syne font-700 text-gray-800 text-sm">Revenue Overview — Last 6 Months</div>
            <span class="badge badge-green">↑ 18% growth</span>
          </div>
          <div class="flex items-end gap-3 h-36" id="rev-bars"></div>
          <div class="flex gap-3 mt-2 justify-between" id="rev-labels"></div>
        </div>
        <!-- System health -->
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 text-sm mb-4">System Health</div>
          <div class="flex flex-col gap-3">
            <div>
              <div class="flex justify-between text-xs mb-1"><span class="text-gray-500">Server CPU</span><span class="font-700 text-gray-800">34%</span></div>
              <div class="prog-track"><div class="prog-fill" style="width:34%;background:#00C48C;"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs mb-1"><span class="text-gray-500">Memory Usage</span><span class="font-700 text-gray-800">61%</span></div>
              <div class="prog-track"><div class="prog-fill" style="width:61%;background:#FF9500;"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs mb-1"><span class="text-gray-500">Storage</span><span class="font-700 text-gray-800">47%</span></div>
              <div class="prog-track"><div class="prog-fill" style="width:47%;background:#0A84FF;"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs mb-1"><span class="text-gray-500">Database Load</span><span class="font-700 text-gray-800">28%</span></div>
              <div class="prog-track"><div class="prog-fill" style="width:28%;background:#00C48C;"></div></div>
            </div>
          </div>
          <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col gap-2">
            <div class="flex justify-between text-xs"><span class="text-gray-400">Uptime</span><span class="font-700 text-green-600">99.98%</span></div>
            <div class="flex justify-between text-xs"><span class="text-gray-400">Last Backup</span><span class="font-700 text-gray-700">2h ago</span></div>
            <div class="flex justify-between text-xs"><span class="text-gray-400">API Status</span><span class="badge badge-green text-xs">Operational</span></div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-5">
        <!-- Role distribution -->
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 text-sm mb-4">Users by Role</div>
          <div class="flex flex-col gap-3" id="role-dist"></div>
        </div>
        <!-- Recent users -->
        <div class="card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">New Users</div>
            <button onclick="showPage('users',null)" class="text-xs font-600 px-3 py-1.5 rounded-lg" style="background:#FFF0F0;color:#E8192C;">View All →</button>
          </div>
          <div class="p-3 flex flex-col gap-2" id="new-users-dash"></div>
        </div>
        <!-- Recent activity -->
        <div class="card overflow-hidden">
          <div class="px-5 py-4 border-b border-gray-100"><div class="font-syne font-700 text-gray-800 text-sm">Recent Activity</div></div>
          <div class="p-3 flex flex-col gap-2" id="dash-activity"></div>
        </div>
      </div>
    </div>

    <!-- ===== ANALYTICS ===== -->
    <div id="page-analytics" class="page hidden">
      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="stat-card"><div class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-600">Conversion Rate</div><div class="font-syne text-2xl text-gray-800 font-800">3.8%</div><div class="text-xs mt-1 metric-up">↑ 0.4% vs last month</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-600">Return Rate</div><div class="font-syne text-2xl font-800" style="color:#FF9500;">2.4%</div><div class="text-xs mt-1 text-gray-400">7 returns this week</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-600">Delivery Success</div><div class="font-syne text-2xl text-gray-800 font-800">94.2%</div><div class="text-xs mt-1 metric-up">↑ 1.1% this week</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-600">Avg Delivery Time</div><div class="font-syne text-2xl text-gray-800 font-800">38 min</div><div class="text-xs mt-1 metric-up">↓ 4 min improved</div></div>
      </div>
      <div class="grid grid-cols-2 gap-5">
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 mb-4 text-sm">Revenue by Category</div>
          <div class="flex flex-col gap-3" id="analytics-cat"></div>
        </div>
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 mb-4 text-sm">Order Status Breakdown</div>
          <div class="flex flex-col gap-3" id="analytics-status"></div>
        </div>
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 mb-4 text-sm">Top Performing Areas</div>
          <table class="w-full data-table"><thead><tr><th>Area</th><th>Orders</th><th>Revenue</th><th>Delivery %</th></tr></thead>
          <tbody id="analytics-areas"></tbody></table>
        </div>
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 mb-4 text-sm">Agent Performance</div>
          <table class="w-full data-table"><thead><tr><th>Agent</th><th>Delivered</th><th>Failed</th><th>Rating</th></tr></thead>
          <tbody id="analytics-agents"></tbody></table>
        </div>
      </div>
    </div>

    <!-- ===== USERS & ROLES ===== -->
    <div id="page-users" class="page hidden">
      <div class="flex items-center gap-2 mb-5 flex-wrap">
        <div class="tab-pill active" onclick="filterUsers('all',this)">All Users</div>
        <div class="tab-pill" onclick="filterUsers('admin',this)">Admin</div>
        <div class="tab-pill" onclick="filterUsers('sales_manager',this)">Sales Manager</div>
        <div class="tab-pill" onclick="filterUsers('inventory_manager',this)">Inventory</div>
        <div class="tab-pill" onclick="filterUsers('delivery_agent',this)">Delivery Agent</div>
        <div class="tab-pill" onclick="filterUsers('customer',this)">Customer</div>
        <div class="ml-auto flex gap-2">
          <div class="relative"><input id="user-search" oninput="renderUsers()" class="search-input" style="width:200px;" placeholder="Search users…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
          <button onclick="openUserModal(null)" class="flex items-center gap-2 px-4 py-2 rounded-xl text-white font-600 text-sm" style="background:#E8192C;">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke="white" stroke-width="2.5" stroke-linecap="round"/></svg>
            Add User
          </button>
        </div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table">
          <thead><tr><th>User</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th><th>Last Login</th><th>Actions</th></tr></thead>
          <tbody id="user-table-body"></tbody>
        </table>
        <div id="no-users" class="hidden py-12 text-center text-gray-400 text-sm">No users found.</div>
      </div>
    </div>

    <!-- ===== ALL ORDERS ===== -->
    <div id="page-orders" class="page hidden">
      <div class="flex items-center gap-2 mb-5 flex-wrap">
        <div class="tab-pill active" onclick="filterOrders('all',this)">All</div>
        <div class="tab-pill" onclick="filterOrders('pending',this)">Pending</div>
        <div class="tab-pill" onclick="filterOrders('confirmed',this)">Confirmed</div>
        <div class="tab-pill" onclick="filterOrders('shipped',this)">Shipped</div>
        <div class="tab-pill" onclick="filterOrders('delivered',this)">Delivered</div>
        <div class="tab-pill" onclick="filterOrders('cancelled',this)">Cancelled</div>
        <div class="ml-auto flex gap-2">
          <div class="relative"><input id="order-search" oninput="renderOrders()" class="search-input" style="width:200px;" placeholder="Search orders…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
          <select id="order-sort" onchange="renderOrders()" class="select-field"><option value="newest">Newest First</option><option value="oldest">Oldest First</option><option value="high">High Value</option></select>
        </div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table"><thead><tr><th>Order ID</th><th>Date</th><th>Customer</th><th>Agent</th><th>Items</th><th>Amount</th><th>Payment</th><th>Status</th><th>Action</th></tr></thead>
        <tbody id="orders-table-body"></tbody></table>
        <div id="no-orders" class="hidden py-12 text-center text-gray-400 text-sm">No orders found.</div>
      </div>
    </div>

    <!-- ===== PRODUCTS ===== -->
    <div id="page-products" class="page hidden">
      <div class="flex items-center gap-2 mb-5 flex-wrap">
        <div class="tab-pill active" onclick="filterProds('all',this)">All Products</div>
        <div class="tab-pill" onclick="filterProds('low',this)">Low Stock</div>
        <div class="tab-pill" onclick="filterProds('expiring',this)">Expiring Soon</div>
        <div class="tab-pill" onclick="filterProds('expired',this)">Expired</div>
        <div class="ml-auto relative"><input id="prod-search" oninput="renderProducts()" class="search-input" style="width:200px;" placeholder="Search…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table"><thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Stock</th><th>Min Stock</th><th>Expiry</th><th>Location</th><th>Status</th></tr></thead>
        <tbody id="products-table-body"></tbody></table>
      </div>
    </div>

    <!-- ===== CUSTOMERS ===== -->
    <div id="page-customers" class="page hidden">
      <div class="flex items-center gap-2 mb-5">
        <div class="tab-pill active" onclick="filterCusts('all',this)">All</div>
        <div class="tab-pill" onclick="filterCusts('vip',this)">⭐ VIP</div>
        <div class="tab-pill" onclick="filterCusts('regular',this)">Regular</div>
        <div class="tab-pill" onclick="filterCusts('new',this)">New</div>
        <div class="ml-auto relative"><input id="cust-search" oninput="renderCustomers()" class="search-input" style="width:200px;" placeholder="Search…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table"><thead><tr><th>Customer</th><th>Phone</th><th>City</th><th>Orders</th><th>Total Spend</th><th>Last Order</th><th>Tier</th><th>Action</th></tr></thead>
        <tbody id="cust-table-body"></tbody></table>
      </div>
    </div>

    <!-- ===== ROLES & PERMISSIONS ===== -->
    <div id="page-roles" class="page hidden">
      <div class="grid grid-cols-2 gap-5">
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 text-sm mb-4">Roles Overview</div>
          <div class="flex flex-col gap-3" id="roles-list"></div>
        </div>
        <div class="card p-5">
          <div class="font-syne font-700 text-gray-800 text-sm mb-4">Permission Matrix</div>
          <div id="perm-matrix"></div>
        </div>
      </div>
    </div>

    <!-- ===== ACTIVITY LOG ===== -->
    <div id="page-activity" class="page hidden">
      <div class="flex items-center gap-2 mb-5">
        <div class="tab-pill active" onclick="filterActivity('all',this)">All</div>
        <div class="tab-pill" onclick="filterActivity('auth',this)">Auth</div>
        <div class="tab-pill" onclick="filterActivity('order',this)">Orders</div>
        <div class="tab-pill" onclick="filterActivity('user',this)">Users</div>
        <div class="tab-pill" onclick="filterActivity('system',this)">System</div>
        <div class="ml-auto relative"><input id="activity-search" oninput="renderActivity()" class="search-input" style="width:200px;" placeholder="Search logs…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table"><thead><tr><th>Time</th><th>User</th><th>Action</th><th>Module</th><th>IP Address</th><th>Status</th></tr></thead>
        <tbody id="activity-table-body"></tbody></table>
      </div>
    </div>

    <!-- ===== SETTINGS ===== -->
    <div id="page-settings" class="page hidden">
      <div class="grid grid-cols-3 gap-5">
        <!-- General -->
        <div class="col-span-2 flex flex-col gap-5">
          <div class="card p-6">
            <div class="font-syne font-700 text-gray-800 mb-5">General Settings</div>
            <div class="grid grid-cols-2 gap-4">
              <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Business Name</label><input class="input-field" value="FreshStock Grocery"/></div>
              <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Currency</label><select class="input-field"><option>₹ INR</option><option>£ GBP</option><option>$ USD</option></select></div>
              <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Admin Email</label><input class="input-field" value="admin@freshstock.com"/></div>
              <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Support Phone</label><input class="input-field" value="+91 98765 43210"/></div>
              <div class="col-span-2"><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Business Address</label><textarea class="input-field" rows="2">MP Nagar, Bhopal, Madhya Pradesh 462011</textarea></div>
            </div>
            <button onclick="showToast('✓ Settings saved','#00C48C')" class="mt-5 px-5 py-2.5 rounded-xl text-white font-600 text-sm" style="background:#E8192C;">Save Changes</button>
          </div>
          <div class="card p-6">
            <div class="font-syne font-700 text-gray-800 mb-5">Notification Preferences</div>
            <div class="flex flex-col gap-4" id="notif-settings"></div>
          </div>
        </div>
        <!-- Right column -->
        <div class="flex flex-col gap-5">
          <div class="card p-5">
            <div class="font-syne font-700 text-gray-800 mb-4">Feature Toggles</div>
            <div class="flex flex-col gap-4" id="feature-toggles"></div>
          </div>
          <div class="card p-5">
            <div class="font-syne font-700 text-gray-800 mb-4">Danger Zone</div>
            <div class="flex flex-col gap-3">
              <button onclick="showToast('⚠️ Cache cleared','#FF9500')" class="w-full py-2.5 rounded-xl border border-orange-200 text-orange-600 font-600 text-sm hover:bg-orange-50">Clear Cache</button>
              <button onclick="showToast('✓ Backup started','#0A84FF')" class="w-full py-2.5 rounded-xl border border-blue-200 text-blue-600 font-600 text-sm hover:bg-blue-50">Manual Backup</button>
              <button onclick="showToast('⚠️ Maintenance mode ON','#E8192C')" class="w-full py-2.5 rounded-xl border border-red-200 text-red-600 font-600 text-sm hover:bg-red-50">Maintenance Mode</button>
            </div>
          </div>
          <div class="card p-5">
            <div class="font-syne font-700 text-gray-800 mb-3">App Version</div>
            <div class="text-xs text-gray-500 flex flex-col gap-1">
              <div class="flex justify-between"><span>Version</span><span class="font-700 text-gray-700">v2.4.1</span></div>
              <div class="flex justify-between"><span>Last Update</span><span class="font-700 text-gray-700">30 Mar 2026</span></div>
              <div class="flex justify-between"><span>Environment</span><span class="badge badge-green text-xs">Production</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- USER MODAL -->
<div id="user-modal" class="modal-overlay hidden">
  <div class="modal-box" style="max-width:580px;">
    <div class="flex items-center justify-between mb-5">
      <div class="font-syne font-800 text-gray-800 text-xl" id="user-modal-title">Add New User</div>
      <button onclick="closeModal('user-modal')" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 text-xl">&times;</button>
    </div>
    <div id="user-modal-body"></div>
  </div>
</div>

<div id="toast" class="hidden"></div>

<script>
// ===== DATA =====
const ROLES=['admin','sales_manager','inventory_manager','delivery_agent','customer'];
const ROLE_LABELS={admin:'Admin',sales_manager:'Sales Manager',inventory_manager:'Inventory Manager',delivery_agent:'Delivery Agent',customer:'Customer'};
const ROLE_COLORS={admin:'badge-red',sales_manager:'badge-purple',inventory_manager:'badge-blue',delivery_agent:'badge-yellow',customer:'badge-gray'};
const STATUSES_ORDER=['pending','confirmed','packed','shipped','delivered','cancelled'];
const PAYMENTS=['COD','UPI','Card','Prepaid'];

function rnd(a,b){return Math.floor(Math.random()*(b-a+1))+a;}
function daysAgo(n){const d=new Date('2026-03-31');d.setDate(d.getDate()-n);return d.toISOString().split('T')[0];}

// const NAMES=['Priya Sharma','Ravi Kumar','Sunita Patel','Amit Joshi','Deepa Nair','Vikram Singh','Meena Gupta','Arjun Verma','Kavya Reddy','Suresh Nair','Pooja Shah','Rahul Mehta','Anita Singh','Kiran Patel','Mohan Das'];
// const AREAS=['Sector 4, Bhopal','MP Nagar, Bhopal','Arera Colony, Bhopal','Kolar Road, Bhopal','Habibganj, Bhopal','Shahpura, Bhopal','Indore','Jabalpur'];

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
  'Ethan Harris',
  'Emily Turner',
  'James Scott',
  'Charlotte Hill'
];

const AREAS = [
  'Camden, London',
  'Canary Wharf, London',
  'Greenwich, London',
  'Hackney, London',
  'Chelsea, London',
  'Kensington, London',
  'Manchester City Centre',
  'Birmingham City Centre'
];

let users = Array.from({length:20},(_,i)=>{
  const role = i===0?'admin':i<3?'sales_manager':i<6?'inventory_manager':i<12?'delivery_agent':'customer';
  const name = NAMES[i%NAMES.length];
  return {
    id: i+1, name,
    email: name.split(' ')[0].toLowerCase()+'@freshstock.com',
    role, status: rnd(0,9)>1?'active':'inactive',
    joined: daysAgo(rnd(10,180)),
    lastLogin: daysAgo(rnd(0,7)),
    phone: `98${rnd(10000000,99999999)}`,
  };
});
let nextUserId = 21;

const PRODUCTS = [
  {id:1,name:'Fresh Tomatoes',cat:'Vegetables',price:40,qty:120,min:20,expiry:'2026-04-25',aisle:'A1',rack:'R1',basket:'B-01'},
  {id:2,name:'Organic Milk',cat:'Dairy',price:65,qty:8,min:15,expiry:'2026-04-05',aisle:'B2',rack:'R3',basket:'B-05'},
  {id:3,name:'Basmati Rice',cat:'Grains',price:120,qty:200,min:30,expiry:'2027-01-01',aisle:'C1',rack:'R5',basket:'B-10'},
  {id:4,name:'Alphonso Mangoes',cat:'Fruits',price:250,qty:4,min:10,expiry:'2026-04-03',aisle:'A2',rack:'R2',basket:'B-03'},
  {id:5,name:'Green Tea',cat:'Beverages',price:180,qty:55,min:10,expiry:'2027-06-30',aisle:'D1',rack:'R9',basket:'B-15'},
  {id:6,name:'Whole Wheat Bread',cat:'Snacks',price:55,qty:3,min:12,expiry:'2026-04-02',aisle:'A1',rack:'R1',basket:'B-02'},
  {id:7,name:'Frozen Peas',cat:'Frozen',price:95,qty:40,min:15,expiry:'2026-11-15',aisle:'D2',rack:'R10',basket:'B-18'},
  {id:8,name:'Amul Butter',cat:'Dairy',price:58,qty:6,min:10,expiry:'2026-04-08',aisle:'B1',rack:'R4',basket:'B-06'},
  {id:9,name:'Onions',cat:'Vegetables',price:30,qty:150,min:40,expiry:'2026-05-20',aisle:'A2',rack:'R2',basket:'B-04'},
  {id:10,name:'Orange Juice',cat:'Beverages',price:140,qty:22,min:8,expiry:'2026-04-20',aisle:'D1',rack:'R9',basket:'B-16'},
];
const EMOJIS={Vegetables:'🥦',Fruits:'🍎',Dairy:'🥛',Grains:'🌾',Beverages:'🧃',Spices:'🌶️',Snacks:'🍪',Frozen:'🧊'};

const customers = Array.from({length:10},(_,i)=>({
  id:i+1, name:NAMES[i], phone:`98${rnd(10000000,99999999)}`,
  city:AREAS[rnd(0,AREAS.length-1)], orders:rnd(1,60),
  spend:rnd(1000,60000), last:daysAgo(rnd(0,30)),
  tier:['vip','vip','regular','regular','regular','new','new','new','vip','regular'][i],
  email:NAMES[i].split(' ')[0].toLowerCase()+'@email.com'
}));

// const agentNames=['Arjun Kumar','Dev Patel','Sunil Rao','Mohan Singh'];
const agentNames = [
  'James Wilson',
  'Daniel Hughes',
  'Michael Turner',
  'Thomas Baker'
];
const orders = Array.from({length:50},(_,i)=>{
  const cust=customers[rnd(0,customers.length-1)];
  const items=Array.from({length:rnd(1,4)},()=>{const p=PRODUCTS[rnd(0,PRODUCTS.length-1)];const q=rnd(1,4);return{name:p.name,qty:q,price:p.price};});
  return{
    id:`ORD-${1000+i}`, date:daysAgo(rnd(0,14)),
    custName:cust.name, custPhone:cust.phone,
    agent:agentNames[rnd(0,3)],
    items, itemCount:items.reduce((s,x)=>s+x.qty,0),
    amount:items.reduce((s,x)=>s+x.price*x.qty,0),
    payment:PAYMENTS[rnd(0,3)],
    status:STATUSES_ORDER[rnd(0,5)],
  };
});

const activityLogs = Array.from({length:30},(_,i)=>{
  const types=['auth','order','user','system'];
  const type=types[rnd(0,3)];
  const actions={
    auth:['User logged in','Password changed','Login failed','Session expired'],
    order:['Order created','Order cancelled','Status updated','Payment received'],
    user:['User created','Role updated','User disabled','Permission changed'],
    system:['Backup completed','Cache cleared','Settings updated','Maintenance started'],
  };
  const u=users[rnd(0,users.length-1)];
  return{
    id:i+1, time:daysAgo(rnd(0,3))+` ${rnd(8,22)}:${String(rnd(0,59)).padStart(2,'0')}`,
    user:u.name, role:u.role,
    action:actions[type][rnd(0,3)], type,
    ip:`192.168.${rnd(1,5)}.${rnd(10,250)}`,
    status:rnd(0,9)>1?'success':'failed',
  };
});

const PERMISSIONS = ['View','Create','Edit','Delete','Export'];
const ROLE_PERMS = {
  admin:{View:true,Create:true,Edit:true,Delete:true,Export:true},
  sales_manager:{View:true,Create:true,Edit:true,Delete:false,Export:true},
  inventory_manager:{View:true,Create:true,Edit:true,Delete:false,Export:false},
  delivery_agent:{View:true,Create:false,Edit:false,Delete:false,Export:false},
  customer:{View:true,Create:false,Edit:false,Delete:false,Export:false},
};

// ===== UTILS =====
function avt(name,size){
  const s=size==='lg'?38:size==='xl'?52:28, fs=size==='lg'?13:size==='xl'?16:10;
  const init=(name||'?').split(' ').map(x=>x[0]).join('').slice(0,2).toUpperCase();
  return `<div class="avatar" style="width:${s}px;height:${s}px;background:#FFF0F0;color:#E8192C;font-size:${fs}px;">${init}</div>`;
}
function roleBadge(r){return `<span class="badge ${ROLE_COLORS[r]||'badge-gray'}">${ROLE_LABELS[r]||r}</span>`;}
function statusBadge(s){
  const m={pending:'badge-yellow',confirmed:'badge-blue',packed:'badge-purple',shipped:'badge-orange',delivered:'badge-green',cancelled:'badge-red',active:'badge-green',inactive:'badge-gray',success:'badge-green',failed:'badge-red'};
  return `<span class="badge ${m[s]||'badge-gray'}">${s.charAt(0).toUpperCase()+s.slice(1)}</span>`;
}
function tierBadge(t){return t==='vip'?'<span class="badge badge-yellow">⭐ VIP</span>':t==='new'?'<span class="badge badge-blue">New</span>':'<span class="badge badge-gray">Regular</span>';}
function typeBadge(t){const m={auth:'badge-purple',order:'badge-blue',user:'badge-teal',system:'badge-gray'};return `<span class="badge ${m[t]||'badge-gray'}">${t}</span>`;}

// ===== PAGES =====
const PAGES=['dashboard','analytics','users','orders','products','customers','roles','activity','settings'];
function showPage(p, el){
  PAGES.forEach(x=>document.getElementById('page-'+x).classList.add('hidden'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  document.getElementById('page-'+p).classList.remove('hidden');
  if(el) el.classList.add('active');
  else document.querySelectorAll('.nav-item').forEach(n=>{if(n.textContent.trim().toLowerCase().startsWith(p.replace('_',' ')))n.classList.add('active');});
  const titles={dashboard:'Dashboard',analytics:'Analytics',users:'Users & Roles',orders:'All Orders',products:'Products',customers:'Customers',roles:'Roles & Permissions',activity:'Activity Log',settings:'Settings'};
  document.getElementById('page-title').textContent=titles[p];
  const renders={users:renderUsers,orders:renderOrders,products:renderProducts,customers:renderCustomers,roles:renderRoles,activity:renderActivity,analytics:renderAnalytics,settings:renderSettings};
  if(renders[p]) renders[p]();
}

// ===== DASHBOARD =====
function initDashboard(){
  [{id:'spark1',c:'#E8192C'},{id:'spark2',c:'#0A84FF'},{id:'spark3',c:'#6C63FF'},{id:'spark4',c:'#00C48C'}].forEach(({id,c})=>{
    const el=document.getElementById(id);if(!el)return;
    el.innerHTML=Array.from({length:8},()=>rnd(20,100)).map(h=>`<span style="height:${h}%;background:${c}44;width:5px;border-radius:1px 1px 0 0;"></span>`).join('');
  });
  const months=['Oct','Nov','Dec','Jan','Feb','Mar'],vals=[145,189,240,167,260,310],maxV=Math.max(...vals);
  document.getElementById('rev-bars').innerHTML=vals.map((v,i)=>`<div class="flex-1 flex flex-col items-center justify-end"><div class="w-full rounded-t-lg" style="height:${Math.round(v/maxV*130)}px;background:${i===5?'#E8192C':'#FFF0F0'};"></div></div>`).join('');
  document.getElementById('rev-labels').innerHTML=months.map(m=>`<span class="text-xs text-gray-400 flex-1 text-center">${m}</span>`).join('');
  const roleCounts={};users.forEach(u=>{roleCounts[u.role]=(roleCounts[u.role]||0)+1;});
  const totalUsers=users.length;
  document.getElementById('role-dist').innerHTML=Object.entries(roleCounts).map(([r,c])=>`
    <div class="flex items-center gap-3">
      ${roleBadge(r)}
      <div class="flex-1"><div class="prog-track"><div class="prog-fill" style="width:${Math.round(c/totalUsers*100)}%;background:#E8192C;"></div></div></div>
      <span class="text-xs font-700 text-gray-700">${c}</span>
    </div>`).join('');
  document.getElementById('new-users-dash').innerHTML=[...users].sort((a,b)=>b.joined.localeCompare(a.joined)).slice(0,5).map(u=>`
    <div class="flex items-center justify-between p-2.5 rounded-lg" style="background:#F8F9FD;">
      <div class="flex items-center gap-2">${avt(u.name)}<div><div class="text-xs font-600 text-gray-700">${u.name}</div><div class="text-xs text-gray-400">${u.joined}</div></div></div>
      ${roleBadge(u.role)}
    </div>`).join('');
  const acts=[
    {icon:'👤',text:'New user registered: Joe Root',time:'3 min ago'},
    {icon:'📦',text:'Order ORD-1049 delivered',time:'12 min ago'},
    {icon:'⚠️',text:'Low stock alert: Whole Wheat Bread',time:'28 min ago'},
    {icon:'🔐',text:'Admin login from 192.168.1.42',time:'1 hr ago'},
    {icon:'💰',text:'£18,420 revenue milestone reached',time:'2 hr ago'},
  ];
  document.getElementById('dash-activity').innerHTML=acts.map(a=>`
    <div class="flex items-start gap-3 p-2.5 rounded-lg" style="background:#F8F9FD;">
      <span class="text-sm mt-0.5">${a.icon}</span>
      <div><div class="text-xs text-gray-700 font-600">${a.text}</div><div class="text-xs text-gray-400">${a.time}</div></div>
    </div>`).join('');
}

// ===== USERS =====
let userFilter='all';
function filterUsers(f,el){userFilter=f;document.querySelectorAll('#page-users .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderUsers();}
function renderUsers(){
  const q=(document.getElementById('user-search')?.value||'').toLowerCase();
  let list=[...users];
  if(userFilter!=='all')list=list.filter(u=>u.role===userFilter);
  if(q)list=list.filter(u=>u.name.toLowerCase().includes(q)||u.email.toLowerCase().includes(q));
  const tbody=document.getElementById('user-table-body');
  const noEl=document.getElementById('no-users');
  if(!list.length){tbody.innerHTML='';noEl.classList.remove('hidden');return;}
  noEl.classList.add('hidden');
  tbody.innerHTML=list.map(u=>`
    <tr class="row-hover" onclick="openUserModal(${u.id})">
      <td><div class="flex items-center gap-3">${avt(u.name)}<div><div class="text-xs font-600 text-gray-700">${u.name}</div><div class="text-xs text-gray-400">${u.phone}</div></div></div></td>
      <td class="text-xs text-gray-500">${u.email}</td>
      <td>${roleBadge(u.role)}</td>
      <td>${statusBadge(u.status)}</td>
      <td class="text-xs text-gray-500">${u.joined}</td>
      <td class="text-xs text-gray-500">${u.lastLogin}</td>
      <td onclick="event.stopPropagation()">
        <div class="flex gap-1">
          <button onclick="openUserModal(${u.id})" class="text-xs px-2 py-1 rounded-lg font-600" style="background:#FFF0F0;color:#E8192C;">Edit</button>
          <button onclick="toggleUserStatus(${u.id})" class="text-xs px-2 py-1 rounded-lg font-600 border border-gray-200 text-gray-500 hover:bg-gray-50">${u.status==='active'?'Disable':'Enable'}</button>
        </div>
      </td>
    </tr>`).join('');
}
function toggleUserStatus(id){const u=users.find(x=>x.id===id);if(u){u.status=u.status==='active'?'inactive':'active';renderUsers();showToast(`✓ ${u.name} ${u.status}`,'#00C48C');}}

// ===== USER MODAL =====
function openUserModal(id){
  const u=id?users.find(x=>x.id===id):null;
  document.getElementById('user-modal-title').textContent=u?'Edit User':'Add New User';
  document.getElementById('user-modal-body').innerHTML=`
    <div class="grid grid-cols-2 gap-4 mb-4">
      <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Full Name *</label><input id="um-name" class="input-field" value="${u?u.name:''}" placeholder="Full name"/></div>
      <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Email *</label><input id="um-email" class="input-field" value="${u?u.email:''}" placeholder="email@example.com"/></div>
      <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Phone</label><input id="um-phone" class="input-field" value="${u?u.phone:''}" placeholder="+91 98765 43210"/></div>
      <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Role *</label>
        <select id="um-role" class="input-field">
          ${ROLES.map(r=>`<option value="${r}" ${u&&u.role===r?'selected':''}>${ROLE_LABELS[r]}</option>`).join('')}
        </select>
      </div>
      ${!u?`<div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Password *</label><input id="um-pass" type="password" class="input-field" placeholder="Min 8 characters"/></div>`:''}
      <div><label class="block text-xs font-700 text-gray-500 mb-1.5 uppercase tracking-wider">Status</label>
        <select id="um-status" class="input-field">
          <option value="active" ${!u||u.status==='active'?'selected':''}>Active</option>
          <option value="inactive" ${u&&u.status==='inactive'?'selected':''}>Inactive</option>
        </select>
      </div>
    </div>
    ${u?`<div class="p-3 rounded-xl bg-gray-50 border border-gray-100 mb-4 text-xs text-gray-500">
      <div class="flex gap-6"><span>Joined: <strong>${u.joined}</strong></span><span>Last Login: <strong>${u.lastLogin}</strong></span></div>
    </div>`:''}
    <div class="flex gap-3">
      <button onclick="closeModal('user-modal')" class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-600 text-sm">Cancel</button>
      <button onclick="saveUser(${id||'null'})" class="flex-1 py-2.5 rounded-xl text-white font-700 text-sm" style="background:#E8192C;">${u?'Save Changes':'Create User'}</button>
    </div>`;
  document.getElementById('user-modal').classList.remove('hidden');
}
function saveUser(id){
  const name=document.getElementById('um-name')?.value.trim();
  const email=document.getElementById('um-email')?.value.trim();
  const role=document.getElementById('um-role')?.value;
  const status=document.getElementById('um-status')?.value;
  const phone=document.getElementById('um-phone')?.value.trim();
  if(!name||!email){showToast('⚠️ Name and email required','#E8192C');return;}
  if(id){const u=users.find(x=>x.id===id);if(u){Object.assign(u,{name,email,role,status,phone});}}
  else{users.unshift({id:nextUserId++,name,email,role,status,phone,joined:daysAgo(0),lastLogin:'—'});}
  closeModal('user-modal');showToast(`✓ User ${id?'updated':'created'}`,'#00C48C');renderUsers();
}

// ===== ORDERS =====
let orderFilter='all';
function filterOrders(f,el){orderFilter=f;document.querySelectorAll('#page-orders .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderOrders();}
function renderOrders(){
  const q=(document.getElementById('order-search')?.value||'').toLowerCase();
  const sort=document.getElementById('order-sort')?.value||'newest';
  let list=[...orders];
  if(orderFilter!=='all')list=list.filter(o=>o.status===orderFilter);
  if(q)list=list.filter(o=>o.id.toLowerCase().includes(q)||o.custName.toLowerCase().includes(q)||o.agent.toLowerCase().includes(q));
  if(sort==='newest')list.sort((a,b)=>b.date.localeCompare(a.date));
  else if(sort==='oldest')list.sort((a,b)=>a.date.localeCompare(b.date));
  else list.sort((a,b)=>b.amount-a.amount);
  const tbody=document.getElementById('orders-table-body');
  const noEl=document.getElementById('no-orders');
  if(!list.length){tbody.innerHTML='';noEl.classList.remove('hidden');return;}
  noEl.classList.add('hidden');
  tbody.innerHTML=list.map(o=>`
    <tr class="row-hover">
      <td><span class="font-syne text-xs font-700" style="color:#E8192C;">${o.id}</span></td>
      <td class="text-xs text-gray-500">${o.date}</td>
      <td><div class="flex items-center gap-2">${avt(o.custName)}<div><div class="text-xs font-600 text-gray-700">${o.custName}</div><div class="text-xs text-gray-400">${o.custPhone}</div></div></div></td>
      <td class="text-xs text-gray-600">${o.agent}</td>
      <td class="text-xs text-gray-500">${o.itemCount} items</td>
      <td class="text-xs font-700 text-gray-800">£${o.amount.toLocaleString()}</td>
      <td><span class="badge ${o.payment==='COD'?'badge-yellow':'badge-blue'}">${o.payment}</span></td>
      <td>${statusBadge(o.status)}</td>
      <td>
        <select onchange="updateOrder('${o.id}',this.value)" class="select-field text-xs py-1 px-2">
          ${STATUSES_ORDER.map(s=>`<option value="${s}" ${o.status===s?'selected':''}>${s.charAt(0).toUpperCase()+s.slice(1)}</option>`).join('')}
        </select>
      </td>
    </tr>`).join('');
}
function updateOrder(id,v){const o=orders.find(x=>x.id===id);if(o){o.status=v;showToast(`✓ ${id} → ${v}`,'#00C48C');}}

// ===== PRODUCTS =====
let prodFilter='all';
function filterProds(f,el){prodFilter=f;document.querySelectorAll('#page-products .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderProducts();}
function renderProducts(){
  const today=new Date('2026-03-31');
  const q=(document.getElementById('prod-search')?.value||'').toLowerCase();
  let list=PRODUCTS.map(p=>({...p,days:Math.ceil((new Date(p.expiry)-today)/86400000)}));
  if(prodFilter==='low')list=list.filter(p=>p.qty<=p.min);
  else if(prodFilter==='expiring')list=list.filter(p=>p.days>=0&&p.days<=14);
  else if(prodFilter==='expired')list=list.filter(p=>p.days<0);
  if(q)list=list.filter(p=>p.name.toLowerCase().includes(q)||p.cat.toLowerCase().includes(q));
  document.getElementById('products-table-body').innerHTML=list.map(p=>{
    const isLow=p.qty<=p.min;
    const pct=Math.min(100,Math.round((p.qty/(p.min*3))*100));
    const expClass=p.days<0?'text-red-500':p.days<=7?'text-red-500':p.days<=14?'text-orange-500':'text-green-600';
    const expLabel=p.days<0?`Expired ${Math.abs(p.days)}d ago`:p.days===0?'Today!':p.days+'d left';
    return `<tr class="row-hover">
      <td><div class="flex items-center gap-2"><span class="text-base">${EMOJIS[p.cat]||'📦'}</span><span class="text-xs font-600 text-gray-700">${p.name}</span></div></td>
      <td><span class="badge badge-purple">${p.cat}</span></td>
      <td class="text-xs font-700 text-gray-800">£${p.price}</td>
      <td><div class="font-syne font-700 text-xs ${isLow?'text-red-500':'text-gray-800'}">${p.qty}</div><div class="prog-track w-14 mt-1"><div class="prog-fill" style="width:${pct}%;background:${isLow?'#E8192C':'#00C48C'};"></div></div></td>
      <td class="text-xs text-gray-400">${p.min}</td>
      <td class="text-xs ${expClass} font-600">${expLabel}</td>
      <td class="text-xs text-gray-500">${p.aisle}·${p.rack}·${p.basket}</td>
      <td>
        ${isLow?'<span class="badge badge-red">Low Stock</span>':'<span class="badge badge-green">In Stock</span>'}
        ${p.days<0?'<span class="badge badge-red ml-1">Expired</span>':p.days>=0&&p.days<=14?'<span class="badge badge-yellow ml-1">Exp. Soon</span>':''}
      </td>
    </tr>`;}).join('');
}

// ===== CUSTOMERS =====
let custFilter='all';
function filterCusts(f,el){custFilter=f;document.querySelectorAll('#page-customers .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderCustomers();}
function renderCustomers(){
  const q=(document.getElementById('cust-search')?.value||'').toLowerCase();
  let list=[...customers];
  if(custFilter!=='all')list=list.filter(c=>c.tier===custFilter);
  if(q)list=list.filter(c=>c.name.toLowerCase().includes(q)||c.city.toLowerCase().includes(q));
  list.sort((a,b)=>b.spend-a.spend);
  document.getElementById('cust-table-body').innerHTML=list.map(c=>`
    <tr class="row-hover">
      <td><div class="flex items-center gap-3">${avt(c.name)}<div><div class="text-xs font-600 text-gray-700">${c.name}</div><div class="text-xs text-gray-400">${c.email}</div></div></div></td>
      <td class="text-xs text-gray-500">${c.phone}</td>
      <td class="text-xs text-gray-500">📍 ${c.city}</td>
      <td class="text-xs font-700 text-gray-800 text-center">${c.orders}</td>
      <td class="text-xs font-700 text-gray-800">£${c.spend.toLocaleString()}</td>
      <td class="text-xs text-gray-500">${c.last}</td>
      <td>${tierBadge(c.tier)}</td>
      <td><button class="text-xs px-2 py-1 rounded-lg font-600" style="background:#FFF0F0;color:#E8192C;">View</button></td>
    </tr>`).join('');
}

// ===== ROLES =====
function renderRoles(){
  const roleCounts={};users.forEach(u=>{roleCounts[u.role]=(roleCounts[u.role]||0)+1;});
  document.getElementById('roles-list').innerHTML=ROLES.map(r=>`
    <div class="flex items-center justify-between p-3 rounded-xl border border-gray-100" style="background:#F8F9FD;">
      <div class="flex items-center gap-3">
        ${roleBadge(r)}
        <span class="text-xs text-gray-500">${roleCounts[r]||0} users</span>
      </div>
      <button onclick="showToast('⚠️ Role editing coming soon','#FF9500')" class="text-xs px-2 py-1 rounded-lg border border-gray-200 text-gray-500 hover:bg-white">Edit Perms</button>
    </div>`).join('');

  document.getElementById('perm-matrix').innerHTML=`
    <div class="overflow-x-auto">
      <table class="w-full text-xs">
        <thead>
          <tr>
            <th class="text-left py-2 text-gray-500 font-700 uppercase tracking-wider">Role</th>
            ${PERMISSIONS.map(p=>`<th class="text-center py-2 text-gray-500 font-700 uppercase tracking-wider">${p}</th>`).join('')}
          </tr>
        </thead>
        <tbody>
          ${ROLES.map(r=>`
            <tr class="border-t border-gray-100">
              <td class="py-3">${roleBadge(r)}</td>
              ${PERMISSIONS.map(p=>`
                <td class="py-3 text-center">
                  ${ROLE_PERMS[r][p]
                    ?'<span style="color:#00C48C;font-size:16px;">✓</span>'
                    :'<span style="color:#D1D5DB;font-size:16px;">✕</span>'}
                </td>`).join('')}
            </tr>`).join('')}
        </tbody>
      </table>
    </div>`;
}

// ===== ACTIVITY LOG =====
let activityFilter='all';
function filterActivity(f,el){activityFilter=f;document.querySelectorAll('#page-activity .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderActivity();}
function renderActivity(){
  const q=(document.getElementById('activity-search')?.value||'').toLowerCase();
  let list=[...activityLogs];
  if(activityFilter!=='all')list=list.filter(a=>a.type===activityFilter);
  if(q)list=list.filter(a=>a.action.toLowerCase().includes(q)||a.user.toLowerCase().includes(q));
  document.getElementById('activity-table-body').innerHTML=list.map(a=>`
    <tr>
      <td class="text-xs text-gray-500 font-mono">${a.time}</td>
      <td><div class="flex items-center gap-2">${avt(a.user)}<div><div class="text-xs font-600 text-gray-700">${a.user}</div><div class="text-xs text-gray-400">${ROLE_LABELS[a.role]||a.role}</div></div></div></td>
      <td class="text-xs text-gray-700 font-600">${a.action}</td>
      <td>${typeBadge(a.type)}</td>
      <td class="text-xs text-gray-400 font-mono">${a.ip}</td>
      <td>${statusBadge(a.status)}</td>
    </tr>`).join('');
}

// ===== ANALYTICS =====
function renderAnalytics(){
  const cats=['Vegetables','Fruits','Dairy','Grains','Beverages','Snacks'];
  const catVals=[38400,22100,41200,19800,28700,14500];
  const maxCat=Math.max(...catVals);
  const catColors=['#E8192C','#0A84FF','#00C48C','#FF9500','#6C63FF','#FF6B00'];
  document.getElementById('analytics-cat').innerHTML=cats.map((c,i)=>`
    <div class="flex items-center gap-3"><span class="text-base">${EMOJIS[c]||'📦'}</span><div class="flex-1"><div class="flex justify-between mb-1"><span class="text-xs text-gray-500">${c}</span><span class="text-xs font-700 text-gray-800">£${catVals[i].toLocaleString()}</span></div><div class="prog-track"><div class="prog-fill" style="width:${Math.round(catVals[i]/maxCat*100)}%;background:${catColors[i]};"></div></div></div></div>`).join('');

  const statusCounts={};orders.forEach(o=>{statusCounts[o.status]=(statusCounts[o.status]||0)+1;});
  const maxStat=Math.max(...Object.values(statusCounts));
  const statColors={pending:'#FF9500',confirmed:'#0A84FF',packed:'#6C63FF',shipped:'#FF6B00',delivered:'#00C48C',cancelled:'#E8192C'};
  document.getElementById('analytics-status').innerHTML=Object.entries(statusCounts).map(([s,v])=>`
    <div class="flex items-center gap-3">${statusBadge(s)}<div class="flex-1"><div class="prog-track"><div class="prog-fill" style="width:${Math.round(v/maxStat*100)}%;background:${statColors[s]||'#aaa'};"></div></div></div><span class="text-xs font-700 text-gray-800 w-6 text-right">${v}</span></div>`).join('');

  // const areas=[['MP Nagar',84,'£38,400','96%'],['Arera Colony',72,'£31,200','94%'],['Habibganj',61,'£27,800','91%'],['Kolar Road',54,'£23,100','89%'],['Shahpura',43,'£18,500','87%']];
  const areas = [
    ['Camden', 84, '£38,400', '96%'],
    ['Canary Wharf', 72, '£31,200', '94%'],
    ['Greenwich', 61, '£27,800', '91%'],
    ['Hackney', 54, '£23,100', '89%'],
    ['Kensington', 43, '£18,500', '87%']
  ];
  document.getElementById('analytics-areas').innerHTML=areas.map(([a,o,r,d])=>`<tr><td class="text-xs text-gray-700">${a}</td><td class="text-xs font-700 text-gray-800 text-center">${o}</td><td class="text-xs font-700 text-gray-800">${r}</td><td class="text-xs text-green-600 font-700 text-center">${d}</td></tr>`).join('');

  const agentData=agentNames.map(n=>({name:n,delivered:rnd(12,22),failed:rnd(0,3),rating:(3.5+Math.random()*1.5).toFixed(1)}));
  document.getElementById('analytics-agents').innerHTML=agentData.map(a=>`<tr><td><div class="flex items-center gap-2">${avt(a.name)}<span class="text-xs text-gray-700">${a.name}</span></div></td><td class="text-xs font-700 text-green-600 text-center">${a.delivered}</td><td class="text-xs font-700 text-red-500 text-center">${a.failed}</td><td class="text-xs font-700 text-orange-500 text-center">⭐ ${a.rating}</td></tr>`).join('');
}

// ===== SETTINGS =====
function renderSettings(){
  const notifs=['New order received','Order status changed','Low stock alert','Delivery failure','New user registered','Daily revenue report'];
  const notifStates=[true,true,true,false,true,false];
  document.getElementById('notif-settings').innerHTML=notifs.map((n,i)=>`
    <div class="flex items-center justify-between">
      <span class="text-sm text-gray-700">${n}</span>
      <div class="toggle ${notifStates[i]?'on':'off'}" onclick="this.classList.toggle('on');this.classList.toggle('off');showToast('✓ Notification updated','#00C48C')">
        <div class="toggle-thumb"></div>
      </div>
    </div>`).join('');

  const features=[['Online Ordering','Allow customer online orders',true],['COD Payments','Enable cash on delivery',true],['Auto Reorder','Auto reorder when low stock',false],['Agent Tracking','Real-time delivery tracking',true],['Customer Reviews','Allow product reviews',false],['Promo Codes','Enable discount codes',true]];
  document.getElementById('feature-toggles').innerHTML=features.map(([n,d,s])=>`
    <div class="flex items-start justify-between gap-3">
      <div><div class="text-xs font-600 text-gray-700">${n}</div><div class="text-xs text-gray-400">${d}</div></div>
      <div class="toggle ${s?'on':'off'}" onclick="this.classList.toggle('on');this.classList.toggle('off');showToast('✓ Feature updated','#00C48C')">
        <div class="toggle-thumb"></div>
      </div>
    </div>`).join('');
}

// ===== MODAL / TOAST =====
function closeModal(id){document.getElementById(id).classList.add('hidden');}
function showToast(msg,color='#00C48C'){
  const t=document.getElementById('toast');
  t.textContent=msg;t.style.color=color;t.style.borderColor=color+'33';
  t.classList.remove('hidden');clearTimeout(t._to);t._to=setTimeout(()=>t.classList.add('hidden'),2800);
}
document.getElementById('user-modal').addEventListener('click',e=>{if(e.target===document.getElementById('user-modal'))closeModal('user-modal');});

initDashboard();
</script>
</body>
</html>