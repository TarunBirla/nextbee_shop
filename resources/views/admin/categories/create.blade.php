@extends('admin.layout')

@section('content')

<div class=" flex items-center justify-center px-4 py-10">

    <div class="w-full  bg-white shadow-xl rounded-2xl p-8">

        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Create Category</h2>
            <p class="text-sm text-gray-500">Add a new category</p>
        </div>

        <form method="POST" action="/admin/categories" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="name"
                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 px-4 py-2 shadow-sm"
                    placeholder="Enter category name">
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
                Save Category
            </button>

        </form>

    </div>

</div>

@endsection