<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <div class="w-64 bg-[#253375] min-h-screen text-white p-5">

        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

        <a href="/admin/dashboard"
           class="block py-2 px-3 rounded {{ request()->is('admin/dashboard') ? 'bg-white text-black' : '' }}">
            Dashboard
        </a>

        <a href="/admin/products"
           class="block py-2 px-3 rounded {{ request()->is('admin/products*') ? 'bg-white text-black' : '' }}">
            Products
        </a>

        <a href="/admin/categories"
           class="block py-2 px-3 rounded {{ request()->is('admin/categories*') ? 'bg-white text-black' : '' }}">
            Categories
        </a>

        <a href="/admin/orders"
           class="block py-2 px-3 rounded {{ request()->is('admin/orders*') ? 'bg-white text-black' : '' }}">
            Orders
        </a>

        <a href="/admin/users"
           class="block py-2 px-3 rounded {{ request()->is('admin/users*') ? 'bg-white text-black' : '' }}">
            Users
        </a>

    </div>

    <!-- CONTENT -->
    <div class="flex-1">

        <!-- NAVBAR -->
        <div class="bg-white shadow p-4 flex justify-between">
            <h2 class="font-bold">Admin Dashboard</h2>

            <div class="flex gap-3 items-center">
                <span>{{ auth()->user()->name }}</span>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded">
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