@extends('admin.layout')

@section('content')

<div class=" p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Categories</h2>
            <p class="text-sm text-gray-500">Manage product categories</p>
        </div>

        <a href="/admin/categories/create"
           class="mt-3 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
            + Add Category
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-xl overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @foreach($categories as $cat)
                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 font-medium text-gray-700">
                        #{{ $cat->id }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-gray-800">
                        {{ $cat->name }}
                    </td>

                    <td class="px-4 py-3 text-center space-x-2">

                        <a href="/admin/categories/{{ $cat->id }}/edit"
                           class="bg-blue-100 text-blue-600 px-3 py-1 rounded-lg text-xs hover:bg-blue-200">
                            Edit
                        </a>

                        <form action="/admin/categories/{{ $cat->id }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete this category?')"
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

@endsection