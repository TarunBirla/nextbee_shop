@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center  px-4">

    <div class="w-full max-w-md">

        <!-- CARD -->
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="bg-[#8B5E3C] text-white text-center py-6">
                <h2 class="text-2xl font-bold">Welcome Back</h2>
                <p class="text-sm text-gray-200">Login to your account</p>
            </div>

            <!-- BODY -->
            <div class="p-8">

                @if(session('success'))
                    <p class="text-green-600 mb-3 text-sm">{{ session('success') }}</p>
                @endif

                @if(session('error'))
                    <p class="text-red-500 mb-3 text-sm">{{ session('error') }}</p>
                @endif

                <form method="POST" action="/login" class="space-y-4">
                    @csrf

                    <!-- EMAIL -->
                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input type="email" name="email"
                            class="w-full mt-1 px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8B5E3C]"
                            placeholder="Enter your email" required>
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm text-gray-600">Password</label>
                        <input type="password" name="password"
                            class="w-full mt-1 px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8B5E3C]"
                            placeholder="Enter your password" required>
                    </div>

                    <!-- REMEMBER -->
                    <div class="flex justify-between items-center text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="accent-[#8B5E3C]">
                            Remember me
                        </label>

                        <a href="#" class="text-[#8B5E3C] hover:underline">
                            Forgot password?
                        </a>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-[#8B5E3C] hover:bg-[#8B5E3C] text-white py-3 rounded-lg font-medium transition">
                        Login
                    </button>

                </form>

                <!-- FOOTER -->
                <p class="text-sm mt-6 text-center text-gray-600">
                    Don't have an account?
                    <a href="/register" class="text-[#8B5E3C] font-medium hover:underline">
                        Register
                    </a>
                </p>

            </div>

        </div>

    </div>

</div>

@endsection