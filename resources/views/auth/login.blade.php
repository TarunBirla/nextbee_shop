@extends('layouts.app')

@section('content')

<div class="flex justify-center items-center py-20">
    <form method="POST" action="/login" class="bg-white p-8 shadow-lg rounded-lg w-96">
        @csrf
        @if(session('success'))
    <p class="text-green-500 mb-3">{{ session('success') }}</p>
@endif

        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if(session('error'))
            <p class="text-red-500 mb-3">{{ session('error') }}</p>
        @endif

        <input type="email" name="email" placeholder="Email"
            class="w-full mb-4 px-4 py-2 border rounded-lg" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full mb-4 px-4 py-2 border rounded-lg" required>

        <button class="w-full bg-[#253375] text-white py-2 rounded-lg">
            Login
        </button>

        <p class="text-sm mt-4 text-center">
            Don't have account? <a href="/register" class="text-blue-600">Register</a>
        </p>
    </form>
</div>

@endsection