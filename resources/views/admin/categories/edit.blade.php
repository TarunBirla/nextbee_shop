@extends('admin.layout')

@section('content')

<h2 class="text-xl font-bold mb-4">Edit Category</h2>

<form method="POST" action="/admin/categories/{{ $category->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $category->name }}"
        class="border px-3 py-2 w-full mb-3">

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Update
    </button>
</form>

@endsection