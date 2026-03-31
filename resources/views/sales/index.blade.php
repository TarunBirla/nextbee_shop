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
    <div class="nav-item" onclick="showPage('orders',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Orders
    </div>
    <div class="nav-item" onclick="showPage('customers',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Customers
    </div>
    <div class="nav-item" onclick="showPage('products',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="7" cy="7" r="1" fill="currentColor"/></svg>
      Products
    </div>
    <p class="px-5 pb-2 pt-4 text-xs font-600 text-white/30 uppercase tracking-widest">Analytics</p>
    <div class="nav-item" onclick="showPage('revenue',this)">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><polyline points="17 6 23 6 23 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      Revenue
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
      </div> --}}
      {{-- <button class="relative p-2 rounded-xl bg-gray-50 hover:bg-gray-100">
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

    <!-- DASHBOARD -->
    <div id="page-dashboard" class="page">
      <div class="grid grid-cols-5 gap-4 mb-6">
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Today's Revenue</div><div class="font-syne text-2xl font-800 text-gray-800">£48,290</div><div class="text-xs mt-2 font-600" style="color:#00C48C;">↑ 12.4% vs yesterday</div><div class="mini-bar mt-3" id="spark1"></div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Orders Today</div><div class="font-syne text-2xl font-800 text-gray-800">184</div><div class="text-xs mt-2 font-600" style="color:#0A84FF;">↑ 8 new in last hr</div><div class="mini-bar mt-3" id="spark2"></div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Active Customers</div><div class="font-syne text-2xl font-800 text-gray-800">1,247</div><div class="text-xs mt-2 font-600" style="color:#6C63FF;">+34 this week</div><div class="mini-bar mt-3" id="spark3"></div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Pending Orders</div><div class="font-syne text-2xl font-800" style="color:#FF9500;">23</div><div class="text-xs mt-2 text-gray-400">Awaiting confirmation</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 uppercase tracking-wider mb-3 font-600">Low Stock Alerts</div><div class="font-syne text-2xl font-800" style="color:#E8192C;">6</div><div class="text-xs mt-2 font-600" style="color:#E8192C;">Needs reorder</div></div>
      </div>

      <div class="grid grid-cols-3 gap-5 mb-5">
        <div class="col-span-2 card overflow-hidden">
          <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="font-syne font-700 text-gray-800 text-sm">Recent Orders</div>
            <button onclick="showPage('orders',null)" class="text-xs font-600 px-3 py-1.5 rounded-lg" style="background:#FFF0F0;color:#E8192C;">View All →</button>
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
            <div class="font-syne font-700 text-gray-800 text-sm">Top Customers</div>
            <button onclick="showPage('customers',null)" class="text-xs font-600 px-3 py-1.5 rounded-lg" style="background:#FFF0F0;color:#E8192C;">View All →</button>
          </div>
          <div class="p-3 flex flex-col gap-2" id="top-customers-dash"></div>
        </div>
      </div>
    </div>

    <!-- ORDERS -->
    <div id="page-orders" class="page hidden">
      <div class="flex items-center gap-2 mb-5 flex-wrap">
        <div class="tab-pill active" onclick="filterOrders('all',this)">All Orders</div>
        <div class="tab-pill" onclick="filterOrders('pending',this)">Pending</div>
        <div class="tab-pill" onclick="filterOrders('confirmed',this)">Confirmed</div>
        <div class="tab-pill" onclick="filterOrders('packed',this)">Packed</div>
        <div class="tab-pill" onclick="filterOrders('shipped',this)">Shipped</div>
        <div class="tab-pill" onclick="filterOrders('delivered',this)">Delivered</div>
        <div class="tab-pill" onclick="filterOrders('cancelled',this)">Cancelled</div>
        <div class="ml-auto flex gap-2">
          <div class="relative"><input id="order-search" oninput="renderOrderTable()" class="search-input" placeholder="Search orders…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
          <select id="order-sort" onchange="renderOrderTable()" class="select-field"><option value="newest">Newest First</option><option value="oldest">Oldest First</option><option value="high">Highest Value</option><option value="low">Lowest Value</option></select>
        </div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table"><thead><tr><th>Order ID</th><th>Date</th><th>Customer</th><th>Items</th><th>Amount</th><th>Payment</th><th>Status</th><th>Update</th></tr></thead><tbody id="order-table-body"></tbody></table>
        <div id="no-orders" class="hidden py-12 text-center text-gray-400 text-sm">No orders found.</div>
      </div>
    </div>

    <!-- CUSTOMERS -->
    <div id="page-customers" class="page hidden">
      <div class="flex items-center gap-2 mb-5">
        <div class="tab-pill active" onclick="filterCustomers('all',this)">All</div>
        <div class="tab-pill" onclick="filterCustomers('vip',this)">⭐ VIP</div>
        <div class="tab-pill" onclick="filterCustomers('regular',this)">Regular</div>
        <div class="tab-pill" onclick="filterCustomers('new',this)">New</div>
        <div class="ml-auto relative"><input id="cust-search" oninput="renderCustomerTable()" class="search-input" placeholder="Search customers…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table"><thead><tr><th>Customer</th><th>Phone</th><th>Location</th><th>Total Orders</th><th>Total Spend</th><th>Last Order</th><th>Tier</th><th>Action</th></tr></thead><tbody id="customer-table-body"></tbody></table>
      </div>
    </div>

    <!-- PRODUCTS -->
    <div id="page-products" class="page hidden">
      <div class="flex items-center gap-2 mb-5">
        <div class="tab-pill active" onclick="filterSalesProd('all',this)">All Products</div>
        <div class="tab-pill" onclick="filterSalesProd('low',this)">Low Stock</div>
        <div class="tab-pill" onclick="filterSalesProd('expiring',this)">Expiring Soon</div>
        <div class="tab-pill" onclick="filterSalesProd('expired',this)">Expired</div>
        <div class="ml-auto relative"><input id="prod-search" oninput="renderProductSalesTable()" class="search-input" placeholder="Search products…"/><svg class="absolute left-3 top-2.5 text-gray-400" width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div>
      </div>
      <div class="card overflow-hidden">
        <table class="w-full data-table"><thead><tr><th>Product</th><th>Category</th><th>Price</th><th>In Stock</th><th>Min Stock</th><th>Expiry</th><th>Days Left</th><th>Location</th><th>Status</th></tr></thead><tbody id="product-sales-body"></tbody></table>
      </div>
    </div>

    <!-- REVENUE -->
    <div id="page-revenue" class="page hidden">
      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="stat-card"><div class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-600">This Month</div><div class="font-syne text-2xl text-gray-800 font-800">£12,84,500</div><div class="text-xs mt-1 font-600" style="color:#00C48C;">↑ 18% vs last month</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-600">This Week</div><div class="font-syne text-2xl text-gray-800 font-800">£2,96,300</div><div class="text-xs mt-1 font-600" style="color:#0A84FF;">↑ 6% vs last week</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-600">Avg Order Value</div><div class="font-syne text-2xl text-gray-800 font-800">£876</div><div class="text-xs mt-1 text-gray-400">Per transaction</div></div>
        <div class="stat-card"><div class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-600">Return Rate</div><div class="font-syne text-2xl font-800" style="color:#FF9500;">2.4%</div><div class="text-xs mt-1 text-gray-400">7 returns this week</div></div>
      </div>
      <div class="grid grid-cols-2 gap-5">
        <div class="card p-5"><div class="font-syne font-700 text-gray-800 mb-4 text-sm">Revenue by Category</div><div id="rev-by-cat" class="flex flex-col gap-3"></div></div>
        <div class="card p-5"><div class="font-syne font-700 text-gray-800 mb-4 text-sm">Monthly Orders Volume</div><div class="flex items-end gap-2 h-40 mt-2" id="monthly-bars"></div><div class="flex gap-2 mt-2 justify-between" id="monthly-labels"></div></div>
      </div>
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

<!-- CUSTOMER MODAL -->
<div id="cust-modal" class="modal-overlay hidden">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-5">
      <div class="font-syne font-800 text-gray-800 text-xl">Customer Profile</div>
      <button onclick="closeModal('cust-modal')" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 text-xl leading-none">&times;</button>
    </div>
    <div id="modal-cust-body"></div>
  </div>
</div>

<div id="toast" class="hidden"></div>

<script>
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
// const customers=[
//   {id:1,name:'Priya Sharma',phone:'9876543210',city:'Bhopal',orders:42,spend:38500,last:'2026-03-30',tier:'vip',email:'priya@email.com'},
//   {id:2,name:'Ravi Kumar',phone:'9823456701',city:'Bhopal',orders:28,spend:21200,last:'2026-03-29',tier:'vip',email:'ravi@email.com'},
//   {id:3,name:'Sunita Patel',phone:'9701234567',city:'Indore',orders:15,spend:9800,last:'2026-03-28',tier:'regular',email:'sunita@email.com'},
//   {id:4,name:'Amit Joshi',phone:'9612345678',city:'Bhopal',orders:3,spend:2400,last:'2026-03-31',tier:'new',email:'amit@email.com'},
//   {id:5,name:'Deepa Nair',phone:'9543217890',city:'Jabalpur',orders:19,spend:14700,last:'2026-03-27',tier:'regular',email:'deepa@email.com'},
//   {id:6,name:'Vikram Singh',phone:'9987654321',city:'Bhopal',orders:56,spend:52000,last:'2026-03-31',tier:'vip',email:'vikram@email.com'},
//   {id:7,name:'Meena Gupta',phone:'9867453201',city:'Sehore',orders:7,spend:5100,last:'2026-03-25',tier:'new',email:'meena@email.com'},
//   {id:8,name:'Arjun Verma',phone:'9754321098',city:'Bhopal',orders:33,spend:27800,last:'2026-03-30',tier:'regular',email:'arjun@email.com'},
// ];
const customers = [
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
  return{id:`ORD-${1000+i}`,date:daysAgo(rnd(0,30)),custId:cust.id,custName:cust.name,custPhone:cust.phone,custCity:cust.city,items,amount:items.reduce((s,x)=>s+x.total,0),payment:PAYMENTS[rnd(0,3)],status:STATUSES[rnd(0,5)]};
});

// Store orders in a map for easy update
const orderMap={};orders.forEach(o=>orderMap[o.id]=o);

function showPage(p,el){
  ['dashboard','orders','customers','products','revenue'].forEach(x=>document.getElementById('page-'+x).classList.add('hidden'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  document.getElementById('page-'+p).classList.remove('hidden');
  if(el)el.classList.add('active');
  else document.querySelectorAll('.nav-item').forEach(n=>{if(n.textContent.trim().toLowerCase().startsWith(p))n.classList.add('active');});
  document.getElementById('page-title').textContent={dashboard:'Dashboard',orders:'Orders',customers:'Customers',products:'Products',revenue:'Revenue & Analytics'}[p];
  if(p==='orders')renderOrderTable();
  if(p==='customers')renderCustomerTable();
  if(p==='products')renderProductSalesTable();
  if(p==='revenue')renderRevenue();
}

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
function tierBadge(t){
  return t==='vip'?'<span class="badge badge-yellow">⭐ VIP</span>':t==='new'?'<span class="badge badge-blue">New</span>':'<span class="badge badge-gray">Regular</span>';
}

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
  const expItems=products.map(p=>{return{...p,days:Math.ceil((new Date(p.expiry)-today)/86400000)};}).filter(p=>p.days<=14).sort((a,b)=>a.days-b.days);
  document.getElementById('expiry-alerts').innerHTML=expItems.map(p=>`
    <div class="flex items-center justify-between p-2.5 rounded-lg" style="background:#F8F9FD;">
      <div class="flex items-center gap-2"><span>${EMOJIS[p.cat]||'📦'}</span><div><div class="text-xs text-gray-700 font-600">${p.name}</div><div class="text-xs text-gray-400">Stock: ${p.qty}${p.qty<=p.min?' · <span style="color:#E8192C;font-weight:700;">Low!</span>':''}</div></div></div>
      <span class="badge ${p.days<0?'badge-red':p.days<=7?'badge-red':'badge-yellow'}">${p.days<0?'Expired':`${p.days}d left`}</span>
    </div>`).join('');
  document.getElementById('top-customers-dash').innerHTML=[...customers].sort((a,b)=>b.spend-a.spend).slice(0,5).map(c=>`
    <div class="flex items-center justify-between p-2.5 rounded-lg" style="background:#F8F9FD;">
      <div class="flex items-center gap-2">${avt(c.name)}<div><div class="text-xs text-gray-700 font-600">${c.name}</div><div class="text-xs text-gray-400">${c.orders} orders</div></div></div>
      <div class="text-right"><div class="text-xs font-700 text-gray-800">£${c.spend.toLocaleString()}</div>${tierBadge(c.tier)}</div>
    </div>`).join('');
}

let orderFilter='all';
function filterOrders(f,el){orderFilter=f;document.querySelectorAll('#page-orders .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderOrderTable();}
function renderOrderTable(){
  const q=(document.getElementById('order-search')?.value||'').toLowerCase();
  const sort=document.getElementById('order-sort')?.value||'newest';
  let list=[...orders];
  if(orderFilter!=='all')list=list.filter(o=>o.status===orderFilter);
  if(q)list=list.filter(o=>o.id.toLowerCase().includes(q)||o.custName.toLowerCase().includes(q)||o.custCity.toLowerCase().includes(q));
  if(sort==='newest')list.sort((a,b)=>b.date.localeCompare(a.date));
  else if(sort==='oldest')list.sort((a,b)=>a.date.localeCompare(b.date));
  else if(sort==='high')list.sort((a,b)=>b.amount-a.amount);
  else list.sort((a,b)=>a.amount-b.amount);
  const tbody=document.getElementById('order-table-body');
  const noO=document.getElementById('no-orders');
  if(!list.length){tbody.innerHTML='';noO.classList.remove('hidden');return;}
  noO.classList.add('hidden');
  tbody.innerHTML=list.map(o=>`
    <tr class="row-hover" onclick="openOrderModal('${o.id}')">
      <td><span class="font-syne text-xs font-700" style="color:#E8192C;">${o.id}</span></td>
      <td class="text-gray-400 text-xs">${o.date}</td>
      <td><div class="flex items-center gap-2">${avt(o.custName)}<div><div class="text-gray-700 text-xs font-600">${o.custName}</div><div class="text-gray-400 text-xs">${o.custCity}</div></div></div></td>
      <td class="text-gray-400 text-xs">${o.items.length} item${o.items.length>1?'s':''}</td>
      <td class="font-700 text-gray-800 text-xs">£${o.amount.toLocaleString()}</td>
      <td><span class="badge ${o.payment==='COD'?'badge-yellow':'badge-blue'}">${o.payment}</span></td>
      <td>${statusBadge(o.status)}</td>
      <td onclick="event.stopPropagation()"><select onchange="updateOrderStatus('${o.id}',this.value)" class="select-field text-xs py-1 px-2">${STATUSES.map(s=>`<option value="${s}"${o.status===s?' selected':''}>${s.charAt(0).toUpperCase()+s.slice(1)}</option>`).join('')}</select></td>
    </tr>`).join('');
}

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

function updateOrderStatus(id,v){const o=orderMap[id];if(o){o.status=v;showToast('✓ Order '+id+' → '+v);}}

let custFilter='all';
function filterCustomers(f,el){custFilter=f;document.querySelectorAll('#page-customers .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderCustomerTable();}
function renderCustomerTable(){
  const q=(document.getElementById('cust-search')?.value||'').toLowerCase();
  let list=[...customers];
  if(custFilter!=='all')list=list.filter(c=>c.tier===custFilter);
  if(q)list=list.filter(c=>c.name.toLowerCase().includes(q)||c.city.toLowerCase().includes(q)||c.phone.includes(q));
  list.sort((a,b)=>b.spend-a.spend);
  document.getElementById('customer-table-body').innerHTML=list.map(c=>`
    <tr class="row-hover" onclick="openCustModal(${c.id})">
      <td><div class="flex items-center gap-3">${avt(c.name)}<div><div class="text-gray-700 font-600 text-xs">${c.name}</div><div class="text-gray-400 text-xs">${c.email}</div></div></div></td>
      <td class="text-gray-400 text-xs">${c.phone}</td>
      <td class="text-gray-500 text-xs">📍 ${c.city}</td>
      <td class="text-center font-700 text-gray-800 text-xs">${c.orders}</td>
      <td class="font-700 text-gray-800 text-xs">£${c.spend.toLocaleString()}</td>
      <td class="text-gray-400 text-xs">${c.last}</td>
      <td>${tierBadge(c.tier)}</td>
      <td onclick="event.stopPropagation()"><button onclick="openCustModal(${c.id})" class="text-xs px-3 py-1.5 rounded-lg font-600" style="background:#FFF0F0;color:#E8192C;">View Orders</button></td>
    </tr>`).join('');
}

function openCustModal(id){
  const c=customers.find(x=>x.id===id);if(!c)return;
  const custOrders=orders.filter(o=>o.custId===c.id).sort((a,b)=>b.date.localeCompare(a.date));
  const totalSpend=custOrders.reduce((s,o)=>s+o.amount,0);
  document.getElementById('modal-cust-body').innerHTML=`
    <div class="flex items-start gap-5 mb-5 p-4 rounded-xl bg-gray-50 border border-gray-100">
      ${avt(c.name,'xl')}
      <div class="flex-1">
        <div class="flex items-center gap-3 mb-1"><div class="font-syne text-xl text-gray-800 font-800">${c.name}</div>${tierBadge(c.tier)}</div>
        <div class="text-gray-400 text-sm mb-3">${c.email} · ${c.phone} · 📍 ${c.city}</div>
        <div class="grid grid-cols-3 gap-3">
          <div class="p-3 rounded-lg bg-white border border-gray-100"><div class="text-xs text-gray-400">Total Orders</div><div class="font-syne font-800 text-gray-800">${c.orders}</div></div>
          <div class="p-3 rounded-lg bg-white border border-gray-100"><div class="text-xs text-gray-400">Total Spend</div><div class="font-syne font-800" style="color:#00C48C;">£${totalSpend.toLocaleString()}</div></div>
          <div class="p-3 rounded-lg bg-white border border-gray-100"><div class="text-xs text-gray-400">Last Order</div><div class="font-syne font-700 text-gray-800 text-sm">${c.last}</div></div>
        </div>
      </div>
    </div>
    <div class="font-syne font-700 text-gray-800 text-sm mb-3">Order History (${custOrders.length})</div>
    <div class="rounded-xl overflow-hidden border border-gray-100" style="max-height:280px;overflow-y:auto;">
      <table class="w-full data-table">
        <thead><tr><th>Order ID</th><th>Date</th><th>Items</th><th>Amount</th><th>Payment</th><th>Status</th></tr></thead>
        <tbody>${custOrders.map(o=>`<tr><td><span style="color:#E8192C;" class="font-syne text-xs font-700">${o.id}</span></td><td class="text-gray-400 text-xs">${o.date}</td><td class="text-gray-400 text-xs">${o.items.length} items</td><td class="font-700 text-gray-800 text-xs">£${o.amount.toLocaleString()}</td><td><span class="badge ${o.payment==='COD'?'badge-yellow':'badge-blue'}">${o.payment}</span></td><td>${statusBadge(o.status)}</td></tr>`).join('')}
        ${custOrders.length===0?'<tr><td colspan="6" class="py-8 text-center text-gray-400 text-sm">No orders yet.</td></tr>':''}</tbody>
      </table>
    </div>`;
  document.getElementById('cust-modal').classList.remove('hidden');
}

let prodSalesFilter='all';
function filterSalesProd(f,el){prodSalesFilter=f;document.querySelectorAll('#page-products .tab-pill').forEach(x=>x.classList.remove('active'));el.classList.add('active');renderProductSalesTable();}
function renderProductSalesTable(){
  const today=new Date('2026-03-31');
  const q=(document.getElementById('prod-search')?.value||'').toLowerCase();
  let list=products.map(p=>({...p,days:Math.ceil((new Date(p.expiry)-today)/86400000)}));
  if(prodSalesFilter==='low')list=list.filter(p=>p.qty<=p.min);
  else if(prodSalesFilter==='expiring')list=list.filter(p=>p.days>=0&&p.days<=14);
  else if(prodSalesFilter==='expired')list=list.filter(p=>p.days<0);
  if(q)list=list.filter(p=>p.name.toLowerCase().includes(q)||p.cat.toLowerCase().includes(q));
  document.getElementById('product-sales-body').innerHTML=list.map(p=>{
    const isLow=p.qty<=p.min;
    const pct=Math.min(100,Math.round((p.qty/(p.min*3))*100));
    const expClass=p.days<0?'exp-bad':p.days<=7?'exp-bad':p.days<=14?'exp-warn':'exp-ok';
    const expLabel=p.days<0?`Expired ${Math.abs(p.days)}d ago`:p.days===0?'Today!':p.days+'d';
    return `<tr>
      <td><div class="flex items-center gap-2"><span class="text-lg">${EMOJIS[p.cat]||'📦'}</span><span class="text-gray-700 font-600 text-xs">${p.name}</span></div></td>
      <td><span class="badge badge-purple">${p.cat}</span></td>
      <td class="font-700 text-gray-800 text-xs">£${p.price}</td>
      <td><div class="font-syne font-700 text-xs ${isLow?'text-red-500':'text-gray-800'}">${p.qty}</div><div class="prog-track w-14 mt-1"><div class="prog-fill" style="width:${pct}%;background:${isLow?'#E8192C':'#00C48C'};"></div></div></td>
      <td class="text-gray-400 text-xs">${p.min}</td>
      <td class="text-gray-400 text-xs">${p.expiry}</td>
      <td class="font-700 text-xs ${expClass}">${expLabel}</td>
      <td class="text-gray-400 text-xs">${p.aisle}·${p.racks.join('/')}·${p.baskets.join('/')}</td>
      <td>${isLow?'<span class="badge badge-red">Low Stock</span>':'<span class="badge badge-green">In Stock</span>'}${p.days<0?'<br><span class="badge badge-red" style="margin-top:3px;">Expired</span>':p.days>=0&&p.days<=14?'<br><span class="badge badge-yellow" style="margin-top:3px;">Exp. Soon</span>':''}</td>
    </tr>`;}).join('');
}

function renderRevenue(){
  const catTotals={};
  orders.forEach(o=>o.items.forEach(it=>{const p=products.find(x=>x.name===it.name);const cat=p?p.cat:'Other';catTotals[cat]=(catTotals[cat]||0)+it.total;}));
  const sorted=Object.entries(catTotals).sort((a,b)=>b[1]-a[1]);
  const maxVal=sorted[0]?.[1]||1;
  const colors=['#E8192C','#0A84FF','#6C63FF','#FF9500','#00C48C','#FB923C','#38BDF8','#4ADE80'];
  document.getElementById('rev-by-cat').innerHTML=sorted.map(([cat,val],i)=>`
    <div class="flex items-center gap-3"><span class="text-lg w-6">${EMOJIS[cat]||'📦'}</span><div class="flex-1"><div class="flex justify-between mb-1"><span class="text-xs text-gray-500">${cat}</span><span class="text-xs font-700 text-gray-800">£${val.toLocaleString()}</span></div><div class="prog-track"><div class="prog-fill" style="width:${Math.round(val/maxVal*100)}%;background:${colors[i%colors.length]};"></div></div></div></div>`).join('');
  const months=['Oct','Nov','Dec','Jan','Feb','Mar'],vols=[145,189,210,167,230,184],maxVol=Math.max(...vols);
  document.getElementById('monthly-bars').innerHTML=vols.map((v,i)=>`<div class="flex-1 flex flex-col items-center justify-end"><div class="w-full rounded-t-lg transition-all" style="height:${Math.round(v/maxVol*130)}px;background:${i===5?'#E8192C':'#FFF0F0'};"></div></div>`).join('');
  document.getElementById('monthly-labels').innerHTML=months.map(m=>`<span class="text-xs text-gray-400 flex-1 text-center">${m}</span>`).join('');
}

function closeModal(id){document.getElementById(id).classList.add('hidden');}
function showToast(msg){const t=document.getElementById('toast');t.textContent=msg;t.classList.remove('hidden');clearTimeout(t._to);t._to=setTimeout(()=>t.classList.add('hidden'),2500);}
['order-modal','cust-modal'].forEach(id=>{document.getElementById(id).addEventListener('click',e=>{if(e.target===document.getElementById(id))closeModal(id);});});

initDashboard();
</script>
</body>
</html>