@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-3xl font-bold text-[#8B5E3C] mb-8 flex items-center gap-2">
        <i class="fa-solid fa-box"></i> My Orders
    </h2>

    <div class="space-y-4">

        @forelse($orders as $order)

            <div class="bg-white shadow rounded-xl p-5 hover:shadow-lg transition">

                <div class="flex justify-between items-center">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-receipt text-[#8B5E3C]"></i>
                            Order #{{ $order->id }}
                        </h3>

                        <p class="text-gray-500 text-sm mt-1">
                            <i class="fa-solid fa-calendar-days mr-1"></i>
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="text-lg font-bold text-[#8B5E3C]">
                            £
                            {{ $order->total_price }}
                        </p>

                        <a href="/order/{{ $order->id }}"
                           class="text-sm text-black hover:underline mt-1 inline-block">
                            View Details →
                        </a>
                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
                <i class="fa-regular fa-face-frown text-2xl mb-2"></i><br>
                No orders found
            </div>

        @endforelse

    </div>

</div>

@endsection