<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>FreshStock – Grocery Inventory</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<script>
tailwind.config = {
  theme: {
    extend: {
      fontFamily: { syne: ['Syne','sans-serif'], dm: ['DM Sans','sans-serif'] },
      colors: {
        brand: { DEFAULT:'#E8192C', light:'#FF3347', dark:'#B5001F' },
        sidebar: '#1A1A2E',
        card: '#FFFFFF',
        muted: '#F5F6FA',
        accent: '#00C48C',
        warn: '#FF9500',
        info: '#0A84FF',
        purple: '#6C63FF',
      }
    }
  }
}
</script>
<style>
  * { box-sizing: border-box; }
  body { font-family: 'DM Sans', sans-serif; background: #F0F2F8; }
  h1,h2,h3,.font-syne { font-family: 'Syne', sans-serif; }
  .sidebar-link { transition: all .2s; }
  .sidebar-link:hover, .sidebar-link.active { background: rgba(232,25,44,0.18); color: #fff; }
  .sidebar-link.active { border-left: 3px solid #E8192C; }
  .card { background: #fff; border-radius: 14px; box-shadow: 0 2px 16px rgba(0,0,0,0.06); }
  .stat-card { border-radius: 14px; padding: 20px 24px; }
  .ring-chart { position: relative; width: 90px; height: 90px; }
  .ring-chart svg { transform: rotate(-90deg); }
  .ring-text { position: absolute; top:50%; left:50%; transform: translate(-50%,-50%); font-family:'Syne',sans-serif; font-weight:700; font-size:15px; }
  .badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:11px; font-weight:600; }
  .tab-btn { cursor:pointer; padding:8px 20px; border-radius:8px; font-weight:600; font-size:13px; transition: all .2s; }
  .tab-btn.active { background:#E8192C; color:#fff; }
  .tab-btn:not(.active):hover { background:#f0f2f8; }
  input,select,textarea { font-family: 'DM Sans', sans-serif; }
  .modal-bg { position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:50; display:flex; align-items:center; justify-content:center; }
  .modal { background:#fff; border-radius:18px; width:100%; max-width:680px; max-height:90vh; overflow-y:auto; padding:36px; box-shadow:0 20px 60px rgba(0,0,0,0.2); }
  .input-field { width:100%; border:1.5px solid #e2e5ef; border-radius:9px; padding:9px 13px; font-size:14px; outline:none; transition: border .2s; }
  .input-field:focus { border-color:#E8192C; }
  .tag { display:inline-flex; align-items:center; gap:5px; background:#F0F2F8; border-radius:7px; padding:4px 10px; font-size:12px; font-weight:600; margin:3px; }
  .tag .remove { cursor:pointer; color:#999; font-size:14px; line-height:1; }
  .tag .remove:hover { color:#E8192C; }
  ::-webkit-scrollbar { width:5px; height:5px; }
  ::-webkit-scrollbar-thumb { background:#ddd; border-radius:10px; }
  .progress-bar { height:6px; border-radius:3px; background:#eee; overflow:hidden; }
  .progress-fill { height:100%; border-radius:3px; }
  .stock-row:hover { background:#fafbff; }
  .expiry-ok { color:#00C48C; }
  .expiry-warn { color:#FF9500; }
  .expiry-bad { color:#E8192C; }
  @keyframes fadeIn { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:none} }
  .page { animation: fadeIn .25s ease; }
</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

  @php
    $userRole = auth()->user()->role;
  @endphp
<div class="flex h-screen overflow-hidden">

  <!-- SIDEBAR -->
  <aside class="w-56 flex-shrink-0 flex flex-col" style="background:#1A1A2E;">
    <div class="px-6 py-6 flex items-center gap-3 border-b border-white/10">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#E8192C;">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="8" height="8" rx="2" fill="white"/><rect x="13" y="3" width="8" height="8" rx="2" fill="white" opacity=".6"/><rect x="3" y="13" width="8" height="8" rx="2" fill="white" opacity=".6"/><rect x="13" y="13" width="8" height="8" rx="2" fill="white"/></svg>
      </div>
      <span class="font-syne font-800 text-white text-lg tracking-tight">FreshStock</span>
    </div>
    <nav class="flex-1 px-3 py-6 flex flex-col gap-1">
      <button onclick="showPage('dashboard')" id="nav-dashboard" class="sidebar-link active w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 text-sm font-dm">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="8" height="8" rx="2" fill="currentColor"/><rect x="13" y="3" width="8" height="8" rx="2" fill="currentColor" opacity=".5"/><rect x="3" y="13" width="8" height="8" rx="2" fill="currentColor" opacity=".5"/><rect x="13" y="13" width="8" height="8" rx="2" fill="currentColor"/></svg>
        Dashboard
      </button>
      <button onclick="showPage('inventory')" id="nav-inventory" class="sidebar-link w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 text-sm font-dm">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M4 6h16M4 10h16M4 14h10M4 18h7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        Inventory
      </button>
      <button onclick="showPage('stock')" id="nav-stock" class="sidebar-link w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl text-white/60 text-sm font-dm">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 10L2 17l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
        Stock Management
      </button>
    </nav>
    <div class="px-4 py-4 border-t border-white/10">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand to-purple flex items-center justify-center text-white text-xs font-bold">{{ auth()->user()->name[0] }}</div>
        <div>
          <div class="text-white text-xs font-semibold">{{ auth()->user()->name }}</div>
          <div class="text-white/40 text-xs">{{ ucfirst(str_replace('_',' ', $userRole)) }}</div>
        </div>
      </div>
      
    </div>
  </aside>


  <!-- MAIN -->
  <div class="flex-1 flex flex-col overflow-hidden">
    <!-- TOPBAR -->
    <header class="bg-white flex items-center justify-between px-8 py-4 border-b border-gray-100">
      <div id="page-title" class="font-syne font-700 text-xl text-gray-800">Dashboard</div>
      <div class="flex items-center gap-4">
        {{-- <div class="relative">
          <input class="bg-gray-50 border border-gray-200 rounded-xl pl-9 pr-4 py-2 text-sm text-gray-600 w-56 outline-none focus:border-brand" placeholder="Search…"/>
          <svg class="absolute left-3 top-2.5 text-gray-400" width="14" height="14" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </div> --}}
        {{-- <button class="relative p-2 rounded-xl bg-gray-50 hover:bg-gray-100">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0" stroke="#555" stroke-width="2" stroke-linecap="round"/></svg>
          <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-brand"></span>
        </button> --}}
        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand to-purple flex items-center justify-center text-white text-xs font-bold">{{ auth()->user()->name[0] }}</div>
        <form action="/logout" method="POST">
          @csrf
            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-2">
              <i class="fa-solid fa-right-from-bracket"></i>          
            </button>
        </form>
      </div>
    </header>

    <!-- PAGES -->
    <main class="flex-1 overflow-y-auto p-8">

      <!-- ========== DASHBOARD PAGE ========== -->
      <div id="page-dashboard" class="page">

        <!-- Sales Activity -->
        <div class="mb-6">
          <h2 class="font-syne font-700 text-base text-gray-700 mb-4">Sales Activity</h2>
          <div class="grid grid-cols-4 gap-4">
            <div class="card p-5 flex flex-col gap-1">
              <span class="text-3xl font-syne font-800 text-info">228</span>
              <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Qty</span>
              <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="#aaa" stroke-width="2"/><path d="M12 6v6l4 2" stroke="#aaa" stroke-width="2" stroke-linecap="round"/></svg>
                To Be Packed
              </div>
            </div>
            <div class="card p-5 flex flex-col gap-1">
              <span class="text-3xl font-syne font-800 text-brand">6</span>
              <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Pkgs</span>
              <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M12 5l7 7-7 7" stroke="#aaa" stroke-width="2" stroke-linecap="round"/></svg>
                To Be Shipped
              </div>
            </div>
            <div class="card p-5 flex flex-col gap-1">
              <span class="text-3xl font-syne font-800 text-accent">10</span>
              <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Pkgs</span>
              <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" stroke="#aaa" stroke-width="2"/></svg>
                To Be Delivered
              </div>
            </div>
            <div class="card p-5 flex flex-col gap-1">
              <span class="text-3xl font-syne font-800 text-info">474</span>
              <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Qty</span>
              <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="#aaa" stroke-width="2"/><polyline points="14,2 14,8 20,8" stroke="#aaa" stroke-width="2"/></svg>
                To Be Invoiced
              </div>
            </div>
          </div>
        </div>

        <!-- Inventory Summary -->
        <div class="grid grid-cols-3 gap-6 mb-6">
          <div class="col-span-1">
            <div class="card p-5 mb-4">
              <h3 class="font-syne font-700 text-sm text-gray-700 mb-4">Inventory Summary</h3>
              <div class="flex items-center justify-between py-3 border-b border-gray-100">
                <span class="text-xs text-gray-500 uppercase font-600 tracking-wider">Quantity in Hand</span>
                <span class="font-syne font-700 text-gray-800 text-sm">10,458</span>
              </div>
              <div class="flex items-center justify-between py-3">
                <span class="text-xs text-gray-500 uppercase font-600 tracking-wider">Quantity to be Received</span>
                <span class="font-syne font-700 text-gray-800 text-sm">168</span>
              </div>
            </div>

            <!-- Purchase Order -->
            <div class="card p-5">
              <div class="flex items-center justify-between mb-4">
                <h3 class="font-syne font-700 text-sm text-gray-700">Purchase Order</h3>
                <span class="badge" style="background:#FFF3E0;color:#FF9500;">This Month</span>
              </div>
              <div class="text-center py-2">
                <div class="text-xs text-gray-400 mb-1">Quantity Ordered</div>
                <div class="text-2xl font-syne font-800 text-info">2.00</div>
              </div>
              <div class="border-t border-gray-100 mt-3 pt-3 text-center">
                <div class="text-xs text-gray-400 mb-1">Total Cost</div>
                <div class="text-2xl font-syne font-800 text-accent">£46.92</div>
              </div>
            </div>
          </div>

          <!-- Product Details + Top Selling -->
          <div class="col-span-2 flex flex-col gap-6">
            <!-- Product Details -->
            <div class="card p-5">
              <h3 class="font-syne font-700 text-sm text-gray-700 mb-4">Product Details</h3>
              <div class="flex items-start justify-between">
                <div class="flex flex-col gap-3 flex-1">
                  <div class="flex items-center justify-between">
                    <span class="text-sm text-brand font-600">Low Stock Items</span>
                    <span class="font-syne font-800 text-brand">3</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">All Item Groups</span>
                    <span class="font-syne font-700 text-gray-800">39</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">All Items</span>
                    <span class="font-syne font-700 text-gray-800">190</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-sm text-brand font-600">Unconfirmed Items</span>
                    <span class="font-syne font-800 text-brand">121</span>
                  </div>
                </div>
                <div class="ml-8 flex flex-col items-center">
                  <div class="ring-chart">
                    <svg width="90" height="90" viewBox="0 0 90 90">
                      <circle cx="45" cy="45" r="36" fill="none" stroke="#eee" stroke-width="10"/>
                      <circle cx="45" cy="45" r="36" fill="none" stroke="#00C48C" stroke-width="10" stroke-dasharray="226 226" stroke-dashoffset="64" stroke-linecap="round"/>
                    </svg>
                    <div class="ring-text text-gray-700">71%</div>
                  </div>
                  <span class="text-xs text-gray-400 mt-2">Active Items</span>
                </div>
              </div>
            </div>

            <!-- Top Selling Items -->
            <div class="card p-5 flex-1">
              <div class="flex items-center justify-between mb-4">
                <h3 class="font-syne font-700 text-sm text-gray-700">Top Selling Items</h3>
                <span class="badge" style="background:#F0F2F8;color:#555;">Previous Year</span>
              </div>
              <div class="grid grid-cols-3 gap-4">
                <div class="flex flex-col items-center gap-2 p-3 rounded-xl bg-orange-50">
                  <div class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl bg-white shadow-sm">🛒</div>
                  <div class="text-xs text-center text-gray-600 font-600">Fresh Vegetables Mix</div>
                  <div class="font-syne font-800 text-brand text-sm">171 <span class="text-xs font-400 text-gray-400">pcs</span></div>
                </div>
                <div class="flex flex-col items-center gap-2 p-3 rounded-xl bg-blue-50">
                  <div class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl bg-white shadow-sm">🥛</div>
                  <div class="text-xs text-center text-gray-600 font-600">Organic Milk Pack</div>
                  <div class="font-syne font-800 text-info text-sm">45 <span class="text-xs font-400 text-gray-400">sets</span></div>
                </div>
                <div class="flex flex-col items-center gap-2 p-3 rounded-xl bg-purple-50">
                  <div class="w-14 h-14 rounded-xl flex items-center justify-center text-3xl bg-white shadow-sm">🍎</div>
                  <div class="text-xs text-center text-gray-600 font-600">Premium Fruit Basket</div>
                  <div class="font-syne font-800 text-purple text-sm">38 <span class="text-xs font-400 text-gray-400">sets</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sales Order -->
        <div class="card p-5">
          <div class="flex items-center justify-between mb-4">
            <h3 class="font-syne font-700 text-sm text-gray-700">Sales Order</h3>
            <span class="badge" style="background:#FFF3E0;color:#FF9500;">This Month</span>
          </div>
          <table class="w-full">
            <thead>
              <tr class="border-b border-gray-100">
                <th class="text-left py-2 text-xs font-600 text-gray-400 uppercase tracking-wider">Channel</th>
                <th class="text-center py-2 text-xs font-600 text-gray-400 uppercase tracking-wider">Draft</th>
                <th class="text-center py-2 text-xs font-600 text-gray-400 uppercase tracking-wider">Confirmed</th>
                <th class="text-center py-2 text-xs font-600 text-gray-400 uppercase tracking-wider">Packed</th>
                <th class="text-center py-2 text-xs font-600 text-gray-400 uppercase tracking-wider">Shipped</th>
                <th class="text-center py-2 text-xs font-600 text-gray-400 uppercase tracking-wider">Invoiced</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="py-3 text-sm text-gray-700 font-600">Direct Sales</td>
                <td class="py-3 text-center text-sm text-gray-500">0</td>
                <td class="py-3 text-center text-sm text-accent font-700">50</td>
                <td class="py-3 text-center text-sm text-gray-500">0</td>
                <td class="py-3 text-center text-sm text-gray-500">0</td>
                <td class="py-3 text-center text-sm text-info font-700">102</td>
              </tr>
              <tr>
                <td class="py-3 text-sm text-gray-700 font-600">Online Store</td>
                <td class="py-3 text-center text-sm text-gray-500">3</td>
                <td class="py-3 text-center text-sm text-accent font-700">28</td>
                <td class="py-3 text-center text-sm text-warn font-700">12</td>
                <td class="py-3 text-center text-sm text-info font-700">7</td>
                <td class="py-3 text-center text-sm text-info font-700">64</td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

      <!-- ========== INVENTORY PAGE ========== -->
      <div id="page-inventory" class="page hidden">
        <div class="flex items-center justify-between mb-6">
          <div>
            <h2 class="font-syne font-700 text-lg text-gray-800">Product Listing</h2>
            <p class="text-sm text-gray-400">Manage your grocery product catalog</p>
          </div>
          <button onclick="openCreateProduct()" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-white font-600 text-sm shadow-md hover:opacity-90 transition" style="background:#E8192C;">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke="white" stroke-width="2.5" stroke-linecap="round"/></svg>
            Create Product
          </button>
        </div>

        <!-- Filters -->
        <div class="flex items-center gap-3 mb-4">
          <div class="tab-btn active" onclick="filterProducts('all',this)">All</div>
          <div class="tab-btn" onclick="filterProducts('active',this)">Active</div>
          <div class="tab-btn" onclick="filterProducts('low',this)">Low Stock</div>
          <div class="ml-auto relative">
            <input id="inv-search" oninput="renderProducts()" class="bg-white border border-gray-200 rounded-xl pl-9 pr-4 py-2 text-sm w-56 outline-none focus:border-brand" placeholder="Search products…"/>
            <svg class="absolute left-3 top-2.5 text-gray-400" width="14" height="14" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          </div>
        </div>

        <!-- Product Table -->
        <div class="card overflow-hidden">
          <table class="w-full">
            <thead style="background:#F8F9FD;">
              <tr>
                <th class="text-left px-5 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Product</th>
                <th class="text-left px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Category</th>
                <th class="text-left px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Location</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Qty</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Price</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Status</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody id="product-table-body">
            </tbody>
          </table>
          <div id="no-products" class="hidden py-16 text-center text-gray-400 text-sm">No products found.</div>
        </div>
      </div>

      <!-- ========== STOCK MANAGEMENT PAGE ========== -->
      <div id="page-stock" class="page hidden">
        <div class="flex items-center justify-between mb-6">
          <div>
            <h2 class="font-syne font-700 text-lg text-gray-800">Stock Management</h2>
            <p class="text-sm text-gray-400">Update stock counts and manage expiry dates</p>
          </div>
          <div class="relative">
            <input id="stock-search" oninput="renderStock()" class="bg-white border border-gray-200 rounded-xl pl-9 pr-4 py-2 text-sm w-56 outline-none focus:border-brand" placeholder="Search…"/>
            <svg class="absolute left-3 top-2.5 text-gray-400" width="14" height="14" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          </div>
        </div>

        <div class="card overflow-hidden">
          <table class="w-full">
            <thead style="background:#F8F9FD;">
              <tr>
                <th class="text-left px-5 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Product</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Current Stock</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Update Qty</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Expiry Date</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Status</th>
                <th class="text-center px-3 py-3 text-xs font-700 text-gray-400 uppercase tracking-wider">Save</th>
              </tr>
            </thead>
            <tbody id="stock-table-body"></tbody>
          </table>
        </div>
      </div>

    </main>
  </div>
</div>

<!-- ===== CREATE PRODUCT MODAL ===== -->
<div id="create-modal" class="modal-bg hidden">
  <div class="modal">
    <div class="flex items-center justify-between mb-6">
      <h2 class="font-syne font-800 text-xl text-gray-800">Create New Product</h2>
      <button onclick="closeCreateProduct()" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 text-gray-500 text-lg">&times;</button>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div class="col-span-2">
        <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Product Name *</label>
        <input id="cp-name" class="input-field" placeholder="e.g. Fresh Tomatoes"/>
      </div>
      <div>
        <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Category</label>
        <select id="cp-category" class="input-field">
          <option>Vegetables</option>
          <option>Fruits</option>
          <option>Dairy</option>
          <option>Grains & Cereals</option>
          <option>Beverages</option>
          <option>Snacks</option>
          <option>Spices</option>
          <option>Frozen</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Unit</label>
        <select id="cp-unit" class="input-field">
          <option>kg</option>
          <option>pcs</option>
          <option>litre</option>
          <option>pack</option>
          <option>dozen</option>
          <option>grams</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Price (£) *</label>
        <input id="cp-price" type="number" class="input-field" placeholder="0.00"/>
      </div>
      <div>
        <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Initial Quantity</label>
        <input id="cp-qty" type="number" class="input-field" placeholder="0"/>
      </div>
      <div>
        <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Expiry Date</label>
        <input id="cp-expiry" type="date" class="input-field"/>
      </div>
      <div>
        <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Minimum Stock Level</label>
        <input id="cp-minstock" type="number" class="input-field" placeholder="5"/>
      </div>
    </div>

    <!-- Location -->
    <div class="mt-5 p-4 rounded-xl border border-gray-200 bg-gray-50">
      <h3 class="font-syne font-700 text-sm text-gray-700 mb-4">📍 Storage Location</h3>
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Aisle</label>
          <select id="cp-aisle" class="input-field">
            <option value="">Select Aisle</option>
            <option>A1</option><option>A2</option><option>B1</option><option>B2</option><option>C1</option><option>C2</option><option>D1</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Racks (multiple)</label>
          <div class="flex gap-1 mb-2 flex-wrap" id="rack-tags"></div>
          <div class="flex gap-1">
            <input id="rack-input" class="input-field flex-1" placeholder="e.g. R1" onkeydown="if(event.key==='Enter'){addTag('rack');event.preventDefault();}"/>
            <button onclick="addTag('rack')" class="px-3 py-2 rounded-lg text-xs font-700 text-white" style="background:#E8192C;">+</button>
          </div>
        </div>
        <div>
          <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Baskets (multiple)</label>
          <div class="flex gap-1 mb-2 flex-wrap" id="basket-tags"></div>
          <div class="flex gap-1">
            <input id="basket-input" class="input-field flex-1" placeholder="e.g. B-01" onkeydown="if(event.key==='Enter'){addTag('basket');event.preventDefault();}"/>
            <button onclick="addTag('basket')" class="px-3 py-2 rounded-lg text-xs font-700 text-white" style="background:#0A84FF;">+</button>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4">
      <label class="block text-xs font-700 text-gray-500 mb-1 uppercase tracking-wider">Description</label>
      <textarea id="cp-desc" class="input-field" rows="2" placeholder="Product description…"></textarea>
    </div>

    <div class="flex gap-3 mt-6">
      <button onclick="closeCreateProduct()" class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-600 text-sm hover:bg-gray-50">Cancel</button>
      <button onclick="saveProduct()" class="flex-1 py-2.5 rounded-xl text-white font-700 text-sm hover:opacity-90 transition" style="background:#E8192C;">Save Product</button>
    </div>
  </div>
</div>

<!-- ===== VIEW PRODUCT MODAL ===== -->
<div id="view-modal" class="modal-bg hidden">
  <div class="modal" style="max-width:500px;">
    <div class="flex items-center justify-between mb-5">
      <h2 class="font-syne font-800 text-xl text-gray-800">Product Details</h2>
      <button onclick="closeViewProduct()" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 text-gray-500 text-lg">&times;</button>
    </div>
    <div id="view-content"></div>
  </div>
</div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 px-5 py-3 rounded-xl text-white text-sm font-600 shadow-xl z-50 hidden" style="background:#00C48C;">✓ Product saved!</div>

<script>
// ===== STATE =====
let products = [
  { id:1, name:'Fresh Tomatoes', category:'Vegetables', unit:'kg', price:40, qty:120, minStock:20, expiry:'2025-08-15', aisle:'A1', racks:['R1','R2'], baskets:['B-01','B-02'], status:'active', desc:'Locally sourced fresh tomatoes' },
  { id:2, name:'Organic Milk', category:'Dairy', unit:'litre', price:65, qty:8, minStock:15, expiry:'2025-04-10', aisle:'B2', racks:['R3'], baskets:['B-05'], status:'active', desc:'Full cream organic milk' },
  { id:3, name:'Basmati Rice', category:'Grains & Cereals', unit:'kg', price:120, qty:200, minStock:30, expiry:'2026-01-01', aisle:'C1', racks:['R5','R6','R7'], baskets:['B-10'], status:'active', desc:'Premium aged basmati rice' },
  { id:4, name:'Alphonso Mangoes', category:'Fruits', unit:'kg', price:250, qty:4, minStock:10, expiry:'2025-04-18', aisle:'A2', racks:['R2'], baskets:['B-03','B-04'], status:'active', desc:'Premium Ratnagiri Alphonso' },
  { id:5, name:'Green Tea Bags', category:'Beverages', unit:'pack', price:180, qty:55, minStock:10, expiry:'2026-06-30', aisle:'D1', racks:['R9'], baskets:['B-15'], status:'active', desc:'Premium green tea 25 bags' },
  { id:6, name:'Turmeric Powder', category:'Spices', unit:'pack', price:45, qty:90, minStock:20, expiry:'2025-12-31', aisle:'C2', racks:['R8'], baskets:['B-12','B-13'], status:'active', desc:'Pure organic turmeric' },
];
let nextId = 7;
let currentFilter = 'all';
let racks = [], baskets = [];

// ===== NAV =====
function showPage(p) {
  ['dashboard','inventory','stock'].forEach(x => {
    document.getElementById('page-'+x).classList.add('hidden');
    document.getElementById('nav-'+x).classList.remove('active');
    document.getElementById('nav-'+x).classList.add('text-white/60');
    document.getElementById('nav-'+x).classList.remove('text-white/80');
  });
  document.getElementById('page-'+p).classList.remove('hidden');
  document.getElementById('nav-'+p).classList.add('active','text-white/80');
  document.getElementById('nav-'+p).classList.remove('text-white/60');
  document.getElementById('page-title').textContent = {dashboard:'Dashboard',inventory:'Inventory',stock:'Stock Management'}[p];
  if(p==='inventory') renderProducts();
  if(p==='stock') renderStock();
}

// ===== FILTER =====
function filterProducts(type, el) {
  currentFilter = type;
  document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
  el.classList.add('active');
  renderProducts();
}

function getFilteredProducts() {
  const q = (document.getElementById('inv-search')?.value||'').toLowerCase();
  return products.filter(p => {
    const matchQ = p.name.toLowerCase().includes(q) || p.category.toLowerCase().includes(q);
    if(currentFilter==='low') return matchQ && p.qty <= p.minStock;
    if(currentFilter==='active') return matchQ && p.qty > p.minStock;
    return matchQ;
  });
}

// ===== RENDER PRODUCTS TABLE =====
function renderProducts() {
  const fp = getFilteredProducts();
  const tbody = document.getElementById('product-table-body');
  const noP = document.getElementById('no-products');
  if(fp.length===0){ tbody.innerHTML=''; noP.classList.remove('hidden'); return; }
  noP.classList.add('hidden');
  tbody.innerHTML = fp.map(p => {
    const isLow = p.qty <= p.minStock;
    const pct = Math.min(100, Math.round((p.qty/(p.minStock*3))*100));
    const locStr = [p.aisle, p.racks.join('/'), p.baskets.join('/')].filter(Boolean).join(' · ');
    return `
    <tr class="border-b border-gray-50 stock-row cursor-pointer" onclick="viewProduct(${p.id})">
      <td class="px-5 py-4">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-lg flex items-center justify-center text-lg" style="background:#F0F2F8;">${categoryEmoji(p.category)}</div>
          <div>
            <div class="font-600 text-sm text-gray-800">${p.name}</div>
            <div class="text-xs text-gray-400">${p.unit}</div>
          </div>
        </div>
      </td>
      <td class="px-3 py-4"><span class="badge" style="background:#EEF2FF;color:#6C63FF;">${p.category}</span></td>
      <td class="px-3 py-4 text-xs text-gray-500">${locStr}</td>
      <td class="px-3 py-4 text-center">
        <div class="font-syne font-700 text-sm ${isLow?'text-brand':'text-gray-800'}">${p.qty}</div>
        <div class="progress-bar w-16 mx-auto mt-1"><div class="progress-fill" style="width:${pct}%;background:${isLow?'#E8192C':'#00C48C'};"></div></div>
      </td>
      <td class="px-3 py-4 text-center font-syne font-700 text-sm text-gray-800">£${p.price}</td>
      <td class="px-3 py-4 text-center">
        ${isLow ? '<span class="badge" style="background:#FFF0F0;color:#E8192C;">Low Stock</span>' : '<span class="badge" style="background:#E8FFF5;color:#00C48C;">In Stock</span>'}
      </td>
      <td class="px-3 py-4 text-center" onclick="event.stopPropagation()">
        <button onclick="deleteProduct(${p.id})" class="px-3 py-1.5 rounded-lg text-xs font-600 text-brand border border-brand/30 hover:bg-brand/5">Delete</button>
      </td>
    </tr>`;
  }).join('');
}

function categoryEmoji(cat) {
  const map = {'Vegetables':'🥦','Fruits':'🍎','Dairy':'🥛','Grains & Cereals':'🌾','Beverages':'🧃','Snacks':'🍪','Spices':'🌶️','Frozen':'🧊'};
  return map[cat]||'📦';
}

function deleteProduct(id) {
  if(confirm('Delete this product?')) { products = products.filter(p=>p.id!==id); renderProducts(); renderStock(); }
}

// ===== VIEW PRODUCT =====
function viewProduct(id) {
  const p = products.find(x=>x.id===id); if(!p) return;
  document.getElementById('view-content').innerHTML = `
    <div class="flex items-center gap-4 mb-5">
      <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-4xl" style="background:#F0F2F8;">${categoryEmoji(p.category)}</div>
      <div>
        <h3 class="font-syne font-800 text-lg text-gray-800">${p.name}</h3>
        <span class="badge" style="background:#EEF2FF;color:#6C63FF;">${p.category}</span>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-3 mb-4">
      <div class="p-3 rounded-xl bg-gray-50"><div class="text-xs text-gray-400 mb-1">Unit</div><div class="font-600 text-gray-800">${p.unit}</div></div>
      <div class="p-3 rounded-xl bg-gray-50"><div class="text-xs text-gray-400 mb-1">Price</div><div class="font-600 text-gray-800">£${p.price}</div></div>
      <div class="p-3 rounded-xl bg-gray-50"><div class="text-xs text-gray-400 mb-1">Quantity</div><div class="font-600 text-gray-800">${p.qty} ${p.unit}</div></div>
      <div class="p-3 rounded-xl bg-gray-50"><div class="text-xs text-gray-400 mb-1">Min Stock</div><div class="font-600 text-gray-800">${p.minStock}</div></div>
      <div class="p-3 rounded-xl bg-gray-50"><div class="text-xs text-gray-400 mb-1">Expiry</div><div class="font-600 text-gray-800">${p.expiry||'—'}</div></div>
    </div>
    <div class="p-4 rounded-xl border border-gray-200 bg-blue-50 mb-4">
      <div class="text-xs font-700 text-gray-500 uppercase tracking-wider mb-2">📍 Storage Location</div>
      <div class="grid grid-cols-3 gap-3 text-sm">
        <div><span class="text-gray-400">Aisle: </span><span class="font-700">${p.aisle||'—'}</span></div>
        <div><span class="text-gray-400">Racks: </span><span class="font-700">${p.racks.join(', ')||'—'}</span></div>
        <div><span class="text-gray-400">Baskets: </span><span class="font-700">${p.baskets.join(', ')||'—'}</span></div>
      </div>
    </div>
    ${p.desc?`<div class="text-sm text-gray-500">${p.desc}</div>`:''}
  `;
  document.getElementById('view-modal').classList.remove('hidden');
}
function closeViewProduct(){ document.getElementById('view-modal').classList.add('hidden'); }

// ===== STOCK MANAGEMENT =====
function renderStock() {
  const q = (document.getElementById('stock-search')?.value||'').toLowerCase();
  const fp = products.filter(p => p.name.toLowerCase().includes(q)||p.category.toLowerCase().includes(q));
  const tbody = document.getElementById('stock-table-body');
  tbody.innerHTML = fp.map(p => {
    const today = new Date(); 
    const expDate = p.expiry ? new Date(p.expiry) : null;
    const daysLeft = expDate ? Math.ceil((expDate-today)/(1000*60*60*24)) : null;
    const expClass = daysLeft === null ? '' : daysLeft < 0 ? 'expiry-bad' : daysLeft <= 14 ? 'expiry-warn' : 'expiry-ok';
    const expLabel = daysLeft === null ? '—' : daysLeft < 0 ? `Expired (${Math.abs(daysLeft)}d ago)` : daysLeft === 0 ? 'Today!' : `${daysLeft}d left`;
    const isLow = p.qty <= p.minStock;
    return `
    <tr class="border-b border-gray-50 stock-row">
      <td class="px-5 py-4">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-lg flex items-center justify-center text-lg" style="background:#F0F2F8;">${categoryEmoji(p.category)}</div>
          <div>
            <div class="font-600 text-sm text-gray-800">${p.name}</div>
            <div class="text-xs text-gray-400">${p.category} · ${p.unit}</div>
          </div>
        </div>
      </td>
      <td class="px-3 py-4 text-center">
        <div class="font-syne font-800 text-lg ${isLow?'text-brand':'text-accent'}">${p.qty}</div>
        <div class="text-xs text-gray-400">min: ${p.minStock}</div>
      </td>
      <td class="px-3 py-4 text-center">
        <div class="flex items-center gap-1 justify-center">
          <button onclick="adjQty(${p.id},-1)" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100 font-700">−</button>
          <input id="qty-${p.id}" type="number" value="${p.qty}" min="0" class="w-16 text-center border border-gray-200 rounded-lg py-1 text-sm font-600 outline-none focus:border-brand"/>
          <button onclick="adjQty(${p.id},1)" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100 font-700">+</button>
        </div>
      </td>
      <td class="px-3 py-4 text-center">
        <input id="exp-${p.id}" type="date" value="${p.expiry||''}" class="border border-gray-200 rounded-lg px-2 py-1 text-sm outline-none focus:border-brand"/>
        <div class="text-xs mt-1 font-600 ${expClass}">${expLabel}</div>
      </td>
      <td class="px-3 py-4 text-center">
        ${isLow ? '<span class="badge" style="background:#FFF0F0;color:#E8192C;">Low Stock</span>' : '<span class="badge" style="background:#E8FFF5;color:#00C48C;">In Stock</span>'}
        ${daysLeft !== null && daysLeft < 0 ? '<div class="badge mt-1" style="background:#FFF0F0;color:#E8192C;">Expired</div>' : ''}
        ${daysLeft !== null && daysLeft >= 0 && daysLeft <= 14 ? '<div class="badge mt-1" style="background:#FFF9EC;color:#FF9500;">Expiring Soon</div>' : ''}
      </td>
      <td class="px-3 py-4 text-center">
        <button onclick="saveStock(${p.id})" class="px-4 py-1.5 rounded-lg text-xs font-700 text-white hover:opacity-90" style="background:#00C48C;">Save</button>
      </td>
    </tr>`;
  }).join('');
}

function adjQty(id, delta) {
  const input = document.getElementById('qty-'+id);
  let v = parseInt(input.value)||0;
  v = Math.max(0, v+delta);
  input.value = v;
}

function saveStock(id) {
  const qty = parseInt(document.getElementById('qty-'+id).value)||0;
  const exp = document.getElementById('exp-'+id).value;
  const p = products.find(x=>x.id===id);
  if(p){ p.qty = qty; p.expiry = exp; }
  showToast('✓ Stock updated for '+p.name);
  renderStock();
}

// ===== CREATE PRODUCT MODAL =====
function openCreateProduct() {
  racks=[]; baskets=[];
  document.getElementById('rack-tags').innerHTML='';
  document.getElementById('basket-tags').innerHTML='';
  ['cp-name','cp-price','cp-qty','cp-expiry','cp-minstock','cp-desc'].forEach(id=>{
    const el=document.getElementById(id); if(el) el.value='';
  });
  document.getElementById('create-modal').classList.remove('hidden');
}
function closeCreateProduct(){ document.getElementById('create-modal').classList.add('hidden'); }

function addTag(type) {
  const input = document.getElementById(type+'-input');
  const val = input.value.trim(); if(!val) return;
  if(type==='rack') { if(!racks.includes(val)) racks.push(val); renderTags('rack', racks, '#E8192C'); }
  else { if(!baskets.includes(val)) baskets.push(val); renderTags('basket', baskets, '#0A84FF'); }
  input.value='';
}

function renderTags(type, arr, color) {
  const container = document.getElementById(type+'-tags');
  container.innerHTML = arr.map((v,i) => `
    <div class="tag" style="border:1.5px solid ${color}22;color:${color};">
      ${v} <span class="remove" onclick="removeTag('${type}',${i})">&times;</span>
    </div>`).join('');
}

function removeTag(type, idx) {
  if(type==='rack') { racks.splice(idx,1); renderTags('rack',racks,'#E8192C'); }
  else { baskets.splice(idx,1); renderTags('basket',baskets,'#0A84FF'); }
}

function saveProduct() {
  const name = document.getElementById('cp-name').value.trim();
  const price = parseFloat(document.getElementById('cp-price').value)||0;
  if(!name){ alert('Product name is required'); return; }
  const p = {
    id: nextId++,
    name, price,
    category: document.getElementById('cp-category').value,
    unit: document.getElementById('cp-unit').value,
    qty: parseInt(document.getElementById('cp-qty').value)||0,
    minStock: parseInt(document.getElementById('cp-minstock').value)||5,
    expiry: document.getElementById('cp-expiry').value,
    aisle: document.getElementById('cp-aisle').value,
    racks: [...racks],
    baskets: [...baskets],
    desc: document.getElementById('cp-desc').value,
    status: 'active'
  };
  products.push(p);
  closeCreateProduct();
  showToast('✓ Product created: '+name);
  renderProducts();
}

// ===== TOAST =====
function showToast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.remove('hidden');
  setTimeout(()=>t.classList.add('hidden'), 2800);
}

// Close modals on outside click
document.getElementById('create-modal').addEventListener('click', e => { if(e.target===document.getElementById('create-modal')) closeCreateProduct(); });
document.getElementById('view-modal').addEventListener('click', e => { if(e.target===document.getElementById('view-modal')) closeViewProduct(); });
</script>
</body>
</html>