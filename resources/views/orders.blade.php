@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif
<h2 class="text-2xl font-bold mb-6">My Orders</h2>

@forelse($orders as $order)

<div class="border p-4 mb-3 rounded">

    <h3>Order ID: {{ $order->id }}</h3>
    <p>Total: ₹{{ $order->total_price }}</p>

</div>

@empty
<p>No orders found</p>
@endforelse

</div>

@endsection