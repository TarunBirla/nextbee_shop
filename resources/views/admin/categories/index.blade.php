@extends('admin.layout')

@section('content')

<a href="/admin/categories/create" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</a>

<table class="w-full mt-4 border">
    <tr class="bg-gray-200">
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>

    @foreach($categories as $cat)
    <tr class="text-center border">
        <td>{{ $cat->id }}</td>
        <td>{{ $cat->name }}</td>
        <td>
            <a href="/admin/categories/{{ $cat->id }}/edit" class="text-blue-500">Edit</a>

            <form action="/admin/categories/{{ $cat->id }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-500">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection