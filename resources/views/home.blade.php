@extends('layouts.app')

@section('content')

    <div>

        <!-- Hero Section -->
        <!-- HERO SLIDER -->
        <div class="relative w-full h-[400px] overflow-hidden">

            <!-- Slide 1 -->
            <div class="slide absolute inset-0 bg-cover bg-center flex items-center justify-center text-center text-white"
                style="background-image: url('https://images.unsplash.com/photo-1607082349566-187342175e2f');">
                <div class=" p-6 rounded-xl">
                    <h1 class="text-4xl font-bold mb-3">Welcome to Eurowide</h1>
                    <p class="mb-4">Best wholesale deals for your business</p>
                    <a href="#" class="bg-[#253375] px-6 py-2 rounded-lg">Shop Now</a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide absolute inset-0 bg-cover bg-center flex items-center justify-center text-center text-white hidden"
                style="background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d');">
                <div class=" p-6 rounded-xl">
                    <h1 class="text-4xl font-bold mb-3">Bulk Products Available</h1>
                    <p class="mb-4">Get best prices on bulk orders</p>
                    <a href="#" class="bg-[#253375] px-6 py-2 rounded-lg">Explore</a>
                </div>
            </div>

        </div>

        <!-- FEATURES STRIP -->
        <div class="bg-[#253375] text-white py-8">
            <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

                <!-- Item 1 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="text-3xl">🚚</div>
                    <h3 class="font-semibold">Nationwide Delivery</h3>
                </div>

                <!-- Item 2 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="text-3xl">✅</div>
                    <h3 class="font-semibold">100% Satisfaction Guaranteed</h3>
                </div>

                <!-- Item 3 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="text-3xl">💰</div>
                    <h3 class="font-semibold">Exclusive Deals & Bulk Pricing</h3>
                </div>

                <!-- Item 4 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="text-3xl">📞</div>
                    <h3 class="font-semibold">Customer Support</h3>
                </div>

            </div>
        </div>

        <!-- ABOUT SECTION -->
        <div class="max-w-7xl mx-auto px-6 py-14">

            <div class="grid md:grid-cols-2 gap-10 items-center">

                <!-- LEFT CONTENT -->
                <div>
                    <h2 class="text-3xl font-bold text-[#253375] mb-4">
                        About Us
                    </h2>

                    <p class="text-gray-600 mb-6">
                        Eurowide Cash & Carry is your reliable wholesale and direct delivery partner, supplying FMCG
                        products across the UK and internationally. With competitive pricing, fast service, and bulk supply,
                        we cater to retailers, restaurants, and caterers, ensuring seamless nationwide and export delivery
                        for your business needs.
                    </p>

                    <!-- CARDS -->
                    <div class="grid grid-cols-2 gap-4 mt-6">

                        <div class="p-4 border rounded-lg text-center hover:bg-[#253375] hover:text-white transition">
                            <div class="text-2xl mb-2">🏢</div>
                            <p class="font-semibold">Wholesalers</p>
                        </div>

                        <div class="p-4 border rounded-lg text-center hover:bg-[#253375] hover:text-white transition">
                            <div class="text-2xl mb-2">🛍️</div>
                            <p class="font-semibold">Retailers</p>
                        </div>

                        <div class="p-4 border rounded-lg text-center hover:bg-[#253375] hover:text-white transition">
                            <div class="text-2xl mb-2">🚚</div>
                            <p class="font-semibold">Distributors</p>
                        </div>

                        <div class="p-4 border rounded-lg text-center hover:bg-[#253375] hover:text-white transition">
                            <div class="text-2xl mb-2">🤝</div>
                            <p class="font-semibold">Trade Agent</p>
                        </div>

                    </div>
                </div>

                <!-- RIGHT IMAGE -->
                <div>
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d" alt="About Eurowide"
                        class="rounded-xl shadow-lg w-full">
                </div>

            </div>

        </div>

        <!-- CATEGORIES SECTION -->
        <div class="bg-gray-50 py-14">
            <div class="max-w-7xl mx-auto px-6">

                <!-- Heading -->
                <h2 class="text-3xl font-bold text-[#253375] mb-8 text-center">
                    Our Categories
                </h2>

                <!-- Categories Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

                    @foreach($categories as $cat)
                        <a href="/category/{{ $cat->id }}"
                            class="bg-[#253375] text-white rounded-xl shadow hover:shadow-lg overflow-hidden group transition">



                            <div class="p-4 flex items-center justify-between hover:bg-[#fff] hover:text-[#253375]">
                                <h3 class="font-semibold">{{ $cat->name }}</h3>
                                <span>→</span>
                            </div>
                        </a>
                    @endforeach

                </div>

            </div>
        </div>


        <!-- PRODUCTS SECTION -->
        <div class="max-w-7xl mx-auto px-6 py-14">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-[#253375]">Featured Products</h2>
                <a href="/products" class="text-blue-600 font-medium">View All →</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                @foreach($products as $p)
                    <div class="border rounded-xl p-4 shadow hover:shadow-lg">

                        <img src="/uploads/{{ $p->image }}" class="rounded-lg mb-3 h-40 w-full object-cover">

                        <h3 class="font-semibold text-lg">{{ $p->title }}</h3>

                        <p class="text-gray-500 text-sm mb-2">
                            {{ \Illuminate\Support\Str::limit($p->description, 50) }}
                        </p>

                        @auth
                            <p class="text-blue-600 font-bold mb-3">£{{ $p->price }}</p>
                        @else
                            <p class="text-red-500 font-medium mb-3">
                                Login to see price
                            </p>
                        @endauth

                        <!-- VIEW -->
                        <a href="/product/{{ $p->id }}" class="block text-center bg-[#253375] text-white py-2 rounded-lg mb-2">
                            View Product
                        </a>

                        <!-- ADD TO CART -->
                        <form action="/add-to-cart/{{ $p->id }}" method="POST">
                            @csrf
                            <button class="w-full bg-green-600 text-white py-2 rounded-lg">
                                Add to Cart
                            </button>
                        </form>

                    </div>
                @endforeach

            </div>

        </div>

    </div>

    <script>
        let slides = document.querySelectorAll('.slide');
        let index = 0;

        setInterval(() => {
            slides[index].classList.add('hidden');
            index = (index + 1) % slides.length;
            slides[index].classList.remove('hidden');
        }, 3000);
    </script>
@endsection