@extends('admin.layout')

@section('content')

<form method="POST" action="/admin/categories">
    @csrf

    <input type="text" name="name" placeholder="Category Name"
        class="border px-3 py-2 w-full mb-3">

    <button class="bg-green-500 text-white px-4 py-2">Save</button>
</form>

@endsection