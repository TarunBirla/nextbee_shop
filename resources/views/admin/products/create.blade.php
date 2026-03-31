@extends('admin.layout')

@section('content')

<div class=" flex items-center justify-center px-4 py-10">

    <div class="w-full bg-white shadow-xl rounded-2xl p-8">

        <!-- Header -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Create Product</h2>
            <p class="text-sm text-gray-500">Add new product details below</p>
        </div>

        <form method="POST" action="/admin/products" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Title</label>
                <input type="text" name="title"
                    class="w-full rounded-lg border-gray-800 focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2 shadow-sm"
                    placeholder="Enter product title">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2 shadow-sm"
                    placeholder="Enter product description"></textarea>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                <input type="number" name="price"
                    class="w-full rounded-lg border-gray-800 focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2 shadow-sm"
                    placeholder="Enter price">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id"
                    class="w-full rounded-lg border-gray-800 focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2 shadow-sm">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                <input type="file" name="image"
                    class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2 file:bg-green-500 file:text-white file:border-0 file:px-4 file:py-2 file:rounded-lg file:cursor-pointer">
            </div>

            <!-- Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200">
                    Save Product
                </button>
            </div>

        </form>
    </div>

</div>

@endsection