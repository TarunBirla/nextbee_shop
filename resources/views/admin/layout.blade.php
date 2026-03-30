<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
   <!-- SIDEBAR -->
<div class="w-64 bg-[#8B5E3C] min-h-screen text-white p-5">

    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
        <i class="fa-solid fa-gauge"></i> Bussiness Owner
    </h2>

    <a href="/admin/dashboard"
       class="block py-2 px-3 rounded hover:bg-white hover:text-black">
        <i class="fa-solid fa-chart-line mr-2"></i> Dashboard
    </a>

    <a href="/admin/products"
       class="block py-2 px-3 rounded hover:bg-white hover:text-black">
        <i class="fa-solid fa-box mr-2"></i> Products
    </a>

    <a href="/admin/categories"
       class="block py-2 px-3 rounded hover:bg-white hover:text-black">
        <i class="fa-solid fa-list mr-2"></i> Categories
    </a>

    <a href="/admin/orders"
       class="block py-2 px-3 rounded hover:bg-white hover:text-black">
        <i class="fa-solid fa-cart-shopping mr-2"></i> Orders
    </a>

    <a href="/admin/users"
       class="block py-2 px-3 rounded hover:bg-white hover:text-black">
        <i class="fa-solid fa-users mr-2"></i> Users
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