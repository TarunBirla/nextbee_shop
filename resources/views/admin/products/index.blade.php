@extends('admin.layout')

@section('content')

<a href="/admin/products/create" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</a>

<table class="w-full mt-4 border">
    <tr class="bg-gray-200">
        <th>ID</th>
        <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Price</th>
        <th>Action</th>
    </tr>

    @foreach($products as $p)
    <tr class="text-center border">
        <td>{{ $p->id }}</td>

        <td>
            <img src="/uploads/{{ $p->image }}" width="50">
        </td>

        <td>{{ $p->title }}</td>
        <td>{{ $p->category->name ?? '' }}</td>
        <td>{{ $p->price }}</td>

        <td>
            <a href="/admin/products/{{ $p->id }}/edit" class="text-blue-500">Edit</a>

            <form action="/admin/products/{{ $p->id }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-500">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection