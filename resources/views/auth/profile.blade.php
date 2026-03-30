@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">

    <h2 class="text-2xl font-bold mb-6">My Profile</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">

        <div class="mb-4">
            <label class="font-semibold">Name:</label>
            <p>{{ auth()->user()->name }}</p>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Email:</label>
            <p>{{ auth()->user()->email }}</p>
        </div>

        

        <!-- EDIT BUTTON -->
        <button onclick="openModal()" 
            class="mt-4 bg-[#253375] text-white px-5 py-2 rounded">
            Edit Profile
        </button>

    </div>

</div>

<!-- MODAL -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">

    <div class="bg-white rounded-lg p-6 w-full max-w-md">

        <h3 class="text-xl font-bold mb-4">Edit Profile</h3>

        <form action="/profile/update" method="POST">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name"
                    value="{{ auth()->user()->name }}"
                    class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email"
                    value="{{ auth()->user()->email }}"
                    class="w-full border p-2 rounded">
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeModal()" 
                    class="px-4 py-2 bg-gray-400 text-white rounded">
                    Cancel
                </button>

                <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded">
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