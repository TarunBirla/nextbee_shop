@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <!-- HEADER -->
    <div class="flex items-center gap-2 mb-6">
        <i class="fa-solid fa-user text-2xl text-[#8B5E3C]"></i>
        <h2 class="text-3xl font-bold text-[#8B5E3C]">My Profile</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- PROFILE CARD -->
    <div class="bg-white shadow-lg rounded-xl p-6">

        <!-- NAME -->
        <div class="flex items-center gap-3 mb-4">
            <i class="fa-solid fa-id-badge text-[#8B5E3C]"></i>
            <div>
                <p class="text-sm text-gray-500">Name</p>
                <p class="font-semibold text-lg">{{ auth()->user()->name }}</p>
            </div>
        </div>

        <!-- EMAIL -->
        <div class="flex items-center gap-3 mb-6">
            <i class="fa-solid fa-envelope text-[#8B5E3C]"></i>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-semibold text-lg">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <!-- EDIT BUTTON -->
        <button onclick="openModal()"
            class="bg-[#8B5E3C] hover:bg-[#8B5E3C] text-white px-5 py-2 rounded-lg flex items-center gap-2 transition">

            <i class="fa-solid fa-pen-to-square"></i>
            Edit Profile
        </button>

    </div>

</div>

<!-- MODAL -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">

    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">

        <div class="flex items-center gap-2 mb-4">
            <i class="fa-solid fa-user-pen text-[#8B5E3C]"></i>
            <h3 class="text-xl font-bold">Edit Profile</h3>
        </div>

        <form action="/profile/update" method="POST">
            @csrf

            <!-- NAME -->
            <div class="mb-3">
                <label class="text-sm text-gray-600">Name</label>
                <input type="text" name="name"
                    value="{{ auth()->user()->name }}"
                    class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-[#8B5E3C]">
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="text-sm text-gray-600">Email</label>
                <input type="email" name="email"
                    value="{{ auth()->user()->email }}"
                    class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-[#8B5E3C]">
            </div>

            <!-- BUTTONS -->
            <div class="flex justify-end gap-2 mt-4">

                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-400 text-white rounded-lg flex items-center gap-1">

                    <i class="fa-solid fa-xmark"></i>
                    Cancel
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg flex items-center gap-1">

                    <i class="fa-solid fa-check"></i>
                    Update
                </button>

            </div>

        </form>

    </div>

</div>

<!-- JS -->
<script>
function openModal() {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>

@endsection