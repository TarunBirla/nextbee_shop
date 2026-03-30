@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-3xl font-bold text-[#8B5E3C] mb-8">
        <i class="fa-solid fa-cart-shopping mr-2"></i> My Cart
    </h2>

    @php $total = 0; @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="lg:col-span-2 space-y-4">

            @forelse($items as $item)

                <div class="flex items-center gap-4 bg-white shadow rounded-xl p-4 hover:shadow-lg transition">

                    <!-- IMAGE -->
                    <div class="w-24 h-24 overflow-hidden rounded-lg ">
                        <img src="/uploads/{{ $item->product->image }}"
                             class="w-full h-full object-cover hover:scale-105 transition">
                    </div>

                    <!-- DETAILS -->
                    <div class="flex-1">

                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-box text-[#8B5E3C]"></i>
                            {{ $item->product->title }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fa-solid fa-layer-group mr-1"></i>
                            Quantity: {{ $item->quantity }}
                        </p>

                        <div class="flex items-center justify-between mt-3">

                            <p class="text-[#8B5E3C] font-bold text-lg">
                                £
                                {{ $item->product->price * $item->quantity }}
                            </p>

                            <a href="/remove-cart/{{ $item->id }}"
                               class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center gap-1">

                                <i class="fa-solid fa-trash"></i> Remove
                            </a>

                        </div>

                    </div>

                </div>

                @php
                    $total += $item->product->price * $item->quantity;
                @endphp

            @empty

                <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
                    <i class="fa-regular fa-face-frown text-2xl mb-2"></i><br>
                    No items in cart
                </div>

            @endforelse

        </div>

        <!-- SUMMARY -->
        <div class="bg-white shadow-lg rounded-xl p-6 h-fit sticky top-24">

            <h3 class="text-xl font-bold text-[#8B5E3C] mb-4">
                <i class="fa-solid fa-receipt mr-2"></i> Order Summary
            </h3>

            <div class="flex justify-between mb-2 text-gray-600">
                <span>Subtotal</span>
                <span>£{{ $total }}</span>
            </div>

            <div class="flex justify-between mb-2 text-gray-600">
                <span>Shipping</span>
                <span><i class="fa-solid fa-truck-fast mr-1"></i> Free</span>
            </div>

            <hr class="my-3">

            <div class="flex justify-between text-lg font-bold text-gray-800 mb-6">
                <span>Total</span>
                <span>
                    <i class="fa-solid fa-gbp"></i> {{ $total }}
                </span>
            </div>

            @if(count($items) > 0)
                <form action="/place-order" method="POST">
                    @csrf

                    <button class="w-full bg-[#8B5E3C] hover:bg-[#8B5E3C] text-white py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">

                        <i class="fa-solid fa-bag-shopping"></i>
                        Place Order
                    </button>
                </form>
            @endif

        </div>

    </div>

</div>

@endsection