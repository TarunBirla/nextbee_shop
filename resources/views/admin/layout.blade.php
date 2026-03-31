<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .active-menu {
            background: white;
            color: black;
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="flex">

    @php
$userRole = auth()->user()->role;
@endphp

<!-- SIDEBAR -->
<div class="w-64 bg-[#8B5E3C] min-h-screen text-white p-5">

    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
        <i class="fa-solid fa-gauge"></i>
        {{ ucfirst(str_replace('_',' ', $userRole)) }}
    </h2>

    <!-- ALL ROLES CAN SEE DASHBOARD -->
    <a href="/admin/dashboard"
       class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black {{ request()->is('admin/dashboard') ? 'active-menu' : '' }}">
        <i class="fa-solid fa-chart-line"></i> Dashboard
    </a>

    {{-- ================= BUSINESS OWNER ================= --}}
    @if($userRole == 'business_owner')

        <a href="/admin/products"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black {{ request()->is('admin/products*') ? 'active-menu' : '' }}">
            <i class="fa-solid fa-box"></i> Products
        </a>

        <a href="/admin/categories"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black {{ request()->is('admin/categories*') ? 'active-menu' : '' }}">
            <i class="fa-solid fa-list"></i> Categories
        </a>

        <a href="/admin/orders"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black {{ request()->is('admin/orders*') ? 'active-menu' : '' }}">
            <i class="fa-solid fa-cart-shopping"></i> Orders
        </a>

        <a href="/admin/users"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black {{ request()->is('admin/users*') ? 'active-menu' : '' }}">
            <i class="fa-solid fa-users"></i> Users
        </a>

    @endif

    {{-- ================= SALES REP ================= --}}
    @if($userRole == 'sales_rep')

        <a href="/admin/orders"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black">
            <i class="fa-solid fa-eye"></i> View Orders
        </a>

        <a href="/admin/reports"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black">
            <i class="fa-solid fa-chart-simple"></i> Reports
        </a>

    @endif

    {{-- ================= INVENTORY MANAGER ================= --}}
    @if($userRole == 'inventory_manager')

        <a href="/admin/products"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black">
            <i class="fa-solid fa-boxes-stacked"></i> Stock Management
        </a>

        <a href="/admin/stock-alerts"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black">
            <i class="fa-solid fa-triangle-exclamation"></i> Low Stock
        </a>

    @endif

    {{-- ================= DELIVERY TEAM ================= --}}
    @if($userRole == 'delivery_team')

        <a href="/admin/orders"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black">
            <i class="fa-solid fa-truck"></i> Delivery Orders
        </a>

        <a href="/admin/delivery-routes"
           class="flex items-center gap-2 py-2 px-3 rounded mb-1 hover:bg-white hover:text-black">
            <i class="fa-solid fa-route"></i> Routes
        </a>

    @endif

</div>

    <!-- CONTENT AREA -->
    <div class="flex-1">

        <!-- TOP NAVBAR -->
        <div class="bg-white shadow px-6 py-4 flex justify-between items-center">

            <h2 class="font-bold text-gray-700">
                 {{ ucfirst(str_replace('_',' ', $userRole)) }} Dashboard
            </h2>

            <div class="flex items-center gap-4">

                <div class="flex items-center gap-2 text-gray-700">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-medium">{{ auth()->user()->name }}</span>
                </div>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>

            </div>

        </div>

        <!-- PAGE CONTENT -->
        <div class="p-6">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>