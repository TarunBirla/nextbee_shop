@extends('admin.layout')

@section('content')

<div class="0 flex items-center justify-center px-4 py-10">

    <div class="w-full bg-white shadow-xl rounded-2xl p-8">

        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Edit Category</h2>
            <p class="text-sm text-gray-500">Update category details</p>
        </div>

        <form method="POST" action="/admin/categories/{{ $category->id }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="name"
                    value="{{ $category->name }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 shadow-sm">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
                Update Category
            </button>

        </form>

    </div>

</div>

@endsection