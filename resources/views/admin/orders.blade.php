@extends('admin.layout')

@section('content')

    <div class="p-6 ">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Orders</h2>

            <span class="text-sm bg-orange-100 text-orange-700 px-4 py-1 rounded-full">
                Total Orders: {{ $orders->count() }}
            </span>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-xl overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="p-3 text-left">Order ID</th>
                        <th class="p-3 text-left">Customer</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Date</th>
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $order)

                                    <tr class="border-b hover:bg-gray-50">

                                        <td class="p-3 font-semibold">#{{ $order->id }}</td>

                                        <!-- CUSTOMER -->
                                        <td class="p-3">
                                            <div class="font-semibold text-gray-800">
                                                {{ $order->user->name ?? 'Guest' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $order->user->email ?? '' }}
                                            </div>
                                        </td>

                                        <!-- TOTAL -->
                                        <td class="p-3 font-medium text-gray-700">
                                            £{{ $order->total_price }}
                                        </td>

                                        <!-- STATUS -->
                                        <td class="p-3">

                                            @php
                                                $status = $order->status;
                                            @endphp

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold

                            @if($status == 'pending')
                                bg-yellow-100 text-yellow-700

                            @elseif($status == 'confirmed')
                                bg-blue-100 text-blue-700

                            @elseif($status == 'processing')
                                bg-indigo-100 text-indigo-700

                            @elseif($status == 'shipped')
                                bg-purple-100 text-purple-700

                            @elseif($status == 'out_for_delivery')
                                bg-orange-100 text-orange-700

                            @elseif($status == 'delivered')
                                bg-green-100 text-green-700

                            @elseif($status == 'completed')
                                bg-emerald-100 text-emerald-700

                            @elseif($status == 'cancelled')
                                bg-red-100 text-red-700

                            @else
                                bg-gray-100 text-gray-700
                            @endif
                        ">
                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </span>

                                        </td>

                                        <!-- DATE -->
                                        <td class="p-3 text-gray-500 text-sm">
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>

                                        <!-- ACTIONS -->
                                        <td class="p-3 flex gap-2 justify-center">

                                            <!-- VIEW -->
                                            <a href="/admin/orders/{{ $order->id }}/view"
                                                class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-xs hover:bg-blue-200">
                                                View
                                            </a>


                                            <!-- DELETE -->
                                            <form method="POST" action="/admin/orders/{{ $order->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button onclick="return confirm('Delete this order?')"
                                                    class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>

                                    </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">
                                No orders found
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection