@extends('admin.layout')

@section('content')

<h2 class="text-xl font-bold mb-4">Edit Product</h2>

<form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $product->title }}"
        class="border w-full mb-2 px-3 py-2">

    <textarea name="description"
        class="border w-full mb-2 px-3 py-2">{{ $product->description }}</textarea>

    <input type="number" name="price" value="{{ $product->price }}"
        class="border w-full mb-2 px-3 py-2">

    <!-- CATEGORY -->
    <select name="category_id" class="border w-full mb-2 px-3 py-2">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <!-- OLD IMAGE -->
    <img src="/uploads/{{ $product->image }}" width="80" class="mb-2">

    <input type="file" name="image" class="mb-3">

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Update
    </button>
</form>

@endsection