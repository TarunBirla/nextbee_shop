@extends('admin.layout')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold">Customers</h2>

    <span class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded">
        Total: {{ $users->count() }}
    </span>
</div>

<div class="bg-white shadow rounded overflow-x-auto">

    <table class="w-full">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Role</th>
                <th class="p-3 text-left">Joined</th>
            </tr>
        </thead>

        <tbody>

            @forelse($users as $user)

            <tr class="border-b hover:bg-gray-50">

                <td class="p-3">{{ $user->id }}</td>
                <td class="p-3 font-semibold">{{ $user->name }}</td>
                <td class="p-3">{{ $user->email }}</td>
                <td class="p-3">
                    <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-sm">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="p-3 text-sm text-gray-500">
                    {{ $user->created_at->format('d M Y') }}
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="text-center p-5 text-gray-500">
                    No users found
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection