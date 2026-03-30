@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-3xl font-bold text-[#8B5E3C] flex items-center gap-2">
            <i class="fa-solid fa-box-open"></i>
            Order #{{ $order->id }}
        </h2>

        <!-- REORDER BUTTON -->
        <form action="/reorder/{{ $order->id }}" method="POST">
            @csrf
            <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fa-solid fa-repeat"></i>
                Reorder
            </button>
        </form>

    </div>

    <!-- ORDER INFO -->
    <div class="bg-white shadow rounded-xl p-4 mb-6 flex justify-between">

        <p class="text-gray-600">
            <i class="fa-solid fa-calendar mr-1"></i>
            {{ $order->created_at->format('d M Y h:i A') }}
        </p>

        <p class="font-bold text-[#8B5E3C]">
            Total: £{{ $order->total_price }}
        </p>

    </div>

    <!-- PRODUCTS -->
    <div class="space-y-4">

       @forelse($order->items as $item)

    @if($item->product)

        <div class="flex items-center gap-4 bg-white shadow rounded-xl p-4">

            <div class="w-24 h-24 overflow-hidden rounded-lg border">
                <img src="/uploads/{{ $item->product->image }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="flex-1">

                <h3 class="text-lg font-semibold">
                    {{ $item->product->title }}
                </h3>

                <p>Qty: {{ $item->quantity }}</p>

                <p class="font-bold text-[#8B5E3C]">
                    £{{ $item->product->price * $item->quantity }}
                </p>

            </div>

        </div>

    @endif

@empty

    <p class="text-gray-500">No products found in this order</p>

@endforelse

    </div>

</div>

@endsection