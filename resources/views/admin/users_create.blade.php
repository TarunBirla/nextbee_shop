@extends('admin.layout')

@section('content')

<h2 class="text-xl font-bold mb-4">Add New User</h2>

<form method="POST" action="{{ url('/admin/users/store') }}" class="bg-white p-6 shadow rounded">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="w-full border p-2 rounded" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role }}">{{ ucfirst(str_replace('_',' ', $role)) }}</option>
            @endforeach
        </select>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Create User
    </button>

</form>

@endsection