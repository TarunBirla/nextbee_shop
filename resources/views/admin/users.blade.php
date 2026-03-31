@extends('admin.layout')

@section('content')

<div class="p-6 ">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Users</h2>
            <p class="text-sm text-gray-500">Manage all system users</p>
        </div>
<div>
        <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">

            Total: {{ $users->count() }}
   
        </span>
                 <a href="{{ url('/admin/users/create') }}"
   class="bg-green-600 text-white px-3 py-1 rounded">
   + Add User
</a>
</div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-xl overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Joined</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($users as $user)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3 font-semibold">#{{ $user->id }}</td>

                    <td class="p-3 font-semibold text-gray-800">
                        {{ $user->name }}
                    </td>

                    <td class="p-3 text-gray-600">
                        {{ $user->email }}
                    </td>

                    <!-- ROLE BADGE -->
                    <td class="p-3">

                        @php
                            $roleColors = [
                                'business_owner' => 'bg-purple-100 text-purple-700',
                                'sales_rep' => 'bg-blue-100 text-blue-700',
                                'inventory_manager' => 'bg-yellow-100 text-yellow-700',
                                'delivery_team' => 'bg-green-100 text-green-700',
                                'customer' => 'bg-gray-100 text-gray-700',
                            ];
                        @endphp

                        <span class="px-3 py-1 rounded-full text-xs {{ $roleColors[$user->role] ?? 'bg-gray-100' }}">
                            {{ $user->role }}
                        </span>

                    </td>

                    <td class="p-3 text-gray-500 text-sm">
                        {{ $user->created_at->format('d M Y') }}
                    </td>

                    <!-- ACTIONS -->
                    <td class="p-3 flex gap-2 justify-center">

                       

                        <!-- DELETE -->
                        <form method="POST" action="/admin/users/{{ $user->id }}">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete this user?')"
                                class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center p-6 text-gray-500">
                        No users found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection