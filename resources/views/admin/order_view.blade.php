@extends('admin.layout')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Order #{{ $order->id }}</h2>

        <span class="px-4 py-1 rounded-full text-sm
            @if($order->status=='pending') bg-yellow-100 text-yellow-700
            @elseif($order->status=='delivered') bg-green-100 text-green-700
            @elseif($order->status=='cancelled') bg-red-100 text-red-700
            @else bg-blue-100 text-blue-700 @endif">
            {{ ucfirst(str_replace('_',' ', $order->status)) }}
        </span>
    </div>

    <!-- CANCELLED / DELIVERED ALERT -->
    @if($order->status == 'cancelled')
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            ❌ This order has been cancelled.
        </div>
    @endif

    @if($order->status == 'delivered')
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            ✅ Order successfully delivered to customer.
        </div>
    @endif

    <!-- INFO -->
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white p-5 rounded shadow">
            <h3 class="text-gray-500 text-sm">Customer</h3>
            <p class="font-bold">{{ $order->user->name ?? 'Guest' }}</p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h3 class="text-gray-500 text-sm">Total</h3>
            <p class="text-2xl font-bold">£{{ $order->total_price }}</p>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h3 class="text-gray-500 text-sm">Date</h3>
            <p>{{ $order->created_at->format('d M Y') }}</p>
        </div>

    </div>

    <!-- TRACKING -->
    <div class="bg-white mt-6 p-6 rounded shadow">

        <h3 class="text-lg font-bold mb-6">Tracking</h3>

        @php
        $steps = [
            'pending','confirmed','processing','shipped','out_for_delivery','delivered'
        ];

        $current = array_search($order->status, $steps);
        @endphp

        <div class="flex justify-between items-center">

            @foreach($steps as $i => $step)

                <div class="flex flex-col items-center">

                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                        {{ $i <= $current ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                        {{ $i+1 }}
                    </div>

                    <p class="text-xs mt-2 text-center">
                        {{ ucfirst(str_replace('_',' ',$step)) }}
                    </p>

                </div>

                @if(!$loop->last)
                    <div class="flex-1 h-1 bg-gray-200"></div>
                @endif

            @endforeach

        </div>

    </div>

    <!-- STATUS UPDATE (NO CANCEL HERE) -->
    @php
        $statuses = [
            'pending',
            'confirmed',
            'processing',
            'shipped',
            'out_for_delivery',
            'delivered'
        ];

        $currentIndex = array_search($order->status, $statuses);
        $nextStatus = $statuses[$currentIndex + 1] ?? $order->status;
    @endphp

    @if($order->status != 'cancelled' && $order->status != 'delivered')
    <div class="bg-white mt-6 p-6 rounded shadow">

        <form method="POST" action="/admin/orders/{{ $order->id }}/status">
            @csrf
            @method('PUT')

            <label class="block mb-2 font-semibold">Update Order Status</label>

            <div class="flex items-center gap-3">

                <select name="status" class="border p-2 rounded w-64">

                    @foreach($statuses as $status)

                        <option value="{{ $status }}"

                            @if($status == $nextStatus) selected @endif

                            @if(array_search($status, $statuses) <= $currentIndex)
                                disabled
                            @endif
                        >
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>

                    @endforeach

                </select>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Update
                </button>

            </div>

        </form>

    </div>
    @endif


    <!-- CANCEL BUTTON SEPARATE -->
    @if($order->status != 'delivered' && $order->status != 'cancelled')
    <div class="bg-white mt-6 p-6 rounded shadow">

        <form method="POST" action="/admin/orders/{{ $order->id }}/cancel">
            @csrf
            @method('PUT')

            <button onclick="return confirm('Are you sure you want to cancel this order?')"
                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">
                Cancel Order
            </button>

        </form>

    </div>
    @endif

</div>

@endsection