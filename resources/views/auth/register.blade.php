@extends('layouts.app')

@section('content')

<div class="flex justify-center items-center py-20">
    <form method="POST" action="/register" class="bg-white p-8 shadow-lg rounded-lg w-96">
        @csrf

        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

        <input type="text" name="name" placeholder="Name"
            class="w-full mb-4 px-4 py-2 border rounded-lg" required>

        <input type="email" name="email" placeholder="Email"
            class="w-full mb-4 px-4 py-2 border rounded-lg" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full mb-4 px-4 py-2 border rounded-lg" required>

        <!-- ROLE -->
        <select name="role" class="w-full mb-4 px-4 py-2 border rounded-lg">
            <option value="customer">Customer</option>
            <option value="bussiness_owner">Bussiness Owner</option>
        </select>

        <button class="w-full bg-[#253375] text-white py-2 rounded-lg">
            Register
        </button>
    </form>
</div>

@endsection