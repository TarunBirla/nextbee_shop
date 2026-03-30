@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center  px-4">

    <div class="w-full max-w-md">

        <!-- CARD -->
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="bg-[#8B5E3C] text-white text-center py-6">
                <h2 class="text-2xl font-bold">Create Account</h2>
                <p class="text-sm text-gray-200">Join us and start shopping</p>
            </div>

            <!-- BODY -->
            <div class="p-8">

                <form method="POST" action="/register" class="space-y-4">
                    @csrf

                    <!-- NAME -->
                    <div>
                        <label class="text-sm text-gray-600">Full Name</label>
                        <input type="text" name="name"
                            class="w-full mt-1 px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8B5E3C]"
                            placeholder="Enter your name" required>
                    </div>

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
                            placeholder="Create password" required>
                    </div>

                    <!-- ROLE (HIDDEN FIXED) -->
                    <input type="hidden" name="role" value="customer">

                    <!-- TERMS -->
                    <div class="flex items-start gap-2 text-sm">
                        <input type="checkbox" required class="mt-1 accent-[#8B5E3C]">
                        <span class="text-gray-600">
                            I agree to the Terms & Conditions
                        </span>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-[#8B5E3C] hover:bg-[#8B5E3C] text-white py-3 rounded-lg font-medium transition">
                        Create Account
                    </button>

                </form>

                <!-- LOGIN LINK -->
                <p class="text-sm mt-6 text-center text-gray-600">
                    Already have an account?
                    <a href="/login" class="text-[#8B5E3C] font-medium hover:underline">
                        Login
                    </a>
                </p>

            </div>

        </div>

    </div>

</div>

@endsection