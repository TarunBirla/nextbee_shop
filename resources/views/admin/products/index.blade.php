@extends('admin.layout')

@section('content')

<div class=" p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Products</h2>
            <p class="text-sm text-gray-500">Manage all your products</p>
        </div>

        <a href="/admin/products/create"
           class="mt-3 md:mt-0 inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
            + Add Product
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white shadow-md rounded-xl overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                <!-- Table Head -->
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-gray-200">

                    @foreach($products as $p)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-4 py-3 font-medium text-gray-700">
                            #{{ $p->id }}
                        </td>

                        <td class="px-4 py-3">
                            <img src="/uploads/{{ $p->image }}"
                                 class="w-12 h-12 object-cover rounded-lg border">
                        </td>

                        <td class="px-4 py-3 font-semibold text-gray-800">
                            {{ $p->title }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                {{ $p->category->name ?? 'N/A' }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-gray-700">
                            £{{ $p->price }}
                        </td>

                        <td class="px-4 py-3 text-center space-x-2">

                            <a href="/admin/products/{{ $p->id }}/edit"
                               class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-lg text-xs hover:bg-blue-200">
                                Edit
                            </a>

                            <form action="/admin/products/{{ $p->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Are you sure?')"
                                        class="bg-red-100 text-red-600 px-3 py-1 rounded-lg text-xs hover:bg-red-200">
                                    Delete
                                </button>
                            </form>

                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection