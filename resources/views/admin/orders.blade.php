@extends('admin.layout')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold">Orders</h2>

    <span class="text-sm bg-orange-100 text-orange-700 px-3 py-1 rounded">
        Total: {{ $orders->count() }}
    </span>
</div>

<div class="bg-white shadow rounded overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Order ID</th>
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-left">Total</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Date</th>
            </tr>
        </thead>

        <tbody>

            @forelse($orders as $order)

            <tr class="border-b hover:bg-gray-50">

                <td class="p-3">#{{ $order->id }}</td>

                <td class="p-3 font-semibold">
                    {{ $order->user->name ?? 'Guest' }}
                </td>

                <td class="p-3">
                    £{{ $order->total_price }}
                </td>

                <td class="p-3">
                    @if($order->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm">Pending</span>
                    @elseif($order->status == 'completed')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Completed</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">{{ $order->status }}</span>
                    @endif
                </td>

                <td class="p-3 text-sm text-gray-500">
                    {{ $order->created_at->format('d M Y') }}
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="text-center p-5 text-gray-500">
                    No orders found
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection