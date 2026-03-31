@extends('admin.layout')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold">
    Dashboard ({{ ucfirst($role) }})
</h2>
    <p class="text-gray-500 text-sm">Overview of your business</p>
</div>

<!-- STATS GRID -->
@if($role == 'business_owner')

<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-600">
        360° Business Overview
    </h3>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- ORDERS -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
        <h3 class="text-sm text-gray-500">Total Orders</h3>
        <p class="text-2xl font-bold mt-2">{{ $orders }}</p>
    </div>

    <!-- PRODUCTS -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
        <h3 class="text-sm text-gray-500">Total Products</h3>
        <p class="text-2xl font-bold mt-2">{{ $products }}</p>
    </div>

    <!-- CUSTOMERS -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
        <h3 class="text-sm text-gray-500">Customers</h3>
        <p class="text-2xl font-bold mt-2">{{ $users }}</p>
    </div>

    <!-- REVENUE -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-xl shadow">
        <h3 class="text-sm opacity-90">Total Revenue</h3>
        <p class="text-2xl font-bold mt-2">£ {{ $totalEarning }}</p>
    </div>

</div>

<!-- ROLE BREAKDOWN -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- SALES REP -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500">Sales Reps</h3>
        <p class="text-xl font-bold mt-2">
            {{ \App\Models\User::where('role','sale_rep')->count() }}
        </p>
    </div>

    <!-- INVENTORY -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500">Inventory Managers</h3>
        <p class="text-xl font-bold mt-2">
            {{ \App\Models\User::where('role','inventory_manager')->count() }}
        </p>
    </div>

    <!-- DELIVERY -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500">Delivery Team</h3>
        <p class="text-xl font-bold mt-2">
            {{ \App\Models\User::where('role','delivery_team')->count() }}
        </p>
    </div>

</div>

<!-- QUICK INSIGHTS -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-semibold mb-3">Order Status Insight</h3>
        <p>Pending: {{ \App\Models\Order::where('status','pending')->count() }}</p>
        <p>Processing: {{ \App\Models\Order::where('status','processing')->count() }}</p>
        <p>Delivered: {{ \App\Models\Order::where('status','delivered')->count() }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-semibold mb-3">Business Health</h3>
        <p>Total Users: {{ \App\Models\User::count() }}</p>
        <p>Total Active Orders: {{ \App\Models\Order::whereIn('status',['pending','processing'])->count() }}</p>
        <p>Completed Orders: {{ \App\Models\Order::where('status','completed')->count() }}</p>
    </div>

</div>

@endif

@if($role == 'sale_rep')

<div class="grid grid-cols-2 gap-6">

    <div class="bg-white p-6 rounded-xl">
        <h3>Active Orders</h3>
        <p>{{ $orders }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl">
        <h3>Total Earnings</h3>
        <p>£ {{ $totalEarning }}</p>
    </div>

</div>

@endif

@if($role == 'inventory_manager')

<div class="grid grid-cols-1 gap-6">

    <div class="bg-white p-6 rounded-xl">
        <h3>Total Products</h3>
        <p>{{ $products }}</p>
    </div>

</div>

@endif

@if($role == 'delivery_team')

<div class="grid grid-cols-1 gap-6">

    <div class="bg-white p-6 rounded-xl">
        <h3>Active Deliveries</h3>
        <p>{{ $orders }}</p>
    </div>

</div>

@endif

@endsection