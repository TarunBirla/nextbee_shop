@extends('admin.layout')

@section('content')

<form method="POST" action="/admin/products" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Title"
        class="border w-full mb-2 px-3 py-2">

    <textarea name="description" placeholder="Description"
        class="border w-full mb-2 px-3 py-2"></textarea>

    <input type="number" name="price" placeholder="Price"
        class="border w-full mb-2 px-3 py-2">

    <!-- CATEGORY -->
    <select name="category_id" class="border w-full mb-2 px-3 py-2">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>

    <input type="file" name="image" class="mb-3">

    <button class="bg-green-500 text-white px-4 py-2">Save</button>
</form>

@endsection