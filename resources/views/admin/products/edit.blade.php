@extends('admin.layout')

@section('content')

<div class=" flex items-center justify-center px-4 py-10">

    <div class="w-full  bg-white shadow-xl rounded-2xl p-8">

        <!-- Header -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Edit Product</h2>
            <p class="text-sm text-gray-500">Update product details below</p>
        </div>

        <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Title</label>
                <input type="text" name="title"
                    value="{{ $product->title }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 shadow-sm">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 shadow-sm">{{ $product->description }}</textarea>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                <input type="number" name="price"
                    value="{{ $product->price }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 shadow-sm">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 shadow-sm">

                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Current Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                <img src="/uploads/{{ $product->image }}"
                     class="w-24 h-24 object-cover rounded-lg border shadow">
            </div>

            <!-- Upload New Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Change Image</label>
                <input type="file" name="image"
                    class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2 file:bg-blue-600 file:text-white file:border-0 file:px-4 file:py-2 file:rounded-lg file:cursor-pointer">
            </div>

            <!-- Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200">
                    Update Product
                </button>
            </div>

        </form>

    </div>

</div>

@endsection