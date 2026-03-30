@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

<h2 class="text-2xl font-bold mb-6">My Cart</h2>

@php $total = 0; @endphp

@forelse($items as $item)

<div class="flex justify-between items-center border p-4 mb-3 rounded">

    <div>
        <h3 class="font-bold">{{ $item->product->title }}</h3>
        <p>Qty: {{ $item->quantity }}</p>
    </div>

    <div class="text-right">
        <p class="font-bold text-lg">
            £{{ $item->product->price * $item->quantity }}
        </p>

        <!-- REMOVE BUTTON -->
        <a href="/remove-cart/{{ $item->id }}"
           class="text-red-500 text-sm mt-1 inline-block">
           Remove
        </a>
    </div>

</div>

@php $total += $item->product->price * $item->quantity; @endphp

@empty
<p>No items in cart</p>
@endforelse

<h3 class="text-xl font-bold mt-4">Total: £{{ $total }}</h3>

@if(count($items) > 0)
<form action="/place-order" method="POST">
    @csrf
    <button class="bg-green-600 text-white px-6 py-2 mt-4 rounded">
        Place Order
    </button>
</form>
@endif

</div>

@endsection