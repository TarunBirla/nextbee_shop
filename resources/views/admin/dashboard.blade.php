@extends('admin.layout')

@section('content')

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold">Orders</h3>
        <p class="text-2xl mt-2">10</p>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold">Products</h3>
        <p class="text-2xl mt-2">25</p>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold">Users</h3>
        <p class="text-2xl mt-2">50</p>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold">Revenue</h3>
        <p class="text-2xl mt-2">£5000</p>
    </div>

</div>

@endsection