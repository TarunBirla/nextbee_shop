@extends('layouts.app')

@section('content')

<div class="bg-gray-50 min-h-screen py-14">

    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Contact Us</h1>
            <p class="text-gray-500 mt-2">We'd love to hear from you. Get in touch with us anytime.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- CONTACT INFO -->
            <div class="bg-white shadow-lg rounded-2xl p-8">

                <h2 class="text-2xl font-semibold mb-6 text-gray-800">Get in Touch</h2>

                <div class="space-y-5 text-gray-600">

                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-envelope text-blue-500 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Email</p>
                            <p>support@yourcompany.co.uk</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-phone text-green-500 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Phone</p>
                            <p>+44 20 7946 0958</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot text-red-500 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Address</p>
                            <p>221B Baker Street, London, UK</p>
                        </div>
                    </div>

                </div>

                <!-- EXTRA INFO BOX -->
                <div class="mt-8 bg-blue-50 p-5 rounded-xl">
                    <p class="text-sm text-gray-600">
                        Our support team usually responds within 24 hours.
                    </p>
                </div>

            </div>

            <!-- CONTACT FORM -->
            <div class="bg-white shadow-lg rounded-2xl p-8">

                <h2 class="text-2xl font-semibold mb-6 text-gray-800">Send Message</h2>

                <form method="POST" action="#">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Name</label>
                        <input type="text" name="name"
                            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Your Name">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email"
                            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="you@example.com">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Message</label>
                        <textarea name="message" rows="5"
                            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Write your message..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Send Message
                    </button>

                </form>

            </div>

        </div>
    </div>

</div>

@endsection