@extends('admin.layout')

@section('content')

<!-- STATS -->
<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold">Orders</h3>
        <p class="text-2xl">{{ $orders }}</p>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold">Products</h3>
        <p class="text-2xl">{{ $products }}</p>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h3 class="text-lg font-bold">Customers</h3>
        <p class="text-2xl">{{ $users }}</p>
    </div>

</div>



@endsection